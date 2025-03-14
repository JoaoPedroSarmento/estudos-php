import Repositorio from "../Repositorio.js";

export default class ProdutoRepositorio extends Repositorio {
    constructor(){
        super("/produto");
    }
}