export default class Modal {
  constructor(idModal , idForm) {
    this.modal = document.getElementById(idModal);
    this.form = document.getElementById(idForm);
  }
  
// modal-backdrop
  ativarFuncoes() {

    const thisGlobal = this;

    this.modal.onclick =  (e) => {
    
    const elem = e.target;
     
    if(elem?.id === "btn-cancelar" || elem?.id === "fechar-modal"){
      thisGlobal.form?.reset();
      thisGlobal.modal.style.display = "none";
     }
   }

   document.getElementById("abrir-modal").onclick  =  (e) => {
    thisGlobal.modal.style.display = "flex";
   };

  //  this.#fecharAoClicarForaDoModal();
  }

  // #fecharAoClicarForaDoModal() {
  //   const thisGlobal = this;

  //   this.modal.("click", function (e)  {
  //     //pegando as posições do modal na tela
  //     const modal = e.currentTarget;
  //     const areaModal = modal.getBoundingClientRect();
  //     if (
  //       (e.clientX < areaModal.left ||
  //         e.clientX > areaModal.right ||
  //         e.clientY < areaModal.top ||
  //         e.clientY > areaModal.bottom) &&
  //       e.target.tagName != "select" &&
  //       e.target.tagName != "option"
  //     ) {
  //       modal.style.display = "none";
  //       thisGlobal.form.reset();
  //     }
  //   });
  // }

  abrirModal(){
    this.modal.style.display = "flex";
  }
  fecharModal(){
    this.form.reset();
    this.modal.style.display = "none";
  }

}
