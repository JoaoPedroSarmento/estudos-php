<?php

class Time extends Validavel implements JsonSerializable {
    public int $id;
    public string $nome;
    public string $descricao;
    public string $criado_em;

    public function __construct(
        int $id = 0,
        string $nome = "",
        string $descricao = "",
        ?string $criado_em = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->criado_em = $criado_em;
    }

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