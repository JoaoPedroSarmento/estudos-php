<?php

interface RepositorioUsuarioTime {
    

    public function inserir(UsuarioTime $uT):int;

    public function alterar(UsuarioTime $uT):bool;

    public function obterPeloId(int $id , bool $buscarLider):array;

    public function excluirPeloId(int $idExcluidor , int $idExcluido, int $idTime):bool;

    // public function existeComId(int $id):bool;

}

?>