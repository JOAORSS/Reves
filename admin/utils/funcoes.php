<?php

include_once "produto.php";

function abrirConexao():PDO{
    $conexao = new PDO("mysql:host=localhost;dbname=reves","root","");
    return $conexao;
}

function fecharConexao(PDO &$conexao):void{
    $conexao = null;
    return;
}

function trazerProduto(PDO $conexao, int $id):produto {

    $stmt = $conexao->prepare("SELECT * FROM produto WHERE idProduto = ?");;
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    
    $stmt->execute();

    $produto = $stmt->fetch(PDO::FETCH_OBJ);

    $finfo = new finfo(FILEINFO_MIME_ENCODING);
    $imagemType = $finfo->buffer($produto->imagem);
    finfo_close($finfo);

    return new produto($produto->idProduto, $produto->nome, $produto->descricao, $produto->imagem, $imagemType, $produto->data);

}

function adicionarProduto(PDO $conexao, produto $produto):bool{
    
    // SEMPRE VAMO PREPARAR O SQL - (nome descds...) VALUES (nome = ? descriao = ?...)
    $stmt = $conexao->prepare("INSERT INTO produto (nome, descricao, imagem, data) VALUES (?,?,?,?)");
    
    $stmt->bindParam(1, $produto->nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $produto->descricao, PDO::PARAM_STR);
    // tem uma imagem, LOB = BLOB  B - BINARIO LOB - largue object 
    $stmt->bindParam(3, $produto->imagem, PDO::PARAM_LOB);
    $stmt->bindParam(4, $produto->data, PDO::PARAM_STR);
    
    // rsultado = TRUE ou FALSE se EXECUTAR FOR VERDADEIRO
    // if (executou) = > ture ou false 
    $resultado = $stmt->execute() ? true : false;
    
    return $resultado;
}

function atualizarProduto(PDO $conexao, produto $produto):bool{
    
    $stmt = $conexao->prepare("UPDATE produto SET nome=?, descricao=?, imagem=?, data=? WHERE idProduto = ?");
    
    $stmt->bindParam(1, $produto->nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $produto->descricao, PDO::PARAM_STR);
    $stmt->bindParam(3, $produto->imagem, PDO::PARAM_LOB);
    $stmt->bindParam(4, $produto->data, PDO::PARAM_STR);
    $stmt->bindParam(5, $produto->id, PDO::PARAM_INT);
    
    $resultado = $stmt->execute()? true : false;
    
    return $resultado;
}

function atualizarProdutoSemImagem(PDO $conexao, produto $produto):bool{
    
    $stmt = $conexao->prepare("UPDATE produto SET nome=?, descricao=?, data=? WHERE idProduto = ?");
    
    $stmt->bindParam(1, $produto->nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $produto->descricao, PDO::PARAM_STR);
    $stmt->bindParam(3, $produto->data, PDO::PARAM_STR);
    $stmt->bindParam(4, $produto->id, PDO::PARAM_INT);
    
    $resultado = $stmt->execute()? true : false;
    
    return $resultado;
}

// delete on cascade
function excluirProduto(PDO $conexao, int $id):bool{
    
    $stmt = $conexao->prepare("DELETE FROM produto WHERE idProduto = ?");
    
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    
    $retorno = $stmt->execute() ? true : false;
    
    if ($retorno){
        
        $resultado = $stmt->rowCount() == 1 ? true : false;
    } else{
        $resultado = false;
    }
    
    return $resultado;
}

function confirmarRelacional(PDO $conexao, int $id):bool{
    
    $stmt = $conexao->prepare("SELECT produto.idProduto, interesse.idProduto FROM reves.produto AS produto JOIN reves.interesse AS interesse ON produto.idProduto = interesse.idProduto WHERE produto.idProduto = ?;");
    
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    
    $retorno = $stmt->execute() ? true : false;
    
    if ($retorno){
        $resultado = $stmt->columnCount() == 2 ? true : false;
    }
    
    return $resultado;
}

function listarProdutosAdmin(PDO $conexao):void{
    
    $stmt = $conexao->prepare("SELECT idProduto, nome FROM produto");
    $stmt->execute();

    $arrayProdutos = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach ($arrayProdutos as $produtos) {
    
        echo
        '<tr>
            <th><img src="../utils/exibir_img.php?id='.$produtos->idProduto.'" alt="'.$produtos->nome.'" width="200px" ></th>
            <th>Produto nº: '.$produtos->idProduto.'</th>
            <th>Nome: '.$produtos->nome.'</th>
            <th><a href="excluir_produto.php?excluir='.$produtos->idProduto.'">Excluir</a></th>
            <th><a href="editar_produto.php?id='.$produtos->idProduto.'">Editar</a></th>
        </tr>';
    }
    return;
}

function tenhoInteresseListar(PDO $conexao):void{

    $stmt = $conexao->prepare("SELECT * FROM interesse");
    $stmt->execute();

    $arrayProdutos = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach ($arrayProdutos as $interesse) {
        echo
        '<tr>
            <th>Nome: '.$interesse->nome.'</th>
            <th>Contato: '.$interesse->contato.'</th>
            <th>ID do produto com interesse:'.$interesse->idProduto.'</th>
        </tr>';
    }
    return;
}

function faleConoscoListar(PDO $conexao):void{

    $stmt = $conexao->prepare("SELECT * FROM faleconosco");
    $stmt->execute();

    $arrayProdutos = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach ($arrayProdutos as $fac) {
        echo
        '<tr>
            <th>Pedido nº: '.$fac->idFaleConosco.'</th>
            <th>Nome: '.$fac->nome.'</th>
            <th>Contato: '.$fac->contato.'</th>
            <th>duvida:'.$fac->duvida.'</th>
        </tr>';
    }
    return;
}

