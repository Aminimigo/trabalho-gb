<?php include 'header.php'; ?>
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

        /* Estilo específico para o campo de pesquisa */
        .container-pesquisa input[type="text"] {
            width: %; /* Largura maior para o campo de pesquisa */
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
