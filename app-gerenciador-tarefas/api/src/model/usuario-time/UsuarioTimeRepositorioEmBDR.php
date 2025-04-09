<?php 

declare(strict_types=1);


final class UsuarioTime extends RepositorioEmBDR implements RepositorioUsuarioTime{

    public function listarPorId(int $id , string $paramSql):array{
     $sql = "SELECT * FROM $paramSql = :id";
     $msgErro = "Erro ao procurar times!";
     $parametros = [
      "id" => $id 
     ];

  
      // buscar usuarios
      // esta lógica fica no Gestor
      // $objetosComUsuarios = [];
      // $objetos =   $this->carregarObjetosDaClasse($sql , UsuarioTime::class , $msgErro , $parametros);
      // $repositorioUsuario = new Repos
      // foreach($objetos as $obj){
      //     $u = 
      // }

     return $this->carregarObjetosDaClasse($sql , UsuarioTime::class , $msgErro , $parametros);
    }


}



?> 