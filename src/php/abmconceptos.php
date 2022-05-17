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
		if($func=='buscar_conceptos'){
			$buscar = $_POST['buscar'];
			$buscar = utf8_decode($buscar);
			buscar_conceptos($buscar);
		}
  
		if($func=='seleccionar_concepto'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			$lista = $_POST['lista'];
			$lista = utf8_decode($lista);
			seleccionar_concepto($cod,$lista);
		}

		if($func=='buscar_conceptos_vista_compras'){
			$buscar = $_POST['buscar'];
			$buscar = utf8_decode($buscar);
			
			buscar_conceptos_vista_compras($buscar);
			
		}
		if($func=='buscarcombo'){		
			buscar_combo();	
		}
		
		if($func=='buscar_combo_concepto'){		
			buscar_combo_concepto();	
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
			
			
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$conceptos = $_POST['conceptos'];
		$conceptos = utf8_decode($conceptos);
						
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
			
		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
		
		mantenimiento($func,$cod,$conceptos,$usuarios_cod,$hora);
		}
		}	


function mantenimiento($func,$cod,$conceptos,$usuarios_cod,$hora){
	if($hora=="" || $conceptos=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from conceptos where cod=?  ";
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
   $sql="insert into conceptos (nombres,usuarios_cod, hora, fecha, estado) value (upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='sss';
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
   $stmt->bind_param($s,$conceptos,$usuarios_cod,$hora); 
}else if($func=='editar'){
	    $sql='update conceptos set nombres=upper(?),usuarios_cod=upper(?),hora=?,fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='sssi';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$conceptos,$usuarios_cod,$hora,$cod); 
	} else if($func=='eliminar'){
		
	    $sql="update conceptos set estado='ELIMINADO' where cod=?";
		
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
	 $sql= "SELECT cod, nombres, fecha, hora, estado FROM conceptos
 where estado=? and nombres like ? "; 
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
		  	  $conceptos=utf8_encode($valor['nombres']);
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
<tr onclick='obtener_datos_conceptos(this)' ".$bacground.">
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:19%;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:19%;' id='td_conceptos'>".$conceptos."</td>
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
	
function buscar_conceptos($buscar){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT cod, nombres FROM conceptos
 where estado='ACTIVO' and nombres like ? "; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$buscar="%".$buscar."%";
$stmt->bind_param($s,$buscar);
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
		  	  $conceptos=utf8_encode($valor['nombres']);
			
	  	 $cant=$cant+1;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr onclick='obtener_datos_vistaconceptos_3(this)' ".$bacground.">
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:95%;' id='td_conceptos'>".$conceptos."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_conceptos_vista_compras($buscar){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT cod,concat(cod,' ',nombres) as esta_en_lista, nombres FROM conceptos
 where estado='ACTIVO' and concat(cod,' ',nombres) like ? "; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$buscar="%".$buscar."%";
$stmt->bind_param($s,$buscar);
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
		  	  $conceptos=utf8_encode($valor['nombres']);
			 $esta_en_lista=utf8_encode($valor['esta_en_lista']); 
			  if($esta_en_lista=="SI"){
				  $colorX='#00c621';
			  }
              if($esta_en_lista!="SI"){
				  $colorX='#e7e7e7';
			  }
	  	 $cant=$cant+1;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
		  $accion='seleccionar_conceptos_compras("'.$cod.'","'.$conceptos.'")'; 
$pagina.=" 
<tr onclick='".$accion."' ".$bacground.">
<td class='td_detalles' style='width:15%;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:85%;' id='td_conceptos'>".$conceptos."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function seleccionar_concepto($cod,$lista){
    $mysqli=conectar_al_servidor();
  $sql="update conceptos set esta_en_lista='".$lista."' where cod='".$cod."'";
  $stmt = $mysqli->prepare($sql);   
  if ( ! $stmt->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
   }
		echo"exito";
}

function buscar_combo(){
	 $mysqli=conectar_al_servidor();
	 $pagina='<option value ="">SELECCIONAR</option>';
	 $sql= "Select cod,conceptos from conceptos where estado='ACTIVO'"; 
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
		  	  $ciudades=utf8_encode($valor['conceptos']);
              $pagina.="<option value ='".$idciudades."'>".$ciudades."</option>";	  
	  }
 }
$informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}


function buscar_combo_concepto(){
	 $mysqli=conectar_al_servidor();
	 $pagina='<option value ="TODOS">TODOS</option>';
	 $sql= "Select cod,nombres as concepto from conceptos where estado='ACTIVO'"; 
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
		  	  $ciudades=utf8_encode($valor['concepto']);
              $pagina.="<option value ='".$idciudades."'>".$ciudades."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}

verificar_datos();

?>