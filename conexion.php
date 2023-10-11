<?php
// Configuración de la base de datos
$host = 'localhost'; // Cambia esto al nombre del servidor de tu base de datos en nuestro caso es localhost
$dbname = 'biblioteca'; // Cambia esto al nombre de tu base de datos - biblioteca
$username = 'root'; // Cambia esto al nombre de usuario de tu base de datos - usuario root
$password = 'root1234'; // Cambia esto a la contraseña de tu base de datos - password = root1234

// Intentar establecer la conexión - con try catch podemos capturar los errores
try {
    // Crear una instancia de la clase PDO con parametros para conexion
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si llegas a este punto, la conexión se ha establecido con éxito
} catch (PDOException $e) {
    // En caso de error, muestra un mensaje de error
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
    //  terminamos el proceso en cado de que falle
    die();
}

?>