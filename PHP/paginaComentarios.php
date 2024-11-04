<?php
session_start();
require_once("../includes/Conections.php");

if (isset($_POST['comentario']) && trim($_POST['comentario']) !== '') {
    
    //verifica si esta el ID del usuario autenticado
    if (!isset($_SESSION['ID_usuario'])) {
        echo "Error: No has iniciado sesion.";
        exit();
    }

    $comentario = $_POST['comentario'];
    $ID_usuario = $_SESSION['ID_usuario'];
    //$car_id = 1; // Este es el ID del auto Honda Civic
    $car_id = $_POST['car_id'];


    //Lista de palabras Proibidas (agregar)
    $palabras_prohibidas = array("feo", "malazo", "insulto", "grosería");

    //si comentario contiene alguna palabra prohibida
    foreach ($palabras_prohibidas as $palabra) {
        if (stripos($comentario, $palabra) !== false) {
            echo "Tu comentario contiene palabras inapropiadas y no sera publicado.";
            exit();
        }
    }


    //Consulta
    $query = $connection->prepare("INSERT INTO comentarios (ID_autos, ID_usuario, comentario, aprobado) VALUES (:car_id, :ID_usuario, :comentario, 0)");
    $query->bindParam(":car_id", $car_id, PDO::PARAM_INT);
    $query->bindParam(":ID_usuario", $ID_usuario, PDO::PARAM_INT);  
    $query->bindParam(":comentario", $comentario, PDO::PARAM_STR);  

    /*echo '<pre>';
        print_r($query);
        echo '</pre>';*/

    // Ejecutar la consulta
    if ($query->execute()) {
        
        echo "Comentario enviado. Pendiente de aprobracion.";
        //header("Location: paginaCome.php");
        header("Location: PaginaCome.php?id=" . urlencode($car_id)); //redirigir a la página del auto con id específico
        exit();

    } else {
        echo "Error al guardar el comentario.";
    }
} else {
    echo "No se puede enviar un comentario vacio.";
}
?>

