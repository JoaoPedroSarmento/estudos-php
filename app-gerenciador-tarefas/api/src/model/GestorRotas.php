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

    
    static public function criaFuncaoDaRota(array $metodo, Gestor $gestor): Closure {
        return function () use ($metodo, $gestor) {

            $gestorMetodo = $metodo["gestorMetodo"];
            $dados = $metodo["dados"];
            $resultado = null;

            if ($metodo["recebeArray"]) {
                $resultado = $gestor->{$gestorMetodo}($dados);
            } else {
                $resultado = $gestor->{$gestorMetodo}(...array_values($dados));
            }

            if ($resultado) {
                respostaJson(false, $metodo["msgs"]["msgSucesso"], 200, $resultado);
            }

            respostaJson(true, $metodo["msgs"]["msgErro"], 200, $resultado);
        };
    }
}
