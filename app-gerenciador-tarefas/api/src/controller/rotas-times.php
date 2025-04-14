<?php

$idTime = dadoEstaValido($dados , "idTime");
$idUsuario = dadoEstaValido($dados , "idUsuario");

$modeloRotas = [
    "/times" => [
        "gestor" => "GestorTimes",
        "POST" => GestorRotas::modelaMetodoHTTPDaRota(true , "cadastrar" , $dados , "Time criado com sucesso" , "Erro ao criar time!")
    ],
     "/times/:id" => [
        // "POST" => GestorRotas::modelaMetodoHTTPDaRota(false , "buscarPorId" , $dados , ""),
     ]
];

return $modeloRotas;
?>