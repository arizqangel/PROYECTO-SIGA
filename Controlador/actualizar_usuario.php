<?php 
include "../Modelo/conexion.php";
$id = $_GET["id"];
$sql = $conexion->query("SELECT * FROM persona WHERE idpersona = $id");
$datos = $sql->fetch_object();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <form class="col-4 p-3 m-auto" method="POST">
        <h3 class="text-center text-secondary">Modificar Información</h3>
        <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
        
        <div class="modal-body">
            <div class="mb-3">
                <label for="inputDocumento" class="form-label">Documento</label>
                <input type="text" class="form-control" name="idpersona" value="<?= $datos->idpersona ?>">
            </div>

            <div class="mb-3">
                <label for="inputNombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="nombres" value="<?= $datos->nombres ?>">
            </div>

            <div class="mb-3">
                <label for="inputApellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $datos->apellidos ?>">
            </div>

            <div class="mb-3">
                <label for="inputTelefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="<?= $datos->telefono ?>">
            </div>

            <div class="mb-3">
                <label for="inputCorreo" class="form-label">Correo</label>
                <input type="text" class="form-control" name="correo" value="<?= $datos->correo ?>">
            </div>

            <div class="mb-3">
                <label for="selectEstado" class="form-label">Estado</label>
                <select class="form-select" name="estado" id="selectEstado">
                    <option value="activo" <?= ($datos->estado === 'activo') ? 'selected' : '' ?>>Activo</option>
                    <option value="inactivo" <?= ($datos->estado === 'inactivo') ? 'selected' : '' ?>>Inactivo</option>
                </select>
            </div>
            
            <?php
            $iddireccion = $datos->iddireccion;
            $sql_direccion = $conexion->query("SELECT * FROM direccion WHERE iddireccion = $iddireccion");
            $direccion = $sql_direccion->fetch_object();
            ?>

            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="inputCalle" class="form-label">Calle</label>
                        <input type="text" class="form-control" name="calle" value="<?= $direccion->calle ?>">
                    </div>
                </div>

                <div class="col">
                    <div class="mb-3">
                        <label for="inputNumero" class="form-label">Número</label>
                        <input type="text" class="form-control" name="numero" value="<?= $direccion->numero ?>">
                    </div>
                </div>
                
                <div class="col">
                    <div class="mb-3">
                        <label for="inputBarrio" class="form-label">Barrio</label>
                        <input type="text" class="form-control" name="barrio" value="<?= $direccion->barrio ?>">
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="inputCiudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?= $direccion->ciudad ?>">
            </div>

            <div class="mb-3">
        <label for="selectRol" class="form-label">Rol</label>
        <select class="form-select" name="idrol" id="selectRol">
            <?php
            $sqlRol = $conexion->query("SELECT * FROM rol");
            while ($rol = $sqlRol->fetch_object()) {
                $selected = ($datos->idrol == $rol->idrol) ? 'selected' : '';
                echo '<option value="' . $rol->idrol . '" ' . $selected . '>' . $rol->nombre_rol . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary" name="btnactualizar" value="ok">Actualizar</button>
        <a href="../index_crud.php" class="btn btn-warning">Cancelar</a>
    </div>

</form>
</form>
    
    <?php
    if (isset($_POST["btnactualizar"])) {
        // Obtener los valores enviados en el formulario
        $idpersona = $_POST["idpersona"];
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $telefono = $_POST["telefono"];
        $correo = $_POST["correo"];
        $calle = $_POST["calle"];
        $numero = $_POST["numero"];
        $barrio = $_POST["barrio"];
        $ciudad = $_POST["ciudad"];
        $idrol = $_POST["idrol"];
    
        // Realizar la consulta de actualización en la tabla persona
        $sqlPersona = $conexion->query("UPDATE persona SET nombres='$nombres', apellidos='$apellidos', telefono='$telefono', correo='$correo' WHERE idpersona=$idpersona");
    
        // Realizar la consulta de actualización en la tabla dirección
        $sqlDireccion = $conexion->query("UPDATE direccion SET calle='$calle', numero='$numero', barrio='$barrio', ciudad='$ciudad' WHERE iddireccion=$datos->iddireccion");
    
        // Realizar la consulta de actualización en la tabla persona para el campo idrol
        $sqlRol = $conexion->query("UPDATE persona SET idrol='$idrol' WHERE idpersona=$idpersona");
    
        // Verificar si las consultas se ejecutaron correctamente
        if ($sqlPersona && $sqlDireccion && $sqlRol) {
            header("location: ../index_crud.php");
            echo '<div class="alert alert-success">Usuario actualizado correctamente</div>';
        } else {
            echo '<div class="alert alert-danger">Error al actualizar el usuario</div>';
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
