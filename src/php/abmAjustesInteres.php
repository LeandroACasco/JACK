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

		if($func=='obtener_tasaanual_interespormora'){	
           	
			obtener_tasaanual_interespormora();	
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
			
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
	
		
        $tasaanual = $_POST['tasaanual'];
		$tasaanual = utf8_decode($tasaanual);
        
		$vtomensual = $_POST['vtomensual'];
		$vtomensual = utf8_decode($vtomensual);
        
		$vtoquincenal = $_POST['vtoquincenal'];
		$vtoquincenal = utf8_decode($vtoquincenal);
		
		$vtosemanal = $_POST['vtosemanal'];
		$vtosemanal = utf8_decode($vtosemanal);
		
		$vtodiario = $_POST['vtodiario'];
		$vtodiario = utf8_decode($vtodiario);
       
		$interespormora = $_POST['interespormora'];
		$interespormora = utf8_decode($interespormora);
		
		$diasdegracia = $_POST['diasdegracia'];
		$diasdegracia = utf8_decode($diasdegracia);

		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
						
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
		
		mantenimiento($func,$cod,$tasaanual,$vtomensual, $vtoquincenal, $vtosemanal,$vtodiario ,$interespormora,$diasdegracia,$usuarios_cod,$hora);
		

		}	
		}	


    function mantenimiento($func,$cod,$tasaanual,$vtomensual, $vtoquincenal, $vtosemanal,$vtodiario,$interespormora,$diasdegracia,$usuarios_cod,$hora){
	if($hora=="" || $vtomensual=="" || $vtoquincenal=="" || $vtosemanal=="" || $vtodiario==""  || $interespormora==""   || $tasaanual=="" || $diasdegracia=="" ||  $usuarios_cod==""  || $hora=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
	if($func=='guardar'){
		$consulta= "Select count(*) from ajustesinteres where cod=?";
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

		if($valor>=1){
		echo "duplicado";	
		exit;
		}
		   $sql="insert into ajustesinteres (vtomensual,vtoquincenal,vtosemanal,vtodiario,tasaanual, interespormora,diasdegracia, usuarios_cod, hora, fecha, estado) value (?,?,?,?,?,?,?,?,?,current_date(),'ACTIVO')";
		   $s='sssssssss';
		   $stmt = $mysqli->prepare($sql);
		   echo $mysqli -> error;
		   $stmt->bind_param($s,$vtomensual,$vtoquincenal,$vtosemanal,$vtodiario,$tasaanual,$interespormora,$diasdegracia,$usuarios_cod,$hora); 
	}
    if($func=='editar'){
	    $sql='update ajustesinteres set vtomensual=upper(?),vtoquincenal=upper(?),vtosemanal=upper(?), vtodiario=upper(?), tasaanual=upper(?), interespormora=upper(?),diasdegracia=upper(?), usuarios_cod=upper(?),hora=upper(?),fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='sssssssssi';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$vtomensual,$vtoquincenal,$vtosemanal,$vtodiario,$tasaanual,$interespormora,$diasdegracia,$usuarios_cod,$hora,$cod); 
	} 

	if($func=='eliminar'){
		
	    $sql="update ajustesinteres set estado='ELIMINADO' where cod=?";
		
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
	 $sql= "SELECT cod,vtomensual,vtoquincenal,vtosemanal,vtodiario,tasaanual, interespormora,diasdegracia,fecha, hora, estado FROM ajustesinteres
 where estado=? and vtomensual like ? "; 
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
		  	    $vtomensual=utf8_encode($valor['vtomensual']);
		  	    $vtoquincenal=utf8_encode($valor['vtoquincenal']);
		  	    $vtosemanal=utf8_encode($valor['vtosemanal']);
		  	    $vtodiario=utf8_encode($valor['vtodiario']);
		  	    $tasaanual=utf8_encode($valor['tasaanual']);
			    $interespormora=utf8_encode($valor['interespormora']);
				$intdia=intVal($interespormora)/30;
			    $diasdegracia=utf8_encode($valor['diasdegracia']);
			    $estado=utf8_encode($valor['estado']); 
	  	 $cant=$cant+1;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr onclick='obtener_datos_ajustesinteres(this)' ".$bacground.">
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:10.5%;'   id='td_interespormora'>".$interespormora."</td>
<td class='td_detalles' style='width:10.5%;'   id='td_intdia'>".$intdia."</td>
<td class='td_detalles' style='width:10.5%;'   id='td_tasaanual'>".$tasaanual."</td>
<td class='td_detalles' style='width:10.5%;'   id='td_diasdegracia'>".$diasdegracia."</td>
<td class='td_detalles' style='width:10.5%;'   id='td_vtomensual'>".$vtomensual."</td>
<td class='td_detalles' style='width:10.5%;'   id='td_vtoquincenal'>".$vtoquincenal."</td>
<td class='td_detalles' style='width:10.5%;'   id='td_vtosemanal'>".$vtosemanal."</td>
<td class='td_detalles' style='width:10.5%;'   id='td_vtodiario'>".$vtodiario."</td>
<td class='td_detalles' style='width:10.5%;'   id='td_estado'>".$estado."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

	
function obtener_tasaanual_interespormora(){
	$mysqli=conectar_al_servidor();
	 $sql= "SELECT tasaanual,interespormora,diasdegracia,vtomensual,vtoquincenal,vtosemanal,vtodiario FROM ajustesinteres where estado='ACTIVO'"; 
  $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
 echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {    
		$tasaanual=$valor['tasaanual']; 
		$diasdegracia=$valor['diasdegracia']; 
		$vtomensual=$valor['vtomensual']; 
		$vtoquincenal=$valor['vtoquincenal']; 
		$vtosemanal=$valor['vtosemanal']; 
		$vtodiario=$valor['vtodiario']; 
		$interespormora=$valor['interespormora']; 
        $intdia=intVal($interespormora)/30;
   }
 }
$informacion =array("1" => $tasaanual,"2" => $intdia,"3" => $diasdegracia,"4" => $vtomensual,"5" => $vtoquincenal,"6" => $vtosemanal,"7" => $vtodiario);
echo json_encode($informacion);	
exit;
}


verificar_datos();

?>