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

$nambreentidad=$_POST['nambreentidad'.$control];
$nambreentidad = ($nambreentidad);

$cuota=$_POST['cuota'.$control];
$cuota = utf8_decode($cuota);

$plazo=$_POST['plazo'.$control];
$plazo=utf8_decode($plazo);


$saldo=$_POST['saldo'.$control];
$saldo=utf8_decode($saldo);

$obs=$_POST['obs'.$control];
$obs=($obs);

if($nambreentidad!="" ){
$consulta1="Insert into referenciascreditoscomerciales (SolicitudesCreditos_cod,nambreentidad, cuota, plazo, saldo, obs,hora,usuarios_cod,fecha,estado)
values((select max(cod) from solicitudescreditos where estado='ACTIVO' limit 1),upper(?),?,?,?,upper(?),?,?,current_date(),'ACTIVO')";
$stmt1 = $mysqli->prepare($consulta1);
echo $mysqli -> error;
$ss='sssssss';
$stmt1->bind_param($ss,$nambreentidad,$cuota,$plazo,$saldo,$obs,$hora,$usuarios_cod);

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