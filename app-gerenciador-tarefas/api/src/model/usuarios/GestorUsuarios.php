<?php

final class GestorUsuarios extends Gestor
{

    public function __construct(PDO $conexao)
    {
        parent::__construct($conexao, "UsuariosRepositorioEmBDR");
    }

    public function usuarioComId(int $id, string $senha): ?Usuarios
    {
        $usuario = $this->controller->get($id, "Usuário não encontrado!");
        if($usuario->verificaSenha($senha)){
        return $usuario;
        } return null;
    }

    public function cadastrar(array $dados): bool
    {
        if (!$this->validarDados([$dados["nome"], $dados["email"], $dados["senha"]])) respostaJson(true, "Parâmetros inválidos!", 400);
        $usuario = new Usuarios(0, $dados["nome"], $dados["email"], $dados["senha"]);
        return $this->controller->post($usuario, "Erro ao criar usuário! Possíveis erros: e-mail ou senha incorreto(a)");
    }

    public function alterar(array $dados): ?int
    {
        if (!$this->validarDados([$dados["id"] ?? $dados[0], $dados["nome"], $dados["email"], $dados["senha"]])) respostaJson(true, "Parâmetros inválidos!", 400);
        $usuario = new Usuarios($dados["id"] ?? $dados[0], $dados["nome"], $dados["email"], $dados["senha"], $dados["data_criacao"] ?? null, $dados["ativo"] ?? true);
        if($usuario->verificaSenha($dados["senha"])){
        return $this->controller->put($usuario, "Erro ao alterar seus dados!");
        }else{
            return null;
        }
    }


    public function removerComId(int $id, $senha): ?int
    {
        $usuario = $this->usuarioComId($id, $senha);

        if ($usuario) {
            return $this->controller->delete($id, "Erro ao excluir seu perfil!", $senha);
        } else {
            return null;
        }
    }

}
