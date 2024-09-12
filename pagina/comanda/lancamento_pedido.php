<?php
session_start();
$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

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
    <title>Lançamento de Pedido</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="home2.css">
    <link rel="stylesheet" href="lancamento_pedido.css">
    <script>
        function addProductField() {
            const container = document.getElementById('product-fields');
            const index = container.children.length;

            const newField = document.createElement('div');
            newField.classList.add('product-field');

            newField.innerHTML = `
                <label for="produto${index}">Seleciona o Nome do Produto:</label>
                <select id="produto${index}" name="produto[]" required>
                    <?php
                    $conn = new mysqli("localhost", "root", "", "restaurante");
                    if ($conn->connect_error) {
                        die("Falha na conexão: " . $conn->connect_error);
                    }
                    $sql = "SELECT ProdutoID, NomeProduto FROM Produtos";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['ProdutoID'] . "'>" . $row['NomeProduto'] . "</option>";
                    }

                    $conn->close();
                    ?>
                </select>
                <br>
                <label for="quantidade${index}">Quantidade:</label>
                <input type="number" id="quantidade${index}" name="quantidade[]" min="1" required>
            `;

            container.appendChild(newField);
        }
    </script>
</head>
<body>
    <nav>
        <div class="logo">
            <img src="../comanda/img/image.png" alt="Logo">
        </div>
        <ul>
            <li><a href="../comanda/comandas.php" class="nav-link">Comandas</a></li>
            <li><a href="../vendas/resultado_vendas.php" class="nav-link">Resultado de Vendas</a></li>
            <li><a href="../produtos/cadastrar_produtos.php" class="nav-link">Adicionar Produto</a></li>
            
        </ul>
    </nav>

    <div class="container">
        <a href="../comanda/comandas.php" class="voltar">Voltar</a>

        <h2>Lançamento de Pedido</h2>
        <form action="lancar_pedido.php" method="post">
            <label for="comanda">Número da Mesa/Comanda/Cliente:</label>
            <input type="text" id="comanda" name="comanda" required>

            <div id="product-fields">
                <div class="product-field">
                    <label for="produto0">Seleciona o Nome do Produto:</label>
                    <select id="produto0" name="produto[]" required>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "restaurante");
                        if ($conn->connect_error) {
                            die("Falha na conexão: " . $conn->connect_error);
                        }
                        $sql = "SELECT ProdutoID, NomeProduto FROM Produtos";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['ProdutoID'] . "'>" . $row['NomeProduto'] . "</option>";
                        }

                        $conn->close();
                        ?>
                    </select>
                    <br>
                    <label for="quantidade0">Quantidade:</label>
                    <input type="number" id="quantidade0" name="quantidade[]" min="1" required>
                </div>
            </div>

            <button class="adicionar" type="button" onclick="addProductField()">Adicionar Mais Produtos</button>
            <br>
            <br>
            <label for="detalhes">Detalhes Adicionais:</label>
            <br>
            <br>
            <textarea id="detalhes" name="detalhes" rows="4" placeholder="Insira detalhes adicionais sobre o pedido aqui..."></textarea>
            <br>
            <input type="submit" value="Lançar Pedido">
            <br>
        </form>
    </div>
</body>
</html>
