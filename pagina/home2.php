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
    <title>Home - Restaurante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="home2.css">
       
</head>

<body>

    <nav>
        <div class="logo">
            <img src="../pagina/comanda/img/image.png" alt="Logo">
        </div>
        <div class="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul>
            <li><a href="../pagina/comanda/comandas.php" class="nav-link">Comandas</a></li>
            <li><a href="../pagina/vendas/resultado_vendas.php" class="nav-link">Resultado de Vendas</a></li>
            <li><a href="../pagina/produtos/cadastrar_produtos.php" class="nav-link">Adicionar Produto</a></li>
            <li>
                <?php if ($loggedin): ?>
                    <form action="../acesso/logout.php" method="POST" style="display:inline;">
                        <input type="submit" value="Sair" class="logout">
                    </form>
                <?php else: ?>
                    <a href="../acesso/login.php" class="login">Login</a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>

    <div class="content">
        <div class="hero-image"></div>

        <div class="food-image">
            <img src="../pagina/comanda/img/R1.jpeg" alt="Imagem de comida">
        </div>

        <div class="copy">
            <h2>Portal dos Funcionários</h2>
            <p>Simplifique a gestão das comandas com nossa plataforma dedicada. Aqui, você pode lançar novas comandas, acompanhar pedidos e fechá-las com facilidade e eficiência. Acesso rápido e intuitivo para otimizar o fluxo de trabalho e garantir um serviço ágil e preciso. Seu papel é essencial para uma experiência excepcional, e nossa ferramenta é projetada para tornar seu trabalho mais simples e eficaz.</p>
        </div>
    </div>

    <footer>
        <label>© 2024 Restaurante. Todos os direitos reservados.</label>
    </footer>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navLinks = document.querySelector('nav ul');

        menuToggle.addEventListener('click', () => {
            navLinks.classList.toggle('show');
        });
    </script>
</body>

</html>
