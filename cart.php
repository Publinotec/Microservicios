<?php
session_start();

// Validar si se seleccionó un cliente
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['cliente_id'])) {
    // Configuración de la conexión a la base de datos
    $host = "localhost";
    $user = "root";
    $password = "Palamor_5";
    $database = "carrito_compras";

    // Crear conexión
    $conn = new mysqli($host, $user, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener el ID del cliente seleccionado
    $clientes_id = $_GET['cliente_id'];

    // Consulta para obtener los datos del cliente desde la base de datos
    $consulta_cliente = "SELECT * FROM clientes WHERE id = $clientes_id";
    $resultado_cliente = $conn->query($consulta_cliente);

    // Verificar si se encontraron resultados
    if ($resultado_cliente->num_rows > 0) {
        $row_cliente = $resultado_cliente->fetch_assoc();

        // Datos del cliente desde la base de datos
        $cliente_id = $row_cliente['id'];
        $clientes_id = $row_cliente['clientes_id'];

        $clientes_nombre = $row_cliente['clientes_nombre'];
        $clientes_direccion = $row_cliente['clientes_direccion'];
        $clientes_ciudad = $row_cliente['clientes_ciudad'];
        $clientes_telefono = $row_cliente['clientes_telefono'];

        // Almacenar los datos del cliente en la sesión
        $_SESSION['cliente'] = [
            'cliente_id' => $cliente_id,
            'clientes_id' => $clientes_id,

            'clientes_nombre' => $clientes_nombre,
            'clientes_direccion' => $clientes_direccion,
            'clientes_ciudad' => $clientes_ciudad,
            'clientes_telefono' => $clientes_telefono,
        ];
    }

    // Cerrar la conexión
    $conn->close();
}

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

    <?php

    // Verificar si las variables están definidas antes de mostrarlas
    if (isset($clientes_id)) {
        echo "<div style='margin-bottom: 10px;'><strong>ID:</strong> {$clientes_id}</div>";
    }
    if (isset($clientes_nombre)) {
        echo "<div style='margin-bottom: 10px;'><strong>Nombres:</strong> {$clientes_nombre}</div>";
    }
    if (isset($clientes_direccion)) {
        echo "<div style='margin-bottom: 10px;'><strong>Dirección:</strong> {$clientes_direccion}</div>";
    }
    if (isset($clientes_ciudad)) {
        echo "<div style='margin-bottom: 10px;'><strong>Ciudad:</strong> {$clientes_ciudad}</div>";
    }
    if (isset($clientes_telefono)) {
        echo "<div style='margin-bottom: 10px;'><strong>Teléfono:</strong> {$clientes_telefono}</div>";
    }

   
    ?>

    <h2>Items comprados</h2>

    <?php
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo "<table>";
        echo "<tr>";
        echo "<th>Producto</th>";
        echo "<th>Cantidad</th>";
        echo "<th>Valor Unitario</th>";
        echo "<th>Subtotal</th>";
        echo "</tr>";

        foreach ($_SESSION['cart'] as $item) {
            echo "<tr>";
            echo "<td>{$item['name']}</td>";
            echo "<td>{$item['quantity']}</td>";
            echo "<td>{$item['price']} </td>";
            echo "<td>{$item['total']} </td>";
            echo "</tr>";
        }

        // Calcular la sumatoria de precios en el carrito
        $total_price = array_sum(array_column($_SESSION['cart'], 'total'));

        echo "<tr class='total'>";
        echo "<td colspan='3'><strong>Total General</strong></td>";
        echo "<td><strong>{$total_price} USD</strong></td>";
        echo "</tr>";

        echo "</table>";
    } else {
        echo "<p>El carrito está vacío.</p>";
    }

    // Verificar si se ha seleccionado un cliente
    if (isset($_GET['cliente_id'])) {
        $cliente_id_seleccionado = $_GET['cliente_id'];

        // Realizar una consulta para obtener los datos del cliente seleccionado
        // y almacenarlos en la sesión o en variables según sea necesario
        // ...

        // Redirigir a la misma página (cart.php) o recargar la información según tu lógica
        // header('Location: cart.php');
        // exit();
    }
    ?>

    <div style='text-align: center;'>
        <a href='index.php'>
            <img src='images/comprar.png' alt='Procesar pedido' width='150 height='150'>
        </a>
        <a href='pagar.php'>
            <img src='images/pagar.png' alt='Procesar pedido' width='150 height='150'>
        </a>
    </div>

</body>
</html>

