<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurante";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['confirm_senha']) && isset($_POST['cpf']) && isset($_POST['telefone'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirm_senha = $_POST['confirm_senha'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];

    if ($senha !== $confirm_senha) {
        echo "As senhas não coincidem. Por favor, tente novamente.";
    } else {
        $sql = "INSERT INTO users (Username, email, senha, CPF, Telefone) VALUES ('$nome', '$email', '$senha', '$cpf', '$telefone')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Erro ao criar registro: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="cadastrar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <h2>Cadastro Restaurante</h2>
        <form action="cadastrar.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <label for="confirm_senha">Confirmar Senha:</label>
            <input type="password" id="confirm_senha" name="confirm_senha" required>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required maxlength="14" oninput="formatarCPF(this)">

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" required maxlength="15" oninput="formatarTelefone(this)">

            <input type="submit" value="Cadastrar">
        </form>
        <div class="login-link">
            <label for="login">Já possui conta?</label>
            <a href="login.php">Faça login</a>
        </div>
    </div>
    <footer>
        <div class="contact-info">
            <label>Contato</label>
            <i class="fas fa-envelope"></i>
            <span>restaurante@gmail.com</span>
        </div>
    </footer>

    <script>
        function formatarCPF(campo) {
            let cpf = campo.value;
            cpf = cpf.replace(/\D/g, "");
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            campo.value = cpf;
        }

        function formatarTelefone(campo) {
            let telefone = campo.value;
            telefone = telefone.replace(/\D/g, "");
            telefone = telefone.replace(/(\d{2})(\d)/, "($1) $2");
            telefone = telefone.replace(/(\d{5})(\d{1,4})$/, "$1-$2");
            campo.value = telefone;
        }
    </script>
</body>
</html>
