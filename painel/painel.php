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
            background-color: #007BFF; /* Cor do header ajustada para azul */
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .navbar .logo {
            font-size: 22px; /* Tamanho da logo reduzido */
            color: white;
            font-weight: bold;
        }

        /* Barra de Pesquisa */
        .search-bar {
            flex-grow: 1;
            max-width: 350px; /* Tamanho da barra de pesquisa reduzido */
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

        /* Menu de Navegação */
        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px; /* Tamanho das fontes do menu reduzido */
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
            background-color: #007BFF; /* Cor do header ajustada para azul */
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
                font-size: 14px; /* Tamanho da fonte do menu no mobile reduzido */
            }
        }

        /* Estilo do conteúdo principal */
        .main-content {
            padding: 20px 20px; /* Padding reduzido */
        }

        .container {
            max-width: 1000px; /* Largura da página reduzida */
            margin: 0 auto;
        }

        /* Estilo do painel */
        .welcome-section {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 30px; /* Margem reduzida */
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .profile-pic {
            border-radius: 50%;
            width: 80px; /* Tamanho da foto de perfil reduzido */
            height: 80px; /* Tamanho da foto de perfil reduzido */
            margin-right: 20px;
            border: 4px solid #D8A6D1;
            object-fit: cover;
        }

        h2 {
            font-size: 22px; /* Tamanho da saudação reduzido */
            color: #007BFF; /* Cor da saudação ajustada para azul */
        }

        p {
            font-size: 16px; /* Tamanho do texto reduzido */
            color: #333;
        }

        .extra-container {
            background-color: #fff;
            padding: 15px; /* Padding reduzido */
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 30px; /* Margem reduzida */
            color: #007BFF; /* Cor do texto ajustada para azul */
        }

        .extra-container p {
            font-size: 14px; /* Tamanho do texto reduzido */
            color: #555;
        }

        /* Cards explicativos */
        .how-it-work-cards {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px; /* Margem reduzida */
        }

        .how-it-work-card {
            background-color: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 22%; /* Largura dos cards reduzida */
            padding: 15px; /* Padding dos cards reduzido */
            border-radius: 8px;
            transition: transform 0.3s ease;
            text-align: center;
        }

        .how-it-work-card:hover {
            transform: translateY(-10px);
        }

        .card-image {
            width: 100%;
            height: 160px; /* Tamanho da imagem reduzido */
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px; /* Margem reduzida */
        }

        .card-title {
            font-size: 18px; /* Tamanho do título reduzido */
            color: #007BFF; /* Cor ajustada para azul */
            margin-bottom: 10px;
        }

        .card-description {
            font-size: 14px; /* Tamanho da descrição reduzido */
            color: #666;
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
            <a href="painel.php">Home</a>
            <a href="..sobre.php">Sobre</a>
            <a href="contato.php">Contato</a>
            <a href="projetos.php">Projetos</a>

            <!-- Exibe Login ou perfil dependendo do estado de login -->
            <?php if (isset($_SESSION['usuario_email'])) { ?>
                <a href="perfil.php">Perfil</a>
                <a href="meus_projetos.php">Meus Projetos</a>
                <a href="postar_projeto.php">Postar Projeto</a>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="../login/login.php">Login</a>
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
            <!-- Seção de boas-vindas -->
            <section class="welcome-section">
                <div class="user-info">
                    <img src="../img/projetos/fotoperfil.png" alt="Foto de Perfil" class="profile-pic">
                    <div>
                        <h2>Seja bem-vindo, Visitante!</h2>
                        <p>Estamos muito felizes em te ter por aqui. Vamos ajudar você a encontrar as melhores oportunidades ou freelancers para o seu projeto.</p>
                    </div>
                </div>
            </section>

            <!-- Descrição adicional -->
            <div class="extra-container">
                <p>Bem-vindo ao CemFreelas, a plataforma que conecta freelancers talentosos e clientes em busca de soluções criativas. Encontre o profissional ideal para seu projeto ou publique suas oportunidades para conquistar novos desafios. Cadastre-se agora e comece a explorar as melhores opções para seu trabalho ou projeto!</p>
            </div>

            <!-- Cards explicativos -->
            <section class="how-it-work-cards">
                <div class="how-it-work-card">
                    <img src="../img/projetos/publiquepj.jpg" alt="Poste seu Projeto" class="card-image">
                    <p class="card-description">Poste seu projeto e conecte-se com freelancers qualificados.</p>
                </div>
                <div class="how-it-work-card">
                    <img src="../img/projetos/selecione.avif" alt="Freelancer" class="card-image">
                    <p class="card-description">Encontre freelancers talentosos prontos para trabalhar no seu projeto.</p>
                </div>
                <div class="how-it-work-card">
                    <img src="../img/projetos/obtenha.webp" alt="Contrate" class="card-image">
                    <p class="card-description">Contrate o freelancer ideal e comece a trabalhar no seu projeto.</p>
                </div>
                <div class="how-it-work-card">
                    <img src="../img/projetos/pagando.avif" alt="Imagem do Cartão" class="card-image">
                    <p class="card-description">Nós garantimos que o pagamento seja seguro e que ambas as partes fiquem satisfeitas.</p>
                </div>
            </section>
        </div>
    </main>

    <script>
        function toggleMenu() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('active');
        }
    </script>
<?php include '../header/footer.php'?>
</body>
</html>
