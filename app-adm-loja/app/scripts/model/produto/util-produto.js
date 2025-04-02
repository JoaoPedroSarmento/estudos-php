import mensagem from "../../util/mensagem.js";

function fcSucesso(msg, metodo, resp) {
  mensagem(msg, "sucesso");

  switch (metodo) {
    case "listar":
      listar(resp);
      break;

    case "inserir":
      inserir(resp);
      break;

    case "excluir":
      excluir(resp);
      break;
  }
}

function fcErro(msg) {
  mensagem(msg, "erro");
}

// usar IntersectionObserver para carregar uma lista muito grande 

 function listar({dados}) {
    console.time("carregaTabela")
    const table = document.querySelector("tbody");
    const linhas = document.createDocumentFragment();

    // const dados = Array(20000).fill().map((_, i) => ({ id: i, nome: `Item ${i}` , preco: 200 , codigo: 200}));
    
    dados.forEach((dado) => {
        linhas.appendChild(criarLinha(dado));
        // table.appendChild(criarLinha(dado))
    })

    table.appendChild(linhas)
    
    console.timeEnd("carregaTabela")
}

function inserir(resp) {
  console.log("Produto inserido com sucesso", resp);
}

function excluir(resp) {
  console.log("Produto excluido com sucesso", resp);
}

function criarLinha({nome, preco , codigo}) {

  const tr = document.createElement("tr");

  const [tdNome, tdPreco, tdcodigo] = [
    { elem: "td", valor: nome },
    { elem: "td", valor: preco },
    { elem: "td", valor: codigo },
  ].map(({elem , valor}) => {
    const td = document.createElement(elem);
    td.textContent = valor;
    return td;
  });
  
  tr.append(tdNome , tdPreco ,  tdcodigo);

  return tr;
}

export { fcSucesso, fcErro };
