<?php
session_start();
$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['stripeToken'] ?? null;
    
    if (!$token) {
        $mensagem = "Erro: Nenhum token foi gerado para o pagamento.";
    } else {
        // Criar instância da classe Payment
        include_once 'Payment.php';
        $payment = new Payment();

        // Processar o pagamento
        $mensagem = $payment->processPayment($token, 5000, 'brl', 'Pagamento Teste');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Pagamento</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="payment-container">
        <h2>Realizar Pagamento</h2>

        <!-- Exibir mensagem de erro ou sucesso -->
        <?php if ($mensagem): ?>
            <p class="message <?php echo (strpos($mensagem, 'sucesso') !== false) ? 'success' : 'error'; ?>">
                <?php echo $mensagem; ?>
            </p>
        <?php endif; ?>

        <!-- Formulário de pagamento -->
        <form action="pagamento.php" method="POST" id="payment-form">
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" required class="input-field">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required class="input-field">
            </div>

            <div class="form-group">
                <label for="card-element">Detalhes do Cartão</label>
                <div id="card-element">
                    <!-- Stripe Element -->
                </div>

                <!-- Erros do Stripe -->
                <div id="card-errors" role="alert"></div>
            </div>

            <button type="submit" class="submit-btn">Pagar</button>
        </form>
    </div>

    <script>
        var stripe = Stripe('sua-chave-publica'); // Substitua pela sua chave pública
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        // Manipulador de erros do Stripe
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Enviar o token do cartão quando o formulário for submetido
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Exibir erro no cartão
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Incluir o token no formulário
                    var tokenInput = document.createElement('input');
                    tokenInput.type = 'hidden';
                    tokenInput.name = 'stripeToken';
                    tokenInput.value = result.token.id;
                    form.appendChild(tokenInput);

                    // Enviar o formulário para o servidor
                    form.submit();
                }
            });
        });
    </script>

    <style>
        /* Estilo geral da página */
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #A3C8FF, #C7E8FF); /* Gradiente suave de azul claro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Container do formulário de pagamento */
        .payment-container {
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

        /* Mensagens de sucesso e erro */
        .message {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .success {
            color: #28a745; /* Verde para sucesso */
        }

        .error {
            color: #dc3545; /* Vermelho para erro */
        }

        /* Erros do Stripe */
        #card-errors {
            color: red;
            font-size: 12px;
        }
    </style>
</body>
</html>
