<?php
include 'pessoa.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];

    $usuario = new Pessoa($codigo, $nome, $nascimento);

    echo "Usuário cadastrado com sucesso!";
}
?>
