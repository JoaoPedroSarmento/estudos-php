<?php

declare(strict_types=1);

/**
 * 
 * Controller serve para controlar os dados retornar os valor retornado do RepositorioEmBDR.
 * Recebe o ObjetoRepositorioEmBDr e em cada método de insercao ou alteracao trabalha com um objeto Vaidavel. 
 */
final class Controller {

    private object $repositorio;


    public function __construct(object $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    public function get(int $id, ?string $msgErro = null , ?string $sql = null , ?string $email = null , bool $temEmail = false) {
        if (!$id) {
            return $this->repositorio->obterTodos();
        } else if ($this->repositorio->existeComId($id , $sql)) { 
            if($temEmail) return $this->repositorio->obterPeloIdEmail($id , $email);
            return $this->repositorio->obterPeloId($id);
        }
        throw new RuntimeException($msgErro ? $msgErro . " - Registro não encontrado" : "Erro ao buscar informações - Registro não encontrado.", 400);
    }


    public function post(Validavel $object, ?string $msgErro = null): int {
        $object->validar();
        $problemas = $object->getProblemas();
        if (!empty($problemas))
            throw new EntradaInvalidaException($msgErro ? $msgErro . $object->getProblemasString() .  " - Dados Inválidos" : "Erro ao cadastrar informações - Dados Inválidos", 500, $problemas);
        return $this->repositorio->inserir($object);
    }


    public function put(Validavel $object, ?string $msgErro = null): int
    {
        $object->validar();
        $problemas = $object->getProblemas();

        if (! empty($problemas))
            throw new EntradaInvalidaException($msgErro ? $msgErro . $object->getProblemasString() . " - Dados Inválidos" :  "Erro ao alterar informações - Dados inválidos", 500, $problemas);
        $this->repositorio->alterar($object);
        return 1;
    }


    public function delete(int $id, ?string $msgErro = null): int
    {
        if (! $this->repositorio->excluirPeloId($id))
            throw new RuntimeException($msgErro ? $msgErro . " - Registro não encontrado" : "Registro não encontrado.", 400);
        return 1;
    }
}
