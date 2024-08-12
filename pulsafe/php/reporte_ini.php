<?php
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id == null || $id == "") {
    header("Location: http://localhost:8089/pulsafe/registro.php");
    exit();
}

include 'conexion_be.php'; // Assuming this file contains your database connection

$id = intval($id);

$autenticado = false;

try {
    if ($conexion) {
        $sql = "SELECT * FROM tutores WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);

        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            $autenticado = true;
        }

        if ($autenticado) {
            $_SESSION['usuario'] = $id;
            header("Location: ../reporte.php");
        } else {
            header("Location: ../index.php?id=x");
        }
    } else {
        throw new Exception("Database connection not established.");
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    mysqli_close($conexion);
}
?>
