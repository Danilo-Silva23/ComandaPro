<?php
session_start();
$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

if (isset($_SESSION['UserID'])) {
    $userID = $_SESSION['UserID'];
} else {
    $userID = "UserID";
}

$conn = new mysqli("localhost", "root", "", "restaurante");
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$sqlSemana = "
    SELECT SUM(ValorTotal) AS TotalSemana 
    FROM ResultadosVendas 
    WHERE YEARWEEK(DataHora, 1) = YEARWEEK(CURDATE(), 1)";
$resultSemana = $conn->query($sqlSemana);
$rowSemana = $resultSemana->fetch_assoc();
$totalSemana = $rowSemana['TotalSemana'] ?? 0;

$sqlMes = "
    SELECT SUM(ValorTotal) AS TotalMes 
    FROM ResultadosVendas 
    WHERE MONTH(DataHora) = MONTH(CURDATE()) 
    AND YEAR(DataHora) = YEAR(CURDATE())";
$resultMes = $conn->query($sqlMes);
$rowMes = $resultMes->fetch_assoc();
$totalMes = $rowMes['TotalMes'] ?? 0;

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Totais de Vendas</title>
    <link rel="stylesheet" href="totais.css">
</head>
<body>

    <div class="container">
        <a href="../home2.php" class="voltar">Voltar à Home</a>
        <h2>Totais de Vendas</h2>
        <div id="resultado">
            <p><strong>Total da Semana:</strong> R$ <?php echo number_format($totalSemana, 2, ',', '.'); ?></p>
            <p><strong>Total do Mês:</strong> R$ <?php echo number_format($totalMes, 2, ',', '.'); ?></p>
        </div>
    </div>
</body>
</html>
