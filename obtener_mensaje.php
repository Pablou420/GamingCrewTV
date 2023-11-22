<?php
// Leer mensajes desde el archivo
$mensajes = file('chat.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Mostrar mensajes en orden inverso (los más recientes primero)
$mensajes = array_reverse($mensajes);

// Mostrar mensajes en formato de lista HTML
foreach ($mensajes as $mensaje) {
    echo '<li>' . $mensaje . '</li>';
}
?>
