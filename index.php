<?php
session_start();

$usuarios = [];

// Verificar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = isset($_POST["username"]) ? $_POST["username"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;

    // Verificar si el usuario existe en el array
    if ($username !== null && $password !== null && isset($usuarios[$username]) && password_verify($password, $usuarios[$username]["contrasena"])) {
        $_SESSION["username"] = $username;
        header("Location: pagina-inicio.php"); 
        exit();
    } else {
        $error_message = "Datos incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" type="text/css" href="global.scss">
</head>
<body class="centrado">
    <div>
        <h2>Iniciar Sesión</h2>

        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="post" action="">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required>
            <br><br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <br><br>
            <input type="submit" name="login" value="Iniciar Sesión">
        </form>
        <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.</p>
    </div>
</body>
</html>
