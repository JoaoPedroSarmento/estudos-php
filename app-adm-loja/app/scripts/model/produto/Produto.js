import Validavel from "../Validavel.js";

export default class Produto extends Validavel{
    /**
     * @type {number}
     */
    id;

    /**
     * @type {string}
     */
    nome;

    /**
     * @type {number}
     */
    preco;

    /**
     * @type {number}
     */
    codigo;

    constructor(nome , preco , codigo , id = 0){
        super();
         this.id = id;
         this.nome = nome;
         this.preco = +preco;
         this.codigo = +codigo;
    }

    /**
     * 
     * @returns {void}
     */
    validar(){
        if(this.nome.length <= 1) this._problemas.push("Nome inválido");
        if(typeof this.preco != "number" ||  this.preco  <= 0) this._problemas.push("Preço inválido");
        if(typeof this.codigo != "number" || this.codigo <= 0) this._problemas.push("Código inválido");
    }

}