<?php

final class GestorProduto{
    private ProdutoRepositorioEmBDR $produtoRepositorio;
    private Controller $controller;

    public function __construct(PDO $conexao) {
        $this->produtoRepositorio = new ProdutoRepositorioEmBDR($conexao);
        $this->controller = new Controller($this->produtoRepositorio);
    }

    public function produtos():array{
        return $this->controller->get(null , "Erro ao listar produtos");
    }
    
    public function produtoComId( $id ): Produto {
        return $this->controller->get( $id, "Erro ao buscar Produto" );
    }


    public function cadastrar(array $dados):bool{
        $produto = new Produto(0, $dados["nome"], $dados["codigo"], $dados["preco"]);
        return $this->controller->post($produto , "Erro ao inserir produto!");
    }

    public function alterar(array $dados):int{
        $produto = new Produto($dados["id"] , $dados["nome"] , $dados["codigo"], $dados["preco"]);
        return $this->controller->put($produto , "Erro ao alterar produto!");
    }

    public function removerComId(int $id):int{
        return $this->controller->delete($id , "Erro ao excluir produto!");
    }

}

?>