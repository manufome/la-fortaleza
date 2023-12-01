<!DOCTYPE html>
<html lang="en">
<?php require 'vistas/includes/_header.php'?>

<div id= "content">
        <section>
        <div class="container mt-5">
<div class="row">
<div class="col-sm-12 mb-3">
<center><h1>Productos</h1></center>
<a href="index.php?controller=inventario&action=agregar"><input  class="btn btn-primary" type="button" value="Agregar producto"></a>
</div>
<div class="col-sm-12">
<div class="table-responsive">


<table class="table table-striped table-hover">
<thead>

<tr>
<th>Id</th>
<th>Nombre</th>
<th>Categoria</th>
<th>Precio</th>
<th>Stock</th>
<th>Almacen</th>
<th>Dirección</th>
<th>Imagen</th>
<th>Acciones</th>


</tr>

</thead>

<tbody>

<?php
foreach ($productos as $key => $row) {
    ?>
<!-- empieza la tabla-->
<tr>
<td><?php echo $row['id_producto']; ?></td>
<td><?php echo $row['nombre_producto']; ?></td>
<td><?php echo $row['nombre_categoria']; ?></td>
<td>$<?php echo $row['precio_venta']; ?></td>
<td><?php echo $row['stock']; ?></td>



<td <?php echo 'class="' . $clase . '"'; ?>><?php echo $row['nombre_almacen']; ?></td>
<td><?php echo $row['direccion']; ?></td>


<td><img width="100" src="assets/images/productos/<?php echo $row['nombre_producto'].'.png'; ?>"></td>

<td>
  <a href="index.php?controller=inventario&action=editar&id=<?php echo $row['id_producto'] ?>">
    <div">
      Editar
    </div>
  </a>
  <a>|</a>
  <a href="index.php?controller=inventario&action=eliminar&id=<?php echo $row['id_producto'] ?>">
    <div">
    Eliminar
    </div>
  </a>
</td>
</tr>
<?php
}
?>
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
    <?php require 'vistas/includes/footer.php'?>
</html>
