<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
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
            background-image: url("assets/images/recuperar.jpg");
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
            background-color: #08a4ec6e;
            color: #000;
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
        }
    </style>
</head>
<body>

    <form method="post" action="index.php">
        <h2>Recuperar Contraseña</h2>

        <?php
// Muestra errores si los hay
if (isset($error)) {
    echo '<p class="error">' . $error . '</p>';
} else {
    echo '<p>Si tu correo está registrado, te enviaremos un correo con un mensaje para recuperar la contraseña.</p>';
}
?>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <input type="hidden" name="controller" value="login">
        <input type="hidden" name="action" value="enviarCorreo">
        <br>

        <button type="submit">Recuperar</button>
    </form>

</body>
</html>
