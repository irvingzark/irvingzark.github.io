
<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '<script>alert("Por favor, inicie sesión."); window.location = "index.php";</script>';
    session_destroy();
    die();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>
    <link rel="stylesheet" href="./assets/css/inicio.css">
</head>
<body>

<nav>
    <ul>
        <li>
            <a href="#" class="logo">
            <img src="./assets/img/logo.jfif" >
        <span class="nav-item-logo" >Pulsafe</span>
            </a>    
    </li>

        <li><a href="./inicio.php" >
        <img  class="fas" src="../pulsafe/iconos/bx-home-heart.svg" alt="">
            <span class="nav-item">Inicio</span>
        </a></li>

        <li><a href="./productos.php">
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
        <span class="nav-item">Cerrar sesi&oacute;n </span>
        </a></li>
    </ul>
</nav>

<div class="slider">
                <ul>
                    <li>
      <img src="./assets/img/slider6.jpg" alt="" width="100%" heigth="100px">
     </li>
                    <li>
      <img src="./assets/img/slider2.jpeg" alt="" width="100%" heigth="100px">
    </li>
                    <li>
      <img src="./assets/img/slider5.jpg" alt="" width="100%" heigth="100px">
    </li>
                    <li>
      <img src="./assets/img/slider4.jpg" alt="" width="100%" heigth="100px">
    </li>
                </ul>
            </div> 

            <div class="info">       
        <H2>¡Bienvenido a PULSAFE!</H2>
        <br>
        <p>Sitio web oficial de la empresa en la cual podr&aacute;s encontrar variedad de productos disponibles para ti. </p>
        <img src="./assets/img/logo.jfif">
        <h2>¡Queremos ayudarte!</h2>
        <br>
        <p>Sabemos que, bajo la problem&aacute;tica actual de extrav&iacute;o y dado que tienes seres importantes los cuales no quieres perder; en especial los que tienen tendencia a la desorientación?
Por eso este producto es para ti.
Los productos que ofrecemos a través de esta plataforma son una ayuda para las personas que te interesan, familiares con discapacidad, niños, hijos, todos aquellos para ofrecerte a ti una manera de dignificarlos y, sobre todo ser precavidos ante un posible extrav&iacute;o.</p>
            <br>
            <br>
            <br>
            <hr size="25" color="#E9F4FF">
            <br>
            <br>
            <div>
            <h2 id="que">¿QU&Eacute; ES?</h2>
            <br>
            <p>Pulsafe es una solución innovadora para personas que enfrentan problemas de orientción en su d&iacute;a a d&iacute;a, diseñado para ser un compañero de navegación confiable.

Este se encuentra equipado con un c&oacute;digo QR, el cual te conecta sin problemas a una p&aacute;gina web personalizada donde puedes compartir f&aacute;cilmente tu ubicaci&oacute;n en tiempo real con contactos de confianza. 
</p>
            </div>
            <br><br>
            <hr size="25" color="#E9F4FF">
            <br>
            <br>
            <div>
            <h2 id="como"> ¿COMO FUNCIONA?</h2>
            <br>
            <p>El funcionamiento de la pulsera es simple y eficiente; cuando se detecta a una persona que la lleva puesta y se considera que se encuentra p&eacute;rdida, activa una notificación en la que pregunta al usuario si considera que está perdido. Si la respuesta es afirmativa, la pulsera utiliza su código QR incorporado para enviar autom&aacute;ticamente la ubicaci&oacute;n actual del usuario a un contacto de confianza predefinido. Esta funcionalidad proporciona una capa adicional de seguridad y tranquilidad tanto para el usuario como para sus seres queridos, asegurando una respuesta r&aacute;pida en caso de emergencia.</p>
            <br><br><br>
            </div>
</div>


</body>
</html>