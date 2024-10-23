<?php require __DIR__."/header.php"; ?>
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
    
    <div class="principal">
        <p>Bem-vindo ao CemFreelas!
            O lugar certo para quem quer oferecer ou encontrar serviços de qualidade!

            Se você é freelancer, aqui é o seu espaço para mostrar seu talento e fechar ótimos negócios. Nossa plataforma é fácil de usar e te ajuda a se conectar com clientes que realmente precisam do seu trabalho.

            Se você está precisando de uma mão para tirar seu projeto do papel, temos uma comunidade cheia de profissionais prontos para te ajudar! Encontre a pessoa ideal para o serviço e acompanhe tudo de forma prática e segura.

            Vem fazer parte dessa rede de gente talentosa e começar a realizar grandes parcerias!
        </p>
    </div>
</body>

</html>


