<?php 

declare(strict_types=1);

final class Produto  extends Validavel implements JsonSerializable{

    public int $id = 0;
    public string $nome;
    public int $codigo;
    public float $preco;


    public function __construct(int $id = 0 , string $nome = "" , int $codigo = 0 , float $preco = 0.0) {

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