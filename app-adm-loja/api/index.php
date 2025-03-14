<?php 

declare(strict_types=1);


require_once __DIR__ . "/src/util/funcoes.php";
require_once __DIR__ . "/vendor/autoload.php";


$dados = json_decode(file_get_contents("php://input") , true) ?? [];


$logica = obterLogica();
$conexao = getConexao();

$rota = new Rota($_SERVER , $dados);

$rotasArray = require_once "src/rotas.php";

foreach($rotasArray as $rotas){
    if(isset($rotas[$logica])) $rota->executarRota($rotas);
}


?> 