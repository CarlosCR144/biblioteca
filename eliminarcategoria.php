<?php
// Incluye el archivo de conexión
include 'conexion.php';
include './partials/scripts.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCategoria = $_POST['idCategoria'];

    try {
        // Verificar si existen libros asociados a la categoría
        $sqlCheck = "SELECT id FROM libro WHERE id_categoria = :id";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->bindParam(':id', $idCategoria, PDO::PARAM_INT);
        $stmtCheck->execute();

        // Si existe mas de un libro asignado a esa categoria enviamos mensaje de que no se puede eliminar por integridad referencial
        if ($stmtCheck->rowCount() > 0) {

            echo "<script>
                Swal.fire('Categoria sin eliminar', 'No se puede eliminar la categoría porque hay libros asociados a ella.', 'info').then(function() {
                    location.href = 'categoria.php'
                });
            </script>";
        } else {
            // No hay libros asociados a la categoría, se puede eliminar
            $sql = "DELETE FROM categoria WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $idCategoria, PDO::PARAM_INT);
            $stmt->execute();
            echo "<script>
                Swal.fire('Categoria eliminada', 'La categoria ha sido eliminada con éxito', 'success').then(function() {
                    location.href = 'categoria.php'
                });
            </script>";
        }
    } catch (PDOException $e) {
        echo "Error al eliminar la categoría: " . $e->getMessage();
    }
}

?>