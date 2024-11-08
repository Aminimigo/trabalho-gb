<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "login");

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Recebe os dados do formulário
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$prazo = $_POST['prazo'];
$orcamento = $_POST['orcamento'];
$tipo = $_POST['tipo'];

// Verifica o tipo e redireciona para a página correspondente
if ($tipo === "projeto") {
    $sql = "INSERT INTO projetos (titulo, descricao, prazo, orcamento) VALUES ('$titulo', '$descricao', '$prazo', '$orcamento')";
    $paginaRedirecionamento = "pedidos-e-projetos.php"; // Página onde todos os projetos são listados
} else {
    $sql = "INSERT INTO projetos (titulo, descricao, prazo, orcamento) VALUES ('$titulo', '$descricao', '$prazo', '$orcamento')";
    $paginaRedirecionamento = "pedidos-e-projetos.php"; // Página onde todos os pedidos são listados
}

// Executa o SQL e redireciona
if ($conn->query($sql) === TRUE) {
    header("Location: $paginaRedirecionamento");
    exit();
} else {
    echo "Erro ao salvar: " . $conn->error;
}

// Fecha a conexão
$conn->close();
?>
