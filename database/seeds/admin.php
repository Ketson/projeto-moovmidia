<?php

require_once('../../app/models/Usuario.php');
require_once('../../app/models/Admin.php');

$usuarioModel = new Usuario();
$adminModel = new Admin();

$arrayUsuario = [
    'email' => 'ketson@gmail.com',
    'senha' => md5('123456')
];

//salvando o usuario
$usuarioModel->create($arrayUsuario);
$usuario = $usuarioModel->buscarPorEmail($arrayUsuario['email']);

$arrayAdmin = [
    'nome' => 'Kétson',
    'usuarios_id' => $usuario['id']
];

$adminModel->create($arrayAdmin);
