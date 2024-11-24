<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    header('Location: login.php');
    exit();
}

$email_usuario = $_SESSION['usuario_email'];

// Incluir a classe de usuários e instanciá-la
include_once '../classes/User.php';
$user = new User();

// Recuperar todos os usuários cadastrados no banco de dados, exceto o usuário atual
$usuarios = $user->getAllUsers($email_usuario);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfis Cadastrados - CemFreelas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #ff80bf;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }

        header .logo h1 {
            margin: 0;
            font-size: 24px;
        }

        header .logo a {
            text-decoration: none;
            color: white;
        }

        header .logo a:hover {
            text-decoration: underline;
        }

        .section {
            padding: 30px 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .perfil-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .perfil-card {
            width: 250px;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            text-align: center;
            background-color: #fff;
        }

        .perfil-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .perfil-card .name {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .perfil-card .email,
        .perfil-card .telefone {
            margin-top: 5px;
            font-size: 14px;
            color: #555;
        }

        footer {
            background-color: #ff80bf;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

    <!-- Cabeçalho -->
    <header>
        <div class="logo">
            <a href="painel.php"><h1>CemFreelas</h1></a>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <section class="section">
        <div class="container">
            <h2 class="title">Perfis Cadastrados</h2>

            <div class="perfil-list">
                <?php
                // Exibir os perfis cadastrados
                foreach ($usuarios as $usuario) {
                    $foto_perfil = !empty($usuario['foto_perfil']) ? $usuario['foto_perfil'] : 'uploads/fotos_perfil/default-avatar.png';
                    echo '<div class="perfil-card">';
                    echo '<img src="' . htmlspecialchars($foto_perfil) . '" alt="Foto de Perfil">';
                    echo '<div class="name">' . htmlspecialchars($usuario['nome']) . '</div>';
                    echo '<div class="email">' . htmlspecialchars($usuario['email']) . '</div>';
                    echo '<div class="telefone">' . htmlspecialchars($usuario['telefone']) . '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 CemFreelas - Todos os direitos reservados.</p>
    </footer>

</body>
</html>
