<?php
include('control_de_variables.php');
$funt = $_POST['funt'];
$funt = preparar_variables(utf8_decode($funt));

//cargar achivos importantes
require("conexion.php");
include("verificar_navegador.php");
function verificar($funt){
	$user=$_POST['useru'];
    $user = utf8_decode($user);
	$pass=$_POST['passu'];
	
	  $pass = str_replace("=","+",$pass);
$navegador=$_POST['navegador'];
$navegador = utf8_decode($navegador);
$resp=verificar_navegador($user,$navegador,$pass);
if($resp!="ok"){
 $informacion =array("1" => "UI");
echo json_encode($informacion);	
exit;
}

if($funt=="cerrarsesion"){
	
	cerrarSesion($user);

}

	if($funt=="buscarmisdatos"){
	buscarmisdatos($user);
}

if($funt=="addtoken"){

$token=$_POST['token'];
$token = utf8_decode($token);
$dispositivo=$_POST['dispositivo'];
$dispositivo = utf8_decode($dispositivo);
 addtoken($token,$dispositivo);
}

}


function cerrarSesion($usuario){
	$mysqli=conectar_al_servidor();
	$consulta="DELETE FROM seguridad where id_usuario=?";
  $stmt = $mysqli->prepare($consulta);

$ss='s';

$stmt->bind_param($ss,$usuario); 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
  $informacion =array("1" => "exito");
echo json_encode($informacion);	
exit;

}



function addtoken($token,$dispositivo)
{
	
if($token==""){
	  $informacion =array("1" => "exito");
echo json_encode($informacion);	
exit;
}
 $tokeActual=buscarToken($dispositivo);
 if($tokeActual==$token){
	  $informacion =array("1" => "exito");
echo json_encode($informacion);	
exit;
 }
	$mysqli=conectar_al_servidor();
	$consulta="DELETE FROM token where dispositivo='$dispositivo'";
 
  $stmt = $mysqli->prepare($consulta);


if ( ! $stmt->execute()) {
 echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
exit;
}		
	$consulta="Insert into token (token,dispositivo) values('$token','$dispositivo')";	

	$stmt = $mysqli->prepare($consulta);

	
if ( ! $stmt->execute()) {
  echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
exit;
}

  $informacion =array("1" => "exito");
echo json_encode($informacion);	
exit;	
	
	
}






function buscarmisdatos($codusario)
{
	$mysqli=conectar_al_servidor();
	 $nombreapellido='';
	 $idcaja='';
	 $caja='';
		$sql= "Select u.sucursales_cod,u.cod,u.user,u.pass,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as nombres,concat(s.nombres,' ',s.numero) as sucursal,a.accesos,
		u.estado, a.cod codigo_perfil
	    from usuarios u 
		join personas p on u.personas_cod=p.cod 
		join accesos a on u.accesos_cod=a.cod
		join sucursales s on u.sucursales_cod=s.cod
		where u.cod='$codusario' and u.estado='ACTIVO' ";
   $stmt = $mysqli->prepare($sql);
 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {  
		      $idusuarios=$valor['cod'];
		  	  $nombreapellido=utf8_encode($valor['nombres']);
			  $user=utf8_encode($valor['user']);
			  $pass=utf8_encode($valor['pass']);
			  $nivelacceso=utf8_encode($valor['accesos']);
			  $sucursal=utf8_encode($valor['sucursal']);
			  $idcaja=utf8_encode(obtener_cod_cajaabierta($idusuarios));
			  $caja=utf8_encode(obtener_nombre_cajaabierta($idusuarios));
			  $estado=utf8_encode($valor['estado']);  	  
			  $sucursales_cod=utf8_encode($valor['sucursales_cod']); 
			  $codigo_perfil=utf8_encode($valor['codigo_perfil']);  	  
	  }
 }

  $informacion =array("1"=>"exito","2" => $nombreapellido,"3" => $nivelacceso,"4" => $idusuarios,"5" => $sucursal,"6" => $idcaja,"7" => $caja,"8" => $sucursales_cod, "9" => $codigo_perfil);
echo json_encode($informacion);	
exit;


}


 function obtener_cod_cajaabierta($cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= " SELECT c.cod,concat(nombre,' ',nro) as caja, c.montoapertura
 FROM caja c
 join datoscaja d on c.datoscaja_cod=d.cod 
 where c.usuarios_cod='$cod' and  c.estado='ABIERTO'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $analista=$valor['cod'];  
	  }
 }
 return $analista;
}

 function obtener_nombre_cajaabierta($cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= " SELECT c.cod,concat(nombre,' ',nro) as caja, c.montoapertura
 FROM caja c
 join datoscaja d on c.datoscaja_cod=d.cod 
 where c.usuarios_cod='$cod' and  c.estado='ABIERTO'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $analista=$valor['caja'];  
	  }
 }
 return $analista;
}


verificar($funt);
