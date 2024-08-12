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
        <li><a href="./php/cerrar.php" class="logout">
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
    document.getElementById('loadReports').addEventListener('click', function() {
        let historialContent = document.getElementById('historialContent');
        historialContent.innerHTML = '';

        <?php
        $mapIndex = 0;
        $resultado->data_seek(0); // Resetea el puntero de los resultados
        while ($fila = $resultado->fetch_assoc()) {
            $latitud = $fila['latitud'];
            $longitud = $fila['longitud'];
            $fechaRegistro = $fila['fecha'];
            $horaRegistro = $fila['hora'];
            $horaEnterado = $fila['hora_enterado'];
            $horaRecuperado = $fila['hora_recuperado'];
            $mapIndex++;
        ?>
            let reporteDiv = document.createElement('div');
            reporteDiv.classList.add('reporte');

            reporteDiv.innerHTML = `
                <h2>Fecha del reporte: <?php echo $fechaRegistro; ?></h2>
                <div class="horas">
                    <h4>Hora del reporte: <?php echo $horaRegistro; ?></h4>
                    <h4 style="margin-left:15px;">Hora Enterado: <?php echo $horaEnterado; ?></h4>
                    <h4 style="margin-left:15px;">Hora Recuperado: <?php echo $horaRecuperado; ?></h4>
                </div>
                <h4>Lugar del reporte:</h4>
                <div id="map<?php echo $mapIndex; ?>" style="width: 80%; height: 250px; margin-top: 15px; margin-left: 50px; margin-bottom:15px;"></div>
            `;

            historialContent.appendChild(reporteDiv);

            var mapOptions<?php echo $mapIndex; ?> = {
                center: { lat: <?php echo $latitud; ?>, lng: <?php echo $longitud; ?> },
                zoom: 15
            };
            var map<?php echo $mapIndex; ?> = new google.maps.Map(document.getElementById('map<?php echo $mapIndex; ?>'), mapOptions<?php echo $mapIndex; ?>);

            var marker<?php echo $mapIndex; ?> = new google.maps.Marker({
                position: { lat: <?php echo $latitud; ?>, lng: <?php echo $longitud; ?> },
                map: map<?php echo $mapIndex; ?>,
                title: 'Ubicación del reporte'
            });

        <?php
        }
        ?>
    });
</script>
</body>
</html>
