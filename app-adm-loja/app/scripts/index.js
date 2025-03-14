import GestorProduto from "./model/produto/GestorProduto.js"

(async () => {
    
    const gestorProduto = new GestorProduto();

    await gestorProduto.listar("Erro ao listar produtos" , "Sucesso ao listar os produtos");
    

    // const form = document.getElementById("form");

    
})()