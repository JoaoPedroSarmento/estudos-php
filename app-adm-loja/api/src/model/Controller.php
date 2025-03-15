<?php 
declare(strict_types=1);

class Controller {   
  
    public function __construct(private object $repositorioEmBDR){}
     
    
    private function validarObjeto(object $objeto){
      $objeto->validar();
      return empty($objeto->getProblemas());
    }

    public function get(?int $id = null):void{
       if($id){
         $dado = $this->repositorioEmBDR->obterPeloId($id);
         respostaJson(false , "Dado obtido com sucesso!" , 200  , $dado);
       } 
       $dados = $this->repositorioEmBDR->obterTodos();

       respostaJson(false , "Dados obtidos com sucesso!" , 200 ,$dados);
    }

   public function post(object $objeto):void{
      if(!$this->validarObjeto($objeto)){
        respostaJson(true , "Erro ao inserir dados" , 500);
      }

      $ultimoId = $this->repositorioEmBDR->inserir($objeto);
      respostaJson(false, "Dado inserido com sucesso" , 200 , $ultimoId);
   }


   public function put( object $object ): void {
    if(!$this->validarObjeto($object))
        respostaJson( false, "Erro ao efetuar alteração - DADOS INVÁLIDOS", 500, $object->getProblemas());
    $this->repositorioEmBDR->alterar( $object );
    respostaJson( false, "Alteração efetuada com sucesso!", 200 );
}


public function delete( int $id ): void {
    if( ! $this->repositorioEmBDR->existeComId( $id ) )
        respostaJson( true, "Informações não encontradas!", 400 );
    $this->repositorioEmBDR->excluirPeloId( $id );
    respostaJson( false, "Exclusão efetuada com sucesso!", 204 );
}

}


?>