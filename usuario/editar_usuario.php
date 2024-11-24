<?php
// Inclui as classes de banco de dados e usuário
include '../db/Database.php';
include 'Usuario.php';

// Cria a instância da conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Instancia a classe Usuario
$usuario = new Usuario($db);

// Verificar se o parâmetro 'email' foi passado pela URL
if (isset($_GET['email'])) {
    $usuario_email = $_GET['email'];

    // Consultar usuário com o email específico
    $usuarioInfo = $usuario->buscarUsuarioPorEmail($usuario_email);

    if (!$usuarioInfo) {
        echo "Usuário não encontrado!";
        exit();
    }
}

// Verificar se o formulário foi enviado para editar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coletar dados do formulário
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $datanascimento = $_POST['datanascimento'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Atualizar dados do usuário
    if ($usuario->editarUsuario($email, $nome, $telefone, $datanascimento, $tipo_usuario)) {
        echo "Usuário atualizado com sucesso!";
        // Redireciona para a página de listagem de usuários
        header("Location: listar_usuarios.php");
        exit();
    } else {
        echo "Erro ao atualizar o usuário.";
    }
}
?>

<form action="editar_usuario.php?email=<?php echo $usuario_email; ?>" method="POST">
    <input type="hidden" name="email" value="<?php echo $usuarioInfo['email']; ?>">

    <!-- Outros campos de dados do usuário -->
    <input type="text" name="nome" value="<?php echo $usuarioInfo['nome']; ?>" required>
    <input type="email" name="email" value="<?php echo $usuarioInfo['email']; ?>" required>
    <input type="text" name="telefone" value="<?php echo $usuarioInfo['telefone']; ?>">
    <input type="date" name="datanascimento" value="<?php echo $usuarioInfo['datanascimento']; ?>">
    <select name="tipo_usuario">
        <option value="admin" <?php if ($usuarioInfo['tipo_usuario'] == 'admin') echo 'selected'; ?>>Admin</option>
        <option value="cliente" <?php if ($usuarioInfo['tipo_usuario'] == 'cliente') echo 'selected'; ?>>Cliente</option>
        <option value="freelancer" <?php if ($usuarioInfo['tipo_usuario'] == 'freelancer') echo 'selected'; ?>>Freelancer</option>
    </select>
    <button type="submit">Atualizar</button>
</form>
