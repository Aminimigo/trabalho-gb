<?php
session_start();
include '../db/db.php';


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        h1 {
            color: #2c3e50;
        }
        .menu {
            margin-top: 20px;
            display: flex;
            gap: 20px;
        }
        .menu a {
            text-decoration: none;
            color: #ffffff;
            background-color: #3498db;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .menu a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Painel de Administração</h1>
    <div class="menu">
        <a href="listar_usuarios.php">Listar Usuários</a>
        <a href="criar_usuario.php">Cadastrar Usuário</a>
        <a href="editar_usuario.php?email=usuario@example.com">Editar Usuário</a>
    </div>
</body>
</html>
