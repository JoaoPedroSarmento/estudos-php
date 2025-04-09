<?php

class UsuarioTime extends Validavel implements JsonSerializable {
    
    public ?Usuario $usuario;
    public ?Time $time;
    public string $papel;

    public function __construct(int $idUsuario , int $idTime , string $papel) {
        global $conexao;

        $repositorioUsuario = new UsuariosRepositorioEmBDR($conexao);
        $repositorioTimes = new TimesRepositorioEmBDR($conexao);
        
        $this->papel = $papel;
        $this->usuario = $repositorioUsuario->obterPeloId($idUsuario);
        $this->time = $repositorioTimes->obterPeloId($idTime);
    }

    public function validar(): void {
        
    }

    public function jsonSerialize(): array {
        return [
            "id" => $this->time->id,
            "timeNome" => $this->time->nome,
            "timeDescricao" => $this->time->descricao,
            "timeDataCriacao" => $this->time->criado_em,
            "usuarioPapel" => $this->papel
        ];
    }
}

?>