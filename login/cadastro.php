<?php
// Incluir a conexão com o banco de dados
include '../db/db.php'; // ou '../db/db.php', dependendo da localização do seu arquivo db.php

// Variável para armazenar a mensagem de erro
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coletar dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];  // Sem hash, senha será armazenada como texto puro
    $telefone = $_POST['telefone'];
    $datanascimento = $_POST['datanascimento'];

    try {
        // Verificar se o e-mail já está cadastrado
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Se o e-mail já estiver registrado, definir a mensagem de erro
            $erro = "Este e-mail já está cadastrado. Por favor, utilize outro.";
        } else {
            // Caso o e-mail não exista, inserir o novo usuário
            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, telefone, datanascimento) VALUES (:nome, :email, :senha, :telefone, :datanascimento)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);  // Armazenar a senha diretamente
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':datanascimento', $datanascimento);
        
            // Executar a query
            $stmt->execute();
        
            // Sucesso, redirecionar ou exibir mensagem
            echo "Cadastro realizado com sucesso!";
            header('Location: login.php');
            exit();
        }

    } catch (PDOException $e) {
        $erro = "Erro ao cadastrar usuário: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - CemFreelas</title>
    <style>
        /* CSS Integrado */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #ffe6f1, #e1bee7); /* Gradiente suave em tons pasteis */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Formulário */
        .container {
            width: 100%;
            max-width: 500px;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 28px;
        }

        .field {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            margin-bottom: 10px;
            color: #555;
        }

        .input, .button {
            width: 100%;
            padding: 12px;
            border-radius: 25px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            background-color: #f9f9f9;
            font-size: 16px;
            color: #333;
        }

        .input[type="file"] {
            border: none;
        }

        .button {
            background-color: #ff66b3; /* Cor suave em tom pastel rosa */
            color: white;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }

        .button:hover {
            background-color: #e04074; /* Cor mais forte para hover */
            transform: scale(1.05);
        }

        /* Estilo para exibir mensagem de erro */
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .footer a {
            color: #ff66b3;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsividade */
        @media screen and (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Formulário de Cadastro -->
    <div class="container">
        <h2 class="title">Cadastre-se para começar</h2>

        <!-- Exibindo a mensagem de erro, se houver -->
        <?php if (!empty($erro)): ?>
            <p class="error"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form action="cadastro.php" method="POST">
            <div class="field">
                <label class="label" for="nome">Nome:</label>
                <input class="input" type="text" id="nome" name="nome" required placeholder="Digite seu nome">
            </div>

            <div class="field">
                <label class="label" for="email">E-mail:</label>
                <input class="input" type="email" id="email" name="email" required placeholder="Digite seu e-mail">
            </div>

            <div class="field">
                <label class="label" for="senha">Senha:</label>
                <input class="input" type="password" id="senha" name="senha" required placeholder="Digite sua senha">
            </div>

            <div class="field">
                <label class="label" for="telefone">Telefone:</label>
                <input class="input" type="text" id="telefone" name="telefone" placeholder="(XX) XXXXX-XXXX">
            </div>

            <div class="field">
                <label class="label" for="datanascimento">Data de Nascimento:</label>
                <input class="input" type="date" id="datanascimento" name="datanascimento">
            </div>

            <div class="field">
                <button class="button" type="submit">Cadastrar</button>
            </div>
        </form>

        <div class="footer">
            <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
        </div>
    </div>

</body>
</html>
