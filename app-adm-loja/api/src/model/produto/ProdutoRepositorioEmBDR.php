<?php 

declare(strict_types=1);


class ProdutoRepositorioEmBDR  implements Repositorio{
      
  private RepositorioEmBDR $repositorioEmBDR;

    public function __construct(PDO $conexao){
        $this->repositorioEmBDR = new RepositorioEmBDR($conexao);
    }
    

    public function obterTodos ():array {
       $sql = "SELECT * FROM produto";
       $msgErro = "Erro ao listar produtos!";
       return $this->repositorioEmBDR->get($sql , $msgErro);
    }

    public function inserir(object $produto): int{

      $sql = "INSERT INTO produto(nome , preco, codigo) VALUE(':nome' , ':preco' , ':codigo')";
      $msgErro = "Erro ao inserir produto";
      $parametros = [
        "nome" => $produto->nome , 
        "preco" => $produto->preco , 
        "codigo" => $produto->codigo
      ];

      return $this->repositorioEmBDR->post($sql , $msgErro , $parametros);
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

     return $this->repositorioEmBDR->post($sql , $msgErro , $parametros);
}

public function excluirPeloId(int $id):int{
  $sql = "DELETE FROM produto WHERE id = :id";
  $msgErro = "Erro ao excluir produto";
  $parametros =  [
    "id" => $id
  ];

   return $this->repositorioEmBDR->excluirPeloId($sql ,$msgErro , $parametros);

}


public function obterPeloId(int $id):Produto{
  $sql = "SELECT * FROM produto WHERE id = :id";
  $msgErro = "Erro ao obter produto pelo id";
  $parametros = [
    "id" => $id
  ];
  return $this->repositorioEmBDR->obterPeloId($sql , $msgErro , "Produto" , $parametros);
}


public function existeComId(int $id):bool{
  $sql = "SELECT * FROM produto WHERE id = :id";  
  $msgErro = "Erro ao encontrar um produto";
  $parametros = [
    "id" => $id
  ];
  return $this->repositorioEmBDR->existeComId($sql , $msgErro , $parametros);
}



}




?> 