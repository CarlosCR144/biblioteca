<?php
// Incluye el archivo de conexión
include 'conexion.php';
include './partials/scripts.php';

// Verifica si se ha enviado el formulario a través del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $autor = $_POST['isbn'];
    $autor = $_POST['autor'];
    $autor = $_POST['año'];

    // Realiza la inserción en la base de datos
    try {
        $sql = "INSERT INTO categoria (titulo, autor) VALUES (:titulo, :autor)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
        $stmt->execute();

        //  muestra notificacion y redirecciona a categoria.php
        echo "<script>
                Swal.fire('Categoria Creada', 'La categoría ha sido creada correctamente', 'success').then(function() {
                    location.href = 'categoria.php'
                });
            </script>";
    } catch (PDOException $e) {
        // En caso de error, muestra un mensaje de error
        echo "Error al crear la categoría: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Categoría</title>
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
                <h1>Crear Nueva Categoría</h1>
                <!-- mejorar a partir de Bootstrap 5 -->
                <form method="POST" action="crearcategoria.php">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">titulo:</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" required>
                    </div>
            
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor:</label>
                        <textarea class="form-control" id="autor" name="autor" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="titulo" class="form-label">ISBN:</label>
                        <input type="number" id="titulo" name="titulo" class="form-control" required>
                    </div>
            
                    <div class="d-grid gap-2">
                        <input class="btn btn-success" type="submit" value="Crear Categoría">
                    </div>
                </form>
            </main>

        </div>
    </div>


    <!-- Archivo JavaScript de Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
</body>
</html>
