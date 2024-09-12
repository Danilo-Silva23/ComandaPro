<?php
session_start();

$conn = new mysqli("localhost", "root", "", "restaurante");
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$comandaID = $_POST['comanda'];
$formaPagamento = $_POST['forma_pagamento'];

$sql = "SELECT TotalItens, ValorTotal FROM TotalComanda WHERE ComandaID = $comandaID";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    die("Detalhes da comanda não encontrados.");
}
$row = $result->fetch_assoc();
$totalItens = $row['TotalItens'];
$valorTotal = $row['ValorTotal'];

$sql = "INSERT INTO ResultadosVendas (ComandaID, ValorTotal, FormaPagamento) 
        VALUES ($comandaID, $valorTotal, '$formaPagamento')";
if (!$conn->query($sql)) {
    die("Erro ao inserir dados em ResultadosVendas: " . $conn->error);
}

$sql = "SELECT p.NomeProduto, i.Quantidade, i.ValorUnitario, i.ValorTotal 
        FROM ItensComanda i 
        JOIN Produtos p ON i.ProdutoID = p.ProdutoID
        WHERE i.ComandaID = $comandaID";
$result = $conn->query($sql);
$itens = [];
while ($row = $result->fetch_assoc()) {
    $itens[] = $row;
}

$sql = "DELETE FROM ItensComanda WHERE ComandaID = $comandaID";
$conn->query($sql);

$sql = "DELETE FROM Comandas WHERE ComandaID = $comandaID";
$conn->query($sql);

$sql = "DELETE FROM TotalComanda WHERE ComandaID = $comandaID";
$conn->query($sql);

$conn->close();
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
    <div class="container">
        <h2>Fechamento de Comanda</h2>
        <div id="resultado">
            <p><strong>Comanda Fechada:</strong> <?php echo htmlspecialchars($comandaID); ?></p>
            <p><strong>Total de Itens:</strong> <?php echo htmlspecialchars($totalItens); ?></p>
            <p><strong>Valor Total:</strong> R$ <?php echo number_format($valorTotal, 2, ',', '.'); ?></p>
            <p><strong>Forma de Pagamento:</strong> <?php echo htmlspecialchars($formaPagamento); ?></p>
            <h3>Detalhes dos Itens</h3>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor Unitário</th>
                        <th>Valor Total</th>
                    </tr>   
                </thead>
                <tbody>
                    <?php foreach ($itens as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['NomeProduto']); ?></td>
                            <td><?php echo htmlspecialchars($item['Quantidade']); ?></td>
                            <td>R$ <?php echo number_format($item['ValorUnitario'], 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($item['ValorTotal'], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p>Obrigado por usar nosso sistema!</p>
        </div>
        <a href="../home2.php" class="voltar">Voltar à Home</a>
    </div>
</body>
</html>
