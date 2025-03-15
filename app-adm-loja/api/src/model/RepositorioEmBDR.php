<?php

declare(strict_types=1);


// reposiTorioEmBDR tem a funcionaldiade de fazer a conexao com o bancoe reotrnar os dados do banco
// Controller vai chamar o repositorioEMBDR fazer as verificacoes necessarias e retornar para o front-end no formato JSON.
class RepositorioEmBDR {

    public function __construct(private PDO $conexao) {}


    private function executar(string $sql, string $msgErro, array $parametros = []) {
        try {

            $ps = $this->conexao->prepare($sql);
            $ps->execute($parametros);

            return $ps;
        } catch (PDOException $e) {
            respostaJson(true, $msgErro, 500);
        }
    }



    protected function carregarObjetosDaClasse(string $sql, string $classe, array $parametros = [], ?string $msgExcecao = null): array {
        try {
            $ps = $this->conexao->prepare($sql);
            $ps->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $classe);
            $ps->execute($parametros);
            return $ps->fetchAll();
        } catch (PDOException $erro) {
            throw new RuntimeException($msgExcecao ?? $erro->getMessage(), intval($erro->getCode()), $erro);
        }
    }


    protected function primeiroObjetoDaClasse(string $sql, string $classe, array $parametros, ?string $msgExcecao = null): ?object {
        $objetos = $this->carregarObjetosDaClasse($sql, $classe, $parametros, $msgExcecao);
        return (count($objetos) > 0 ? $objetos[0] : null);
    }



    public function get(string $sql, string $msgErro): array {
        $ps = $this->executar($sql, $msgErro);
        return $ps->fetchAll();
    }

    public function post(string $sql, string $msgErro, array $parametros = []): int {

        $this->executar($sql, $msgErro, $parametros);
        return intval($this->conexao->lastInsertId());
    }

    public function put(string $sql, string $msgErro, array $parametros = []): int {
        $ps = $this->executar($sql, $msgErro, $parametros);

        $linhasAlteradas = $ps->rowCount();

        if (!$linhasAlteradas) {
            respostaJson(true, "Erro ao encontrar produto", 500);
        } return $ps->rowCount();
    }


    public function delete(string $sql, string $msgErro, array $parametros = []) {
        $ps = $this->executar($sql, $msgErro, $parametros);
        return intval($ps->rowCount());
    }



    public function buscar(string $sql, string $msgErro, string $classe, array $parametros = []): object {
         return $this->primeiroObjetoDaClasse($sql , $classe , $parametros);
    }


    public function buscarPorId(string $sql, string $msgErro, array $parametros = []) {
        $ps = $this->executar($sql, $msgErro, $parametros);
        return $ps->rowCount() > 0;
    }
}
