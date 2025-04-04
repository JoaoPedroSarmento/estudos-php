import ErrorNaoEncontrado from "../../excecoes/ErrorNaoEncontrado.js";
import mensagem from "../../util/mensagem.js";
import Modal from "../Modal.js";
import GestorProduto from "./GestorProduto.js";
import Produto from "./Produto.js";

const funcoesReq = {
  listar,
  inserir,
  excluir,
  alterar
};

const propsPrivadas = {
  id: Symbol("id"),
};

function fcSucesso(msg, metodo, resp) {
  const gestorProduto =   new GestorProduto()
  mensagem(msg, "sucesso");
  const funcao = funcoesReq[metodo];
  if (funcao) {
    funcao(resp, gestorProduto);
  } else {
    throw new ErrorNaoEncontrado("Erro ao encontrar função!");
  }
}

function fcErro(msg) {
  mensagem(msg, "erro");
}

function* geradorLinhas(dados, maxLinhas) {
  let index = 0;
  while (index < dados.length) {
    const limite = Math.min(index + maxLinhas, dados.length);
    const linhas = [];
    
    while (index < limite) {
      linhas.push(dados[index]);
      index++;
    }
    
    yield linhas;
  }
}



function inserir(resp) {}


function excluir(resp, gestorProduto) {
  gestorProduto.listar(
    "Erro ao listar Produtos",
    "Sucesso ao listar produtos!"
  );
}

function alterar(resp){
  mensagem("Produto alterado com sucesso!" , "sucesso");
}

function listar({ dados }, gestorProduto) {
  console.time("carregaTabela");
  const table = document.querySelector("tbody");
  table.innerHTML = "";
  const maxLinhas = 20;
  
  const gerador = geradorLinhas(dados, maxLinhas);
  const obrserver = new IntersectionObserver(([entry]) => {
    if (entry.isIntersecting) {
      obrserver.unobserve(entry.target);
      carregarMaisLinhas();
    }
  });

  
  function carregarMaisLinhas() {
    const { value: lote, done } = gerador.next();
    
    if (!done) {
      const frament = document.createDocumentFragment();
      lote.forEach(produto => frament.appendChild(criarLinha(produto)));
      table.appendChild(frament);

      if (!done) observarUltimaLinha();
    }
  }

  function observarUltimaLinha() {
    const linhas = document.getElementsByClassName("linha-animada");
    const ultimaLinha = linhas[linhas.length - 1];

    if (ultimaLinha) {
      obrserver.observe(ultimaLinha);
    }
  }

  carregarMaisLinhas();
  editarExcluirProduto(gestorProduto);
  console.timeEnd("carregaTabela");
}


function criarLinha(produto) {
  const tr = document.createElement("tr");
  tr.classList.add("linha-animada");

  ["nome", "preco", "codigo", "botao"].map((chave) => {
    const td = document.createElement("td");

    if (chave == "botao") {
      ["EDITAR", "EXCLUIR"].map((texto) => {
        const btn = document.createElement("button");

        btn[propsPrivadas.id] = produto["id"];
        btn.style.margin = "10px";
        btn.textContent = texto;
        td.appendChild(btn);
      });
    } else {
      td.textContent = produto[chave];
    }
    tr.appendChild(td);
  });

  return tr;
}

function editarExcluirProduto(gestorProduto) {
  document.getElementById("tabela-produtos").onclick = (e) => {
    const elem = e.target;
    const id = elem[propsPrivadas.id] ?? null;

    if (elem?.textContent.toLowerCase() == "editar") {
      form(id, gestorProduto);
    } else if (elem?.textContent.toLowerCase() == "excluir") {
      if (confirm(`Deseja excluir o produto de id ${id}?`)) {
        gestorProduto.excluir(
          +id,
          "Erro ao excluir produto!",
          "Sucesso ao excluir produto!"
        );
      }
    }
  };
}

async function form(id , gestorProduto) {

const modal = new Modal("modal-backdrop", "modal-form");
modal.ativarFuncoes();
modal.abrirModal()


const nome = document.getElementById("modal-nome");
const preco = document.getElementById("modal-preco");
const codigo = document.getElementById("modal-codigo");

if(id){
  const {dados: {nome:nomeValor , preco: precoValor, codigo: codigoValor}} = await gestorProduto.buscar(id , "Erro ao buscar produto" , "Sucesso ao buscar produto", false);

  nome.value = nomeValor;
  preco.value = precoValor;
  codigo.value = codigoValor; 
}
  document.getElementById("btn-salvar").onclick = async (e) => {
    e.preventDefault();

  
      if (id) {
        const produto = new Produto(nome.value, +preco.value, +codigo.value, +id);
        const alterar = await gestorProduto.alterar(produto , "Erro ao alterar produto!" , "Sucesso ao alterar produto!", false )

        if(!alterar?.erro){
          modal.fecharModal();
        }else{
          mensagem(produto.getProblemas() , "erro");
        }
      } else {
        const produto = new Produto(nome.value, +preco.value, +codigo.value);
        const inserir =  await gestorProduto.inserir(produto , "Erro ao inserir produto!" , "Sucesso ao inserir produto!")

        if(inserir){
          modal.fecharModal();
        }else{
          mensagem(produto.getProblemas() , "erro");
        }
      
      }


  } ;
}
export { fcSucesso, fcErro };
