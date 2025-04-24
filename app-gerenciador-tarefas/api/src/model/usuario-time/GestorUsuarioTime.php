<?php

declare(strict_types=1);

final class GestorUsuarioTime extends Gestor
{

    public function __construct(PDO $conexao)
    {
        parent::__construct($conexao, "UsuarioTimeRepositorioEmBDR");
    }

    public function obterPeloId(int $id, string $buscar): array
    {
        global $conexao;

        // $usuariosTies = 
        // listar os times da pessoa ou listar as pessosas do time
        // listar as pessoas do time
        $objetos =   $this->controller->get($id, "Erro ao listar");
        $dados = [];
        if ($buscar == "usuarios") {
            // buscar usuarios
            $repositorioUsuario = new UsuariosRepositorioEmBDR($conexao);
            foreach ($objetos as $obj) {
                $dados[] =  $repositorioUsuario->obterPeloId($obj->usuario_id);
            }
        } else {
            $repositorioTime = new TimesRepositorioEmBDR($conexao);
            foreach ($objetos as $obj) {
                $dados[] =  $repositorioTime->obterPeloId($obj->time_id);
            }
        }
        return $dados;
    }
    public function timeComId(int $id): ?time
    {
        $time = $this->controller->get($id, "Usuário não encontrado!");
        return $time;
    }

    public function cadastrar(int $idTime , int $idUsuario, string $papel): int
    {
        
        // if (!$this->validarDados($idTime , $idUsuario)) respostaJson(true, "Parâmetros inválidos!", 400);
        $time = new UsuarioTime($idUsuario , $idTime , $papel);
        return $this->controller->post($time, "Erro ao criar usuário! Erros: ");
    }

    public function alterar(array $dados): ?int {
        // idUsuario (para verificar se é um lider e pode alterar)
        $id = $this->buscarDado($dados , 0, "intval") ?? $this->buscarDado($dados, "id",);
        $nome =  $this->buscarDado($dados , "nome" );
        $email = $this->buscarDado($dados , "email" );
        $senha = $this->buscarDado($dados , "senha");
        $senhaNova = $this->buscarDado($dados, "senhaNova");

        // if (!$this->validarDados($id, $nome, $email, $senha)) respostaJson(true, "Parâmetros inválidos!", 400);

        $timeBanco =  $this->controller->get($id, "Usuário não encontrado!");

        $time = new time( $id, $nome, $email, $senha, $this->buscarDado($dados , "data_criacao"), $this->buscarDado($dados , "ativo"));

        // verificar se usuario tem permissao para alterar
        // if(){
        return $this->controller->put($time, "Erro ao alterar seus dados!");
        // } else {
        // return null;
        // }
    }


    public function removerComId(int $id, int $idUsuarioTime): int|null {
        // idUsuario (para verificar se é um lider e pode excluir o usuario do time)
        // $usuarioTime->obterPeloId($idUsuario);

            $liderTime = $this->repositorioEmBDR->obterPeloId($idUsuarioTime, true);

        // Verifica se encontrou o líder e se o ID do líder corresponde ao idExcluidor
        if (!empty($liderTime) && $liderTime[0]->usuario_id == $idUsuarioTime) {
            $time = $this->timeComId($id, $idUsuarioTime);
            
            if ($time) {
                return $this->controller->delete($id, "Erro ao excluir seu perfil!");
            } else {
                return null;
            }
        } return null;
    }
}
