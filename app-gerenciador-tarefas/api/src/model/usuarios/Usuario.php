<?php

declare(strict_types=1);

final class Usuario extends Validavel implements JsonSerializable {
 


    public function __construct(
        public int $id = 0,
        public string $nome = "",
        public string $email = "",
        public string $senha = "",
        public ?string $data_criacao = "",
        public bool $ativo = true
    ) {}


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