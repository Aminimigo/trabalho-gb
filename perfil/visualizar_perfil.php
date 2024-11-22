<?php
session_start();

// Verifica se o parâmetro 'id' foi passado na URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Incluir as classes de usuários e postagens
    include_once 'User.php';
    include_once 'Post.php';

    // Criar instâncias das classes
    $user = new User();
    $post = new Post();

    // Buscar informações do usuário
    $user_info = $user->getUserById($user_id);
    if (!$user_info) {
        echo "Usuário não encontrado!";
        exit;
    }

    // Buscar as postagens do usuário
    $posts = $post->getPostsByUserId($user_id);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?php echo htmlspecialchars($user_info['nome']); ?></title>
</head>
<body>

<h1>Perfil de <?php echo htmlspecialchars($user_info['nome']); ?></h1>
<p>Email: <?php echo htmlspecialchars($user_info['email']); ?></p>

<h2>Postagens</h2>
<ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <a href="postagem.php?id=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['titulo']); ?></a>
            <p><?php echo htmlspecialchars(substr($post['descricao'], 0, 100)); ?>...</p>
        </li>
    <?php endforeach; ?>
</ul>

<!-- Formulário para enviar mensagem -->
<h3>Enviar Mensagem</h3>
<form action="enviar_mensagem.php" method="POST">
    <input type="hidden" name="receiver_id" value="<?php echo $user_id; ?>">
    <textarea name="message" placeholder="Escreva sua mensagem..." required></textarea><br>
    <button type="submit">Enviar Mensagem</button>
</form>

</body>
</html>
