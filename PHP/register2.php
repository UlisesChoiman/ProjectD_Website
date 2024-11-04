<?php

require_once("../includes/Conections.php");
session_start();

if (isset($_POST["register"])) {
    
    /*echo '<pre>';
        print_r($_POST);
    echo '</pre>';*/

    //verifica que todos los campos estén llenos
    if (!empty($_POST['Nombre']) && !empty($_POST['Apellido']) && !empty($_POST['Clave']) && !empty($_POST['Telefono']) && !empty($_POST['Email']) && $_POST['ID_cargo'] !== "Seleccione...") {

        
        $nombre = $_POST['Nombre'];
        $apellido = $_POST['Apellido'];
        $telefono = $_POST['Telefono'];
        $email = $_POST['Email'];
        $clave = $_POST['Clave'];
        $cargo = $_POST['ID_cargo'];
        $ID_autos = null;

        //hashear la contraseña (no se pudo con este metodo)
        //$password_hash = password_hash($contraseña, PASSWORD_BCRYPT);

        //generar un salt aleatorio (con este si)
        $salt = substr(sha1(mt_rand()), 0, 22);

        //hashear la contraseña utilizando crypt()
        $password_hash = crypt($clave, '$2y$10$' . $salt);

    try {

        $query = $connection->prepare("SELECT * FROM usuarios WHERE EMAIL = :email");
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            $message = '<p class="error">El email ya se encuentra registrado</p>';
        } else {

            // Inserta los datos del nuevo usuario en la base de datos
            $query = $connection->prepare("INSERT INTO usuarios (NOMBRE, APELLIDO, TELEFONO, CLAVE, EMAIL, ID_CARGO, ID_AUTOS) 
                                           VALUES (:nombre, :apellido, :telefono, :password_hash, :email, :cargo, :ID_autos)");
            $query->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $query->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $query->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $query->bindParam(":password_hash", $password_hash, PDO::PARAM_STR);
            $query->bindParam(":email", $email, PDO::PARAM_STR);
            $query->bindParam(":cargo", $cargo, PDO::PARAM_INT);
            if ($ID_autos === null) {
                $query->bindValue(":ID_autos", null, PDO::PARAM_NULL);
            } else {
                $query->bindParam(":ID_autos", $ID_autos, PDO::PARAM_INT);
            }
            $result = $query->execute();

            if ($result) {
                $message = "Cuenta correctamente creada";
            } else {
                $message = "Error al ingresar los datos de la informacion";
            }
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
    } else {
        $message = "Todos los campos no deben estar vacios!";
    }
}
?>

<!-- Mostramos los mensajes de error o éxito -->
<?php if (!empty($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
