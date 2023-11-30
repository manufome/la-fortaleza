<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Contacto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    </header>
    <section class="container">
    <div class="row">
        <br><br><br>
        <h3 class="center-align">CONTACTO</h3>
        <article class="col s6 offset-s3">
            <form id="contact-form" method="POST" action="formulario-contacto.php">
                <div class="input-field">
                    <i class="material-icons prefix">perm_identity</i>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>

                <div class="input-field">
                    <i class="material-icons prefix">person_pin</i>
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" required>
                </div>
                
                <div class="input-field">
                    <i class="material-icons prefix">email</i>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    <span class="helper-text" data-error="Ingresa un correo válido"></span>
                </div>

                <div class="input-field">
                    <i class="material-icons prefix">mode_edit</i>
                    <label for="mensaje">Mensaje</label>
                    <textarea name="mensaje" id="mensaje" rows="10" class="materialize-textarea" required></textarea>
                </div>
                <br><br><br>

                <div class="center-align">
                    <a href="index.php" class="btn blue">Volver</a>
                    <button type="button" class="btn blue" onclick="enviarFormulario()">Enviar</button>
                </div>
            </form>
        </article>
    </div>
</section>


    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
    <script>
        function enviarFormulario() {
            // Validar todos los campos antes de enviar
            const nombre = document.getElementById("nombre").value;
            const apellido = document.getElementById("apellido").value;
            const email = document.getElementById("email").value;
            const mensaje = document.getElementById("mensaje").value;

            if (!nombre || !apellido || !email || !mensaje) {
                alert("Por favor, complete todos los campos.");
                return;
            }

            // Cambiar la acción del formulario antes de enviarlo
            document.getElementById("contact-form").action = "error500";

            // Enviar el formulario
            document.getElementById("contact-form").submit();
        }
    </script>

</body>
</html>