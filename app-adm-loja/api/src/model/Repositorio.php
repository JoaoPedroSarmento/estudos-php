<?php 

declare(strict_types=1);
interface Repositorio{
    /**
     * 
     * 
     */

     public function obterTodos():array;

/**
 * 
 * @param object $objeto
 */
      public function inserir(object $objeto):int;

      /**
       * 
       * 
       */

       public function alterar(Object $objeto):bool;

       /**
        * 

        */

        public function excluirPeloId(int $id):bool;

        /**
         * 
         * 
         */

         public function obterPeloId(int $id):object;

         /**
          * 

          */

          public function existeComId(int $id):bool;
}

?>