<?php
// Iniciar a sessão
session_start();

// Remover todos os dados da sessão
session_unset();

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login
header("Location: login.php");
exit();
?>
