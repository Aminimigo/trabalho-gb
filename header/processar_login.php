<?php
session_start();
require_once 'Usuario.php'; // Inclua a classe Usuario
require_once '../db/db.php'; // Conexão com o banco de dados

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o email e senha foram fornecidos
    if (isset($_POST['email'], $_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        try {
            // Criar a instância da classe Usuario
            $usuario = new Usuario($conn);
            
            // Tentar autenticar o usuário
            $usuarioAutenticado = $usuario->autenticar($email, $senha);

            if ($usuarioAutenticado) {
                // Redireciona de acordo com o tipo de usuário
                if ($usuarioAutenticado['tipo_usuario'] == 'cliente') {
                    header('Location: painel_cliente.php');
                } elseif ($usuarioAutenticado['tipo_usuario'] == 'freelancer') {
                    header('Location: painel_freelancer.php');
                }
                exit();
            } else {
                $erro = "Credenciais inválidas!";
            }
        } catch (PDOException $e) {
            $erro = "Erro ao realizar login: " . $e->getMessage();
        }
    } else {
        $erro = "Por favor, preencha todos os campos!";
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
        /* CSS de login (Pode ser o mesmo que já foi fornecido) */
        .container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .field {
            margin-bottom: 10px;
        }

        .label {
            font-size: 14px;
        }

        .input {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            margin-top: 5px;
        }

        .button {
            width: 100%;
            padding: 10px;
            background-color: #4a6fa5;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #365d81;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="title">Faça login para continuar</h2>
        <?php if (!empty($erro)): ?>
            <p class="error"><?php echo $erro; ?></p>
        <?php endif; ?>
        <form action="processar_login.php" method="POST">
            <div class="field">
                <label for="email" class="label">Email:</label>
                <input type="email" id="email" name="email" class="input" required>
            </div>
            <div class="field">
                <label for="senha" class="label">Senha:</label>
                <input type="password" id="senha" name="senha" class="input" required>
            </div>
            <button type="submit" class="button">Entrar</button>
        </form>
        <div class="footer">
            <p>Não tem uma conta? <a href="cadastrar_usuario.php">Cadastre-se</a></p>
        </div>
    </div>
</body>
</html>
