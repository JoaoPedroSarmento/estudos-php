<?php

declare(strict_types=1);


final class UsuarioTimeRepositorioEmBDR extends RepositorioEmBDR implements RepositorioUsuarioTime
{

    public function inserir(UsuarioTime $uT): int
    {
        /***
         * 
         * 
         * SELECT * FROM usuario_time WHERE time_id = 1;
         * SELECT u.* FROM usuarios u
   JOIN usuario_time ut ON u.id = ut.usuario_id
   WHERE ut.time_id = 1;
         * 
         * 
         * 
         */
        $sql = "INSERT INTO usuario_time (usuario_id, time_id) VALUES (:usuario_id , :time_id) ";
        $msgErro = "Erro ao inserir usuário no time!";
        $parametros = [
            "usuario_id" => $uT->usuario->id,
            "time_id" => $uT->time->id
        ];
        $ps = $this->executar($sql,  $msgErro, $parametros);
        return $ps->rowCount();
    }


    public function alterar(UsuarioTime $uT): bool
    {
        $sql = "UPDATE usuario_time SET papel = :papel WHERE usuario_id = :usuario_id";
        $msgErro = "Erro ao alterar papel do usuário!";
        $parametros = [
            "usuario_id" => $uT->usuario->id,
            "papel" => $uT->papel
        ];

        $ps = $this->executar($sql, $msgErro, $parametros);
        return $ps->rowCount() > 0;
    }

    // array|UsuarioTime
    public function obterPeloId(int $id, bool $buscarLider): array {

        if ($buscarLider) {
            $sql = "SELECT u.*, t.*        
                    FROM usuarios u
                    JOIN usuario_time ut ON u.id = ut.usuario_id
                    JOIN times t ON ut.time_id = t.id   
                    WHERE ut.time_id = :id AND ut.papel = 'lider';";

            $msgErro = "Erro ao procurar o líder do time!";
            $parametros = ["id" => $id];
            // primeiroObjetoDaClasse 
            return $this->carregarObjetosDaClasse($sql, UsuarioTime::class, $msgErro, $parametros);
        }

        $sql = "SELECT  u.*,  t.*        
             FROM usuarios u
             JOIN usuario_time ut ON u.id = ut.usuario_id
             JOIN times t ON ut.time_id = t.id   
             WHERE ut.time_id = :id;";

        $msgErro = "Erro ao procurar times e usuários relacionados aos times!";
        $parametros = [
            "id" => $id
        ];

        /**
         * usuario_id nao vai ser compativel com Usuario $usuario
         * time_id nao vai ser compativel com Time time
         */
        return $this->carregarObjetosDaClasse($sql, UsuarioTime::class, $msgErro, $parametros);
    }

    public function excluirPeloId(?int $idExcluidor, int $idExcluido, int $idTime): bool {
        // Busca o líder do time
        $liderTime = $this->obterPeloId($idTime, true);
        
        // Verifica se encontrou o líder e se o ID do líder corresponde ao idExcluidor
        if (!empty($liderTime) && $liderTime[0]->usuario_id == $idExcluidor) {
            // Lógica para excluir o usuário do time
            $sql = "DELETE FROM usuario_time WHERE usuario_id = :idExcluido AND time_id = :idTime";
            $parametros = [
                "idExcluido" => $idExcluido,
                "idTime" => $idTime
            ];
            
            $this->executar($sql, $parametros);
            return true;
        }
        
        return false;
    }
}
