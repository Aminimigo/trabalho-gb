<?php
session_start();

// Incluindo o arquivo de conexão com o banco de dados
include_once '../db/db.php';  // Caminho correto para o db.php

$erro = '';  // Variável para mensagens de erro

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Valida se os campos não estão vazios
    if (empty($email) || empty($senha)) {
        $erro = "Todos os campos são obrigatórios!";
    } else {
        // Verificar se o e-mail existe no banco de dados
        try {
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Verificar se o e-mail foi encontrado
            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($senha === $usuario['senha']) {
                    $_SESSION['usuario_email'] = $usuario['email'];
                    $_SESSION['usuario_nome'] = $usuario['nome'];  // Armazenando o nome

                    // Redirecionar para a página do painel ou dashboard
                    header("Location: ../login/painel.php");
                    exit();
                } else {
                    $erro = "Senha incorreta!";
                }
            } else {
                $erro = "E-mail não encontrado!";
            }
        } catch (PDOException $e) {
            // Caso ocorra algum erro na consulta
            $erro = "Erro ao acessar o banco de dados: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CemFreelas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-field {
            margin-bottom: 15px;
        }

        .input-field label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .input-field input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #4CAF50;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <!-- Exibe mensagens de erro -->
    <?php if (!empty($erro)): ?>
        <p class="error"><?php echo $erro; ?></p>
    <?php endif; ?>

    <!-- Formulário de login -->
    <form action="login.php" method="POST">
        <div class="input-field">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="input-field">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>
        </div>

        <button type="submit" class="btn-submit">Login</button>
    </form>

    <div class="forgot-password">
        <a href="recuperar_senha.php">Esqueceu sua senha?</a>
    </div>
</div>

</body>
</html>
