
    
    <section class="oferts container">
            <button class="arrow left-arrow" onclick="changeCategories(-1)">&#9664;</button>
            <?php
        $numCategorias = count($categorias);

        for ($i = 0; $i < 3; $i++) {
            $categoria = $categorias[$i]['nombre_categoria'];

            echo '<div class="ofert-1 b' . ($i + 1) . '">';
            echo '<div class="ofert-txt">';
            echo '<h3>' . $categoria . '</h3>';
            echo '<a href="#' . $categoria . '">Y MUCHO MAS!!!</a>';
            echo '</div>';
            echo '<img src="assets/images/categorias/' . $categoria. '.png" alt="' . $categoria. '">';
            echo '</div>';
            echo '</div>';
        }
    ?>
        <button class="arrow right-arrow" onclick="changeCategories(1)">&#9654;</button>
    </section>

    <div id="product-list"></div>
    <?php
    $file_extensions = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
    foreach ($categorias as $categoria) {
        echo '<section class="products container" id="' . $categoria['nombre_categoria'] . '">';
        echo '<h2>' . $categoria['nombre_categoria'] . '</h2>';
        echo '<div class="box-container">';
        echo '<div class="box-container" id="lista-' . $categoria['id_categoria'] . '">';
        foreach ($productos as $producto) {
            $file_name = $producto['nombre_producto'];
            foreach ($file_extensions as $extension) {
                if (file_exists('assets/images/productos/' . $file_name . '.' . $extension)) {
                    $file_name .= '.' . $extension;
                    break;
                }
            }
            if ($producto['id_categoria'] == $categoria['id_categoria']) {
                echo '<div class="box">';
                echo '<img src="assets/images/productos/' . $file_name . '" alt="' . $producto['nombre_producto'] . '" title="' . $producto['descripcion'] . '">';
                echo '<div class="product-txt">';
                echo '<h3>' . $producto['nombre_producto'] . '</h3>';
                echo '<p class="precio">' . $producto['precio_venta'] . '</p>';
                echo '<a href="#" class="agregar-carrito btn-3" data-id="' . $producto['id_producto'] . '">Agregar al carrito </a>';
                echo '</div>';
                echo '</div>';
            }
        }
        echo '</div>';
        echo '</div>';
        echo '</section>';
    }
    ?>

    <section class="testimonial container">
        <span>Cuentenos su experiencia con nosotros: </span>
        <h2>Qué opinan nuestros clientes</h2>
        <div class="testimonial-content">
            <div class="testimonial-1">
                <p>Cada uno de los servicios que ofrece el establecimiento cumple con mis expectativas con una muy buena
                    atención GRACIAS!</p>
                <img src="assets/images/icons/starts.png">
                <h4>Calificación </h4>
            </div>
            <div class="testimonial-1">
                <p>Sus servicios de envíos son muy rápidos y eficaces dándome un maravilloso servicio </p>
                <img src="assets/images/icons/starts.png">
                <h4>Calificación </h4>
            </div>  
            <div class="testimonial-1">
                <p>Tiene una plataforma muy amigable con el usuario fácil de usar y otorga la información necesaria para
                    hacer mis compras muy ágil y fácil </p>
                <img src="assets/images/icons/starts.png">
                <h4>Calificación </h4>
            </div>
        </div>
    </section>
    <script src="assets/js/script.js"></script>
    <script>
        const categorias = <?php echo json_encode($categorias); ?>;

        const categoriaIzquierdaElement = document.querySelector('.ofert-1.b1 h3');
        const categoriaCentroElement = document.querySelector('.ofert-1.b2 h3');
        const categoriaDerechaElement = document.querySelector('.ofert-1.b3 h3');

        const categoriaIzquierdaContainer = document.querySelector('.ofert-1.b1');
        const categoriaCentroContainer = document.querySelector('.ofert-1.b2');
        const categoriaDerechaContainer = document.querySelector('.ofert-1.b3');

        const categoriaIzquierdaImg = document.querySelector('.ofert-1.b1 img');
        const categoriaCentroImg = document.querySelector('.ofert-1.b2 img');
        const categoriaDerechaImg = document.querySelector('.ofert-1.b3 img');

        const categoriaIzquierdaButton = document.querySelector('.ofert-1.b1 a');
        const categoriaCentroButton = document.querySelector('.ofert-1.b2 a');
        const categoriaDerechaButton = document.querySelector('.ofert-1.b3 a');
        
        let posicionActual = 0;

        function changeCategories(offset) {
            // Actualiza la posición actual.
            posicionActual += offset;

            if (posicionActual < 0) {
                posicionActual = categorias.length - 3;
            } else if (posicionActual > categorias.length - 3) {
                posicionActual = 0;
            }

            categoriaIzquierdaElement.innerText = categorias[posicionActual].nombre_categoria;
            categoriaCentroElement.innerText = categorias[posicionActual + 1].nombre_categoria;
            categoriaDerechaElement.innerText = categorias[posicionActual + 2].nombre_categoria;

            categoriaIzquierdaImg.src = 'assets/images/categorias/' + categorias[posicionActual].nombre_categoria + '.png';
            categoriaCentroImg.src = 'assets/images/categorias/' + categorias[posicionActual + 1].nombre_categoria + '.png';
            categoriaDerechaImg.src = 'assets/images/categorias/' + categorias[posicionActual + 2].nombre_categoria + '.png';

            categoriaIzquierdaButton.href = '#' + categorias[posicionActual].nombre_categoria;
            categoriaCentroButton.href = '#' + categorias[posicionActual + 1].nombre_categoria;
            categoriaDerechaButton.href = '#' + categorias[posicionActual + 2].nombre_categoria;
            
            categoriaIzquierdaContainer.classList.remove('b1', 'b2', 'b3');
            categoriaCentroContainer.classList.remove('b1', 'b2', 'b3');
            categoriaDerechaContainer.classList.remove('b1', 'b2', 'b3');

            categoriaIzquierdaContainer.classList.add('b' + ((posicionActual + 1) % 3 + 1));
            categoriaCentroContainer.classList.add('b' + ((posicionActual + 2) % 3 + 1));
            categoriaDerechaContainer.classList.add('b' + ((posicionActual + 3) % 3 + 1));
        }
    </script>
