<?php
require 'includes/conexion.php';
$resultado = $conn->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio | Cafetería Digital</title>
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
    
    .hero-section {
      background: linear-gradient(rgba(58, 90, 120, 0.8), rgba(44, 62, 80, 0.8)), 
                  url('https://images.unsplash.com/photo-1445116572660-236099ec97a0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
      background-size: cover;
      background-position: center;
      color: white;
      padding: 5rem 0;
      border-radius: 0 0 20px 20px;
      margin-bottom: 3rem;
    }
    
    .card {
      border: none;
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.3s ease;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    }
    
    .card-img-top {
      height: 200px;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    
    .card:hover .card-img-top {
      transform: scale(1.05);
    }
    
    .price-tag {
      font-size: 1.2rem;
      color: var(--accent-color);
      font-weight: bold;
    }
    
    .section-title {
      position: relative;
      margin-bottom: 2rem;
      color: var(--primary-color);
    }
    
    .section-title:after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 0;
      width: 60px;
      height: 4px;
      background: var(--accent-color);
      border-radius: 2px;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border: none;
      padding: 0.5rem 1.5rem;
      border-radius: 50px;
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      background-color: #2c3e50;
      transform: translateY(-2px);
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
          <a class="nav-link active" href="menu.php"><i class="fas fa-home me-1"></i> Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="productos.php"><i class="fas fa-coffee me-1"></i> Productos</a>
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

<!-- Hero Section -->
<section class="hero-section">
  <div class="container text-center">
    <h1 class="display-4 fw-bold mb-3">¡Bienvenido a la Cafetería Digital!</h1>
    <p class="lead mb-4">Disfruta de nuestros exquisitos productos y realiza tus pedidos con un solo clic.</p>
    <button class="btn btn-light btn-lg px-4"><i class="fas fa-coffee me-2"></i>Ver Menú</button>
  </div>
</section>

<!-- Productos destacados -->
<div class="container mb-5">
  <h2 class="section-title">Nuestros Productos Destacados</h2>
  
  <div class="row g-4">
    <?php while ($producto = $resultado->fetch_assoc()): ?>
    <div class="col-lg-4 col-md-6">
      <div class="card h-100">
        <img src="img/<?= $producto['imagen'] ?>" class="card-img-top" alt="<?= htmlspecialchars($producto['nombre']) ?>">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
          <p class="card-text text-muted"><?= htmlspecialchars($producto['descripcion']) ?></p>
        </div>
        <div class="card-footer bg-transparent">
          <div class="d-flex justify-content-between align-items-center">
            <span class="price-tag">$<?= number_format($producto['precio'], 0, ',', '.') ?></span>
            <button class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i>Agregar</button>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
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