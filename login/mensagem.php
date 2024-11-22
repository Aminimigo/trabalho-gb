<?php
session_start();

// Incluir as classes
include 'header.php';
include 'db/Database.php';
include 'db/Mensagem.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");
    exit();
}

// Criar a instância da classe Database
$database = new Database();
$conn = $database->getConnection();

// Criar a instância da classe Mensagem
$mensagem = new Mensagem($conn);

// Variável para armazenar erros
$erro = '';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destinatario = trim($_POST['destinatario']);
    $mensagemTexto = trim($_POST['mensagem']);
    $sender_id = $_SESSION['usuario_id']; // ID do usuário logado

    // Verificar se os campos não estão vazios
    if (empty($destinatario) || empty($mensagemTexto)) {
        $erro = "O destinatário e a mensagem são obrigatórios!";
    } else {
        try {
            // Enviar a mensagem utilizando o método da classe Mensagem
            $mensagem->enviarMensagem($sender_id, $destinatario, $mensagemTexto);
            // Redirecionar após o envio
            header("Location: sucesso.php");
            exit();
        } catch (Exception $e) {
            $erro = "Erro ao enviar a mensagem: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" type="text/css" href="bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f8bbd0; /* Cor de fundo rosa claro */
            font-family: Arial, Helvetica, sans-serif;
        }

        .container-mensagens {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilo dos campos de entrada */
        input[type="text"], textarea {
            width: 95%; /* Ajusta a largura do campo de texto */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .container-pesquisa input[type="text"] {
            width: 100%;
        }

        .container-mensagens {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 99%;
        }

        input[type="destinatario"], input[type="mensagem"] {
            max-width: 300px;
            padding: 10px;
            margin: 10px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #ff3399;
            width: 9%;
        }
    </style>
</head>
<body>
    <div class="container-mensagens">
        <h2>Enviar Mensagem</h2>

        <!-- Exibindo mensagem de erro -->
        <?php if (!empty($erro)): ?>
            <p class="error"><?php echo $erro; ?></p>
        <?php endif; ?>

        <!-- Formulário de envio de mensagem -->
        <form action="enviar_mensagem.php" method="post">
            <label for="destinatario">Destinatário:</label>
            <input type="text" id="destinatario" name="destinatario" required>

            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="4" required></textarea>

            <button type="submit">Enviar Mensagem</button>
        </form>
    </div>
</body>
</html>
