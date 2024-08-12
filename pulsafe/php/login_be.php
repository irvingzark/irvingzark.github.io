<?php
session_start();

include 'conexion_be.php';

$correo = $_POST['correo'];
$contra = $_POST['contra'];

$validar_login = mysqli_query($conexion, "SELECT * FROM tutores WHERE correo='$correo' AND contra = '$contra' ");

if(mysqli_num_rows($validar_login) > 0){
$_SESSION['usuario'] = $correo;
    header("location: ../inicio.php");
exit;
}else{
echo'
<script>
alert("El usuario no existe, porfavor verifique los datos");
window.location = "../index.php";
</script>
    '; 
    exit;
    
}

?>