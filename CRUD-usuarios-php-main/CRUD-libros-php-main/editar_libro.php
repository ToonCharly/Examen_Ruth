<?php
include("connection.php");

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $autor_id = $_POST['autor_id'];
    $precio = $_POST['precio'];

    $sql = "UPDATE libros SET titulo='$titulo', fecha_publicacion='$fecha_publicacion', autor_id='$autor_id', precio='$precio' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el libro: " . mysqli_error($con);
    }
} else {
    $id = $_GET['id'];

    $sql = "SELECT * FROM libros WHERE id='$id'";
    $query = mysqli_query($con, $sql);
    $libro = mysqli_fetch_assoc($query);
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/style.css" rel="stylesheet">
    <title>Editar Libro</title>
</head>

<body>
    <div class="edit-book-form">
        <h1>Editar Libro</h1>
        <form action="editar_libro.php" method="POST">
            <input type="hidden" name="id" value="<?= $libro['id'] ?>">
            <input type="text" name="titulo" value="<?= $libro['titulo'] ?>" placeholder="Título" required>
            <input type="date" name="fecha_publicacion" value="<?= $libro['fecha_publicacion'] ?>" placeholder="Fecha de Publicación" required>
            <input type="text" name="autor_id" value="<?= $libro['autor_id'] ?>" placeholder="ID de Autor" required>
            <input type="number" step="0.01" name="precio" value="<?= $libro['precio'] ?>" placeholder="Precio" required>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>
</body>

</html>
