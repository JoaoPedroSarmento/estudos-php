const mensagens = [];

export default function mensagem(msg, classe, excluirMensagem = false) {
  const msgElem = document.getElementById("msg");

  if (!mensagens.length || excluirMensagem) {
    msgElem.textContent = excluirMensagem ? msg.msg : msg;

    msgElem.className = excluirMensagem ? msg.classe : classe;

    if (!excluirMensagem) {
      mensagens.unshift({
        msg,
        classe,
      });
    }

    setTimeout(() => {
      msgElem.textContent = "";
      msgElem.className = "";

      if (mensagens.length) {
        mensagens.shift();

        if (mensagens.length) {
          mensagem(mensagens[0], null, true);
        }
      }
    }, 2000);
  } else {
    mensagens.push({
      msg,
      classe,
    });
  }
}
