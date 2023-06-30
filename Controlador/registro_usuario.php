<?php
include "Modelo/conexion.php";

if (!empty($_POST["btnregistrar"])) {
    if (empty($_POST["idpersona"]) || empty($_POST["nombres"]) || empty($_POST["apellidos"]) || empty($_POST["telefono"]) || empty($_POST["correo"]) || empty($_POST["calle"]) || empty($_POST["numero"]) || empty($_POST["barrio"]) || empty($_POST["ciudad"]) || empty($_POST["idrol"])) {
        echo '<div class="alert alert-warning">Uno de los campos está vacío</div>';
    } else {
        $idpersona = $_POST["idpersona"];
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $estado = $_POST["estado"];
        $calle = $_POST["calle"];
        $numero = $_POST["numero"];
        $barrio = $_POST["barrio"];
        $ciudad = $_POST["ciudad"];
        $idrol = $_POST["idrol"];

        // Consulta para obtener el ID del rol seleccionado
        $queryRol = "SELECT idrol FROM rol WHERE nombre_rol = '$idrol'";
        $resultRol = $conexion->query($queryRol);
        if ($resultRol->num_rows > 0) {
            $rowRol = $resultRol->fetch_assoc();
            $idrol = $rowRol["idrol"];

            // Insertar nueva dirección
            $sqlDireccion = "INSERT INTO direccion (calle, numero, barrio, ciudad) VALUES ('$calle', '$numero', '$barrio', '$ciudad')";
            if ($conexion->query($sqlDireccion) === true) {
                $iddireccion = $conexion->insert_id;

                // Insertar nueva persona con la dirección y el rol
                $sqlPersona = "INSERT INTO persona (idpersona, nombres, apellidos, telefono, correo, estado, idrol, iddireccion) 
                                VALUES ('$idpersona', '$nombres', '$apellidos', '$telefono', '$correo', '$estado', '$idrol', '$iddireccion')";

                if ($conexion->query($sqlPersona) === true) {
                    echo '<div class="alert alert-success">Usuario registrado correctamente</div>';
                } else {
                    echo '<div class="alert alert-warning">Error al registrar usuario</div>';
                }
            } else {
                echo '<div class="alert alert-warning">Error al registrar dirección</div>';
            }
        } else {
            echo '<div class="alert alert-warning">No se encontró el ID del rol seleccionado</div>';
        }
    }
}
?>


<script>
    history.replaceState(null, null, location.pathname);
</script>