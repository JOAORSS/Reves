<?php

include_once "../utils/funcoes.php";

$conexao = abrirConexao();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/iconReves.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/normalize.css">
    <title>Reves - Produtos</title>
</head>

<body>
    <header>
        <a href="../index.html"><img src="../assets/logorevesboutique.png" alt="BANNER LOGO"></a>
        <form >
            <input autocomplete="off" role="combobox" list="produtos" type="search" name="search">
            <datalist role="listbox" id="produtos">
                <?php
                    datalistProd($conexao);
                ?>
            </datalist>
            <input type="submit" value="procurar produto">
        </form>
        <div>
            <a href="../index.html">Home</a> 
            <a href="produtos.php">Produtos</a> 
            <a href="fale_conosco.html">Fale Conosco</a>
        </div>
    </header>
    <main>
    <?php
        $prod = listarProdutos($conexao);
    ?>
    </main>
    <footer>
        <h2>2024 Alice Maffei Rizzetti & João Vitor Raenke dos Santos</h2>
        <h2>Todos os direitos reservados - 2024</h2>
    </footer>

</body>

</html>