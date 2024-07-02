<?php
include("connection.php");

$con = connection(); // Establecer conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];

    $sql = "UPDATE autores SET nombre='$name', apellido='$lastname', fecha_nacimiento='$birthday' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el autor: " . mysqli_error($con);
    }
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id']; // Obtener el ID del autor a editar

        // Consulta para obtener los datos del autor
        $sql = "SELECT * FROM autores WHERE id='$id'";
        $query = mysqli_query($con, $sql);

        // Verificar si se encontró el autor
        if ($query && mysqli_num_rows($query) > 0) {
            $author = mysqli_fetch_assoc($query);
        } else {
            echo "No se encontró ningún autor con el ID proporcionado.";
            exit();
        }
    } else {
        echo "ID de autor no especificado.";
        exit();
    }
}

mysqli_close($con); // Cerrar la conexión
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/style.css" rel="stylesheet">
    <title>Editar Autor</title>
</head>
<body>
    <div class="edit-author-form">
        <h1>Editar Autor</h1>
        <form action="editar_autor.php" method="POST">
            <input type="hidden" name="id" value="<?= $author['id'] ?>">
            <input type="text" name="name" value="<?= $author['nombre'] ?>" placeholder="Nombre" required>
            <input type="text" name="lastname" value="<?= $author['apellido'] ?>" placeholder="Apellidos" required>
            <input type="date" name="birthday" value="<?= $author['fecha_nacimiento'] ?>" placeholder="Fecha de Nacimiento" required>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>
</html>
