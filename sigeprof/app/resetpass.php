<?php
session_start();
include 'conn.php';

if (isset($_GET['id']) && isset($_GET['token'])) {

    $id = base64_decode($_GET['id']);
    $token = $_GET['token'];

    $rpass = $conn->prepare("SELECT * FROM instructor WHERE id = :id AND token = :token");
    $rpass->execute(array(':id' => $id, ':token' => $token));
    $row = $rpass->fetch(PDO::FETCH_ASSOC);

    if ($rpass->rowCount() > 0) {

        if (isset($_POST['btn-resetpass'])) {

            $pass = $_POST['pass'];
            $cpass = $_POST['cpass'];

            if ($pass != $cpass) {
                $msg = array("Las contraseñas no coinciden", "warning");
            } else {
                $npass = password_hash($pass, PASSWORD_BCRYPT); //Contraseña encriptada para enviar a la base de datos
                $uppass = $conn->prepare("UPDATE instructor SET contrasenha = :pass WHERE id = :id");
                $uppass->execute(array(':pass' => $npass, ':id' => $id));
                $msg = array("Contraseña cambiada con éxito, espera te redireccionamos", "success");
                header("refresh:5;url=./");
            }
        }
    } else {
        $msg = array("Token o ID no válido", "danger");
    }
}
?>

<!DOCTYPE html>
<html lang="es-CO" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGEPROF</title>
    <!--Logo Favicon-->
    <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">

    <!--SEO Tags-->
    <meta name="author" content="SIGEPROF">
    <meta name="description" content="Aplicativo Web Bootstrap">
    <meta name="keywords" content="SENA, sena, Sena, PROYECTO, proyecto, Proyecto, FORMATIVO, formativo, Formativo, SISTEMA, sistema,
        Sistema, GESTION, gestion, Gestion, SIGEPROF, sigeprof, Sigeprof">

    <!--Optimization Tags-->
    <meta name="theme-color" content="#000000">
    <meta name="MobileOptimized" content="width">
    <meta name="HandlhledFriendly" content="true">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-traslucent">

    <!--Bootstrap 5.3 Styles and complements-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/me.styles.css">

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

<body class="bg-res"
    style="background-image: url('../assets/img/font.png'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;">

    <!--Navbar-->
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.html">
                <img src="../assets/img/logo.png" alt="Avatar Logo" style="width: 60px" class="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"
                aria-label="Boton de menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./">Inicio</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <button class="btn btn-danger" type="button" onclick="location.href='../index.html'">Salir</button>
                </div>
            </div>
        </div>
    </nav>
    <!--Navbar-->

    <main class="form-signin m-auto pt-5 pb-5 mt-4 col-md-4" style="margin: 50px;">
        <div class="card" style="border: 3px solid white; background-color: black; color: white;">
            <div class="card-body">
                <div class="text-center">
                    <img src="../assets/img/logosige.png" alt="Logo" width="251" height="125">
                    <h1 class="display-6">Cambiar Contraseña</h1>
                </div>

                <!--Alerts-->
                <?php
                if (isset($msg)) {
                    ?>
                    <div class="alert alert-<?php echo $msg[1]; ?> alert-dismissible fade show">
                        <strong>Alerta !</strong>
                        <?php echo $msg[0]; ?>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-info alert-dismissible fade show">
                        <strong>Hola
                            <?php echo $row['nombre']; ?> !
                        </strong> Aquí debes ingresar tu nueva contraseña.
                    </div>
                    <?php
                }
                ?>
                <!--Alerts-->

                <form action="" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="mb-3 mt-3">
                        <label for="pass" class="form-label">Nueva contraseña:</label>
                        <input type="password" class="form-control" id="pass" placeholder="Nueva Contraseña" name="pass"
                            style="background-color: gray; border-color: gray" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="cpass" class="form-label">Repita la nueva contraseña:</label>
                        <input type="password" class="form-control" id="cpass" placeholder="Repita la contraseña"
                            name="cpass" style="background-color: gray; border-color: gray" required>
                    </div>
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-block"
                            name="btn-resetpass">Restablecer</button>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <a href="./"> Regresar a Iniciar Sesión</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <div class="card-footer">
            <p class="my-5 py-4 text-center bg-black text-white">&copy; Copyright 2024-2025: by ZJosDaX</p>
        </div>
    </footer>

    <!--Complements JS-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>