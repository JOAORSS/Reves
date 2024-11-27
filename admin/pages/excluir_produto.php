<?php

include_once "../utils/funcoes.php";

$conexao = abrirConexao();

$id = isset($_GET["excluir"]) ? $_GET["excluir"] : null;
$excluirDep = isset($_GET["confirm"]) ? true : null;

try {

    $confirmRelacao = confirmarRelacional($conexao, $id);

    if ($confirmRelacao) {
        $print = "Cuidado<br><p>Está ação também excluira os interesses que estão relacionados á este produto<p>";
        $solve = "<a href='excluir_produto.php?excluir=$id&confirm=1'>Deseja excluir mesmo assim?</a>";
    }

    if ($excluirDep == true OR !$confirmRelacao) {
        $resultado = excluirProduto($conexao, $id);
        $print = $resultado? "O produto foi deletado com sucesso" : "Erro ao deletar o produto";
    }

} catch (Throwable $erro) {
    $print = "Erro ao deletar o produto";
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
    <?php if (isset($solve)){
        echo $solve;
    } ?>
    </main>
    <footer>
        <h2>2024 Alice Maffei Rizzetti & João Vitor Raenke dos Santos</h2>
        <h2>Todos os direitos reservados - 2024</h2>
    </footer>

</body>
<?php fecharConexao($conexao) ?>

</html>