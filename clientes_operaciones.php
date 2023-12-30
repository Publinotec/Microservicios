<?php
session_start();

function conectarBaseDeDatos() {
    $host = "localhost";
    $user = "root";
    $password = "Palamor_5";
    $database = "carrito_compras";

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    return $conn;
}


function agregarCliente($clientes_id, $nombre, $direccion, $ciudad, $telefono) {
    $conn = conectarBaseDeDatos();

    $stmt = $conn->prepare("INSERT INTO clientes (clientes_id, clientes_nombre, clientes_direccion, clientes_ciudad, clientes_telefono) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $clientes_id, $nombre, $direccion, $ciudad, $telefono);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

function actualizarCliente($id, $clientes_id, $nombre, $direccion, $ciudad, $telefono) {
    $conn = conectarBaseDeDatos();

    $stmt = $conn->prepare("UPDATE clientes SET clientes_id=?, clientes_nombre=?, clientes_direccion=?, clientes_ciudad=?, clientes_telefono=? WHERE id=?");
    $stmt->bind_param("sssssi", $clientes_id, $nombre, $direccion, $ciudad, $telefono, $id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

function eliminarCliente($id) {
    $conn = conectarBaseDeDatos();

    $stmt = $conn->prepare("DELETE FROM clientes WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

?>
