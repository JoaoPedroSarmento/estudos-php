<?php 
declare(strict_types=1);

class Controller {   
    
    private PDO $conexao;


    public function __construct(PDO $conexao) {
       $this->conexao = $conexao;
    }


    public function executar($sql , $msgErro ,$parametros = []):PDOStatement{
         try{
             
             $ps = $this->conexao->prepare($sql);
             $ps->execute($parametros);
             
             return $ps;

         }catch(PDOException $e){
              respostaJson(true , $msgErro , 500);
         }
    
}

  public function getConexao():PDO{
    return $this->conexao;
  }

}

?>