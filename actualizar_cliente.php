<?php
include 'clientes_operaciones.php';

// Verificar si se recibió un ID válido mediante GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $cliente_id = $_GET['id'];

    $conn = conectarBaseDeDatos();
    $consulta = "SELECT * FROM clientes WHERE id = $cliente_id";
    $resultado = $conn->query($consulta);

    if ($resultado->num_rows > 0) {
        $cliente = $resultado->fetch_assoc();
    }

    $conn->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se hayan recibido los datos del formulario
    if (isset($_POST['clientes_id'], $_POST['nombre_actualizado'], $_POST['direccion_actualizada'], $_POST['ciudad_actualizada'], $_POST['telefono_actualizado'])) {
        $cliente_id = $_POST['cliente_id'];
        $clientes_id = $_POST['clientes_id'];
        $nombre_actualizado = $_POST['nombre_actualizado'];
        $direccion_actualizada = $_POST['direccion_actualizada'];
        $ciudad_actualizada = $_POST['ciudad_actualizada'];
        $telefono_actualizado = $_POST['telefono_actualizado'];

        actualizarCliente($cliente_id, $clientes_id, $nombre_actualizado, $direccion_actualizada, $ciudad_actualizada, $telefono_actualizado);

        header("Location: select_cliente.php");
        exit();
    } else {
        echo "Error: No se recibieron todos los datos necesarios para actualizar el cliente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cliente</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<?php if (isset($cliente)) : ?>
    <h2>Actualizar Cliente</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="cliente_id" value="<?php echo $cliente['id']; ?>">
        <label for="clientes_id">Identificador único:</label>
        <input type="text" name="clientes_id" value="<?php echo $cliente['clientes_id']; ?>"><br>

        <label for="nombre_actualizado">Nombre:</label>
        <input type="text" name="nombre_actualizado" value="<?php echo $cliente['clientes_nombre']; ?>"><br>

        <label for="direccion_actualizada">Dirección:</label>
        <input type="text" name="direccion_actualizada" value="<?php echo $cliente['clientes_direccion']; ?>"><br>

        <label for="ciudad_actualizada">Ciudad:</label>
        <input type="text" name="ciudad_actualizada" value="<?php echo $cliente['clientes_ciudad']; ?>"><br>

        <label for="telefono_actualizado">Teléfono:</label>
        <input type="text" name="telefono_actualizado" value="<?php echo $cliente['clientes_telefono']; ?>"><br>

        <input type="submit" value="Actualizar Cliente">
    </form>
<?php endif; ?>

</body>
</html>
