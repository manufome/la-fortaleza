<!DOCTYPE html>
<html lang="es-MX">
<?php require 'vistas/includes/_header.php' ?>
<body>

<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="index.php" method="POST"  enctype="multipart/form-data">
<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Nombre *</label>
<input type="text"  id="nombre" name="nombre" class="form-control" required>
</div>
</div>

<div class="col-sm-6">
<div class="mb-3">
<label for="descripcion" class="form-label">Descripcion *</label>
<input type="text"  id="descripcion" name="descripcion" class="form-control" required >
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="precio_compra" class="form-label">Precio compra *</label>
<input type="number"  id="precio_compra" name="precio_compra" class="form-control" required>
</div>
</div>

<div class="col-sm-6">
<div class="mb-3">
<label for="precio_venta" class="form-label">Precio venta*</label>
<input type="number"  id="precio_venta" name="precio_venta" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="stock" class="form-label">Cantidad *</label>
<input type="number"  id="stock" name="stock" class="form-control" required>
</div>
</div>

<div class="col-sm-6">

<div class="mb-3">
<label for="almacen" class="form-label">Almacen *</label>
<select name="almacen" id="almacen" class="form-control" required>
<?php
    foreach ($almacenes as $key => $row) {
        ?>
        <option value="<?php echo $row['id_almacen']; ?>"><?php echo $row['nombre_almacen']; ?></option>
        <?php
    }
    ?>
    </select>
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
<input type="hidden" name="controller" value="inventario">
<input type="hidden" name="action" value="insertar">
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div>
</body>
</html>