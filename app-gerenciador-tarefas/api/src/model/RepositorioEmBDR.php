<?php 


declare(strict_types=1);



abstract class RepositorioEmBDR {
    
    private PDO $conexao;

    public function __construct(PDO $conexao){
        $this->conexao = $conexao;
    }

    
    protected function carregarObjetosDaClasse( string $sql, string $classe, ?string $msgErro = null  , array $parametros = []):array {

        try {
            $ps = $this->conexao->prepare( $sql );
            $ps->setFetchMode( PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $classe );
            $ps->execute( $parametros );
            return $ps->fetchAll();
        }
        catch ( PDOException $erro ) {
            throw new RuntimeException( $msgErro ?? $erro->getMessage(), 500, $erro );
        }
    }
    

    protected function primeiroObjetoDaClasse( string $sql, string $classe, array $parametros, ?string $msgErro = null ): ?object {
        $objetos = $this->carregarObjetosDaClasse( $sql, $classe, $msgErro , $parametros);

        return ( count( $objetos ) > 0 ? $objetos[ 0 ] : null );
    }


    protected function removerRegistroComId(int $id, string $tabela, ?string $msgErro = null ): bool {
        try {
            $ps = $this->conexao->prepare( "DELETE FROM $tabela WHERE id = :id" );
            $ps->execute( [ 'id' => $id ] );
            return $ps->rowCount() > 0;
        }
        catch ( PDOException $erro ) {
            throw new RuntimeException( $msgErro ?? $erro->getMessage(), 500, $erro );
        }
    }

  
protected function executar($sql , $msgErro ,$parametros = []):array{
    try{
        $ps = $this->conexao->prepare($sql);
        $ps->execute($parametros);
        return ["ps" => $ps ,  "conexao" => $this->conexao];

    }catch(PDOException $e){
        if($e->getCode() == "23000") respostaJson(true, $msgErro , 500);
        respostaJson(true , $msgErro  .  $e->getMessage(), 500);
    }
}

}
?>