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
		
        if($func=='buscarsucuesales'){	
            $usuarios_cod = $_POST['usuarios_cod'];
			$usuarios_cod = utf8_decode($usuarios_cod);	
			buscarsucuesales($usuarios_cod);	
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
			
			
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$nombres = $_POST['nombres'];
		$nombres = ($nombres);
					
		$numero = $_POST['numero'];
		$numero = utf8_decode($numero);
		
		$lnglat = $_POST['lnglat'];
		$lnglat = utf8_decode($lnglat);
		
		$barrios_cod = $_POST['barrios_cod'];
		$barrios_cod = utf8_decode($barrios_cod);
		
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
		
		$direccion = $_POST['direccion'];
		$direccion = utf8_decode($direccion);
		
		$ruc = $_POST['ruc'];
		$ruc = utf8_decode($ruc);
		
		$telefono = $_POST['telefono'];
		$telefono = utf8_decode($telefono);
		
		mantenimiento($func,$direccion,$ruc,$telefono,$cod,$nombres,$numero,$lnglat,$barrios_cod,$hora);
		}
		}	


function mantenimiento($func,$direccion,$ruc,$telefono,$cod,$nombres,$numero,$lnglat,$barrios_cod,$hora){
	if($hora=="" || $nombres=="" || $numero=="" || $lnglat=="" || $barrios_cod=="" || $direccion=="" || $ruc=="" || $telefono=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from sucursales where cod=?  ";
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
   $sql="insert into sucursales (direccion,ruc,telefono,nombres, numero, lnglat, barrios_cod, hora, fecha, estado) value (upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='ssssssss';
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
   $stmt->bind_param($s,$direccion,$ruc,$telefono,$nombres,$numero,$lnglat,$barrios_cod,$hora); 
}else if($func=='editar'){
	    $sql='update sucursales set direccion=upper(?), ruc=upper(?), telefono=upper(?), nombres=upper(?), numero=upper(?), lnglat=upper(?), barrios_cod=upper(?),hora=?,fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='ssssssssi';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$direccion,$ruc,$telefono,$nombres,$numero,$lnglat,$barrios_cod,$hora,$cod); 
	} else if($func=='eliminar'){
		
	    $sql="update sucursales set estado='ELIMINADO' where cod=?";
		
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
	
function buscar($buscar,$buscar2) {
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT s.cod, s.nombres, s.numero, s.direccion,s.ruc,s.telefono,s.lnglat, s.barrios_cod,b.barrios,c.ciudades,d.departamentos, s.fecha, s.hora, s.estado 
FROM sucursales s
join barrios b on s.barrios_cod=b.cod
join ciudades c on b.ciudades_idciudades=c.idciudades
join departamentos d on c.departamentos_iddepartamentos=d.iddepartamentos
 where s.estado=? and concat(s.nombres,' ',s.numero) like ? "; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
$buscar="%".$buscar."%";
$buscar2="".$buscar2."";
$stmt->bind_param($s,$buscar2,$buscar);
if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result)) {
		      $barrios_cod=$valor['barrios_cod'];  
		      $cod=$valor['cod'];  
		  	  $lnglat=utf8_encode($valor['lnglat']);
		  	  $barrios=utf8_encode($valor['barrios']);
			   $nombres=utf8_encode($valor['nombres']);
			   $direccion=utf8_encode($valor['direccion']);
			   $ruc=utf8_encode($valor['ruc']);
			   $telefono=utf8_encode($valor['telefono']);
			   $numero=utf8_encode($valor['numero']);
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
<tr onclick='obtener_datos_sucursales(this)' ".$bacground.">
<td class='td_detalles' style='width:0cm;display: none;'   id='td_lnglat'>".$lnglat."</td>
<td class='td_detalles' style='width:0cm;display: none;' id='td_barrios_cod'>".$barrios_cod."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:8.1%;' id='td_nombres'>".$nombres."</td>
<td class='td_detalles' style='width:8.1%;'   id='td_numero' >".$numero."</td>
<td class='td_detalles' style='width:8.1%;'   id='td_direccion' >".$direccion."</td>
<td class='td_detalles' style='width:8.1%;'   id='td_ruc' >".$ruc."</td>
<td class='td_detalles' style='width:8.1%;'   id='td_telefono' >".$telefono."</td>
<td class='td_detalles' style='width:8.1%;' id='td_barrios'>".$barrios."</td>
<td class='td_detalles' style='width:5%;' >
<center>
<a href='https://maps.google.com/?q=".$lnglat."' target='_blank'><button type='button' style='align-items: center;line-height: normal;display: flex;' class='input_atras'><img src='./icono/lotes.png' style='width: 20px;height: 20px; padding: 0px 4px 2px 1px;' /></button></a>
</center>
</td>
<td class='td_detalles' style='width:8.1%;'   id='td_ciudades'>".$ciudades."</td>
<td class='td_detalles' style='width:8.1%;'   id='td_departamentos'>".$departamentos."</td>
<td class='td_detalles' style='width:8.1%;'   id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:8.1%;'   id='td_hora'>".$hora."</td>
<td class='td_detalles' style='width:8.1%;'   id='td_estado'>".$estado."</td>
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
	 $sql= "Select s.cod, concat(s.nombres,' ',s.numero) as sucursl from sucursales s where s.estado='ACTIVO'"; 
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
		  	  $ciudades=utf8_encode($valor['sucursl']);
              $pagina.="<option value ='".$idciudades."'>".$ciudades."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}

function buscarsucuesales($usuarios_cod){
	 $mysqli=conectar_al_servidor();
	 $pagina='';
	 $sql= "SELECT u.sucursales_cod, concat(s.nombres,' ',s.numero) as sucursal
FROM usuarios u
join sucursales s on u.sucursales_cod=s.cod
where u.cod=?"; 
   $stmt = $mysqli->prepare($sql);
$s='s';
$usuarios_cod="".$usuarios_cod."";
$stmt->bind_param($s,$usuarios_cod);
   if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
   }
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){  
		      $sucursales_cod=$valor['sucursales_cod'];  
		  	  $sucursal=utf8_encode($valor['sucursal']);  
	  }
 }
 $informacion =array("1" => "exito","2" => $sucursales_cod,"3" => $sucursal);
	echo json_encode($informacion);	
exit;
}


verificar_datos();

?>