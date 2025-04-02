import GestorProduto from "./model/produto/GestorProduto.js"
import Produto from "./model/produto/Produto.js";
import GestorWorker from "./model/worker/GestorWorker.js";
import configs from "./configs.js";


(async () => {
  const gestorProduto = new GestorProduto();

 gestorProduto.listar("Erro ao listar produtos"  , "Sucesso ao listar produtos" , true);

//  gestorProduto.buscar(10012 , "Erro ao buscar produto!" , "Sucesso ao buscar produto!" , true);

// for(let i = 0 ; i < 9000; i+=1){
//   const produto = new Produto("Teste" , 200 , 300);
//   gestorProduto.inserir(produto , "Erro ao inserir produto", "Sucesso ao inserir produto");
// }
 
})()



