<?php 

declare(strict_types=1);


final class UsuariosRepositorioEmBDR extends RepositorioEmBDR implements RepositorioUsuarios{
      

    public function inserir(Usuario $u): int{

      $sql = "INSERT INTO usuarios(nome , email, senha) VALUE(:nome , :email , :senha)";
      $msgErro = "Erro ao criar perfil! Troque o e-mail!";
      $parametros = [
        "nome" => $u->nome , 
        "email" => $u->email , 
        "senha" => $u->senha
      ];

    ["conexao" => $conexao] =   $this->executar($sql , $msgErro , $parametros);

      return (int) $conexao->lastInsertId();
    }


    public function alterar(Usuario $u):bool {
       $sql = "UPDATE usuarios SET nome = :nome , email = :email , senha = :senha WHERE id = :id";
       $msgErro = "Erro ao alterar perfil!";
       $parametros = [
        "id" => $u->id,
        "nome" => $u->nome , 
        "email" => $u->email , 
        "senha" => $u->senha,
       ];

     ["ps" => $ps] =  $this->executar($sql , $msgErro , $parametros);
     return $ps->rowCount() > 0;
}

public function excluirPeloId(int $id):bool{

  $msgErro = "Erro ao excluir perfil!";

  return $this->removerRegistroComId($id , Usuario::class,$msgErro);

}


public function obterPeloIdEmail(int $id , string $email):?Usuario{
  // erro ao buscar email errado

  $sql = "SELECT * FROM usuarios WHERE id = :id and email = :email";
  $msgErro = "Senha incorreta e/ou e-mail incorretos!";
  $parametros = [
    "id" => $id,
    "email" => $email
  ];
  
 $usuario =  $this->primeiroObjetoDaClasse($sql , Usuario::class, $parametros , $msgErro);
  
 return $usuario;
}

public function obterPeloId(int $id) {
  $sql = "SELECT * FROM usuarios WHERE id = :id";
  $msgErro = "Senha incorreta e/ou email incorretos!";
  $parametros = [
    "id" => $id,
  ];
  
 $usuario =  $this->primeiroObjetoDaClasse($sql , Usuario::class, $parametros , $msgErro);
  
 return $usuario;
}


public function existeComId(int $id):bool{
  $sql = "SELECT * FROM usuarios WHERE id = :id";  
  $msgErro = "Erro ao encontrar perfil!";
  $parametros = [
    "id" => $id
  ];
  $produto =  $this->primeiroObjetoDaClasse($sql ,  Usuario::class ,  $parametros, $msgErro);
  
  return $produto !== null;
  
}

}

?> 