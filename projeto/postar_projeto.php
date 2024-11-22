<?php 
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_email'])) {
    echo "<p>Você precisa estar logado para acessar esta página.</p>";
    exit;
}

include('../db/Db.php');
include('../db/projeto.php');

// Criar uma instância de conexão com o banco de dados
$database = new DB();
$conn = $database->connect();  // Use 'connect()' em vez de 'getConnection()'


// Criar uma instância da classe Project
$projeto = new projeto($conn);

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $nome_produto = htmlspecialchars($_POST['nome_produto']);
    $descricao = htmlspecialchars($_POST['descricao']);
    $valor = htmlspecialchars($_POST['valor']);
    $foto = ''; // Variável para armazenar o caminho da foto

    // Lógica de upload de imagem
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Pasta para salvar as imagens
        $uploadFile = $uploadDir . basename($_FILES['foto']['name']);

        // Mover o arquivo enviado para o diretório especificado
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadFile)) {
            $foto = $uploadFile; // Salvar o caminho do arquivo na variável
        } else {
            echo "<p>Falha ao fazer o upload da imagem.</p>";
        }
    }

    // Inserir o novo projeto no banco de dados
    if ($project->createProject($nome_produto, $descricao, $valor, $_SESSION['usuario_email'], $foto)) {
        // Redirecionar para "Meus Projetos" após o envio
        header("Location: meus_projetos.php");
        exit;
    } else {
        echo "<p>Erro ao inserir o projeto.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postar Projeto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #6a5acd;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            margin-top: 15px;
            cursor: pointer;
        }
        button:hover {
            background-color: #483d8b;
        }
        a {
            margin-top: 10px;
            display: inline-block;
            color: #6a5acd;
            text-decoration: none;
        }
    </style>
</head>
<body>

<h2>Postar Novo Projeto</h2>

<form method="POST" enctype="multipart/form-data">
    <label for="nome_produto">Nome do Produto:</label>
    <input type="text" name="nome_produto" required>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" required></textarea>

    <label for="valor">Valor:</label>
    <input type="text" name="valor" required>

    <label for="foto">Foto do Produto (opcional):</label>
    <input type="file" name="foto">

    <button type="submit">Postar Projeto</button>
</form>

<a href="meus_projetos.php">Voltar para Meus Projetos</a>

</body>
</html>
