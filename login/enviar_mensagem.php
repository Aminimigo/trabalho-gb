<?php
require __DIR__."/conexao.php"; // Inclua sua conexão com o banco de dados

session_start(); // Inicie a sessão para acessar os dados do usuário logado
$id_remetente = $_SESSION['usuario_id']; // Supondo que você armazena o ID do usuário na sessão

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destinatario = $_POST['destinatario'];
    $mensagem = $_POST['mensagem'];

    // Certifique-se de que o destinatário existe (opcional)
    $query_destinatario = "SELECT id FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($query_destinatario);
    $stmt->bind_param('s', $destinatario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_destinatario = $row['id'];

        // Insira a mensagem no banco de dados
        $query_mensagem = "INSERT INTO mensagens (id_remetente, id_destinatario, mensagem) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query_mensagem);
        $stmt->bind_param('iis', $id_remetente, $id_destinatario, $mensagem);
        
        if ($stmt->execute()) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Erro ao enviar a mensagem.";
        }
    } else {
        echo "Destinatário não encontrado.";
    }
}
?>
