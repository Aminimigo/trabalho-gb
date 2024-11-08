<?php
include 'header.php'; // Incluindo o cabeçalho do site
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fale Conosco - CemFreelas</title>
    <link rel="stylesheet" href="style.css"> <!-- Caminho para o arquivo CSS -->
</head>
<body>
    <style>
        /* Resetando o estilo de algumas tags */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Estilo Geral da Página */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    line-height: 1.6;
    padding: px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Container Principal */
.container {
    max-width: 1000px;
    width: 100%;
    margin: 0 auto;
    padding: 20px;
}

/* Cabeçalho */
h2 {
    font-size: 24px;
    color: #ff4d94; /* Cor rosa claro */
    margin-bottom: 15px;
}

/* Contato - Informações */
.contact-info {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.contact-info p {
    font-size: 16px;
    margin-bottom: 10px;
}

.contact-info strong {
    font-weight: bold;
    color: #555;
}

/* Links de E-mail */
.contact-info a {
    color: #ff4d94;
    text-decoration: none;
}

.contact-info a:hover {
    text-decoration: underline;
}

/* Redes Sociais */
.social-links {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.social-links ul {
    list-style-type: none;
    padding-left: 0;
}

.social-links li {
    margin: 10px 0;
}

.social-links a {
    color: #ff4d94;
    text-decoration: none;
    font-size: 16px;
}

.social-links a:hover {
    text-decoration: underline;
}

/* Estilos Responsivos */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }

    h2 {
        font-size: 20px;
    }

    .contact-info p, .social-links li {
        font-size: 14px;
    }

    /* Tornar as listas mais compactas em dispositivos móveis */
    .social-links ul {
        padding-left: 20px;
    }
}

    </style>
    <!-- Container Principal -->
    <div class="container">
        <!-- Seção de Contato -->
        <div class="contact-info">
            <h2>Fale Conosco</h2>
            <p>Tem dúvidas ou precisa de mais informações? Não hesite em entrar em contato! Estamos sempre à disposição para ajudar.</p>
            <p><strong>Telefone:</strong> (11) 1234-5678</p>
            <p><strong>E-mail:</strong> <a href="mailto:contato@cemfreelas.com.br">contato@cemfreelas.com.br</a></p>
        </div>

        <!-- Seção de Redes Sociais -->
        <div class="social-links">
            <h2>Siga-nos nas Redes Sociais</h2>
            <p>Fique por dentro de todas as novidades, dicas e conteúdos exclusivos seguindo nossas redes sociais:</p>
            <ul>
                <li><a href="https://facebook.com/cemfreelas" target="_blank">Facebook: facebook.com/cemfreelas</a></li>
                <li><a href="https://instagram.com/cemfreelas" target="_blank">Instagram: @cemfreelas</a></li>
                <li><a href="https://twitter.com/cemfreelas" target="_blank">Twitter: @cemfreelas</a></li>
                <li><a href="https://linkedin.com/company/cemfreelas" target="_blank">LinkedIn: linkedin.com/company/cemfreelas</a></li>
            </ul>
        </div>
    </div>

    
</body>
</html>
