<?php 

declare(strict_types=1);


final class TimesRepositorioEmBDR extends RepositorioEmBDR implements RepositorioTimes{
      

    public function inserir(Time $t , UsuarioTime $uT): int{

    
      $sql = "INSERT INTO times(nome , email, senha) VALUE(:nome , :descricao , :criado_em)";
      $msgErro = "Erro ao inserir produto!";
      $parametros = [
        "nome" => $t->nome , 
        "descricao" => $t->descricao, 
        "criado_em" => $t->criado_em
      ];

      $this->executar($sql , $msgErro , $parametros);

      return 1;
    }


    public function alterar(Time $t , UsuarioTime $uT):bool {
       $sql = "UPDATE usuarios SET nome = :nome , descricao = :criado_em WHERE id = :id";
       $msgErro = "Erro ao alterar Time. Você não tem permissão para alterar um time!";
       $parametros = [
        "id" => $t->id,
        "nome" => $t->nome , 
        "descricao" => $t->descricao , 
        "criado_em" => $t->criado_em,
       ];

       // verificar se o usuário é um líder!
     $ps =  $this->executar($sql , $msgErro , $parametros);
     return $ps->rowCount() > 0;
}

public function excluirPeloId(int $id , UsuarioTime $uT):bool{

  $msgErro = "Erro ao excluir Time!";

  return $this->removerRegistroComId($id , Usuario::class,$msgErro);

}


public function obterPeloId(int $id):?Time{
  $sql = "SELECT * FROM times WHERE id = :id";
  $msgErro = "Erro ao buscar Time!";
  $parametros = [
    "id" => $id,
  ];
  
 $usuario =  $this->primeiroObjetoDaClasse($sql , Usuario::class, $parametros , $msgErro);
  
 return $usuario;
}


public function existeComId(int $id):bool{
  $sql = "SELECT * FROM times WHERE id = :id";  
  $msgErro = "Erro ao encontrar time!";
  $parametros = [
    "id" => $id
  ];
  $produto =  $this->primeiroObjetoDaClasse($sql ,  Time::class ,  $parametros, $msgErro);
  
  return $produto !== null;
  
}

}

?> 