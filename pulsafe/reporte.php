<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>REPORTE</title>
    <link rel="stylesheet" href="./assets/css/reporte.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBx_1NtkK5uaxG8Fxqdhf-_n17rzQZpFfY" async defer></script>

    <script>
function no(){
    
    document.getElementById("e").innerHTML = "";
}

        var lat, lng;

        function getLocation() {
            if (navigator.geolocation) {
                var options = {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                };
                navigator.geolocation.getCurrentPosition(initMap, showError, options);
            } else {
                document.getElementById("a").innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function initMap(position) {
            console.log('Initializing map with position:', position);
            lat = position.coords.latitude;
            lng = position.coords.longitude;
            var coords = { lat: lat, lng: lng };

            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: coords
            });

            var marker = new google.maps.Marker({
                position: coords,
                map: map
            });

            document.getElementById("map").style.display = "block";
            document.getElementById("a").innerHTML = "Latitud: " + lat + "<br>Longitud: " + lng;
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    document.getElementById("a").innerHTML = "User denied the request for Geolocation.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    document.getElementById("a").innerHTML = "Location information is unavailable.";
                    break;
                case error.TIMEOUT:
                    document.getElementById("a").innerHTML = "The request to get user location timed out.";
                    break;
                case error.UNKNOWN_ERROR:
                    document.getElementById("a").innerHTML = "An unknown error occurred.";
                    break;
            }
        }

        function confirmLocation() {
            console.log("Confirming location with lat:", lat, "lng:", lng);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("Response from server: " + this.responseText);
                    // Aquí puedes mostrar un mensaje o realizar otras acciones después de enviar los datos
                    alert("Muchas gracias por la ayuda, alguien de confianza está en camino nota: porfavor mantengase cerca del lugar del reporte");
                } else {
                    console.log("Estado readyState:", this.readyState, "Status:", this.status);
                }
            };
            xhttp.open("POST", "guardar.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "lat=" + lat + "&lng=" + lng;
            console.log("Sending params: " + params);
            xhttp.send(params);
        }
    </script>
</head>
<body>
    <div class="infonoso">
        <h1>PULSAFE</h1>
        <br><br>
        <h2>HOLA, esta persona es portadora de una pulsera pulsafe, lo que significa que tiene tendencia a la desorientación</h2>
        <br><br>
        <h3>Si usted piensa que esta persona está perdida, por favor proporcione su ubicación.</h3>
        <br>
        <h3>Compartir ubicación momentánea:</h3>
        <span>Sí</span><input type="radio" name="a" id="si" class="radio" onclick="getLocation()"> <span>No</span> <input type="radio" id="no" name="a" class="radio" onclick="no() ,document.getElementById('map').style.display='none'; document.getElementById('a').innerHTML='';">
        <div id="map"></div>
        <p id="e"></p>
        <br>
        <button onclick="confirmLocation()" class="btn">Confirmar ubicación</button>
        <div id="a"></div>
    </div>
</body>
</html>
