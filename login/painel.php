<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    header('Location: login.php');  // Redireciona para a página de login se não estiver logado
    exit();
}

include '../db/db.php';  // Conexão com o banco de dados

// Recuperar os dados do usuário
$email_usuario = $_SESSION['usuario_email'];
$stmt = $conn->prepare("SELECT nome, foto_perfil FROM usuarios WHERE email = :email");
$stmt->bindParam(':email', $email_usuario);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Definir os dados do usuário
$nome_usuario = $usuario ? $usuario['nome'] : 'Usuário Anônimo';
$foto_perfil = $usuario && isset($usuario['foto_perfil']) && !empty($usuario['foto_perfil']) 
    ? $usuario['foto_perfil'] 
    : 'uploads/fotos_perfil/default-avatar.png'; // Foto de perfil ou padrão
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - CemFreelas</title>
    <link rel="stylesheet" href="caminho/para/seu/estilo.css"> <!-- Ajuste o caminho -->
    <style>
        /* Estilos Gerais */
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to bottom, #ff8da2, #ff4d94); 
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;  /* Flexbox para estrutura em coluna */
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;  /* Ocupa toda a altura da página */
            overflow-y: auto; /* Adiciona rolagem ao conteúdo */
        }

        /* Conteúdo Principal */
        .main-content {
            background-color: white;
            width: 100%;
            max-width: 1000px;
            margin-top: 90px; /* Compensa a altura do cabeçalho fixo */
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            color: #333;
        }

        .container {
            width: 100%;
            padding: 30px 20px 30px 20px;
        }

        .welcome-section h2 {
            font-size: 26px;
            margin-bottom: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .user-info img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin-right: 20px;
        }

        .welcome-section p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        /* Rodapé (Footer) */
        .site-footer {
            background-color: #FFC0CB;
            color: #333;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            position: relative;
            bottom: 0;
        }

        /* Estilos de Responsividade */
        @media (max-width: 768px) {
            .main-content {
                margin-top: 70px;  /* Menor espaço para cabeçalho fixo em dispositivos móveis */
                padding: 20px;
            }
        }
    </style>
</head>
<!-- Incluir Cabeçalho -->
<?php include 'header.php'; ?>
<body>
    

    <!-- Conteúdo Principal -->
    <main class="main-content">
        <div class="container">
            <section class="welcome-section">
                <div class="user-info">
                    <!-- Foto de perfil -->
                    <img src="<?php echo $foto_perfil; ?>" alt="Foto de Perfil" class="profile-pic">
                    <h2>Bem-vindo, <?php echo htmlspecialchars($nome_usuario); ?>!</h2>
                </div>
                <p>Você está logado no painel de controle.</p>
                <p>Bem-vindo ao CemFreelas! O lugar certo para quem quer oferecer ou encontrar serviços de qualidade!</p>
                <p>Se você é freelancer, aqui é o seu espaço para mostrar seu talento e fechar ótimos negócios.</p>
                <p>Se você está precisando de uma mão para tirar seu projeto do papel, temos uma comunidade cheia de profissionais prontos para te ajudar!</p>
                <p>Vem fazer parte dessa rede de gente talentosa e começar a realizar grandes parcerias!</p>
            </section>
        </div>
    </main>

    <!-- Rodapé (Footer) -->
    <footer class="site-footer">
        <p>&copy; 2024 CemFreelas - Todos os direitos reservados.</p>
    </footer>

</body>
</html>
