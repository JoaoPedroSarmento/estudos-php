<?php

abstract class Gestor {
    protected object $repositorioEmBDR;
    protected Controller $controller;

    public function __construct(PDO $conexao, string $classe) {
        $this->repositorioEmBDR = new $classe($conexao);
        $this->controller = new Controller($this->repositorioEmBDR);
    }


    public function buscarDado(array $dados , $param){
        return $dados[$param];
    }


    public function dadoEstaValido(array $dados , int|string $param , string|null $casting = null):mixed{
        $dado = $this->buscarDado($dados , $param);
        if(isset($dado) && !empty($dado)) return $casting ? $casting($dado) : $dado;
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
