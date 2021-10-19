<?php

require_once('../../app/models/Usuario.php');
require_once('../../app/models/Admin.php');

$usuarioModel = new Usuario();
$adminModel = new Admin();

$arrayUsuario = [
    'email' => 'admin@gmail.com',
    'senha' => md5('123456')
];

//salvando o usuario
$usuarioModel->create($arrayUsuario);
$usuario = $usuarioModel->buscarPorEmail($arrayUsuario['email']);

$arrayAdmin = [
    'nome' => 'Admin',
    'usuarios_id' => $usuario['id']
];

$adminModel->create($arrayAdmin);
