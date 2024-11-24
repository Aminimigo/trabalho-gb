<?php
session_start();
include 'header.php'; // Incluindo o cabeçalho
include_once '../db/Database.php'; // Incluir a classe Database
include_once '../db/Projeto.php'; // Incluir a classe Projeto

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_email'])) {
    echo "<p>Você precisa estar logado para acessar esta página.</p>";
    exit;
}

if (!isset($_GET['id'])) {
    echo "<p>Projeto não encontrado.</p>";
    exit;
}

$projeto_id = $_GET['id'];

try {
    $database = new Database();
    $conn = $database->getConnection();

    $projeto = new Projeto($conn);
    $projetoDetalhes = $projeto->getProjeto($projeto_id, $_SESSION['usuario_email']);

    if (!$projetoDetalhes) {
        echo "<p>Projeto não encontrado ou você não tem permissão para editá-lo.</p>";
        exit;
    }

    // Se o formulário for enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome_produto = htmlspecialchars($_POST['nome_produto']);
        $descricao = htmlspecialchars($_POST['descricao']);
        $valor = htmlspecialchars($_POST['valor']);

        // Atualizar o projeto no banco
        if ($projeto->updateProjeto($projeto_id, $nome_produto, $descricao, $valor)) {
            echo "<p style='color: green;'>Projeto atualizado com sucesso!</p>";
        } else {
            echo "<p style='color: red;'>Erro ao atualizar o projeto.</p>";
        }
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Projeto</title>
    <style>
        body {
            background-color: #f0f8ff;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;
        }

        h2 {
            font-size: 2em;
            color: #6a5acd;
            margin-bottom: 20px;
        }

        .form-editar {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .form-editar input, .form-editar textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .btn-editar {
            background-color: #6a5acd;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-editar:hover {
            background-color: #483d8b;
        }
    </style>
</head>
<body>

<h2>Editar Projeto</h2>

<form method="POST" class="form-editar">
    <label for="nome_produto">Nome do Produto:</label>
    <input type="text" name="nome_produto" value="<?php echo htmlspecialchars($projetoDetalhes['nome_produto']); ?>" required>

    <label for="descricao">Descrição:</label>
    <textarea name="descricao" required><?php echo htmlspecialchars($projetoDetalhes['descricao']); ?></textarea>

    <label for="valor">Valor:</label>
    <input type="text" name="valor" value="<?php echo htmlspecialchars($projetoDetalhes['valor']); ?>" required>

    <button type="submit" class="btn-editar">Atualizar Projeto</button>
</form>

<a href="meus_projetos.php" class="btn-voltar">Voltar para Meus Projetos</a>

</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn = null;
?>
