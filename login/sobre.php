<?php
// Incluir a conexão com o banco de dados e cabeçalho
include 'header.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre nós - CemFreelas</title>
    <link rel="stylesheet" href="caminho/para/seu/estilo.css"> <!-- Ajuste o caminho -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f9f9f9;
            color: #333;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #FF4D94;
        }

        h2 {
            font-size: 28px;
            color: #FF4D94;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .contact-info, .social-links {
            font-size: 18px;
            margin-top: 30px;
        }

        .contact-info p, .social-links p {
            margin: 10px 0;
        }

        .social-links ul {
            list-style: none;
            padding: 0;
        }

        .social-links ul li {
            margin: 5px 0;
        }

        .social-links ul li a {
            color: #FF4D94;
            text-decoration: none;
            font-weight: 500;
        }

        .social-links ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container"> 
        <h1>Sobre o CemFreelas</h1>
        <p>Bem-vindo ao <strong>CemFreelas</strong>, a plataforma ideal para freelancers e empresas que buscam soluções criativas e profissionais! Nosso objetivo é conectar pessoas talentosas a projetos incríveis, seja você um freelancer buscando novas oportunidades ou uma empresa em busca de serviços especializados.</p>

        <p>O <strong>CemFreelas</strong> oferece um espaço seguro e dinâmico para freelancers exibirem suas habilidades e conquistarem novos contratos. De design gráfico a desenvolvimento de software, passando por redação e marketing digital, temos uma comunidade cheia de profissionais de várias áreas prontos para ajudar a tirar o seu projeto do papel e levá-lo ao próximo nível.</p>

        <h2>Por que escolher o CemFreelas?</h2>
        <ul>
            <li><strong>Diversidade de Serviços</strong>: Encontre freelancers especializados em diversas áreas como programação, design, marketing, tradução, redação e muito mais.</li>
            <li><strong>Segurança e Confiança</strong>: Todos os profissionais são cuidadosamente verificados, garantindo um ambiente seguro para realizar negócios.</li>
            <li><strong>Fácil de Usar</strong>: A plataforma é intuitiva e fácil de navegar, permitindo que você encontre o que precisa rapidamente.</li>
        </ul>

        <p>Se você é freelancer, aqui é o lugar para mostrar o seu trabalho e conquistar novas oportunidades. Se você precisa de ajuda para o seu projeto, estamos aqui para conectar você com profissionais qualificados.</p>
    </div>
</body>
</html>

<?php
// Incluir o rodapé
include_once 'footer.php';
?>
