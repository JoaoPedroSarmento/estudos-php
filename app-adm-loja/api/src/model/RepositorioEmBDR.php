<?php 

declare(strict_types=1);


class RepositorioEmBDR {
    
    private Controller $controller;


    public function __construct(PDO $conexao){
        $this->controller = new Controller($conexao);
    }

    public function get(string $sql , string $msgErro):array{
        $ps = $this->controller->executar($sql, $msgErro);
        return $ps->fetchAll();
    }

    public function post( string $sql , string $msgErro, array $parametros = []):int{

        $this->controller->executar($sql , $msgErro, $parametros);  
        return intval($this->controller->getConexao()->lastInsertId());
    }

    public function alterar(string $sql , string $msgErro, array $parametros = []):int{
        $ps = $this->controller->executar($sql , $msgErro , $parametros);
 
        $linhasAlteradas = $ps->rowCount();
    
        if(!$linhasAlteradas){
          respostaJson(true , "Erro ao encontrar produto" , 500);
        } return $ps->rowCount();
}


public function excluirPeloId(string $sql , string $msgErro, array $parametros = []){
    $ps = $this->controller->executar($sql , $msgErro , $parametros);
    return intval($ps->rowCount());
}



public function obterPeloId(string $sql, string $msgErro, string $nomeClasse, array $parametros = []): object {
    $ps = $this->controller->executar($sql, $msgErro, $parametros);
    return $ps->fetch(PDO::FETCH_CLASS, $nomeClasse);
}


public function existeComId(string $sql, string $msgErro, array $parametros = []){
    $ps = $this->controller->executar($sql , $msgErro, $parametros);
    return $ps->rowCount() > 0;
}


}
?>