<?php
declare(strict_types=1);

final class Rota {
    private string $logica;
    private string $metodo;
    private array $parametros;
    private Requisicao $req;
    public Array $dados;
    public bool $rotaEncontrada = false;
    
    public function __construct( Array $server){
        $this->req = new Requisicao( $server );
        $this->logica = $this->req->getLogica();
        $this->metodo = $this->req->getMetodo();
        $this->parametros = $this->req->getParametros();
    }

    public function getMetodo(){
        return $this->metodo;
    }

    public function executarRota( Array $rotas , PDO $conexao , string $gestor){ 
        $rota =  $rotas[ $this->logica ][ $this->metodo ];
        $this->rotaEncontrada = true;
    
        // constroi a rota dinamicamente
        
       $funcao =  GestorRotas::criaFuncaoDaRota($rota , $gestor , $conexao);

        if($funcao){
                try{
                    if( ! empty( $this->dados ) ) $funcao( $this->dados );
                    else if ( ! empty( $this->parametros ) ) $funcao( $this->parametros );
                    else $funcao();
                }
                catch (RuntimeException $e) {
                    respostaJson( true, $e->getMessage(), 400 );
                }
                catch (Exception $e) {
                    respostaJson( true, $e->getMessage(), 500 );
                }
        }else{
                respostaJson( true , "Rota inexistente." , 404 );
        }
    }
}

?>