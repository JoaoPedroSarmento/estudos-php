<?php

interface RepositorioTimes {
    
    public function inserir(Time $u):int;

    public function alterar(Time $u, UsuarioTime $uT):bool;

    public function obterPeloId(int $id):?Time;

    public function excluirPeloId(int $id, UsuarioTime $uT):bool;

    public function existeComId(int $id):bool;

}

?>