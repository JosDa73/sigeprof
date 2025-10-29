<!DOCTYPE html>
<html lang="es-CO" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Proyecto - SIGEPROF</title>

    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .navbar {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand img {
            transition: transform 0.3s;
        }

        .navbar-brand img:hover {
            transform: scale(1.1) rotate(-5deg);
        }
    </style>
</head>

<body class="bg-reg"
    style="background-image: url('../assets/img/font.png'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;">

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

    <!-- Formulario -->
    <main class="form-signin m-auto pt-5 pb-5 mt-4 col-md-4" style="margin: 50px;">
        <div class="card" style="border: 3px solid white; background-color: black; color: white;">
            <div class="card-body">

                <div class="text-center">
                    <img src="../assets/img/logosige.png" alt="Logo" width="251" height="125">
                    <h1 class="display-6">Insertar Proyecto</h1>
                </div>

                <form action="insertar_proyecto.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="nombre">Nombre del proyecto</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            placeholder="Nombre del proyecto" style="background-color: gray; border-color: gray;"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Estado del proyecto</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="estado" id="planeado" value="Planeado"
                                required>
                            <label class="form-check-label" for="planeado">Planeado</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="estado" id="proceso" value="En Proceso">
                            <label class="form-check-label" for="proceso">En Proceso</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="estado" id="completado"
                                value="Completado">
                            <label class="form-check-label" for="completado">Completado</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="enlace">Enlace del proyecto (GitHub)</label>
                        <input type="url" name="enlace" id="enlace" class="form-control"
                            placeholder="https://github.com/usuario/repositorio"
                            style="background-color: gray; border-color: gray;" required>
                    </div>

                    <div class="mb-3">
                        <label for="foto">Foto del proyecto (opcional)</label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*"
                            style="background-color: gray; border-color: gray;">
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success btn-block">Guardar proyecto</button>
                    </div>
                </form>

                <!-- Tutorial GitHub -->
                <div class="mt-5">
                    <h4>¿Cómo subir tu proyecto a GitHub?</h4>
                    <ol>
                        <li>Crea una cuenta en <a href="https://github.com" target="_blank">GitHub</a>.</li>
                        <li>Instala <a href="https://git-scm.com/" target="_blank">Git</a> en tu computador.</li>
                        <li>Abre tu terminal y navega a la carpeta del proyecto.</li>
                        <li>Ejecuta los siguientes comandos:
                            <pre style="background-color: #222; color: #0f0; padding: 10px; border-radius: 5px;">
git init
git add .
git commit -m "Primer commit"
git remote add origin https://github.com/usuario/repositorio.git
git push -u origin master
              </pre>
                        </li>
                        <li>Tu proyecto estará disponible en GitHub.</li>
                    </ol>
                    <p>
                        También puedes ver el
                        <a href="https://docs.github.com/es/get-started/start-your-journey/uploading-a-project-to-github"
                            target="_blank">
                            tutorial oficial de GitHub
                        </a>.
                        <span style="color: #00ff88; font-weight: bold;">(Recomendado)</span>
                    </p>

                </div>

            </div>
        </div>
    </main>

    <footer>
        <div class="card-footer bg-dark">
            <p class="m y-5 py-4 text-center bg-black text-white">&copy; Copyright 2024-2025: by ZJosDaX</p>
        </div>
    </footer>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>