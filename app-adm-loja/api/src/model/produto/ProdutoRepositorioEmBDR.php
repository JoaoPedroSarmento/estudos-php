<?php 

declare(strict_types=1);


class ProdutoRepositorioEmBDR {
      
    private Controller $controller;

    public function __construct(PDO $conexao){
        $this->controller = new Controller($conexao);
    }
    

    public function obterTodos ():array {
       $sql = "SELECT * FROM produto";
       
       $ps = $this->controller->executar($sql , "Erro ao listar produtos!");
       return $ps->fetchAll();
    }

    public function inserir(Produto $produto): int{
      $sql = "INSERT INTO produto(nome , preco, codigo) VALUE(':nome' , ':preco' , ':codigo')";
      $ps = $this->controller->executar($sql , "Erro ao inserir produto" , ["nome" => $produto->nome , "preco" => $produto->preco , "codigo" => $produto->codigo]);
      
      return intval($this->controller->getConexao()->lastInsertId());

    }


    public function alterar(Produto $produto){
       $sql = "UPDATE produto SET nome = :nome , preco = :preco , codigo = :codigo WHERE id = :id";
       
    }

}

?> 