<?php
session_start();
include '../db/DB.php'; // Incluir a classe DB
include_once '../db/projeto.php'; // Incluir a classe Projeto

// Verificar se o usuário está autenticado
if (!isset($_SESSION['usuario_email'])) {
    echo "<p>Você precisa estar logado para acessar esta página.</p>";
    exit;
}

try {
    // Corrigir a instância da classe DB
    $database = new DB();
    $conn = $database->connect();

    $projeto = new Projeto($conn);
    $projetos = $projeto->getProjetosPorUsuario($_SESSION['usuario_email']);
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
    <title>Meus Projetos</title>
    <style>
        body {
            background-color: #f0f8ff; /* Azul claro */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
        }
        .btn-editar, .btn-excluir, .btn-voltar {
            background-color: #6a5acd; /* Roxo claro */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }
        .btn-editar:hover, .btn-excluir:hover, .btn-voltar:hover {
            background-color: #483d8b; /* Roxo escuro */
        }
        .projeto {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 100%;
            max-width: 600px;
        }
        .projeto h3 {
            color: #333;
        }
        .projeto p {
            color: #555;
        }
    </style>
</head>
<body>

<h2>Meus Projetos</h2>

<a href="postar_projeto.php" class="btn-editar">Postar Novo Projeto</a>
<a href="../painel/painel_freelancer.php" class="btn-voltar">Voltar para a página inicial</a>

<!-- Exibindo os projetos do usuário -->
<?php if (count($projetos) > 0): ?>
    <?php foreach ($projetos as $projeto): ?>
        <div class="projeto">
            <h3><?php echo htmlspecialchars($projeto['nome_produto']); ?></h3>
            <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($projeto['descricao'])); ?></p>
            <p><strong>Valor:</strong> R$ <?php echo number_format((float)$projeto['valor'], 2, ',', '.'); ?></p>

            <!-- Links de edição e exclusão -->
            <a href="editar_projeto.php?id=<?php echo $projeto['id']; ?>" class="btn-editar">Editar</a>
            <a href="excluir_projeto.php?id=<?php echo $projeto['id']; ?>" class="btn-excluir">Excluir</a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Você ainda não postou nenhum projeto.</p>
<?php endif; ?>

</body>
</html>
