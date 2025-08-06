<?php
require 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Procesar imagen
    $imagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombreImagen = time() . '_' . basename($_FILES["imagen"]["name"]);
        $rutaDestino = 'imagenes/' . $nombreImagen;
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino);
        $imagen = $rutaDestino;
    }

    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $nombre, $descripcion, $precio, $imagen);

    if ($stmt->execute()) {
        header('Location: productos.php?mensaje=agregado');
        exit();
    } else {
        echo "Error al guardar: " . $conn->error;
    }
}
?>
