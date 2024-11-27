<?php

include_once "funcoes.php";

$conexao = abrirConexao();

$nome = $_POST["nome"];
$email = $_POST["email"];
$duvida = $_POST["duvida"];

$resultado = faleConsocoInsert($conexao, $nome, $email, $duvida);

$print = $resultado? "Sua duvida foi adicionada a nossa lista" : "Erro ao registrar sua duvida <br>Tente novamente.";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../assets/iconReves.png" type="image/x-icon">
    <title>Reves - Fale conosco</title>
</head>

<body>
    <header>
        <div>
            <a href="../index.html"><img src="../images/logorevesboutique.png" alt="BANNER LOGO"></a>
        </div>
        <div><a href="../index.html">Home</a> 
            <a href="../html/fale_conosco.html">Fale Conosco</a>
            <a href="produtos.php">Produtos</a> 
        </div>
    </header>
    <main>
    <h2><?=$print?></h2>
    </main>
    <footer>
        <h2>2024 Alice Maffei Rizzetti & João Vitor Raenke dos Santos</h2>
        <h2>Todos os direitos reservados - 2024</h2>
    </footer>

</body>

</html>