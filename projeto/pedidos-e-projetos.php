<?php
// Incluir as classes de banco de dados e pedidos/projetos
include_once 'Database.php';
include_once 'PedidoProjeto.php';

// Criar uma nova instância de conexão com o banco de dados
$database = new Database();
$conn = $database->getConnection();

// Criar uma instância da classe PedidoProjeto
$pedidoProjeto = new PedidoProjeto($conn);

// Buscar pedidos e projetos do banco
$pedidos = $pedidoProjeto->getPedidos();
$projetos = $pedidoProjeto->getProjetos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pedidos e Projetos</title>
    <link rel="stylesheet" href="estilo.css"> <!-- Link para seu CSS -->
</head>
<body>
    <div class="tabs">
        <button class="tablink" onclick="openTab(event, 'Pedidos')">Pedidos</button>
        <button class="tablink" onclick="openTab(event, 'Projetos')">Projetos</button>
    </div>

    <!-- Tab content para pedidos -->
    <div id="Pedidos" class="tabcontent" style="display: block;">
        <h2>Pedidos</h2>
        <ul>
            <?php foreach ($pedidos as $pedido): ?>
                <li><?php echo htmlspecialchars($pedido['nome']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Tab content para projetos -->
    <div id="Projetos" class="tabcontent" style="display: none;">
        <h2>Projetos</h2>
        <ul>
            <?php foreach ($projetos as $projeto): ?>
                <li><?php echo htmlspecialchars($projeto['nome']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";  
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";  
            evt.currentTarget.className += " active";
        }

        // Abre a aba de pedidos por padrão
        document.getElementsByClassName("tablink")[0].click();
    </script>
</body>
</html>
