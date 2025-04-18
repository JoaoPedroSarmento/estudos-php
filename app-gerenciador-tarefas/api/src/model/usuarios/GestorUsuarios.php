<?php

declare(strict_types=1);

final class GestorUsuarios extends Gestor {

    public function __construct(PDO $conexao)
    {
        parent::__construct($conexao, "UsuariosRepositorioEmBDR");
    }

    public function usuarioComId(int $id, string $senha, ?string $email = null): Usuario|null {
    
        if(!$this->validarDados([$id , $senha , $email])) respostaJson(true , "Parâmetros inválidos!" , 400);
        $usuario = $this->controller->get($id, "Usuário não encontrado!" , null , $email , true);
        if ($usuario && $usuario->verificaSenha($senha)) {
            return $usuario;
        }
        return null;
    }

    public function cadastrar(array $dados): int {
      
        $nome =  $this->dadoEstaValido($dados , "nome");
        $email = $this->dadoEstaValido($dados , "email");
        $senha = $this->dadoEstaValido($dados , "senha");

        if(!$nome || !$email || !$senha) respostaJson(true , "Parâmetros inválidos" , 400);
        
        $usuario = new Usuario(0, $nome, $email, $senha);
        return $this->controller->post($usuario, "Erro ao criar usuário! Erros: ");
    }

    public function alterar(array $dados): int|null {
        
        $id = (int) ($this->dadoEstaValido($dados , "id") || $this->dadoEstaValido($dados , 0));
        $nome =  $this->dadoEstaValido($dados , "nome");
        $email = $this->dadoEstaValido($dados , "email");
        $senha = $this->dadoEstaValido($dados , "senha");
        $senhaNova = $this->dadoEstaValido($dados , "senhaNova");

        if (!$id ||  !$nome  || !$email || !$senha) respostaJson(true, "Parâmetros inválidos!", 400);

        $usuarioBanco =  $this->controller->get($id, "Usuário não encontrado!");

        $usuario = new Usuario(
            $id,
            $nome,
            $email,
            $senha,
            $dados["data_criacao"] ?? null,
            $dados["ativo"] ?? true
        );

        if ($usuarioBanco->verificaSenha($senha)) {
            if(isset($senhaNova)){
                $usuario->senha = $senhaNova;
            }

            return $this->controller->put($usuario, "Erro ao alterar seus dados!");
        } else {
            return null;
        }
    }


    public function removerComId(int $id, $senha): int|null {

        $usuarioBanco = $this->usuarioComId($id, $senha);

        if ($usuarioBanco) {
            return $this->controller->delete($id, "Erro ao excluir seu perfil!", $senha);
        } else {
            return null;
        }
    }
}
