<?php 

declare(strict_types=1);

class Produto {

    private array $problemas = [];


    public function __construct(
      public int $id = 0, 
      public string $nome = "", 
      public int $codigo = 0, 
      public float $preco = 0.0
    ){}
  
    public function validar ():void{
        if(strlen($this->nome) <= 1) $this->problemas[] = "Nome inválido";
        if($this->codigo <= 0) $this->problemas[] = "Código inválido";
        if($this->preco <= 0) $this->problemas[] = "Preço inválido";
    } 


    public function getProblemas():array{  
      return $this->problemas; 
    }
    
}

?> 