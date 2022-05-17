<?php
require("conexion.php");

	$importe = $_GET['importe'];
	$importe = utf8_decode($importe);
	
	$moneda = $_GET['moneda'];
	$moneda = utf8_decode($moneda);
	
	$referencia = $_GET['referencia'];
	$referencia = utf8_decode($referencia);
	
	$deuda_id = $_GET['deuda_id'];
	$deuda_id = utf8_decode($deuda_id);
	
function cargar_pago($importe,$deuda_id,$moneda,$referencia){
	$mysqli=conectar_al_servidor();
	if($deuda_id=="" || $importe=="" || $moneda=="" || $referencia==""){
	$informacion =array("codigo_respuesta" => "99","mensaje_respuesta" => "CAMPOS VACIOS");
    echo json_encode($informacion);
	exit;
	}else{
	$consulta= "SELECT case when min(cod)='".$deuda_id."' then 'SI' when min(cod)<>'".$deuda_id."' then 'NO' end AS resultado FROM pagoexpress WHERE cedula=(select cedula from pagoexpress where cod='".$deuda_id."') and estado='ACTIVO'";
$stmt = $mysqli->prepare($consulta);
if ( ! $stmt->execute()) {
   echo "Error1";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) { 
		      $resultado=$valor['resultado'];  	  
   }
 }
 if($resultado=="NO"){
 $informacion =array("codigo_respuesta" => "88","mensaje_respuesta" => "PRIMERO FALTA PAGAR CUOTA ANTERIOR");
    echo json_encode($informacion);
	exit;	 
 }

}
	
	


	 $pagina='';
	  $sql="insert into pagos_por_pago_espress (importe,deuda_id,moneda,referencia,fechapago, horapago, estado,cliente,cuota,vencimiento,deuda,cedula)
	  value 
	  (".$importe.",".$deuda_id.",".$moneda.",'".$referencia."',current_date(),current_time(),'PAGADO',(select cliente from pagoexpress where cod='".$deuda_id."'),(select cuota from pagoexpress where cod='".$deuda_id."'),
	  (select fecha from pagoexpress where cod='".$deuda_id."'),(select monto from pagoexpress where cod='".$deuda_id."'),(select cedula from pagoexpress where cod='".$deuda_id."'))";
	   
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
  
    if (!$stmt->execute()) {
echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
  $sql1="update pagoexpress set estado='PAGADO' where cod='".$deuda_id."'";
   $stmt1 = $mysqli->prepare($sql1);
   echo $mysqli -> error;
  
    if (!$stmt1->execute()) {
    echo trigger_error('The query execution failed; MySQL said ('.$stmt1->errno.') '.$stmt1->error, E_USER_ERROR);
   exit;
   }
   
$informacion =array("codigo_respuesta" => "00","mensaje_respuesta" => "PAGADO CORRECTAMENTE");
echo json_encode($informacion);	
exit;
}

cargar_pago($importe,$deuda_id,$moneda,$referencia);
?>