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
		if($func=='buscarvista'){
			$buscar = $_POST['buscar'];
			$buscar = utf8_decode($buscar);
			
			
			$buscar2 = $_POST['buscar2'];
			$buscar2 = utf8_decode($buscar2);	
			buscarvista($buscar,$buscar2);
			
		}
		if($func=='buscarcombo'){		
			buscar_combo();	
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
				
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$porcentaje = $_POST['porcentaje'];
		$porcentaje = utf8_decode($porcentaje);
		
		$descripcion = $_POST['descripcion'];
		$descripcion = utf8_decode($descripcion);
						
		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
		
		
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
		
		mantenimiento($func,$cod,$porcentaje,$descripcion,$hora,$usuarios_cod);
		}
		}	


function mantenimiento($func,$cod,$porcentaje,$descripcion,$hora,$usuarios_cod){
	if($hora=="" || $porcentaje=="" || $descripcion=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from margendeutilidades where cod=?  ";
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

if($valor>=1)
{
echo "duplicado";	
exit;
}
   $sql="insert into margendeutilidades (usuarios_cod,porcentaje,descripcion, hora, fecha, estado) value (upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='ssss';
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
   $stmt->bind_param($s,$usuarios_cod,$porcentaje,$descripcion,$hora); 
}else if($func=='editar'){
	    $sql='update margendeutilidades set usuarios_cod=upper(?), porcentaje=upper(?),descripcion=upper(?),hora=?,fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='ssssi';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$usuarios_cod,$porcentaje,$descripcion,$hora,$cod); 
	} else if($func=='eliminar'){
		
	    $sql="update margendeutilidades set estado='ELIMINADO' where cod=?";
		
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
	 $bacground='rgba(0,0,0,0.05)';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT cod, porcentaje,descripcion, fecha, hora, estado FROM margendeutilidades
 where estado=? and descripcion like ? "; 
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
 
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result)) {
		     
		      $cod=$valor['cod'];  
		  	  $porcentaje=utf8_encode($valor['porcentaje']);
		  	  $descripcion=utf8_encode($valor['descripcion']);
			    $fecha=utf8_encode($valor['fecha']);
			    $hora=utf8_encode($valor['hora']);
			  $estado=utf8_encode($valor['estado']); 
	  	 $cant=$cant+1;
		 if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
		
$pagina.="
<tr onclick='obtener_datos_utilidades(this)' ".$bacground." >
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center; ' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:15%; ' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:15%; ' id='td_porcentaje'>".$porcentaje."</td>
<td class='td_detalles' style='width:20%;' id='td_descripcion'>".$descripcion."</td>
<td class='td_detalles' style='width:15%;'   id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:15%; '   id='td_hora'>".$hora."</td>
<td class='td_detalles' style='width:15%;'   id='td_estado'>".$estado."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}
function buscarvista($buscar,$buscar2){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT cod, porcentaje,descripcion, fecha, hora, estado FROM margendeutilidades
 where estado=? and descripcion like ? "; 
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
 
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result)) {
		     
		      $cod=$valor['cod'];  
		  	  $porcentaje=utf8_encode($valor['porcentaje']);
		  	  $descripcion=utf8_encode($valor['descripcion']);
			    $fecha=utf8_encode($valor['fecha']);
			    $hora=utf8_encode($valor['hora']);
			  $estado=utf8_encode($valor['estado']); 
	  	 $cant=$cant+1;
		 if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
		
		 
$pagina.=" 
<tr onclick='obtener_datos_utilidadesvista(this)' ".$bacground.">
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:15%;' id='td_porcentaje'>".$porcentaje."</td>
<td class='td_detalles' style='width:65%;' id='td_descripcion'>".$descripcion."</td>
<td class='td_detalles' style='width:15%;'   id='td_estado'>".$estado."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

verificar_datos();

?>