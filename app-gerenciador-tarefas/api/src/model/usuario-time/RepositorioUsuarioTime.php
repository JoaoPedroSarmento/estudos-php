<?php

interface RepositorioUsuarioTime {
    
    public function listarPorId(int $id):array;

    public function inserir(UsuarioTime $uT):int;

    public function alterar(UsuarioTime $uT):bool;

    public function obterPeloId(int $id):?Time;

    public function excluirPeloId(?int $idExcluidor , int $idExcluido):bool;

    public function existeComId(int $id):bool;

}

?>