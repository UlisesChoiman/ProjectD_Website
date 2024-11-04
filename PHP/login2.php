<?php

session_start();

require_once("../includes/Conections.php");

if (isset($_POST["login"])) {

    //verifica que los campos no estén vacíos
    if (!empty($_POST['Email']) && !empty($_POST['Clave'])) {

       
        $email = $_POST["Email"];
        $password = $_POST["Clave"];

        //consulta para buscar el email en la base de datos
        $query = $connection->prepare("SELECT * FROM usuarios WHERE EMAIL = :email");
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        /*echo '<pre>';
        print_r($result);
        echo '</pre>';*/

        if (!$result) {
            $message = '<p class="error">El correo y la contraseña no coinciden</p>';
        } else {

            
            /*if (password_verify($password, $result['PASSWORD'])) {
                // Iniciar sesión si las credenciales son correctas
                $_SESSION['session_email'] = $email;
                header("Location: ../principal.html");
            } else {
                $message = "Correo electrónico o contraseña inválidos!";
            }*/

            //recuperar la clave almacenada
            $stored_hash = $result['Clave'];

            //hashear la contraseña ingresada usando el mismo salt
            $input_hash = crypt($password, $stored_hash);

            //comparar el hash
            if ($input_hash === $stored_hash) {
                
                $_SESSION['session_email'] = $email;
                $_SESSION['ID_usuario'] = $result['ID_usuario'];
                $_SESSION['ID_cargo'] = $result['ID_cargo'];

                //header("Location: ../principal.html"); //pagina prueba
                header("Location: principal.php"); // Redirigir a la página principal

                exit; // Asegúrate de salir después de redirigir
            } else {
                $message = "Correo electronico o contrasena invalidos";
            }
        }
    } else {
        $message = "Todos los campos son obligatorios";
    }
}
?>

<!-- mostrar mensaje de error -->
<?php if (!empty($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
