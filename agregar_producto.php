<?php
include 'includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = floatval($_POST['precio']);

    if (!empty($nombre) && $precio > 0) {
        // Insertar en productos
        $stmt = $conexion->prepare("INSERT INTO productos (nombre, descripcion, precio) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $nombre, $descripcion, $precio);
        $stmt->execute();

        // Insertar en historial
        $stmt_historial = $conexion->prepare("INSERT INTO historial_productos (nombre, precio) VALUES (?, ?)");
        $stmt_historial->bind_param("sd", $nombre, $precio);
        $stmt_historial->execute();

        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Producto agregado',
                    text: 'El producto fue guardado correctamente',
                    confirmButtonColor: '#007bff'
                });
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Nombre o precio inválidos',
                    confirmButtonColor: '#007bff'
                });
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Agregar Nuevo Producto</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="agregar_producto.php">
                    <div class="mb-3">
                        <label class="form-label">Nombre del producto</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" name="precio" class="form-control" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    <a href="productos.php" class="btn btn-secondary">Volver</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
