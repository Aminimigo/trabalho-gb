<?php

class Favorito {
    private $conn;
    private $table = 'favoritos';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function isFavoritado($projeto_id, $usuario_id) {
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE projeto_id = ? AND usuario_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$projeto_id, $usuario_id]);
        return $stmt->fetchColumn() > 0;
    }
}
?>
