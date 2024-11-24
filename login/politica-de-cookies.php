<?php
// Iniciar a sessão para garantir que o cabeçalho funcione corretamente
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir a classe de conexão PDO
include_once 'Database.php';  // Inclua o caminho correto

// Criar uma instância da classe Database e obter a conexão
$db = new Database();
$conn = $db->getConnection();

// Obter o nome do usuário se estiver logado (exemplo de uso do banco de dados)
$usuario_nome = 'Visitante';  // Valor padrão caso o usuário não esteja logado

if (isset($_SESSION['usuario_email'])) {
    $usuario_email = $_SESSION['usuario_email'];

    // Consultar o banco de dados para obter o nome do usuário
    try {
        $stmt = $conn->prepare("SELECT nome FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $usuario_email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            $usuario_nome = $usuario['nome'];
        }
    } catch (PDOException $e) {
        echo "Erro na consulta: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Cookies - CemFreelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"> <!-- Link do Bulma -->
</head>
<body>
    <style>
        /* Estilos personalizados para o layout */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4a6fa5;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header .logo h1 {
            margin: 0;
            font-size: 36px;
            font-weight: bold;
            color: #ffffff;
        }

        .barra-pesquisa {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .barra-pesquisa input {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px 0 0 5px;
            border: 2px solid #ccc;
            width: 300px;
        }

        .barra-pesquisa button {
            padding: 10px;
            font-size: 16px;
            background-color: #4a6fa5;
            color: white;
            border: 2px solid #4a6fa5;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        .barra-pesquisa button:hover {
            background-color: #365f8e;
        }

        .container {
            padding: 30px;
            max-width: 900px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .title {
            color: #333;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .footer {
            background-color: #4a6fa5;
            color: white;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }
    </style>

    <!-- Cabeçalho -->
    <header>
        <div class="logo">
            <a href="painel.php"><h1>CemFreelas</h1></a>
        </div>
    </header>

    <!-- Conteúdo da Política de Cookies -->
    <div class="container">
        <h2 class="title is-3">Política de Cookies</h2>
        <p>Esta Política de Cookies explica como o site <strong>CemFreelas</strong> usa cookies e tecnologias semelhantes para reconhecer você quando você visita nosso site e como podemos usar essas informações.</p>

        <h3 class="title is-4">O que são Cookies?</h3>
        <p>Cookies são pequenos arquivos de texto que são armazenados no seu dispositivo (computador, tablet, celular) quando você acessa nosso site. Eles ajudam a melhorar a sua experiência de navegação, lembrando suas preferências, autenticando seu login, e permitindo que possamos analisar o desempenho do site.</p>

        <h3 class="title is-4">Quais Cookies usamos?</h3>
        <p>Usamos os seguintes tipos de cookies:</p>
        <ul>
            <li><strong>Cookies Necessários:</strong> Essenciais para o funcionamento do site, como autenticação de usuário.</li>
            <li><strong>Cookies de Desempenho:</strong> Usados para analisar como você interage com o site, nos ajudando a melhorar a experiência de navegação.</li>
            <li><strong>Cookies de Funcionalidade:</strong> Permitem que o site se lembre de suas escolhas e preferências, como idioma e configurações.</li>
            <li><strong>Cookies de Publicidade:</strong> Usados para exibir anúncios relevantes para você, baseados em seus interesses.</li>
        </ul>

        <h3 class="title is-4">Como Controlar os Cookies</h3>
        <p>Você pode controlar e/ou excluir cookies a qualquer momento, através das configurações do seu navegador. Você pode configurar seu navegador para bloquear cookies ou alertá-lo quando um cookie for enviado. No entanto, isso pode afetar a funcionalidade de alguns recursos do site.</p>

        <h3 class="title is-4">Alterações na Política de Cookies</h3>
        <p>Esta política pode ser atualizada ocasionalmente. Caso haja mudanças significativas, iremos notificá-lo em nosso site. Recomendamos que você revise periodicamente esta página para se manter informado sobre nossas práticas em relação aos cookies.</p>

        <h3 class="title is-4">Entre em Contato Conosco</h3>
        <p>Se você tiver dúvidas sobre nossa Política de Cookies, entre em contato conosco através do e-mail: <a href="mailto:contato@cemfreelas.com">contato@cemfreelas.com</a></p>
    </div>

    <footer class="footer">
        <p>&copy; 2024 CemFreelas. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
