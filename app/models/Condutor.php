<?php

require_once('MySql.php');

class Condutor
{

    private $mysql;

    public function __construct()
    {
        $this->mysql = new MySql('condutores');
    }

    public function create($arrayCondutor)
    {
        $arrayCondutor['criado_em'] = date('Y-m-d H:i:s');
        $arrayCondutor['editado_em'] = date('Y-m-d H:i:s');
        return $this->mysql->inserir($arrayCondutor);
    }

    public function cadastrarCondutor($arrayCondutor){
        $arrayCondutor['criado_em'] = date('Y-m-d H:i:s');
        $arrayCondutor['editado_em'] = date('Y-m-d H:i:s');

        return $this->mysql->inserir($arrayCondutor);

    }

    public function buscarCondutorPorUsuarioID($usuarios_id)
    {
        $where = "usuarios_id = $usuarios_id";

        $condutor  = $this->mysql->buscar($where);

        if (count($condutor) > 0) 
            return $condutor[0];
         else 
            return false;
    }

    public function atualizar($arrayCondutor, $id)
    {
        $where = "id = $id";
        $arrayCondutor['editado_em'] = date('Y-m-d H:i:s');
        return $this->mysql->atualizar($arrayCondutor, $where);
    }

    public function buscarPorEmail(string $email)
    {
        $where = "email = '$email'";
        return $this->mysql->buscar($where);
    }

    public function buscarPorCPF(string $cpf)
    {
        $where = "cpf = '$cpf'";
        return $this->mysql->buscar($where);
    }

    public function buscarCondutorPorID($id)
    {
        $where = "id = $id";

        $condutor  = $this->mysql->buscar($where);

        if (count($condutor) > 0) 
            return $condutor[0];
         else 
            return false;
    }

    public function buscarTodosCondutores(){
        return $this->mysql->buscar();
    }




}
