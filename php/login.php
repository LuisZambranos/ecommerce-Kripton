<?php
session_start();

// Conexión a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kripton";

$conn = new mysqli($servername, $username, $password, $dbname);



$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el usuario ha ingresado su correo electrónico y contraseña, si no vienen en blanco los campos
if (isset($_POST['correo']) && isset($_POST['contrasena']) && $_POST['correo'] != "" && $_POST['contrasena'] != "") {
    // Verificar si el usuario ha ingresado correctamente su correo electrónico y contraseña verifica que sea email valido y que la contrasela posea mas de 6 o igual carac
    if (filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL) && strlen($_POST['contrasena']) >= 6) {
        // Consultar la base de datos para verificar las credenciales
        
        //obtener todos los datos del usuario en la base de datos
        $sql = "SELECT * FROM usuarios WHERE correo='$correo'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            // Inicio de sesión exitoso
            $result = $result->fetch_assoc();
            $clave = password_verify($_POST['contrasena'], $result['contrasena']); 


            if ($clave) {
                header("Location: http://localhost/ecommerce-Kripton/pages/compras.html"); // Redireccionar a la página de compras
            } else {
                echo "Correo electrónico o contraseña incorrectos1";
            }
        
        } else {
            echo "Correo electrónico o contraseña incorrectos2";
        }

    } else {
        echo "Correo electrónico o contraseña incorrectos3";
        
    }
    } else {
        echo "Correo electrónico o contraseña incorrectos, campo en blanco";
        }


$conn->close();
?>
