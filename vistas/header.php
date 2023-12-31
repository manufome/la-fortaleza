<!DOCTYPE html>
<html lang="es">
<head>
    <title>Supermercados - La Fortaleza</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/gsap.min.js" integrity="sha512-7Au1ULjlT8PP1Ygs6mDZh9NuQD0A5prSrAUiPHMXpU6g3UMd8qesVnhug5X4RoDr35x5upNpx0A6Sisz1LSTXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/script.js"></script>

    <link rel="stylesheet" href="assets/css/index.css">
</head>
    <body>

    <header class="header">
        <a href="index.php">
            <div class="header__logo">
                <img src="assets/images/icons/logo.png" alt="">
                <h4>La Fortaleza</h4>
            </div>
        </a>
        <div class="header__search" id="search-bar">
            <form action="index.php" method="get">
                <input type="hidden" name="controller" value="productos">
                <input type="hidden" name="action" value="index">
                <input type="text" name="search" placeholder="Buscar productos...">
                <button type="submit"><i class="fa-solid fa-search"></i></button>
            </form>
        </div>
        <div style="display: flex; align-items: center;">
            <div style="padding: 0 30px;">
                <ul>
                    <div class="contador">
                        <span id="numero-productos">0</span>
                    </div>
                    <li class="submenu" id="carrito-compras">
                    <i class="fa-solid fa-cart-shopping" style="color: #038de9; font-size: 24px"></i>
                        <div id="carrito">
                            <div class="lista-carrito">
                            </div>
                            <div class="carrito-footer">
                                <div>
                                    <a href="#" id="vaciar-carrito" class="btn-3">Vaciar</a>
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="productos" id="productos">
                                        <input type="hidden" name="controller" value="carrito">
                                        <input type="hidden" name="action" value="checkout">
                                        <button id='checkout' type="submit" class="btn-3" disabled>Ir a Pagar</button>
                                    </form>
                                </div>
                                <p id="total">Total: $0.00</p>
                            </div>

                        </div>
                    </li>
                </ul>
            </div>
            <nav class="header__nav">
                <ul class="header__list">
                    <li><a href="index.php"><i class="fa-solid fa-house"></i> Inicio</a></li>
                    <li><a href="index.php?controller=productos&action=index"><i class="fa-solid fa-table-cells-large"></i> Productos</a></li>
                    <li><a href="index.php?controller=contactenos&action=index"><i class="fa-solid fa-envelope"></i> Contáctenos</a></li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- menu desplegable de usuario-->
                        <li class="submenu">
                            <a href="index.php?controller=infoUsuario&action=index"><i class="user-icon fas fa-user"></i> <?php echo $_SESSION['user']['nombre_usuario']; ?></a>
                            <div id="user-menu">
                                <ul class="children">
                                    <li><a href="index.php?controller=infoUsuario&action=index"><i class="fa-regular fa-address-card" style='color:
                                    #038de9;'></i> Mi Cuenta</a></li>
                                    <hr>
                                    <li><a href="index.php?controller=carrito&action=compras"><i class="fa-brands fa-shopify" style='color:
                                    #038de9;'></i> Mis Compras</a></li>
                                    <hr>
                                    <li><a href="index.php?controller=login&action=logout"><i class="fa-solid fa-arrow-right-from-bracket" style='color:
                                    #038de9;'></i> Cerrar Sesión</a></li>
                                </ul>
                            </div>
                        </li>
                    <?php else: ?>
                        <li><a href="index.php?controller=login&action=index"><i class="fa-solid fa-arrow-right-to-bracket"></i> Ingresar</a></li>
                    <?php endif;?>
                </ul>
            </nav>
        </div>
    </header>
