<?php 

declare(strict_types=1);


final class UsuariosRepositorioEmBDR extends RepositorioEmBDR implements RepositorioUsuarios{
      

    public function inserir(Usuario $u): int{

      $sql = "INSERT INTO usuarios(nome , email, senha) VALUE(:nome , :email , :senha)";
      $msgErro = "Erro ao inserir produto!";
      $parametros = [
        "nome" => $u->nome , 
        "email" => $u->email , 
        "senha" => $u->senha
      ];

      $this->executar($sql , $msgErro , $parametros);

      return 1;
    }


    public function alterar(Usuario $u):bool {
       $sql = "UPDATE usuarios SET nome = :nome , email = :email , senha = :senha WHERE id = :id";
       $msgErro = "Erro ao alterar produto!";
       $parametros = [
        "id" => $u->id,
        "nome" => $u->nome , 
        "email" => $u->email , 
        "senha" => $u->senha,
       ];

     $ps =  $this->executar($sql , $msgErro , $parametros);
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