<?php
include 'clientes_operaciones.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clientes_id = $_POST['clientes_id'];
    $nombre_nuevo = $_POST['nombre_nuevo'];
    $direccion_nueva = $_POST['direccion_nueva'];
    $ciudad_nueva = $_POST['ciudad_nueva'];
    $telefono_nuevo = $_POST['telefono_nuevo'];

    agregarCliente($clientes_id, $nombre_nuevo, $direccion_nueva, $ciudad_nueva, $telefono_nuevo);

    header("Location: select_cliente.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nuevo Cliente</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<h2>Agregar Cliente</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <label for="clientes_id">Id:</label>
    <input type="text" name="clientes_id"><br>

    <label for="nombre_nuevo">Nombre:</label>
    <input type="text" name="nombre_nuevo"><br>

    <label for="direccion_nueva">Dirección:</label>
    <input type="text" name="direccion_nueva"><br>

    <label for="ciudad_nueva">Ciudad:</label>
    <input type="text" name="ciudad_nueva"><br>

    <label for="telefono_nuevo">Teléfono:</label>
    <input type="text" name="telefono_nuevo"><br>

    <input type="submit" value="Agregar Cliente">
</form>

</body>
</html>
