<?php
session_start();

if(isset($_SESSION['usuario'])){
header("location = inicio.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">
<link rel="stylesheet" href="assets/css/estilos.css">
    <title>Registro</title>
</head>

<body>

<script>
    function validarinput(){
        var input = event.target.value;
        var regex = /^[a-zA-Z]*$/;

        if (!regex.test(input)) {
        alert("Solo se pueden colocar letras.");
        event.target.value = input.replace(/[^a-zA-Z]/g, '');
        return;
                                }

    if (input.length >= 4) {
        input.style.border-color == "green";
        boton.disabled = false; // Habilitar el botón
                            } 
    else {
        mensaje.textContent = "El nombre no es válido. Debe tener al menos 4 letras.";
        mensaje.style.color = "red";
        boton.disabled = true; // Deshabilitar el botón
            }
    }
    

</script>

<main>   
    <div class="contenedor_todo">
<div class="caja_trasera">
    <div class="cajatrasera_login">
        <h3>¿ya tienes una cuenta?</h3>
        <p>Inicia sesi&oacute;n para entrar a la p&aacute;gina</p>
        <button id="btn_inicio">Iniciar sesi&oacute;n</button>
    </div>
    <div class="cajatrasera_registro">
        <h3>¿Aun no tienes una cuenta?</h3>
        <p>Regsitrate para poder iniciar sesi&oacute;n</p>
        <button id="btn_registro">Regsitrarse</button>
    </div>
</div>
<!--Formularios para el registro e inicio de sesion de los usuarios-->
<div class="contenedor-login-register">
<!--formulario del inicio de sesion-->
<form action="php/login_be.php" class="login" method="post">
<h2>Iniciar sesi&oacute;n</h2>
<input type="text" placeholder="correo" name="correo">
<input type="password" placeholder="Contraseña" name="contra">
<button>Entrar</button>
</form>

<!--formulario del registro-->
<form action="php/registro_be.php" method="POST" class="registro">
<h2>Registro</h2>
<h3>Datos del tutor</h3>
<input type="text" placeholder="Nombre" name="nombre" oninput="validarinput(event)">
<input type="text" placeholder="Correo electronico" name="correo" >
<input type="password" placeholder="Contraseña"  name="contra">
<hr size="3px">
<h3>Datos del usuario pulsafe</h2>
<input type="text" placeholder="nombre"  name="nombre_p">
<button>Regsitrarse</button>
</form>

</div>
</div>
</main>
<script src="assets/js/scripts.js"></script>
</body>
</html>