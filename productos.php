<?php
require 'includes/conexion.php';
$productos = $conn->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos | Cafetería Digital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #3a5a78;
      --secondary-color: #f8f9fa;
      --accent-color: #ff6b6b;
    }
    
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    
    .navbar {
      background: linear-gradient(135deg, var(--primary-color), #2c3e50);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .navbar-brand {
      font-family: 'Pacifico', cursive;
      font-size: 1.5rem;
    }
    
    .page-header {
      position: relative;
      padding-bottom: 10px;
      margin-bottom: 2rem;
    }
    
    .page-header:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 4px;
      background: var(--accent-color);
      border-radius: 2px;
    }
    
    .table-container {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    
    .table thead {
      background: linear-gradient(135deg, var(--primary-color), #2c3e50);
      color: white;
    }
    
    .table th {
      font-weight: 500;
      text-align: center;
      vertical-align: middle;
    }
    
    .table td {
      vertical-align: middle;
    }
    
    .product-img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    
    .product-img:hover {
      transform: scale(1.1);
    }
    
    .btn-add {
      background-color: var(--primary-color);
      border: none;
      transition: all 0.3s ease;
    }
    
    .btn-add:hover {
      background-color: #2c3e50;
      transform: translateY(-2px);
    }
    
    .action-buttons .btn {
      margin: 0 3px;
      min-width: 80px;
    }
    
    /* Footer Minimalista */
    footer {
      background: var(--primary-color);
      color: white;
      padding: 2rem 0;
      margin-top: auto;
      text-align: center;
    }
    
    .footer-content {
      max-width: 600px;
      margin: 0 auto;
    }
    
    .footer-logo {
      font-family: 'Pacifico', cursive;
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }
    
    .footer-contact {
      margin-bottom: 1rem;
      font-size: 0.9rem;
    }
    
    .footer-contact i {
      margin-right: 5px;
    }
    
    .copyright {
      font-size: 0.8rem;
      color: rgba(255, 255, 255, 0.7);
    }
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="fas fa-coffee me-2"></i>Cafetería Digital</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCafeteria">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCafeteria">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="menu.php"><i class="fas fa-home me-1"></i> Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="productos.php"><i class="fas fa-coffee me-1"></i> Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pedidos.php"><i class="fas fa-shopping-cart me-1"></i> Pedidos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="historial.php"><i class="fas fa-history me-1"></i> Historial</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4 mb-5">
  <h2 class="text-center text-primary page-header"><i class="fas fa-boxes me-2"></i>Gestión de Productos</h2>
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <a href="agregar_producto.php" class="btn btn-add btn-success">
      <i class="fas fa-plus-circle me-2"></i>Agregar Producto
    </a>
  </div>
  
  <div class="table-container">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Precio</th>
          <th>Imagen</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($p = $productos->fetch_assoc()): ?>
        <tr>
          <td class="text-center fw-bold"><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['nombre']) ?></td>
          <td class="fw-bold">$<?= number_format($p['precio'], 0, ',', '.') ?></td>
          <td class="text-center">
            <img src="img/<?= $p['imagen'] ?>" class="product-img" alt="<?= htmlspecialchars($p['nombre']) ?>">
          </td>
          <td class="action-buttons text-center">
            <a href="editar_producto.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">
              <i class="fas fa-edit me-1"></i>Editar
            </a>
            <a href="eliminar_producto.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
              <i class="fas fa-trash-alt me-1"></i>Eliminar
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Footer Minimalista -->
<footer>
  <div class="container">
    <div class="footer-content">
      <div class="footer-logo">
        <i class="fas fa-coffee me-2"></i>Cafetería Digital
      </div>
      <div class="footer-contact">
        <p><i class="fas fa-map-marker-alt"></i> Av. Digital 123, Santiago</p>
        <p><i class="fas fa-phone"></i> +56 9 1234 5678 | <i class="fas fa-envelope"></i> contacto@cafeteriadigital.cl</p>
      </div>
      <div class="copyright">
        <p>&copy; <?= date('Y') ?> Cafetería Digital. Todos los derechos reservados.</p>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>