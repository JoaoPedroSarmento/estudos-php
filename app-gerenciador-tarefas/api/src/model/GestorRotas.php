<?php

abstract class GestorRotas {

    static public  function  modelaMetodoHTTPDaRota(bool $recebeArray, string $gestorMetodo, array|null $dados, string $msgSucesso, string $msgErro): array {
        return  [
            "recebeArray" => $recebeArray,
            "gestorMetodo" => $gestorMetodo,
            "dados" => $dados,
            "msgs" => [
                "msgSucesso" => $msgSucesso,
                "msgErro" => $msgErro
            ]
        ];
    }

    
    static public function criaFuncaoDaRota(array $metodo, string $gestor, PDO $conexao): Closure {
        return function () use ($metodo, $gestor, $conexao) {
            $gestor = new $gestor($conexao);
            $gestorMetodo = $metodo["gestorMetodo"];

            $resultado = null;

            if ($metodo["recebeArray"]) {
                $resultado = $gestor->{$metodo["gestorMetodo"]}($metodo["dados"]);
            } else {
                $resultado = $gestor->{$metodo["gestorMetodo"]}(...array_values($metodo["dados"]));
            }

            if ($resultado) {
                respostaJson(false, $metodo["msgs"]["msgSucesso"], 200, $resultado);
            }

            respostaJson(true, $metodo["msgs"]["msgErro"], 200, $resultado);
        };
    }
}
