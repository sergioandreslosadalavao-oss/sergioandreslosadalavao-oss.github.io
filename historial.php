<?php
require 'includes/conexion.php';

// Obtener los registros del historial de productos
$query = "SELECT * FROM historial_productos ORDER BY fecha_registro DESC";
$resultado = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Productos | Cafetería Digital</title>
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
            padding-bottom: 15px;
            margin-bottom: 2rem;
            color: var(--primary-color);
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
        
        .history-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color), #2c3e50);
            color: white;
            font-weight: 600;
            padding: 1.2rem;
            text-align: center;
        }
        
        .table-container {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table thead {
            background-color: rgba(58, 90, 120, 0.1);
            color: var(--primary-color);
        }
        
        .table th {
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
            padding: 1rem;
        }
        
        .table td {
            vertical-align: middle;
            padding: 0.8rem;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(58, 90, 120, 0.05);
        }
        
        .empty-state {
            padding: 3rem;
            text-align: center;
        }
        
        .empty-state i {
            font-size: 3rem;
            color: rgba(58, 90, 120, 0.3);
            margin-bottom: 1rem;
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

<div class="container my-5">
    <h2 class="text-center page-header">
        <i class="fas fa-history me-2"></i>Historial de Productos
    </h2>
    
    <div class="history-card">
        <div class="card-header">
            <i class="fas fa-clock-rotate-left me-2"></i>Registro de Productos
        </div>
        <div class="card-body p-0">
            <?php if ($resultado && $resultado->num_rows > 0): ?>
            <div class="table-container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Producto</th>
                            <th>Precio</th>
                            <th>Fecha de Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $resultado->fetch_assoc()): ?>
                            <tr>
                                <td class="text-center fw-bold"><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['nombre']) ?></td>
                                <td class="text-center fw-bold text-primary">$<?= number_format($row['precio'], 0, ',', '.') ?></td>
                                <td class="text-center">
                                    <i class="far fa-calendar-alt me-2 text-muted"></i>
                                    <?= date('d/m/Y H:i', strtotime($row['fecha_registro'])) ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h5 class="text-muted">No hay productos registrados aún</h5>
                    <p class="text-muted">El historial de productos aparecerá aquí</p>
                </div>
            <?php endif; ?>
        </div>
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