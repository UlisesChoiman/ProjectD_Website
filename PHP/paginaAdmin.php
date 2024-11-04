<?php
session_start();
require_once("../includes/Conections.php");

//Solo admin
if (isset($_SESSION['ID_cargo']) && $_SESSION['ID_cargo'] == 2) {
    echo "No tienes permiso para acceder a esta pagina.";
    exit();
}

//Obtener comentarios no aprobados
$query = $connection->prepare("SELECT * FROM comentarios WHERE aprobado = 0");
$query->execute();
$comentarios_pendientes = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project D</title>
    <link rel="stylesheet" href="../CSS/paginaAdmin.css">
</head>
<body>

<h2>Comentarios Pendientes de Aprobacion</h2>
<table>
    <tr>
        <th>ID Comentario</th>
        <th>Usuario</th>
        <th>Comentario</th>
        <th>Aprobar</th>
        <th>Eliminar</th>
    </tr>
    <?php foreach ($comentarios_pendientes as $comentario): ?>
        <tr>
            <td><?php echo $comentario['ID_comentario']; ?></td>
            <td><?php echo $comentario['ID_usuario']; ?></td>
            <td><?php echo $comentario['comentario']; ?></td>

            <td>
                <!-- Botón para aprobar -->
                <form action="aprobarComentario.php" method="POST">
                    <input type="hidden" name="ID_comentario" value="<?php echo $comentario['ID_comentario']; ?>">
                    <button type="submit">Aprobar</button>
                </form>
            </td>

            <td>
                <!-- Botón para eliminar  -->
                <form action="eliminarComentario.php" method="POST">
                    <input type="hidden" name="ID_comentario" value="<?php echo $comentario['ID_comentario']; ?>">
                    <button type="submit" class="eliminar">Eliminar</button>
                </form>
            </td>

        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
