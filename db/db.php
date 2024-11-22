<?php
class DB {
    private $host = 'localhost';  // Host do banco de dados
    private $dbname = 'login';  // Nome do banco de dados
    private $username = 'root';  // Usuário do banco de dados
    private $password = '';  // Senha do banco de dados
    private $conn;

    // Método para conectar ao banco de dados
    public function connect() {
        $this->conn = null;
        try {
            // Estabelece a conexão com o banco de dados
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            // Define o modo de erro para exceções
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
            die(); // Finaliza o script em caso de erro
        }
        return $this->conn;
    }
}
?>
