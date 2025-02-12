<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - CemFreelas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Corpo da Página */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #A3C9FF, #4A76A8);
            color: #333;
            min-height: 100vh;
        }

        /* Estilo para o menu */
        .navbar {
            background-color: #6A4C9C;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .navbar .logo {
            font-size: 24px;
            color: white;
            font-weight: bold;
        }

        /* Barra de Pesquisa */
        .search-bar {
            flex-grow: 1;
            max-width: 400px;
            display: flex;
            margin-left: 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 8px;
            border-radius: 20px;
            border: none;
            outline: none;
            font-size: 16px;
        }

        .search-bar button {
            padding: 8px 12px;
            background-color: #D8A6D1;
            color: white;
            border-radius: 20px;
            border: none;
            cursor: pointer;
        }

        /* Menu de navegação */
        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .hamburger-menu {
            display: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
        }

        .hamburger-menu div {
            width: 25px;
            height: 3px;
            background-color: white;
        }

        /* Estilo do menu quando estiver ativo (visível em dispositivos móveis) */
        .nav-links.active {
            display: block;
            position: absolute;
            top: 60px;
            left: 0;
            width: 100%;
            background-color: #6A4C9C;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                width: 100%;
            }

            .hamburger-menu {
                display: flex;
            }

            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-bar {
                margin-top: 10px;
                width: 100%;
                margin-left: 0;
            }

            .nav-links a {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">CemFreelas</div>

        <!-- Barra de Pesquisa -->
        <div class="search-bar">
            <input type="text" placeholder="Pesquisar...">
            <button>Pesquisar</button>
        </div>

        <!-- Menu de Navegação -->
        <div class="nav-links">
            <a href="home.php">Home</a>
            <a href="sobre.php">Sobre</a>
            <a href="contato.php">Contato</a>
            <?php if (isset($_SESSION['usuario_email'])) { ?>
                <a href="perfil.php">Perfil</a>
                <a href="meus_projetos.php">Meus Projetos</a>
                <a href="postar_projeto.php">Postar Projeto</a>
                <a href="../header/logout.php">Logout</a>
            <?php } ?>
        </div>

        <!-- Hamburger Menu -->
        <div class="hamburger-menu" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </header>

    <!-- Conteúdo da Página -->
    <main class="main-content">
        <div class="container">
            <!-- Seu conteúdo aqui -->
        </div>
    </main>

    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
    </script>

</body>
</html>
