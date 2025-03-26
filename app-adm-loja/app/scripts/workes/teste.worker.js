self.onmessage = function(e) {
    console.log('[Worker] Mensagem recebida:', e);
    
    try {
      // Recebe no formato { id, data } do GestorWorker
      const { id, data } = e.data;
      
      if (!Array.isArray(data)) {
        throw new Error('Dados devem ser um array');
      }
      
      // Processa os dados
      const resultado = data.map(valor => valor * 2);
      console.log('[Worker] Resultado processado:', resultado);
      
      // Retorna no mesmo formato { id, resultado }
      self.postMessage({ id, data: resultado });
      
    } catch (error) {
      console.error('[Worker] Erro:', error);
      self.postMessage({ 
        error: true,
        message: error.message,
        id: e.data?.id // Mantém o ID se existir
      });
    }
  };
  
  function processarDados(dados) {
    return dados.map(valor => valor * 2);
  }