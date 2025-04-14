<?php

declare(strict_types=1);

$id = dadoEstaValido($dados , 0);
$senha = dadoEstaValido($dados , "senha");
$email = dadoEstaValido($dados , "email");

// criar uma classe modeloRotas
$modeloRotas = [
    "/usuarios" => [
        "gestor" => "GestorUsuarios",
        "POST" => GestorRotas::modelaMetodoHTTPDaRota(true, "cadastrar", $dados, "Perfil criado com sucesso", "Erro ao criar perfil"),
    ],
    "/usuarios/:id" => [
        "gestor" => "GestorUsuarios",
        "POST" => GestorRotas::modelaMetodoHTTPDaRota(
            false,
            "usuarioComId",
            ["id" => $id, "senha" => $senha, " email" => $email],
            "Perfil encontrado com sucesso!",
            "Senha e/ou e-mail incorretos"
        ),
        "DELETE" =>  GestorRotas::modelaMetodoHTTPDaRota(false, "removerComId", ["id" => $id, "senha" => $senha], "Perfil excluído com sucesso", " Senha incorreta"),
        "PUT" =>   GestorRotas::modelaMetodoHTTPDaRota(true, "alterar", $dados, "Perfil alterado com sucesso", "Senha incorreta!"),
    ],
];

return $modeloRotas;
