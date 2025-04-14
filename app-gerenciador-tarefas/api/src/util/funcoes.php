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


function respostaJson(bool $erro, string $msg, int $codeStatus , $dados = null){   
       header("Content-type: application/json;charset=utf-8");
       die(json_encode(["erro" => $erro  , "msg" => $msg , "status" => $codeStatus , "dados" => $dados]));
}

function obterLogica(array &$dados):string{
    // url = app-adm-loja/produto (ex: get)
    $url = $_SERVER["REQUEST_URI"];

    // diretorioRaiz = app-adm-loja-produto
    $diretorioRaiz = strtolower(dirname($_SERVER["PHP_SELF"]));

    // rota completa -> tira app-adm-loja de dentro de url, assim, url, fica: /produto
    $rotaCompleta = str_replace($diretorioRaiz , "" , $url);
    // ["/" , "produto"]
    $arrayRota = explode("/" , $rotaCompleta);
    
    $logica = "/$arrayRota[1]";
    // ["/" , "produto" , "/" "1"]
    if(count($arrayRota) > 2){
        for( $i = 2; $i < count( $arrayRota ); $i++ ) {
            if( ! is_numeric( $arrayRota[$i] ) )
                $logica .= "/".$arrayRota[$i];
            else {
                array_push($dados , (int) $arrayRota[$i]);
                $logica .= "/:id";
            }
        }
    }
    return $logica;
}

function dadoEstaValido(array $dados , int|string $param):mixed{
    return (isset($dados[$param]) && !empty($dados[$param])) ? $dados[$param] : null;
}

?>
