<?php


class Authenticate extends Model {

    private array $all_users;

    public function __construct(string $users_table_name) {
        $this->all_users = $this->getTableData($users_table_name);
    }



    public function logIn(string $user_name, string $password) {
        foreach ($this->all_users as $user) {
            if ($user[USERNAME] == $user_name && $this->verifyPassword($password, $user[PASSWORD])) {
                $_SESSION[USERNAME] = $user[USERNAME];
                $_SESSION[ROLE] = $user[ROLE];
                $_SESSION['user_logged_in'] = 'logged';
            }
        }
    }

    public function logOut(string $redirect_to='') {
        session_destroy();
        if ($redirect_to != '') {
            header('Location: '.$redirect_to);
        }
    }

    private function hashPassword(string $password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function verifyPassword(string $password, string $hashed_password) {
        if (password_verify($password, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool    return false if user already exist or insert to table failed
     */
    public function createNewUser(string $user_name, string $password, string $role=DEFAULT_USER_ROLE): bool {
        foreach ($this->all_users as $user) {
            if ($user[USERNAME] == $user_name) {
                return false;
            }
        }
        return $this->insertToTable(TABLE_USERS, array(USERNAME=>$user_name, PASSWORD=>$this->hashPassword($password), ROLE=>$role));
    }

    /**
     * @return bool     return false if user doesn't exist or update table failed
     */
    public function updateUserPassword(string $user_name, string $password): bool {
        foreach ($this->all_users as $user) {
            if ($user[USERNAME] == $user_name) {
                return $this->updateTableRow(TABLE_USERS, array(USERNAME=>$user_name), array(PASSWORD=>$this->hashPassword($password)));
            }
        }
        return false;
    }

}