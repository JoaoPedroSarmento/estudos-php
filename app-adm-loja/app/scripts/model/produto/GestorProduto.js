import Gestor from "../Gestor.js";
import ProdutoRepositorio from "./ProdutoRepositorio.js";
import { fcErro, fcSucesso } from "./util-produto.js";

export default class GestorProduto extends Gestor{
       constructor(){
        super(ProdutoRepositorio , fcErro , fcSucesso);
       }
}