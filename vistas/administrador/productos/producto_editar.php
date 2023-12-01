
<!DOCTYPE html>
<html lang="en">
<?php require 'vistas/includes/_header.php' ?>
<body>

<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="index.php" method="POST"  enctype="multipart/form-data" >

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Nombre *</label>
<input type="text"  id="nombre" name="nombre" value="<?php echo $producto['nombre_producto']; ?>" class="form-control" required>
</div>
</div>

<div class="col-sm-6">
<div class="mb-3">
<label for="nombre_categoria" class="form-label">Categoria *</label>
<input type="text"  id="nombre_categoria" name="nombre_categoria" value="<?php echo $producto['nombre_categoria']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="precio" class="form-label">Precio *</label>
<input type="text"  id="precio" name="precio" value="<?php echo $producto['precio_venta']; ?>"  class="form-control" required>
</div>
</div>

<div class="col-sm-6">
<div class="mb-3">
<label for="stock" class="form-label">Stock *</label>
<input type="number"  id="stock" name="stock"  value="<?php echo $producto['stock']; ?>" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="almacen" class="form-label">Almacén *</label>
<input type="text"  id="almacen" name="almacen"  value="<?php echo $producto['nombre_almacen']; ?>" class="form-control" required>
</div>
</div>

<div class="col-sm-6">

<div class="mb-3">
<label for="direccion" class="form-label">Dirección *</label>
<input type="text"  id="direccion" name="direccion" value="<?php echo $producto['direccion']; ?>" class="form-control" required>
</div>


</div>
</div>
<div class="row">
    <div class="col-sm-12">
    <div class="mb-3">
<label for="categorias" class="form-label">Categorias *</label>
<select name="categorias" id="categorias" class="form-control" required>
<?php
    foreach ($categorias as $key => $row) {
        ?>
        <option value="<?php echo $row['id_categoria']; ?>"><?php echo $row['nombre_categoria']; ?></option>
        <?php
    }
    ?>

  </select>
    </div>   
</div>
</div>
<div class="mb-3">

<div class="mb-3">
<input type="hidden" name="controller" value="inventario">
<input type="hidden" name="action" value="actualizar">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div>
</body>
</html>