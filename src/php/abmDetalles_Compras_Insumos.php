<?php
require("conexion.php");
function cargar_detalles_compras_insumos(){

$mysqli=conectar_al_servidor(); 
$control=1;	
$totalRegistro=$_POST['totalRegistro'];
$totalRegistro = utf8_decode($totalRegistro);

while($control<=$totalRegistro){


$cantidad=$_POST['cantidad'.$control];
$cantidad = utf8_decode($cantidad);

$conceptos_cod=$_POST['conceptos_cod'.$control];
$conceptos_cod = utf8_decode($conceptos_cod);

$concepto=$_POST['concepto'.$control];
$concepto = utf8_decode($concepto);

$precio=$_POST['precio'.$control];
$precio = utf8_decode($precio);

$subtotal=$_POST['subtotal'.$control];
$subtotal = utf8_decode($subtotal);



if($cantidad!="" || $conceptos_cod!="" || $precio!="" || $subtotal!=""  ){
$consulta1="Insert into detalles_compras (cantidad,conceptos_cod,concepto, precio, subtotal, compras_cod,  estado)
values(upper(?),upper(?),upper(?),upper(?),upper(?),(select max(cod) from compras where estado='ACTIVO' limit 1),'ACTIVO')";
$stmt1 = $mysqli->prepare($consulta1);
echo $mysqli -> error;
$ss='sssss';
$stmt1->bind_param($ss,$cantidad,$conceptos_cod,$concepto,$precio,$subtotal);

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



cargar_detalles_compras_insumos();

?>