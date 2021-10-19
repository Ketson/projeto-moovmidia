<?php

require_once('../models/CRUD/MySql.php');

class Usuario {

    private $mysql;

    public function __construct()
    {
        $this->mysql = new MySql('usuarios');
    }

    public function create($arrayUsuario){
        $arrayUsuario['criado_em'] = date('Y-m-d H:i:s');
        $arrayUsuario['editado_em'] = date('Y-m-d H:i:s');

        return $this->mysql
    }


}