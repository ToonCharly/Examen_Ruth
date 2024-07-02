<?php
include("connection.php");

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $autor_id = $_POST['autor_id'];
    $precio = $_POST['precio'];

    $sql = "INSERT INTO libros (titulo, fecha_publicacion, autor_id, precio) VALUES ('$titulo', '$fecha_publicacion', '$autor_id', '$precio')";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al agregar el libro: " . mysqli_error($con);
    }
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
    <title>Agregar Nuevo Libro</title>
</head>

<body>
    <div class="add-book-form">
        <h1>Agregar Nuevo Libro</h1>
        <form action="crear_libro.php" method="POST">
            <input type="text" name="titulo" placeholder="Título" required>
            <input type="date" name="fecha_publicacion" placeholder="Fecha de Publicación" required>
            <input type="text" name="autor_id" placeholder="ID de Autor" required>
            <input type="number" step="0.01" name="precio" placeholder="Precio" required>
            <input type="submit" value="Agregar">
        </form>
    </div>
</body>

</html>
