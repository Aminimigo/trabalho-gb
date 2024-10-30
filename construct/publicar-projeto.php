<?php require __DIR__."/../header.php";
include 'postar_projeto.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $nascimento = $_POST['nascimento'];

    $usuario = new Pessoa($email, $nome, $senha, $nascimento);

    echo "Usuário cadastrado com sucesso!";
}
?>
