<?php

// criar instacia Gestor e em Gestor colocar dadoEstaValido

$gestorUsuarioTime = new GestorUsuarioTime($conexao);

$idTime = $gestorUsuarioTime->dadoEstaValido($dados, "idTime", "intval");
$idUsuario = $gestorUsuarioTime->dadoEstaValido($dados, "idUsuario", "intval");
$papel = $gestorUsuarioTime->dadoEstaValido($dados , "papel" , "strval");

$modeloRotas = [
    "/usuario-time" => [
        "POST" => Roteador::modelaRequisicao(false, "cadastrar", ["idTime" => $idTime ,  "idUsuario" => $idUsuario , "papel" => $papel], "Usuario adicionado ao time com sucesso", "Erro ao adicionar usuário ao time!", $gestorUsuarioTime)
    ],
    "/usuario-time/:id" => [
        // "POST" => GestorRotas::modelaRequisicao(false , "buscarPorId" , $dados , ""),
    ]
];

return $modeloRotas;
?>

