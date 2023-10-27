<!DOCTYPE html>
<html>
<head>
    <title>Página Protegida</title>
</head>
<body>
    <?php
    session_start();
    if(isset($_SESSION['username'])) {
        echo "<h2>Bienvenido, " . $_SESSION['username'] . ".</h2>";
    } else {
        header("Location: login.php");
    }
    ?>
    <!-- Contenido de la página protegida -->
</body>
</html>
