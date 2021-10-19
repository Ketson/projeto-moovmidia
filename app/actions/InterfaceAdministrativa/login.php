<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

//imports
require_once('../../models/Usuario.php');
require_once('../../models/Admin.php');

//Validações
if (!isset($_POST['email']) or !isset($_POST['senha'])) {
    die('Campos inválidos');
}

//instancias
$usuarioModel = new Usuario();
$adminModel = new Admin();

//inputs
$email = htmlspecialchars($_POST['email']);
$senha = htmlspecialchars($_POST['senha']);

//vai retonar um array ou falso
$usuario = $usuarioModel->buscarPorEmail($email);

//se retonar falso | criptofar a senha pra ver se é igual a que tá no banco de dados
if (!$usuario or md5($senha) != $usuario['senha']) {
    $_SESSION['danger'] = 'E-mail ou senha inválidos!';
    header('Location: http://localhost/projetoMoovmidia/app/views/admin/login.php');
    die();
}

$admin = $adminModel->buscarPorUsuarioId($usuario['id']);
//se o admin não existe
if(!$admin){
    $_SESSION['danger'] = 'Usuário inválido!';
    header('Location: http://localhost/projetoMoovmidia/app/views/admin/login.php');
    die();
}

header('Location: http://localhost/projetoMoovmidia/app/views/admin/dashboard.php');

$_SESSION['autenticado_admin'] = true; //vai ligar a sessão autenticado
$_SESSION['admin_id'] = $admin['id']; //salvar o id do admin logado, que ai no painel administrativo vai mostrar o nome do administador logado
$_SESSION['admin_nome'] = $admin['nome'];