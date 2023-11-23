<?php
session_start();

$usuarios = [];

// Verificar el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registro"])) {
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : null;

    // Verificar si el usuario ya existe en el array
    if ($email !== null && isset($usuarios[$email])) {
        $error_message = "El correo electrónico ya está registrado. Intenta con otro.";
    } else {
        // Almacenar la contraseña de forma segura utilizando password_hash()
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        
        // Agregar el nuevo usuario al array con la contraseña hasheada
        $usuarios[$email] = ["nombre" => $nombre, "contrasena" => $hash];
        $_SESSION["new_user"] = $email;

        header("Location: index.php"); // Redirige a la página de inicio de sesión después de registrar
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="global.scss">
</head>
<body class="centrado">
    
    <div class="wrapper">
        <h2>Registro</h2>
        
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <!-- Formulario de registro -->
        <form method="post" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br><br>
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>
            <br><br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
            <br><br>
            <input type="submit" name="registro" value="Registrarse">
        </form>
    </div>

</body>
</html>
