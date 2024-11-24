<?php
session_start();
include '../db/Database.php';
include '../db/Usuario.php';

$database = new Database();
$conn = $database->getConnection();

$usuario = new Usuario($conn);

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($usuario->criar($nome, $email, $senha)) {
        $mensagem = "Usuário criado com sucesso!";
    } else {
        $mensagem = "Erro ao criar usuário! O email já pode estar em uso.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <h1>Cadastrar Usuário</h1>

    <!-- Exibe a mensagem de sucesso ou erro -->
    <?php if ($mensagem): ?>
        <div>
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>
        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
