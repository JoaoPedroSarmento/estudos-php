export default class Produto{
    /**
     * @type {Array<string>}
     */
    #problemas = [];
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
        if(nome.length <= 1) this.#problemas.push("Nome inválido");
        if(typeof this.preco != "number" ||  this.preco  <= 0) this.#problemas.push("Preço inválido");
        if(typeof this.codigo != "number" || this.codigo <= 0) this.#problemas.push("Código inválido");
    }
    
    /**
     * @returns {Array<string>}
     */
    getProblemas(){
        return this.#problemas;     
    }

}