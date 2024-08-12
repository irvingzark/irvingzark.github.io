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

// Actualizar el registro en historial con la hora de recuperado
$sqlUpdate = "UPDATE historial SET hora_recuperado = CURRENT_TIME() WHERE id_tutor = ? AND hora_recuperado IS NULL";
$stmtUpdate = $conexion->prepare($sqlUpdate);

if ($stmtUpdate === false) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al preparar la consulta de actualización: ' . $conexion->error
    ]);
    die();
}

$stmtUpdate->bind_param("i", $id_tutor);

if ($stmtUpdate->execute()) {
    // Eliminar el registro de la tabla reporte
    $sqlDelete = "DELETE FROM reportes WHERE id_tutor = ?";
    $stmtDelete = $conexion->prepare($sqlDelete);

    if ($stmtDelete === false) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error al preparar la consulta de eliminación: ' . $conexion->error
        ]);
        die();
    }

    $stmtDelete->bind_param("i", $id_tutor);

    if ($stmtDelete->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Registro eliminado de la tabla reporte y hora de recuperado registrada correctamente.'
        ]);

        // Redirigir a la página de inicio
        echo '<script>window.location.href = "./inicio.php";</script>';
        exit;
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error al eliminar el registro de la tabla reporte: ' . $stmtDelete->error
        ]);
    }

    // Cerrar la declaración de eliminación
    $stmtDelete->close();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al actualizar el registro: ' . $stmtUpdate->error
    ]);
}

// Cerrar la declaración de actualización
$stmtUpdate->close();

// Cerrar la conexión
$conexion->close();
?>
