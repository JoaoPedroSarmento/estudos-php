"use strict";
import workerRotas from "../../workes/rotas.js";

export default class GestorWorker {
    /**
     * Construtor da classe GestorWorker
     * @param {object} options - Opções de configuração
     * @param {function} options.onMessage - Callback para mensagens do Worker
     * @param {function} options.onError - Callback para erros do Worker
     */
    constructor(options = {}) {
      this.callbacks = new Map();
      this.lastId = 0;
      this.genericCallback = null;
  
      // Configura os handlers (serão aplicados quando worker for criado)
      if (options.onError) {
        this.onError = options.onError;
      }
  
      if (options.onMessage) {
        this.onMessage(options.onMessage);
      }
    }
  
    /**
     * Cria e retorna um Worker para a rota especificada
     * @private
     * @param {string} rota 
     * @returns {Worker}
     */
    #getWorker(rota) {
        console.log('Tentando carregar rota:', rota);
        console.log('Rotas disponíveis:', workerRotas);
        
        if (!workerRotas[rota]) {
          console.error('Rota não encontrada no mapeamento:', Object.keys(workerRotas));
          throw new Error(`Rota de worker não encontrada: ${rota}`);
        }
        
        const worker = new Worker(workerRotas[rota]);
        console.log('Worker criado para rota:', rota);
        return worker;
      }
  
    /**
     * Envia uma mensagem para o Worker da rota especificada
     * @param {any} message - Dados a serem enviados
     * @param {function} [callback] - Callback para a resposta
     * @param {string} workerRota - Rota do worker a ser usado
     * @returns {number} ID da mensagem
     */
    postMessage(message, callback, workerRota) {
      const id = ++this.lastId;
      const messageWithId = { id, data: message };
      const worker = this.#getWorker(workerRota);

      if (callback) {
        this.callbacks.set(id, callback);
      }
      worker.postMessage(messageWithId);
      return id;
    }

    /**
     * Registra um callback genérico para todas as mensagens
     * @param {function} callback - Função a ser chamada quando receber mensagens
     */
    onMessage(callback) {
      this.genericCallback = callback;
    }
  
    /**
     * Manipulador interno de mensagens
     * @private
     */
    _handleMessage(event) {
      const { id, data } = event.data;
  
      if (id && this.callbacks.has(id)) {
        const callback = this.callbacks.get(id);
        callback(data);
        this.callbacks.delete(id);
      }
  
      if (this.genericCallback) {
        this.genericCallback(data, id);
      }
    }
  
    /**
     * Manipulador interno de erros
     * @private
     */
    _handleError(error) {
      console.error('Erro no Worker:', error);
      if (this.onError) {
        this.onError(error);
      }
    }
}