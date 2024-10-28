<?php
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
      $titulo = $_POST['titulo'];
      $descricao = $_POST['descricao'];
      $orcamento = $_POST['orcamento'];
      $data_entrega = $_POST['data_entrega'];

   
      $conn = new mysqli('localhost', 'seu_usuario', 'sua_senha', 'seu_banco');

      
      if ($conn->connect_error) {
          die("Conexão falhou: " . $conn->connect_error);
      }

     
      $sql = "INSERT INTO projetos (titulo, descricao, orcamento, data_entrega) VALUES ('$titulo', '$descricao', '$orcamento', '$data_entrega')";

      if ($conn->query($sql) === TRUE) {
          echo "<p>Projeto publicado com sucesso!</p>";
      } else {
          echo "Erro: " . $sql . "<br>" . $conn->error;
      }

      $conn->close();
  }
  ?>

  <footer>
      <p>&copy; 2024 CemFreela. Todos os direitos reservados.</p>
  </footer>
</body>

</html>
