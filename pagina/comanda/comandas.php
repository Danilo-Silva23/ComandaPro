<?php
session_start();
$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

// Verifica se o UserID está definido na sessão
if (isset($_SESSION['UserID'])) {
    $userID = $_SESSION['UserID'];
} else {
    $userID = "UserID";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comandas - Restaurante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="home2.css">
    <link rel="stylesheet" href="comandas.css">
</head>

<body>

<nav>
    <div class="logo">
        <img src="../comanda/img/image.png" alt="Logo">
    </div>
    <ul>
        <li><a href="../home2.php" class="nav-link">Início</a></li>
        <li><a href="../vendas/resultado_vendas.php" class="nav-link">Resultado de Vendas</a></li>
        <li><a href="../produtos/cadastrar_produtos.php" class="nav-link">Adicionar Produto</a></li>
    </ul>
    <a href="../home2.php" class="mobile-home-button">Home</a> 
</nav>


    <div class="content">
        <div class="cards-container">
            <div class="card">
                <h3>Lançar Produtos</h3>
                <p>Adicione produtos à comanda existente ou Crie uma.</p>
                <a href="../comanda/lancamento_pedido.php" class="card-link">Ir para Lançar Produtos</a>
            </div>
            <div class="card">
                <h3>Fechar Comanda</h3>
                <p>Finalize e feche a comanda.</p>
                <a href="../comanda/fechar_comanda.php" class="card-link">Ir para Fechar Comanda</a>
            </div>
        </div>
    </div>

</body>

</html>
