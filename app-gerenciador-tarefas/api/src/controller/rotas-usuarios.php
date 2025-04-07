<?php 



$gestor = new GestorUsuarios($conexao);

return [
    "/usuarios" => [
        "POST" => function ($dados) use ($gestor){
            $cadastro = $gestor->cadastrar($dados);
            if($cadastro) respostaJson(false , "Perfil criado com sucesso" , 200);
            respostaJson(true, "Erro ao criar perfil!" , 500);
        },  
    ], 
    "/usuarios/:id"  => [
        "GET" => function ($dados) use ($gestor){
            
            $id = (int) $dados[0] ?? null;
            $senha = (string) $dados["senha"];
            
            if(!$senha) respostaJson(true, "Insira a senha!" , 400);

            if(!$id) respostaJson(true , "Erro ao buscar ID!" , 400);
            $usuario = $gestor->usuarioComId($id , $senha);     
            if($usuario) respostaJson(false, "Perfil encontrado com sucesso" , 200, $usuario);
            else respostaJson(false, "Senha incorreta" , 404);
        }
        , "DELETE" => function($dados) use ($gestor){
            $id = $dados[0] ??  null;
            $senha = (string) $dados["senha"];
            if(!$id) respostaJson(true , "Erro ao obter ID!" , 400);
            $idExcluido = $gestor->removerComId($id , $senha);
            if($idExcluido) respostaJson(false, "Perfil excluído com sucesso" , 200, $idExcluido);
            else respostaJson(false, "Senha incorreta" , 400);
        },
        "PUT" => function ($dados) use ($gestor){
            $linhasAfetadas = $gestor->alterar($dados);
            if($linhasAfetadas) respostaJson(false , "Perfil alterado com sucesso" , 200 , $linhasAfetadas );
            respostaJson(true , "Senha incorreta!" , 400);
        }
    ]
]
?>