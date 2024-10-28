<?php require __DIR__."/../header.php"?>

    <div class="caixa">
        <h2>Postar Novo Projeto</h2>
        <form action="postar_projeto.php" method="POST">
            <label for="titulo">Título do Projeto:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <label for="orcamento">Orçamento:</label>
            <input type="text" id="orcamento" name="orcamento" required>

            <label for="data_entrega">Data de Entrega:</label>
            <input type="date" id="data_entrega" name="data_entrega" required>

            <button type="submit">Publicar Projeto</button>
        </form>
    </div>

   