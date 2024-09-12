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
    <title>Fechar Mesa/Comanda</title>
    <link rel="stylesheet" href="fechar_comanda.css">
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
    </nav>
    <div class="container">
        <a href="../comanda/comandas.php" class="voltar">Voltar</a>
        <h2>Fechar Mesa/Comanda</h2>
        <form action="fechar_comanda_processar.php" method="post">
            <label for="comanda">Número da Mesa/Comanda/Cliente:</label>
            <select id="comanda" name="comanda" required>
                <?php
                $conn = new mysqli("localhost", "root", "", "restaurante");
                if ($conn->connect_error) {
                    die("Falha na conexão: " . $conn->connect_error);
                }

                $sql = "SELECT ComandaID, NomeCliente FROM Comandas";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['ComandaID'] . "'>" . htmlspecialchars($row['NomeCliente']) . "</option>";
                }

                $conn->close();
                ?>
            </select>

            <label for="forma_pagamento">Forma de Pagamento:</label>
            <select id="forma_pagamento" name="forma_pagamento" required>
                <option value="Dinheiro">Dinheiro</option>
                <option value="Cartão de Crédito">Cartão de Crédito</option>
                <option value="Cartão de Débito">Cartão de Débito</option>
                <option value="Outros">Outros</option>
            </select>

            <input type="submit" value="Fechar Comanda">
        </form>

        <div id="resultado">
        </div>
    </div>
</body>
</html>