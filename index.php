<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Leer información del usuario desde el archivo CSV (puedes mejorar esto utilizando una base de datos)
    $registros = array_map('str_getcsv', file('usuarios.csv'));

    foreach ($registros as $registro) {
        if ($registro[0] == $usuario && password_verify($contrasena, $registro[1])) {
            // Iniciar sesión
            $_SESSION["usuario"] = $usuario;
            header("Location: transmision.php");  // Redirige a la página de transmisión
            exit();
        }
    }

    $mensaje_error = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        p {
            margin-top: 16px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Iniciar sesión</h2>

    <?php
    if (isset($mensaje_error)) {
        echo "<p style='color: red; text-align: center;'>$mensaje_error</p>";
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>

        <input type="submit" value="Iniciar sesión">
    </form>

    <p>¿No tienes una cuenta? <a href="registro.php">Regístrate</a></p>

</body>
</html>
