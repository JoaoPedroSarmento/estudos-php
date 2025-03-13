<?php 

$produtoRepositorio = new ProdutoRepositorioEmBDR($conexao);
return [
    "/produto" => [
        "GET" => function ($dados) use ($produtoRepositorio){

        } ,
        "POST" => function ($dados) use ($produtoRepositorio){

        },  
        ""
    ]
]

?>