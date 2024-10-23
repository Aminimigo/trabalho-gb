<?php include 'pessoa.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/CSS/cadastro.css"> <!-- Certifique-se de que o caminho está correto -->
</head>
<body>
    <header>
        <a href="../index.php"><h1>CemFreelas</h1></a>
        <form action="pesquisa.php" method="GET">
            <input type="text" name="query" placeholder="Digite sua pesquisa" required>
            <button type="submit">Pesquisar</button>
        </form>
        <nav>
            <ul class="menu">
            <li><a href="construct/cadastro.php">Cadastro</a></li>
                <li><a href="../login/index.php">login</a></li>
                <li><a href="servicos.php">Serviços</a></li>
                <li><a href="sobre.php">Sobre Nós</a></li>
                <li><a href="contato.php">Contato</a></li>
            </ul>
        </nav>
    </header>
    <main class="caixa">
        <h1>Cadastro de Freelancer</h1>
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
