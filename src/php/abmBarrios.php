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
		if($func=='buscarcombo'){		
			buscar_combo();	
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
				
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$barrios = $_POST['barrios'];
		$barrios = ($barrios);
					
		$ciudades_idciudades = $_POST['ciudades_idciudades'];
		$ciudades_idciudades = utf8_decode($ciudades_idciudades);
		
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
		
		mantenimiento($func,$cod,$barrios,$ciudades_idciudades,$hora);
		}
		}	


function mantenimiento($func,$cod,$barrios,$ciudades_idciudades,$hora){
	if($hora=="" || $barrios=="" || $ciudades_idciudades=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from barrios where cod=?  ";
$stmt = $mysqli->prepare($consulta);
$ss='s';
$stmt->bind_param($ss, $idciudades); 
if ( ! $stmt->execute()) {
   echo "Error";
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
   $sql="insert into barrios (barrios,ciudades_idciudades,hora,fecha,estado) value (upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='sss';
   $stmt = $mysqli->prepare($sql);
   $stmt->bind_param($s,$barrios,$ciudades_idciudades,$hora); 
}else if($func=='editar'){
		
	    $sql='update barrios set barrios=upper(?),ciudades_idciudades=upper(?),fecha=current_date(),hora=?,estado="ACTIVO" where cod=?';
		$s='sssi';
			$stmt = $mysqli->prepare($sql);
            $stmt->bind_param($s,$barrios,$ciudades_idciudades,$hora,$cod); 
	} else if($func=='eliminar'){
		
	    $sql="update barrios set estado='ELIMINADO' where cod=?";
		
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
	 $sql= "SELECT b.cod,b.fecha,b.hora, b.barrios, b.ciudades_idciudades,c.departamentos_iddepartamentos,c.ciudades,d.departamentos, b.estado 
FROM barrios b
join ciudades c on b.ciudades_idciudades=c.idciudades
join departamentos d on c.departamentos_iddepartamentos=d.iddepartamentos
 where b.estado=? and concat(b.barrios,' ',c.ciudades) like ? "; 
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
		  	  $barrios=($valor['barrios']);
			   $ciudades_idciudades=utf8_encode($valor['ciudades_idciudades']);
			   $departamentos_iddepartamentos=utf8_encode($valor['departamentos_iddepartamentos']);
			    $ciudades=utf8_encode($valor['ciudades']);
			    $departamentos=utf8_encode($valor['departamentos']);
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
<tr onclick='obtener_datos_Barrios(this)' ".$bacground."  >
<td class='td_detalles' style='width:0%;display: none;' id='td_ciudades_idciudades'>".$ciudades_idciudades."</td>
<td class='td_detalles' style='width:0%;display: none;' id='td_departamentos_iddepartamentos'>".$departamentos_iddepartamentos."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:13.5%;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:13.5%;' id='td_barrios'>".$barrios."</td>
<td class='td_detalles' style='width:13.5%;' id='td_ciudades'>".$ciudades."</td>
<td class='td_detalles' style='width:13.5%;' id='td_departamentos'>".$departamentos."</td>
<td class='td_detalles' style='width:13.5%;' id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:13.5%;' id='td_hora'>".$hora."</td>
<td class='td_detalles' style='width:13.5%;' id='td_estado' >".$estado."</td>
</tr>
";		  
	  }
 }
  $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_combo(){
	 $mysqli=conectar_al_servidor();
	 $pagina='<option value ="">SELECCIONAR</option>';
	 $sql= "Select cod,barrios from barrios where estado='ACTIVO'"; 
   $stmt = $mysqli->prepare($sql);
   if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){  
		      $idciudades=$valor['cod'];  
		  	  $ciudades=($valor['barrios']);
              $pagina.="<option value ='".$idciudades."'>".$ciudades."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}


verificar_datos();

?>