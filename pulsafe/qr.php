<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '<script>alert("Por favor, inicie sesión."); window.location = "index.php";</script>';
    session_destroy();
    die();
}

$conexion = mysqli_connect("localhost", "root", "", "pulsafe");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id_tutor = $_SESSION['usuario'];

$sql = "SELECT latitud, longitud, fecha, hora, hora_enterado, hora_recuperado FROM historial WHERE id_tutor = ?";
$stmt = $conexion->prepare($sql);

if ($stmt === false) {
    die('Error al preparar la consulta: ' . $conexion->error);
}

$stmt->bind_param("i", $id_tutor);
$stmt->execute();
$resultado = $stmt->get_result();

$reportes = [];

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $reportes[] = $fila;
    }
}

$stmt->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/historial.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBx_1NtkK5uaxG8Fxqdhf-_n17rzQZpFfY" async defer></script>
    <title>Historial</title>
</head>
<body>
<nav style="height:100%;">
    <ul>
        <li>
            <a href="#" class="logo">
                <img src="./assets/img/logo.jfif">
                <span class="nav-item-logo">Pulsafe</span>
            </a>
        </li>
        <li><a href="./inicio.php">
            <img class="fas" src="../pulsafe/iconos/bx-home-heart.svg" alt="">
            <span class="nav-item">Inicio</span>
        </a></li>
        <li><a href="#">
            <img class="fas" src="../pulsafe/iconos/bx-cart.svg" alt="">
            <span class="nav-item">Productos</span>
        </a></li>
        <li><a href="#">
            <img class="fas" src="../pulsafe/iconos/bx-question-mark.svg" alt="">
            <span class="nav-item">Acerca de</span>
        </a></li>
        <li><a href="historial.php">
            <img class="fas" src="../pulsafe/iconos/bx-history.svg" alt="">
            <span class="nav-item">Historial</span>
        </a></li>
        <li><a href="./qr.php">
            <img class="fas" src="../pulsafe/iconos/bx-bell.svg" alt="">
            <span class="nav-item">Reporte</span>
        </a></li>
        <li><a href="#" class="logout">
            <img class="fas" src="../pulsafe/iconos/bx-log-out.svg" alt="">
            <span class="nav-item">Cerrar sesión</span>
        </a></li>
    </ul>
</nav>

<div class="info">
    <h1>Reportes Registrados</h1>
    <button id="loadReports">Cargar Historial</button>
    <div id="historialContent"></div>
</div>

<script>
    let reportes = <?php echo json_encode($reportes); ?>;

    document.getElementById('loadReports').addEventListener('click', function() {
        let historialContent = document.getElementById('historialContent');
        historialContent.innerHTML = '';

        reportes.forEach((reporte, index) => {
            let mapIndex = index + 1;

            let reporteDiv = document.createElement('div');
            reporteDiv.classList.add('reporte');

            reporteDiv.innerHTML = `
                <h2>Fecha del reporte: ${reporte.fecha}</h2>
                <div class="horas">
                    <h4>Hora del reporte: ${reporte.hora}</h4>
                    <h4 style="margin-left:15px;">Hora Enterado: ${reporte.hora_enterado}</h4>
                    <h4 style="margin-left:15px;">Hora Recuperado: ${reporte.hora_recuperado}</h4>
                </div>
                <h4>Lugar del reporte:</h4>
                <div id="map${mapIndex}" style="width: 80%; height: 250px; margin-top: 15px; margin-left: 50px; margin-bottom:15px;"></div>
            `;

            historialContent.appendChild(reporteDiv);

            var mapOptions = {
                center: { lat: parseFloat(reporte.latitud), lng: parseFloat(reporte.longitud) },
                zoom: 15
            };
            var map = new google.maps.Map(document.getElementById('map' + mapIndex), mapOptions);

            var marker = new google.maps.Marker({
                position: { lat: parseFloat(reporte.latitud), lng: parseFloat(reporte.longitud) },
                map: map,
                title: 'Ubicación del reporte'
            });
        });
    });
</script>
</body>
</html>
