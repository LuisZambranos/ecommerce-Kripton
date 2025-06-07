<?php
// Conexión a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kripton";

$conn = new mysqli($servername, $username, $password, $dbname);


// Recibir datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
// usa password_hash para encriptar la contraseña
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el usuario ha ingresado su nombre, correo electrónico y contraseña
if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['contrasena'])) {
    // Verificar si el usuario ha ingresado correctamente su nombre, correo electrónico y contraseña
    if (filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL) && strlen($_POST['contrasena']) >= 6) {
        // Verificar si la contraseña es de al menos 6 caracteres
        // Si la contraseña es correcta, guardar la sesión
        $exiteUsuario = "SELECT * FROM usuarios WHERE correo='$correo'";
        $result = $conn->query($exiteUsuario);
        if ($result->num_rows == 1) {
            echo "El correo electrónico ya está en uso";
        } else {
            $sql = "INSERT INTO usuarios (nombre, correo, contrasena, fecha) VALUES ('$nombre', '$correo', '$contrasena', now() )";
            $result = $conn->query($sql);
                if ($result === TRUE) {
                    echo "Registro exitoso";
                header("Location: http://localhost/ecommerce-Kripton/pages/login.html");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
        }
    } else {
        echo "Correo electrónico o contraseña incorrectos";
    }
}



// // Insertar datos en la base de datos
// $sql = "INSERT INTO usuarios (nombre, correo, contrasena, fecha) VALUES ('$nombre', '$correo', '$contrasena', now() )";

// if ($conn->query($sql) === TRUE) {
//     echo "Registro exitoso";
//     header("Location: http://localhost/ecommerce/login.html");

// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

$conn->close();
?>
