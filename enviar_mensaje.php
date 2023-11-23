<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mensaje'])) {
    $mensaje = htmlspecialchars($_POST['mensaje']);
    
    // Guardar el mensaje en un archivo de texto (puedes mejorar esto usando una base de datos)
    file_put_contents('chat.txt', '[' . date('H:i:s') . '] ' . $mensaje . PHP_EOL, FILE_APPEND);
}
?>
