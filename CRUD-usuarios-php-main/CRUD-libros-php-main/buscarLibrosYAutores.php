<?php
// Función para buscar libros por título o autor
function buscarLibrosYAutores($con, $termino) {
    $sql = "SELECT l.id, l.titulo, l.fecha_publicacion, l.precio, a.nombre AS nombre_autor, a.apellido AS apellido_autor 
            FROM libros l 
            INNER JOIN autores a ON l.autor_id = a.id 
            WHERE l.titulo LIKE '%$termino%' OR a.nombre LIKE '%$termino%' OR a.apellido LIKE '%$termino%'";
    
    $query = mysqli_query($con, $sql);

    // Verificar si se encontraron resultados
    if ($query && mysqli_num_rows($query) > 0) {
        return $query; // Devuelve el resultado de la consulta
    } else {
        return null; // Devuelve null si no se encontraron resultados
    }
}
?>
