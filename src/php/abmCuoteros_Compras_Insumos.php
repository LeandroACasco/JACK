<?php
require("conexion.php");
function cargar_cuoteros_compras_insumos(){

$mysqli=conectar_al_servidor(); 
$control=1;	
$totalRegistro=$_POST['totalRegistro'];
$totalRegistro = utf8_decode($totalRegistro);	

$hora=$_POST['hora'];
$hora = utf8_decode($hora);

$usuarios_cod=$_POST['usuarios_cod'];
$usuarios_cod = utf8_decode($usuarios_cod);

while($control<=$totalRegistro){


$vto=$_POST['vto'.$control];
$vto = utf8_decode($vto);

$plazo=$_POST['plazo'.$control];
$plazo = utf8_decode($plazo);

$monto=$_POST['monto'.$control];
$monto = utf8_decode($monto);

if($vto!="" || $plazo!="" || $monto!="" || $usuarios_cod!=""  ){
$consulta1="Insert into cuoteros_compras_proveedores (vto, plazo, monto, hora, usuarios_cod,fecha, compras_cod, estado)
values(upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),(select max(cod) from compras where estado='ACTIVO' limit 1),'ACTIVO')";
$stmt1 = $mysqli->prepare($consulta1);
echo $mysqli -> error;
$ss='sssss';
$stmt1->bind_param($ss,$vto,$plazo,$monto,$hora,$usuarios_cod);

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



cargar_cuoteros_compras_insumos();

?>