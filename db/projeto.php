<?php
class Projeto {
    private $conn;
    private $table = 'projetos';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para buscar projetos por usuário
    public function getProjetosPorUsuario($usuario_email) {
        $query = "SELECT * FROM " . $this->table . " WHERE usuario_email = :usuario_email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_email', $usuario_email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
