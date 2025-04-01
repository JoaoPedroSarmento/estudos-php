self.onmessage = async function ({
  data: {
    message: {
      metodo,
      urlGestor,
      dadosFetch: { msgErro, msgSucesso, obj, id },
    },
  },
}) {
  const GestorObjeto = await import(urlGestor);
  console.log(GestorObjeto)
  const gestor = new GestorObjeto.default;

  let dados = null;
  switch (metodo) {
    case "GET":
      dados = await gestor.listar(msgErro, msgSucesso, false);
      break;
    case "POST":
      dados = await gestor.inserir(obj, msgErro, msgSucesso);
      break;
    case "PUT":
      dados = await gestor.alterar(obj, msgErro, msgSucesso);
      break;
    case "DELETE":
      dados = await gestor.excluir(id, msgErro, msgSucesso);
      break;
    case "GET/:ID":
      dados = await gestor.buscar(id, msgErro, msgSucesso);
      break;
  }

  self.postMessage({ id, data: dados });

};
