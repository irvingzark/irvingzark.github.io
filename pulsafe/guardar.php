<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$conexion=mysqli_connect("localhost", "root","","pulsafe" );

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id_tutor = $_SESSION['usuario'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

if (isset($id_tutor) && isset($lat) && isset($lng)) {
    echo "Datos recibidos: id_tutor=$id_tutor, lat=$lat, lng=$lng\n";

    $verificacionSql = "SELECT COUNT(*) FROM reportes WHERE id_tutor = ?";
    $stmt = $conexion->prepare($verificacionSql);
    $stmt->bind_param("i", $id_tutor);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo "Ya existe un registro para este usuario.";
    } else {
        $sql = "INSERT INTO reportes (id_tutor, latitud, longitud) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("idd", $id_tutor, $lat, $lng);

        if ($stmt->execute()) {
            echo "Registro insertado exitosamente.";
        } else {
            echo "Error al insertar el registro: " . $stmt->error;
        }

        $stmt->close();
    }
} else {
    echo "Faltan datos requeridos.";
}

$conexion->close();
?>
