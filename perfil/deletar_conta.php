<?php
session_start();
require_once '../db/DB.php';
require_once '../db/Usuario.php';

// Verifica se o usuário está logado
if (isset($_SESSION['usuario_email'])) {
    $email_usuario = $_SESSION['usuario_email'];

    // Conexão com o banco de dados
    $database = new DB();
    $conn = $database->connect();

    // Criando objeto da classe Usuario
    $usuario = new Usuario($conn);

    // Tentativa de deletar a conta
    if ($usuario->deletarConta($email_usuario)) {
        // Se for bem-sucedido, encerre a sessão e redirecione para a página de login
        session_destroy();
        header("Location: ../login/login.php");
        exit();
    } else {
        echo "Erro ao deletar a conta. Tente novamente.";
    }
} else {
    echo "Você precisa estar logado para deletar a sua conta.";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Conta - CemFreelas</title>
    <link rel="stylesheet" href="caminho/para/seu/estilo.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fb;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .delete-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .delete-container h2 {
            color: #0056b3;
            margin-bottom: 20px;
        }
        .delete-container p {
            margin-bottom: 30px;
        }
        .delete-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-delete {
            background-color: #ff4d4d;
            color: white;
        }
        .btn-cancel {
            background-color: #ccc;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="delete-container">
        <h2>Tem certeza?</h2>
        <p>Deletar sua conta é uma ação permanente e não poderá ser desfeita.</p>
        <?php if (isset($erro)): ?>
            <p style="color: red;"><?php echo $erro; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <button type="submit" class="btn-delete">Deletar Conta</button>
            <a href="../perfil/perfil.php" class="btn-cancel">Cancelar</a>
        </form>
    </div>
</body>
</html>
