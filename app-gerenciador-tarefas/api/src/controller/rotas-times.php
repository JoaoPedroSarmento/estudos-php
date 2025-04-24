<?php

$gestorTimes = new GestorTimes($conexao);
$idTime = $gestorTimes->dadoEstaValido($dados , "idTime", "intval");
$idUsuario = $gestorTimes->dadoEstaValido($dados , "idUsuario", "intval");

$modeloRotas = [
    "/times" => [
        "POST" => Roteador::modelaRequisicao(true , "cadastrar" , $dados , "Time criado com sucesso" , "Erro ao criar time!", $gestorTimes)
    ],
     "/times/:id" => [
        // "POST" => GestorRotas::modelaRequisicao(false , "buscarPorId" , $dados , ""),
     ]
];

return $modeloRotas;
?>

