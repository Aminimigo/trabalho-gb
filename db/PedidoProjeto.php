<?php
class PedidoProjeto {
    private $conn;
    private $table = 'pedidos';  // Nome da tabela no banco de dados

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para buscar os pedidos
    public function getPedidos() {
        $query = "SELECT * FROM {$this->table} WHERE tipo = 'pedido'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar os projetos
    public function getProjetos() {
        $query = "SELECT * FROM {$this->table} WHERE tipo = 'projeto'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
