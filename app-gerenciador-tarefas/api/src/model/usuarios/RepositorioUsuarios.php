<?php 

interface RepositorioUsuarios{
    
    public function inserir(Usuarios $u):int;

    public function alterar(Usuarios $u):bool;

    public function obterPeloId(int $id):?Usuarios;

    public function excluirPeloId(int $id):bool;

    public function existeComId(int $id):bool;
}

?>