<?php
session_start();

$conn = new mysqli("localhost", "root", "", "restaurante");
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$comanda = $_POST['comanda'];
$produtos = $_POST['produto'];
$quantidades = $_POST['quantidade'];

$sql = "SELECT ComandaID FROM Comandas WHERE NomeCliente = '$comanda'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $comandaID = $row['ComandaID'];
} else {
    $sql = "INSERT INTO Comandas (NomeCliente) VALUES ('$comanda')";
    if ($conn->query($sql) === TRUE) {
        $comandaID = $conn->insert_id;
    } else {
        die("Erro ao criar comanda: " . $conn->error);
    }
}

foreach ($produtos as $index => $produtoID) {
    $quantidade = $quantidades[$index];

    $sql = "SELECT Valor FROM Produtos WHERE ProdutoID = $produtoID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $valorUnitario = $row['Valor'];

    $sql = "INSERT INTO ItensComanda (ComandaID, ProdutoID, Quantidade, ValorUnitario) VALUES ($comandaID, $produtoID, $quantidade, $valorUnitario)";
    if (!$conn->query($sql)) {
        die("Erro ao adicionar item: " . $conn->error);
    }
}

$sql = "SELECT COUNT(*) AS TotalItens, SUM(ValorTotal) AS ValorTotal FROM ItensComanda WHERE ComandaID = $comandaID";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalItens = $row['TotalItens'];
$valorTotal = $row['ValorTotal'];

$sql = "INSERT INTO TotalComanda (ComandaID, TotalItens, ValorTotal) VALUES ($comandaID, $totalItens, $valorTotal)
        ON DUPLICATE KEY UPDATE TotalItens = $totalItens, ValorTotal = $valorTotal";
if (!$conn->query($sql)) {
    die("Erro ao atualizar total da comanda: " . $conn->error);
}

$conn->close();

header("Location: lancamento_pedido.php");
exit();
?>
