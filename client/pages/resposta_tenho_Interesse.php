<?php

include_once "../utils/funcoes.php";

$conexao = abrirConexao();

// pega as informacoes do post
$id = $_POST["id"];
$nome = $_POST["nome"];
$tel = $_POST["telefone"];

// chama a funcao para inserir o interesse no banco e retorna se funcionou ou nao 
$resultado = tenhoInteresseInsert($conexao, $nome, $tel, $id);


// se funcionou  $print       =       //resultado true                                         //resultado false
$print = $resultado? "Seu interesse foi adicionado a lista de espera" : "Erro ao registrar seu interesse <br>Tente novamente." 

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/iconReves.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/normalize.css">
    <title>Reves - Encomende sua peça</title>
</head>

<body>
    <header>
            <a href="../index.html"><img src="../assets/logorevesboutique.png" alt="BANNER LOGO"></a>
        <div>
            <a href="../index.html">Home</a> 
            <a href="fale_conosco.html">Fale Conosco</a>
            <a href="produtos.php">Produtos</a> 
        </div>
    </header>
    <main>
    <!-- mostra o q estiver no print -->
    <h2><?=$print?></h2>
    </main>
    <footer>
        <h2>2024 Alice Maffei Rizzetti & João Vitor Raenke dos Santos</h2>
        <h2>Todos os direitos reservados - 2024</h2>
    </footer>

</body>

</html>