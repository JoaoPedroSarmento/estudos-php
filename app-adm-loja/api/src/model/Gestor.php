<?php

abstract class Gestor{
     protected RepositorioEmBDR $repositorioEmBDR;
     protected Controller $controller;

     public function __construct(PDO $conexao , string $classe) {
        $this->repositorioEmBDR = new $classe($conexao);
        $this->controller = new Controller($this->repositorioEmBDR);
     }

     protected function validarObjeto(array $parametros){
        $valido  = true;

        foreach($parametros as $param){
            if(isset($param)) $valido = false;
        } 

        return $valido;
    } 
}
?>