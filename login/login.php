<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/CSS/estilo.css"> 
</head>
<body>
    <main>
        <h1>Cadastro</h1>
        <form action="salvar-usuario.php" method="POST">
            <label for="codigo">Código:</label>
            <input type="number" name="codigo" required><br>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" required><br>

            <label for="nascimento">Data de Nascimento:</label>
            <input type="date" name="nascimento" required><br>

            <div class="field">
                <label class="label">Você é:</label>
                <div class="control">
                    <div class="select">
                        <select name="tipo" required>
                            <option value="">Selecione</option>
                            <option value="freelancer">Freelancer</option>
                            <option value="contratante">Contratante</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit">Cadastrar</button>
        </form>
    </main>
</body>
</html>
