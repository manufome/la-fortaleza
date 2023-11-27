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
    <link rel="stylesheet" href="View/css/productos.css">
</head>
    <body>

    <header class="header">
        <div class="header__logo">
            <img src="View/images/icons/logo.png" alt="">
            <h4>La Fortaleza</h4>
        </div>
        <div style="display: flex; align-items: center;">
            
        <div style="padding: 0 30px;">
                <ul>
                    <li class="submenu">
                        <img id="img-carrito" src="View/images/icons/car.svg" alt="car">
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
                    <li><a href="index.php?controller=login&action=index">Ingresar</a></li>
                </ul>
            </nav>
        </div>
    </header>
