<?php
require("conexion.php");

function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
		if($func=='buscar_planilla_caja'){
			$fecha = $_POST['fecha'];
			$fecha = utf8_decode($fecha);
				
			$resumen = $_POST['resumen'];
			$resumen = utf8_decode($resumen);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);	
			$lote = $_POST['lote'];
			$lote = utf8_decode($lote);	
			buscar_planilla_caja($fecha,$resumen,$caja_cod,$lote);
			
		}
        

	
		}	


function buscar_planilla_caja($fecha,$resumen,$caja_cod,$lote){
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
if($resumen=="NO"){
	 $sql= "SELECT cd.fecha,cd.nro,cd.cod,cd.descripcion,cd.ingreso,cd.egreso,cd.estado,concat(cd.caja_cod,' - ',da.nombre,' ',da.nro) as caja,c.montoapertura,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as apertura,c.fecha,c.hora 
FROM cajadiaria cd
join caja c on cd.caja_cod=c.cod
join usuarios u on c.usuarios_cod=u.cod
join personas p on u.personas_cod=p.cod
join datoscaja da on c.datoscaja_cod where cd.estado='ACTIVO' and cd.fecha=? and da.cod=? and c.cod=? "; 
   $stmt = $mysqli->prepare($sql);
  $s='sss';
$fecha="".$fecha."";
$caja_cod="".$caja_cod."";
$lote="".$lote."";
$stmt->bind_param($s,$fecha,$caja_cod,$lote);
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
}
if($resumen=="SI"){
	 $sql= "SELECT cd.origen, cd.tipo,da.cod,cd.fecha,cd.nro,cd.cod,cd.descripcion,sum(cd.ingreso) as ingreso,sum(cd.egreso) as egreso,cd.estado,concat(cd.caja_cod,' - ',da.nombre,' ',da.nro) as caja,c.montoapertura 
FROM cajadiaria cd
join caja c on cd.caja_cod=c.cod
join usuarios u on c.usuarios_cod=u.cod
join personas p on u.personas_cod=p.cod
join datoscaja da on c.datoscaja_cod  where cd.estado='ACTIVO' and cd.fecha=? and da.cod=?  group by case when cd.origen='pago' then cd.tipo else cd.cod end order by cd.cod asc"; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
$fecha="".$fecha."";
$caja_cod="".$caja_cod."";
$stmt->bind_param($s,$fecha,$caja_cod);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		  	    $origen=utf8_encode($valor['origen']);
		  	    $tipo=utf8_encode($valor['tipo']);
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
         $saldoactual=($montoapertura+$totalingreso-$totalegreso);
         if($origen=="PAGO" && $tipo=="INTERES" ){
          $descripcion="Intereses Cobrados del dia";
         }
         if($origen=="PAGO" && $tipo=="COBRO" ){
          $descripcion="Cobranzas del dia ";
         }
         if($origen=="PAGO" && $tipo=="DESCUENTO" ){
          $descripcion="Descuentos del dia ";
         }
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
}

 
$informacion =array("1" => $pagina,"2" => number_format($montoapertura,'0',',','.'),"3" => number_format($totalingreso,'0',',','.'),"4" => number_format($totalegreso,'0',',','.'),"5" => number_format($saldoactual,'0',',','.'));
echo json_encode($informacion);	
exit;
}


verificar_datos();

?>