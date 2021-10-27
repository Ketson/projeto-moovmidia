<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

//imports
require_once("../../models/Admin.php");
require ("../../models/Usuario.php");

//instancias
$usuarioModel = new Usuario();
$adminModel = new Admin();

$admin = $adminModel->buscarAdminPorID($_SESSION['admin_id']);

if(!$admin){
    $_SESSION['danger'] = 'Usuário inválido!';
    header('Location: http://localhost/projetoMoovmidia/app/views/admin/dashboard.php');
    die();
}

$usuario = $usuarioModel->buscarPorUsuarioID($admin['usuarios_id']);

if($usuario['senha'] != md5($_POST['senhaAtual'])){
    $_SESSION['danger'] = 'As senha atual está incorreta!';
    header('Location: http://localhost/projetoMoovmidia/app/views/admin/alterarSenha.php');
    die();
}

if(md5($_POST['novaSenha']) != md5($_POST['confirmarSenha'])){
    $_SESSION['danger'] = 'Nova senha e confirmar senha não são iguais!';
    header('Location: http://localhost/projetoMoovmidia/app/views/admin/alterarSenha.php');
    die();
    
}

$arrayUsuario =  [
    'senha' => md5($_POST['novaSenha'])
];

$usuarioModel->alterarSenha($arrayUsuario,$usuario['id']);

$_SESSION['success'] = 'Senha Alterada com Sucesso!';
header('Location: http://localhost/projetoMoovmidia/app/views/admin/alterarSenha.php');
header('Location: http://localhost/projetoMoovmidia/app/views/admin/dashboard.php');

die();



