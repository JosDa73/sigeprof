<?php
if (isset($_POST['iduser'])) {
    $delete = $conn->prepare('DELETE FROM instructor WHERE id = ?');
    $delete->bindParam(1, $_POST['id']);
    $delete->execute();
    if ($delete) {
        $delmsg = array('Usuario eliminado correctamente', 'success');
    } else {
        $delmsg = array('No se pudo eliminar el usuario', 'danger');
    }
}
?>
<link rel="stylesheet" href="../assets/DataTables/datatables.min.css">

<!--Section alerts-->
<?php if (isset($delmsg)) { ?>
            <div class="alert alert-<?php echo $delmsg[1]; ?> alert-dismissible">
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              <strong>Alerta!</strong>
              <?php echo $delmsg[0]; ?>
            </div>
          <?php } ?>
<!--Section alerts-->

<h2>Tabla de Datos de Usuarios</h2>
<table class="table table-striped table-bordered table-hover" id="tuser">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Operaciones</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $data = $conn->prepare('SELECT * FROM instructor');
        $data->execute();

        foreach($data as $row){
        ?>
        <tr>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['apellido']; ?></td>
            <td><?php echo $row['correo']; ?></td>
            <td><?php echo $row['rol']; ?></td>
            <td>
                <button type="submit" class="btn btn-outline-primary">Editar</button>

                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<script src="../assets/DataTables/datatables.min.js"></script>
<script>
    let table = new DataTable('#tuser',{
        responsive: true,
        language:{
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json' // via CDN
            //url: '../assets/DataTable/es-ES.json' // via local
        },
    });
</script>