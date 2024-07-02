<?php
include("connection.php");

$con = connection(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];

    $sql = "INSERT INTO autores (nombre, apellido, fecha_nacimiento) VALUES ('$name', '$lastname', '$birthday')";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al agregar el autor: " . mysqli_error($con);
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
    <title>Agregar Autor</title>
</head>
<body>
    <div class="create-author-form">
        <h1>Agregar Nuevo Autor</h1>
        <form action="crear_autor.php" method="POST">
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="text" name="lastname" placeholder="Apellidos" required>
            <input type="date" name="birthday" placeholder="Fecha de Nacimiento" required>
            <input type="submit" value="Agregar">
        </form>
    </div>
</body>
</html>
