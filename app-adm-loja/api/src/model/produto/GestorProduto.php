<?php


final class GestorProduto extends Gestor{

    public function __construct(PDO $conexao) {
        parent::__construct($conexao , "ProdutoRepositorioEmBDR");
    }

    public function produtos():array{
        return $this->controller->get(null , "Erro ao listar produtos");
    }
    
    public function produtoComId( $id ): Produto {
        return $this->controller->get( $id, "Erro ao buscar Produto" );
    }


    public function cadastrar(array $dados):bool{
        if(!$this->validarObjeto([$dados["nome"], $dados["codigo"], $dados["preco"]])) respostaJson(true , "Parâmetros inválidos!" , 400);
        $produto = new Produto(0, $dados["nome"], $dados["codigo"], $dados["preco"]);
        return $this->controller->post($produto , "Erro ao inserir produto!");
    }


    public function alterar(array $dados):int{
        if(!$this->validarObjeto([$dados["id"], $dados["nome"], $dados["codigo"], $dados["preco"]])) respostaJson(true , "Parâmetros inválidos!" , 400);
        $produto = new Produto($dados["id"] , $dados["nome"] , $dados["codigo"], $dados["preco"]);
        return $this->controller->put($produto , "Erro ao alterar produto!");
    }

    
    public function removerComId(int $id):int{
        return $this->controller->delete($id , "Erro ao excluir produto!");
    }

}

?>