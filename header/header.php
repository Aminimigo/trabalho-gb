<?php 
// Verifica se o usuário está logado e recupera as informações da sessão
$usuario_logado = isset($_SESSION['nome']) && !empty($_SESSION['nome']);
$nome_usuario = $usuario_logado ? $_SESSION['nome'] : 'Visitante';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - CemFreelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <style>
        /* Estilos do cabeçalho */
        header {
            background: linear-gradient(135deg, #4a6fa5, #a8d0e6);
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
        }

        .logo h1 {
            font-size: 24px;
            margin: 0;
        }

        .logo a {
            text-decoration: none;
            color: white;
        }

        .barra-pesquisa {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 5px;
            border-radius: 20px;
            max-width: 300px;
            width: 100%;
        }

        .barra-pesquisa input {
            width: 100%;
            padding: 5px;
            border: none;
            outline: none;
        }

        .barra-pesquisa button {
            background-color: #4a6fa5;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        /* Menu Hambúrguer */
        .menu-burger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .menu-burger span {
            background: white;
            height: 3px;
            margin: 4px 0;
            width: 25px;
        }

        .nav-menu {
            display: flex;
            gap: 20px;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .nav-menu a:hover {
            text-decoration: underline;
        }

        /* Responsividade */
        @media screen and (max-width: 768px) {
            .nav-menu {
                display: none;
                flex-direction: column;
                background-color: #4a6fa5;
                position: absolute;
                top: 60px;
                right: 20px;
                width: 200px;
                padding: 10px;
                border-radius: 5px;
            }

            .nav-menu.active {
                display: flex;
            }

            .menu-burger {
                display: flex;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <a href="../painel/painel.php"><h1>CemFreelas</h1></a>
    </div>

    <form action="../login/pesquisar.php" method="get" class="barra-pesquisa">
        <input type="text" name="query" placeholder="Buscar...">
        <button type="submit">Pesquisar</button>
    </form>

    <!-- Menu Hambúrguer -->
    <div class="menu-burger" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- Menu de Navegação -->
    <nav class="nav-menu">
        <a href="../painel/painel.php">Home</a>
        <a href="../header/sobre.php">Sobre</a>
        <a href="../header/contato.php">Contato</a>
        <a href="../projeto/projetos.php">Projetos</a>
        <?php if ($usuario_logado): ?>
            <a href="../header/perfil.php">Perfil</a>
            <a href="../projeto/meus_projetos.php">Meus Projetos</a>
            <a href="../projeto/postar_projeto.php">Postar Projeto</a>
            <a href="../header/logout.php">Logout</a>
        <?php endif; ?>
    </nav>

    <!-- Informações do Usuário -->
    <div class="usuario-info">
        <?php if ($usuario_logado): ?>
            <span>Olá, <?php echo htmlspecialchars($nome_usuario); ?>!</span>
        <?php else: ?>
            <a href="../login/login.php" class="button is-light">Login</a>
            <a href="../header/cadastro.php" class="button is-light">Cadastro</a>
        <?php endif; ?>
    </div>
</header>

<script>
    function toggleMenu() {
        const navMenu = document.querySelector('.nav-menu');
        navMenu.classList.toggle('active');
    }
</script>
</body>
</html>
