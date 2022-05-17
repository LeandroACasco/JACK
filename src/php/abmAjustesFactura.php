<?php
require("conexion.php");

function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
		if($func=='buscar'){
			$buscar = $_POST['buscar'];
			$buscar = utf8_decode($buscar);
			
			$buscar2 = $_POST['buscar2'];
			$buscar2 = utf8_decode($buscar2);	
			buscar($buscar,$buscar2);
		}

		if($func=='obtenernrofactura'){		
		    $sucursales_cod = $_POST['sucursales_cod'];
			$sucursales_cod = utf8_decode($sucursales_cod);
			obtenernrofactura($sucursales_cod);	
		}
		if($func=='obtener_nrocomprobante'){		
		    $sucursales_cod = $_POST['sucursales_cod'];
			$sucursales_cod = utf8_decode($sucursales_cod);
			obtener_nrocomprobante($sucursales_cod);	
		}
		if($func=='obtener_nrorecibo'){		
		    $sucursales_cod = $_POST['sucursales_cod'];
			$sucursales_cod = utf8_decode($sucursales_cod);
			obtener_nrorecibo($sucursales_cod);	
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
				
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$timbrado = $_POST['timbrado'];
		$timbrado = utf8_decode($timbrado);
       
        $ruc = $_POST['ruc'];
		$ruc = utf8_decode($ruc);

		$iniciovigencia = $_POST['iniciovigencia'];
		$iniciovigencia = utf8_decode($iniciovigencia);

		$finvigencia = $_POST['finvigencia'];
		$finvigencia = utf8_decode($finvigencia);

		$nrofactura = $_POST['nrofactura'];
		$nrofactura = utf8_decode($nrofactura);

		$titular = $_POST['titular'];
		$titular = utf8_decode($titular);

		$actividades = $_POST['actividades'];
		$actividades = utf8_decode($actividades);

		$direccion = $_POST['direccion'];
		$direccion = utf8_decode($direccion);

		$telefono = $_POST['telefono'];
		$telefono = utf8_decode($telefono);

		$ciudad = $_POST['ciudad'];
		$ciudad = utf8_decode($ciudad);

		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
						
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
		
		mantenimiento($func,$cod,$ruc,$timbrado,$iniciovigencia,$finvigencia,$nrofactura,$titular,$actividades,$direccion,$telefono,$ciudad,$usuarios_cod,$hora);
		

		}	
		}	


    function mantenimiento($func,$cod,$ruc,$timbrado,$iniciovigencia,$finvigencia,$nrofactura,$titular,$actividades,$direccion,$telefono,$ciudad,$usuarios_cod,$hora){
	if($hora=="" || $timbrado==""  || $iniciovigencia==""   || $finvigencia==""   || $nrofactura=="" || $usuarios_cod==""  || $hora=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
	if($func=='guardar'){
		$consulta= "Select count(*) from ajustesfactura where cod=?";
		$stmt = $mysqli->prepare($consulta);
		$ss='s';
		$stmt->bind_param($ss, $cod); 
		if ( ! $stmt->execute()) {
		   echo "Error1";
		   exit;
		}
		$result = $stmt->get_result();
		$nro_total=$result->fetch_row();
		  $valor=$nro_total[0];

		if($valor>=1){
		echo "duplicado";	
		exit;
		}
		   $sql="insert into ajustesfactura (timbrado,ruc, iniciovigencia, finvigencia, nrofactura, titular, actividades, direccion, telefono, ciudad, usuarios_cod, hora, fecha, estado) value (?,?,?,?,?,?,?,upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
		   $s='ssssssssssss';
		   $stmt = $mysqli->prepare($sql);
		   echo $mysqli -> error;
		   $stmt->bind_param($s,$timbrado,$ruc,$iniciovigencia,$finvigencia,$nrofactura,$titular,$actividades,$direccion,$telefono,$ciudad,$usuarios_cod,$hora); 
	}
    if($func=='editar'){
	    $sql='update ajustesfactura set timbrado=upper(?), ruc=upper(?), iniciovigencia=upper(?), finvigencia=upper(?), nrofactura=upper(?), titular=upper(?), actividades=upper(?), direccion=upper(?), telefono=upper(?), ciudad=upper(?), usuarios_cod=upper(?), hora=upper(?),fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='ssssssssssssi';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$timbrado,$ruc,$iniciovigencia,$finvigencia,$nrofactura,$titular,$actividades,$direccion,$telefono,$ciudad,$usuarios_cod,$hora,$cod); 
	} 

	if($func=='eliminar'){
		
	    $sql="update ajustesfactura set estado='ELIMINADO' where cod=?";
		
		$s='i';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$cod); 
	}
   if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
	echo"exito";
}
	
function buscar($buscar,$buscar2){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT cod, timbrado,ruc, iniciovigencia, finvigencia, nrofactura, titular, actividades, direccion, telefono, ciudad,fecha, hora, estado FROM ajustesfactura
 where estado=? and nrofactura like ? "; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
$buscar="%".$buscar."%";
$buscar2="".$buscar2."";
$stmt->bind_param($s,$buscar2,$buscar);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		     
		        $cod=$valor['cod'];  
		  	    $timbrado=utf8_encode($valor['timbrado']);
		  	    $ruc=utf8_encode($valor['ruc']);
			    $iniciovigencia=utf8_encode($valor['iniciovigencia']);
			    $finvigencia=utf8_encode($valor['finvigencia']);
			    $nrofactura=utf8_encode($valor['nrofactura']);
			    $titular=utf8_encode($valor['titular']);
			    $actividades=utf8_encode($valor['actividades']);
			    $direccion=utf8_encode($valor['direccion']);
			    $telefono=utf8_encode($valor['telefono']);
			    $ciudad=utf8_encode($valor['ciudad']);
			    $estado=utf8_encode($valor['estado']); 
	  	 $cant=$cant+1;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr onclick='obtener_datos_ajustesfactura(this)' ".$bacground.">
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:8.6%;' id='td_titular'>".$titular."</td>
<td class='td_detalles' style='width:8.6%;' id='td_ruc'>".$ruc."</td>
<td class='td_detalles' style='width:8.6%;'   id='td_telefono'>".$telefono."</td>
<td class='td_detalles' style='width:8.6%;'   id='td_direccion'>".$direccion."</td>
<td class='td_detalles' style='width:8.6%;'   id='td_ciudad'>".$ciudad."</td>
<td class='td_detalles' style='width:8.6%;'   id='td_actividades'>".$actividades."</td>
<td class='td_detalles' style='width:8.6%;'   id='td_timbrado'>".$timbrado."</td>
<td class='td_detalles' style='width:8.6%;'   id='td_iniciovigencia'>".$iniciovigencia."</td>
<td class='td_detalles' style='width:8.6%;'   id='td_finvigencia'>".$finvigencia."</td>
<td class='td_detalles' style='width:8.6%;'   id='td_nrofactura'>".$nrofactura."</td>
<td class='td_detalles' style='width:8.6%;'   id='td_estado'>".$estado."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

	
function obtenernrofactura($sucursales_cod){
	$mysqli=conectar_al_servidor();
	 $sql= "SELECT nrofactura FROM ajustesfactura where estado='ACTIVO' and sucursal_cod='".$sucursales_cod."'"; 
  $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
 echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {    
		$nrofactura=$valor['nrofactura']; 
          $nro= intVal($nrofactura)+1;	  	   	  
   }
 }
 
$informacion =array("1" => $nro);
echo json_encode($informacion);	
exit;
}

function obtener_nrorecibo($sucursales_cod){
	$mysqli=conectar_al_servidor();
	 $sql= "SELECT nrorecibo FROM ajustesfactura where estado='ACTIVO' and sucursal_cod='".$sucursales_cod."'"; 
  $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
 echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {    
		$nrorecibo=$valor['nrorecibo']; 
          $nro= intVal($nrorecibo)+1;	  	   	  
   }
 }
 
$informacion =array("1" => $nro);
echo json_encode($informacion);	
exit;
}


function obtener_nrocomprobante($sucursales_cod){
	$mysqli=conectar_al_servidor();
	 $sql= "SELECT nrocomprobante FROM ajustesfactura where estado='ACTIVO' and sucursal_cod='".$sucursales_cod."'"; 
  $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
 echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {    
		$nrocomprobante=$valor['nrocomprobante']; 
          $nro= intVal($nrocomprobante)+1;	  	   	  
   }
 }
 
$informacion =array("1" => $nro);
echo json_encode($informacion);	
exit;
}


verificar_datos();

?>