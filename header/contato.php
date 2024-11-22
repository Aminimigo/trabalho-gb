<?php
include '../header/header.php'; // Incluindo o cabeçalho do site

// Processar o formulário quando for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $mensagem = new Mensagem($db);
    $mensagem->nome = htmlspecialchars($_POST['nome']); // Proteção contra injeção de HTML
    $mensagem->email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); // Sanitização do e-mail
    $mensagem->mensagem = htmlspecialchars($_POST['mensagem']); // Proteção contra injeção de HTML

    if ($mensagem->salvarMensagem()) {
        echo "<p>Mensagem enviada com sucesso! Obrigado por entrar em contato.</p>";
    } else {
        echo "<p>Houve um erro ao enviar sua mensagem. Por favor, tente novamente.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fale Conosco - CemFreelas</title>
    <link rel="stylesheet" href="style.css">
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Container Principal */
        .container {
            max-width: 1000px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        h2 {
            font-size: 24px;
            color: #007bff; /* Azul */
            margin-bottom: 15px;
        }

        /* Contato - Informações */
        .contact-info {
            margin-bottom: 30px;
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
            color: #007bff; /* Azul */
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
            color: #007bff; /* Azul */
            text-decoration: none;
            font-size: 16px;
        }

        .social-links a:hover {
            text-decoration: underline;
        }

        /* Formulário */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        button {
            padding: 10px 15px;
            background-color: #007bff; /* Azul */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3; /* Azul escuro */
        }

        /* Estilos Responsivos */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h2 {
                font-size: 20px;
            }
        }
    </style>

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

        <!-- Formulário de Contato -->
        <h2>Entre em Contato</h2>
        <form action="fale_conosco.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>

                <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="mensagem">Mensagem:</label>
            <textarea name="mensagem" id="mensagem" rows="5" required></textarea>

            <button type="submit">Enviar Mensagem</button>
        </form>
    </div>

    <?php include '../header/footer.php'?>
</body>
</html>
