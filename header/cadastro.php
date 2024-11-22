<?php
session_start();
include '../db/DB.php'; // Classe DB para conexão com o banco de dados

// Variável para armazenar erros
$erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha_confirm = $_POST['senha_confirm'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $data_nascimento = $_POST['data_nascimento'];

    // Validar se os campos estão preenchidos
    if (empty($nome) || empty($email) || empty($senha) || empty($senha_confirm) || empty($tipo_usuario) || empty($data_nascimento)) {
        $erro = "Todos os campos são obrigatórios!";
    } elseif ($senha !== $senha_confirm) {
        $erro = "As senhas não coincidem!";
    } else {
        // Conectar ao banco de dados
        $DB = new DB();
        $conn = $DB->getConnection();

        if ($conn === null) {
            $erro = "Erro ao conectar ao banco de dados.";
        } else {
            // Verificar se o e-mail já está cadastrado
            $query = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $erro = "E-mail já cadastrado!";
            } else {
                // Inserir novo usuário no banco de dados
                $query = "INSERT INTO usuarios (nome, email, senha, tipo_usuario, data_nascimento) VALUES (:nome, :email, :senha, :tipo_usuario, :data_nascimento)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $senha); // Senha em texto simples
                $stmt->bindParam(':tipo_usuario', $tipo_usuario);
                $stmt->bindParam(':data_nascimento', $data_nascimento);

                if ($stmt->execute()) {
                    // Armazenar as informações na sessão
                    $_SESSION['usuario_email'] = $email;
                    $_SESSION['usuario_id'] = $conn->lastInsertId();

                    // Redirecionar para o painel de acordo com o tipo de usuário
                    if ($tipo_usuario == 'cliente') {
                        header("Location: painel_cliente.php");
                    } elseif ($tipo_usuario == 'freelancer') {
                        header("Location: painel_freelancer.php");
                    }
                    exit();
                } else {
                    $erro = "Erro ao cadastrar, tente novamente!";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
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

        /* Container do formulário de cadastro */
        .form-container {
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

        /* Estilo do select (tipo de usuário) */
        .select-field {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 25px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            color: #333;
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

        /* Link para o login */
        .login-link {
            margin-top: 20px;
            color: #6c757d; /* Cor suave para o texto */
        }

        .login-link a {
            color: #007BFF; /* Azul forte para o link */
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Cadastro</h2>

        <!-- Exibindo a mensagem de erro, se houver -->
        <?php if (!empty($erro)): ?>
            <p class="error"><?php echo $erro; ?></p>
        <?php endif; ?>

        <!-- Formulário de cadastro -->
        <form method="POST" action="cadastro.php">
            <input type="text" name="nome" placeholder="Nome" class="input-field" required><br>
            <input type="email" name="email" placeholder="E-mail" class="input-field" required><br>
            <input type="password" name="senha" placeholder="Senha" class="input-field" required><br>
            <input type="password" name="senha_confirm" placeholder="Confirmar Senha" class="input-field" required><br>
            <select name="tipo_usuario" class="select-field" required>
                <option value="freelancer">Freelancer</option>
                <option value="cliente">Cliente</option>
            </select><br>
            <input type="date" name="data_nascimento" class="input-field" required><br>
            <button type="submit" class="submit-btn">Cadastrar</button>
        </form>

        <!-- Link para o login -->
        <p class="login-link">
            Já tem uma conta? <a href="../login/login.php">Faça login</a>
        </p>
    </div>

</body>
</html>
