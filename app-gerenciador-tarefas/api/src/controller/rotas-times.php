<?php

// $idTime = $dados["id"] ?? null;
// $idUsuario = $dados["idUsuario"];


$modeloRotas = [
    "/times" => [
        "gestor" => "GestorTimes",
        "POST" => GestorRotas::modelaMetodoHTTPDaRota(true , "cadastrar" , $dados , "Time criado com sucesso" , "Erro ao criar time!")
    ],
     "/times/:id" => [
        // "POST" => GestorRotas::modelaMetodoHTTPDaRota(false , "")
     ]
];

echo "modelo rotas: ";
return $modeloRotas;
?>