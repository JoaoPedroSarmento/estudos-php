export default  function mensagem(msg ,classe){
    const msgElem = document.getElementById("msg");

    msgElem.textContent = msg;
    msgElem.className  = classe;
    
    setTimeout(() => {
        msgElem.textContent = "";
        msgElem.className = null;
    }, 5000);
   
}