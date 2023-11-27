<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Recuperacion de cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="view/css/recuperar.css">

    <style>

        /* Estilo personalizado */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-title {
            text-align: center;
            margin-top: 20px;
        }

        .invalid-feedback {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4 form-title">Formulario de Recuperacion de cuenta</h1>
        <form method="post" action="procesar.php">
            <div class="mb-3">
                <label for="primer_nombre" class="form-label">Primer Nombre</label>
                <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" required minlength="3">
                <div class="invalid-feedback">Por favor, ingresa un nombre válido con al menos 3 caracteres.</div>
            </div>
            <div class="mb-3">
                <label for="segundo_nombre" class="form-label">Segundo Nombre</label>
                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre" required>
                <div class="invalid-feedback">Por favor, ingresa un segundo nombre válido.</div>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required minlength="3">
                <div class="invalid-feedback">Por favor, ingresa apellidos válidos (letras y espacios).</div>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                <div class="invalid-feedback">Ingresa una fecha de nacimiento válida.</div>
            </div>
            <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" class="form-control" id="edad" name="edad" required min="18" max="100">
                <div class="invalid-feedback">Debes ser mayor de 18 años.</div>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <select class="form-select" id="genero" name="genero" required>
                    <option value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                    <option value="otro">Otro</option>
                </select>
                <div class="invalid-feedback">Selecciona tu género.</div>
            </div>
            <div class="mb-3">
                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                <select class="form-select" id="nacionalidad" name="nacionalidad" required>
                    <option value="colombiana">Colombiana</option>
                    <option value="extranjero">Extranjero</option>
                </select>
                <div class="invalid-feedback">Selecciona tu nacionalidad.</div>
            </div>
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad donde vive</label>
                <select class="form-select" id="ciudad" name="ciudad" required>
                    <option value="bogota">Bogotá</option>
                    <option value="medellin">Medellín</option>
                    <option value="cali">Cali</option>
                    <option value="Ibague">Ibague</option>
                    <option value="Bucaramanga">Bucaramanga</option>
                    <option value="Cartagena">Cartagena</option>
                </select>
                <div class="invalid-feedback">Selecciona tu ciudad.</div>
            </div>
            <div class="mb-3">
                <label for="contacto" class="form-label">Número de Contacto</label>
                <input type="tel" class="form-control" id="contacto" name="contacto" required pattern="^\d{10}$">
                <div class="invalid-feedback">Ingresa un número de contacto válido (10 dígitos).</div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Guardar</button>
        </form>
    </div>
</body>
</html>


