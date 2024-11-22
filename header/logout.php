<?php
// Incluir o arquivo de conexão com o banco de dados (se necessário)
require_once '../db/Usuario.php';

// Iniciar a sessão
session_start();

// Conectar ao banco de dados com PDO (se necessário)
$pdo = new PDO('mysql:host=localhost;dbname=login', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Criar o objeto Usuario
$usuario = new Usuario($pdo);

// Fazer logout: destruir as variáveis de sessão
session_unset(); // Limpa todas as variáveis de sessão
session_destroy(); // Destrói a sessão

// Redirecionar para a página de login (ou painel)
header("Location: ../painel/painel.php");
exit();
?>
