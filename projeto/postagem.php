<?php
session_start();
include('Database.php');
include('Post.php');

// Criar uma instância de conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

// Criar uma instância da classe Post
$post = new Post($conn);

// Verificar se o parâmetro 'id' foi passado na URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Buscar informações da postagem
    $post_data = $post->getPostById($post_id);

    if (!$post_data) {
        echo "Postagem não encontrada!";
        exit;
    }
} else {
    echo "ID da postagem não especificado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post_data['titulo']); ?></title>
</head>
<body>

<h1><?php echo htmlspecialchars($post_data['titulo']); ?></h1>
<p><strong>Autor: </strong><?php echo htmlspecialchars($post_data['author_name']); ?></p>
<p><strong>Publicado em: </strong><?php echo htmlspecialchars($post_data['created_at']); ?></p>
<p><?php echo nl2br(htmlspecialchars($post_data['descricao'])); ?></p>

</body>
</html>
