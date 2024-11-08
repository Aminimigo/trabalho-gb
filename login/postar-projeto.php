<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postar Projeto ou Pedido</title>
    <style>
        /* Estilo básico para a página */
        body {
            background-color: #f8bbd0;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .formulario {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 500px;
        }

        .formulario h2 {
            text-align: center;
            color: #333;
        }

        .formulario label {
            color: #555;
            margin: 10px 0;
            display: block;
        }

        .formulario input[type="text"],
        .formulario input[type="number"],
        .formulario textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .formulario select,
        .formulario button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .formulario button {
            background-color: #ff4d94;
            color: white;
            font-size: 1em;
        }
    </style>
</head>
<body>

<div class="formulario">
    <h2>Postar Projeto ou Pedido</h2>
    <form action="salvar-projeto-pedido.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="4" required></textarea>

        <label for="prazo">Prazo (em dias):</label>
        <input type="number" id="prazo" name="prazo" required>

        <label for="orcamento">Orçamento (R$):</label>
        <input type="number" id="orcamento" name="orcamento" required>

        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo">
            <option value="projeto">Projeto</option>
            <option value="pedido">Pedido</option>
        </select>

        <button type="submit">Postar</button>
    </form>
</div>

</body>
</html>
