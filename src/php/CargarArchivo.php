<?php
require("conexion.php");
include("subir_foto_base64.php");
function abm(){



$mysqli=conectar_al_servidor(); 
$control=1;	
$totalRegistro=$_POST['totalRegistro'];
$totalRegistro = utf8_decode($totalRegistro);
$idsolicitud=obtenerUltimaId();
$usuarios_cod = $_POST['usuarios_cod'];
$usuarios_cod = utf8_decode($usuarios_cod);

$hora=$_POST['hora'];
$hora = utf8_decode($hora);

while($control<=$totalRegistro){


$ext=$_POST['ext'.$control];
$ext = utf8_decode($ext);

$nombre=$_POST['nombre'.$control];
$nombre = utf8_decode($nombre);

$tamanho=$_POST['tamanho'.$control];
$tamanho = utf8_decode($tamanho);


$id_solicitud="";
 $id_solicitud=$idsolicitud;
$donde="../CreditoGuaraniDocuments/";
if($ext!=""){
          $archivo=substr($_POST['archivo'.$control], strpos($_POST['archivo'.$control], ",") + 1);
          $archivo = base64_decode($archivo);
          $id_f=subir_imagen_base64($donde,$archivo,$id_solicitud,$ext);
		  $ruta="/CreditoGuaraniDocuments/".$id_solicitud.$id_f.'.'.$ext;
		  //cargamos fotos en db
 $mysqli=conectar_al_servidor();
$consulta="insert into documentospersonas ( url, nombres, hora, tamanho, extencion, usuarios_cod, solicitudescreditos_cod, fecha, estado) value (?,?,?,?,?,?,?,current_date(),'ACTIVO')";	
$stmt = $mysqli->prepare($consulta);
$ss='sssssss';
$stmt->bind_param($ss,$ruta,$nombre,$hora,$tamanho,$ext,$usuarios_cod,$id_solicitud); 
if (! $stmt->execute()) {
   echo "Error";
   exit;
} 

		   $control=$control+1;
}
		


}


$informacion =array("1" => "exito");
echo json_encode($informacion);	
exit;
	
}

 
 function obtenerUltimaId(){
	$cod ="";
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $sql= "select max(cod) as cod from solicitudescreditos where estado='ACTIVO' limit 1";
	
   $stmt = $mysqli->prepare($sql); 
 if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result))
	  {
		  
		  
		      $cod=$valor['cod'];
		   	 
			  
	  }
 }
 
 
 return $cod;
}
 
abm();

?>

