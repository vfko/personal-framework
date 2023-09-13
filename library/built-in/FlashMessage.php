<?php

class FlashMessage {

    public function __construct() {

    }

    public function getFlashMessage() {

        if (isset($_SESSION[SESSION_SUCCESS])) {
            $message = $this->sessionSuccess();
            $this->unsetSession(SESSION_SUCCESS);
            return $message;
        } elseif (isset($_SESSION[SESSION_FAILURE])) {
            $message = $this->sessionFailure();
            $this->unsetSession(SESSION_FAILURE);
            return $message;
        } elseif (isset($_SESSION[SESSION_INFO])) {
            $message = $this->sessionInfo();
            $this->unsetSession(SESSION_INFO);
            return $message;
        }

        return '';
    }

    private function sessionSuccess(): string {
        return '<div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Úspěch! </strong>'. $_SESSION[SESSION_SUCCESS].'
                </div>';
    }

    private function sessionFailure(): string {
        return '<div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <strong>Oops! </strong>'. $_SESSION[SESSION_FAILURE].'
                </div>';
    }

    private function sessionInfo(): string {
        return '<div class="alert alert-info alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        '. $_SESSION[SESSION_INFO].'
                </div>';
    }

    private function unsetSession(string $session): void {
        unset($_SESSION[$session]);
    }


}