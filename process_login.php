<?php
// Conexión a la base de datos (ajusta los detalles de conexión según tu configuración)
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "nombre_de_tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Recibe datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta a la base de datos para verificar las credenciales
$stmt = $conn->prepare("SELECT username, password FROM usuarios WHERE username = ?");
$stmt->bind_param("s", $username);

if ($stmt->execute()) {
    $stmt->bind_result($db_username, $db_password);
    $stmt->fetch();

    // Verifica la contraseña
    if (password_verify($password, $db_password)) {
        session_start();
        $_SESSION['username'] = $username;
        header("Location: pagina_protegida.php"); // Redirige a la página protegida
    } else {
        header("Location: login.php?error=1"); // Redirige de nuevo al formulario de login con un mensaje de error
    }
} else {
    header("Location: login.php?error=2"); // Redirige de nuevo al formulario de login con un mensaje de error
}

$stmt->close();
$conn->close();
?>
