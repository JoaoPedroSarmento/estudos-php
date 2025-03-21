import mensagem from "../../util/mensagem.js";


const funcoesReq = {
  listar,
  inserir,
  excluir,
};


function fcSucesso(msg, metodo, resp) {
  mensagem(msg, "sucesso");
  funcoesReq[metodo](resp);
}


function fcErro(msg) {
  mensagem(msg, "erro");
}


function listar({ dados }) {
  const table = document.querySelector("#tabela-produtos")
  const tabelaBody = table.querySelector("tbody");
  const fragment =  document.createDocumentFragment();

  table.style.display = "none ";
  tabelaBody.innerHTML = ""; 

  dados.forEach(({id , nome , preco , codigo}) => {
      const row = document.createElement("tr");
      row.innerHTML = `
          <td>${id}</td>
          <td>${nome}</td>
          <td>R$ ${preco.toFixed(2)}</td>
          <td>${codigo}</td>
      `;
      fragment.appendChild(row);
  });
  
  tabelaBody.appendChild(fragment);
  table.style.display = "table";
}


function inserir(resp) {
  console.log("Produto inserido com sucesso", resp);
}


function excluir(resp) {
  console.log("Produto excluido com sucesso", resp);
}


export { fcSucesso, fcErro };
