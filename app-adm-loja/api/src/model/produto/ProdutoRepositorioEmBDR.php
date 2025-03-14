<?php 

declare(strict_types=1);


class ProdutoRepositorioEmBDR extends RepositorioEmBDR implements Repositorio{
      
    public function obterTodos ():array {
       $sql = "SELECT * FROM produto";
       $msgErro = "Erro ao listar produtos!";
       return $this->get($sql , $msgErro);
    }

    public function inserir(object $produto): int{

      $sql = "INSERT INTO produto(nome , preco, codigo) VALUE(':nome' , ':preco' , ':codigo')";
      $msgErro = "Erro ao inserir produto";
      $parametros = [
        "nome" => $produto->nome , 
        "preco" => $produto->preco , 
        "codigo" => $produto->codigo
      ];

      return $this->post($sql , $msgErro ,  $produto, $parametros);
    }


    public function alterar(object $produto):int {
       $sql = "UPDATE produto SET nome = :nome , preco = :preco , codigo = :codigo WHERE id = :id";
       $msgErro = "Erro ao alterar produto";
       $parametros = [
        "id" => $produto->id,
        "nome" => $produto->nome , 
        "preco" => $produto->preco , 
        "codigo" => $produto->codigo,
       ];

     return $this->put($sql , $msgErro , $produto , $parametros);
}

public function excluirPeloId(int $id):int{
  $sql = "DELETE FROM produto WHERE id = :id";
  $msgErro = "Erro ao excluir produto";
  $parametros =  [
    "id" => $id
  ];

   return $this->delete($sql ,$msgErro , $parametros);

}


public function obterPeloId(int $id):object{
  $sql = "SELECT * FROM produto WHERE id = :id";
  $msgErro = "Erro ao obter produto pelo id";
  $parametros = [
    "id" => $id
  ];
  return $this->buscar($sql , $msgErro , "Produto" , $parametros);
}


public function existeComId(int $id):bool{
  $sql = "SELECT * FROM produto WHERE id = :id";  
  $msgErro = "Erro ao encontrar um produto";
  $parametros = [
    "id" => $id
  ];
  return $this->existe($sql , $msgErro , $parametros);
}

}




?> 