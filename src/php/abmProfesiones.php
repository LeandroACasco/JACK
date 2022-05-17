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
		
		$Profesion = $_POST['Profesion'];
		$Profesion = ($Profesion);
		
		$SectorEconomico = $_POST['SectorEconomico'];
		$SectorEconomico = utf8_decode($SectorEconomico);
						
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
	
		mantenimiento($func,$cod,$Profesion,$SectorEconomico,$hora);
		}
		}	


function mantenimiento($func,$cod,$Profesion,$SectorEconomico,$hora){
	if($hora=="" || $Profesion=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from profesiones where cod=?  ";
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
   $sql="insert into profesiones (profesion,sectoreconomico, hora, fecha, estado) value (upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='sss';
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
   $stmt->bind_param($s,$Profesion,$SectorEconomico,$hora); 
}else if($func=='editar'){
	    $sql='update profesiones set profesion=upper(?),sectoreconomico=upper(?),hora=?,fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='sssi';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$Profesion,$SectorEconomico,$hora,$cod); 
	} else if($func=='eliminar'){
		
	    $sql="update profesiones set estado='ELIMINADO' where cod=?";
		
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
	
function buscar($buscar,$buscar2)
{
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT cod, Profesion, SectorEconomico, fecha, hora, estado FROM profesiones
 where estado=? and Profesion like ? order by cod desc"; 
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
		  	  $Profesion=($valor['Profesion']);
		  	  $SectorEconomico=utf8_encode($valor['SectorEconomico']);
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
<tr onclick='obtener_datos_profesiones(this)'  ".$bacground.">
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:15.8%;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:15.8%;' id='td_Profesion'>".$Profesion."</td>
<td class='td_detalles' style='width:15.8%;' id='td_SectorEconomico'>".$SectorEconomico."</td>
<td class='td_detalles' style='width:15.8%;'   id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:15.8%;'   id='td_hora'>".$hora."</td>
<td class='td_detalles' style='width:15.8%;'   id='td_estado'>".$estado."</td>
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
	 $sql= "Select cod,profesion from profesiones where estado='ACTIVO'"; 
   $stmt = $mysqli->prepare($sql);
   if ( ! $stmt->execute()) {
   echo "Error1";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){  
		      $idciudades=$valor['cod'];  
		  	  $ciudades=($valor['profesion']);
              $pagina.="<option value ='".$idciudades."'>".$ciudades."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}


verificar_datos();

?>