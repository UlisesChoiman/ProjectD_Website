<?php
session_start();
require_once("../includes/Conections.php");

//admin
if (isset($_SESSION['ID_cargo']) && $_SESSION['ID_cargo'] == 2) {
    echo "No tienes permiso para realizar esta acción.";
    exit();
}

if (isset($_POST['ID_comentario'])) {
    $ID_comentario = $_POST['ID_comentario'];

    //eliminar el comentario
    $query = $connection->prepare("DELETE FROM comentarios WHERE ID_comentario = :ID_comentario");
    $query->bindParam(":ID_comentario", $ID_comentario, PDO::PARAM_INT);

    if ($query->execute()) {
        echo "Comentario eliminado con éxito.";
        header("Location: paginaAdmin.php"); 
        exit();
    } else {
        echo "Error al eliminar el comentario.";
    }
} else {
    echo "No se ha recibido el ID del comentario.";
}
?>
