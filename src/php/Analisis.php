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
		if($func=='buscar_detalles_analisis'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);	
			buscar_detalles_analisis($cod);	
		}
		if($func=='buscarcombo'){		
			buscar_combo();	
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
			 
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
						
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
			
		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
		
		$promediodia = $_POST['promediodia'];
		$promediodia = utf8_decode($promediodia);
		
		$promediosemana = $_POST['promediosemana'];
		$promediosemana = utf8_decode($promediosemana);
		
		$promedioquincena = $_POST['promedioquincena'];
		$promedioquincena = utf8_decode($promedioquincena);
		
		$promediomes = $_POST['promediomes'];
		$promediomes = utf8_decode($promediomes);
		
		$ingresosextras = $_POST['ingresosextras'];
		$ingresosextras = utf8_decode($ingresosextras);
		
		$alquilercasa = $_POST['alquilercasa'];
		$alquilercasa = utf8_decode($alquilercasa);
		
		$alquilernegocio = $_POST['alquilernegocio'];
		$alquilernegocio = utf8_decode($alquilernegocio);
		
		$cuotabanco = $_POST['cuotabanco'];
		$cuotabanco = utf8_decode($cuotabanco);
		
		$cuotafinanciera = $_POST['cuotafinanciera'];
		$cuotafinanciera = utf8_decode($cuotafinanciera);
		
		$cuotacooperativa = $_POST['cuotacooperativa'];
		$cuotacooperativa = utf8_decode($cuotacooperativa);
		
		$cuotaelectrodomesticos = $_POST['cuotaelectrodomesticos'];
		$cuotaelectrodomesticos = utf8_decode($cuotaelectrodomesticos);
		
		$cuotausureros = $_POST['cuotausureros'];
		$cuotausureros = utf8_decode($cuotausureros);
		
		$canthijos = $_POST['canthijos'];
		$canthijos = utf8_decode($canthijos);
		
		$condicion = $_POST['condicion'];
		$condicion = utf8_decode($condicion);
		
		$montoaprobado = $_POST['montoaprobado'];
		$montoaprobado = utf8_decode($montoaprobado);
		
		$plazo = $_POST['plazo'];
		$plazo = utf8_decode($plazo);
		
		$cuota = $_POST['cuota'];
		$cuota = utf8_decode($cuota);
		
		$obsanalista = $_POST['obsanalista'];
		$obsanalista = utf8_decode($obsanalista);
		
		$solicitudescreditos_cod = $_POST['solicitudescreditos_cod'];
		$solicitudescreditos_cod = utf8_decode($solicitudescreditos_cod);
		
		$descripcionmargen = $_POST['descripcionmargen'];
		$descripcionmargen = utf8_decode($descripcionmargen);
		
		$porcentajemargen = $_POST['porcentajemargen'];
		$porcentajemargen = utf8_decode($porcentajemargen);
		
	
		mantenimiento($func,$cod,$hora,$usuarios_cod,$promediodia,$promediosemana,$promedioquincena,$promediomes,$ingresosextras,
		$alquilercasa,$alquilernegocio,$cuotabanco,$cuotafinanciera,$cuotacooperativa,$cuotaelectrodomesticos,$cuotausureros,$canthijos,
		$condicion,$montoaprobado,$plazo,$cuota,$obsanalista,$solicitudescreditos_cod,$descripcionmargen,$porcentajemargen);
		}
		}	


function mantenimiento($func,$cod,$hora,$usuarios_cod,$promediodia,$promediosemana,$promedioquincena,$promediomes,$ingresosextras,
	$alquilercasa,$alquilernegocio,$cuotabanco,$cuotafinanciera,$cuotacooperativa,$cuotaelectrodomesticos,$cuotausureros,$canthijos,
	$condicion,$montoaprobado,$plazo,$cuota,$obsanalista,$solicitudescreditos_cod,$descripcionmargen,$porcentajemargen){
	if($hora=="" || $promediodia=="" || $promediosemana=="" || $promedioquincena=="" || $promediomes=="" || $ingresosextras=="" || 
	$alquilercasa=="" || $alquilernegocio=="" || $cuotabanco=="" || $cuotafinanciera=="" || $cuotacooperativa=="" || $cuotaelectrodomesticos=="" || $cuotausureros=="" || $canthijos==""
	|| $condicion=="" || $montoaprobado=="" || $plazo=="" || $cuota=="" || $descripcionmargen=="" || $porcentajemargen=="" || $obsanalista=="" || $solicitudescreditos_cod=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from analisis where cod=?  ";
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
   $sql="insert into analisis (usuarios_cod, promediodia, promediosemana, promedioquincena, promediomes, ingresosextras, alquilercasa, alquilernegocio, cuotabanco, cuotafinanciera, cuotacooperativa, cuotaelectrodomesticos, cuotausureros, canthijos, condicion, montoaprobado, plazo, cuota, obsanalista, solicitudescreditos_cod, hora,descripcionmargen,porcentajemargen, fecha, estado) value (upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='sssssssssssssssssssssss';
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
   $stmt->bind_param($s,$usuarios_cod,$promediodia,$promediosemana,$promedioquincena,$promediomes,$ingresosextras,$alquilercasa,$alquilernegocio,$cuotabanco,$cuotafinanciera,$cuotacooperativa,$cuotaelectrodomesticos,$cuotausureros,$canthijos,$condicion,$montoaprobado,$plazo,$cuota,$obsanalista,$solicitudescreditos_cod,$hora,$descripcionmargen,$porcentajemargen); 

  $sql2="update solicitudescreditos set condicionaprobado=upper(?),obsanalista=upper(?),montoaprobado=?, plazoaprobado=?,montocuotaaprobada=?, fechaaprobacion=current_date(), horaaprobacion=?, estadosolicitud='APROBADO',analista_cod=upper(?) where cod=?";
   $s='sssssssi';
   $stmt2 = $mysqli->prepare($sql2);
   echo $mysqli -> error;
   $stmt2->bind_param($s,$condicion,$obsanalista,$montoaprobado,$plazo,$cuota,$hora,$usuarios_cod,$solicitudescreditos_cod);
   
}
   if ( ! $stmt->execute()) {
echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
if ( ! $stmt2->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt2->errno.') '.$stmt2->error, E_USER_ERROR);
   exit;
}
	echo"exito";
}

function buscar_detalles_analisis($cod) {
$mysqli=conectar_al_servidor();
$sql='';
$cant=0;
$sql= "SELECT cod,promediodia, promediosemana, promedioquincena, promediomes, ingresosextras, alquilercasa, alquilernegocio, 
cuotabanco, cuotafinanciera, cuotacooperativa, cuotaelectrodomesticos, cuotausureros, canthijos, condicion, montoaprobado, 
plazo, cuota, obsanalista, descripcionmargen, porcentajemargen 
FROM analisis 
WHERE estado='ACTIVO' and solicitudescreditos_cod='$cod'"; 

$stmt = $mysqli->prepare($sql);
echo $mysqli -> error; 
if ( ! $stmt->execute()) {
	      echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
	   exit;
	}
	 $result = $stmt->get_result();
	 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		    $cod=$valor['cod'];
			$promediodia=utf8_encode($valor['promediodia']);
			$promediosemana=utf8_encode($valor['promediosemana']);
			$promedioquincena=utf8_encode($valor['promedioquincena']);
			$promediomes=utf8_encode($valor['promediomes']);
			$ingresosextras=utf8_encode($valor['ingresosextras']);
			$alquilercasa=utf8_encode($valor['alquilercasa']);	
			$alquilernegocio=utf8_encode($valor['alquilernegocio']);
			$cuotabanco=utf8_encode($valor['cuotabanco']);
			$cuotafinanciera=utf8_encode($valor['cuotafinanciera']);
			$cuotacooperativa=utf8_encode($valor['cuotacooperativa']);
			$cuotaelectrodomesticos=utf8_encode($valor['cuotaelectrodomesticos']);
			$cuotausureros=utf8_encode($valor['cuotausureros']);
			$canthijos=utf8_encode($valor['canthijos']); 
			$condicion=utf8_encode($valor['condicion']); 
			$montoaprobado=utf8_encode($valor['montoaprobado']); 	   
			$plazo=utf8_encode($valor['plazo']);
	        $cuota=utf8_encode($valor['cuota']);			 
	        $obsanalista=utf8_encode($valor['obsanalista']);			 
	        $descripcionmargen=utf8_encode($valor['descripcionmargen']);			 
	        $porcentajemargen=utf8_encode($valor['porcentajemargen']);			 
$cant=$cant+1;
 }
 }
$informacion1 =array("1" => $cod,"2" => $promediodia,"3" => $promediosemana,"4" => $promedioquincena,"5" => $promediomes,
"6" => $ingresosextras,"7" => $alquilercasa,"8" => $alquilernegocio,"9" => $cuotabanco,"10" => $cuotafinanciera,"11" => $cuotacooperativa,
"12" => $cuotaelectrodomesticos,"13" => $cuotausureros,"14" => $canthijos,"15" => $condicion,"16" => $montoaprobado,
"17" => $plazo,"18" => $cuota,"19" => $obsanalista,"20" => $descripcionmargen,"21" => $porcentajemargen);
echo json_encode($informacion1);	
exit;

}



verificar_datos();

?>