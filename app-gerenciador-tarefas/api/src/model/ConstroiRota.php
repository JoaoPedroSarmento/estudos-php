<?php

final class ConstroiRota {

    private Closure $funcao;
    private Gestor $gestor;

    public function __construct(private array $metodo, string $gestor, PDO $conexao) {
        $this->gestor = new $gestor($conexao);
        $this->configurarRota();
    }

    private function configurarRota(): void {
        $metodo = $this->metodo;

        $this->funcao = function () use ($metodo) {
            $resultado = null;

            if ($metodo["recebeArray"]) {
                $resultado = $this->gestor->{$metodo["gestorMetodo"]}($metodo["dados"]);
            } else {
                $resultado = $this->gestor->{$metodo["gestorMetodo"]}(...array_values($metodo["dados"]));
            }

            if ($resultado) {
                respostaJson(false, $metodo["msgs"]["msgSucesso"], 200, $resultado);
            }

            respostaJson(true, $metodo["msgs"]["msgErro"], 200, $resultado);
        };
    }

    public function getFuncao(): Closure {
        return $this->funcao;
    }
}
