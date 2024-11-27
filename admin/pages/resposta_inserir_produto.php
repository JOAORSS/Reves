<?php

include_once "../utils/funcoes.php";

$conexao = abrirConexao();

$id = isset($_POST["id"]) ? $_POST["id"] : 0;

$nome = $_POST["nome"];
$data = $_POST["data"];
$descricao = $_POST["descricao"];
$imagem = isset($_FILES["imagem"]) ? $_FILES["imagem"] : null;

$imagemData = $imagem['error'] === UPLOAD_ERR_OK ? file_get_contents($imagem['tmp_name']) : null;

$produto = new produto($id, $nome, $descricao, $imagemData, "", $data);

if ($id !== 0) {
    $resultado = $imagemData != null ? atualizarProduto($conexao, $produto) : atualizarProdutoSemImagem($conexao, $produto);
    $print = $resultado? "O produto foi atualizado com sucesso" : "Erro ao atualizar o produto.";
} else{
    $resultado = $imagemData != null ? adicionarProduto($conexao, $produto) : null;
    $print = $resultado? "O novo produto foi adicionado a lista" : "Erro ao registrar o novo produto.";
}



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Reves - Adicionar produto</title>
</head>
<body>
    <header>
            <a href="../index.php"><img src="../assets/logorevesboutique.png" alt="BANNER LOGO"></a>
        <a href="../index.php">Voltar</a> 
    </header>
    <main>
    <h2><?=$print?></h2>
    </main>
    <footer>
        <h2>2024 Alice Maffei Rizzetti & João Vitor Raenke dos Santos</h2>
        <h2>Todos os direitos reservados - 2024</h2>
    </footer>

</body>
<?php fecharConexao($conexao) ?>

</html>