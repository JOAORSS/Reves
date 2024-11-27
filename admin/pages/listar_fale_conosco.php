<?php

include_once "../utils/funcoes.php";

$conexao = abrirConexao();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/normalize.css">
    <link rel="shortcut icon" href="../assets/iconReves.png" type="image/x-icon">
    <title>Reves - Fac</title>    
</head>

<body>
    <header>
            <a href="../index.php"><img src="../assets/logorevesboutique.png" alt="BANNER LOGO"></a>
            <h2>Administrador</h2>
    </header>
    <main>
        <h2>Duvidas dos usuarios</h2>
        <table>
            <tr>
                <th>Nome</th>
                <th>Contato</th>
                <th>Dúvida</th>
            </tr>
            <?php
            faleConoscoListar($conexao);
            ?>
        </table>
        <a href="../index.php">Voltar a pagina principal admin</a>
    </main>
    <footer>
        <h2>2024 Alice Maffei Rizzetti & João Vitor Raenke dos Santos</h2>
        <h2>Todos os direitos reservados - 2024</h2>
    </footer>

</body>
<?php fecharConexao($conexao) ?>
</html>