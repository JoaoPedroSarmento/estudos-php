"use strict";
import getRota from "../../workes/rota.js";

export default class GestorWorker {
    constructor(options = {}) {
        this.callbacks = new Map();
        this.lastId = 0;
        this.genericCallback = null;
        this.workers = new Map(); // Armazena workers por rota

        if (options.onError) {
            this.onError = options.onError;
        }

        if (options.onMessage) {
            this.onMessage(options.onMessage);
        }
    }

    #getWorker(rota) {
        // Reutiliza worker se já existir para esta rota
        if (!this.workers.has(rota)) {
            const rotaWorker = getRota(rota);
            const worker = new Worker(rotaWorker);
            
            // Configura os handlers
            worker.onmessage = (event) => this._handleMessage(event);
            worker.onerror = (error) => this._handleError(error);
            
            this.workers.set(rota, worker);
        }
        
        return this.workers.get(rota);
    }

    postMessage(message, workerRota, callback = null) {
        const id = ++this.lastId;
        const messageWithId = { id, message };
        const worker = this.#getWorker(workerRota);

        if (callback) {
            this.callbacks.set(id, callback);
        }
        
        worker.postMessage(messageWithId);
        return id;
    }

    onMessage(callback) {
        this.genericCallback = callback;
    }

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

    _handleError(error) {
        console.error('Erro no Worker:', error);
        if (this.onError) {
            this.onError(error);
        }
    }

    // Método para encerrar workers
    terminate(rota = null) {
        if (rota) {
            const worker = this.workers.get(rota);
            if (worker) {
                worker.terminate();
                this.workers.delete(rota);
            }
        } else {
            this.workers.forEach(worker => worker.terminate());
            this.workers.clear();
        }
    }
}