<?php

abstract class Gestor {
    protected object $repositorioEmBDR;
    protected Controller $controller;

    public function __construct(PDO $conexao, string $classe) {
        $this->repositorioEmBDR = new $classe($conexao);
        $this->controller = new Controller($this->repositorioEmBDR);
    }

    protected function validarDados(array $parametros) {
        $valido  = true;

        foreach ($parametros as $param) {
            if (!$param || !isset($param)) {
                $valido = false;
                break;
            };
        }

        return $valido;
    }
}
