<?php
session_start();
require_once("../includes/Conections.php");

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    //var_dump($car_id);  para verificar el valor del car_id
} else {
    echo "ID de auto no especificado.";
    exit;
}

//consulta para obtener los detalles del auto
$queryAuto = $connection->prepare("SELECT * FROM autos WHERE ID_autos = :car_id");
$queryAuto->bindParam(":car_id", $car_id, PDO::PARAM_INT);
$queryAuto->execute();
$auto = $queryAuto->fetch(PDO::FETCH_ASSOC);

if (!$auto) {
    echo "No se encontró ningún auto con el ID especificado.";
    exit;
}

//consulta para obtener los comentarios del auto
$queryComentarios = $connection->prepare("SELECT comentarios.comentario, usuarios.EMAIL 
                                          FROM comentarios 
                                          JOIN usuarios ON comentarios.ID_usuario = usuarios.ID_usuario 
                                          WHERE comentarios.ID_autos = :car_id AND comentarios.aprobado = 1");
$queryComentarios->bindParam(":car_id", $car_id, PDO::PARAM_INT);
$queryComentarios->execute();
$comentarios = $queryComentarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios - <?php echo htmlspecialchars($auto['Nombre']); ?></title>
    <link rel="stylesheet" href="../CSS/paginaComentarios.css">
</head>
<body>

<header>
        <nav class="navbar">
            <div class="logo">
                <h1>Project D</h1>
            </div>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="principal.php">Cars</a></li>
                <li><a href="../index.html">Log Out</a></li>
                <li><a href="paginaAdmin.php">Admin</a></li>
            </ul>
        </nav>
</header>

<section class="car-details">
    <h2><?php echo htmlspecialchars($auto['Nombre']); ?> - Comentarios</h2>
    <h2><?php echo "Color: ", htmlspecialchars($auto['Color']); ?></h2>
    <img src="../Autos/<?php echo htmlspecialchars($auto['Imagen'] ? $auto['Imagen'] : 'default.png'); ?>" alt="Imagen de <?php echo htmlspecialchars($auto['Color']); ?>">
    <p><?php echo htmlspecialchars($auto['Info']); ?></p>
</section>

<section class="comments">
    <h3>Comentarios</h3>

    <?php if (count($comentarios) > 0): ?>
        <?php foreach ($comentarios as $comentario): ?>
            <div class="comment">
                <p><strong><?php echo htmlspecialchars($comentario['EMAIL']); ?>:</strong> 
                <?php echo htmlspecialchars($comentario['comentario']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay comentarios todavía. Sé el primero en comentar.</p>
    <?php endif; ?>

    
    <h4>Añadir un comentario</h4>
    <form action="paginaComentarios.php" method="POST">
        <textarea name="comentario" rows="5" placeholder="Escribe tu comentario aquí..." required></textarea>
        <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
        <button type="submit">Publicar comentario</button>
    </form>
</section>

<footer>
        <div class="footer-container" style="padding: 0px 0 40px 0;">
            <h3 style="margin: 38px;"> Project D </h3>
            <p>&copy; 2024 Project D. All Rights Reserved.</p>
            <div class="social-media">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
            </div>
        </div>
</footer>

</body>
</html>
