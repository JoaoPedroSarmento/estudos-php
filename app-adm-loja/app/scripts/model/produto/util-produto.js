import mensagem from "../../util/mensagem.js";

function fcSucesso(msg, metodo, resp){
    mensagem(msg , "sucesso");

    switch(metodo){
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


function fcErro(msg){
    mensagem(msg , "erro");
}


function listar(resp){
    console.log("resposta: " , resp);
}


function inserir(resp){
    console.log("Produto inserido com sucesso" , resp)
}

function excluir(resp){
    console.log("Produto excluido com sucesso" , resp);
}
export {fcSucesso , fcErro};
