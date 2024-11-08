<?php
// Incluir a lógica de conexão e a consulta ao banco de dados para carregar as informações do perfil.

session_start();
if (!isset($_SESSION['usuario_email'])) {
    header('Location: login.php');
    exit();
}

include '../db/db.php';  // Conexão com o banco de dados

// Recuperar os dados do usuário
$email_usuario = $_SESSION['usuario_email'];
$stmt = $conn->prepare("SELECT nome, email, foto_perfil, redes_sociais, portfolio, datanascimento, telefone FROM usuarios WHERE email = :email");
$stmt->bindParam(':email', $email_usuario);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificar se os dados estão presentes
$nome_usuario = isset($usuario['nome']) ? $usuario['nome'] : '';
$email_usuario = isset($usuario['email']) ? $usuario['email'] : '';
$foto_perfil = isset($usuario['foto_perfil']) ? $usuario['foto_perfil'] : 'uploads/fotos_perfil/default-avatar.png';
$redes_sociais = isset($usuario['redes_sociais']) ? $usuario['redes_sociais'] : '';
$portfolio = isset($usuario['portfolio']) ? $usuario['portfolio'] : '';
$datanascimento = isset($usuario['datanascimento']) ? $usuario['datanascimento'] : '';
$telefone = isset($usuario['telefone']) ? $usuario['telefone'] : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - CemFreelas</title>
    <style>
        /* CSS Integrado */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        /* Cabeçalho */
        header {
            background-color: #ff80bf;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }

        header .logo h1 {
            margin: 0;
            font-size: 24px;
        }

        header .logo a {
            text-decoration: none;
            color: white;
        }

        header .logo a:hover {
            text-decoration: underline;
        }

        /* Formulário */
        .section {
            padding: 30px 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .field {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .input, .button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .input[type="file"] {
            border: none;
        }

        .button {
            background-color: #ff4d94;
            color: white;
            cursor: pointer;
        }

        .button:hover {
            background-color: #e04074;
        }

        .notification {
            margin-top: 20px;
            background-color: #e6ffe6;
            color: #4caf50;
        }

        .img-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .img-container img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }

        /* Responsividade */
        @media screen and (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <!-- Cabeçalho -->
    <header>
        <div class="logo">
            <a href="painel.php"><h1>CemFreelas</h1></a>
        </div>
    </header>

    <!-- Conteúdo principal -->
    <section class="section">
        <div class="container">
            <h2 class="title">Editar Perfil</h2>

            <?php if (isset($mensagem)) { ?>
                <div class="notification">
                    <?php echo $mensagem; ?>
                </div>
            <?php } ?>

            <form action="editar-perfil.php" method="POST" enctype="multipart/form-data">
                <div class="field">
                    <label class="label">Nome</label>
                    <div class="control">
                        <input class="input" type="text" name="nome" value="<?php echo htmlspecialchars($nome_usuario); ?>" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">E-mail</label>
                    <div class="control">
                        <input class="input" type="email" value="<?php echo htmlspecialchars($email_usuario); ?>" disabled>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Telefone</label>
                    <div class="control">
                        <input class="input" type="text" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" placeholder="(XX) XXXXX-XXXX">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Data de Nascimento</label>
                    <div class="control">
                        <input class="input" type="date" name="data_nascimento" value="<?php echo htmlspecialchars($datanascimento); ?>">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Instagram</label>
                    <div class="control">
                        <input class="input" type="text" name="instagram" value="<?php echo isset($redes_sociais['instagram']) ? htmlspecialchars($redes_sociais['instagram']) : ''; ?>" placeholder="Instagram">
                    </div>
                </div>

                <div class="field">
                    <label class="label">LinkedIn</label>
                    <div class="control">
                        <input class="input" type="text" name="linkedin" value="<?php echo isset($redes_sociais['linkedin']) ? htmlspecialchars($redes_sociais['linkedin']) : ''; ?>" placeholder="LinkedIn">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Facebook</label>
                    <div class="control">
                        <input class="input" type="text" name="facebook" value="<?php echo isset($redes_sociais['facebook']) ? htmlspecialchars($redes_sociais['facebook']) : ''; ?>" placeholder="Facebook">
                    </div>
                </div>

                <div class="field">
                    <label class="label">GitHub</label>
                    <div class="control">
                        <input class="input" type="text" name="github" value="<?php echo isset($redes_sociais['github']) ? htmlspecialchars($redes_sociais['github']) : ''; ?>" placeholder="GitHub">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Portfólio</label>
                    <div class="control">
                        <input class="input" type="text" name="portfolio" value="<?php echo htmlspecialchars($portfolio); ?>" placeholder="Link para o portfólio">
                    </div>
                </div>

                <div class="field">
                    <label class="label">Foto de Perfil</label>
                    <div class="control">
                        <input class="input" type="file" name="foto_perfil">
                    </div>
                    <div class="img-container">
                        <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de perfil">
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button class="button" type="submit">Salvar Alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="footer">
        <div class="content has-text-centered">
            <p>&copy; 2024 CemFreelas - Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
