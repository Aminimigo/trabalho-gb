<?php
// Inclui as classes de banco de dados e projeto
include 'Database.php';
include 'Projeto.php';

// Conecta ao banco de dados
$database = new Database();
$db = $database->getConnection();

// Instancia a classe Projeto
$projeto = new Projeto($db);

// Recebe os dados do formulário
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$prazo = $_POST['prazo'];
$orcamento = $_POST['orcamento'];
$tipo = $_POST['tipo'];

// Verifica o tipo e determina a página de redirecionamento
if ($tipo === "projeto") {
    $paginaRedirecionamento = "pedidos-e-projetos.php";
} else {
    $paginaRedirecionamento = "pedidos-e-projetos.php";
}

// Tenta adicionar o projeto ao banco
if ($projeto->adicionarProjeto($titulo, $descricao, $prazo, $orcamento)) {
    // Redireciona para a página correta
    header("Location: $paginaRedirecionamento");
    exit();
} else {
    echo "Erro ao salvar o projeto.";
}

// Fecha a conexão com o banco
$db = null;
?>
