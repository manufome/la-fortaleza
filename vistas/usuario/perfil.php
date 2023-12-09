<?php if (isset($_SESSION['user'])):
    $usuario = $_SESSION['user'];
    var_dump($usuario);
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
                    <button class="btn-3" type="button" onclick='toggleModal("modal-avatar")'>Cambiar Avatar</button>
                    <!-- create hidden modal for choose the avatar -->
                    <div id="modal-avatar" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick='toggleModal("modal-avatar")'>&times;</span>
                            <h2>Elija un avatar</h2>
                            <div class="avatar-container">
                                <img src="http://bootdey.com/img/Content/avatar/avatar2.png" alt="">
                                <img src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                <img src="http://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                                <img src="http://bootdey.com/img/Content/avatar/avatar4.png" alt="">
                                <img src="http://bootdey.com/img/Content/avatar/avatar5.png" alt="">
                                <img src="http://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                                <img src="http://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                                <img src="http://bootdey.com/img/Content/avatar/avatar8.png" alt="">
                            </div>
                        </div>
                    </div>

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
            <h2>Detalles de la Cuenta  <i class="fa-solid fa-edit" id="edit-details"></i></h2>

            <!-- button editar -->
            <div class="account-details__container">
                <form action="index.php" method="post">
                    <div class="account-details__item">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $usuario['nombre']; ?>" required disabled>
                    </div>
                    <div class="account-details__item">
                        <label for="correo">Correo:</label>
                        <input type="email" name="correo" id="correo" value="<?php echo $usuario['correo']; ?>" required disabled>
                    </div>
                    <div class="account-details__item">
                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" id="direccion" value="<?php echo $usuario['direccion']; ?>" required disabled>
                    </div>
                    <input type="hidden" name="controller" value="infoUsuario">
                    <input type="hidden" name="action" value="update">

                    <div class="account-details__item" id="save-changes">
                        <button type="submit" class="btn-3">Guardar Cambios</button>
                    </div>
                </form>
            </div>
            <br>
            <br>
            <h2>Cambiar Contraseña</h2>
            <div class="account-details__container">
                <form action="index.php" method="post">
                    <div class="account-details__item">
                        <label for="old-password">Contraseña Actual:</label>
                        <input type="password" name="old-password" id="old-password" required>
                    </div>
                    <div class="account-details__item">
                        <label for="new-password">Nueva Contraseña:</label>
                        <input type="password" name="new-password" id="new-password" required>
                    </div>
                    <div class="account-details__item">
                        <label for="confirm-password">Confirmar Contraseña:</label>
                        <input type="password" name="confirm-password" id="confirm-password" required>
                    </div>
                    <input type="hidden" name="controller" value="infoUsuario">
                    <input type="hidden" name="action" value="updatePassword">
                    <div class="account-details__item">
                        <button type="submit" class="btn-3">Cambiar Contraseña</button>
                    </div>
                    </div>
                    <?php if (isset($error)): ?>
                <div class="error-block" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif;?>
            <?php if (isset($success)): ?>
                <div class="help-block" role="alert">
                    <?php echo $success; ?>
                </div>
            <?php endif;?>
                </form>
            </div>
    </section>
</div>
<script>
    document.getElementById('carrito-compras').style.display = 'none';
    document.getElementById('search-bar').style.display = 'none';
    const editDetails = document.getElementById('edit-details');
    // enable inputs
    editDetails.addEventListener('click', () => {
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.disabled = false;
        });
        document.getElementById('save-changes').style.display = 'block';
    });

    // modal functions
    function toggleModal(modalId){
        const modal = document.getElementById(modalId);
        if (modal.style.display === "" || modal.style.display === "none") {
            modal.style.display = "block";
        } else {
            modal.style.display = "none";
        }
    }


    //set selected avatar to profile avatar
    const avatarContainer = document.querySelector('.avatar-container');
    const profileAvatar = document.querySelector('.img-account-profile');
    avatarContainer.addEventListener('click', (e) => {
        profileAvatar.src = e.target.src;
        toggleModal('modal-avatar');
    });

    //save avatar to local storage
    window.addEventListener('beforeunload', () => {
        localStorage.setItem('avatar', profileAvatar.src);
    });

    //load avatar from local storage
    window.addEventListener('load', () => {
        const avatar = localStorage.getItem('avatar');
        if(avatar){
            profileAvatar.src = avatar;
        }
    });

</script>