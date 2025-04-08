<?php

class UsuarioTime extends Validavel implements JsonSerializable {
    
    public ?Usuario $usuario;
    public ?Time $time;

    public function __construct(int $idUsuario , int $idTime) {
        global $conexao;

        $repositorioUsuario = new UsuariosRepositorioEmBDR($conexao);
        $repositorioTimes = new TimesRepositorioEmBDR($conexao);
        
        $this->usuario = $repositorioUsuario->obterPeloId($idUsuario);
        $this->time = $repositorioTimes->obterPeloId($idTime);
    }

    public function validar(): void {
        
    }

    public function jsonSerialize(): array {
        return [
            
        ];
    }
}

?>