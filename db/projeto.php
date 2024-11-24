<?php

class Projeto {
    private $conn;

    // Construtor
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para criar um novo projeto
    public function createProject($nome_produto, $descricao, $valor, $usuario_email, $foto) {
        $query = "INSERT INTO projetos (nome_produto, descricao, valor, usuario_email, foto) 
                  VALUES (:nome_produto, :descricao, :valor, :usuario_email, :foto)";
        
        $stmt = $this->conn->prepare($query);

        // Vinculando os parâmetros
        $stmt->bindParam(':nome_produto', $nome_produto);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':usuario_email', $usuario_email); 
        $stmt->bindParam(':foto', $foto);

        // Executando a consulta
        if ($stmt->execute()) {
            return true; // Projeto inserido com sucesso
        } else {
            return false; // Erro ao inserir o projeto
        }
    }

    // Método para buscar projetos por email de usuário
    public function getProjetosPorUsuario($usuario_email) {
        $query = "SELECT * FROM projetos WHERE usuario_email = :usuario_email";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_email', $usuario_email);
        
        $stmt->execute();

        // Retorna os resultados como um array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
