<?php

require_once('MySql.php');

class Usuario
{

    private $mysql;

    public function __construct()
    {
        $this->mysql = new MySql('usuarios');
    }

    public function create($arrayUsuario)
    {
        $arrayUsuario['criado_em'] = date('Y-m-d H:i:s');
        $arrayUsuario['editado_em'] = date('Y-m-d H:i:s');

        return $this->mysql->inserir($arrayUsuario);
    }

    public function alterarSenha($arrayUsuario, $id)
    {
        $where = "id = $id";
        $arrayUsuario['editado_em'] = date('Y-m-d H:i:s');
        return $this->mysql->atualizar($arrayUsuario, $where);
    }

    public function buscarPorId($id)
    {
        $where = "id = $id";
        if ($this->mysql->buscar($where)) {
            return $this->mysql->buscar($where)[0];
            return null;
        }
    }

    public function buscarPorEmail($email)
    {
        $where = "email = '$email'";

        $usuario = $this->mysql->buscar($where);

        //se tetornar um count maior que 0, achou o email e vai retornar o primeiro
        if (count($usuario) > 0) {
            return $usuario[0];
        } else {
            return false;
        }
    }

    public function buscarPorUsuarioID($id)
    {
        $where = "id = $id";

        $usuario = $this->mysql->buscar($where);

        if(count($usuario) > 0){
            return $usuario[0];
        }else{
            return false;
        }
    }

}
