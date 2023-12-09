
<!DOCTYPE html>
<html lang="en">
<?php require 'vistas/includes/_header.php' ?>

<body>
  
<div id= "content">
        <section>
        <div class="container mt-5">
<div class="row">
<div class="col-sm-12 mb-3">
<center><h1>Información de sesion actual</h1></center>
</div>
<div class="col-sm-12">
<div class="table-responsive">


<table class="table table-striped table-hover">
<thead>

<tr>
<th>Nombre</th>
<th>Telefono</th>
<th>Correo</th>
<th>Cargo</th>
<th>Fecha Contratación</th>


</tr>

</thead>

<tbody>
<tr>
<td><?php echo $actualsesion['nombre']; ?></td>
<td><?php echo $actualsesion['telefono']; ?></td>
<td><?php echo $actualsesion['correo']; ?></td>
<td><?php echo $actualsesion['titulo_puesto']; ?></td>
<td><?php echo $actualsesion['fecha_contratacion']; ?></td>
</tr>
</tbody>

</table>
</div>
</div>
</div>
</div>
        </section>


        <section>
            <div class= "container">
                <div class= "row">
                    <div class= "col-lg-9">
            </div>
        </section>
    </div>
    
    <?php require 'vistas/footer.php' ?>
    </body>

</html>