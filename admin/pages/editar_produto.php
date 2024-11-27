<?php

include_once "../utils/funcoes.php";

$conexao = abrirConexao();

$id = $_GET['id'];

$produto = trazerProduto($conexao, $id);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/iconReves.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/normalize.css">
    <title>Reves - <?= $produto->nome ?></title>
</head>

<body>
    <header>
            <a href="../index.html"><img src="../assets/logorevesboutique.png" alt="BANNER LOGO"></a>
        <div>
            <a href="../index.html">Home</a>
            <a href="fale_conosco.html">Fale Conosco</a>
        </div>
    </header>
    <form action="resposta_inserir_produto.php" method="post" enctype="multipart/form-data">
        <img src="../utils/exibir_img.php?id=<?=$id?>" alt="Imagem do Produto">
        <div>
        <label>Alterar imagem</label><br>
        <input type="file" accept="image/*" name="imagem">
        </div>
        <div>
        <input type="hidden" name="id" value="<?= $id?>">
            <h2>Nome: <input type="text" name="nome" value="<?= $produto->nome?>"></h2>
            <p>Descricao: <input type="text" name="descricao" value="<?= $produto->descricao?>"></p>
            <h3>Data: <input type="date" name="data" value="<?= $produto->data ?>"></h3>
            <input type="submit" value="Atualizar">
        </div>
    </form>
    <footer>
        <h2>2024 Alice Maffei Rizzetti & João Vitor Raenke dos Santos</h2>
        <h2>Todos os direitos reservados - 2024</h2>
    </footer>

</body>

</html>