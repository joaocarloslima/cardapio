<?php

class Produto {
    public int $id;
    public string $nome;
    public string $descricao;
    public string $imagem;
    public float $preco;

    function __construct ($id, $nome, $descricao, $imagem, $preco) {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->preco = $preco;
    }

    function getPrecoFormatado(): string{
        return "R$ " . number_format($this->preco, 2);
    }

}