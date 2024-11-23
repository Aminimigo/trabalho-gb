<?php
// Iniciar a sessão
session_start();

// Incluir as classes
include_once 'Database.php';
include_once 'Projeto.php';
include_once 'Usuario.php';

// Criar instância da classe de banco de dados e conectar
$database = new Database();
$conn = $database->connect();

// Obter o termo de busca
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Verificar se o usuário está logado
$usuario_nome = 'Visitante';
if (isset($_SESSION['usuario_email'])) {
    $usuario_email = $_SESSION['usuario_    email'];
    $usuario = new Usuario($conn);
    $usuario_nome = $usuario->obterNomePorEmail($usuario_email);
}

// Buscar os projetos
$projeto = new Projeto($conn);
$resultados = [];
if ($query) {
    $resultados = $projeto->buscarProjetos($query);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Pesquisa - CemFreelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <style>
        /* Estilos personalizados */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            padding-top: 0px;
        }
        /* Restante do CSS */
    </style>
</head>

<body>
    <header>
        <!-- Conteúdo do cabeçalho -->
    </header>

    <div class="container">
        <h2 class="title">Resultados para: "<?php echo htmlspecialchars($query); ?>"</h2>

        <?php if (count($resultados) > 0): ?>
            <div class="columns is-multiline">
                <?php foreach ($resultados as $projeto): ?>
                    <div class="column is-one-third">
                        <div class="box">
                            <h3 class="title is-5"><?php echo htmlspecialchars($projeto['nome_produto']); ?></h3>
                            <p><?php echo htmlspecialchars($projeto['descricao']); ?></p>
                            <a href="../login/detalhes.php?projeto_id=<?php echo $projeto['projeto_id']; ?>" class="button is-link">Ver detalhes</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="no-results">Nenhum resultado encontrado para "<?php echo htmlspecialchars($query); ?>"</p>
        <?php endif; ?>
    </div>
</body>
</html>