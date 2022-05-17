<?php
require("conexion.php");
function abm(){

$mysqli=conectar_al_servidor(); 
$control=1;	
$totalRegistro=$_POST['totalRegistro'];
$totalRegistro = utf8_decode($totalRegistro);

$usuarios_cod = $_POST['usuarios_cod'];
$usuarios_cod = utf8_decode($usuarios_cod);

$hora=$_POST['hora'];
$hora = utf8_decode($hora);

while($control<=$totalRegistro){


$nombre=$_POST['nombre'.$control];
$nombre = ($nombre);

$telefono=$_POST['telefono'.$control];
$telefono = utf8_decode($telefono);

$vinculo=$_POST['vinculo'.$control];
$vinculo = ($vinculo);



if($vinculo!="" || $telefono!="" || $nombre!=""  ){
$consulta1="Insert into referenciaspersonales (SolicitudesCreditos_cod, vinculo,nombre,telefono,hora,usuarios_cod,fecha,estado)
values((select max(cod) from solicitudescreditos where estado='ACTIVO' limit 1),upper(?),upper(?),upper(?),?,?,current_date(),'ACTIVO')";
$stmt1 = $mysqli->prepare($consulta1);
echo $mysqli -> error;
$ss='sssss';
$stmt1->bind_param($ss,$vinculo,$nombre,$telefono,$hora,$usuarios_cod);

if (!$stmt1->execute()) {
	
echo trigger_error('The query execution failed; MySQL said ('.$stmt1->errno.') '.$stmt1->error, E_USER_ERROR);
exit;
}
$control=$control+1;
}	

}


$informacion =array("1" => "exito");
echo json_encode($informacion);	
exit;
	
}

abm();

?>