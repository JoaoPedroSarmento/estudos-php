<?php

class Time extends Validavel implements JsonSerializable {
    

    public function __construct(
    public int $id = 0 ,
    public string $nome = "", 
    public string $descricao  = "", 
    public int $id_lider = 0,
    public ?string $criado_em  = null,
    ) {}


    public function validar(): void {
        if(!$this->nome || strlen($this->nome) == 0 || trim($this->nome) == "") $this->problemas[] = "Insira um nome!";
        // verificar  se existe um usuario com este id
        if(!$this->id_lider || $this->id_lider <= 0) $this->problemas[] = "Insira um usuário para ser lider!";
    }

 

    public function jsonSerialize(): array {
        return [
            "id" => $this->id,
            "nome" => $this->nome,
            "descricao" => $this->descricao,
            "criado_em" => $this->criado_em,
            "id_lider" => $this->id_lider
        ];
    }
}

?>