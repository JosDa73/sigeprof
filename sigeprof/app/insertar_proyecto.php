<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $enlace = $_POST['enlace'];
    $fotoRuta = null;

    // Validar que el enlace sea de GitHub
    if (strpos($enlace, 'github.com') === false) {
        echo "❌ El enlace debe ser de GitHub.";
        exit;
    }

    // Procesar imagen si se subió
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $directorio = 'assets/img/';
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        $nombreArchivo = basename($_FILES['foto']['name']);
        $rutaDestino = $directorio . time() . '_' . $nombreArchivo;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
            $fotoRuta = $rutaDestino;
        }
    }

    $sql = "INSERT INTO proyecto (nombre, estado, enlace, foto) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $estado);
    $stmt->bindParam(3, $enlace);
    $stmt->bindParam(4, $fotoRuta);

    if ($stmt->execute()) {
        header("Location: home?page=proj");
        exit;
    } else {
        echo "Error al insertar el proyecto: " . $conn->errorInfo()[2];
    }
}
?>