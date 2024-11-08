<?php
// Definir parâmetros da conexão
$host = 'localhost';      // ou o endereço do seu servidor de banco de dados
$dbname = 'login';    // Nome do banco de dados
$username = 'root'; // Usuário do banco de dados
$password = '';   // Senha do banco de dados

try {
    // Criando a conexão com o banco de dados
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configurando o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Caso haja erro na conexão, exibe a mensagem
    echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
    exit();
}

// Consultar os pedidos e projetos
$query = "SELECT * FROM pedidos"; // Adapte conforme necessário
$result = $conn->query($query);

$pedidos = [];
$projetos = [];

// Organizar os resultados nas arrays respectivas
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {  // Usando fetch() com PDO::FETCH_ASSOC
    if ($row['tipo'] === 'pedido') {
        $pedidos[] = $row;
    } elseif ($row['tipo'] === 'projeto') {
        $projetos[] = $row;
    }
}
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
