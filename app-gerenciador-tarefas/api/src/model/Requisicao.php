<?php

declare(strict_types=1);

final class Requisicao {
    private array $dadosReq;
    private string $url = '';
    private string $arquivoAtual = '';
    private string $diretorioRaiz = '';
    private string $rota = '';
    private string $metodo = '';
    private array $arrayRota = [];
    private string $logica = '';
    private array $parametros = [];
    private string $logicaComId = '';


    public function __construct(array $dadosReq, array &$dadosUsuario) {
        $this->dadosReq = $dadosReq;
        $this->destrinchaRequisicao($dadosUsuario);
    }


    private function destrinchaRequisicao(&$dadosUsuario) {
        $this->metodo = $this->dadosReq["REQUEST_METHOD"];

        // url = app-adm-loja/produto (ex: get)
        $this->url = $this->dadosReq["REQUEST_URI"];

        // diretorioRaiz = app-adm-loja-produto
        $this->diretorioRaiz = strtolower(dirname($this->dadosReq["PHP_SELF"]));

        // rota completa -> tira app-adm-loja de dentro de url, assim, url, fica: /produto
        $rotaCompleta = str_replace($this->diretorioRaiz, "", $this->url);
        // ["/" , "produto"]
        $this->arrayRota = explode("/", $rotaCompleta);

        $this->logica = "/{$this->arrayRota[1]}";
        // ["/" , "produto" , "/" "1"]

        if (count($this->arrayRota) > 2) {
            $this->logicaComId = $this->logica;

            for ($i = 2; $i < count($this->arrayRota); $i++) {
                $param = $this->arrayRota[$i];
                if (! is_numeric($param)) {
                    $this->logica .= "/" . $param;
                    $this->logicaComId .= "/" . $param;
                } else {
                    $param = (int) $this->arrayRota[$i];
                    $this->parametros[] = (int) $param;
                    array_push($dadosUsuario, (int) $param);
                    $this->logicaComId .= "/:id";
                }
            }
        }
    }


    public function getLogica(): string
    {
        if (empty($this->parametros))
            return $this->logica;
        return $this->logicaComId;
    }


    public function getMetodo(): string
    {
        return $this->metodo;
    }


    public function getParametros(): array {
        return $this->parametros;
    }
}
