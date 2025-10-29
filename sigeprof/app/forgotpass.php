<?php
session_start();
include 'conn.php';

if (isset($_POST['btnrescue'])) {

    $email = $_POST['email'];
    $fpass = $conn->prepare('SELECT * FROM instructor WHERE correo = ? LIMIT 1');
    $fpass->bindParam(1, $email);
    $fpass->execute();
    $row = $fpass->fetch(PDO::FETCH_ASSOC);

    if ($fpass->rowCount() == 1) {
        $id = base64_encode($row['id']);
        $token = md5(uniqid(rand()));

        $uptoken = $conn->prepare('UPDATE instructor SET token = ? WHERE correo = ?');
        $uptoken->bindParam(1, $token);
        $uptoken->bindParam(2, $email);
        $uptoken->execute();

        $subject = '=?UTF-8?B?' . base64_encode("Restablecer Contraseña") . "=?=";
        $message = "<p>Hola " . $row['nombre'] . ", ya puedes restablecer la contraseña</p><br>";
        $message .= "<p>Por favor, haz click en el siguiente enlace para restablecer tu contraseña:</p><br>";
        $message .= "<a href='https://localhost/sigeprof/app/resetpass?id=$id&token=$token'>Restablecer</a>";

        include 'config.mailer.php';
    } else {
        $msg = array("El correo no existe", "danger");
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

    <!--Narbar Azul-->
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

<body class="bg-forg"
    style="background-image: url('../assets/img/font.png'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;">

    <!--Navbar-->
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.html">
                <img src="../assets/img/logo.png" alt="Avatar Logo" style="width: 60px" class="" />
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
                    <h1 class="display-6">Recuperar Contraseña</h1>
                </div>
                <!--Section alerts-->
                <?php if (isset($msg)) { ?>
                    <div class="alert alert-<?php echo $msg[1]; ?> alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Alerta!</strong>
                        <?php echo $msg[0]; ?>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-warning" role="alert">
                        Se enviara un link a su correo para restablecer la contraseña.
                    </div>
                <?php } ?>
                <!--Section alerts-->

                <form action="" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingrese email" name="email"
                            style="background-color: gray; border-color: gray" required>
                    </div>
                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-warning btn-block" name="btnrescue">Restablecer</button>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <a href="reg_user">Registráte como usuario</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="./">Iniciar Sesión</a>
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