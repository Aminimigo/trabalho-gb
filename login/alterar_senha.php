<?php
// Inclusão das classes
require_once '../db/Database.php';
require_once '../db/Usuario.php';

// Inicia a conexão com o banco
$database = new Database();
$pdo = $database->getConnection();

// Instância o objeto User com a conexão
$user = new User($pdo);

$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senha_digitada = trim($_POST['senha_atual']);
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmacao_senha'];

    // Define o ID do usuário (aqui, um valor fixo para teste)
    $usuario_id = 1;

    // Verifica a senha atual
    if ($user->checkPassword($usuario_id, $senha_digitada)) {
        // Verifica se as novas senhas coincidem
        if ($nova_senha === $confirmar_senha) {
            // Atualiza a senha
            if ($user->updatePassword($usuario_id, $nova_senha)) {
                $mensagem = "Senha alterada com sucesso!";
            } else {
                $mensagem = "Erro ao atualizar a senha. Tente novamente.";
            }
        } else {
            $mensagem = "A nova senha e a confirmação não coincidem. Tente novamente.";
        }
    } else {
        $mensagem = "A senha atual está incorreta. Tente novamente.";
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
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 400px; margin: 50px auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="password"] { width: 100%; padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"] { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
        .message { text-align: center; margin-top: 20px; font-weight: bold; }
        .success { color: #5bc0de; }
        .error { color: #d9534f; }
    </style>
</head>
<body>

<div class="container">
    <h2>Alterar Senha</h2>

    <?php if ($mensagem): ?>
        <div class="message <?php echo (strpos($mensagem, 'sucesso') !== false) ? 'success' : 'error'; ?>">
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>

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
