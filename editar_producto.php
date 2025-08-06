<?php
require 'includes/conexion.php';

$id = $_GET['id'];
$producto = $conn->query("SELECT * FROM productos WHERE id = $id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    if (!empty($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], "img/" . $imagen);
        $conn->query("UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', imagen='$imagen' WHERE id=$id");
    } else {
        $conn->query("UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio' WHERE id=$id");
    }

    header("Location: productos.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Producto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2 class="text-center text-info mb-4">Editar Producto</h2>
  <form method="POST" enctype="multipart/form-data" class="card shadow p-4">
    <div class="mb-3">
      <label class="form-label">Nombre:</label>
      <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Descripción:</label>
      <textarea name="descripcion" class="form-control" required><?= $producto['descripcion'] ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Precio:</label>
      <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Imagen (actual: <?= $producto['imagen'] ?>):</label>
      <input type="file" name="imagen" class="form-control">
    </div>
    <button type="submit" class="btn btn-info">Actualizar</button><br>
    <a href="productos.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
</body>
</html>
