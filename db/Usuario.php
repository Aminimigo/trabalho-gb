<?php
class Usuario {
    private $conn;
    private $table = 'usuarios';  // Supondo que o nome da tabela seja 'usuarios'

    // Definindo o construtor para a conexão com o banco
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para obter os dados do usuário com base no e-mail
    public function getUsuarioByEmail($email) {
        // Query SQL para buscar todos os dados necessários do usuário
        $query = "SELECT nome, email, foto_perfil, redes_sociais, portfolio FROM " . $this->table . " WHERE email = :email LIMIT 1";

        // Preparando a query
        $stmt = $this->conn->prepare($query);

        // Bindando o parâmetro de email
        $stmt->bindParam(':email', $email);

        // Executando a query
        $stmt->execute();

        // Retorna o resultado
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
