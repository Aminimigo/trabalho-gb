<?php
session_start();
include '../db/Database.php'; // Incluir a classe Database
include '../db/Mensagem.php'; // Incluir a classe Mensagem

// Conectar ao banco de dados
$database = new Database();
$conn = $database->getConnection();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Verifica se o projeto_id foi passado na URL
if (isset($_GET['projeto_id'])) {
    $projeto_id = $_GET['projeto_id'];
} else {
    header('Location: index.php');
    exit;
}

// Processar a mensagem
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id']; // O destinatário pode ser determinado por outros meios, como um campo oculto no formulário
    $message = $_POST['message'];

    // Verificar se a mensagem foi enviada
    if (!empty($message)) {
        $mensagem = new Mensagem($conn);

        // Enviar a mensagem
        if ($mensagem->enviarMensagem($sender_id, $receiver_id, $projeto_id, $message)) {
            $_SESSION['message_sent'] = "Mensagem enviada com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao enviar a mensagem!";
        }
        header('Location: enviar_mensagem.php?projeto_id=' . $projeto_id);
        exit;
    } else {
        $_SESSION['error'] = "A mensagem não pode estar vazia!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mensagem</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>
<body>

<!-- Exibindo erro ou sucesso -->
<?php if (isset($_SESSION['message_sent'])): ?>
    <div class="notification is-success">
        <?php echo $_SESSION['message_sent']; unset($_SESSION['message_sent']); ?>
    </div>
<?php elseif (isset($_SESSION['error'])): ?>
    <div class="notification is-danger">
        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="container">
    <h2 class="title">Enviar Mensagem</h2>

    <form method="POST">
        <div class="field">
            <label class="label" for="receiver_id">ID do Destinatário:</label>
            <div class="control">
                <input class="input" type="number" id="receiver_id" name="receiver_id" required>
            </div>
        </div>

        <div class="field">
            <label class="label" for="message">Mensagem:</label>
            <div class="control">
                <textarea class="textarea" id="message" name="message" rows="4" required></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-primary" type="submit">Enviar Mensagem</button>
            </div>
        </div>
    </form>
</div>

</body>
</html>
