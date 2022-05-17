<?php
function conectar_al_servidor(){
/*SERVIDOR,NOMBRE USUARIO,CONTRASEÑA USUARIO,NOMBRE DE LA BASE DE DATOS*/	
  $mysqli = new mysqli('localhost','root','','creditoguarani');  
  $mysqli->set_charset("utf8");
    //$mysqli = new mysqli('localhost','adarco','Jqnvmt.659','adarco_creditoguarani');       
return  $mysqli;
}
?>