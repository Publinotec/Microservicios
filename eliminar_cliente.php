<?php
include 'clientes_operaciones.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['confirmar_eliminar'])) {
    // Confirmación recibida, proceder con la eliminación
    $cliente_id = $_POST['id'];
    
    // Lógica para eliminar cliente
    eliminarCliente($cliente_id);

    // Mostrar mensaje después de eliminar
    echo "Cliente eliminado correctamente..redireccionando";

    // Redireccionar a select_cliente.php después de unos segundos
    header("refresh:2;url=select_cliente.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Mostrar confirmación antes de eliminar
    $cliente_id = $_POST['id'];
    echo "¿Estás seguro de que deseas eliminar este cliente?";
    echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
    echo "<input type='hidden' name='id' value='$cliente_id'>";
    echo "<input type='hidden' name='confirmar_eliminar' value='1'>";
    echo "<input type='submit' value='Sí'>";
    echo "</form>";
    echo "<a href='select_cliente.php'>No</a>";
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    header("Allow: POST");
    echo json_encode(array("error" => "Método no permitido o ID no proporcionado"));
    exit();
}
?>

