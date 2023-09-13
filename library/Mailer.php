<?php

use PHPMailer\PHPMailer;
use PHPMailer\Exception;

final class Mailer {

    private object $mail;
    private object $db;


    public function __construct() {
        $this->mail = new PHPMailer\PHPMailer(true);
        $this->db = new MysqliDb(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT, DB_CHARSET, DB_SOCKET);
    }

}