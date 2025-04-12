<?php

declare(strict_types=1);

$modeloRotas = [
    "/usuarios" => [
        "gestor" => "GestorUsuarios",
        "POST" => [
            "recebeArray" => true,
            "gestorMetodo" => "cadastrar",
            "dados" => $dados,
            "msgs" => [
                "msgSucesso" => "Perfil criado com sucesso",
                "msgErro" =>  "Erro ao criar perfil!"
            ]
        ]

    ], "/usuarios/:id" => [
        "gestor" => "GestorUsuarios",
        "POST" => [
            "recebeArray" => false,
            "gestorMetodo" => "usuarioComId",
            "dados" => [
                "id" => (int) ($dados[0] ?? null),
                "senha" => (string) ($dados["senha"] ?? null),
                "email" => (string) ($dados["email"] ?? null)
            ],
            "msgs" => [
                "msgSucesso" => "Perfil encontrado com sucesso",
                "msgErro" =>  "Senha e/ou e-mail incorretos"
            ]
        ], "DELETE" => [
            "recebeArray" => false,
            "gestorMetodo" => "removerComId",
            "dados" => [
                "id" => (int) ($dados[0] ?? null),
                "senha" => (string) ($dados["senha"] ?? null)
            ],
            "msgs" => [

                "msgSucesso" => "Perfil excluído com sucesso",
                "msgErro" => "Senha incorreta"
            ]
        ], "PUT" => [
            "recebeArray" => true,
            "gestorMetodo" => "alterar",
            "dados" => $dados,
            "msgs" => [
                "msgSucesso" => "Perfil alterado com sucesso",
                "msgErro" =>    "Senha incorreta!"
            ]
        ]
    ]

];

return $modeloRotas;
