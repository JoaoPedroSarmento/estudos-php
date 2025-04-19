<?php 

const OPCOES = [
    // Lança todas as exceções
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // Resultado como matriz associativa
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // Reutiliza a mesma conexão. Emula um Singleton
    PDO::ATTR_PERSISTENT => true
];

function getConexao():PDO{
  
    $dbName = "repositorio_gerencia_tarefas";
    $host = "localhost";

    $dns = "mysql:dbname=$dbName;host=$host;charset=utf8";
    try{
       $pdo = new PDO($dns , "root" , "" , OPCOES);
    }catch(PDOException $e){
    respostaJson(true, "Erro ao realizar conexão! " . $e->getMessage() , 500);
    }

    return $pdo;
}


function respostaJson(bool $erro, string $msg, int $codeStatus , $dados = null):never{   
       header("Content-type: application/json;charset=utf-8");
       die(json_encode(["erro" => $erro  , "msg" => $msg , "status" => $codeStatus , "dados" => $dados]));
}


?>
