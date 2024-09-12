<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurante";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM Users WHERE email='$email' AND senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['UserID'] = $user['UserID']; 
        $_SESSION['nome'] = $user['Username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['sexo'] = $user['sexo'];
        $_SESSION['senha'] = $user['senha'];
        header("Location: ../pagina/home2.php");
        exit();
    } else {
        echo "Login falhou. Verifique suas credenciais.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login restaurante</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="form-container">
        <h2>Login restaurante</h2>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <input type="submit" value="Login">
        </form>
        <div class="login-link">
            <label for="cadastro">Ainda não possui conta?</label>
            <a href="cadastrar.php">Cadastre-se</a>
        </div>
    </div>
    <footer>
        <div class="contact-info">
            <label>Contato</label>
            <i class="fas fa-envelope"></i>
            <span>Restaurante@gmail.com</span>
        </div>
    </footer>
</body>
</html>
