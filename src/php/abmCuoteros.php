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
	
		if($func=='buscarcombomes'){		
			buscarcombomes();	
		}
		
		if($func=='buscarcombomonto'){	
            $condicion = $_POST['condicion'];
			$condicion = utf8_decode($condicion);		
			buscarcombomonto($condicion);
		}
		if($func=='buscarcomboplazo'){	
            $monto = $_POST['monto'];
			$monto = utf8_decode($monto);	

            $condicion = $_POST['condicion'];
			$condicion = utf8_decode($condicion);		
			buscarcomboplazo($monto,$condicion);
		}
		
		if($func=='buscarcombocuotamonto'){	
            $cod = $_POST['cod'];
			$cod = utf8_decode($cod);		
			buscarcombocuotamonto($cod);
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$condicion = $_POST['condicion'];
		$condicion = utf8_decode($condicion);
		
		$montodisponible = $_POST['montodisponible'];
		$montodisponible = utf8_decode($montodisponible);	
		
		$plazo = $_POST['plazo'];
		$plazo = utf8_decode($plazo);
		
		$montocuota = $_POST['montocuota'];
		$montocuota = utf8_decode($montocuota);
		
		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
		
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
		
		mantenimiento($func,$cod,$condicion,$montodisponible,$plazo,$montocuota,$usuarios_cod,$hora);
		}
		}	

function mantenimiento($func,$cod,$condicion,$montodisponible,$plazo,$montocuota,$usuarios_cod,$hora){
	if($hora=="" || $condicion=="" || $montodisponible=="" || $plazo=="" || $montocuota==""){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from planprestamos where cod=?  ";
$stmt = $mysqli->prepare($consulta);
$ss='s';
$stmt->bind_param($ss, $cod); 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
$result = $stmt->get_result();
$nro_total=$result->fetch_row();
  $valor=$nro_total[0];

if($valor>=1){
echo "duplicado";	
exit;
}
   $sql="insert into planprestamos (condicion, montodisponible, plazo, montocuota,usuarios_cod, hora,fecha, estado) value (upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='ssssss';
   $stmt = $mysqli->prepare($sql);
   $stmt->bind_param($s,$condicion,$montodisponible,$plazo,$montocuota,$usuarios_cod,$hora); 
}else if($func=='editar'){
		
	    $sql='update planprestamos set condicion=upper(?),montodisponible=upper(?),plazo=upper(?),montocuota=upper(?),usuarios_cod=upper(?),hora=?,fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='ssssssi';
			$stmt = $mysqli->prepare($sql);
            $stmt->bind_param($s,$condicion,$montodisponible,$plazo,$montocuota,$usuarios_cod,$hora,$cod); 
	} else if($func=='eliminar'){
		
	    $sql="update planprestamos set estado='ELIMINADO' where cod=?";
		
		$s='i';
			$stmt = $mysqli->prepare($sql);
            $stmt->bind_param($s,$cod); 
	}
   if ( ! $stmt->execute()) {
   echo "Error";
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
	 $sql= "SELECT p.cod, p.condicion, p.montodisponible, p.plazo, p.montocuota, p.fecha, p.hora, p.estado 
FROM planprestamos p
 where p.estado=? and p.montodisponible like ? "; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
$buscar="%".$buscar."%";
$buscar2="".$buscar2."";
$stmt->bind_param($s,$buscar2,$buscar);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
		      $cod=$valor['cod'];  
		  	  $condicion=utf8_encode($valor['condicion']);
			  $montodisponible=utf8_encode($valor['montodisponible']);
			  $montodisponible1=number_format($montodisponible,'0',',','.');
			  $plazo=utf8_encode($valor['plazo']);
			  $plazo1=number_format($plazo,'0',',','.');
			  $montocuota=utf8_encode($valor['montocuota']);
			  $montocuota1=number_format($montocuota,'0',',','.');
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

<tr onclick='obtener_datos_cuoteros(this)' ".$bacground." >
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:11.8%;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:11.8%;' id='td_condicion'>".$condicion."</td>
<td class='td_detalles' style='width:11.8%;' id='td_montodisponible'>".$montodisponible1."</td>
<td class='td_detalles' style='width:11.8%;' id='td_plazo'>".$plazo1."</td>
<td class='td_detalles' style='width:11.8%;' id='td_montocuota'>".$montocuota1."</td>
<td class='td_detalles' style='width:11.8%;' id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:11.8%;' id='td_hora'>".$hora."</td>
<td class='td_detalles' style='width:11.8%;' id='td_estado' >".$estado."</td>
</tr>
";		  
	  }
 }
  $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

 function buscarcombomes(){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $sql= "SELECT cod,condicion FROM planprestamos where estado='ACTIVO' group by condicion order by cod desc "; 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){  
		      $cod=$valor['cod'];  
		  	  $condicion=utf8_encode($valor['condicion']);
              $pagina.="<option value ='".$condicion."'>".$condicion."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}

 function buscarcombomonto($condicion){
	$mysqli=conectar_al_servidor();
	 $pagina='<option value ="">SELECCIONAR</option>';
	 $sql= "SELECT cod,montodisponible FROM planprestamos where estado='ACTIVO' AND condicion='$condicion' group by montodisponible order by cod desc"; 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){  
		      $cod=$valor['cod'];  
		  	  $montodisponible=utf8_encode($valor['montodisponible']);
			  $montodisponible1=number_format($montodisponible,'0',',','.');
              $pagina.="<option value ='".$montodisponible."'>".$montodisponible1."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
} 

 function buscarcomboplazo($monto,$condicion){
	$mysqli=conectar_al_servidor();
	 $pagina='<option value ="">SELECCIONAR</option>';
	 $sql= "SELECT cod,plazo FROM planprestamos where estado='ACTIVO' AND montodisponible='".$monto."' and condicion='".$condicion."' order by cod desc"; 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){  
		      $cod=$valor['cod'];  
		  	  $plazo=utf8_encode($valor['plazo']);	  
		   
              $pagina.="<option value ='".$cod."'>".$plazo."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}
 

 
 function buscarcombocuotamonto($cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $sql= "SELECT cod,montocuota FROM planprestamos where estado='ACTIVO' AND cod='$cod' order by cod desc"; 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){  
		      $cod=$valor['cod'];  
		  	  $montocuota=utf8_encode($valor['montocuota']);	  
		  	 $montocuota1=number_format($montocuota,'0',',','.');	  
              $pagina.="<option value ='".$cod."'>".$montocuota1."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}
 
 verificar_datos();

?>