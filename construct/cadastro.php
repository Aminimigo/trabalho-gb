<?php include 'pessoa.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/CSS/cadastro.css">
</head>
<body>
    <header>
        <a href="../index.php"><h1 class="title">CemFreelas</h1></a>
        <form action="pesquisa.php" method="GET">
            <input class="pesq" type="text" name="query" placeholder="Digite sua pesquisa" required>
            <button class="btn" type="submit">Pesquisar</button>
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
    <div class="box">
        <main class="caixa">
            <div class="centro">
                <h1>Cadastro</h1>
                <form class="form" action="salvar-usuario.php" method="POST">
                    
                    <label for="email">Email:</label><br>
                    <input id="email" type="text" placeholder="" name="email" required><br>
                    
                    <label for="nome">Nome:</label><br>
                    <input type="text" name="nome" required><br>
                    
                    <label for="senha">Senha:</label><br>
                    <input type="password" name="senha" required><br>

                    <label for="nascimento">Data de Nascimento:</label>
                    <input class="date" type="date" name="nascimento" required><br>

                    <div class="field">
                        <label class="label">Você é:</label>
                        <div class="control">
                            <div class="select">
                                <select name="tipo" required>
                                    <option value="" disabled selected hidden>Selecione</option>
                                    <option value="freelancer">Freelancer</option>
                                    <option value="contratante">Contratante</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="btct">
                        <button class="buton" type="submit">Cadastrar</button>
                    </div>
                    
                
                </form>
            </div>
            
        </main>
    </div>
    
</body>
</html>
