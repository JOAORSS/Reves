<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reves - Encomende sua peça</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="shortcut icon" href="../assets/iconReves.png" type="image/x-icon">
</head>

<body>
    <header>
        <a href="../index.html"><img src="../assets/logorevesboutique.png" alt="BANNER LOGO"></a>
        <div>
            <a href="../index.html">Home</a>
            <a href="produtos.php">Produtos</a>
            <a href="fale_conosco.html">Fale Conosco</a>
        </div>
    </header>
    <main>
        <h2>Formulário Tenho Interesse</h2>
        <form action="resposta_tenho_Interesse.php" method="post">

            <input type="hidden" name="id" value="<?=$_GET["id"]?>">
            <label>Nome:</label>
            <input type="text" name="nome">
            <label>Telefone</label>
            <input type="number" name="telefone">
            <input type="submit" value="Enviar">
        </form>
    </main>
    <footer>
        <h2>2024 Alice Maffei Rizzetti & João Vitor Raenke dos Santos</h2>
        <h2>Todos os direitos reservados - 2024</h2>
    </footer>

</body>

</html>