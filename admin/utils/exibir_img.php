<?php

include_once "funcoes.php";

$conexao = abrirConexao();

$id = $_GET['id'];

$produtoImg = trazerProduto($conexao, $id);

$produtoImg->tratarImagem();