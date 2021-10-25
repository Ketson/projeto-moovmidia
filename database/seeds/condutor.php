<?php

//imports
require_once("../../app/models/Usuario.php");
require_once("../../app/models/Condutor.php");

//instancias
$usuarioModel = new Usuario();
$condutorModel = new Condutor();

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('A', 'Z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    return $key;
}

for($i = 0 ; $i < 5 ; $i++){
    $arrayUsuario = [
        'email' => 'nome'.$i.'@gmail.com',
        'senha' => md5('123456')
    ];

    $usuarioModel->create($arrayUsuario);

    $usuario = $usuarioModel->buscarPorEmail($arrayUsuario['email']);

    $arrayCondutor = [
        'nome' => 'nome '.$i,
        'cpf' => rand(11111111111,99999999999),
        'telefone' => rand(111111111,999999999),
        'placa' => random_string(5),
        'carro' => "linea",
        'usuarios_id' => $usuario['id']
    ];
    
    $condutorModel->create($arrayCondutor);
}
