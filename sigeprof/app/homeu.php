<?php 
include "conn.php";
session_start();

//Verifica la sesión que se está iniciando
if (isset($_SESSION['instructor']) && isset($_SESSION['id']) && isset($_SESSION['rol']) ) {
    $search = $conn->prepare("SELECT * FROM instructor WHERE correo = ? AND id = ? AND rol = ?");
    $search->bindParam(1, $_SESSION['instructor']);
    $search->bindParam(2, $_SESSION['id']);
    $search->bindParam(3, $_SESSION['rol']);
    $search->execute();
    $data = $search->fetch(PDO::FETCH_ASSOC);

    if (is_array($data)) {

?>
<!DOCTYPE html>
<html lang="es-CO" class="h-100">

<head>
    <meta charset="UTF-8"> <!--Tipos de Caracteres que Acepta-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Responsive-->
    <title>SIGEPROF</title>

    <!--Favicon-->
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">

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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>

<body class="h-100">
    <header>
        <!--Navbar-->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
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
                        <li class="nav-item">
                            <a class="nav-link" href="?page=proj">Proyectos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#obj">Objetivos</a>
                        </li>
                        <li>
                            <a class="nav-link" href="?page=tableusers">Usuarios</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <button class="btn btn-primary" type="button" onclick="location.href='app/'">Entrar</button>
                    </div>
                </div>
            </div>
        </nav>
        <!--Navbar-->
        <a href="logout">Salir</a>

        <?php
        //Controlador de modulos o subpáginas
        $page = isset($_GET['page']) ? strtolower($_GET['page']) : 'homeu';
        require_once './' . $page . '.php';

        if ($page == 'homeu') {
            require_once 'init.php';
        }
        ?>
    </header>
<?php 
    }
}else {
    //Si no hay sesión iniciada, redirigir a la página de inicio de sesión
    header("Location: ./");
    exit();
}
?>

</body>
</html>