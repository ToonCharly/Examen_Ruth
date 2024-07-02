<?php
include("connection.php");
$con = connection();

// Verificar la conexión
if (!$con) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Verificar si los datos están presentes en $_POST
if (!isset($_POST["id"]) || !isset($_POST["name"]) || !isset($_POST["lastname"]) || !isset($_POST["fecha_nacimiento"])) {
    die("Error: Campos requeridos no encontrados en el formulario.");
}

$id = $_POST["id"];
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$fecha_nacimiento = $_POST['fecha_nacimiento']; // Asegúrate de que este nombre coincida con el campo del formulario

// Preparar la consulta SQL con sentencia preparada para seguridad
$sql = "UPDATE autores SET nombre=?, apellido=?, fecha_nacimiento=? WHERE id=?";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    // Vincular parámetros y ejecutar la consulta
    mysqli_stmt_bind_param($stmt, "sssi", $name, $lastname, $fecha_nacimiento, $id);
    mysqli_stmt_execute($stmt);

    // Verificar si la consulta se ejecutó correctamente
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: index.php");
        exit();
    } else {
        echo "No se encontraron registros para actualizar.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la consulta: " . mysqli_error($con);
}

mysqli_close($con);
?>
