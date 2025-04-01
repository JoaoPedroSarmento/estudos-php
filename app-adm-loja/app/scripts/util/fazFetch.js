import mensagem from "./mensagem.js";

function fazFetch(metodo, url, cbErro = null, cbSucesso = null, dados = null) {
  let configMetodo = trataMetodo(metodo, dados);
   
  const meuFetch = fetch(url, configMetodo)
    .then((resposta) => verificaErro(resposta))
    .then(async (resposta) => {
    const resp = await resposta.json();

      if (resp.erro && cbErro) cbErro(resp);
      else if (cbSucesso) cbSucesso(resp);
      return resp;
    })
    .catch((erro) => {
      mensagem(erro, "erro");
    });
  return meuFetch;
}

function verificaErro(resposta) {
  if (!resposta.ok)
    throw new Error(resposta.status + " - " + resposta.statusText);

  return resposta;
}

function trataMetodo(metodo, dados) {
  let configMetodo = null;

  if (metodo !== "GET") {
    configMetodo = {
      method: metodo,
      body: JSON.stringify(dados),
      headers: {
        "Content-Type": "application/json;charset=UTF-8",
      },
    };
  }

  return configMetodo;
}

export { fazFetch };
