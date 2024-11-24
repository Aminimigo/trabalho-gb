<?php
// Iniciar a sessão e verificar o usuário
session_start();
if (!isset($_SESSION['usuario_email'])) {
    echo "
    <div class='alerta'>
        <i class='fas fa-exclamation-triangle'></i>
        <span>Você precisa estar logado para acessar esta página.</span>
    </div>
    ";
    exit;
}

// Incluir os arquivos de banco de dados e classes
include '../db/db.php';
include '../db/Projeto.php';
include '../db/Favorito.php';

$usuario_id = 1; // O ID do usuário deve ser dinâmico, você pode pegá-lo da sessão

// Instanciar a classe Database e fazer a conexão
$db = new DB();
$conn = $db->connect(); // Usar o método connect para obter a conexão

// Instanciar as classes usando a conexão correta
$projetoObj = new Projeto($conn);
$favoritoObj = new Favorito($conn);

// Recuperar os projetos postados
$projetos = $projetoObj->getProjetos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos Postados</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Estilos do CSS */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .alerta {
            display: flex;
            align-items: center;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Roboto', sans-serif;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .alerta i {
            font-size: 24px;
            margin-right: 10px;
        }

        .alerta span {
            font-size: 16px;
            font-weight: 500;
        }

        .caixa-projeto {
            background-color: #fff;
            padding: 20px;
            margin: 15px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .caixa-projeto h3 {
            font-size: 24px;
            color: #333;
        }

        .caixa-projeto p {
            font-size: 16px;
            color: #666;
        }

        .caixa-projeto img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
        }

        .caixa-projeto .btn-postar,
        .caixa-projeto .btn-detalhes,
        .caixa-projeto .btn-carrinho,
        .caixa-projeto .btn-mensagem {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            background-color: #4a90e2;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .caixa-projeto .btn-postar {
            background-color: #28a745;
        }

        .caixa-projeto .btn-detalhes:hover,
        .caixa-projeto .btn-carrinho:hover,
        .caixa-projeto .btn-mensagem:hover {
            background-color: #007bff;
        }

        .caixa-projeto .btn-postar:hover {
            background-color: #218838;
        }

        h2 {
            color: #333;
            font-size: 28px;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<?php
// Caso o usuário não esteja logado, a mensagem será exibida
if (!isset($_SESSION['usuario_email'])) {
    echo "
    <div class='alerta'>
        <i class='fas fa-exclamation-triangle'></i>
        <span>Você precisa estar logado para acessar esta página.</span>
    </div>
    ";
    exit;
}
?>

<a href="postar_projeto.php" class="btn-postar">Postar Novo Projeto</a>

<h2>Projetos Postados</h2>

<?php if (count($projetos) > 0): ?>
    <?php foreach ($projetos as $projeto): ?>
        <?php 
            // Verificar se o projeto foi favoritado
            $favoritado = $favoritoObj->isFavoritado($projeto['projeto_id'], $usuario_id);
        ?>
        <div class="caixa-projeto">
            <h3><?php echo htmlspecialchars($projeto['nome_produto']); ?></h3>
            <p><?php echo htmlspecialchars($projeto['descricao']); ?></p>
            <img src="<?php echo htmlspecialchars($projeto['foto']); ?>" alt="Imagem do projeto">
            <p>Valor: R$ <?php echo number_format($projeto['valor'], 2, ',', '.'); ?></p>
            <a href="detalhes_projeto.php?projeto_id=<?php echo $projeto['projeto_id']; ?>" class="btn-detalhes">Ver Detalhes</a>
            <a href="comprar_projeto.php?projeto_id=<?php echo $projeto['projeto_id']; ?>" class="btn-carrinho">
                <i class="fas fa-shopping-cart"></i> 
            </a>
            <a href="enviar_mensagem.php?projeto_id=<?php echo $projeto['projeto_id']; ?>" class="btn-mensagem">
                <i class="fas fa-comment-alt"></i> Enviar Mensagem
            </a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Nenhum projeto postado ainda.</p>
<?php endif; ?>

</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$db = null;
?>  
