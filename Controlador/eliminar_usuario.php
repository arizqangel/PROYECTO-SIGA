<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conexion->prepare("DELETE FROM persona WHERE idpersona = $id");

    if ($sql->execute()) {
        echo '<div class="alert alert-warning">Usuario eliminado exitosamente</div>';
    } else {
        echo '<div class="alert alert-danger">Error al eliminar</div>';
    }
}

?>