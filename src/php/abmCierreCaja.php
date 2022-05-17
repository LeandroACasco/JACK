<?php
require("conexion.php");

function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
		if($func=='buscar_caja_actual'){
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);	
			buscar_caja_actual($caja_cod);
		}
		
		if($func=='obtener_montoapertura'){
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);	
			obtener_montoapertura($caja_cod);	
		}
		if($func=='buscar_combo_lote'){
			  $fecha = $_POST['fecha'];
		     $fecha = utf8_decode($fecha);	
			buscar_combo_lote($fecha);	
		}
		
        if($func=='cerrar_caja'){
			$montocierre = $_POST['montocierre'];
			$montocierre = utf8_decode($montocierre);
			$usuarios_cod = $_POST['usuarios_cod'];
			$usuarios_cod = utf8_decode($usuarios_cod);
			$horacierre = $_POST['horacierre'];
			$horacierre = utf8_decode($horacierre);	
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);	
			cerrar_caja($montocierre ,$horacierre,$usuarios_cod,$caja_cod);	
		}
        

	
		}	


function buscar_caja_actual($caja_cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
     $saldo=0;
     $totalingreso=0;
     $totalegreso=0;
     $saldoactual=0;
     $montoapertura=0;
     $c=0;

	 $sql= "SELECT cd.fecha,cd.nro,cd.cod,cd.descripcion,cd.ingreso,cd.egreso,cd.estado,concat(cd.caja_cod,' - ',da.nombre,' ',da.nro) as caja,c.montoapertura,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as apertura,c.fecha,c.hora 
FROM cajadiaria cd
join caja c on cd.caja_cod=c.cod
join usuarios u on c.usuarios_cod=u.cod
join personas p on u.personas_cod=p.cod
join datoscaja da on c.datoscaja_cod where cd.estado='ACTIVO' and c.cod=? "; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$caja_cod="".$caja_cod."";
$stmt->bind_param($s,$caja_cod);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		  	   $montoapertura=utf8_encode($valor['montoapertura']);
		  	   $fecha=utf8_encode($valor['fecha']);
               $datea = date_create($fecha);
                $fecha1= date_format($datea,"d/m/Y");
			    $nro=utf8_encode($valor['nro']);
			    $cod=utf8_encode($valor['cod']);
			    $descripcion=utf8_encode($valor['descripcion']);
			    $ingreso=utf8_encode($valor['ingreso']); 
			    $egreso=utf8_encode($valor['egreso']); 
				if($c==0){
					$saldo=$saldo+$montoapertura+($ingreso-$egreso);
					$c=1;
				}else{
					$saldo=$saldo+($ingreso-$egreso);
				}
                
	  	 $cant=$cant+1;
         $totalingreso=$totalingreso+$ingreso;
         $totalegreso=$totalegreso+$egreso;
         $saldoactual=$montoapertura+($totalingreso-$totalegreso);
if($ingreso==0){
  $ingreso="";
}else{
  $ingreso=$ingreso;
  $ingreso=number_format($ingreso,'0',',','.');
}
if($egreso==0){
  $egreso="";
}else{
  $egreso=$egreso;
  $egreso=number_format($egreso,'0',',','.');
}

		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr  ".$bacground.">
<td class='td_detalles' style='width:12.5%;' >".$fecha1."</td>
<td class='td_detalles' style='width:12.5%;' >".$nro."</td>
<td class='td_detalles' style='width:10%;' >".$cod."</td>
<td class='td_detalles' style='width:35%;' >".$descripcion."</td>
<td class='td_detalles' style='width:10%;' >".$ingreso."</td>
<td class='td_detalles' style='width:10%;' >".$egreso."</td>
<td class='td_detalles' style='width:10%;' >".number_format($saldo,'0',',','.')." Gs.</td>
</tr>
";		  
   }
 }

$informacion =array("1" => $pagina,"2" => number_format($montoapertura,'0',',','.'),"3" => number_format($totalingreso,'0',',','.'),"4" => number_format($totalegreso,'0',',','.'),"5" => number_format($saldoactual,'0',',','.'),"6" => $cant);
echo json_encode($informacion);	
exit;
}


   function obtener_cierrecaja($caja_cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "SELECT ifnull(montoapertura,0) as apertura FROM caja cod='".$caja_cod."'";
   if ($stmt = $mysqli->prepare($sql)) 
	   echo $mysqli -> error;
   if ( ! $stmt->execute()) {
   echo "Error";
   exit;
  }
  $result = $stmt->get_result();
  $valor= mysqli_num_rows($result);
  if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $analista=$valor['apertura'];  
	  }
  }
   return $analista;
  }
  
  
   function obtener_montoapertura($caja_cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "SELECT ifnull(montoapertura,0) as apertura FROM caja where cod='".$caja_cod."'";
   if ($stmt = $mysqli->prepare($sql)) 
	   echo $mysqli -> error;
   if ( ! $stmt->execute()) {
    echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
  }
  $result = $stmt->get_result();
  $valor= mysqli_num_rows($result);
  if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $analista=$valor['apertura'];  
	  }
  }
   $informacion =array("1" => number_format($analista,'0',',','.'));
echo json_encode($informacion);	
exit;
  }
  
  function cerrar_caja($montocierre ,$horacierre,$usuarios_cod,$caja_cod){
     $mysqli=conectar_al_servidor();
	if($montocierre=="" || $horacierre==""  || $usuarios_cod=="" || $caja_cod==""  ){
    echo "camposvacio";	
    exit;
	}
	 $sql='update caja set fechacierre=current_date(), montocierre=upper(?), horacierre=upper(?),usuarios_cod_cierre=?,estado="CERRADO" where cod=?';
	$s='sssi';
	$stmt = $mysqli->prepare($sql);
	echo $mysqli -> error;
      $stmt->bind_param($s,$montocierre,$horacierre ,$usuarios_cod ,$caja_cod); 
	
   if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
	echo"exito";
}


function buscar_combo_lote($fecha){
	 $mysqli=conectar_al_servidor();
	 $pagina='';
	 $sql= "SELECT cod FROM caja WHERE fecha='".$fecha."'"; 
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
		  	  
              $pagina.="<option value ='".$cod."'>".$cod."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}

verificar_datos();

?>