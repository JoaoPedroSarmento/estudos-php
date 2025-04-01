import GestorProduto from "./model/produto/GestorProduto.js"
import Produto from "./model/produto/Produto.js";
import GestorWorker from "./model/worker/GestorWorker.js";
import configs from "./configs.js";


(async () => {
  const gestorProduto = new GestorProduto();

 gestorProduto.listar("Erro ao listar produtos"  , "Sucesso ao listar produtos" , true);
})()



