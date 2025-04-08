<?php

declare(strict_types=1);

final class Usuario extends Validavel implements JsonSerializable {
 

    public int $id;
    public string $nome;
    public string $email;
    public string $senha;
    public ?string $data_criacao;
    public bool $ativo;

    public function __construct(
        int $id = 0,
        string $nome = "",
        string $email = "",
        string $senha = "",
        ?string $data_criacao = null,
        bool $ativo = true
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->data_criacao = $data_criacao;
        $this->ativo = $ativo;
    }

    public function validar(): void {
        if(strlen($this->senha) < 10) $this->problemas[] = "Senha inválida! Digite ao menos 10 caracs";
        else {
            $this->setSenhaComHash($this->senha);
        }
        if(!strlen($this->nome)) $this->problemas[] = "Nome inválido!";
        if(!strlen($this->email)) $this->problemas[] = "E-mail inválido!";
    }

    private function setSenhaComHash(){
        $this->senha = password_hash($this->senha , PASSWORD_DEFAULT);
    }

    
    public function verificaSenha($senha):bool{
        return password_verify($senha, $this->senha);
    }
    
    public function jsonSerialize(): array {
        return [
            "id" => $this->id,
            "nome" => $this->nome, 
            "email" => $this->email,
            "data_criacao" => $this->data_criacao,
            "ativo" => $this->ativo
        ];
    }
}