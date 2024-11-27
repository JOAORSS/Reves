<?php

include_once "produto.php";


// abrir a conexao é  só criar um objeto do tipo PDO passando:
// qual o tipo banco - "mysql"
// qual o host - "localhost"
// qual o banco - "reves"
// qual o usuario - "root"
// qual a senha - "*nenhuma*"
function abrirConexao():PDO{
    $conexao = new PDO("mysql:host=localhost;dbname=reves","root","");
    return $conexao;
}

// ATENÇÂO PARA ESTA - é uma funcao normal que delcara a canexao com NULL
// mas porque tem o *&* antes do $conexao?
// porque com ele, faz com que a funcao altere a posicção de memoria da var $conexao
// ou seja da para se dizer altera a verdadeira var $conexao
function fecharConexao(PDO &$conexao):void{
    $conexao = null;
    return;
}

function trazerProduto(PDO $conexao, int $id):produto {

    // preparando o nosso script sql só que aqui tem um parametro *?*
    $stmt = $conexao->prepare("SELECT * FROM produto WHERE idProduto = ?");
    // vincular o paramtro ? - $id - dizendo que ele é um int
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    
    $stmt->execute();

    // produto = busca do banco (como um objto) *SINGULAR*
    $produto = $stmt->fetch(PDO::FETCH_OBJ);

    // FILE INFO = criando o finfo na (funcao descobrir que tipo é o arquivo)
    $finfo = new finfo(FILEINFO_MIME_ENCODING);

    // o tipo da nassa imagem = file info = memeria (da imagem pega do banco)
    $imagemType = $finfo->buffer($produto->imagem);

    // fechando o file info
    finfo_close($finfo);

    // retornando o objeto produto - da classe produto
    return new produto($produto->idProduto, $produto->nome, $produto->descricao, $produto->imagem, $imagemType, $produto->data);

}

function listarProdutos(PDO $conexao):void{
    
    $stmt = $conexao->prepare("SELECT idProduto, nome FROM produto");
    $stmt->execute();

    $arrayProdutos = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach ($arrayProdutos as $produtos) {
        echo'<div>
                <a class="produto__img" href="produto_pagina.php?id='. $produtos->idProduto .'">
                <img src="../utils/exibir_img.php?id='. $produtos->idProduto .'" alt="'. $produtos->nome .'" width="200px" >
                <h3 class="produto__h3">'. $produtos->nome .'</h3>
                </a>
            </div>';
        echo'<br>';
    }
    return;
}

function datalistProd(PDO $conexao):void{
    
    // preparando o script SQL (linguagem do banco)
    $stmt = $conexao->prepare("SELECT idProduto, nome FROM produto");
    // metodo que executa o scrip que ele salvou
    $stmt->execute(); 

    // buscou a resposta do script

    // var que salva a respota - do stmt ele fetchAll (buscar Todos) - (PDO::BUSCAR_*como um objt*)
    $arrayProdutos = $stmt->fetchAll(PDO::FETCH_OBJ);


                                // sair do plural      //e tratar o singular   // de cada um
    // foreach (pra cada um) - (*TODOS OS OBJETOS* como *UM OBJETO* (quando falarmos do obejto SEPARADAMENTE dosOUTROS) )
    foreach ($arrayProdutos as $produto) {
        
            // tag e valor == *pagina do produto com uma variavel (nesse caso o id=)*


            // produto_pagina.php?id=21
            // 1(produto_pagina.php) 2(?) 3(id) = 4($produto->idProduto)>
            
            // 1*arquivo* 2*avisaque vai passar parametros* 3*anunciando uma variavel* 4*valor da variavel*

        echo '<option value="produto_pagina.php?id='.$produto->idProduto.'">'. $produto->nome .'</option>';
    }
    return;
}

function tenhoInteresseInsert(PDO $conexao, string $nome, int $contato, int $id):bool{

    $stmt = $conexao->prepare("INSERT INTO interesse (nome, contato, idProduto) VALUES (?,?,?)");
    
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $contato, PDO::PARAM_INT);
    $stmt->bindParam(3, $id, PDO::PARAM_INT);
    
    $resultado = $stmt->execute()? true : false;
    
    return $resultado;
}

function faleConsocoInsert(PDO $conexao, string $nome, string $contato, string $duvida):bool{

    $stmt = $conexao->prepare("INSERT INTO faleconosco (nome, contato, duvida) VALUES (?,?,?)");
    
    $stmt->bindParam(1, $nome, PDO::PARAM_STR);
    $stmt->bindParam(2, $contato, PDO::PARAM_STR);
    $stmt->bindParam(3, $duvida, PDO::PARAM_STR);
    
    $resultado = $stmt->execute()? true : false;
    
    return $resultado;
}