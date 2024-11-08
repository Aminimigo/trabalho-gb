<?php
// Verifica se a sessão já foi iniciada antes de chamar session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Inicia a sessão, caso ainda não tenha sido iniciada
}

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    header("Location: login.php");  // Redireciona para o login se o usuário não estiver logado
    exit();
}

// Armazenar o e-mail do usuário logado
$usuario_email = $_SESSION['usuario_email'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - CemFreelas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css"> <!-- Link do Bulma -->
</head>

<body>

<!-- Cabeçalho -->
<header>
    <!-- Logo e Nome do Site com link para o painel -->
    <div class="logo">
        <a href="painel.php"><h1>CemFreelas</h1></a>
    </div>

    <!-- Barra de Pesquisa -->
    <div class="barra-pesquisa">
        <input type="text" placeholder="Buscar...">
        <button type="submit">Pesquisar</button>
    </div>
<!-- Menu Hambúrguer -->
<div class="hamburger-menu" onclick="toggleMenu()">
    <div class="menu-icon">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
</div>

<!-- Navegação Lateral -->
<div id="nav" class="nav">
    <ul>
        <li><a href="painel.php">Início</a></li>
        <li><a href="sobre.php">Sobre</a></li>
        <li><a href="projetos.php">Serviços</a></li>
        <li><a href="contato.php">Contato</a></li>
        <li><a href="perfil.php">Meu Perfil</a></li>
        <li><a href="logout.php">Sair</a></li>
    </ul>
</div>


    <!-- Exibe o e-mail do usuário logado -->
    <div class="usuario-info">
        Bem-vindo, <?php echo $usuario_email; ?>
    </div>
</header>


<script>
    // Função para mostrar/ocultar o menu no mobile
    function toggleMenu() {
        var menu = document.getElementById("menu");
        menu.classList.toggle("show");
    }

function toggleMenu() {
    var nav = document.getElementById('nav');
    if (nav.style.left === "0px") {
        nav.style.left = "-250px";  // Fecha o menu
    } else {
        nav.style.left = "0px";  // Abre o menu
    }
}</script>


<style>

    /* Cabeçalho */
    header {
        background-color: pink; /* Rosa claro */
        color: white;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%; /* Garante que o cabeçalho ocupe toda a largura da tela */
        box-sizing: border-box; /* Para garantir que o padding não afete a largura */
    }

    .logo h1 {
        padding: 30px 10px 10px 0px;
        font-size: 24px;
        margin: 0;
    }

    .logo a {
        text-decoration: none;
        color: white;
    }

    .logo a:hover {
        text-decoration: ;
    }

    /* Barra de Pesquisa */
    .barra-pesquisa {
        display: flex;
        align-items: center;
        background-color: white;
        padding: 10px;
        border-radius: 25px;
        margin-right: 20px;
        max-width: 300px;
        width: 100%;
    }

    .barra-pesquisa input {
        width: 100%;
        padding: 10px;
        border-radius: 25px;
        border: 1px solid #ddd;
        font-size: 16px;
    }

    .barra-pesquisa button {
        background-color: #ff4d94;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
    }

    /* Menu Hambúrguer */
    .menu-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .menu-icon {
        display: flex; /* O menu hambúrguer será visível em todos os dispositivos */
        flex-direction: column;
        justify-content: space-around;
        width: 30px;
        height: 40px;
        cursor: pointer;
    }

    .menu-icon div {
        background-color: white;
        height: 4px;
        border-radius: 2px;
    }

    /* Menu de navegação */
    .menu {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #ff4d94;
    }

    .menu ul {
        list-style: none;
        display: flex;
        margin: 0;
        padding: 0;
    }

    .menu ul li {
        padding: 0 15px;
    }

    .menu ul li a {
        text-decoration: none;
        color: white;
        font-size: 18px;
    }

    .menu ul li a:hover {
        text-decoration: underline;
    }

    .usuario-info {
        color: white;
        font-size: 18px;
        margin-left: 20px;
    }

    /* Responsividade */
    @media screen and (max-width: 768px) {
        /* Menu oculto por padrão em dispositivos móveis */
        .menu ul {
            flex-direction: column;
            display: none; /* Esconde o menu por padrão */
            width: 100%; /* Garante que o menu ocupe a largura total */
            padding: 0;
            margin-top: 20px;
        }

        .menu-container {
            width: 100%;
            display: block;
        }

        .menu ul.show {
            display: flex; /* Torna o menu visível quando a classe 'show' for adicionada */
            margin-top: 10px;
            background-color: #ff4d94; /* Cor de fundo do menu */
            border-radius: 8px; /* Bordas arredondadas */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Sombras sutis para o menu */
        }

        .menu ul li {
            padding: 10px 0; /* Espaçamento entre os itens do menu */
            text-align: center;
            width: 100%; /* Para que cada item ocupe a largura total */
        }

        .menu ul li a {
            font-size: 20px;
            padding: 10px;
            display: block; /* Faz com que o link ocupe toda a largura */
            color: white;
            text-align: center;
        }

        .barra-pesquisa {
            flex-direction: column;
            width: 100%;
            margin-top: 15px;
        }
    }
    /* Menu Hambúrguer */
.hamburger-menu {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1001;
    cursor: pointer;
}

.menu-icon {
    width: 30px;
    height: 22px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    cursor: pointer;
}

.bar {
    height: 4px;
    background-color: #333;
    width: 100%;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

/* Navegação Lateral */
#nav {
    position: fixed;
    top: 0;
    left: -250px;
    width: 250px;
    height: 100%;
    background-color: #FF4D94;
    transition: left 0.3s ease-in-out;
    z-index: 1000;
}

#nav ul {
    list-style: none;
    padding: 20px;
    margin: 0;
}

#nav ul li {
    margin: 20px 0;
}

#nav ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: 500;
}

#nav ul li a:hover {
    text-decoration: underline;
}

</style>

</body>
</html>
