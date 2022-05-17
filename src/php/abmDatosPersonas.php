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
		
		if($func=='buscar_datos_personales_editar'){
			$cedulac = $_POST['cedulac'];
			$cedulac = utf8_decode($cedulac);
			buscar_datos_personales_editar($cedulac);
		}
		
		if($func=='buscar_clientes'){
			$buscar = $_POST['nombres'];
			$buscar = utf8_decode($buscar);
		 buscar_clientes($buscar);
		}
		
		if($func=='buscarcombo'){		
			buscar_combo();	
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
			
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$primernombre = $_POST['primernombre'];
		$primernombre = ($primernombre);
		
		$segundonombre = $_POST['segundonombre'];
		$segundonombre = ($segundonombre);
		
		$primerapellido = $_POST['primerapellido'];
		$primerapellido = ($primerapellido);
		
		$segundoapellido = $_POST['segundoapellido'];
		$segundoapellido = ($segundoapellido);
		
		$apellidocasada = $_POST['apellidocasada'];
		$apellidocasada = ($apellidocasada);
		
		$cedula = $_POST['cedula'];
		$cedula = utf8_decode($cedula);
		
		$ruc = $_POST['ruc'];
		$ruc = utf8_decode($ruc);
		
		$fechanac = $_POST['fechanac'];
		$fechanac = utf8_decode($fechanac);
		
		$conyuge = $_POST['conyuge'];
		$conyuge = utf8_decode($conyuge);
		
		
		$direccion = $_POST['direccion'];
		$direccion = ($direccion);
		
		$referenciadireccio = $_POST['referenciadireccio'];
		$referenciadireccio = ($referenciadireccio);
		
		$telefono = $_POST['telefono'];
		$telefono = utf8_decode($telefono);
		
		$correo = $_POST['correo'];
		$correo = utf8_decode($correo);
		
		$sexo = $_POST['sexo'];
		$sexo = utf8_decode($sexo);
				
		$viviendapropia = $_POST['viviendapropia'];
		$viviendapropia = utf8_decode($viviendapropia);
			
		$observacion = $_POST['observacion'];
		$observacion = ($observacion);
		
		$lnglat = $_POST['lnglat'];
		$lnglat = utf8_decode($lnglat);
		
		$barrios_cod = $_POST['barrios_cod'];
		$barrios_cod = utf8_decode($barrios_cod);
	
		$nacionalidad_cod = $_POST['nacionalidad_cod'];
		$nacionalidad_cod = utf8_decode($nacionalidad_cod);
	
		$estadosciviles_cod = $_POST['estadosciviles_cod'];
		$estadosciviles_cod = utf8_decode($estadosciviles_cod);
	
		$tipospersonas_cod = $_POST['tipospersonas_cod'];
		$tipospersonas_cod = utf8_decode($tipospersonas_cod);
	
		$profesiones_cod = $_POST['profesiones_cod'];
		$profesiones_cod = utf8_decode($profesiones_cod);
	
		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
	
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
	
		$clavepermisofech = $_POST['clavepermisofech'];
		$clavepermisofech = utf8_decode($clavepermisofech);
	
		mantenimiento($func,$clavepermisofech,$cod,$primernombre,$segundonombre,$primerapellido,$segundoapellido,$apellidocasada
,$cedula,$ruc,$fechanac,$conyuge,$direccion,$referenciadireccio,$telefono,$correo,$sexo,$viviendapropia,
$observacion,$lnglat,$barrios_cod,$nacionalidad_cod,$estadosciviles_cod,$tipospersonas_cod,$profesiones_cod,$usuarios_cod,$hora);
		}
		}	


function mantenimiento($func,$clavepermisofech,$cod,$primernombre,$segundonombre,$primerapellido,$segundoapellido,$apellidocasada
,$cedula,$ruc,$fechanac,$conyuge,$direccion,$referenciadireccio,$telefono,$correo,$sexo,$viviendapropia,
$observacion,$lnglat,$barrios_cod,$nacionalidad_cod,$estadosciviles_cod,$tipospersonas_cod,$profesiones_cod,$usuarios_cod,$hora){
	if($hora=="" || $primernombre=="" || $direccion=="" || $telefono=="" || $lnglat=="" || $tipospersonas_cod=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from personas where cedula=? and estado='ACTIVO' ";
$stmt = $mysqli->prepare($consulta);
$ss='s';
$stmt->bind_param($ss, $cedula); 
if (!$stmt->execute()) {
   echo "Error1";
   exit;
}
$result = $stmt->get_result();
$nro_total=$result->fetch_row();
  $valor=$nro_total[0];

if($valor>=1){
echo "duplicado";	
exit;
}
   $sql="insert into personas (clavepermisofech,primernombre,segundonombre,primerapellido,segundoapellido,apellidocasada,
   cedula,ruc,fechanac,conyuge,direccion,referenciadireccio,telefono,correo,sexo,viviendapropia,observacion,
   lnglat,barrios_cod,nacionalidad_cod,estadosciviles_cod,tipospersonas_cod,profesiones_cod,usuarios_cod, hora, fecha, estado) value (upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='sssssssssssssssssssssssss';
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
   $stmt->bind_param($s,$clavepermisofech,$primernombre,$segundonombre,$primerapellido,$segundoapellido,$apellidocasada
,$cedula,$ruc,$fechanac,$conyuge,$direccion,$referenciadireccio,$telefono,$correo,$sexo,$viviendapropia,
$observacion,$lnglat,$barrios_cod,$nacionalidad_cod,$estadosciviles_cod,$tipospersonas_cod,$profesiones_cod,$usuarios_cod,$hora); 
}

 if($func=='editar'){
	    $sql='update personas set clavepermisofech=upper(?),primernombre=upper(?),segundonombre=upper(?),primerapellido=upper(?),segundoapellido=upper(?),apellidocasada=upper(?),
   cedula=upper(?),ruc=upper(?),fechanac=upper(?),conyuge=upper(?),direccion=upper(?),referenciadireccio=upper(?),telefono=upper(?),correo=upper(?),sexo=upper(?),viviendapropia=upper(?),observacion=upper(?),
   lnglat=upper(?),barrios_cod=upper(?),nacionalidad_cod=upper(?),estadosciviles_cod=upper(?),tipospersonas_cod=upper(?),profesiones_cod=upper(?),usuarios_cod=upper(?),hora=?,fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='sssssssssssssssssssssssssi';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$clavepermisofech,$primernombre,$segundonombre,$primerapellido,$segundoapellido,$apellidocasada
,$cedula,$ruc,$fechanac,$conyuge,$direccion,$referenciadireccio,$telefono,$correo,$sexo,$viviendapropia,
$observacion,$lnglat,$barrios_cod,$nacionalidad_cod,$estadosciviles_cod,$tipospersonas_cod,$profesiones_cod,$usuarios_cod,$hora,$cod); 
	} 
	if($func=='eliminar'){
		
	    $sql="update personas set estado='ELIMINADO' where cod=?";
		
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
	 $sql= "SELECT p.cod, p.primernombre, p.segundonombre, p.primerapellido, p.segundoapellido, p.apellidocasada,
 p.cedula, p.ruc, p.sexo, p.fechanac, p.telefono, p.correo,p.direccion, p.conyuge,p.referenciadireccio,
 p.viviendapropia, p.observacion, p.lnglat, p.barrios_cod,b.barrios,c.ciudades,d.departamentos, p.nacionalidad_cod,n.nacionalidad,
 p.estadosciviles_cod,e.EstadosCivil, p.tipospersonas_cod,t.Tipo, p.profesiones_cod,pr.Profesion, p.usuarios_cod
 , p.fecha, p.hora, p.estado 
 FROM personas p
 join barrios b on p.barrios_cod=b.cod
 join ciudades c on b.ciudades_idciudades=c.idciudades
 join departamentos d on c.departamentos_iddepartamentos=d.iddepartamentos
 join nacionalidad n on p.nacionalidad_cod=n.cod
 join estadosciviles e on p.estadosciviles_cod=e.cod
 join tipospersonas t on p.tipospersonas_cod=t.cod
 join profesiones pr on p.profesiones_cod=pr.cod
 where p.estado=? and concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.cedula,' ',p.ruc) like ? "; 
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
		     
		      $cod=utf8_encode($valor['cod']);  
		  	  $primernombre=($valor['primernombre']);
		  	  $segundonombre=($valor['segundonombre']);
		  	  $primerapellido=($valor['primerapellido']);
		  	  $segundoapellido=($valor['segundoapellido']);
		  	  $apellidocasada=($valor['apellidocasada']);	  
			  $nombres=$primernombre." ".$segundonombre." ".$primerapellido." ".$segundoapellido." ".$apellidocasada;
		  	  $cedula=utf8_encode($valor['cedula']);
		  	  $ruc=utf8_encode($valor['ruc']);
		  	  $sexo=utf8_encode($valor['sexo']);
		  	  $fechanac=utf8_encode($valor['fechanac']);
		  	  $telefono=utf8_encode($valor['telefono']);
		  	  $correo=utf8_encode($valor['correo']);
		  	  $direccion=($valor['direccion']);
		  	  $conyuge=utf8_encode($valor['conyuge']);
		  	  $referenciadireccio=($valor['referenciadireccio']);
		  	  $viviendapropia=utf8_encode($valor['viviendapropia']);
		  	  $observacion=($valor['observacion']);
		  	  $lnglat=utf8_encode($valor['lnglat']);
		  	  $barrios_cod=utf8_encode($valor['barrios_cod']);
		  	  $barrios=($valor['barrios']);
		  	  $ciudades=($valor['ciudades']);
		  	  $departamentos=utf8_encode($valor['departamentos']);
		  	  $nacionalidad_cod=utf8_encode($valor['nacionalidad_cod']);
		  	  $nacionalidad=utf8_encode($valor['nacionalidad']);
		  	  $estadosciviles_cod=utf8_encode($valor['estadosciviles_cod']);
		  	  $EstadosCivil=utf8_encode($valor['EstadosCivil']);
		  	  $tipospersonas_cod=utf8_encode($valor['tipospersonas_cod']);
		  	  $Tipo=utf8_encode($valor['Tipo']);
		  	  $profesiones_cod=utf8_encode($valor['profesiones_cod']);
		  	  $Profesion=($valor['Profesion']);
		  	  $usuarios_cod=utf8_encode($valor['usuarios_cod']);
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
<tr onclick='obtener_datos_datospersonales(this)' ".$bacground." >
<td class='td_detalles' style='width:0%;display:none;' id='td_primernombre'>".$primernombre."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_segundonombre'>".$segundonombre."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_primerapellido'>".$primerapellido."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_segundoapellido'>".$segundoapellido."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_apellidocasada'>".$apellidocasada."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_correo'>".$correo."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_conyuge'>".$conyuge."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_lnglat'>".$lnglat."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_referenciadireccio'>".$referenciadireccio."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_viviendapropia'>".$viviendapropia."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_observacion'>".$observacion."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_barrios_cod'>".$barrios_cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_nacionalidad_cod'>".$nacionalidad_cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_estadosciviles_cod'>".$estadosciviles_cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_tipospersonas_cod'>".$tipospersonas_cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_profesiones_cod'>".$profesiones_cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_Profesion'>".$Profesion."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:6.7%;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:6.7%;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:6.7%;'   id='td_ruc'>".$ruc."</td>
<td class='td_detalles' style='width:6.7%;'   id='td_nombres'>".$nombres."</td>
<td class='td_detalles' style='width:6.7%;'   id='td_sexo'>".$sexo."</td>
<td class='td_detalles' style='width:6.7%;'   id='td_fechanac'>".$fechanac."</td>
<td class='td_detalles' style='width:6.7%;'   id='td_direccion'>".$direccion."</td>
<td class='td_detalles' style='width:6.7%;'   id='td_telefono'>".$telefono."</td>
<td class='td_detalles' style='width:6.7%;'   id='td_barrios'>".$barrios."</td>
<td class='td_detalles' style='width:6.7%;'   id='td_ciudades'>".$ciudades."</td>
<td class='td_detalles' style='width:6.7%;'>
<center>
<a href='https://maps.google.com/?q=".$lnglat."' target='_blank'><button type='button' style='align-items: center;line-height: normal;display: flex;' class='input_atras'><img src='./icono/lotes.png' style='width: 20px;height: 20px; padding: 0px 4px 2px 1px;' /></button></a>
</center>
</td>
<td class='td_detalles' style='width:6.7%;'   id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:6.7%;'   id='td_hora'>".$hora."</td>
<td class='td_detalles' style='width:6.7%;'   id='td_estado'>".$estado."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_clientes($buscar){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT p.cod, concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as clientes,
 p.cedula, p.telefono
 FROM personas p
 join barrios b on p.barrios_cod=b.cod
 join ciudades c on b.ciudades_idciudades=c.idciudades
 join departamentos d on c.departamentos_iddepartamentos=d.iddepartamentos
 join nacionalidad n on p.nacionalidad_cod=n.cod
 join estadosciviles e on p.estadosciviles_cod=e.cod
 join tipospersonas t on p.tipospersonas_cod=t.cod
 join profesiones pr on p.profesiones_cod=pr.cod
 where p.estado='ACTIVO' and concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.cedula,' ',p.ruc) like ? limit 20"; 
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
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		     
		      $cod=$valor['cod'];  
		  	  $clientes=($valor['clientes']);
		  	  $cedula=utf8_encode($valor['cedula']);
		  	  $telefono=utf8_encode($valor['telefono']);
		  
	  	 $cant=$cant+1;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr onclick='obtener_datos_vistaclientes_3(this)' ".$bacground." >
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:20%;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:50%;'   id='td_clientes'>".$clientes."</td>
<td class='td_detalles' style='width:25%;'   id='td_telefono'>".$telefono."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}


function buscar_datos_personales_editar($cedulac){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d"; 
		      $cod=""; 
		  	  $primernombre=""; 
		  	  $segundonombre=""; 
		  	  $primerapellido=""; 
		  	  $segundoapellido=""; 
		  	  $apellidocasada=""; 	  
			  $nombres=""; 
		  	  $cedula=""; 
		  	  $ruc=""; 
		  	  $sexo=""; 
		  	  $fechanac=""; 
		  	  $telefono=""; 
		  	  $correo=""; 
		  	  $direccion=""; 
		  	  $conyuge=""; 
		  	  $referenciadireccio=""; 
		  	  $viviendapropia=""; 
		  	  $observacion=""; 
		  	  $lnglat=""; 
		  	  $barrios_cod=""; 
		  	  $barrios=""; 
		  	  $ciudades=""; 
		  	  $departamentos=""; 
		  	  $nacionalidad_cod=""; 
		  	  $nacionalidad=""; 
		  	  $estadosciviles_cod=""; 
		  	  $EstadosCivil=""; 
		  	  $tipospersonas_cod=""; 
		  	  $Tipo=""; 
		  	  $profesiones_cod=""; 
		  	  $Profesion=""; 
		  	  $usuarios_cod=""; 
			  $fecha=""; 
			  $hora=""; 
			  $estado=""; 
			  
	 $sql= "SELECT p.cod, p.primernombre, p.segundonombre, p.primerapellido, p.segundoapellido, p.apellidocasada,
 p.cedula, p.ruc, p.sexo, p.fechanac, p.telefono, p.correo,p.direccion, p.conyuge,p.referenciadireccio,
 p.viviendapropia, p.observacion, p.lnglat, p.barrios_cod,b.barrios,c.ciudades,d.departamentos, p.nacionalidad_cod,n.nacionalidad,
 p.estadosciviles_cod,e.EstadosCivil, p.tipospersonas_cod,t.Tipo, p.profesiones_cod,pr.Profesion, p.usuarios_cod
 , p.fecha, p.hora, p.estado 
 FROM personas p
 join barrios b on p.barrios_cod=b.cod
 join ciudades c on b.ciudades_idciudades=c.idciudades
 join departamentos d on c.departamentos_iddepartamentos=d.iddepartamentos
 join nacionalidad n on p.nacionalidad_cod=n.cod
 join estadosciviles e on p.estadosciviles_cod=e.cod
 join tipospersonas t on p.tipospersonas_cod=t.cod
 join profesiones pr on p.profesiones_cod=pr.cod
 where p.estado='ACTIVO' and p.cedula=? "; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$cedulac="".$cedulac."";
$stmt->bind_param($s,$cedulac);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		     
		      $cod=$valor['cod'];  
		  	  $primernombre=($valor['primernombre']);
		  	  $segundonombre=($valor['segundonombre']);
		  	  $primerapellido=($valor['primerapellido']);
		  	  $segundoapellido=($valor['segundoapellido']);
		  	  $apellidocasada=utf8_encode($valor['apellidocasada']);	  
			  $nombres=$primernombre." ".$segundonombre." ".$primerapellido." ".$segundoapellido." ".$apellidocasada;
		  	  $cedula=utf8_encode($valor['cedula']);
		  	  $ruc=utf8_encode($valor['ruc']);
		  	  $sexo=utf8_encode($valor['sexo']);
		  	  $fechanac=utf8_encode($valor['fechanac']);
		  	  $telefono=utf8_encode($valor['telefono']);
		  	  $correo=utf8_encode($valor['correo']);
		  	  $direccion=($valor['direccion']);
		  	  $conyuge=utf8_encode($valor['conyuge']);
		  	  $referenciadireccio=($valor['referenciadireccio']);
		  	  $viviendapropia=utf8_encode($valor['viviendapropia']);
		  	  $observacion=($valor['observacion']);
		  	  $lnglat=utf8_encode($valor['lnglat']);
		  	  $barrios_cod=utf8_encode($valor['barrios_cod']);
		  	  $barrios=($valor['barrios']);
		  	  $ciudades=($valor['ciudades']);
		  	  $departamentos=utf8_encode($valor['departamentos']);
		  	  $nacionalidad_cod=utf8_encode($valor['nacionalidad_cod']);
		  	  $nacionalidad=utf8_encode($valor['nacionalidad']);
		  	  $estadosciviles_cod=utf8_encode($valor['estadosciviles_cod']);
		  	  $EstadosCivil=utf8_encode($valor['EstadosCivil']);
		  	  $tipospersonas_cod=utf8_encode($valor['tipospersonas_cod']);
		  	  $Tipo=utf8_encode($valor['Tipo']);
		  	  $profesiones_cod=utf8_encode($valor['profesiones_cod']);
		  	  $Profesion=($valor['Profesion']);
		  	  $usuarios_cod=utf8_encode($valor['usuarios_cod']);
			  $fecha=utf8_encode($valor['fecha']);
			  $hora=utf8_encode($valor['hora']);
			  $estado=utf8_encode($valor['estado']); 
	  	      $cant=$cant+1;
			  
   }
 }
 
$informacion =array("1" => $cod,
                    "2" => $primernombre,
					"3" => $segundonombre,
					"4" => $primerapellido,
					"5" => $segundoapellido,
					"6" => $apellidocasada,
					"7" => $nombres,
					"8" => $cedula,
					"9" => $ruc,
					"10" => $sexo,
					"11" => $fechanac,
					"12" => $telefono,
					"13" => $correo,
					"14" => $direccion,
					"15" => $conyuge,
					"16" => $referenciadireccio,
					"17" => $viviendapropia,
					"18" => $observacion,
					"19" => $lnglat,
					"20" => $barrios_cod,
					"21" => $nacionalidad_cod,
					"22" => $estadosciviles_cod,
					"23" => $tipospersonas_cod,
					"24" => $profesiones_cod,
					"25" => $cant,
					"26" => $barrios,
					"27" => $Profesion
);
echo json_encode($informacion);	
exit;
}

verificar_datos();

?>