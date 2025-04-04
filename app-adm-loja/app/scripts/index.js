import GestorProduto from "./model/produto/GestorProduto.js"
import Produto from "./model/produto/Produto.js";
import GestorWorker from "./model/worker/GestorWorker.js";
import configs from "./configs.js";
import Modal from "./model/Modal.js";


(async () => {

const gestorProduto = new GestorProduto();
const modal = new Modal("modal-backdrop" , "modal-form");

modal.ativarFuncoes();

gestorProduto.listar("Erro ao listar produtos"  , "Sucesso ao listar produtos" , true);

//  gestorProduto.buscar(10012 , "Erro ao buscar produto!" , "Sucesso ao buscar produto!" , true);


})()





