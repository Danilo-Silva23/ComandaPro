<?php
session_start();

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "restaurante");

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $nomeProduto = $conn->real_escape_string($_POST['nomeProduto']);
    $categoria = $conn->real_escape_string($_POST['categoria']);
    $valor = $conn->real_escape_string($_POST['valor']);

    $sql = "INSERT INTO Produtos (NomeProduto, Categoria, Valor) VALUES ('$nomeProduto', '$categoria', '$valor')";

    if ($conn->query($sql) === TRUE) {
        $mensagem = "Produto cadastrado com sucesso!";
    } else {
        $mensagem = "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="cadastrar_produtos.css">
</head>
<body>
    <?php if (!empty($mensagem)): ?>
        <div class="mensagem">
            <?php echo htmlspecialchars($mensagem); ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <h2>Cadastrar Produto</h2>
        <form action="cadastrar_produtos.php" method="post">
            <label for="nomeProduto">Nome do Produto:</label>
            <input type="text" id="nomeProduto" name="nomeProduto" required>

            <label>Categoria:</label>
            <div>
                <input type="radio" id="comida" name="categoria" value="Comida" required>
                <label for="comida">Comida</label>
            </div>
            <div>
                <input type="radio" id="bebida" name="categoria" value="Bebida">
                <label for="bebida">Bebida</label>
            </div>
            <div>
                <input type="radio" id="outro" name="categoria" value="Outro">
                <label for="outro">Outro</label>
            </div>
            <br>
            <label for="valor">Valor:</label>
            <input type="text" id="valor" name="valor" required>

            <input type="submit" value="Cadastrar">
            <a href="../home2.php" class="voltar">Voltar</a>
        </form>
    </div>
</body>
</html>
