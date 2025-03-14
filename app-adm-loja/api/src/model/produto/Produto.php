<?php 

declare(strict_types=1);

class Produto implements JsonSerializable{

    private array $problemas = [];


    public int $id = 0;
    public string $nome;
    public int $codigo;
    public float $preco;


    public function __construct($id = 0 , string $nome , int $codigo , float $preco) {
         $this->id = $id;
         $this->nome = $nome;
         $this->codigo = $codigo;
         $this->preco = $preco;
    }


    public function validar ():void{
        if(strlen($this->nome) <= 1) $this->problemas[] = "Nome inválido";
        if($this->codigo <= 0) $this->problemas[] = "Código inválido";
        if($this->preco <= 0) $this->problemas[] = "Preço inválido";
    } 


    public function getProblemas():array{  
      return $this->problemas; 
    }
    
    public function jsonSerialize(): array{
       return [
        "id" => $this->id ,
        "nome" => $this->nome,
        "codigo" => $this->codigo,
        "preco" => $this->preco
       ];
    }
}

?> 