<?php
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Por favor, inicie sesión.'
    ]);
    session_destroy();
    die();
}

$conexion = mysqli_connect("localhost", "root", "", "pulsafe");

// Verifica la conexión
if ($conexion->connect_error) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Conexión fallida: ' . $conexion->connect_error
    ]);
    die();
}

// Obtener el id del tutor desde la sesión
$id_tutor = $_SESSION['usuario'];

// Verificar si existe algún reporte activo (sin hora_recuperado) para este usuario
$sqlCheck = "SELECT id FROM historial WHERE id_tutor = ? AND hora_recuperado IS NULL ORDER BY id DESC LIMIT 1";
$stmtCheck = $conexion->prepare($sqlCheck);

if ($stmtCheck === false) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al preparar la consulta de verificación: ' . $conexion->error
    ]);
    die();
}

$stmtCheck->bind_param("i", $id_tutor);
$stmtCheck->execute();
$result = $stmtCheck->get_result();
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    echo json_encode([
        'status' => 'exists',
        'message' => 'Debe finalizar el reporte anterior antes de crear uno nuevo.'
    ]);
    die();
}

// Insertar registro en historial
$sqlInsert = "INSERT INTO historial (latitud, longitud, fecha, hora, hora_enterado, id_tutor) 
              SELECT latitud, longitud, fecha, hora, CURRENT_TIME(), id_tutor 
              FROM reportes 
              WHERE id_tutor = ?";
$stmtInsert = $conexion->prepare($sqlInsert);

if ($stmtInsert === false) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al preparar la consulta de inserción: ' . $conexion->error
    ]);
    die();
}

$stmtInsert->bind_param("i", $id_tutor);

if ($stmtInsert->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Confirmación registrada correctamente.'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al insertar en historial: ' . $stmtInsert->error
    ]);
}

// Cerrar la declaración de inserción
$stmtInsert->close();

// Cerrar la conexión
$conexion->close();
?>
