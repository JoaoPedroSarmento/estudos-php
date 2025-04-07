<?php 

declare(strict_types=1);

abstract class Validavel{

    protected array $problemas = [];
    
    abstract public function validar():void;
    
    public function getProblemas():array{
        return $this->problemas;
    }
}

?>