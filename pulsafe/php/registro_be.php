<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/nuevo.css"/>
    <title>Nuevo Usuario</title>
</head>
<body>
<?php 

// Verificar si el parámetro "nombre" está presente
if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
    header("Location: http://localhost/pulsafe/index.jsp");
    exit();
}

// Incluir el archivo de conexión a la base de datos
include 'conexion_be.php';

// Recoger los parámetros del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contra = $_POST['contra'];
$nombre_p =$_POST['nombre_p'];

// Preparar la consulta
$query = "INSERT INTO tutores (nombre, correo, contra, nombre_p) VALUES (?, ?, ?, ?)";

//verificar que  no se repitan los correos
$verificar =mysqli_query($conexion, "SELECT * FROM tutores WHERE correo= '$correo' ");

if(mysqli_num_rows($verificar) > 0){
echo'
<script>
alert("Este correo ya esta registrado, intenta con uno nuevo");
window.location="../index.jsp";
</script>
'
;exit();
}

if ($stmt = $conexion->prepare($query)) {
    // Vincular los parámetros
    $stmt->bind_param("ssss", $nombre, $correo, $contra, $nombre_p);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Obtener el ID del tutor insertado
        $idTutor = $stmt->insert_id;
        $qrUrl = "localhost/pulsafe/php/reporte_ini.php?id=" . $idTutor;
?>
<div class="wrap">
    <h1>Bienvenido a la familia pulsafe</h1>
    <h2>Te haz registrado correctamente</h2>
    <h4>Tu id es: <?php echo $idTutor; ?>, por favor guárdalo, es tu manera de iniciar sesión y no hay otra forma de conseguirlo</h4>
    <h4>Enlace del código QR: <a href="<?php echo $qrUrl; ?>"><?php echo $qrUrl; ?></a><br></h4>
    <h4>Código QR:</h4><br>
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo $qrUrl; ?>">
    <a href="../index.jsp"><input class="btn" type="submit" value="confirmar"/><br></a>
</div>
<?php
    }
} 

// Cerrar la conexión
$conexion->close();
?>

</body>
</html>
