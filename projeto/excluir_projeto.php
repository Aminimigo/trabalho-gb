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
    
    // Excluir o projeto
    if ($projeto->excluirProjeto($projeto_id, $_SESSION['usuario_email'])) {
        echo "<p>Projeto excluído com sucesso!</p>";
    } else {
        echo "<p>Erro ao excluir o projeto.</p>";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}
?>

<a href="meus_projetos.php" class="btn-voltar">Voltar para Meus Projetos</a>
