<?php include_once '../db/db.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Bem-vindo ao Meu Site Freelancer</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
    <style>
     /* Corpo da página */
body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to right, #f1c6d3, #d0e4f4); /* Gradiente suave em tons pastel (rosas e azuis claros) */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    color: #333333; /* Cor do texto principal */
}

/* Container principal */
.container {
    background: #ffffff; /* Fundo branco para destacar os elementos */
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombras sutis para sofisticação */
    text-align: center;
    width: 100%;
    max-width: 450px; /* Limita a largura para não ficar muito largo */
}

/* Título principal */
h1 {
    font-size: 28px;
    font-weight: bold;
    color: #2c3e50; /* Cor mais escura para o título */
    margin-bottom: 30px;
}

/* Links transformados em botões */
a {
    display: block;
    background-color: #f7b7d9; /* Cor rosa pastel suave para os botões */
    color: white;
    text-align: center;
    text-decoration: none;
    padding: 15px 25px;
    margin: 10px 0;
    border-radius: 25px;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s ease; /* Efeito suave ao passar o mouse */
    width: 60%;
    margin-left: auto;
    margin-right: auto;
}

/* Efeito ao passar o mouse sobre os botões */
a:hover {
    background-color: #f4a6c7; /* Rosa pastel mais forte ao passar o mouse */
    transform: translateY(-5px); /* Leve elevação ao passar o mouse */
}

/* Ajustes de layout e responsividade */
@media screen and (max-width: 768px) {
    h1 {
        font-size: 24px;
    }
    a {
        width: 80%; /* Botões ficam maiores em telas menores */
    }
}

    </style>
<body class="index">
    <div class="container">
        <h1>Bem-vindo ao Meu Site Freelancer!</h1>
        <!-- Links transformados em botões -->
        <a href="login.php">Login</a>
        <a href="cadastro.php">Cadastrar</a>
    </div>
</body>
</html>
