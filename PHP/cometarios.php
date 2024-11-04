<?php
session_start();
require_once("../includes/Conections.php");

$car_id = 1; // ID del auto Honda Civic

// Consulta para obtener los comentarios del auto con el ID específico
$query = $connection->prepare("SELECT comentarios.comentario, usuarios.EMAIL 
                               FROM comentarios 
                               JOIN usuarios ON comentarios.ID_usuario = usuarios.ID_usuario 
                               WHERE comentarios.ID_autos = :car_id AND comentarios.aprobado = 1 "); // Asegúrate de que la tabla tenga una columna 'fecha_comentario'
$query->bindParam(":car_id", $car_id, PDO::PARAM_INT);
$query->execute();

// Fetch all comentarios
$comentarios = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Project D </title>
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
                <li><a href="../principal.html">Cars</a></li>
                <li><a href="../index.html">Log Out</a></li>
                <li><a href="paginaAdmin.php">Admin</a></li>
            </ul>
        </nav>
    </header>

    <section class="car-details" style="display: flex;">
        <h2 style="position: absolute;">Toyota AE86 Trueno</h2>
        <img src="../img/Group 9.png" alt="Toyota AE86 Trueno" style="width: 700px; display: flex;" />
        <div style="position: relative; top: 15vh;">
        <p>El Toyota AE86 Trueno es un automóvil de culto que ha ganado popularidad en la cultura de las carreras callejeras y de drift. Equipado con un motor 4A-GE de 1.6 litros, este coche de tracción trasera es conocido por su equilibrio en las curvas y su capacidad de maniobra, haciéndolo el favorito entre los conductores de carreras en montaña.</p>
        <h3>Curiosidades</h3>
        <ul>
            <li>El AE86 es famoso gracias al anime "Initial D".</li>
            <li>Fue fabricado entre 1983 y 1987 por Toyota.</li>
            <li>A pesar de no tener gran potencia, es amado por su maniobrabilidad.</li></div>
        </ul>
    </section>

<section class="comments">
    
    <h3> Ver Comentarios</h3>

    <!-- Mostrar los comentarios -->
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
        <button type="submit">Publicar comentario</button>
    </form>
    
</section>

    <footer>
        <div class="footer-container" style="padding: 50px;">
            <p>&copy; 2024 Project D. All Rights Reserved.</p>
            <div class="social-media" style="top: 24px; position: relative;">
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
            </div>
        </div>
    </footer>

</body>
</html>
