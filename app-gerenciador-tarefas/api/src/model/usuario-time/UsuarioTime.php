<?php

declare(strict_types=1);

class UsuarioTime extends Validavel implements JsonSerializable {
    
    public ?Usuario $usuario;
    public ?Time $time;

    public function __construct(
        int $idUsuario = 0,
        int $idTime = 0,
        public string $papel = ""
    ) {
        global $conexao;

        $repositorioUsuario = new UsuariosRepositorioEmBDR($conexao);
        $repositorioTimes = new TimesRepositorioEmBDR($conexao);
        
        $this->papel = $papel;
        if($idUsuario !== 0) $this->usuario = $repositorioUsuario->obterPeloId($idUsuario);
        if($idTime !== 0) $this->time = $repositorioTimes->obterPeloId($idTime);
    }

    public function validar(): void {
        
    }

    public function jsonSerialize(): array {
        return [
            "id" => $this->time->id,
            "timeNome" => $this->time->nome,
            "timeDescricao" => $this->time->descricao,
            "timeDataCriacao" => $this->time->criado_em,
            "usuarioPapel" => $this->papel,
            "usuario_id" => $this->usuario->id
        ];
    }
}

?>