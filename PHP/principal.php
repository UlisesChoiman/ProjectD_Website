<?php
require_once("../includes/Conections.php");

// Consulta para obtener todos los autos
$query = $connection->prepare("SELECT ID_autos, Color, Info, Imagen, Nombre FROM autos");
$query->execute();
$autos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project D</title>
    <link rel="stylesheet" href="../CSS/principal.css">
    <style>
        body {
            padding: 20px 0 0 0;
        }
        .car-card {
            height: 395px;
            width: 400px;
            margin-bottom: 17%;
        }
        footer {
            width: 98vw;
            height: 30vh;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Cars</a></li>
                <li><a href="../index.html">Log out</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="intro">
        <h1>Página Principal</h1>
        <h2>Autos de los 90</h2>
    </section>

    <div class="cars-container">
        <?php foreach ($autos as $auto): ?>
            <a href="PaginaCome.php?id=<?php echo htmlspecialchars($auto['ID_autos']); ?>" class="imagen">

                <div class="car-card">
                <img src="../Autos/<?php echo htmlspecialchars($auto['Imagen']) ?: 'default.png'; ?>">
                    <div class="car-details">
                    <h2> <?php echo htmlspecialchars($auto['Nombre']); ?> </h2>
                    <h3> <?php echo "Color: ", htmlspecialchars($auto['Color']); ?> </h3>
                    <p> <?php echo htmlspecialchars($auto['Info']); ?> </p>
                    <p> <?php echo htmlspecialchars($auto['ID_autos']); ?> </p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <footer>
        <div class="footer-container">
            <h3> Project D </h3>
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

