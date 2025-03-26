import GestorProduto from "./model/produto/GestorProduto.js"
import Produto from "./model/produto/Produto.js";
import GestorWorker from "./model/worker/GestorWorker.js";
(async () => {
    
    // const gestorProduto = new GestorProduto();

    // await gestorProduto.listar("Erro ao listar produtos" , "Sucesso ao listar os produtos");
    // const produto1 = new Produto("Teste 1" , 200, 1)
    // console.log(produto1);
    // // await gestorProduto.inserir(produto1 , "Erro ao inserir produto" , "Produto inserido com sucesso");
    
    // gestorProduto.excluir(10000 , "Erro ao excluir produto" , "Sucesso ao excluir produto")
    // // const form = document.getElementById("form");
 

    // 1. Crie uma instância do GestorWorker
    const gestor = new GestorWorker({
      onMessage: (data) => {
        console.log('Mensagem genérica recebida:', data);
      },
      onError: (error) => {
        console.error('Erro capturado:', error);
      }
    });
    
    // 2. Gerar um array com 300+ números aleatórios
    function gerarDadosMassivos(quantidade = 300) {
      return Array.from({ length: quantidade }, () => 
        Math.floor(Math.random() * 100) + 1  // Números entre 1 e 100
      );
    }
    
    const dadosParaProcessar = gerarDadosMassivos(10500000);
    console.log('Dados enviados para processamento:', dadosParaProcessar.length);
    
    // 3. Medir o tempo de processamento
    console.time('Tempo de processamento');
    
    // 4. Enviar dados para processamento
    gestor.postMessage(
      dadosParaProcessar,
      (resultado) => {
        console.timeEnd('Tempo de processamento');
        console.log('Resultado do processamento (primeiros 10 itens):', resultado.slice(0, 10));
        console.log('Total de itens processados:', resultado.length);
        
        // Verificação de integridade
        const todosProcessados = resultado.every((val, idx) => val === dadosParaProcessar[idx] * 2);
        console.log('Todos os dados foram processados corretamente?', todosProcessados);
      },
      "/teste"
    );
    
})()
