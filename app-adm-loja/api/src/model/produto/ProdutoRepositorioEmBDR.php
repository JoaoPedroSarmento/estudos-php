<?php 

declare(strict_types=1);


final class ProdutoRepositorioEmBDR extends RepositorioEmBDR implements Repositorio{
      
    public function obterTodos ():array {
       $sql = "SELECT * FROM produto";
       $msgErro = "Erro ao listar produtos!";
       return $this->carregarObjetosDaClasse($sql , Produto::class, $msgErro);
    }

    public function inserir(object $produto): int{

      $sql = "INSERT INTO produto(nome , preco, codigo) VALUE(:nome , :preco , :codigo)";
      $msgErro = "Erro ao inserir produto";
      $parametros = [
        "nome" => $produto->nome , 
        "preco" => $produto->preco , 
        "codigo" => $produto->codigo
      ];

      $this->executar($sql , $msgErro , $parametros);

      return 1;
    }


    public function alterar(object $produto):bool {
       $sql = "UPDATE produto SET nome = :nome , preco = :preco , codigo = :codigo WHERE id = :id";
       $msgErro = "Erro ao alterar produto";
       $parametros = [
        "id" => $produto->id,
        "nome" => $produto->nome , 
        "preco" => $produto->preco , 
        "codigo" => $produto->codigo,
       ];

     $ps =  $this->executar($sql , $msgErro , $parametros);
     return $ps->rowCount() > 0;
}

public function excluirPeloId(int $id):bool{
  $sql = "DELETE FROM produto WHERE id = :id";
  $msgErro = "Erro ao excluir produto";
  $parametros =  [
    "id" => $id
  ];

   return $this->removerRegistroComId($id , Produto::class,$msgErro);

}


public function obterPeloId(int $id):object{
  $sql = "SELECT * FROM produto WHERE id = :id";
  $msgErro = "Erro ao obter produto pelo id";
  $parametros = [
    "id" => $id
  ];
  return $this->primeiroObjetoDaClasse($sql , Produto::class, $parametros , $msgErro);
}


public function existeComId(int $id):bool{
  $sql = "SELECT * FROM produto WHERE id = :id";  
  $msgErro = "Erro ao encontrar um produto";
  $parametros = [
    "id" => $id
  ];
  $produto =  $this->primeiroObjetoDaClasse($sql ,  Produto::class ,  $parametros, $msgErro);
  
  return $produto !== null;
  
}

}




?> 