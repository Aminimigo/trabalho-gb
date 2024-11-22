<?php
session_start();
include 'header.php'; // Incluir o cabeçalho
include_once '../db/Database.php'; // Incluir a classe Database
include_once '../db/Produto.php'; // Incluir a classe Produto

// Conectar ao banco de dados
$database = new Database();
$conn = $database->getConnection();

// Verificar se o ID do produto foi passado na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_produto = $_GET['id']; // Pega o ID do produto da URL
} else {
    // Redireciona caso o ID não seja válido ou não tenha sido fornecido
    header("Location: painel.php"); // Ou qualquer outra página de erro
    exit();
}

$produto = new Produto($conn);
$produtoDetalhes = $produto->getDetalhes($id_produto);

if (!$produtoDetalhes) {
    // Caso o produto não seja encontrado, redireciona para a página inicial ou erro
    header("Location: painel.php"); // Ou qualquer outra página de erro
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto - CemFreelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"> <!-- Link do Bulma -->
</head>
<body>

<!-- Detalhes do Produto -->
<div class="container">
    <h2 class="title">Detalhes do Produto</h2>

    <!-- Exibindo os detalhes do produto -->
    <div class="box">
        <h3 class="title is-3"><?php echo htmlspecialchars($produtoDetalhes['nome_produto']); ?></h3>
        <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($produtoDetalhes['descricao'])); ?></p>

        <!-- Verificando se a chave 'valor' existe no array e convertendo para float -->
        <?php if (isset($produtoDetalhes['valor'])): ?>
            <p><strong>Preço:</strong> R$ <?php echo number_format((float)$produtoDetalhes['valor'], 2, ',', '.'); ?></p>
        <?php else: ?>
            <p><strong>Preço:</strong> Não disponível</p>
        <?php endif; ?>

        <p><strong>Criado em:</strong> <?php echo date("d/m/Y", strtotime($produtoDetalhes['data_criacao'])); ?></p>

        <!-- Exemplo de exibição de mais informações (coloquei algumas colunas fictícias) -->
        <?php if (!empty($produtoDetalhes['categoria'])): ?>
            <p><strong>Categoria:</strong> <?php echo htmlspecialchars($produtoDetalhes['categoria']); ?></p>
        <?php endif; ?>

        <!-- Botão para voltar -->
        <a href="painel.php" class="button is-link">Voltar</a>
    </div>
</div>

</body>
</html>
