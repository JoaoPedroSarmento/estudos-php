<?php
 
final class GestorTimes extends Gestor
{

    public function __construct(PDO $conexao)
    {
        parent::__construct($conexao, "TimesRepositorioEmBDR");
    }

    public function timeComId(int $id): ?time
    {
        $time = $this->controller->get($id, "Usuário não encontrado!");
        return $time;
    }

    public function cadastrar(array $dados): bool
    {
        if (!$this->validarDados([$dados["nome"], $dados["email"], $dados["senha"]])) respostaJson(true, "Parâmetros inválidos!", 400);
        $time = new time(0, $dados["nome"], $dados["email"], $dados["senha"]);
        return $this->controller->post($time, "Erro ao criar usuário! Erros: ");
    }

    public function alterar(array $dados): ?int
    {
        // idUsuario (para verificar se é um lider e pode alterar)
        $id = $dados["id"] ?? $dados[0];
        $nome =  $dados["nome"];
        $email = $dados["email"];
        $senha = $dados["senha"];
        $senhaNova = $dados["senhaNova"];

        if (!$this->validarDados([
            $id,
            $nome,
            $email,
            $senha
        ])) respostaJson(true, "Parâmetros inválidos!", 400);

        $timeBanco =  $this->controller->get($id, "Usuário não encontrado!");

        $time = new time(
            $id,
            $nome,
            $email,
            $senha,
            $dados["data_criacao"] ?? null,
            $dados["ativo"] ?? true
        );

        // verificar se usuario tem permissao para alterar
        // if(){
            return $this->controller->put($time, "Erro ao alterar seus dados!");
        // } else {
            // return null;
        // }
    }


    public function removerComId(int $id, int $idUsuarioTime): ?int
    {
        // idUsuario (para verificar se é um lider e pode excluir)
        // $usuarioTime->obterPeloId($idUsuario);
        $time = $this->timeComId($id, $idUsuarioTime);

        if ($time) {
            return $this->controller->delete($id, "Erro ao excluir seu perfil!", $senha);
        } else {
            return null;
        }
    }
}
