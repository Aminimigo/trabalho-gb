<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Publicado</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <div class="container">
        <h1>Seu Projeto Foi Publicado com Sucesso!</h1>

        <p><strong>Título do Projeto:</strong> <?php echo htmlspecialchars($_POST['titulo']); ?></p>
        <p><strong>Descrição:</strong> <?php echo htmlspecialchars($_POST['descricao']); ?></p>
        <p><strong>Categoria:</strong> <?php echo htmlspecialchars($_POST['categoria']); ?></p>
        <p><strong>Prazo para Conclusão:</strong> <?php echo htmlspecialchars($_POST['prazo']); ?></p>
        <p><strong>Orçamento:</strong> R$ <?php echo htmlspecialchars($_POST['orcamento']); ?></p>

        <a href="index.html" class="botao-voltar">Voltar para a Página Inicial</a>
    </div>

</body>
</html>
