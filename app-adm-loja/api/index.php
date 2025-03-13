<?php 

declare(strict_types=1);

require_once __DIR__ . "/src/util/funcoes.php";
require_once __DIR__ . "/vendor/autoload.php";

$dados = json_decode(file_get_contents("php://input") , true) ?? [];


$logica = obterLogica();
$conexao = getConexao();



?> 