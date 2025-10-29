<!DOCTYPE html>
<html lang="es-CO" class="h-100">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proyectos Formativos - SIGEPROF</title>

  <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    body {
      background: linear-gradient(135deg, #e3f2fd 0%, #fff 100%);
    }
    .navbar {
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    .navbar-brand img {
      transition: transform 0.3s;
    }
    .navbar-brand img:hover {
      transform: scale(1.1) rotate(-5deg);
    }
    .section-title {
      color: #1976d2;
      font-weight: 700;
      margin-bottom: 18px;
    }
    .card-proyecto {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card-proyecto:hover {
      transform: translateY(-6px);
      box-shadow: 0 6px 24px rgba(25, 118, 210, 0.18);
    }
  </style>
</head>

<body class="h-100">

  <!-- Navbar Azul -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="home">
        <img src="../assets/img/logo.png" alt="SIGEPROF Logo" style="width: 60px" /> SIGEPROF
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"
        aria-label="Boton de menú">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="home?page=proj">Proyectos</a></li>
          <li class="nav-item"><a class="nav-link" href="home?page=tableusers">Tabla de Usuarios</a></li>
        </ul>
        <div class="d-flex">
          <a href="home?page=perfil" class="btn btn-light text-dark me-2">Mi perfil</a>
          <a href="./logout" class="btn btn-danger">Salir</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Contenido -->
  <main class="container pt-5 mt-5">
    <section class="section-card py-5">
      <h1 class="section-title text-center">Proyectos Formativos</h1>

      <?php
      include 'conn.php';
      $stmt = $conn->query("SELECT * FROM proyecto ORDER BY id DESC");
      $proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($proyectos) === 0) {
        echo '<p class="text-center" style="font-size: 20px;">Actualmente no hay proyectos formativos, vuelve más tarde.</p>';
      } else {
        echo '<div class="row row-cols-1 row-cols-md-3 g-4">';
        foreach ($proyectos as $proyecto) {
          echo '
          <div class="col">
            <div class="card card-proyecto h-100">
              ' . ($proyecto['foto'] ? '<img src="' . $proyecto['foto'] . '" class="card-img-top" alt="Foto del proyecto">' : '') . '
              <div class="card-body">
                <h5 class="card-title">' . htmlspecialchars($proyecto['nombre']) . '</h5>
                <p class="card-text"><strong>Estado:</strong> ' . htmlspecialchars($proyecto['estado']) . '</p>
                <a href="' . htmlspecialchars($proyecto['enlace']) . '" class="btn btn-primary" target="_blank">Ver en GitHub</a>
              </div>
            </div>
          </div>';
        }
        echo '</div>';
      }
      ?>
    </section>
  </main>

  <footer class="footer text-center bg-dark text-white py-3 mt-5">
    <div class="container">
      <span>&copy; 2024-2025 SIGEPROF | by ZJosDaX</span>
    </div>
  </footer>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>