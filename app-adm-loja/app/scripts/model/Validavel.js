
"use strict";
import ErrorClasseAbstrata from "../excecoes/ErrorClasseAbstrata.js";

export default class Validavel{
    
    /**
     * 
     * @type {array<string>}
     */
    _problemas = [];


    constructor(){
        throw new ErrorClasseAbstrata("A classe Validavel é uma classe Abstrata e não pode ser instânciada");
    }

    validar(){
      throw new ErrorClasseAbstrata("É necessário implementar um método de uma classe abstrata");    
    }   
 
    getProblemas(){
        return this._problemas;
    }

}