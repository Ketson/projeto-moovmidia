<?php
ini_set('display_erros', true);
error_reporting(E_ALL);
session_start();

//imports
require_once('../../models/Condutor.php');
require_once('../../models/Usuario.php');

//instancias
$usuarioModel = new Usuario();
$condutorModel = new Condutor();

$condutor = $condutorModel->buscarCondutorPorID($_POST['id']);
$usuario = $usuarioModel->buscarPorUsuarioID($condutor['usuarios_id']);

//Caso o email já esteja cadastrado no banco de dados
/*$existeEmail = $usuarioModel->buscarPorEmail($_POST['email']);
//vai contar os elementos do array
if(count($existeEmail) > 0){
    $_SESSION['danger'] = 'Email já cadastrado!';
    header('Location: http://localhost/projetoMoovmidia/app/views/admin/dashboard.php');
}
*/

$arrayUsuario = [
    'email' => $_POST['email']
];
$usuarioModel->alterarSenha($arrayUsuario,$usuario['id']);

$arrayCondutor = [
        'nome' => $_POST['nomeCompleto'],
        'cpf' => $_POST['cpf'],
        'telefone' => $_POST['telefone'],
        'placa' => $_POST['placa'],
        'carro' => $_POST['carro']
];
$condutorModel->atualizar($arrayCondutor,$condutor['id']);
$condutorModel->buscarTodosCondutores();

$_SESSION['success'] = 'Condutor Atualizado!';
header('Location: http://localhost/projetoMoovmidia/app/views/admin/dashboard.php');
die();
