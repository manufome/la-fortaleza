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

            <!-- button editar -->
            <div class="account-details__container">
                <!-- table with orders -->
                <div class="account-details__item">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID Orden</th>
                                <th scope="col">Fecha de Compra</th>
                                <th scope="col">Total</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ordenes as $orden): ?>
                                <?php if ($orden['estado'] != 'creado'): ?>
                                    <tr>
                                        <td>ORD-<?php echo $orden['id_orden']; ?></td>
                                        <td><?php echo $orden['fecha_orden']; ?></td>
                                        <td>$<?php echo (int) $orden['total']; ?></td>
                                        <td><?php echo ucfirst($orden['estado']); ?></td>
                                        <td>
                                            <a href="index.php?controller=compras&action=verDetalle&id_orden=<?php echo $orden['id_orden']; ?>" class="btn-transparent" title="Ver detalles">
                                                <i class="fa-solid fa-eye" style="color: #038de9;"></i>
                                        </td>
                                    </tr>
                                <?php endif;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
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