import GestorProduto from "./model/produto/GestorProduto.js"
import Produto from "./model/produto/Produto.js";

(async () => {
    
    const gestorProduto = new GestorProduto();

    await gestorProduto.listar("Erro ao listar produtos" , "Sucesso ao listar os produtos");
    const produto1 = new Produto("Teste 1" , 200, 1)
    console.log(produto1);
    // await gestorProduto.inserir(produto1 , "Erro ao inserir produto" , "Produto inserido com sucesso");
    
    gestorProduto.excluir(10000 , "Erro ao excluir produto" , "Sucesso ao excluir produto")
    // const form = document.getElementById("form");

    
})()