<?php
include 'clientes_operaciones.php';

// Configuración de la conexión a la base de datos (si es necesario)
$host = "localhost";
$user = "root";
$password = "Palamor_5";
$database = "carrito_compras";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Inicializar variables
$resultados = [];
$clientes_nombre = '';

// Procesar la búsqueda si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre ingresado
    $clientes_nombre = $_POST['busqueda_nombres'];

    // Consulta para obtener los datos de los clientes que coincidan con el nombre
    $consulta_busqueda = "SELECT * FROM clientes WHERE clientes_nombre LIKE '%$clientes_nombre%'";
    $resultado_busqueda = $conn->query($consulta_busqueda);

    // Almacenar los resultados en un arreglo
    while ($row = $resultado_busqueda->fetch_assoc()) {
        $resultados[] = $row;
    }
}

// Cerrar la conexión
$conn->close();

// Almacenar los resultados de la búsqueda en la sesión
$_SESSION['resultados'] = $resultados;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Resumen</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

    <h2 style="text-align: center; font-size: 24px;">Datos del Cliente</h2>
    

    <form method="post" action="select_cliente.php">
        <div style="max-width: 500px; margin: 0 auto; text-align: center; font-size: 18px;">
            
            <div style="margin-bottom: 15px;">
                <label style="display: inline-block; width: 200px;" for="busqueda_nombres">Buscar Nombres:</label>
                <!-- Campo de búsqueda para filtrar nombres -->
                <input type="text" id="busqueda_nombres" name="busqueda_nombres" value="<?php echo $clientes_nombre; ?>">
                <!-- Botón para ejecutar la búsqueda -->
                <input type="submit" value="Buscar">
            </div>
        </div>
        <!-- Agregar un botón para dirigirse a crear_cliente.php -->
        <div style="margin-bottom: 15px;">
        <a href="agregar_cliente.php" style="text-decoration: none;">
        <button type="button" style="padding: 10px 15px; font-size: 16px;">Crear Cliente</button>
    </a>
</div>
    </form>

    <?php if (!empty($resultados)) : ?>
        <h2>Resultados de la Búsqueda</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Teléfono</th>
                <th>Acciones</th> <!-- Nueva columna para las acciones -->
            </tr>
            <?php foreach ($resultados as $cliente) : ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['clientes_nombre']; ?></td>
                    <td><?php echo $cliente['clientes_direccion']; ?></td>
                    <td><?php echo $cliente['clientes_ciudad']; ?></td>
                    <td><?php echo $cliente['clientes_telefono']; ?></td>
                    <!-- Botones para actualizar, seleccionar y eliminar -->
                    <td>
                        <form method="get" action="actualizar_cliente.php">
                            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
                            <button type="submit">Actualizar</button>
                        </form>
                        <form method="get" action="cart.php">
                            <input type="hidden" name="cliente_id" value="<?php echo $cliente['id']; ?>">
                            <button type="submit">Seleccionar</button>
                        </form>
                        <form method="post" action="eliminar_cliente.php">
                            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    
</body>
</html>
