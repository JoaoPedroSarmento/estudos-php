<?php

abstract class Gestor {
    protected object $repositorioEmBDR;
    protected Controller $controller;

    public function __construct(PDO $conexao, string $classe) {
        $this->repositorioEmBDR = new $classe($conexao);
        $this->controller = new Controller($this->repositorioEmBDR);
    }


    public function dadoEstaValido(array $dados , int|string $param):mixed{
        if(isset($dados[$param]) && !empty($dados[$param])) return $dados[$param];
        return null;
    }
    
    protected function validarDados(...$parametros) {
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
