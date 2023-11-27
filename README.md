# la-fortaleza

Este proyecto es un sistema de comercio electrónico diseñado para un supermercado, implementado utilizando el patrón Modelo-Vista-Controlador (MVC) con PHP y MySQL.

## TODO

1. **Gestión de Productos:** Permite agregar, modificar y eliminar productos del inventario. Cada producto tiene información detallada, como nombre, descripción, precio, y categoría.

2. **Categorías de Productos:** Los productos están organizados en categorías para facilitar la navegación y búsqueda de productos específicos.

3. **Carrito de Compras:** Los usuarios pueden agregar productos a su carrito de compras y proceder a realizar la compra.

4. **Gestión de Órdenes:** Funcionalidad completa para realizar y gestionar órdenes de compra. Cada orden incluye información sobre los productos seleccionados, el total de la compra y el estado del pedido.

5. **Gestión de Usuarios:** Los usuarios pueden registrarse, iniciar sesión y gestionar sus perfiles. La autenticación garantiza una experiencia personalizada y segura.

## Requisitos del Sistema

-   Servidor web con soporte para PHP.
-   Servidor de base de datos MySQL.
-   PHP 7.x o superior.

## Instalación

1. Clona este repositorio en tu servidor local:

    ```bash
    git clone https://github.com/manufome/la-fortaleza.git
    ```

2. Configura la base de datos:

    - Importa el archivo SQL proporcionado en la carpeta `ScriptSQL` para crear la estructura de la base de datos.

3. Configuración de Conexión a la Base de Datos:

    - Actualiza los detalles de conexión en el archivo `modelos/database.php` con tu información de base de datos.

4. Accede al sistema:

    - Abre tu navegador y visita `http://localhost/index.php` para acceder al sistema.
