<?php
// Incluir a classe de banco de dados e a classe Usuario
include '../db/Database.php';
include 'Usuario.php';

// Criar a instância da conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Instanciar a classe Usuario
$usuario = new Usuario($db);

// Verificar se o parâmetro 'id' foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Tentar deletar o usuário
    if ($usuario->deletarUsuario($id)) {
        echo "Usuário deletado com sucesso!";
        header('Location: listar_usuarios.php'); // Redireciona de volta para a listagem
        exit();
    } else {
        echo "Erro ao deletar o usuário!";
    }
} else {
    echo "ID do usuário não fornecido!";
}
?>
