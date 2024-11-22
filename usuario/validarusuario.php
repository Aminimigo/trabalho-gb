<?php

class ValidarUsuario {
    private $pdo;

    public function __construct() {
        // Requer a classe de conexão com o banco de dados
        require __DIR__ . "/../Database/Conectar.php";
        $this->pdo = $banco;
    }

    // Método para verificar se o usuário existe e a senha está correta
    public function verificarSeExiste($usuario, $senha) {
        // Preparar a consulta SQL para buscar o usuário no banco de dados
        $sql = "SELECT * FROM usuarios WHERE nome = :u";  // Considerando que a busca é pelo 'nome'
        $comando = $this->pdo->prepare($sql);
        $comando->bindValue("u", $usuario);
        $comando->execute();

        // Recuperar os dados do usuário
        $usuarioEncontrado = $comando->fetch(PDO::FETCH_ASSOC);

        if ($usuarioEncontrado) {
            // Verificar se a senha fornecida corresponde ao hash armazenado no banco de dados
            if (password_verify($senha, $usuarioEncontrado['senha'])) {
                // Senha correta, retorna os dados do usuário
                return $usuarioEncontrado;
            } else {
                // Senha incorreta
                return false;
            }
        }

        // Usuário não encontrado
        return false;
    }
}
?>
