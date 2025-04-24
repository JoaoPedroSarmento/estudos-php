<?php
declare(strict_types=1);

final class GestorRota {
    public string $logica;
    private string $metodo;
    private array $parametros;
    private Requisicao $req;
    public Array $dadosUsuario;
    public bool $rotaEncontrada = false;
    
    public function __construct( Array $server , array &$dadosUsuario){
        $this->req = new Requisicao( $server , $dadosUsuario);
        $this->logica = $this->req->getLogica();
        $this->metodo = $this->req->getMetodo();
        $this->parametros = $this->req->getParametros();
        $this->dadosUsuario = $dadosUsuario;
    }

    public function getMetodo(){
        return $this->metodo;
    }

    public function executarRota(Array $rotas){ 
        $rota =  $rotas[ $this->logica ][ $this->metodo ];
        
               
        $funcao = $rota ? Roteador::fabricaHandler($rota) : null;

        if($funcao){
                try{
                    $this->rotaEncontrada = true;
                    $funcao();
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