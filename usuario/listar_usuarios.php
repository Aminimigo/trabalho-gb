<?php
// Incluir a classe de banco de dados e a classe Usuario
include '../db/Database.php';
include 'Usuario.php';

// Criar a instância da conexão com o banco de dados
$database = new Database();
$db = $database->getConnection();

// Instanciar a classe Usuario
$usuario = new Usuario($db);

// Buscar todos os usuários
$usuarios = $usuario->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f7ff; /* Azul claro para o fundo da página */
            color: #333;
            margin: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        h1 {
            color: #0056b3; /* Azul escuro para o título */
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007acc; /* Azul vibrante para o cabeçalho */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f0f8ff; /* Azul muito claro para linhas alternadas */
        }

        tr:hover {
            background-color: #e0f2ff; /* Azul claro ao passar o mouse */
        }

        a {
            text-decoration: none;
            color: #0073e6; /* Azul médio para os links */
            font-weight: bold;
        }

        a:hover {
            color: #004a99; /* Azul escuro ao passar o mouse */
        }

        .back-link {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

    </style>
</head>
<body>

<h1>Lista de Usuários</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['id']; ?></td>
                <td><?php echo $usuario['nome']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td><?php echo $usuario['telefone']; ?></td>
                <td>
                    <a href="editar_usuario.php?email=<?php echo $usuario['email']; ?>">Editar</a> | 
                    <a href="deletar_usuario.php?email=<?php echo $usuario['email']; ?>">Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
