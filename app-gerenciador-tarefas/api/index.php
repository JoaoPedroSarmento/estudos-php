<?php 

declare(strict_types=1);
  try{

    require_once __DIR__ . "/src/util/funcoes.php";
    require_once __DIR__ . "/vendor/autoload.php";
        
    $dados = json_decode(file_get_contents('php://input'), true) ?? [];

    $rota = new Rota($_SERVER, obterLogica($dados));
    
    $metodo = $rota->getMetodo();

    if($metodo != "GET"){
        if(empty($dados)){
            throw new DadosNaoEnviadosException("Dados não enviados!" , 500);
        }
    }

    $conexao = getConexao();

    $rota->dados = $dados;

    $rotasArray = require_once "src/rotas.php";

    foreach ($rotasArray as $rotas) {
        if (isset($rotas[$rota->logica])) {
         $rota->executarRota($rotas, $conexao,  $rotas[$rota->logica]["gestor"]); 
      };
    }
    

    if(!$rota->rotaEncontrada) respostaJson(true , "Rota não encontrada!" , 400);

 }catch(DadosNaoEnviadosException $e){
    respostaJson(true, $e->getMessage() , $e->getCode());
 }catch(Exception $e){
    respostaJson(true , $e->getMessage() ,$e->getCode());
 }catch(Throwable  $e){
    respostaJson(true , $e->getMessage() , $e->getCode());
 }


?>
