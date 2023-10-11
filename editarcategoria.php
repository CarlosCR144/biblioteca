<?php
//  incluir conexion a BD
include 'conexion.php';
//  llamamos a nuestro archivo partials para mostrar las notificaciones
include './partials/scripts.php';

//  Comprobamos si vienen datos desde formulario a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Actualizar los datos
    try {

        $sql = 'UPDATE categoria SET nombre = :nombre, descripcion = :descripcion WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        //  muestra notificacion y redirecciona a categoria.php
        echo "<script>
                Swal.fire('Categoria editada', 'La categoría ha sido editada correctamente', 'success').then(function() {
                    location.href = 'editarcategoria.php?id={$id}'
                });
            </script>";

    } catch (PDOException $e) {
        echo "Error al actualizar categoria: " . $e->getMessage();
    }
}

// Obtén datos de la categoría a editar
if (isset($_GET['id']) && !empty($_GET['id']))
{
    $idCategoria = $_GET['id'];

    try {

        $sql = "SELECT * FROM categoria WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $idCategoria, PDO::PARAM_STR);
        $stmt->execute();

        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
        $message = isset($categoria) && !empty($categoria) ? "Categoria obtenida" : "Categoria no existe";
        // echo '<h1 style="text-align: center;">' . $message  . " " . $categoria['nombre'] .'</h1>';

    } catch ( PDOException $e ) {
        echo "Error al obtener los datos de la categoría: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Estilos personalizados -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>
<body>

 <!-- CABECERA -->
 <?php require('./partials/header.php') ?>

    <div class="container-fluid">
        <div class="row my-4 mx-auto">

        <!-- MENU PRINCIPAL -->
        <?php require('./partials/menu.php') ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


                <h1>Editar Categoría</h1>
                <form method="POST" action="editarcategoria.php">
                    <input type="hidden" name="id" value="<?php echo (isset($categoria['id'])) ? $categoria['id'] : ""; ?>">
                    
                    <div class="mb-3">
                        <label for="nombre">Nombre:</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo (isset($categoria['nombre'])) ? $categoria['nombre'] : ""; ?>" required>
                    </div>
            
                    <div class="mb-3">    
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo (isset($categoria['descripcion'])) ? $categoria['descripcion'] : ""; ?></textarea>
                    </div>
            
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-primary" value="Guardar Cambios">
                    </div>
                </form>
            </main>

        </div>
    </div>


    <!-- Archivo JavaScript de Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
</body>
</html>