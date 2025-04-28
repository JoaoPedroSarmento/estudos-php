<?php

abstract class Gestor {
    protected object $repositorioEmBDR;
    protected Controller $controller;

    public function __construct(PDO $conexao, string $classe) {
        $this->repositorioEmBDR = new $classe($conexao);
        $this->controller = new Controller($this->repositorioEmBDR);
    }


    public function buscarDado(array $dados , string|int $param , string|null $casting = null){
        return $casting ? $casting($dados[$param]) : $dados[$param];
    }


    public function dadoEstaValido(array $dados , int|string $param , string|null $casting = null):mixed{
       
        if(isset($dados[$param]) && !empty($dados[$param])) return $casting ? $casting($dados[$param]) : $dados[$param];
        return null;
    }
    
    
    public function validarDados(...$parametros) {
        $valido  = true;

        foreach ($parametros as $param) {

            if (!$param || !isset($param) || empty($param)) {
                $valido = false;
                break;
            };
        }

        return $valido;
    }
}
