<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
<div class="login-container">
    <h2>Inicio de Sesión</h2>
    <?php
    // Mostrar avisos si existen en la URL
    if (isset($_GET['error1']))
        echo "<p style='color: red;'>$_GET[error1]</p>";
    if (isset($_GET['error2']))
        echo "<p style='color: red;'>$_GET[error2] <a href='registro.php'>¿Quiere registrarse?</a></p>";
    ?>
    <form action="../Validaciones/validarLogin.php" method="post">
        <input type="text" name="user" placeholder="Usuario" required>
        <input type="password" name="pass" placeholder="Contraseña" required>
        <input type="submit" value="Iniciar Sesión">
    </form>
</div>
</body>
</html>