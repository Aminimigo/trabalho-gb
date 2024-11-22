<?php
session_start();
include '../db/DB.php'; // Classe DB para conexão com o banco de dados

// Variável para armazenar erros
$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validar se os campos estão preenchidos
    if (empty($email) || empty($senha)) {
        $erro = "Email e senha são obrigatórios!";
    } else {
        // Conectar ao banco de dados
        $DB = new DB();
        $conn = $DB->connect();  // Usando o método 'connect', não 'getConnection'

        if ($conn === null) {
            $erro = "Erro ao conectar ao banco de dados.";
        } else {
            // Consultar o banco de dados para verificar se o usuário existe
            $query = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Verificar a senha (sem hash para este exemplo)
                if ($senha == $usuario['senha']) {
                    // Se a senha estiver correta, armazenar as informações na sessão
                    $_SESSION['usuario_email'] = $usuario['email'];
                    $_SESSION['usuario_id'] = $usuario['id'];

                    // Redirecionar para o painel de acordo com o tipo de usuário
                    if ($usuario['tipo_usuario'] == 'cliente') {
                        header("Location: ../painel/painel_cliente.php");
                    } elseif ($usuario['tipo_usuario'] == 'freelancer') {
                        header("Location: ../painel/painel_freelancer.php");
                    }
                    exit();
                } else {
                    $erro = "Senha incorreta!";
                }
            } else {
                $erro = "Usuário não encontrado!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* Estilo básico da página */
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #A3C8FF, #C7E8FF); /* Gradiente suave de azul claro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Container do formulário de login */
        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Título do formulário */
        h2 {
            font-size: 28px;
            color: #007BFF; /* Azul forte */
            margin-bottom: 20px;
        }

        /* Estilo dos campos de entrada */
        .input-field {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 25px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            color: #333;
            transition: border-color 0.3s;
        }

        .input-field:focus {
            border-color: #007BFF; /* Foco na borda com cor azul */
            outline: none;
        }

        /* Botão de envio */
        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #007BFF; /* Azul forte */
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .submit-btn:hover {
            background-color: #0056b3; /* Cor mais forte no hover */
            transform: scale(1.05); /* Efeito de aumentar o botão */
        }

        /* Mensagem de erro */
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        /* Link para o cadastro */
        .signup-link {
            margin-top: 20px;
            color: #6c757d; /* Cor suave para o texto */
        }

        .signup-link a {
            color: #007BFF; /* Azul forte para o link */
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>

        <!-- Exibindo a mensagem de erro, se houver -->
        <?php if (!empty($erro)): ?>
            <p class="error"><?php echo $erro; ?></p>
        <?php endif; ?>

        <!-- Formulário de login -->
        <form method="POST" action="login.php">
            <input type="email" name="email" id="email" placeholder="Email" class="input-field" required><br>
            <input type="password" name="senha" id="senha" placeholder="Senha" class="input-field" required><br>
            <button type="submit" class="submit-btn">Entrar</button>
        </form>

        <!-- Link para o cadastro -->
        <p class="signup-link">
            Ainda não tem uma conta? <a href="cadastro.php">Cadastre-se</a>
        </p>
    </div>

</body>
</html>
