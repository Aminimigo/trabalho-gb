<?php
include 'header.php'; // Incluindo o cabeçalho

// Conectar ao banco de dados (recomendo o uso de PDO para uma abordagem mais segura)
try {
    $conn = new PDO('mysql:host=localhost;dbname=login', 'root', ''); // Ajuste conforme seu banco
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    die();
}

// Consulta SQL
$sql = "SELECT titulo, descricao FROM projetos";  // Certifique-se de que 'titulo' e 'descricao' existam na tabela
$stmt = $conn->prepare($sql);
$stmt->execute();

// Recupera os resultados
$projetos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>
    <style>
       /* Estilo geral da página */
body {
    background-color: #f8bbd0;
    font-family: Arial, Helvetica, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0px;
    margin: 0;
}

/* Caixa do projeto */
.caixa-projeto {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    padding: 20px;
    width: 100%;  /* Faz a caixa ocupar 100% da largura */
    max-width: 100%;  /* Remove qualquer limite de largura */
    margin: 10px 0;
    box-sizing: border-box; /* Inclui o padding no cálculo da largura */
}

.caixa-projeto h3 {
    font-size: 1.5em;
    color: #333;
}

.caixa-projeto p {
    color: #555;
    margin: 5px 0;
}

.caixa-projeto .detalhes {
    font-weight: bold;
    color: #ff4d94;
    margin-top: 20px; /* Ajustado para um espaçamento apropriado */
}

/* Estilo para o cabeçalho */
h2 {
    font-size: 2em;
    color: #ff4d94;
    margin-bottom: 20px;
    text-align: center;
    width: 100%;
}

/* Responsividade para telas pequenas */
@media (max-width: 768px) {
    /* Garantir que a caixa de projeto tenha um padding maior em dispositivos móveis */
    .caixa-projeto {
        padding: 15px;
    }

    /* Ajustar o tamanho do título */
    h2 {
        font-size: 1.5em;
    }
}

    </style>
</head>
<body>

    <h2>Projetos</h2>
    
    <!-- Exibindo os projetos -->
    <?php if (count($projetos) > 0): ?>
        <?php foreach ($projetos as $projeto): ?>
            <div class="caixa-projeto">
                <h3><?php echo htmlspecialchars($projeto['titulo']); ?></h3>
                <p><?php echo htmlspecialchars($projeto['descricao']); ?></p>
                <p class="detalhes">Detalhes do Projeto</p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum projeto encontrado.</p>
    <?php endif; ?>


</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn = null;
?>
