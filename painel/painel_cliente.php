<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    header("Location: ../header/login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}

// Incluir o arquivo de configuração
include '../db/Database.php'; // Certifique-se de que o caminho está correto


try {
    // Criar a conexão com o banco de dados usando as variáveis definidas no config.php
    $conn = new PDO("mysql:localhost=$localhost;login=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Falha na conexão com o banco de dados: " . $e->getMessage());
}

// O código restante para o painel do cliente aqui
$usuario = new Usuario($conn);

// Obter o e-mail do usuário da sessão
$email = $_SESSION['usuario_email'];

// Buscar os dados do usuário no banco de dados
$dadosUsuario = $usuario->getUserByEmail($email);

if ($dadosUsuario) {
    // Definir os dados do usuário
    $nome = htmlspecialchars($dadosUsuario['nome']);
    $fotoPerfil = htmlspecialchars($dadosUsuario['foto_perfil']);
    $redesSociais = htmlspecialchars($dadosUsuario['redes_sociais']);
    $portfolio = htmlspecialchars($dadosUsuario['portfolio']);
} else {
    // Se não encontrar o usuário, exibe uma mensagem de erro
    die("Erro: Usuário não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Cliente - CemFreelas</title>
    <link rel="stylesheet" href="../css/estilos.css"> <!-- Substitua pelo caminho correto do seu CSS -->
</head>
<body>
    <header>
        <h1>Bem-vindo, <?php echo $nome; ?>!</h1>
        <img src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil" width="100">
    </header>

    <div class="container">
        <h2>Suas informações</h2>
        <p><strong>Nome:</strong> <?php echo $nome; ?></p>
        <p><strong>Redes Sociais:</strong> <?php echo $redesSociais; ?></p>
        <p><strong>Portfólio:</strong> <a href="<?php echo $portfolio; ?>" target="_blank">Ver Portfólio</a></p>
    </div>
</body>
</html>
