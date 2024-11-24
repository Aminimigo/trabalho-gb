<?php
// Inclui as classes de banco de dados e usuário
include 'Database.php';
include 'Usuario.php';

// Verifica se o método é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $datanascimento = $_POST['datanascimento'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Conecta ao banco de dados
    $database = new Database();
    $db = $database->getConnection();

    // Instancia a classe Usuario
    $usuario = new Usuario($db);

    // Tenta cadastrar o usuário
    if ($usuario->cadastrarUsuario($nome, $email, $senha, $telefone, $datanascimento, $tipo_usuario)) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário!";
    }

    // Fecha a conexão
    $db = null;
}
?>

<!-- Formulário HTML para cadastro -->
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f0f8ff;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

form {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    padding: 20px 40px;
    width: 100%;
    max-width: 400px;
    text-align: center;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="date"],
select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #87cefa;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
}

input:focus,
select:focus {
    border-color: #4682b4;
    outline: none;
    box-shadow: 0 0 5px #4682b4;
}

button {
    background-color: #4682b4;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 10px 15px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #5a9bd3;
}

h1 {
    color: #4682b4;
    margin-bottom: 20px;
}

</style>

<form action="cadastro_usuario.php" method="POST">
    <h1>Cadastro de Usuário</h1>
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <input type="text" name="telefone" placeholder="Telefone">
    <input type="date" name="datanascimento">
    <select name="tipo_usuario">
        <option value="admin">Admin</option>
        <option value="cliente">Cliente</option>
        <option value="freelancer">Freelancer</option>
    </select>
    <button type="submit">Cadastrar</button>
</form>
