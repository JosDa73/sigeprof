<!-- Navbar Azul adaptado al sistema -->
<nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="home">
            <img src="../assets/img/logo.png" alt="SIGEPROF Logo" style="width: 60px" /> SIGEPROF
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-label="Boton de menú">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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

<!-- Contenido principal -->
<section class="container py-5 mt-5">
    <div class="text-center mb-5">
        <img src="../assets/img/logo.png" alt="SIGEPROF Logo" style="width: 300px;" class="mb-3">
        <h1 class="display-5 fw-bold text-primary">Bienvenido, <?php echo htmlspecialchars($data['nombre']); ?> 👋</h1>
        <p class="lead">Gestiona, comparte y evalúa proyectos formativos del SENA Oriente Antioqueño desde un solo lugar.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h4 class="card-title text-success">Insertar un nuevo proyecto</h4>
                    <p class="card-text">Agrega tu proyecto formativo, sube una imagen y enlázalo con tu repositorio en GitHub.</p>
                    <a href="home?page=insproj" class="btn btn-outline-success">Insertar proyecto</a>
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h4 class="card-title text-primary">Ver proyectos existentes</h4>
                    <p class="card-text">Explora los proyectos publicados por otros aprendices e instructores. ¡Inspírate y aprende!</p>
                    <a href="home?page=proj" class="btn btn-outline-primary">Ver proyectos</a>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <p class="text-muted">¿Sabías que puedes editar o eliminar tus proyectos en cualquier momento? Mantén tu portafolio actualizado.</p>
    </div>

    <hr class="my-5">

    <h3 class="text-center mb-4 text-secondary">Últimos proyectos publicados</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        $stmt = $conn->query("SELECT * FROM proyecto ORDER BY id DESC LIMIT 3");
        $ultimos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($ultimos) === 0) {
            echo '<p class="text-center text-muted">Aún no hay proyectos registrados.</p>';
        } else {
            foreach ($ultimos as $proyecto) {
                echo '
                <div class="col">
                    <div class="card h-100">
                        ' . ($proyecto['foto'] ? '<img src="' . $proyecto['foto'] . '" class="card-img-top" alt="Foto del proyecto">' : '') . '
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($proyecto['nombre']) . '</h5>
                            <p class="card-text"><strong>Estado:</strong> ' . htmlspecialchars($proyecto['estado']) . '</p>
                            <a href="' . htmlspecialchars($proyecto['enlace']) . '" class="btn btn-sm btn-primary" target="_blank">Ver en GitHub</a>
                        </div>
                    </div>
                </div>';
            }
        }
        ?>
    </div>
</section>