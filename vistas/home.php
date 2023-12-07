<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Fortaleza</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" href="assets/css/index.css">
    <meta mane="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-acale=1.0">
</head>

<body>

    <header class="header">
        <div class="header__logo">
            <img src="assets/images/icons/logo.png" alt="">
            <h4>La Fortaleza</h4>
        </div>
        <div style="display: flex; align-items: center;">
        <?php if (isset($_SESSION['user'])): ?>
            <li style='margin-right: 30px'><i class="user-icon fas fa-user"></i> Bienvenido, <?php echo $_SESSION['user']['nombre_usuario']; ?>!</li>
        <?php endif;?>
            <nav class="header__nav">
                <ul class="header__list">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="index.php?controller=productos&action=index">Productos</a></li>
                    <li><a href="index.php?controller=contactenos&action=index">Contáctenos</a></li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <li><a href="index.php?controller=login&action=logout">Salir</a></li>
                    <?php else: ?>
                        <li><a href="index.php?controller=login&action=index">Ingresar</a></li>
                    <?php endif;?>
                </ul>
            </nav>
        </div>
    </header>
    <div class="main-container">
        <div class="container-cover">
            <div class="container-child-cover">
                <div class="container-imagen">
                    <img src="assets/images/icons/almacen.jpg">
                </div>
                <div class="capa-shadow"></div>
                <div class="capa2"></div>
            </div>
        </div>
        <div class="welcome">
            <div class="welcome__title">
                <h1>Bienvenido a </h1>
                <h2>Supermercado La fortaleza</h2>
            </div>
            <div class="welcome__subtitle">
                <h2>¡Encuentra todo para tu despensa!</h2>
            </div>
        </div>

        <div class="products-carousel">
            <?php
$img_extencions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
foreach ($categorias as $categoria) {
    echo '<div class="products__card">';
    echo '<div class="products_img">';
    // Aquí puedes usar el nombre de la categoría o algún otro dato para construir la ruta de la imagen
    echo '<img src="assets/images/categorias/' . $categoria['nombre_categoria'] . '.png" alt="' . $categoria['nombre_categoria'] . '">';
    echo '</div>';
    echo '<div class="products__info">';
    echo '<h3>' . $categoria['nombre_categoria'] . '</h3>';
    echo '</div>';
    echo '</div>';
}
?>
        </div>
        <div class="container-info">
                <div class="info">
                    <h3>¿Qué hacemos en supermercados <i> La fortaleza</i>?</h3>
                    <p>En supermercados la fortaleza, buscamos siempre cubrir una necesidad de forma inmediata y segura,
                        proporcionando una experiencia agradable al usuario durante su compra, así mismo con procesos
                        eficientes en los pedidos y en las entregas de los productos y artículos.</p>
                </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.products-carousel').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1000,
            });
        });
    </script>