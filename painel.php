<?php
include '../header/header.php';
$nome_usuario = 'Visitante';
$foto_perfil = '../img/projetos/fotoperfil.png'; // Foto de perfil padrão

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
            background: linear-gradient(135deg, #A3C9FF, #4A76A8); /* Gradiente suave de azul */
            color: #333;
            min-height: 100vh;
        }

        /* Layout principal */
        .main-content {
            padding: 40px 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .welcome-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        /* Estilo da imagem de perfil circular */
        .profile-pic {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            margin-right: 20px;
            border: 4px solid #D8A6D1;
            object-fit: cover;
        }

        h2 {
            font-size: 26px;
            color: #6A4C9C;
        }

        p {
            font-size: 18px;
            color: #333;
        }

        /* Cards explicativos */
        .how-it-work-cards {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 40px;
        }

        .how-it-work-card {
            background-color: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 22%;
            padding: 20px;
            border-radius: 8px;
            transition: transform 0.3s ease;
            text-align: center;
        }

        .how-it-work-card:hover {
            transform: translateY(-10px);
        }

        .card-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 20px;
            color: #6A4C9C;
            margin-bottom: 10px;
        }

        .card-description {
            font-size: 16px;
            color: #666;
        }

        /* Container com o texto adicional */
        .extra-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            color: #6A4C9C;
        }

        .extra-container p {
            font-size: 16px;
            color: #555;
        }

        /* Menu Responsivo */
        .nav-links {
            display: none;
            width: 100%;
            background-color: #D8A6D1;
            padding: 10px 0;
        }

        .nav-links li {
            display: block;
            text-align: center;
            margin: 10px 0;
        }

        .nav-links.active {
            display: block;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .how-it-work-cards {
                flex-direction: column;
                align-items: center;
            }

            .how-it-work-card {
                width: 80%;
                margin: 10px 0;
            }

            .hamburger-menu {
                display: block;
            }

            .nav-links {
                display: none;
                width: 100%;
                background-color: #D8A6D1;
                padding: 10px 0;
            }

            .nav-links li {
                display: block;
                text-align: center;
                margin: 10px 0;
            }

            .nav-links.active {
                display: block;
            }
        }
    </style>
</head>
<body>

<!-- Conteúdo Principal -->
<main class="main-content">
    <div class="container">
        <section class="welcome-section">
            <div class="user-info">
                <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil" class="profile-pic">
                <div>
                    <h2>Seja bem-vindo, <?php echo htmlspecialchars($nome_usuario); ?>!</h2>
                    <p>Estamos muito felizes em te ter por aqui. Vamos ajudar você a encontrar as melhores oportunidades ou freelancers para o seu projeto.</p>
                </div>
            </div>
        </section>

        <!-- Container com o texto adicional -->
        <div class="extra-container">
            <p>Bem-vindo ao CemFreelas, a plataforma que conecta freelancers talentosos e clientes em busca de soluções criativas. Encontre o profissional ideal para seu projeto ou publique suas oportunidades para conquistar novos desafios. Cadastre-se agora e comece a explorar as melhores opções para seu trabalho ou projeto!</p>
        </div>

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

    <?php include '../header/footer.php'; ?>
</main>
</body>
</html>
