<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

require_once('../../models/InterfaceAdmistrativa/AdminModel.php');

if(!isset($_POST['email']) OR !isset($_POST['senha'])){
    die('Campos inválidos');
}

$AdminModel = new Admin();
