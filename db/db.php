<?php
// Configurações de conexão com o banco de dados
$host = 'localhost'; // ou o nome do seu host
$dbname = 'login'; // Substitua com o nome do seu banco de dados
$username = 'root'; // Substitua com seu nome de usuário
$password = ''; // Substitua com sua senha

try {
    // Criar uma instância PDO para conectar ao banco de dados
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Configurar o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Opcional: definir o charset para UTF-8
    $conn->exec("SET NAMES 'utf8'");
    
} catch (PDOException $e) {
    // Se houver erro na conexão, exibe a mensagem de erro
    die("Falha na conexão: " . $e->getMessage());
}
?>
