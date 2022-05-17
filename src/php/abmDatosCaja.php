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
            $cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_combo($cod);	
		}
		
		if($func=='buscar_combo_caja'){	
			buscar_combo_caja();	
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
			
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$nombre = $_POST['nombre'];
		$nombre = utf8_decode($nombre);
			
		$nro = $_POST['nro'];
		$nro = utf8_decode($nro);
			
		$sucursales_cod = $_POST['sucursales_cod'];
		$sucursales_cod = utf8_decode($sucursales_cod);
		
		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
						
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
		
		mantenimiento($func,$cod,$nombre,$nro,$sucursales_cod,$usuarios_cod,$hora);
		}
		}	


function mantenimiento($func,$cod,$nombre,$nro,$sucursales_cod,$usuarios_cod,$hora){
	if($hora=="" || $nombre=="" || $nro=="" || $sucursales_cod=="" || $usuarios_cod=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from datoscaja where cod=?  ";
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
   $sql="insert into datoscaja (nombre, nro, sucursales_cod, usuarios_cod, hora, fecha, estado) value (upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='sssss';
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
   $stmt->bind_param($s,$nombre,$nro,$sucursales_cod,$usuarios_cod,$hora); 
}else if($func=='editar'){
	    $sql='update datoscaja set nombre=upper(?), nro=upper(?), sucursales_cod=upper(?), usuarios_cod=upper(?),hora=?,fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='sssssi';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$nombre,$nro,$sucursales_cod,$usuarios_cod,$hora,$cod); 
	} else if($func=='eliminar'){
		
	    $sql="update datoscaja set estado='ELIMINADO' where cod=?";
		
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
	 $sql= "SELECT d.cod,d.nombre,d.nro,d.sucursales_cod,concat(s.nombres,' ',s.numero) as sucursal,d.fecha,d.hora,d.estado 
FROM datoscaja d
join sucursales s on d.sucursales_cod=s.cod
 where d.estado=? and d.nombre like ? "; 
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
		  	  $nombre=utf8_encode($valor['nombre']);
		  	  $nro=utf8_encode($valor['nro']);
		  	  $sucursales_cod=utf8_encode($valor['sucursales_cod']);
		  	  $sucursal=utf8_encode($valor['sucursal']);
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
<tr onclick='obtener_datos_datoscaja(this)' ".$bacground.">
<td class='td_detalles' style='width:0%;display:none' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:15.8%;' id='td_nombre'>".$nombre."</td>
<td class='td_detalles' style='width:15.8%;' id='td_nro'>".$nro."</td>
<td class='td_detalles' style='width:0%;display:none' id='td_sucursales_cod'>".$sucursales_cod."</td>
<td class='td_detalles' style='width:15.8%;' id='td_sucursal'>".$sucursal."</td>
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

function buscar_combo($cod){
	 $mysqli=conectar_al_servidor();
	 $pagina='<option value ="">SELECCIONAR</option>';
	 $sql= "SELECT d.cod,concat(d.nombre,' ',d.nro,' - ',s.nombres,' ',s.numero) as sucursal,d.estado 
FROM datoscaja d
join sucursales s on d.sucursales_cod=s.cod
where d.estado='ACTIVO' and d.sucursales_cod=".$cod.""; 
   $stmt = $mysqli->prepare($sql);
   if ( ! $stmt->execute()) {
   echo "Error1";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){  
		      $cod=$valor['cod'];  
		  	  $sucursal=utf8_encode($valor['sucursal']);
              $pagina.="<option value ='".$cod."'>".$sucursal."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}

function buscar_combo_caja(){
	 $mysqli=conectar_al_servidor();
	 $pagina='<option value ="TODOS">TODOS</option>';
	 $sql= "SELECT d.cod,concat(d.nombre,' ',d.nro,' - ',s.nombres,' ',s.numero) as sucursal,d.estado 
FROM datoscaja d
join sucursales s on d.sucursales_cod=s.cod
where d.estado='ACTIVO'"; 
   $stmt = $mysqli->prepare($sql);
   if ( ! $stmt->execute()) {
   echo "Error1";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){  
		      $cod=$valor['cod'];  
		  	  $sucursal=utf8_encode($valor['sucursal']);
              $pagina.="<option value ='".$cod."'>".$sucursal."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}



verificar_datos();

?>