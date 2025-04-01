<?php 


$gestor = new GestorProduto($conexao);

return [
    "/produto" => [
        "GET" => function () use ($gestor){
            $produtos = $gestor->produtos();
            respostaJson(false , "Sucesso ao listar produtos" , 200 , $produtos);
        } ,
        "POST" => function ($dados) use ($gestor){
            $cadastro = $gestor->cadastrar($dados);
            if($cadastro) respostaJson(false , "Produto inserido com sucesso" , 200);
            respostaJson(true, "Erro ao inserir produto!" , 500);
        },  
        "PUT" => function ($dados) use ($gestor){
            $linhasAfetadas = $gestor->alterar($dados);
            respostaJson(false , "Produto alterado com sucesso" , 200 , $linhasAfetadas );
        }
    ], 
    "/produto/:id"  => [
        "GET" => function ($dados) use ($gestor){
            $id = (int) $dados[0];
            $produto = $gestor->produtoComId($id);     
            respostaJson(false, "Produto encontrado com sucesso" , 200, $produto);
        }
        , "DELETE" => function($dados) use ($gestor){
            $id = $dados["id"] ??  null;
            if(!$id) respostaJson(true , "Erro ao obter ID!" , 400);
            $idExcluido = $gestor->removerComId($id);
            respostaJson(false , "Produto excluido com sucesso" , 200,  $idExcluido);
        }
    ]
]
?>