<?php
$mensagem = "";

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletando os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cartao_numero = $_POST['cartao_numero'];
    $data_validade = $_POST['data_validade'];
    $cvv = $_POST['cvv'];

    // Incluir as classes de conexão e processamento de pagamento
    include_once 'Database.php'; // Incluir a classe Database
    include_once 'Pagamento.php'; // Incluir a classe Pagamento

    try {
        // Criar a conexão com o banco de dados
        $database = new Database();
        $conn = $database->getConnection();

        // Criar o objeto Pagamento e processar o pagamento
        $pagamento = new Pagamento($conn);
        $sucesso = $pagamento->processarPagamento($nome, $email, $cartao_numero, $data_validade, $cvv);
        
        if ($sucesso) {
            $mensagem = "Pagamento processado com sucesso!";
        } else {
            $mensagem = "Erro ao processar o pagamento. Tente novamente.";
        }
    } catch (PDOException $e) {
        $mensagem = "Erro de conexão: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
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

        input[type="text"], input[type="email"], input[type="password"], input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
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
    <h2>Realizar Pagamento</h2>

    <!-- Mensagem de erro ou sucesso -->
    <?php if ($mensagem): ?>
        <div class="message <?php echo (strpos($mensagem, 'sucesso') !== false) ? 'success' : 'error'; ?>">
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>

    <!-- Formulário de pagamento -->
    <form action="pagamento.php" method="POST">
        <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input type="text" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="cartao_numero">Número do Cartão</label>
            <input type="text" id="cartao_numero" name="cartao_numero" maxlength="16" required>
        </div>

        <div class="form-group">
            <label for="data_validade">Data de Validade (MM/AA)</label>
            <input type="text" id="data_validade" name="data_validade" maxlength="5" placeholder="MM/AA" required>
        </div>

        <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="number" id="cvv" name="cvv" maxlength="3" required>
        </div>

        <input type="submit" value="Pagar">
    </form>
</div>

</body>
</html>
