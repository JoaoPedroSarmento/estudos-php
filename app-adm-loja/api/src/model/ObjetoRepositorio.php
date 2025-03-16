<?php 

declare(strict_types=1);
interface ObjetoRepositorio{
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

       public function alterar(Object $objeto):int;

       /**
        * 

        */

        public function excluirPeloId(int $id):int;

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