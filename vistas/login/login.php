<!DOCTYPE html>
<html lang="en">

<head>
    <title>Iniciar Sesión</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="vistas/css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <main>
        <!-- formulario de login-Registro -->
        <div class="contenerdor__todo">
            <div class="caja_trasera">
                <div class="caja_trasera-login">
                    <h3>¿Ya tienes cuenta?</h3>
                    <p> Inicia sesión, ingresa a la página </p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión </button>

                </div>
                <div class="caja_trasera-register">
                    <h3>¿Aún no tienes cuenta?</h3>
                    <p> Registrate para que puedas iniciar sesión </p>
                    <button id="btn__registrarse">Registrarse </button>

                </div>


            </div>
            <div class="contenedor__login-register">


            <form action="index.php" method="post" class="formulario__login">
                <h2>Iniciar Sesion </h2>

                <div class="input-box animation" style="--i: 1; --j: 24;">
                    <input type="email" name="email" required placeholder="Correo Electrónico">
                    <i class='bx bxs-envelope'></i>
                </div>

                <div class="input-box animation">
                    <input type="password" name="password" required placeholder="Contraseña">
                    <i class='bx bxs-envelope'></i>
                </div>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php endif; ?>
                <input type="hidden" name="controller" value="login">
                <input type="hidden" name="action" value="login">
                <center><button type="submit">Entrar</button></center><br>
                <center><span class="contra"><a href="formulario de recuperacion de cuenta/formulario.html">Recuperar Contraseña</a></span></center>
            </form>

            <form action="index.php" method="post" class="Formulario__register">
                <h2>Registrarse</h2>

                <div class="input-box animation">
                    <input type="text" name="name" required placeholder="Nombre Completo ">
                    <i class='bx bxs-envelope'></i>
                </div>
                <input type="address" name="address" required placeholder="Dirección">
                <input type="email" name="email" required placeholder="Correo Electrónico">
                <input type="password" name="password" placeholder="Contraseña" required
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,16}$"
                    title="La contraseña debe contener al menos una mayúscula, una minúscula, un número y tener una longitud de 8 a 16 caracteres">
                <input type="password" name="confirmPassword" placeholder="Confirmar Contraseña" required
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,16}$"
                    title="La contraseña debe contener al menos una mayúscula, una minúscula, un número y tener una longitud de 8 a 16 caracteres">
                    <?php if (isset($error_register)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error_register ?>
                    </div>
                    <?php endif; ?>
                    <center><button type="submit">Registrarse</button></center>
                <input type="hidden" name="controller" value="login">
                <input type="hidden" name="action" value="register">
            </form>
        </div>
    </main>
    <script src="vistas/js/login.js" type='module' defer></script>
    <script type='module' defer>
        import { register } from './vistas/js/login.js';
        const flag = <?= isset($register) ? 'true' : 'false' ?>;
        if (flag) {
            register();
        }
    </script>

</body>

</html>
