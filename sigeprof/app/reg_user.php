<?php
include_once 'conn.php';

if (isset($_POST['btn-reg'])) {
  $insert = $conn->prepare('INSERT INTO instructor(dni, nombre, apellido, edad, correo, nombre_de_usuario, contrasenha) VALUES(?,?,?,?,?,?,?)');
  $insert->bindParam(1, $_POST['dni']);
  $insert->bindParam(2, $_POST['nombre']);
  $insert->bindParam(3, $_POST['apellido']);
  $insert->bindParam(4, $_POST['edad']);
  $insert->bindParam(5, $_POST['correo']);
  $insert->bindParam(6, $_POST['nombre_de_usuario']);
  $pass = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
  $insert->bindParam(7, $pass);

  /*Validation Data */
  $search = $conn->prepare('SELECT * FROM instructor WHERE correo=:correo');
  $search->execute(array(":correo" => $_POST['correo']));
  $search->fetch(PDO::FETCH_ASSOC);

  if ($search->rowCount() > 0) {
    $msg = array("Disculpa, el correo ya existe", "danger");
  }

  /*Validation Data */elseif ($insert->execute()) {
    $msg = array("Usuario creado", "success");
  } else {
    $msg = array("Usuario no creado", "danger");
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

<body class="bg-reg"
  style="background-image: url('../assets/img/font.png'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;">

  <header>
    <!--Navbar-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary fixed-top">
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

  </header>

  <main class="form-signin m-auto pt-5 pb-5 mt-4 col-md-4" style="margin: 50px;">
    <div class="card" style="border: 3px solid white; background-color: black; color: white;">
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
          <img src="../assets/img/logosige.png" alt="Logo" width="251" height="125">
          <h1 class="display-6">Registrarse</h1>
        </div>
        <form action="" method="post" enctype="application/x-www-form-urlencoded">

          <div>
            <label for="Seleccione su tipo de documento">Seleccione su tipo de documento</label><br>
            <select name="tipo_documento" id="tipo_documento" type="number" style="background-color: gray; border-color: gray">
              <option value="documento">Seleccione su tipo de documento</option>
              <option value="cedula_ciudadania">Cedula de Ciudadania</option>
              <option value="tarjeta_identidad">Tarjeta de Identidad</option>
              <option value="registro_civil">registro civil</option>
              <option value="cedula_extrangeria">Cedula de Extrangeria</option>
              <option value="pasaporte">Pasaporte</option>
              <option value="visa">Visa extrangera</option>
            </select>
          </div><br>

          <div>
            <label for="dni">Ingrese su Documento</label><br>
            <input type="text" name="dni" id="dni" placeholder="Ingrese su Numero de Documento"
              class="form-control mb-3" style="background-color: gray; border-color: gray" required>
          </div>

          <div>
            <label for="nombre">Nombres</label><br>
            <input type="text" name="nombre" id="nombre" placeholder="Ingrese sus nombres" class="form-control"
              style="background-color: gray; border-color: gray" required>
          </div><br>

          <div>
            <label for="apellido">Apellidos</label><br>
            <input type="text" name="apellido" id="apellido" placeholder="Ingrese sus apellidos" class="form-control" style="background-color: gray; border-color: gray"
              required>
          </div><br>

          <div>
            <label for="edad">Edad</label><br>
            <input type="number" name="edad" id="edad" placeholder="Ingrese su edad" class="form-control" style="background-color: gray; border-color: gray" required>
          </div><br>

          <div>
            <label for="correo">Correo Electronico</label><br>
            <input type="email" name="correo" id="correo" placeholder="Ingrese su correo" class="form-control" style="background-color: gray; border-color: gray" required>
          </div><br>

          <div>
            <label for="nombre_de_usuario">Nombre de usuario</label><br>
            <input type="text" name="nombre_de_usuario" id="nombre_de_usuario"
              placeholder="Ingrese su nombre de usuario" class="form-control" style="background-color: gray; border-color: gray" required>
          </div><br>

          <div>
            <label for="contraseña" class="form-label">Contraseña</label><br>
            <div class="input-group">
              <input class="form-control" type="password" name="contraseña" id="password"
                placeholder="Escriba su contraseña" style="background-color: gray; border-color: gray" required>
              <span class="input-group-text pt-0" onclick="pass_show_hide();">
                <i class="bi bi-eye-fill d-none" id="showeye" style="font-size: 20px;"></i>
                <i class="bi bi-eye-slash-fill" id="hideeye" style="font-size: 20px;"></i>
              </span>
            </div><br>
          </div>

          <div></div>
          <div class="d-grid"><br>
            <button type="success" class="btn btn-success btn-block" name="btn-reg" >Registrar</button>
          </div><br>

          <div class="row">
            <div class="col-sm-6">
              <a href="./">Iniciar Sesión</a>
            </div>
          </div>

        </form>
      </div>
    </div>
  </main>

  <footer>
    <div class="card-footer bg-dark">
      <p class="m y-5 py-4 text-center bg-black text-white">&copy; Copyright 2024-2025: by ZJosDaX</p>
    </div>
  </footer>

  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <!--Script visualización password-->
  <script src="../assets/js/password.viewer.js"></script>
</body>

</html>

<!--quienes somos, intro, caracteristicas, problema y justificacion, obj gen y esp,  referente teorico, tablero kanban, 
base de datos (chartDB, dbdiagram), equipo-->