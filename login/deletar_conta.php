<?php
session_start();
include '../db/Database.php';
include '../db/Usuario.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$conn = $database->getConnection();
$usuario = new Usuario($conn);

// Recupera o e-mail do usuário logado
$email_usuario = $_SESSION['usuario_email'];
$mensagem = "";

// Se o formulário de confirmação de exclusão for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($usuario->excluirConta($email_usuario)) {
        // Destrói a sessão do usuário e redireciona para a página inicial
        session_destroy();
        header("Location: painel.php");
        exit();
    } else {
        $mensagem = "Erro ao excluir a conta.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Exclusão de Conta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>
    <section class="section">
        <div class="container">
            <h2 class="title">Confirmar Exclusão de Conta</h2>
            <p class="subtitle">Tem certeza que deseja excluir sua conta? Essa ação é irreversível.</p>

            <?php if ($mensagem): ?>
                <div class="notification is-danger">
                    <?php echo $mensagem; ?>
                </div>
            <?php endif; ?>

            <form action="deletar_conta.php" method="POST">
                <div class="buttons">
                    <button type="submit" class="button is-danger">Excluir Conta</button>
                    <a href="perfil.php" class="button is-light">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
