<?php
// Configurações de conexão com o banco de dados
$host = 'localhost'; // ou o nome do seu host
$dbname = 'login'; // Substitua com o nome do seu banco de dados
$username = 'root'; // Substitua com seu nome de usuário
$password = ''; // Substitua com sua senha

try {
    // Criar uma instância PDO para conectar ao banco de dados
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Configurar o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Opcional: definir o charset para UTF-8
    $conn->exec("SET NAMES 'utf8'");
    
} catch (PDOException $e) {
    // Se houver erro na conexão, exibe a mensagem de erro
    die("Falha na conexão: " . $e->getMessage());
}
?>

<?php
// Iniciar a sessão
session_start();

// Variável para armazenar erros
$erro = '';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $email = trim($_POST['email']);
    $senha = trim($_POST['password']);

    // Verificar se os campos não estão vazios
    if (empty($email) || empty($senha)) {
        $erro = "E-mail e senha são obrigatórios!";
    } else {
        try {
            // Aqui usamos a variável $conn corretamente para se referir à conexão PDO
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Se o e-mail for encontrado no banco de dados
            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                // Comparar diretamente a senha fornecida com a senha no banco de dados
                if ($senha === $usuario['senha']) {  // Comparação direta
                    // Armazenar informações do usuário na sessão
                    $_SESSION['usuario_email'] = $usuario['email'];
                    $_SESSION['usuario_id'] = $usuario['id'];

                    // Redirecionar para a página do painel ou dashboard
                    header("Location: painel.php");
                    exit();
                } else {
                    $erro = "Senha incorreta!";
                }
            } else {
                $erro = "E-mail não encontrado!";
            }
        } catch (PDOException $e) {
            // Caso ocorra algum erro na consulta
            $erro = "Erro ao acessar o banco de dados: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CemFreelas</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <!-- Exibindo mensagens de erro -->
        <?php if (!empty($erro)): ?>
            <p class="error"><?php echo $erro; ?></p>
        <?php endif; ?>

        <!-- Formulário de login -->
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="E-mail" required class="input-box">
            <input type="password" name="password" placeholder="Senha" required class="input-box">
            <button type="submit" class="button">Entrar</button>
        </form>

        <!-- Link para cadastro -->
        <p style="text-align: center; margin-top: 20px;">
            Ainda não tem uma conta? <a href="cadastro.php">Cadastre-se</a>
        </p>
    </div>

    <style>
        /* Estilo do fundo da página (gradiente externo) */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #d0e4f4, #f1c6d3); /* Gradiente suave entre azul claro e rosa claro (tons pastéis) */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Estilo da caixa de login (gradiente interno) */
        .container {
            background: #ffffff; /* Fundo branco para destacar os elementos */
            padding: 30px;
            border-radius: 15px; /* Bordas arredondadas */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Sombras sutis para sofisticação */
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #6c757d; /* Cor suave para o título */
        }

        .input-box {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 25px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            color: #333;
        }

        .input-box:focus {
            outline: none;
            border-color: #ffb3c6; /* Foco com uma cor de borda suave */
        }

        .button {
            width: 100%;
            padding: 12px;
            background-color: #ffb3c6; /* Cor pastel suave para o botão (rosa claro) */
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .button:hover {
            background-color: #ff80a0; /* Cor mais forte ao passar o mouse */
            transform: scale(1.05); /* Aumenta ligeiramente o botão */
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: center;
        }

        p {
            margin-top: 20px;
            color: #6c757d; /* Cor suave para o texto */
        }

        a {
            color: #ff4d94; /* Cor rosa suave para o link */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</body>
</html>
