<?php
require("conexion.php");
function abm(){

$mysqli=conectar_al_servidor(); 
$control=1;	
$totalRegistro=$_POST['totalRegistro'];
$totalRegistro = utf8_decode($totalRegistro);

while($control<=$totalRegistro){

$factura=$_POST['factura'.$control];
$factura = utf8_decode($factura);

$cedula=$_POST['cedula'.$control];
$cedula = utf8_decode($cedula);

$cliente=$_POST['cliente'.$control];
$cliente=utf8_decode($cliente);

$cuota=$_POST['cuota'.$control];
$cuota=utf8_decode($cuota);

$fecha=$_POST['fecha'.$control];
$fecha=utf8_decode($fecha);

$monto=$_POST['monto'.$control];
$monto=utf8_decode($monto);

if($factura!="" ){
$consulta1="insert into pagoexpress (factura,cedula,cliente,cuota,fecha,monto) values (?,?,?,?,?,?)";
$stmt1 = $mysqli->prepare($consulta1);
echo $mysqli -> error;
$ss='ssssss';
$stmt1->bind_param($ss,$factura,$cedula,$cliente,$cuota,$fecha,$monto);

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