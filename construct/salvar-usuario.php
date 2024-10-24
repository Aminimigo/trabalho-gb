<?php
include 'pessoa.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $dataNasci = $_POST['dataNasci'];
    $sobre = $_POST['sobre'];

    $usuario = new Pessoa($email, $nome, $senha, $dataNasci, $sobre);

    echo "Usuário cadastrado com sucesso!";
}
?>
