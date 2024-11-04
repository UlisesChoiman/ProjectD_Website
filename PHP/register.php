<?php
/*Conectar a la base de datos
$servername = "localhost";
$username = "root"; // Cambia a tus credenciales
$password = ""; // Cambia a tu contraseña
$dbname = "project_d"; // Cambia por el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/

/*if (isset($_POST['register'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['Nombre']);
    $ape = mysqli_real_escape_string($conn, $_POST['Apellido']);
    $pass = mysqli_real_escape_string($conn, $_POST['Contraseña']);
    $tel = mysqli_real_escape_string($conn, $_POST['Telefono']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (Nombre, Apellido, Contraseña, Telefono, Email) VALUES ('$nom','$ape', '$hashed_pass','$tel','$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}*/

/*if (isset($_POST['register'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['Nombre'] ?? '');
    $ape = mysqli_real_escape_string($conn, $_POST['Apellido'] ?? '');
    $pass = mysqli_real_escape_string($conn, $_POST['Contraseña'] ?? '');
    $tel = mysqli_real_escape_string($conn, $_POST['Telefono'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['Email'] ?? '');

    if (empty($email)) {
        die("Email is required");
    }

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (Nombre, Apellido, Contraseña, Telefono, Email) VALUES ('$nom','$ape', '$hashed_pass','$tel','$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}*/

require_once("includes/Conections.php");
session_start();

if (isset($_POST['register'])) {
    $nom = isset($_POST['Nombre']) ? mysqli_real_escape_string($conn, $_POST['Nombre']) : '';
    $ape = isset($_POST['Apellido']) ? mysqli_real_escape_string($conn, $_POST['Apellido']) : '';
    $pass = isset($_POST['Clave']) ? mysqli_real_escape_string($conn, $_POST['Clave']) : '';
    $tel = isset($_POST['Telefono']) ? mysqli_real_escape_string($conn, $_POST['Telefono']) : '';
    $email = isset($_POST['Email']) ? mysqli_real_escape_string($conn, $_POST['Email']) : '';
    $id_cargo = isset($_POST['ID_cargo']) ? mysqli_real_escape_string($conn, $_POST['ID_cargo']) : null;

    // Check if ID_cargo is not null and exists in the cargos table
    if (empty($id_cargo)) {
        die("ID_cargo is required and must be valid");
    }
    
    if (empty($email)) {
        die("Email is required");
    }

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `usuarios` (`Nombre`, `Apellido`, `Clave`, `Telefono`, `Email`, `ID_cargo`) VALUES ('$nom','$ape', '$hashed_pass','$tel','$email', $id_cargo)";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

/*
if (isset($_POST["register"])) {

    if (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {

        $full_name = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = $connection->prepare("SELECT * FROM users WHERE EMAIL = :email");
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            $message = '<p class="error">El email ya se encuentra registrado</p>';
        } else {
            $query = $connection->prepare("INSERT INTO users(FULLNAME, USERNAME, PASSWORD, EMAIL) VALUES (:fullname, :username, :password_hash, :email)");
            $query->bindParam(":fullname", $full_name, PDO::PARAM_STR);
            $query->bindParam(":username", $username, PDO::PARAM_STR);
            $query->bindParam(":password_hash", $password_hash, PDO::PARAM_STR);
            $query->bindParam(":email", $email, PDO::PARAM_STR);
            $result = $query->execute();

            if ($result) {
                $message = "Cuenta correctamente creada";
            } else {
                $message = "Error al ingresar los datos de la información";
            }
        }
    } else {
        $message = "Todos los campos no deben estar vacíos!";
    }
}
?>
*/
?>
