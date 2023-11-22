<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de inicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #004853;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
        }

        p {
            text-align: center;
            margin-top: 16px;
        }

        a {
            color: #4caf50;
        }
    </style>
</head>
<body>

    <h2>Bienvenido, <?php echo $usuario; ?>!</h2>
    <!-- Contenido de la página de inicio -->

    <p><a href="cerrar_sesion.php">Cerrar sesión</a></p>

</body>
</html>
