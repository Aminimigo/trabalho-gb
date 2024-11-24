<?php
// Incluir o autoload
spl_autoload_register(function ($class) {
    $prefix = 'config\\';
    $base_dir = __DIR__ . '/';
    
    if (strpos($class, $prefix) === 0) {
        $relative_class = substr($class, strlen($prefix));
        $file = $base_dir . 'config/' . str_replace('\\', '/', $relative_class) . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

// Criar uma instância da classe de conexão
use config\Database;
use models\Usuario;
use models\Projeto;

// Conectar ao banco de dados
$database = new Database();
$conn = $database->getConnection();

// Recuperar o vendedor_id da URL
$vendedor_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$vendedor_id) {
    echo "<p>Vendedor não encontrado.</p>";
    exit;
}

// Instanciar a classe Usuario
$usuarioObj = new Usuario($conn);
if (!$usuarioObj->getUsuarioPorId($vendedor_id)) {
    echo "<p>Vendedor não encontrado.</p>";
    exit;
}

// Instanciar a classe Projeto
$projetoObj = new Projeto($conn);
$projetos = $projetoObj->getProjetosPorVendedor($vendedor_id);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Vendedor</title>

    <style>
        /* Estilo básico */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #4a90e2;
        }

        .perfil-vendedor {
            background-color: #ffffff;
            width: 80%;
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .perfil-vendedor h3 {
            color: #3f51b5;
            font-size: 1.8rem;
        }

        .perfil-vendedor p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #555;
        }

        .projetos-lista {
            margin-top: 30px;
        }

        .projeto {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .projeto h4 {
            font-size: 1.5rem;
            color: #4a90e2;
        }

        .projeto p {
            font-size: 1rem;
            color: #555;
        }

        .btn-contato {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #3f51b5;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }

        .btn-contato:hover {
            background-color: #303f9f;
        }
    </style>
</head>
<body>

<h2>Perfil do Vendedor</h2>

<div class="perfil-vendedor">
    <h3><?php echo htmlspecialchars($usuarioObj->nome); ?></h3>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($usuarioObj->email); ?></p>
    <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($usuarioObj->descricao)); ?></p>

    <a href="mensagem.php?id=<?php echo $vendedor_id; ?>" class="btn-contato">Enviar Mensagem</a>

    <div class="projetos-lista">
        <h3>Projetos de <?php echo htmlspecialchars($usuarioObj->nome); ?>:</h3>

        <?php if ($projetos): ?>
            <?php foreach ($projetos as $projeto): ?>
                <div class="projeto">
                    <h4><?php echo htmlspecialchars($projeto['nome_produto']); ?></h4>
                    <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($projeto['descricao'])); ?></p>
                    <p><strong>Valor:</strong> R$ <?php echo number_format($projeto['valor'], 2, ',', '.'); ?></p>
                    <a href="detalhes.php?nome_produto=<?php echo urlencode($projeto['nome_produto']); ?>" class="btn-contato">Ver Detalhes</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Este vendedor ainda não possui projetos publicados.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn = null;
?>
