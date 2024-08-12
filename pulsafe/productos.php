
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
    <link rel="stylesheet" href="./assets/css/productos.css">
    <title>Productos</title>
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

        <li><a href="#" class="logout">
        <img class="fas" src="../pulsafe/iconos/bx-log-out.svg" alt="">
        <span class="nav-item">Cerrar sesi&oacute;n </span>
        </a></li>
    </ul>
</nav>


<section id="infonoso">
    
        <img  class="img-izq" src="./assets/img/pulsera.jpg" alt="#">
    <div class="text-der">
        <h2>Pulsera (Pulsafe)</h2>
        <p>Pulsera con codigo qr, para ayudar a personas con tendencia a la desorientaci&oacute;n</p>
        <br>
        <p>Con un precio de &#36;249.00</p>
        <br>
        <input class="btn" type="submit" value="comprar">
    </div>
    
</section>
<section id="infonoso">
    <div class="text-izq">
        <h2>Terapia psicol&oacute;gica</h2>
        <p>Cita programada con un especialista, para ayudar con problemas psicol&oacute;gicos</p>
        <br>
        <p>Con un costo de &#36;500, por sesi&oacute;n</p>
        <br>
        <input type="submit" class="btn" value="Agendar">
        
    </div>
        <img  class="img-der" src="./assets/img/terapia.jpeg" alt="#">
</section>

<section id="infonoso">
    
        <img  class="img-izq" src="./assets/img/subs.png" alt="#">
    <div class="text-der">
        <h2>Subscripci&oacute;n mensual</h2>
        <p>Subscrpic&oacute;n para contar con todos los beneficios pulsafe</p>
        <br>
        <p>Con un costo de &#36;130 mensuales</p>
        <br>
        <input type="submit" class="btn" value="Subscribirse">
    </div>
    
</section>
</body>
</html>