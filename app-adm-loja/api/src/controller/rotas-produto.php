<?php 

$produtoRepositorio = new ProdutoRepositorioEmBDR($conexao);

return [
    "/produto" => [
        "GET" => function () use ($produtoRepositorio){
            $produtos = $produtoRepositorio->obterTodos();
            respostaJson(false , "Sucesso ao listar produtos" , 200 , $produtos);
        } ,
        "POST" => function ($dados) use ($produtoRepositorio){
            $produto = new Produto(0, $dados["nome"], $dados["codigo"], $dados["preco"]);
            $id = $produtoRepositorio->inserir($produto);
            respostaJson(false , "Produto inserido com sucesso" , 200, $id);
        },  
        "PUT" => function ($dados) use ($produtoRepositorio){
            $produto = new Produto($dados["id"] , $dados["nome"] , $dados["codigo"], $dados["preco"]);
            $linhasAfetadas = $produtoRepositorio->alterar($produto);
            respostaJson(false , "Produto alterado com sucesso" , 200 , $linhasAfetadas );
        }
    ], 
    "/produto/:id"  => [
        "GET" => function ($dados) use ($produtoRepositorio){
            $id = $dados["id"];
            $produto = $produtoRepositorio->obterPeloId($id);
            respostaJson(false, "" , 200, $produto);
        }
        , "DELETE" => function($dados) use ($produtoRepositorio){
            $id = $dados["id"];
            $idExcluido = $produtoRepositorio->excluirPeloId($id);
            respostaJson(false , "Produto excluido com sucesso" , 200,  $idExcluido);
        }
    ]
]

?>