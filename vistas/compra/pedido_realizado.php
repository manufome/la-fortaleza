
<!DOCTYPE html>
<html>
<head>
    <title>Resumen del Pedido</title>
    <style>
        /* Estilos CSS para el resumen del pedido */
    </style>
</head>
<body>
    <h1>Resumen del Pedido</h1>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo $producto['precio']; ?></td>
                    <td><?php echo $producto['cantidad'] * $producto['precio']; ?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <p>Total a pagar: <?php echo $total; ?></p>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Pedido Realizado</title>
    <style>
        /* Estilos CSS para la vista de pedido realizado */
    </style>
</head>
<body>
    <h1>Pedido Realizado</h1>
    <p>¡Su pedido ha sido realizado con éxito!</p>
    <p>¿Desea imprimir un recibo de compra?</p>
    <button onclick="imprimirRecibo()">Imprimir Recibo</button>

    <script>
        function imprimirRecibo() {
            // Lógica para imprimir el recibo de compra
            window.print();
        }
    </script>
</body>
</html>
