<?php 

$produtoRepositorio = new ProdutoRepositorioEmBDR($conexao);
$controller = new Controller($produtoRepositorio);
return [
    "/produto" => [
        "GET" => function () use ($controller ){
            // global $controller;
            $controller->get();
        } ,
        "POST" => function ($dados) use ($controller){
            // global $controller;
            $produto = new Produto(0, $dados["nome"], $dados["codigo"], $dados["preco"]);
            $controller->post($produto);
        },  
        "PUT" => function ($dados) use ($controller){
            // global $controller;
            $produto = new Produto($dados["id"] , $dados["nome"] , $dados["codigo"], $dados["preco"]);
            
            $controller->put($produto);
        }
    ], 
    "/produto/:id"  => [
        "GET" => function ($dados) use ($controller){
         // global $controller;
         // $controller->get($dados[0]);
         $controller->get($dados[0]);
        }
        , "DELETE" => function($dados) use ($controller){
            $controller->delete($dados[0]);
        }
    ]
]

?>