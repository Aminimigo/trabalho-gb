<?php
// autoload.php
spl_autoload_register(function ($class) {
    // O prefixo da classe é 'db' e o namespace de todas as classes da pasta 'db' será 'db'
    $prefix = 'db\\';  
    $base_dir = __DIR__ . '/';  // Caminho base do projeto
    
    // Verifica se a classe pertence ao namespace db
    if (strpos($class, $prefix) === 0) {
        // Remover o prefixo e construir o caminho da classe
        $relative_class = substr($class, strlen($prefix));
        $file = $base_dir . 'db/' . str_replace('\\', '/', $relative_class) . '.php'; // Caminho do arquivo
        
        // Verifica se o arquivo existe
        if (file_exists($file)) {
            require_once $file;
        } else {
            echo "Arquivo não encontrado: $file";  // Para depuração
        }
    }
});
?>