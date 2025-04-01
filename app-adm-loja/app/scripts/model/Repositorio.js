import { fazFetch } from "../util/fazFetch.js";
import configs from "../configs.js";

export default class Repositorio{
    
    #rota;

   constructor(rota){
    console.log("ROTA" , this.#rota)
        this.#rota = rota;
   }
  
   async obterTodos(cbErro, cbSucesso = null) {
    return await fazFetch("GET", configs.API + this.#rota, cbErro, cbSucesso);
  }


  /** 
   * @param {Produto} produto 
   * @param {Function} cbErro 
   * @param {Function|null} cbSucesso
   */
  async inserir(produto, cbErro, cbSucesso = null) {
    return await fazFetch("POST", configs.API + this.#rota, cbErro, cbSucesso, produto);
  }


  /** 
   * @param {Produto} produto 
   * @param {Function} cbErro 
   * @param {Function|null} cbSucesso
   */
  async alterar( produto, cbErro, cbSucesso = null ) {
    return await fazFetch("PUT", configs.API + this.#rota, cbErro, cbSucesso, produto);
  }


  /**
   * @param { int } id 
   * @param {Function} cbErro 
   * @param {Function|null} cbSucesso
   */
  async excluir( id, cbErro, cbSucesso = null ) {
    console.log(`id a ser excluído ${id}`)
    return await fazFetch("DELETE", configs.API + this.#rota + `/${id}`, cbErro, cbSucesso, [id]);
  }


  /**
   * @param { int } id 
   * @param {Function} cbErro 
   * @param {Function|null} cbSucesso
   */
  async buscar( id, cbErro, cbSucesso = null ) {
    return await fazFetch("GET", configs.API + this.#rota + `/${id}`, cbErro, cbSucesso);
  }

}