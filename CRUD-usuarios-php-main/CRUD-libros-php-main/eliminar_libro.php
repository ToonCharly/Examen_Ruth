<?php
include("connection.php");

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM libros WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el libro: " . mysqli_error($con);
    }
} else {
    echo "ID de libro no especificado.";
}

mysqli_close($con);
?>
