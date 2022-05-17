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
		
		$ruc = $_POST['ruc'];
		$ruc = utf8_decode($ruc);
		
		$nombre = $_POST['nombre'];
		$nombre = ($nombre);
		
		$direccion = $_POST['direccion'];
		$direccion = utf8_decode($direccion);
		
		$email = $_POST['email'];
		$email = utf8_decode($email);
		
		$telefono = $_POST['telefono'];
		$telefono = utf8_decode($telefono);
		
		$barrios_cod = $_POST['barrios_cod'];
		$barrios_cod = utf8_decode($barrios_cod);
						
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
		
		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
		
		mantenimiento($func,$cod,$ruc,$nombre,$direccion,$email,$telefono,$barrios_cod,$usuarios_cod,$hora);
		}
		}	


function mantenimiento($func,$cod,$ruc,$nombre,$direccion,$email,$telefono,$barrios_cod,$usuarios_cod,$hora){
	if($hora=="" || $nombre=="" || $barrios_cod==""  || $usuarios_cod=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from proveedores where cod=?  ";
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
   $sql="insert into proveedores (ruc, nombre, direccion,email, telefono, barrios_cod, hora, usuarios_cod, fecha,estado) value (upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='ssssssss';
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
   $stmt->bind_param($s,$ruc,$nombre,$direccion,$email,$telefono,$barrios_cod,$hora,$usuarios_cod); 
}else if($func=='editar'){
	    $sql='update proveedores set ruc=upper(?), nombre=upper(?), direccion=upper(?), email=upper(?), telefono=upper(?), barrios_cod=?, hora=?, usuarios_cod=?, fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='ssssssssi';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$ruc,$nombre,$direccion,$email,$telefono,$barrios_cod,$hora,$usuarios_cod,$cod); 
	} else if($func=='eliminar'){
		
	    $sql="update proveedores set estado='ELIMINADO' where cod=?";
		
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
	 $sql= "SELECT e.cod,e.ruc,e.nombre,e.telefono,e.direccion,e.email,e.barrios_cod,b.barrios,c.ciudades,e.fecha,e.hora,e.estado
FROM proveedores e
join barrios b on e.barrios_cod=b.cod
join ciudades c on b.ciudades_idciudades=c.idciudades
 where e.estado=? and concat(e.ruc,' ',e.nombre) like ? "; 
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
		  	  $ruc=utf8_encode($valor['ruc']);
		  	  $nombre=utf8_encode($valor['nombre']);
		  	  $telefono=utf8_encode($valor['telefono']);
		  	  $direccion=utf8_encode($valor['direccion']);
		  	  $email=utf8_encode($valor['email']);
		  	  $barrios=utf8_encode($valor['barrios']);
		  	  $ciudades=utf8_encode($valor['ciudades']);
		  	  $barrios_cod=utf8_encode($valor['barrios_cod']);
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
<tr onclick='obtener_datos_proveedores(this)' ".$bacground.">
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_barrios_cod'>".$barrios_cod."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:10%;' id='td_ruc'>".$ruc."</td>
<td class='td_detalles' style='width:12%;' id='td_nombre'>".$nombre."</td>
<td class='td_detalles' style='width:12%;'   id='td_telefono'>".$telefono."</td>
<td class='td_detalles' style='width:12%;'   id='td_direccion'>".$direccion."</td>
<td class='td_detalles' style='width:12%;'   id='td_email'>".$email."</td>
<td class='td_detalles' style='width:12%;'   id='td_barrios'>".$barrios."</td>
<td class='td_detalles' style='width:12%;'   id='td_ciudad'>".$ciudades."</td>
<td class='td_detalles' style='width:12%;'   id='td_estado'>".$estado."</td>
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
	 $pagina='<option value ="TODOS">TODOS</option>';
	 $sql= "SELECT cod,nombre FROM proveedores where estado='ACTIVO'"; 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result))
 {  
		      $cod=$valor['cod'];  
		  	  $nombre=utf8_encode($valor['nombre']);
              $pagina.="<option value ='".$cod."'>".$nombre."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}


verificar_datos();

?>