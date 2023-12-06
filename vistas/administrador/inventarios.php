<!DOCTYPE html>
<html lang="en">
<?php require 'vistas/includes/_header.php'?>

<div id= "content">
        <section>
<div class="container mt-5" style="margin-bottom: 50px;">
<div class="row">
<div class="col-sm-12 mb-3">
<center><h1>Productos</h1></center>
<a href="index.php?controller=inventario&action=agregar"><input  class="btn btn-primary" type="button" value="Agregar producto"></a>
</div>
<!-- Colores de alerta -->
<div class="col-sm-4">
        <div class="alert alert-danger" role="alert">
            Stock muy bajo
        </div>
    </div>
    <div class="col-sm-4">
        <div class="alert alert-warning" role="alert">
            Stock bajo
        </div>
    </div>
    <div class="col-sm-4">
        <div class="alert alert-info" role="alert">
            Stock medio
        </div>
    </div>
<!-- Fin colores de alerta -->
<div class="col-sm-12" >
<div class="table-responsive">
<table  class="table table-striped table-hover" id="myTable">
<thead>

<tr>
<th>Id</th>
<th>Nombre</th>
<th>Categoria</th>
<th>Precio</th>
<th>Stock</th>
<th>Almacen</th>
<th>Alerta</th>
<th>Imagen</th>
<th>Acciones</th>


</tr>

</thead>

<tbody>

<?php
foreach ($productos as $key => $row) {
    ?>
<!-- empieza la tabla-->

<?php
if ($row['stock'] <= $row['alerta']) {
        $color = '#fadbd8';
    } elseif ($row['stock'] <= $row['alerta'] * 2) {
        $color = '#fdf3d8';
    } elseif ($row['stock'] <= $row['alerta'] * 4) {
        $color = '#d7f1f5';
    } else {
        $color = '';
    }
    ?>

<tr style="background-color: <?php echo $color; ?>">
<td><?php echo $row['id_producto']; ?></td>
<td><?php echo $row['nombre_producto']; ?></td>
<td><?php echo $row['nombre_categoria']; ?></td>
<td>$<?php echo $row['precio_venta']; ?></td>
<td><?php echo $row['stock']; ?></td>



<td><?php echo $row['nombre_almacen']; ?></td>
<td <?php echo $row['alerta']; ?>><?php echo $row['alerta']; ?></td>


<td><img width="100" src="assets/images/productos/<?php echo $row['nombre_producto'] . '.png'; ?>"></td>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script>
    let table = new DataTable('#myTable', {
        // searchable: true,
        // perPage: 5,
        // perPageSelect: [5, 10, 15, 20, 25, 30],
        // labels: {
        //     placeholder: "Buscar...",
        //     perPage: "{select} productos por página",
        //     noRows: "No se encontraron productos",
        //     info: "Mostrando {start} a {end} de {rows} productos (Página {page} de {pages})"
        // }
    });

    </script>
    <?php require 'vistas/includes/footer.php'?>
</html>