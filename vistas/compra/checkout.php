<div class="main-container-checkout">
    <section class="products-list">
        <table id="lista-pedido">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><img src="<?php echo $producto->imagen; ?>" alt="producto" style="width: 100px; height: 100px;"></td>
                    <td><?php echo $producto->titulo; ?></td>
                    <td><?php echo $producto->cantidad; ?></td>
                    <td><?php echo $producto->precio; ?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </section>
    <aside>
        <section class='resumen-pedido'>
            <h2>Resumen de Pedido</h2>
            <div class="resumen-pedido__container">
                <div class="resumen-pedido__item">
                    <p>Subtotal:</p>
                    <p>$<?php echo $subtotal; ?></p>
                </div>
                <div class="resumen-pedido__item">
                    <p>Envío:</p>
                    <p>$<?php echo $envio; ?></p>
                </div>
                <div class="resumen-pedido__item">
                    <p>Total:</p>
                    <p>$<?php echo $total; ?></p>
                </div>
                <div class="resumen-pedido__tip">
                    <p><?php echo $tip; ?></p>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <h2>Datos de Envío</h2>
            <form action="index.php" method="post">
                <div class="datos-envio__container">
                    <div class="datos-envio__item">
                        <label for="metodo_pago">Método de Pago:</label>
                        <select name="metodo_pago" id="metodo_pago" required>
                            <option value="tarjeta">Tarjeta de Crédito</option>
                            <option value="efectivo">Efectivo</option>
                        </select>
                    </div>
                    <div class="datos-envio__item">
                        <label for="numero_tarjeta">Número de Tarjeta:</label>
                        <input type="number" name="numero_tarjeta" id="numero_tarjeta" placeholder="Número de Tarjeta" required>
                    </div>
                    <div class="datos-envio__item">
                        <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
                        <input type="month" name="fecha_vencimiento" id="fecha_vencimiento" placeholder="Fecha de Vencimiento" required>
                    </div>
                    <div class="datos-envio__item">
                        <label for="codigo_seguridad">Código de Seguridad:</label>
                        <input type="number" max="999" limitname="codigo_seguridad" id="codigo_seguridad" placeholder="Código de Seguridad" required>
                    </div>
                    <div class="datos-envio__item">
                        <label for="nombre_tarjeta">Nombre en la Tarjeta:</label>
                        <input type="text" name="nombre_tarjeta" id="nombre_tarjeta" placeholder="Nombre en la Tarjeta" required>
                    </div>
                    <div class="datos-envio__item">
                        <label for="tipo_tarjeta">Tipo de Tarjeta:</label>
                        <select name="tipo_tarjeta" id="tipo_tarjeta" required>
                            <option value="visa">Visa</option>
                            <option value="mastercard">Mastercard</option>
                            <option value="american_express">American Express</option>
                        </select>
                    </div>
                    <div class="datos-envio__item">
                        <label for="comentarios">Comentarios:</label>
                        <textarea name="comentarios" id="comentarios" cols="30" rows="10" placeholder="Comentarios"></textarea>
                    </div>
                    <div class="datos-envio__item">
                        <input type="hidden" name="controller" value="carrito">
                        <input type="hidden" name="action" value="realizarPedido">
                        <input type="hidden" name="productos" value='<?php echo json_encode($productos); ?>'>
                        <button type="submit" class="btn-3">Realizar Pedido</button>
                    </div>
                </div>
            </form>
        </section>

    </aside>
</div>
<script>
    document.getElementById('carrito-compras').style.display = 'none';
    //if metodo de pago es efectivo, deshabilitar los campos de tarjeta
    //if metodo de pago es tarjeta, habilitar los campos de tarjeta
    let metodo_pago = document.getElementById('metodo_pago');
    let numero_tarjeta = document.getElementById('numero_tarjeta');
    let fecha_vencimiento = document.getElementById('fecha_vencimiento');
    let codigo_seguridad = document.getElementById('codigo_seguridad');
    let nombre_tarjeta = document.getElementById('nombre_tarjeta');
    let tipo_tarjeta = document.getElementById('tipo_tarjeta');
    let comentarios = document.getElementById('comentarios');
    let checkout = document.getElementById('checkout');
    metodo_pago.addEventListener('change', function() {
        if (metodo_pago.value == 'efectivo') {
            numero_tarjeta.disabled = true;
            fecha_vencimiento.disabled = true;
            codigo_seguridad.disabled = true;
            nombre_tarjeta.disabled = true;
            tipo_tarjeta.disabled = true;
            comentarios.disabled = false;
            checkout.disabled = false;
        } else {
            numero_tarjeta.disabled = false;
            fecha_vencimiento.disabled = false;
            codigo_seguridad.disabled = false;
            nombre_tarjeta.disabled = false;
            tipo_tarjeta.disabled = false;
            comentarios.disabled = false;
            checkout.disabled = false;
        }
    });

</script>