<?php

class Time extends Validavel implements JsonSerializable {
    
    public function __construct(
    public int $id = 0 ,
    public string $nome = "", 
    public string $descricao  = "", 
    public ?string $criado_em  = null
    ) {}


    public function validar(): void {
        
    }


    public function jsonSerialize(): array {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "descricao" => $this->descricao,
            "criado_em" => $this->criado_em
        ];
    }
}

?>