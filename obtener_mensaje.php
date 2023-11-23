<?php
$archivo = 'chat.txt';

// Verificar si el archivo existe y es legible
if (file_exists($archivo) && is_readable($archivo)) {
    // Leer mensajes desde el archivo
    $mensajes = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($mensajes !== false) {
        echo '<ul>';
        foreach ($mensajes as $mensaje) {
            echo '<li>' . $mensaje . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Error al leer el archivo de mensajes.';
    }
} else {
    echo 'El archivo de mensajes no existe o no es legible.';
}
?>
