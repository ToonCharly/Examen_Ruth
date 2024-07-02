<?php
include("connection.php");

$con = connection();

$errors = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (empty($_POST['titulo'])) {
        $errors[] = "El título del libro es obligatorio.";
    }
    if (empty($_POST['fecha_publicacion'])) {
        $errors[] = "La fecha de publicación es obligatoria.";
    }
    if (empty($_POST['autor_id'])) {
        $errors[] = "El ID del autor es obligatorio.";
    }
    if (empty($_POST['precio'])) {
        $errors[] = "El precio del libro es obligatorio.";
    } elseif (!is_numeric($_POST['precio'])) {
        $errors[] = "El precio debe ser un valor numérico.";
    }

    // Si no hay errores, proceder con la inserción
    if (empty($errors)) {
        $titulo = $_POST['titulo'];
        $fecha_publicacion = $_POST['fecha_publicacion'];
        $autor_id = $_POST['autor_id'];
        $precio = $_POST['precio'];

        $sql = "INSERT INTO libros (titulo, fecha_publicacion, autor_id, precio) VALUES ('$titulo', '$fecha_publicacion', '$autor_id', '$precio')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            mysqli_close($con);
            header("Location: listar_libros.php");
            exit();
        } else {
            echo "Error al agregar el libro: " . mysqli_error($con);
        }
    }
}

// Consulta para obtener autores
$sql_autores = "SELECT * FROM autores";
$query_autores = mysqli_query($con, $sql_autores);

// Consulta para obtener libros
$sql_libros = "SELECT * FROM libros";
$query_libros = mysqli_query($con, $sql_libros);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Listado de Autores y Libros</title>
</head>

<body>
    <div class="authors-list">
        <h1>Listado de Autores</h1>
        <a href="crear_autor.php" class="add-button">Agregar Nuevo Autor</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query_autores)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['nombre'] ?></td>
                        <td><?= $row['apellido'] ?></td>
                        <td><?= $row['fecha_nacimiento'] ?></td>
                        <td><a href="editar_autor.php?id=<?= $row['id'] ?>" class="edit-link">Editar</a></td>
                        <td><a href="eliminar_autor.php?id=<?= $row['id'] ?>" class="delete-link">Eliminar</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    <div class="books-list">
        <h1>Listado de Libros</h1>
        <a href="crear_libro.php" class="add-button">Agregar Nuevo Libro</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Fecha de Publicación</th>
                    <th>Autor</th>
                    <th>Precio</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($query_libros)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['titulo'] ?></td>
                        <td><?= $row['fecha_publicacion'] ?></td>
                        <td><?= obtenerNombreAutor($con, $row['autor_id']) ?></td>
                        <td><?= $row['precio'] ?></td>
                        <td><a href="editar_libro.php?id=<?= $row['id'] ?>" class="edit-link">Editar</a></td>
                        <td><a href="eliminar_libro.php?id=<?= $row['id'] ?>" class="delete-link">Eliminar</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
     <!-- Formulario de búsqueda -->
                    
     <form action="buscarLibrosYAutores" method="GET">
            <input type="text" name="buscar" placeholder="Buscar por título o autor">
            <button type="submit">Buscar</button>
        </form>
        <br>
    </div>

</body>

</html>

<?php
mysqli_close($con);

function obtenerNombreAutor($con, $autor_id) {
    $sql = "SELECT nombre FROM autores WHERE id='$autor_id'";
    $query = mysqli_query($con, $sql);
    if ($query && mysqli_num_rows($query) > 0) {
        $autor = mysqli_fetch_assoc($query);
        return $autor['nombre'];
    } else {
        return "Autor Desconocido";
    }
}
?>
