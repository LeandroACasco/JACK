<?php
require("conexion.php");

	$referencia = $_GET['referencia'];
	$referencia = utf8_decode($referencia);
	
	
	
function anular_pago($referencia){
	if($referencia==""){
	$informacion =array("codigo_respuesta" => "99","mensaje_respuesta" =>"CAMPOS VACIOS");
    echo json_encode($informacion);
	exit;
	}
	$mysqli=conectar_al_servidor();
	$consulta= "Select count(*) from pagos_por_pago_espress where referencia=?  ";
$stmt = $mysqli->prepare($consulta);
echo $mysqli -> error;
$ss='s';
$stmt->bind_param($ss, $referencia); 
if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
$result = $stmt->get_result();
$nro_total=$result->fetch_row();
  $valor=$nro_total[0];

if($valor<1)
{
$informacion =array("codigo_respuesta" => "88","mensaje_respuesta" =>"REFERENCIA INVALIDA");
    echo json_encode($informacion);
	exit;
}


	 $pagina='';
	  $sql="update pagos_por_pago_espress set estado='ANULADO' where referencia='".$referencia."' and cod>0";
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
  
    if (!$stmt->execute()) {
echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
   $sql1="update pagoexpress set estado='ACTIVO' where cod=(select deuda_id from pagos_por_pago_espress where referencia='".$referencia."')";
   $stmt1 = $mysqli->prepare($sql1);
   echo $mysqli -> error;
  
    if (!$stmt1->execute()) {
echo trigger_error('The query execution failed; MySQL said ('.$stmt1->errno.') '.$stmt1->error, E_USER_ERROR);
   exit;
}

$informacion =array("codigo_respuesta" => "00","mensaje_respuesta" => "PAGO ANULADO CORRECTAMENTE");
echo json_encode($informacion);	
exit;
}

anular_pago($referencia);
?>