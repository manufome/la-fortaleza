<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url("assets/images/supermercado.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
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

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            font-size: 9px;
        }
    </style>
</head>
<body>

    <form action="index.php" method="POST">
        <h2>Cambiar Contraseña</h2>
        <?php
// Muestra errores si los hay
if (isset($error)) {
    echo '<p class="error">' . $error . '</p>';
}
?>
        <input type="password" id="password" name="password" placeholder="Nueva Contraseña" required><br>

        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirmar Contraseña" required><br>
        <input type="hidden" name="controller" value="login">
        <input type="hidden" name="action" value="actualizarContrasena">
        <input type="hidden" id="token" name="token" value="<?=$token?>">
        <input type="submit" value="Cambiar Contraseña">
    </form>

</body>
</html>
