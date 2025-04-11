<?php 

declare(strict_types=1);

interface RepositorioUsuarios{
    
    public function inserir(Usuario $u):int;

    public function alterar(Usuario $u):bool;

    public function obterPeloIdEmail(int $id , string $email):?Usuario;

    public function obterPeloId(int $id);
    
    public function excluirPeloId(int $id):bool;

    public function existeComId(int $id):bool;
}

?>