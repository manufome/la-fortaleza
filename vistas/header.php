<!DOCTYPE html>
<html lang="es">
<head>
    <title>Supermercados - La Fortaleza</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" href="assets/css/productos.css">
</head>
    <body>

    <header class="header">
        <div class="header__logo">
            <img src="assets/images/icons/logo.png" alt="">
            <h4>La Fortaleza</h4>
        </div>
        <div style="display: flex; align-items: center;">
        <?php if (isset($_SESSION['user'])): ?>
            <li><i class="user-icon fas fa-user"></i> Bienvenido, <?php echo $_SESSION['user']['nombre_usuario']; ?>!</li>
            <?php else: ?>
            <li><i class="user-icon fas fa-user"></i> Bienvenido, Invitado!</li>
        <?php endif; ?> 

        <div style="padding: 0 30px;">
                <ul>
                    <li class="submenu">
                        <img id="img-carrito" src="assets/images/icons/car.png" alt="car" style="width: 30px; height: 30px;">
                        <div id="carrito">
                            <table id="lista-carrito">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <a href="#" id="vaciar-carrito" class="btn-3">Vaciar Carrito</a>
                        </div>
                    </li>
                </ul>
            </div>
            <nav class="header__nav">
                <ul class="header__list">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="index.php?controller=productos&action=index">Productos</a></li>
                    <li><a href="index.php?controller=contactenos&action=index">Contáctenos</a></li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li><a href="index.php?controller=login&action=logout">Salir</a></li>
                    <?php else: ?>
                        <li><a href="index.php?controller=login&action=index">Ingresar</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
