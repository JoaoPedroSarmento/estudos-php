<?php

final class GestorTimes extends Gestor {

    public function __construct(PDO $conexao) {
        parent::__construct($conexao, "TimesRepositorioEmBDR");
    }

    public function timeComId(int $id): ?time {
        $time = $this->controller->get($id, "Time não encontrado!");
        return $time;
    }

    public function cadastrar(array $dados): bool {
        $nome = $this->dadoEstaValido($dados , "nome");
        $descricao = $this->dadoEstaValido($dados , "descricao");
        $id_lider = $this->dadoEstaValido($dados , "id_lider");

        if (!$this->validarDados($nome, $descricao , $id_lider)) respostaJson(true, "Parâmetros inválidos!", 400);
        $time = new time(0,$nome , $descricao , $id_lider);
        return $this->controller->post($time, "Erro ao criar time! Erros: ");
    }

    public function alterar(array $dados): ?int {
        // idUsuario (para verificar se é um lider e pode alterar)
        $id = $this->dadoEstaValido($dados , 0) ?? $this->dadoEstaValido($dados , "id");
        $nome = $this->dadoEstaValido($dados , "nome");
        $email = $this->dadoEstaValido($dados , "email");
        $senha = $this->dadoEstaValido($dados , "senha");
        $senhaNova = $this->dadoEstaValido($dados , "senhaNova");

        if (!$this->validarDados($id, $nome, $email, $senha)) respostaJson(true, "Parâmetros inválidos!", 400);

        $timeBanco =  $this->controller->get($id, "Time não encontrado!");

        $time = new time($id, $nome, $email, $senha, $this->dadoEstaValido($dados , "data_criacao"), $this->dadoEstaValido($dados , "ativo"));

        // verificar se usuario tem permissao para alterar
        // if(){
        return $this->controller->put($time, "Erro ao alterar seus dados!");
        // } else {
        // return null;
        // }
    }


    public function removerComId(int $id, int $idUsuarioTime): ?int {
        global $conexao;

        // idUsuario (para verificar se é um lider e pode excluir o time)
        $repositorioUsuarioTime = new UsuarioTimeRepositorioEmBDR($conexao);
        $lider = $repositorioUsuarioTime->obterPeloId($idUsuarioTime, true);

        if (!empty($lider)) {
            
            $time = $this->timeComId($id);

            if ($time) {
                return $this->controller->delete($id, "Erro ao excluir seu time!");
            }
        }
        return null;
    }
}
