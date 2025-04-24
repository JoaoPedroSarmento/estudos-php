<?php

declare(strict_types=1);

// criar gestor
$gestorUsuario = new GestorUsuarios($conexao);

$id = $gestorUsuario->dadoEstaValido($dados , 0, "intval") ??  $gestorUsuario->dadoEstaValido($dados , "id", "intval");
$senha = $gestorUsuario->dadoEstaValido($dados , "senha", "strval");
$email = $gestorUsuario->dadoEstaValido($dados , "email", "strval");

// criar uma classe modeloRotas
$modeloRotas = [
    "/usuarios" => [
        "POST" => Roteador::modelaRequisicao(true, "cadastrar", $dados, "Perfil criado com sucesso", "Erro ao criar perfil", $gestorUsuario),
    ],
    "/usuarios/:id" => [
        "POST" => Roteador::modelaRequisicao(
            false,
            "usuarioComId",
            ["id" => $id, "senha" => $senha, " email" => $email],
            "Perfil encontrado com sucesso!",
            "Senha e/ou e-mail incorretos", $gestorUsuario
        ),
        "DELETE" =>  Roteador::modelaRequisicao(false, "removerComId", ["id" => $id, "senha" => $senha], "Perfil excluído com sucesso", " Senha incorreta", $gestorUsuario),
        "PUT" =>   Roteador::modelaRequisicao(true, "alterar", $dados, "Perfil alterado com sucesso", "Senha incorreta!", $gestorUsuario),
    ],
];

return $modeloRotas;
