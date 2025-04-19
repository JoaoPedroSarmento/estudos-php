<?php

// criar instacia Gestor e em Gestor colocar dadoEstaValido

$gestorTimes = new GestorTimes($conexao);
$idTime = $gestorTimes->dadoEstaValido($dados , "idTime");
$idUsuario = $gestorTimes->dadoEstaValido($dados , "idUsuario");

$modeloRotas = [
    "/times" => [
        "gestor" => $gestorTimes,
        "POST" => GestorRotas::modelaMetodoHTTPDaRota(true , "cadastrar" , $dados , "Time criado com sucesso" , "Erro ao criar time!")
    ],
     "/times/:id" => [
        // "POST" => GestorRotas::modelaMetodoHTTPDaRota(false , "buscarPorId" , $dados , ""),
     ]
];

return $modeloRotas;
?>

