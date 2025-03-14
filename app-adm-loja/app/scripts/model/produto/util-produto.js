import mensagem from "../../util/mensagem.js";

function fcSucesso(msg, metodo, resp){
    mensagem(msg , "sucesso");
    switch(metodo){
        case "listar": 
         listar(resp);
        break;
    }
}


function fcErro(msg){
    mensagem(msg , "erro");
}


function listar(resp){
    console.log("resposta: " , resp);
}

export {fcSucesso , fcErro};