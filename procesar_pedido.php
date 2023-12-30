<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera la información del cliente
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $customer_phone = $_POST['customer_phone'];

    // Puedes realizar acciones con la información del cliente aquí

    // Redirige a otra página o realiza acciones adicionales según tu lógica
    header('Location: confirmacion_pedido.php');
    exit();
}
?>
