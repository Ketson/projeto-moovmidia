<?php

require_once "../CRUD/MySql.php";

class Admin {
    
    private $mysql;

    public function __construct()
    {
        $this->mysql = new MySql('administradores');
    }

}