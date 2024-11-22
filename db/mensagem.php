<?php
namespace models;

use PDO;

class Mensagem {
    private $conn;
    private $table_name = "mensagens";

    // Propriedades
    public $id;
    public $nome;
    public $email;
    public $mensagem;
    public $data_envio;

    // Construtor
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para salvar mensagem
    public function salvarMensagem() {
        $query = "INSERT INTO " . $this->table_name . " (nome, email, mensagem) VALUES (:nome, :email, :mensagem)";
        $stmt = $this->conn->prepare($query);

        // Limpar dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mensagem = htmlspecialchars(strip_tags($this->mensagem));

        // Associar parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':mensagem', $this->mensagem);

        // Executar a consulta
        return $stmt->execute();
    }
}
?>
