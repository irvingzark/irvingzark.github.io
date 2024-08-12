document.getElementById("btn_registro").addEventListener("click",registrar);
document.getElementById("btn_inicio").addEventListener("click",iniciar);
window.addEventListener("resize",pagina);

var login=document.querySelector(".login");
var registro=document.querySelector(".registro");
var contenedorc=document.querySelector(".contenedor-login-register"); 
var cajatrasera_login=document.querySelector(".cajatrasera_login");
var cajatrasera_registro=document.querySelector(".cajatrasera_registro");



function pagina(){
    if(window.innerWidth>850){
        cajatrasera_login.style.display="block";
        cajatrasera_registro.style.display="block";

    }else{
        cajatrasera_registro.style.display="block";
        cajatrasera_registro.style.opacity="1";
        cajatrasera_login.style.display="none";
        login.style.display="block";
        registro.style.display="none";
        contenedorc.style.left="0px";
    }
}
pagina();

function registrar(){

    if(window.innerWidth>850){
registro.style.display="block";
contenedorc.style.left="410px";
login.style.display="none";
cajatrasera_registro.style.opacity="0";
cajatrasera_login.style.opacity="1";
}else{
    registro.style.display="block";
    contenedorc.style.left="0px";
    login.style.display="none";
    cajatrasera_registro.style.display="none";
    cajatrasera_login.style.display="block";
    cajatrasera_login.style.opacity="1"; 
}
}

function iniciar(){

    if(window.innerWidth>850){
        registro.style.display="none";
        contenedorc.style.left="10px";
        login.style.display="block";
        cajatrasera_registro.style.opacity="1";
        cajatrasera_login.style.opacity="0";    
    }else{
    registro.style.display="none";
    contenedorc.style.left="0px";
    login.style.display="block";
    cajatrasera_registro.style.display="block";
    cajatrasera_login.style.display="none";
    }
}
