<?php

//exibir os erros
ini_set('display_errors', true);
error_reporting(E_ALL);
//inicia sessão da página
session_start();

require_once('../../vendor/autoload.php');
require_once('../../models/Condutor.php');
require_once('../../models/Usuario.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$condutorModel = new Condutor();
$usuarioModel = new Usuario();

/*
//Caso o email já esteja cadastrado no banco de dados
$existeEmail = $usuarioModel->buscarPorEmail($_POST['email']);
//vai contar os elementos do array
if(count($existeEmail) > 0){
    $_SESSION['danger'] = 'Email já cadastrado!';
    header('Location: http://localhost/projetoMoovmidia/app/views/admin/cadastrarCondutor.php');
}

//Caso o CPF já esteja cadastrado no banco de dados
$existeCPF = $usuarioModel->buscarPorCPF($_POST['cpf']);
if(count($existeCPF) > 0){
    $_SESSION['danger'] = 'CPF já cadastrado!';
    header('Location: http://localhost/projetoMoovmidia/app/views/admin/cadastrarCondutor.php');
}
*/

$arrayUsuario = [
    'email' => $_POST['email'],
    'senha' => md5(rand(111, 999))
];
$usuarioModel->cadastrarUsuario($arrayUsuario);

$arrayCondutor = [
    'nome' => $_POST['nomeCompleto'],
    'cpf' => $_POST['cpf'],
    'telefone' => $_POST['telefone'],
    'placa' => $_POST['placa'],
    'carro' => $_POST['carro'],
    'usuarios_id' => $_SESSION['admin_id']
];
$condutorModel->cadastrarCondutor($arrayCondutor);

$_SESSION['success'] = 'Condutor Cadastrado Com Sucesso!';
header('Location: http://localhost/projetoMoovmidia/app/views/admin/dashboard.php');


$mail = new PHPMailer(true);    //true é para habilitar o disparo de Exception

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();

    //configs para se autentificar no SMTP
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ketsonsantos1999@gmail.com';
    $mail->Password = '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //info do remetente
    $mail->setFrom('ketsonsantos1999@gmail.com', 'Moovimidia');
    $mail->addReplyTo('ketsonsantos1999@gmail.com', 'Moovimidia');

    //info do destinatario
    $mail->addAddress($_POST['email']);

    //configs do email
    $mail->isHTML(true); //corpo da mensagem aceita HTML
    $mail->Subject = utf8_decode('Parabéns, você agora é um condutor cadastrado na Moovmidia!');
    $mail->Body = utf8_decode('Seja bem-vindo, ' . $_POST['nomeCompleto'] . '!' . "<br/><br/>
    Agora seus passageiros vao ver noticias e propagandas enquanto faz a viagem.<br/><br/>
    Suas informações pessoais:<br/>" . "Nome: "
        . $_POST['nomeCompleto'] . "<br/>" . "CPF: " .
        $_POST['cpf'] . "<br/>" . "Telefone: " .
        $_POST['telefone'] . "<br/>" . "Placa: " .
        $_POST['placa'] . "<br/>" . "Carro: " .
        $_POST['carro'] . "<br/>" . "Senha: " .
        $arrayUsuario['senha']);

    //envia o email
    $mail->send();
    echo 'email enviado';
} catch (Exception $e) {
    echo 'Erro ao enviar: ' . $e->getMessage();
}
