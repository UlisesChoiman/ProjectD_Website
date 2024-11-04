<?php
/* Iniciar sesión
session_start();

// Conectar a la base de datos
$servername = "localhost";
$username = "root"; // Cambia a tus credenciales
$password = ""; // Cambia a tu contraseña
$dbname = "project_d"; // Cambia por el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/

require_once("includes/Conections.php");
session_start();

// Verificar si se ha enviado el formulario
if (isset($_POST['login'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['Nombre']);
    $pass = mysqli_real_escape_string($conn, $_POST['Contraseña']);

    // Consulta SQL para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE Nombre = '$nom'";
    $result = $conn->query($sql);

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verificar si la contraseña es correcta
        if (password_verify($pass, $row['Contraseña'])) {
            // Autenticación exitosa
            $_SESSION['usuarios'] = $row['usuarios']; // Guardar el nombre de usuario en la sesión
             
            header("Location: principal.html"); // Redirigir al usuario al dashboard o página principal
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No user found with that username.";
    }
}

$conn->close();

/*
if (isset($_POST["login"])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = $connection->prepare("SELECT * FROM users WHERE USERNAME = :username");
        $query->bindParam(":username", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            $message = '<p class="error">La combinación del usuario y la contraseña son inválidos!</p>';
        } else {
            if (password_verify($password, $result['password'])) {
                $_SESSION['session_username'] = $username;
                header("Location: intropage.php");
                
            } else {
                $message = "Nombre de usuario o contraseña inválida!";
            }
        }
    } else {
        $message = "Todos los campos son requeridos!";
    }
}

*/

?>
