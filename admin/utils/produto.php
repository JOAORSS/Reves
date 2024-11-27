<?php

class produto{
    public int $id;
    public string $nome;
    public string $descricao;
    public ?string $imagem;
    public string $imagemType;
    public string $data;

    public function __construct(int $id, string $nome, string $descricao, ?string $imagem, string $imagemType, string $data)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->imagemType = $imagemType;
        $this->data = $data;
    }

    public function __toString()
    {
        return "ID: $this->id <br> NOME: $this->nome <br> DESCRICAO: $this->descricao <br> DATA: $this->data";
    }

    public function tratarImagem()
    {
        header("Content-type: image");

        echo $this->imagem;
    }


}