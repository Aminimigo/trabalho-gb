<?php
// Inclui as classes de banco de dados e usuário
include 'Database.php';
include 'Usuario.php';

// Verifica se o e-mail foi passado na URL
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Cria a instância da conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Instancia a classe Usuario
    $usuario = new Usuario($db);

    // Tenta excluir o usuário
    if ($usuario->deletarUsuario($email)) {
        echo "Usuário deletado com sucesso!";
        // Redireciona para a página de listagem
        header("Location: listar_usuarios.php");
        exit();
    } else {
        echo "Erro ao excluir o usuário!";
    }

    // Fecha a conexão
    $db = null;
} else {
    echo "Email não fornecido!";
}
?>
