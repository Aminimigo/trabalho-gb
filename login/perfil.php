<?php
include 'header.php';
?>

<?php
// Inicia a sessão se ainda não foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");  // Redireciona para o login se o usuário não estiver logado
    exit();
}

include '../db/db.php'; // Conexão com o banco de dados

// Recuperar os dados do usuário do banco de dados
$email_usuario = $_SESSION['usuario_email'];
$stmt = $conn->prepare("SELECT nome, email, foto_perfil, redes_sociais, portfolio FROM usuarios WHERE email = :email");
$stmt->bindParam(':email', $email_usuario);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Definir os dados do usuário
$nome_usuario = $usuario ? $usuario['nome'] : 'Usuário Anônimo';
$email_usuario = $usuario ? $usuario['email'] : 'Não informado';
$foto_perfil = $usuario && isset($usuario['foto_perfil']) && !empty($usuario['foto_perfil']) 
    ? $usuario['foto_perfil'] 
    : 'uploads/fotos_perfil/default-avatar.png'; // Foto de perfil ou padrão
$redes_sociais = $usuario ? $usuario['redes_sociais'] : '';
$portfolio = $usuario ? $usuario['portfolio'] : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Perfil - CemFreelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"> <!-- Link do Bulma -->
    <style>
        /* Estilos Gerais */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f7fc; /* Fundo claro */
        }

        /* Cabeçalho */
        header {
            background-color: #ff80bf; /* Rosa claro */
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }

        .logo h1 {
            padding: 30px 10px 10px 0px;
            font-size: 24px;
            margin: 0;
        }

        .logo a {
            text-decoration: none;
            color: white;
        }

        .logo a:hover {
            text-decoration: underline;
        }

        /* Barra de Pesquisa */
        .barra-pesquisa {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 10px;
            border-radius: 25px;
            margin-right: 20px;
            max-width: 300px;
            width: 100%;
        }

        .barra-pesquisa input {
            width: 100%;
            padding: 10px;
            border-radius: 25px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .barra-pesquisa button {
            background-color: #ff4d94;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }

        /* Menu de navegação */
        .menu {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ff4d94;
        }

        .menu ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .menu ul li {
            padding: 0 15px;
        }

        .menu ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

        .menu ul li a:hover {
            text-decoration: underline;
        }

        .usuario-info {
            color: white;
            font-size: 18px;
            margin-left: 20px;
        }

        /* Estilo do conteúdo da página */
        .profile-container {
            margin-top: 30px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-header .image {
            margin-right: 20px;
        }

        .profile-header .image img {
            border-radius: 50%;
            width: 128px;
            height: 128px;
        }

        .profile-header h2 {
            margin: 0;
        }

        .profile-header p {
            font-size: 16px;
            color: #777;
        }

        .profile-section {
            margin-top: 20px;
        }

        .profile-section h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .profile-section p {
            font-size: 16px;
            color: #555;
        }

        .buttons a {
            margin-top: 20px;
        }

        /* Responsividade */
        @media screen and (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            .profile-container {
                margin-top: 20px;
            }

            .profile-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<!-- Conteúdo principal da página de perfil -->
<main>
    <section class="section">
        <div class="container">
            <div class="profile-container">
                <div class="profile-header">
                    <div class="image">
                        <img src="<?php echo $foto_perfil; ?>" alt="Foto de Perfil" class="is-rounded">
                    </div>
                    <div>
                        <h2><?php echo htmlspecialchars($nome_usuario); ?></h2>
                        <p><strong>E-mail:</strong> <?php echo htmlspecialchars($email_usuario); ?></p>
                    </div>
                </div>

                <div class="profile-section">
                    <h3>Redes Sociais</h3>
                    <?php if (!empty($redes_sociais)): ?>
                        <p><a href="<?php echo htmlspecialchars($redes_sociais); ?>" target="_blank">Visitar perfil</a></p>
                    <?php else: ?>
                        <p>Não informado</p>
                    <?php endif; ?>
                </div>

                <div class="profile-section">
                    <h3>Portfólio</h3>
                    <?php if (!empty($portfolio)): ?>
                        <p><a href="<?php echo htmlspecialchars($portfolio); ?>" target="_blank">Ver portfólio</a></p>
                    <?php else: ?>
                        <p>Não informado</p>
                    <?php endif; ?>
                </div>

                <div class="buttons">
                    <a href="editar_perfil.php" class="button is-link">Editar Perfil</a>
                    <a href="alterar_senha.php" class="button is-info">Alterar Senha</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
