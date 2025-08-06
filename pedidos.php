<?php
require 'includes/conexion.php';
$resultado = $conn->query("SELECT * FROM pedidos ORDER BY fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedidos | Cafetería Digital</title>
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
    
    .table-responsive {
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
    }
    
    .badge-pendiente {
      background-color: #ffc107;
      color: #000;
    }
    
    .badge-entregado {
      background-color: #198754;
    }
    
    .badge-cancelado {
      background-color: #dc3545;
    }
    
    .page-title {
      color: var(--primary-color);
      position: relative;
      padding-bottom: 10px;
    }
    
    .page-title:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 4px;
      background: var(--accent-color);
      border-radius: 2px;
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

<div class="container mt-4 mb-5">
  <h2 class="mb-4 page-title"><i class="fas fa-box-open me-2"></i>Pedidos recibidos</h2>

  <?php if ($resultado->num_rows > 0): ?>
  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Cliente</th>
          <th>Productos</th>
          <th>Total</th>
          <th>Fecha</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($pedido = $resultado->fetch_assoc()): ?>
        <tr>
          <td class="fw-bold"><?= $pedido['id'] ?></td>
          <td><?= htmlspecialchars($pedido['cliente']) ?></td>
          <td>
            <?php
              $items = explode(",", $pedido['productos']);
              foreach ($items as $item) {
                echo "<div class='d-flex align-items-center mb-1'><i class='fas fa-circle-notch fa-xs me-2 text-muted'></i><span>" . htmlspecialchars(trim($item)) . "</span></div>";
              }
            ?>
          </td>
          <td class="fw-bold">$<?= number_format($pedido['total'], 0, ',', '.') ?></td>
          <td><?= date('d/m/Y H:i', strtotime($pedido['fecha'])) ?></td>
          <td>
            <?php
              $estado = $pedido['estado'];
              $clase = match ($estado) {
                  'pendiente' => 'badge-pendiente',
                  'entregado' => 'badge-entregado',
                  'cancelado' => 'badge-cancelado',
                  default => 'bg-secondary'
              };
              $icono = match ($estado) {
                  'pendiente' => 'clock',
                  'entregado' => 'check-circle',
                  'cancelado' => 'times-circle',
                  default => 'question-circle'
              };
            ?>
            <span class="badge <?= $clase ?>"><i class="fas fa-<?= $icono ?> me-1"></i><?= ucfirst($estado) ?></span>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <?php else: ?>
    <div class="alert alert-info shadow-sm">
      <i class="fas fa-info-circle me-2"></i>No hay pedidos registrados aún.
    </div>
  <?php endif; ?>
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