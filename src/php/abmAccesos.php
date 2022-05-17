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

		if($func=='obtenerFunciones'){
			$buscar = $_POST['buscar'];
			$html = $_POST['html'];
			obtenerFunciones($buscar, $html);
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
			
			
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$accesos = $_POST['accesos'];
		$accesos = utf8_decode($accesos);
						
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);

		$funciones = $_POST['funciones'];
		
		mantenimiento($func,$cod,$accesos,$hora, $funciones);
		}
		}	


function mantenimiento($func,$cod,$accesos,$hora, $funciones){
	if($hora=="" || $accesos=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
	$consulta= "Select count(*) from accesos where cod=?  ";
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
   $sql="insert into accesos (accesos, hora, fecha, estado) value (upper(?),upper(?),current_date(),'ACTIVO')";
   $s='ss';
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
   $stmt->bind_param($s,$accesos,$hora); 
}else if($func=='editar'){
	    $sql='update accesos set accesos=upper(?),hora=?,fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='ssi';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$accesos,$hora,$cod); 
	} else if($func=='eliminar'){
		
	    $sql="update accesos set estado='ELIMINADO' where cod=?";
		
		$s='i';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$cod); 
	}
   if ( ! $stmt->execute()) {
	echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}else{
	if($func=='editar'){
		$funciones = explode(",", $funciones);
		foreach($funciones as $line){
			$f = explode(":", $line);
			$consulta = "UPDATE accesos_funciones SET activo=? WHERE accesos_cod=? AND funciones_cod=?";
			$stmt = $mysqli->prepare($consulta);
			$activo = $f[1]=='true' ? 1 : 0;
			$stmt->bind_param('iii', $activo, $cod, $f[0]);

			if ( ! $stmt->execute()) {
				echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
				exit;
			}
		}
	}
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
	 $sql= "SELECT cod, accesos, fecha, hora, estado FROM accesos
 where estado=? and accesos like ? "; 
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
		  	  $accesos=utf8_encode($valor['accesos']);
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
<tr onclick='obtener_datos_accesos(this)' ".$bacground.">
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:19%;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:19%;' id='td_accesos'>".$accesos."</td>
<td class='td_detalles' style='width:19%;'   id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:19%;'   id='td_hora'>".$hora."</td>
<td class='td_detalles' style='width:19%;'   id='td_estado'>".$estado."</td>
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
	 $sql= "Select cod,accesos from accesos where estado='ACTIVO'"; 
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
		  	  $ciudades=utf8_encode($valor['accesos']);
              $pagina.="<option value ='".$idciudades."'>".$ciudades."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);
exit;
}

function obtenerFunciones($buscar, $html){
		$mysqli=conectar_al_servidor();
		 $pagina='';
		 $sql= "select af.*, f.objeto, f.titulo
		 from accesos_funciones af
			 join funciones f on f.cod = af.funciones_cod
		 where af.accesos_cod = ? "; 
	   $stmt = $mysqli->prepare($sql);
	  $s='s';
	$stmt->bind_param($s,$buscar);
	if ( ! $stmt->execute()) {
	   echo "Error3";
	   exit;
	}
	
	$result = $stmt->get_result();
	$valor= mysqli_num_rows($result);

	$arr = [];

	if ($valor>0)
	{
		while ($valor= mysqli_fetch_assoc($result)) {
				
			$cod = $valor['funciones_cod'];
			$titulo = utf8_encode($valor['titulo']);
			$objeto = utf8_encode($valor['objeto']);
			$activo = $valor['activo'];

			$checked = $activo==1 ? 'checked' : '';

			$pagina.=" 
			<tr>
			<td class='td_detalles' style='width:50%;' id='td_cod'>".$titulo."</td>
			<td class='td_detalles' style='width:50%;' id='td_estado'>
				<input type='checkbox' id='array_accesos' name='array_accesos[]' value='".$cod."' ".$checked.">
			</td>
			</tr>
			";
			$arr[] = [$objeto, $activo];
		}
	}

	if($html==1){
		$result = $pagina;
	}else if($html==2){
		$result = $arr;
	}

	$informacion = array("1" => "exito", "2" => $result);
	echo json_encode($informacion);
	exit;
}


verificar_datos();

?>