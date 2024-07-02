<?php
include("connection.php");

$con = connection(); 

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $sql = "DELETE FROM autores WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el autor: " . mysqli_error($con);
    }
} else {
    echo "ID de autor no especificado.";
}

mysqli_close($con); 
?>
