<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persona
    </title> 
    <!-- DISEÑO -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4b4a5d8f19.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Estilo/Estilo.css">
</head>
<body>
    <script>
    function eliminar(){
        var respuesta=confirm("¿Segúro que quíeres eliminar este usuario?");
        return respuesta
        }
    </script>

    <div class="container">
    </div>
    <div class="container-fluid row">
        <form class="col-4 p-8" method="POST">
            <?php
            include "Modelo/conexion.php";
            include "Controlador/registro_usuario.php";
            include "Controlador/eliminar_usuario.php";
            ?> 

<!-- Ventana Registro -->
    <div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registroModalLabel">Registro de Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="inputDocumento" class="form-label">Documento</label>
                            <input type="text" class="form-control" name="idpersona">
                        </div>
                        
                        <div class="mb-3">
                            <label for="inputNombre" class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="nombres">
                        </div>

                        <div class="mb-3">
                            <label for="inputApellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos">
                        </div>

                        <div class="mb-3">
                            <label for="inputTelefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono">
                        </div>
                        
                        <div class="mb-3">
                            <label for="inputCorreo" class="form-label">Correo</label>
                            <input type="text" class="form-control" name="correo">
                        </div>
                        
                        <div class="mb-3">
                            <label for="selectEstado" class="form-label">Estado</label>
                            <select class="form-select" name="estado" id="selectEstado">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="inputCalle" class="form-label">Calle</label>
                                    <input type="text" class="form-control" name="calle">
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="mb-3">
                                    <label for="inputNumero" class="form-label">Número</label>
                                    <input type="text" class="form-control" name="numero">
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="mb-3">
                                    <label for="inputBarrio" class="form-label">Barrio</label>
                                    <input type="text" class="form-control" name="barrio">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="inputCiudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" name="ciudad">
                        </div>
                        
                        <div class="mb-3">
                            <label for="selectRol" class="form-label">Rol</label>
                            <select class="form-select" name="idrol" id="selectRol">
                                <option value="administrador">1</option>
                                <option value="operario">2</option>
                                <option value="cliente">3</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Esto es el buscador de JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<form class="col-15 p-5">
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registroModal">
            <i class="fas fa-user-plus"></i> Registrar Usuario
        </button>
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar...">
    </div>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">ID Persona</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Correo</th>
                <th scope="col">Estado</th>
                <th scope="col">Direccion</th>
                <th scope="col">ROL</th>                
                    
                <th scope="col">Editar / Eliminar</th>
            </tr>
        </thead>
            
            

<!-- Tabla: Obtención de Datos -->            
    <tbody>
        <?php
        include "Modelo/conexion.php";
        $sql = $conexion->query ("select * from persona");
        while($datos=$sql->fetch_object()){ ?>
        <tr>
            <td><?= $datos->idpersona?></td>
            <td><?= $datos->nombres ?></td>
            <td><?= $datos->apellidos ?></td>
            <td><?= $datos->telefono ?></td>
            <td><?= $datos->correo ?></td>
            <td><?= $datos->estado ?></td>
            <td><?= $datos->iddireccion ?></td>
            <td><?= $datos->idrol ?></td>

            <td>
                <a href="Controlador/actualizar_usuario.php?id=<?= $datos->idpersona?>" class="btn btn-small btn-warning"><i class="fa-solid fa-user-pen"></i></a>
                <a onclick="return eliminar()" href="index_crud.php?id=<?= $datos->idpersona?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>

        </tr>
            <?php }
            ?>
    </tbody>
</table>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    <!-- Tabla: Buscador JS Tiempo real -->
    <script>
    document.getElementById('searchInput').addEventListener('input', function() {
        var input = this.value.toLowerCase();
        var tableRows = document.querySelectorAll('tbody tr');

    tableRows.forEach(function(row) {
      var rowData = row.textContent.toLowerCase();
      if (rowData.includes(input)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
</script>

</body>
</html>