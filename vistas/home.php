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

        <div class="category-carousel">
            <?php
$img_extencions = array('jpg', 'jpeg', 'png', 'gif', 'webp');
foreach ($categorias as $categoria) {
    echo '<div class="category__card">';
    echo '<div class="category_img">';
    // Aquí puedes usar el nombre de la categoría o algún otro dato para construir la ruta de la imagen
    echo '<img src="assets/images/categorias/' . $categoria['nombre_categoria'] . '.png" alt="' . $categoria['nombre_categoria'] . '">';
    echo '</div>';
    echo '<div class="category__info">';
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
            $('.category-carousel').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1000,
            });
        });
    </script>