<?php




var_dump($alunoExiste);


if (!isset($_POST['usuario']) || !isset($_POST['senha'])) {
    header("Location:./login.php");
}

if ($_POST['usuario'] == "") {
    die("Campo usuário está vazio!");
}
if ($_POST['senha'] == "") {
    die("Campo senha está vazio!");
}

if (empty($alunoExiste)) {
    die("Este usuário não existe!");
}


echo "Usuário validado!";