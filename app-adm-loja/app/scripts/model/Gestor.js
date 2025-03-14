export default class Gestor {
    #objetoRepositorio;
    fcSucesso;
    fcErro;

    constructor(ObjetoRepositorio , fcErro , fcSucesso){
        this.#objetoRepositorio = new ObjetoRepositorio();
        this.fcErro = fcErro;
        this.fcSucesso = fcSucesso;
    }

    async listar( msgErro , msgSucesso) {
        return await this.#objetoRepositorio.obterTodos( (() => this.fcErro(msgErro)) , ((resp) => this.fcSucesso(msgSucesso , "listar", resp)) );
    }

    async inserir( objeto , msgErro , msgSucesso ) {
        return await this.#objetoRepositorio.inserir( objeto, (() => this.fcErro(msgErro)) , ((resp) => this.fcSucesso(msgSucesso , "inserir" , resp)) );
    }

    async alterar( objeto , msgErro , msgSucesso) {
        return await this.#objetoRepositorio.alterar( objeto, (() => this.fcErro(msgErro)) , ((resp) => this.fcSucesso(msgSucesso, "alterar" , resp)) );
    }

    async excluir( id , msgErro , msgSucesso ) {
        await this.#objetoRepositorio.excluir( id, (() => this.fcErro(msgErro)) , ((resp) => this.fcSucesso(msgSucesso, "excluir" , resp)));
    }

    async buscar( id ,msgErro , msgSucesso ) {
        return await this.#objetoRepositorio.buscar( id ,(() => this.fcErro(msgErro)) , ((resp) => this.fcSucesso(msgSucesso, "buscar" , resp)));
    }
}