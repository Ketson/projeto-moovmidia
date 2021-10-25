<?php

require_once("MySql.php");

class Admin
{

    private $mysql;

    public function __construct()
    {
        $this->mysql = new MySql('administradores');
    }

    public function create($arrayAdmin)
    {
        $arrayAdmin['criado_em'] = date('Y-m-d H:i:s');
        $arrayAdmin['editado_em'] = date('Y-m-d H:i:s');

        return $this->mysql->inserir($arrayAdmin);
    }

    public function buscarPorUsuarioId($usuario_id)
    {
        $where = "usuarios_id = $usuario_id";

        $admin = $this->mysql->buscar($where);

        //se tetornar um count maior que 0, achou o email e vai retornar o primeiro
        if (count($admin) > 0) {
            return $admin[0];
        } else {
            return false;
        }
    }

    public function buscarAdminPorID($id)
    {
        $where = "id = $id";

        $admin = $this->mysql->buscar($where);

        if (count($admin) > 0) {
            return $admin[0];
        } else {
            return false;
        }
    }

    public function buscarTodos()
    {
       return $this->mysql->buscar();
    }
}
