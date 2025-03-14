<?php 

declare(strict_types=1);


class RepositorioEmBDR {
    
    private Controller $controller;
    private PDO $conexao;

    public function __construct(PDO $conexao){
        $this->controller = new Controller($conexao);
        $this->conexao = $conexao;
    }


    private function carregarObjetosDaClasse(string $sql , string $msgErro, $classe , array $parametros = []):array{
        try{
         $ps =  $this->conexao->prepare($sql);
         $ps->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE , $classe);
         
         $ps->execute($parametros);
         return $ps->fetchAll();   

        }catch(PDOException $e){
            throw new RepositorioException($msgErro);
        }
    }
    
    private function  carregaPrimeiroObjetoDaClasse(string $sql , string $msgErro , $classe , array $parametros = []):object{ 
        return $this->carregarObjetosDaClasse($sql ,$msgErro , $classe , $parametros)[0];
    }


    public function get(string $sql , string $msgErro):array{
        $ps = $this->controller->executar($sql, $msgErro);
        return $ps->fetchAll();
    }


    public function post( string $sql , string $msgErro, object $objeto ,array $parametros = []):int{   
        $objeto->validar();

        if(count($objeto->getProblemas()) > 0) {
           throw new RepositorioException($objeto->getProblemas());
        }
        
        $this->controller->executar($sql , $msgErro, $parametros);  
        return intval($this->conexao->lastInsertId());
    }


    public function put(string $sql , string $msgErro, object $objeto , array $parametros = []):int{
        $objeto->validar();

        if(count($objeto->getProblemas()) > 0) {
           throw new RepositorioException($objeto->getProblemas());
        }


        $ps = $this->controller->executar($sql , $msgErro , $parametros);
 
        $linhasAlteradas = $ps->rowCount();
    
        if(!$linhasAlteradas){
          respostaJson(true , "Erro ao encontrar produto" , 500);
        } return $ps->rowCount();
}


public function delete(string $sql , string $msgErro, array $parametros = []){
    $ps = $this->controller->executar($sql , $msgErro , $parametros);
    return intval($ps->rowCount());
}



public function buscar(string $sql, string $msgErro, string $classe, array $parametros = []):object {
    return $this->carregaPrimeiroObjetoDaClasse($sql , $msgErro , $classe , $parametros);
}


public function existe(string $sql, string $msgErro, array $parametros = []){
    $ps = $this->controller->executar($sql , $msgErro, $parametros);
    return $ps->rowCount() > 0;
}


}
?>