<?php

require_once('MySql.php');

class Usuario {

    private $mysql;

    public function __construct()
    {
        $this->mysql = new MySql('usuarios');
    }

    public function create($arrayUsuario){
        $arrayUsuario['criado_em'] = date('Y-m-d H:i:s');
        $arrayUsuario['editado_em'] = date('Y-m-d H:i:s');

        return $this->mysql->inserir($arrayUsuario);
    }

    public function buscarPorEmail($email)
    {
        $where = "email = '$email'";

        $usuario = $this->mysql->buscar($where);

        //se tetornar um count maior que 0, achou o email e vai retornar o primeiro
        if(count($usuario) > 0){
            return $usuario[0];
        }else{
            return false;
        }
    }


}