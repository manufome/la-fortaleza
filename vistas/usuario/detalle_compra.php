<?php
if (isset($_SESSION['user'])):
    $usuario = $_SESSION['user'];
else:
    header('Location: index.php');
endif;
?>
<div class="main-container-userinfo">
    <aside>
        <section class='user-sidebar'>
            <div class="card">
                <div class="card__header">Imágen de Perfil</div>
                <div class="card__body">
                    <!-- Profile avatar-->
                    <img class="img-account-profile" src="http://bootdey.com/img/Content/avatar/avatar2.png" alt="">
                    <!-- Profile avatar change button-->
                    <a href="index.php?controller=infoUsuario&action=index" style="color: #038de9;">Configuración de Perfil</a>
                </div>
            </div>
            <div class="card">
                <div class="card__header">Nombre de usuario</div>
                <div class="card__body">
                    <h1><?php echo $usuario['nombre_usuario']; ?></h1>
                </div>
            </div>

        </section>
    </aside>
    <section class="account-details">
            <h2>Mis Compras</h2>
            <div style="display: flex; justify-content: space-between;">
                <section style="margin-right: 20px;">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Imagen</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Precio Unitario</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><img src="assets/images/productos/<?php echo $item['nombre_producto']; ?>.png" alt="<?php echo $item['nombre_producto']; ?>" width="100px"></td>
                                    <td><?php echo $item['nombre_producto']; ?></td>
                                    <td>$<?php echo (int) $item['precio_unitario']; ?></td>
                                    <td><?php echo (int) $item['cantidad']; ?></td>
                                    <td>$<?php echo (int) $item['subtotal']; ?></td>
                                </tr>
                            <?php endforeach;?>
                    </table>
                </section>
                <section class="resumen-pedido" style="width: 385px;">
                    <h2>Resumen de Pedido</h2>
                    <div class="resumen-pedido__container">
                        <div class="resumen-pedido__item">
                            <p>Id Pedido</p>
                            <p>ORD-<?php echo $orden['id_orden']; ?></p>
                        </div>
                        <div class="resumen-pedido__item">
                            <p>Fecha de Compra</p>
                            <p><?php echo $orden['fecha_orden']; ?></p>
                        </div>
                        <div class="resumen-pedido__item">
                            <p>Estado</p>
                            <p><?php echo ucfirst($orden['estado']); ?></p>
                        </div>
                        <div class="resumen-pedido__item">
                            <p>Subtotal</p>
                            <p>$<?php echo (int) $orden['total'] - (int) $orden['envio']; ?></p>
                        </div>
                        <div class="resumen-pedido__item">
                            <p>Envío</p>
                            <p>$<?php echo $orden['envio']; ?></p>
                        </div>
                        <div class="resumen-pedido__item">
                            <p>Total</p>
                            <p>$<?php echo (int) $orden['total']; ?></p>
                        </div>
                        <div class="resumen-pedido__tip">
                            <?php if ($orden['envio'] == 0): ?>
                                <p>El envío salió gratis <i class="fas fa-check"></i></p>
                            <?php else: ?>
                                <p>Costo de envío estándar para compras menores a $50.000</p>
                            <?php endif;?>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <h2>Datos de Envío</h2>
                    <div class="resumen-pedido__container">
                        <div class="resumen-pedido__item">
                            <p>Cliente</p>
                            <p><?php echo $_SESSION['user']['nombre']; ?></p>
                        </div>
                        <div class="resumen-pedido__item">
                            <p>Dirección</p>
                            <p><?php echo $_SESSION['user']['direccion']; ?></p>
                        </div>
                        <div class="resumen-pedido__item">
                            <p>Metodo de Pago</p>
                            <p><?php echo ucfirst($orden['metodo_pago']); ?></p>
                    </div>
                    </div>
                            <!-- <a href="index.php?controller=compras&action=verRecibo&id_orden=<?php echo $orden['id_orden']; ?>" class="btn btn-primary" style="margin-top: 20px;">Ver Recibo</a> -->
                        <?php if ($orden['estado'] == 'enviado'): ?>
                            <!-- <form action="index.php" method="post">
                                <input type="hidden" name="controller" value="carrito">
                                <input type="hidden" name="action" value="confirmarREcibido">
                                <input type="hidden" name="id_orden" value="<?php echo $orden['id_orden']; ?>">
                                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Confirmar Recibido</button>
                            </form> -->
                        <?php endif;?>
                    <br>
                </section>
            </div>
    </section>
</div>
<script>
    document.getElementById('carrito-compras').style.display = 'none';
    document.getElementById('search-bar').style.display = 'none';
    document.getElementById('numero-productos').style.display = 'none';
    const profileAvatar = document.querySelector('.img-account-profile');
    //load avatar from local storage
    window.addEventListener('load', () => {
        const avatar = localStorage.getItem('avatar');
        if(avatar){
            profileAvatar.src = avatar;
        }
    });

</script>

<style>
    table {
        width: 100%;
        margin: 0 auto;
        border-collapse: collapse;
        text-align: center;
    }

    th,
    td {
        padding: 20px;
        border-bottom: 1px solid #dadada;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .main-container-userinfo {
        padding-top: 40px;
    }
    a:hover{
        text-decoration: underline;
    }
    .btn-transparent{
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

</style>