<?php
// Configuração de conexão com o banco de dados
$host = "localhost";  // Endereço do servidor MySQL
$dbname = "usuarios_db";  // Nome do banco de dados
$username = "root";  // Usuário do MySQL
$password = "";  // Senha do MySQL (em ambientes de desenvolvimento como o WAMP, o padrão geralmente é vazio)

// Tentando conectar ao banco de dados
try {
    // Estabelece a conexão com o banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Definindo o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Se a conexão falhar, exibe a mensagem de erro
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

$mensagem = ""; // Variável para armazenar mensagens de erro ou sucesso

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senha_digitada = $_POST['senha_atual']; // Senha atual digitada pelo usuário
    $nova_senha = $_POST['nova_senha']; // Nova senha desejada
    $confirmar_senha = $_POST['confirmacao_senha']; // Confirmação da nova senha

    // Defina o ID do usuário manualmente para testar (Substitua por um ID real ou use sessão)
    $usuario_id = 1; // Aqui você usa um ID fixo de teste (no caso, o ID 1)

    // Preparando a consulta para pegar a senha do usuário no banco de dados
    $stmt = $pdo->prepare("SELECT senha FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $usuario_id);
    $stmt->execute();

    // Verificando se o usuário existe
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Verificando se a senha digitada corresponde à senha armazenada no banco de dados
        if ($senha_digitada == $usuario['senha']) {
            // Verificando se a nova senha e a confirmação da senha coincidem
            if ($nova_senha == $confirmar_senha) {
                // Atualizando a senha no banco de dados
                $stmt_update = $pdo->prepare("UPDATE usuarios SET senha = :nova_senha WHERE id = :id");
                $stmt_update->bindParam(':nova_senha', $nova_senha);
                $stmt_update->bindParam(':id', $usuario_id);
                $stmt_update->execute();

                $mensagem = "Senha alterada com sucesso!";
            } else {
                $mensagem = "A nova senha e a confirmação não coincidem. Tente novamente.";
            }
        } else {
            $mensagem = "A senha atual está incorreta. Tente novamente.";
        }
    } else {
        $mensagem = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="password"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }

        .success {
            color: #5bc0de;
        }

        .error {
            color: #d9534f;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Alterar Senha</h2>

    <!-- Exibe a mensagem de erro ou sucesso -->
    <?php if ($mensagem): ?>
        <div class="message <?php echo (strpos($mensagem, 'sucesso') !== false) ? 'success' : 'error'; ?>">
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>

    <!-- Formulário de alteração de senha -->
    <form action="alterar_senha.php" method="POST">
        <div class="form-group">
            <label for="senha_atual">Senha Atual</label>
            <input type="password" id="senha_atual" name="senha_atual" required>
        </div>
        
        <div class="form-group">
            <label for="nova_senha">Nova Senha</label>
            <input type="password" id="nova_senha" name="nova_senha" required>
        </div>

        <div class="form-group">
            <label for="confirmacao_senha">Confirmar Nova Senha</label>
            <input type="password" id="confirmacao_senha" name="confirmacao_senha" required>
        </div>

        <input type="submit" value="Alterar Senha">
    </form>
</div>

</body>
</html>
