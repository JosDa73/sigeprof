<?php
include_once 'conn.php';
session_start();

if (isset($_POST['btnlogin'])) {
    $login = $conn->prepare("SELECT * FROM instructor WHERE correo = ?");
    $login->bindParam(1, $_POST['correo']);
    $login->execute();
    $row = $login->fetch(PDO::FETCH_ASSOC);

    if (is_array($row)) {
        if (password_verify($_POST['contraseña'], $row['contrasenha'])) {
            switch ($row['rol']) {
                case 'instructor':
                    $_SESSION['instructor'] = $row['correo'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['rol'] = $row['rol'];
                    header("Location: home");
                    break;

                case 'aprendiz':
                    $_SESSION['instructor'] = $row['correo'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['rol'] = $row['rol'];
                    header("Location: homeu");
                    break;

                default:
                    header("Location: ./");
                    break;
            }

        } else {
            $msg = array("Contraseña incorrecta", "warning");
        }
    } else {
        $msg = array("El correo no existe", "danger");
    }
}

?>

<!DOCTYPE html>
<html lang="es-CO" class="h-100">

<head>
    <meta charset="UTF-8">
    <!--Tipos de Caracteres que Acepta-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Responsive-->
    <title>SIGEPROF</title>

    <!--Favicon-->
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">

    <!--SEO Tags-->
    <meta name="author" content="SIGEPROF">
    <meta name="description" content="Aplicativo Web Bootstrap">
    <meta name="keywords"
        content="SENA, sena, Sena, PROYECTO, proyecto, Proyecto, FORMATIVO, formativo, Formativo, SISTEMA, sistema, Sistema, GESTION, gestion, Gestion, SIGEPROF, sigeprof, Sigeprof">

    <!--Optimization Tags-->
    <meta name="theme-color" content="#000000">
    <meta name="MobileOptimized" content="width">
    <meta name="HandlhledFriendly" content="true">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-traslucent">

    <!--Styles and Complements Bootstrap 5.3.3.0-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!--styles Icons Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!--Navbar Azul-->
    <style>
        .navbar {
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .navbar-brand img {
            transition: transform 0.3s;
        }
        .navbar-brand img:hover {
            transform: scale(1.1) rotate(-5deg);
        }
    </style>
</head>

<body class="bg-log"
    style="background-image: url('../assets/img/font.png'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

    <header>
        <!--Navbar-->
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
            <dXiv class="container-fluid">
                <a class="navbar-brand" href="../index.html">
                    <img src="../assets/img/logo.png" alt="Avatar Logo" style="width: 60px" class="" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavbar" aria-label="Boton de menú">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./">Inicio</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <button class="btn btn-danger" type="button"
                            onclick="location.href='../index.html'">Salir</button>
                    </div>
                </div>
            </div>
        </nav>
        <!--Navbar-->

    </header>

    <main class="form-signin m-auto pt-5 pb-5 mt-4 col-md-4" style="margin: 50px;">
        <div class="card" style="border: 3px solid white;  background-color: black; color: white;">
            <div class="card-body">

                <!--Section alerts-->
                <?php if (isset($msg)) { ?>
                    <div class="alert alert-<?php echo $msg[1]; ?> alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Alerta!</strong>
                        <?php echo $msg[0]; ?>
                    </div>
                <?php } ?>
                <!--Section alerts-->

                <div class="text-center">
                    <img src="../assets/img/logosige.png" alt="Logo" width="250" height="125">
                    <h1 class="display-6">Inicio de Sesión</h1>
                </div>
                <form action="" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="mb-3 mt-3">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="correo" placeholder="Ingrese su correo"
                            name="correo" style="background-color: gray; border-color: gray" required>
                    </div>

                    <div>
                        <label for="contraseña" class="form-label">Contraseña</label><br>
                        <div class="input-group">
                            <input class="form-control" type="password" name="contraseña" id="password"
                                placeholder="Escriba su contraseña" style="background-color: gray; border-color: gray;"
                                required>
                            <span class="input-group-text eye-icon" onclick="pass_show_hide();">
                                <i class="bi bi-eye-fill d-none" id="showeye" style="font-size: 20px;"></i>
                                <i class="bi bi-eye-slash-fill" id="hideeye" style="font-size: 20px;"></i>
                            </span>
                        </div><br>
                    </div>

                    <div class="form-check mb-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember"> Recuerdame
                        </label>
                    </div>
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-block" name="btnlogin">Ingresar</button>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <a href="reg_user.php">Registráte como usuario</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="forgotpass">¿Olvidaste la contraseña?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!--Complements JS-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <!--Script visualización password-->
    <script src="../assets/js/password.viewer.js"></script>

    <footer>
        <div class="card-footer bg-dark">
            <p class="m y-5 py-4 text-center bg-black text-white">&copy; Copyright 2024-2025: by ZJosDaX</p>
        </div>
    </footer>
</body>

</html>

<!--Frontend inicio de sesion-->