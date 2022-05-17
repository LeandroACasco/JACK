<?php
require("conexion.php");
include("subir_foto_base64.php");


function buscar_cajas_habiertas_y_cerrarlas(){
	$mysqli=conectar_al_servidor();
	 $sql= "SELECT cod,montoapertura,estado FROM caja WHERE estado='ABIERTO'"; 
   $stmt = $mysqli->prepare($sql); 
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		  	   $cod=utf8_encode($valor['cod']);
		  	   $montoapertura=utf8_encode($valor['montoapertura']);
		  	   $estado=utf8_encode($valor['estado']);
             
               buscar_montocierre_caja($cod,$montoapertura);  
   }
 }

}


function buscar_montocierre_caja($caja_cod,$montoapertura1){
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
                $saldo=$saldo+($ingreso-$egreso);
	  	 $cant=$cant+1;
         $totalingreso=$totalingreso+$ingreso;
         $totalegreso=$totalegreso+$egreso;
         $saldoactual=$montoapertura+($totalingreso-$totalegreso);
      	 

   }
 }

  if($saldoactual=="0"){
    $sql5="update caja set montocierre='".$montoapertura1."',fechacierre=current_date(),horacierre=current_time(),estado='CERRADO' where cod='".$caja_cod."'";
   $stmt5 = $mysqli->prepare($sql5);
   if (! $stmt5->execute()) {
    echo trigger_error('The query execution failed; MySQL said ('.$stmt5->errno.') '.$stmt5->error, E_USER_ERROR);
    exit;
   } 
}else{
$sql5="update caja set montocierre='".$saldoactual."',fechacierre=current_date(),horacierre=current_time(),estado='CERRADO' where cod='".$caja_cod."'";
   $stmt5 = $mysqli->prepare($sql5);
   if (! $stmt5->execute()) {
    echo trigger_error('The query execution failed; MySQL said ('.$stmt5->errno.') '.$stmt5->error, E_USER_ERROR);
    exit;
   } 
}
echo "exito";
}





buscar_cajas_habiertas_y_cerrarlas();
?>

