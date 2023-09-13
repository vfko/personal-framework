<?php

class HomepageModel {

    private object $db;

    public function __construct() {
        $this->db = new MysqliDb(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT, DB_CHARSET, DB_SOCKET);
    }

    
}