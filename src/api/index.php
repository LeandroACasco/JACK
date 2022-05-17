<?php
require("conexion.php");

    $tipo_documento = $_GET['tipo_documento'];
	$tipo_documento = utf8_decode($tipo_documento);
	
	$documento = $_GET['documento'];
	$documento = utf8_decode($documento);
		
function buscar($tipo_documento,$documento){
	if($tipo_documento=="" || $documento=="" ){
	$informacion =array("codigo_respuesta" => "99","mensaje_respuesta" =>"CAMPOS VACIOS");
    echo json_encode($informacion);
	exit;
	}
	$mysqli=conectar_al_servidor();
	 $pagina='';
	  $control="";
	  $i=0;
   $n=0;
   $cant=0;
	 $mensaje_respuesta="DATOS NO ENCONTRADAS";
	 $codigoresp="88";
	 $datos=Array(Array());
	 $sql= "SELECT cod,factura,cedula,cliente,cuota,fecha,monto FROM pagoexpress where cedula=? and estado='ACTIVO'"; 
   $stmt = $mysqli->prepare($sql);
 $s='s';
$documento="".$documento."";
$stmt->bind_param($s,$documento);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
		      $cod=utf8_encode($valor['cod']);
		  	  $factura=utf8_encode($valor['factura']);
			  $cedula=utf8_encode($valor['cedula']);
			  $cliente=utf8_encode($valor['cliente']);
			  $cuota=utf8_encode($valor['cuota']); 
			  $vencimiento=utf8_encode($valor['fecha']); 
			  $monto=utf8_encode($valor['monto']); 
			   if($cedula==$control || $control==""){
				    $datos[$i]=array("cliente" => $cliente,"deuda_id" => $cod,"cuota" => $cuota,"moneda" => "PYG","importe" => $monto,"vencimiento" => $vencimiento);
				 $i++;
                 $control=$cedula;				 
			   }else{
				   $i=0; 
                  $datos[$i]=array("cliente" => $cliente,"deuda_id" => $cod,"cuota" => $cuota,"moneda" => "PYG","importe" => $monto,"vencimiento" => $vencimiento);
				   $control=$cedula;
                   $i++;				   
			   }
	        
       $cant=$cant+1;
	   
   }
  
 }
 if($cant<=0){
		   $codigoresp="88";
		   $mensaje_respuesta="DATOS NO ENCONTRADAS";
		   $informacion =array("codigo_respuesta" => $codigoresp,"mensaje_respuesta" => $mensaje_respuesta);
          echo json_encode($informacion);	
          exit;
	   }else{
		   $codigoresp="00"; 
		   $mensaje_respuesta="CONSULTA EXITOSA"; 
	   }
$informacion =array("codigo_respuesta" => $codigoresp,"mensaje_respuesta" => $mensaje_respuesta,"datos" => $datos);
echo json_encode($informacion);	
exit;
}


buscar($tipo_documento,$documento);
?>