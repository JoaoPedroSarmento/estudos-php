<?php

abstract class Roteador {
    static public function modelaRequisicao(
        bool $recebeArray, 
        string $metodo, 
        ?array $dados, 
        string $msgSucesso, 
        string $msgErro, 
        Gestor $gestor
    ): array {
        return [
            "gestor" => $gestor,
            "recebeArray" => $recebeArray,
            "metodo" => $metodo,
            "dados" => $dados,
            "msgs" => ["sucesso" => $msgSucesso, "erro" => $msgErro]
        ];
    }

    static public function fabricaHandler(array $configs): Closure {
        return function () use ($configs) {
            $gestor = $configs["gestor"];
            $dados = $configs["dados"];
            
            $valido = $configs["recebeArray"] 
                ? $gestor->validarDados($dados) 
                : $gestor->validarDados(...$dados);

            if (!$valido) {
                respostaJson(true, "Parâmetros inválidos", 500);
            }

            $resultado = $configs["recebeArray"]
                ? $gestor->{$configs["metodo"]}($dados)
                : $gestor->{$configs["metodo"]}(...$dados);

            respostaJson(
                !$resultado,
                $configs["msgs"][$resultado ? "sucesso" : "erro"],
                $resultado ? 200 : 500,
                $resultado
            );
        };
    }
}