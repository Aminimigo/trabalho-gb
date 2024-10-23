<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CemFreela</title>
    <link rel="stylesheet" href="/CSS/estili-index.css">
    <meta name="description" content="CemFreela - Conecte-se com freelancers ou ofereça seus serviços de qualidade.">
    <meta name="keywords" content="freelancer, serviços, oferta, demanda, plataforma de trabalho, profissionais">
    <link rel="stylesheet" href="/CSS/estili-index.css">
</head>

<body>
    <header>
        <h1><a href="index.php">CemFreelas</a></h1>


        <form action="pesquisa.php" method="GET">
            <input type="text" name="query" placeholder="Digite sua pesquisa" required>
            <button type="submit">Pesquisar</button>
        </form>

        <span class="menu-icon" onclick="toggleMenu()">&#9776;</span>


        <nav>
            <ul class="menu">
            <li><a href="construct/cadastro.php">Cadastro</a></li>
                <li><a href="login/login.php">login</a></li>
                <li><a href="servicos.php">Serviços</a></li>
                <li><a href="sobre.php">Sobre Nós</a></li>
                <li><a href="contato.php">Contato</a></li>


            </ul>
        </nav>
    </header>

    <script>
        // Função para alternar a visibilidade do menu em telas pequenas
        function toggleMenu() {
            var menu = document.querySelector('.menu');
            menu.classList.toggle('active');
        }
    </script>
</body>

</html>
