<?php
require("conexion.php");

function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
		
		if($func=='buscar_detalles_cuoteros_Clientes'){
			$ventas_cod = $_POST['ventas_cod'];
			$ventas_cod = utf8_decode($ventas_cod);	
			buscar_detalles_cuoteros_Clientes($ventas_cod);	
		}
		if($func=='buscar_cantidad_cuota_a_pagar_clientes'){
			$ventas_cod = $_POST['ventas_cod'];
			$ventas_cod = utf8_decode($ventas_cod);	

            $limit = $_POST['limit'];
			$limit = utf8_decode($limit);	
		buscar_cantidad_cuota_a_pagar_clientes($ventas_cod,$limit);	
		}
		if($func=='cargarpagos'){
			$montopagado = $_POST['montopagado'];
			$montopagado = utf8_decode($montopagado);	

			$fechapago = $_POST['fechapago'];
			$fechapago = utf8_decode($fechapago);	

            $ventas_cod = $_POST['ventas_cod'];
			$ventas_cod = utf8_decode($ventas_cod);	

            $caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);	

            $nrocomprobante = $_POST['nrocomprobante'];
			$nrocomprobante = utf8_decode($nrocomprobante);

            $sucursales_cod = $_POST['sucursales_cod'];
			$sucursales_cod = utf8_decode($sucursales_cod);	

            $usuarios_cod = $_POST['usuarios_cod'];
			$usuarios_cod = utf8_decode($usuarios_cod);	

            $hora = $_POST['hora'];
			$hora = utf8_decode($hora);	
		    cargarpagos($montopagado,$fechapago, $ventas_cod,$caja_cod,$nrocomprobante,$sucursales_cod,$usuarios_cod,$hora);	
		}	
        if($func=='anular_pagos'){
	
            $nrocomprobante = $_POST['nrocomprobante'];
			$nrocomprobante = utf8_decode($nrocomprobante);	

            $clavepermisoanulacion = $_POST['clavepermisoanulacion'];
			$clavepermisoanulacion = utf8_decode($clavepermisoanulacion);	
		    anular_pagos($nrocomprobante,$clavepermisoanulacion);	
		}
		if($func=='buscar_historial_cobros_cuotas_clientes'){
            $nrofactura = $_POST['nrofactura'];
			$nrofactura = utf8_decode($nrofactura);
		    buscar_historial_cobros_cuotas_clientes($nrofactura);	
		}
		if($func=='buscar_mas_detalles_historial_cobros_cuotas_clientes'){
            $nrofactura = $_POST['nrofactura'];
			$nrofactura = utf8_decode($nrofactura);
            $nrorecibo = $_POST['nrorecibo'];
			$nrorecibo = utf8_decode($nrorecibo);
		   buscar_mas_detalles_historial_cobros_cuotas_clientes($nrofactura,$nrorecibo);	
		}

		}	

function buscar_historial_cobros_cuotas_clientes($nrofactura){	
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $cant=0;

		$sql= "SELECT c.cod,c.nrocomprobante,c.fecha,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as cliente,sum(ifnull(c.monto,'0')) as monto,sum(ifnull(c.descuento,'0')) as descuento,case when v.moneda='Guaranies' then 'Gs.' when v.moneda='Dolares' then '$.' END as Mn
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod where v.nrofactura=? and c.estado='PAGADO' group by c.nrocomprobante";
$stmt = $mysqli->prepare($sql);
  echo $mysqli -> error; 
$s='s';
$nrofactura="".$nrofactura."";
$stmt->bind_param($s,$nrofactura);
if(!$stmt->execute()){
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {	 
 	          $nrocomprobante=utf8_encode($valor['nrocomprobante']);
 	          $cod=utf8_encode($valor['cod']);
 	          $cliente=utf8_encode($valor['cliente']);
 	          $monto=utf8_encode($valor['monto']);
 	          $descuento=utf8_encode($valor['descuento']);
 	          $fecha=utf8_encode($valor['fecha']);
 	          $Mn=utf8_encode($valor['Mn']);
             $datea = date_create($fecha);
            $fep= date_format($datea,"d/m/Y");
      $cant=$cant+1;
  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
		$onclick1='abrir_cerrar_ventanas_detalles_historialpago_cuotas_clientes("1","'.$nrofactura.'","'.$nrocomprobante.'")';
		$onclick2='cargarreporterecibo("'.$nrocomprobante.'","'.$monto.'")';
		$accion2='ver_vetana_permiso(id_progreso,"3","","'.$nrocomprobante.'")';
  $pagina.="
<tr ".$bacground." style='cursor: default;'> 
<td id='td_cod' class='td_detalles' style='width:0%;background-color: #efeded;display:none'>".$cod."</td>
<td id='td_nrocomprobante' class='td_detalles' style='width:10%;text-align:center;'>".$nrocomprobante."</td>
<td id='td_fecha' class='td_detalles'  style='width:10%;text-align:center;'>".$fep."</td>
<td id='td_cliente'  class='td_detalles' style='width:40%;text-align:left;'>".$cliente."</td>
<td id='td_monto'  class='td_detalles' style='width:10%;text-align:center;'>".number_format($monto,'0',',','.')."</td>
<td id='td_descuento'  class='td_detalles' style='width:10%;text-align:center;'>".number_format($descuento,'0',',','.')."</td>
<td id='td_Mn'  class='td_detalles' style='width:5%;text-align:center;'>".$Mn."</td>
<td class='td_detalles' style='width:5%;text-align:center;'>
<center><button type='button' onclick='".$onclick1."' class='input_atras' style='height: 33px;width: 33px;box-shadow: inset 0px -1px 2px 0px #afafaf;background: var(--colorbotonphoto);'><img src='./icono/ver.png' style='width:24px;height:24px;'></button></center>
</td>
<td class='td_detalles' style='width:5%;text-align:center;'>
<center><button type='button' onclick='".$onclick2."' class='input_atras' style='height: 33px;width: 33px;box-shadow: inset 0px -1px 2px 0px #afafaf; background: var(--colorcabezera);'><img src='./icono/Print_24x24.png' style='width:23px;height:23px;'></button></center>
</td>
<td class='td_detalles' style='width:5%;text-align:center;'>
<center><button type='button' onclick='".$accion2."' class='input_atras' style='height: 33px;width: 33px;box-shadow: inset 0px -1px 2px 0px #afafaf;background: var(--colorbotoneliminar);'><img src='./icono/delete.png' style='width:20px;height:20px;'></button></center>
</td>
</tr>
";
   }
 }
 
$informacion =array("1" => "exito","2" => $pagina,"3" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_mas_detalles_historial_cobros_cuotas_clientes($nrofactura,$nrorecibo){	
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $cant=0;
	 $tmonto=0;
	 $tinteres=0;
	 $tdescuento=0;

		$sql= "SELECT c.ventas_cod,concat(s.nombres,' ',s.numero) as sucursal,concat(d.nombre,' ',d.nro) as caja,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as usuario,cu.plazo as cuota,ifnull(c.monto,'0')-cu.totalinteres as monto,cu.totalinteres,ifnull(c.descuento,'0') as descuento,ifnull(c.monto,'0') as montointeres,case when v.moneda='Guaranies' then 'Gs.' when v.moneda='Dolares' then '$.' END as Mn,c.fecha,c.hora
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join usuarios u on c.usuarios_cod=u.cod
join personas p on u.personas_cod=p.cod
join cuoteros cu on cu.cod=c.cuoteros_cod
join caja ca on c.caja_cod=ca.cod
join datoscaja d on ca.datoscaja_cod=d.cod
join sucursales s on d.sucursales_cod=s.cod
 where v.nrofactura='".$nrofactura."' and c.nrocomprobante='".$nrorecibo."'";
$stmt = $mysqli->prepare($sql);
  echo $mysqli -> error; 
if(!$stmt->execute()){
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {	 
 	          $ventas_cod=utf8_encode($valor['ventas_cod']);
              $cuotac=obtener_cantidad_cuota($ventas_cod);
 	          $sucursal=utf8_encode($valor['sucursal']);
 	          $caja=utf8_encode($valor['caja']);
 	          $usuarios=utf8_encode($valor['usuario']);
 	          $cuota=utf8_encode($valor['cuota']);
 	          $monto=utf8_encode($valor['monto']);
 	          $totalinteres=utf8_encode($valor['totalinteres']);
 	          $descuento=utf8_encode($valor['descuento']);
 	          $montointeres=utf8_encode($valor['montointeres']);
 	          $fecha=utf8_encode($valor['fecha']);
 	          $hora=utf8_encode($valor['hora']);
 	          $Mn=utf8_encode($valor['Mn']);
              $datea = date_create($fecha);
              $fep= date_format($datea,"d/m/Y");
              $cant=$cant+1;
              $tmonto=$tmonto+$monto;
              $tinteres=$tinteres+$totalinteres;
             $tdescuento=$tdescuento+$descuento;
  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
  $pagina.="
<tr ".$bacground." style='cursor: default;'> 
<td id='td_cuota' class='td_detalles' style='width:20%;text-align:center;'>".$cuota."/".$cuotac."</td>
<td id='td_monto'  class='td_detalles' style='width:20%;text-align:center;'>".number_format($monto,'0',',','.')."</td>
<td id='td_totalinteres'  class='td_detalles' style='width:20%;text-align:center;'>".number_format($totalinteres,'0',',','.')."</td>
<td id='td_descuento'  class='td_detalles' style='width:20%;text-align:center;'>".number_format($descuento,'0',',','.')."</td>
<td id='td_Mn'  class='td_detalles' style='width:20%;text-align:center;'>".$Mn."</td>
</tr>
";
   }
 }
 
$informacion =array("1" => "exito","2" => $pagina,"3" => $cant,"4" => $fep,"5" => $hora,"6" => $sucursal,"7" => $caja,"8" => $usuarios,"9" => number_format($tmonto,'0',',','.'),"10" => number_format($tinteres,'0',',','.'),"11" => number_format($tdescuento,'0',',','.'));
echo json_encode($informacion);	
exit;
}

function buscar_cantidad_cuota_a_pagar_clientes($ventas_cod,$limit){	
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $cant=0;
	 $totalapagar=0;
	 $totdescuento=0;
	 $totalMonto=0;
	 $totalInter=0;
	 $is=0;
		$sql= "Select v.clientes_cod,v.cobrador_cod,concat(p2.primernombre,' ',p2.segundonombre,' ',p2.primerapellido,' ',p2.segundoapellido,' ',p2.apellidocasada) as cobrador,p1.cod as personas_cod,v.fechaventa,v.nrofactura,p1.cedula,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as Cliente,p1.direccion,p1.telefono, 
c.cod, c.cuota as monto,ifnull((SELECT sum(p.monto) from cobroscuotasclientes p where p.estado='PAGADO' and  p.cuoteros_cod=c.cod),0) as totalpagado,
ifnull((SELECT sum(p2.descuento) from cobroscuotasclientes p2 where p2.estado='PAGADO' and  p2.cuoteros_cod=c.cod),0) as totaldescuento,
 c.plazo,ifnull(c.descuento,'0') as descuentos, c.interes, c.fechaapagar,date_format(c.fechaapagar, '%m') as mes,date_format(current_date(), '%m') as meshoy
,date_format(c.fechaapagar, '%Y') as ano,date_format(current_date(), '%Y') as anohoy,date_format(c.fechaapagar, '%d') as dia,
 c.totalinteres, c.estado, c.ventas_cod,c.diasdegracia 
from cuoteros c
join ventas v on c.ventas_cod=v.cod 
join personas p1 on v.clientes_cod=p1.cod
join usuarios u on v.cobrador_cod=u.cod
join personas p2 on u.personas_cod=p2.cod
where c.ventas_cod=? and c.estado='PENDIENTE' limit ".$limit."";
$stmt = $mysqli->prepare($sql);
  echo $mysqli -> error; 
$s='s';
$ventas_cod="".$ventas_cod."";
$stmt->bind_param($s,$ventas_cod);
if(!$stmt->execute()){
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {	 
 	      $clientes_cod=utf8_encode($valor['personas_cod']);
 	      $fechaventa=utf8_encode($valor['fechaventa']);
 	      $nrofactura=utf8_encode($valor['nrofactura']);
		      $clientes_cedula=utf8_encode($valor['cedula']);
			  $nombres=utf8_encode($valor['Cliente']);
			  $direccion=utf8_encode($valor['direccion']);
			  $telefono=utf8_encode($valor['telefono']);
			  $cod_Cuotero=$valor['cod'];
		  	  $Monto=utf8_encode($valor['monto']);
              $plazo=utf8_encode($valor['plazo']);
              $cobrador_cod=utf8_encode($valor['cobrador_cod']);
              $cobrador=utf8_encode($valor['cobrador']);
			  $mes=utf8_encode($valor['mes']);
			   $meshoy=utf8_encode($valor['meshoy']);
			   $diasdegracia=utf8_encode($valor['diasdegracia']);
			   
			    $año=utf8_encode($valor['ano']);
			    $añohoy=utf8_encode($valor['anohoy']);
			    $dia=utf8_encode($valor['dia']);
			   $cantcuota=0;
			   $cantcuota=utf8_encode(obtener_cantidad_cuota($ventas_cod));
              $interes=utf8_encode($valor['interes']);
              $fecha_pagar=utf8_encode($valor['fechaapagar']);
$datea = date_create($fecha_pagar);
$fep= date_format($datea,"d/m/Y");
              $estado=utf8_encode($valor['estado']);
              $cod_ventaFK=utf8_encode($valor['ventas_cod']);
              $monto_pagado=utf8_encode($valor['totalpagado']);
              $totaldescuento=utf8_encode($valor['totaldescuento']);
              $descuentos=utf8_encode($valor['descuentos']);
              $total=$Monto-($monto_pagado+$descuentos);
			  $total_interes=utf8_encode($valor['totalinteres']);
			  $diff=0;
			  $colorestado="";
			  $colorestadotexto="";
			  $puratorio=1;
			 $fechahoy=date('Y-m-d');
$total_interes=0;
$total_interes_actual=0;
$fechainicial = new DateTime($fecha_pagar);
$fechafinal = new DateTime($fechahoy);
$diferencia = $fechainicial->diff($fechafinal);

$meses=0;	
$meses1=0;	
	 $total_interes1=0; 	
	 $total_numero=0; 

$resultd=0;	 
    if($total>0 || $total<0){	
            if($fechainicial>$fechafinal){
				$meses=0;
				$meses1=0;
			}else{
				$dd= $diferencia->days;
                /* $meses=intval($dd)-intval($diasdegracia); */
                $meses=intval($dd);
                $meses1=intval($dd);
			}			  
			if($meses>0){
			  if($interes!=0){
			  $interes_moratorio=($interes * ($Monto))/100;
			  
			  $total_interes_general=$interes_moratorio ;
			  $total_interes=($total_interes_general*$meses);
                      
			       $numeros_sp=$total_interes;
			 	$totint_1_con_puntos=number_format($numeros_sp,'0',',','.');		  
			  if((intVal($numeros_sp)>=1) && (intVal($numeros_sp)<=500)){
			  $total_numero=500;
			  } else if((intVal($numeros_sp)>=501) && (intVal($numeros_sp)<=999)){
			   $total_numero=1000;
			  } else if(intVal($numeros_sp)>=1000 && intVal($numeros_sp)<=999999){
					 $datosconpuntos=explode('.',$totint_1_con_puntos,2);
                    	
                     $dap=$datosconpuntos[0];
                      $ddp=$datosconpuntos[1];
					  if(intVal($ddp)>=0 && intVal($ddp)<=500){
						 $resultd=500;
					  }else if(intVal($ddp)>=501 && intVal($ddp)<=1000){
						 $resultd=1000; 
					  } 
             
					  $total_numero=intval($dap."000")+$resultd; 
                     
			 }	
			  $total_interes=$total_numero;
			  $t=($Monto)+$total_interes;
		      $total=$t-($monto_pagado+$descuentos);
			   }
			   }else{
			      $meses=0;		  
			   }
			  if($total_interes==""){
				 $total_interes=0;
			  }else{
				$total_interes1=$total_interes;  
			  }
              $sql="update cuoteros set totalinteres='$total_interes',diasatrasados='$meses' where cod='$cod_Cuotero'";
             $stmt = $mysqli->prepare($sql);
             $stmt->execute();   
	 }
          
	
if( $total<=0) {
	$total=0;
	$total_interes1=$total_interes;
	$colorestado="#09c7a0";
	$colorestadotexto="#fff";
}else{
	
}
if($estado=="PENDIENTE" && $meses==1) {
	$colorestado="#ff5722";
	$colorestadotexto="#fff";

}
if($estado=="PENDIENTE" && $meses>1) {
	$colorestado="#9C27B0";
	$colorestadotexto="#fff";
}
if($estado=="PENDIENTE" && $meses==0 && $mes==$meshoy && $año==$añohoy) {	
	$colorestado="#FFEB3B";
	$colorestadotexto="#fff";
}
$cant=$cant+1;
     $totalapagar= $totalapagar+$total;
     $totdescuento= $totdescuento+$descuentos;
	 $totalMonto=$totalMonto+$Monto;
	 $totalInter=$totalInter+$total_interes1;
	 if(intVal($total_interes1)!=0){
		 $is=$is+1;
	 }
   $accion1='ver_vetana_permiso(id_progreso,"1",this,"")';
  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
  $pagina.="
<tr ".$bacground."  style='cursor: default;' '> 
<td id='td_id' style='display:none'>".$cod_Cuotero."</td>
<td id='td_id_1' style='display:none'>".$cod_ventaFK."</td>
<td  id='td_cedula1' class='td_detalles' style='width:0%;background-color: #efeded;display:none'>".$clientes_cedula."</td>
<td  id='td_nombres1' class='td_detalles' style='width:0%;background-color: #efeded;display:none'>".$nombres."</td>
<td  id='td_direccion1' class='td_detalles' style='width:0%;background-color: #efeded;display:none'>".$direccion."</td>
<td  id='td_datosS1' class='td_detalles' style='width:5%;background-color: #efeded;color:red;text-align:center;'>".$plazo."/".$cantcuota."</td>
<td  id='td_datos_2' class='td_detalles' style='width:19%;text-align:center;'>".$fep."</td>
<td id='td_datos_1' class='td_detalles'  style='width:19%;text-align:center;'>".number_format($Monto,'0',',','.')."</td>
<td id='td_datos_9'  class='td_detalles' style='width:0%;text-align:center;display:none'>".$diasdegracia."</td>
<td id='td_datos_9'  class='td_detalles' style='width:0%;text-align:center;display:none;color:red;'>".$meses1."</td>
<td id='td_datos_9'  class='td_detalles' style='width:0%;text-align:center;color:red;display:none'>".$meses."</td>
<td id='td_datos_8' class='td_detalles'  style='width:19%;text-align:center;color:red;'>".number_format($total_interes1,'0',',','.')."</td>
<td id='td_datos_4' class='td_detalles'  style='width:0%;text-align:center;display:none;' >".$interes."</td>
<td id='td_monto_".$cod_Cuotero."' class='td_detalles'  style='width:19%;text-align:center;color:red;' >".number_format($total,'0',',','.')."</td>
<td id='td_datos_11' class='td_detalles' style='width:0%;text-align:center;color:green;display:none'>".number_format($monto_pagado,'0',',','.')."</td>
<td id='td_descuento_".$cod_Cuotero."' class='td_detalles'  style='width:0%;text-align:center;color:green;cursor: text;display:none'><div class='div_td_desc' onclick=".$accion1." name='".$cod_Cuotero."' id='div_descuento_".$cod_Cuotero."' >".number_format($descuentos,'0',',','.')."</div></td>
<td id='td_datos_5'  class='td_detalles' style='width:19%;text-align:center;'>".$meses1."</td>
</tr>
";
   }
 }
 
$informacion =array("1" => "exito","2" => $pagina,"3" => $cant,"4" => number_format($totalapagar,'0',',','.'),"5" => number_format($totdescuento,'0',',','.'),"6" => number_format($totalMonto,'0',',','.'),"7" => number_format($totalInter,'0',',','.'),"8" => $is);
echo json_encode($informacion);	
exit;
}

function buscar_detalles_cuoteros_Clientes($ventas_cod){	
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $cant=0;
	 $cantPE=0;
	 $cantPA=0;
		$sql= "Select v.clientes_cod,v.cobrador_cod,concat(p2.primernombre,' ',p2.segundonombre,' ',p2.primerapellido,' ',p2.segundoapellido,' ',p2.apellidocasada) as cobrador,p1.cod as personas_cod,v.fechaventa,v.nrofactura,p1.cedula,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as Cliente,p1.direccion,p1.telefono, 
c.cod, c.cuota as monto,ifnull((SELECT sum(p.monto) from cobroscuotasclientes p where p.estado='PAGADO' and  p.cuoteros_cod=c.cod),0) as totalpagado,
ifnull((SELECT sum(p2.descuento) from cobroscuotasclientes p2 where p2.estado='PAGADO' and  p2.cuoteros_cod=c.cod),0) as totaldescuento,
 c.plazo,ifnull(c.descuento,'0') as descuentos, c.interes, c.fechaapagar,date_format(c.fechaapagar, '%m') as mes,date_format(current_date(), '%m') as meshoy
,date_format(c.fechaapagar, '%Y') as ano,date_format(current_date(), '%Y') as anohoy,date_format(c.fechaapagar, '%d') as dia,
 c.totalinteres, c.estado, c.ventas_cod,c.diasdegracia 
from cuoteros c
join ventas v on c.ventas_cod=v.cod 
join personas p1 on v.clientes_cod=p1.cod
join usuarios u on v.cobrador_cod=u.cod
join personas p2 on u.personas_cod=p2.cod
where c.ventas_cod=?";
$stmt = $mysqli->prepare($sql);
  echo $mysqli -> error; 
$s='s';
$ventas_cod="".$ventas_cod."";
$stmt->bind_param($s,$ventas_cod);
if(!$stmt->execute()){
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {	 
 	      $clientes_cod=utf8_encode($valor['personas_cod']);
 	      $fechaventa=utf8_encode($valor['fechaventa']);
 	      $nrofactura=utf8_encode($valor['nrofactura']);
		      $clientes_cedula=utf8_encode($valor['cedula']);
			  $nombres=utf8_encode($valor['Cliente']);
			  $direccion=utf8_encode($valor['direccion']);
			  $telefono=utf8_encode($valor['telefono']);
			  $cod_Cuotero=$valor['cod'];
		  	  $Monto=utf8_encode($valor['monto']);
              $plazo=utf8_encode($valor['plazo']);
              $cobrador_cod=utf8_encode($valor['cobrador_cod']);
              $cobrador=utf8_encode($valor['cobrador']);
			  $mes=utf8_encode($valor['mes']);
			   $meshoy=utf8_encode($valor['meshoy']);
			   $diasdegracia=utf8_encode($valor['diasdegracia']);
			   
			    $año=utf8_encode($valor['ano']);
			    $añohoy=utf8_encode($valor['anohoy']);
			    $dia=utf8_encode($valor['dia']);
			   $cantcuota=0;
			   $cantcuota=utf8_encode(obtener_cantidad_cuota($ventas_cod));
              $interes=utf8_encode($valor['interes']);
              $fecha_pagar=utf8_encode($valor['fechaapagar']);
            $datea = date_create($fecha_pagar);
           $fep= date_format($datea,"d/m/Y");
              $estado=utf8_encode($valor['estado']);
              $cod_ventaFK=utf8_encode($valor['ventas_cod']);
              $monto_pagado=utf8_encode($valor['totalpagado']);
              $totaldescuento=utf8_encode($valor['totaldescuento']);
              $descuentos=utf8_encode($valor['descuentos']);
              $total=$Monto-($monto_pagado+$descuentos);
			  $total_interes=utf8_encode($valor['totalinteres']);
			  $diff=0;
			  $colorestado="";
			  $colorestadotexto="";
			  $puratorio=1;
			 $fechahoy=date('Y-m-d');
$total_interes=0;
$fechainicial = new DateTime($fecha_pagar);
$fechafinal = new DateTime($fechahoy);
$diferencia = $fechainicial->diff($fechafinal);

$meses=0;	
$meses1=0;	
$total_numero=0;
	 $total_interes1=0; 
$resultd=0;
if($estado!="PAGADO"){
  if($total>0 || $total<0){	
            if($fechainicial>$fechafinal){
				$meses=0;
				$meses1=0;
			}else{
				$dd= $diferencia->days;
                /* $meses=intval($dd)-intval($diasdegracia); */
                $meses=intval($dd);
                $meses1=intval($dd);
			}			  
			   if($meses>0){
			  if($interes!=0){
			  $interes_moratorio=($interes * ($Monto))/100;
			  $total_interes_general=$interes_moratorio ;
			  $total_interes=($total_interes_general*$meses);
         			  $numeros_sp=$total_interes;
			 	$totint_1_con_puntos=number_format($numeros_sp,'0',',','.');		  
			  if((intVal($numeros_sp)>=1) && (intVal($numeros_sp)<=500)){
			  $total_numero=500;
			  } else if((intVal($numeros_sp)>=501) && (intVal($numeros_sp)<=999)){
			   $total_numero=1000;
			  } else if(intVal($numeros_sp)>=1000 && intVal($numeros_sp)<=999999){
					 $datosconpuntos=explode('.',$totint_1_con_puntos,2);
                    	
                     $dap=$datosconpuntos[0];
                      $ddp=$datosconpuntos[1];
					  if(intVal($ddp)>=0 && intVal($ddp)<=500){
						 $resultd=500;
					  }else if(intVal($ddp)>=501 && intVal($ddp)<=1000){
						 $resultd=1000; 
					  } 
             
					  $total_numero=intval($dap."000")+$resultd; 
                     
			 }	
			  $total_interes=$total_numero;
			  
			  $t=($Monto)+$total_interes;
		      $total=$t-($monto_pagado+$descuentos);
			   }
			   }else{
			      $meses=0;		  
			   }
			  if($total_interes==""){
				 $total_interes=0;
			  }else{
				$total_interes1=number_format($total_interes,'0',',','.');  
			  }
              $sql="update cuoteros set totalinteres='$total_interes',diasatrasados='$meses' where cod='$cod_Cuotero'";
             $stmt = $mysqli->prepare($sql);
             $stmt->execute();   
	 }
}	
  

	 
if( $total<=0){
	$total=0;
	$total_interes1=number_format($total_interes,'0',',','.');  
	$colorestado="#09c7a0";
	$colorestadotexto="#fff";
            $sql="update cuoteros set estado='PAGADO' where cod='$cod_Cuotero'";
             $stmt = $mysqli->prepare($sql);
             $stmt->execute(); 
} else {
      $total=$total;
	  $sql="update cuoteros set estado='PENDIENTE' where cod='$cod_Cuotero'";
             $stmt = $mysqli->prepare($sql);
             $stmt->execute(); 
}
if($estado=="PENDIENTE" && $meses==1) {
	$colorestado="#ff5722";
	$colorestadotexto="#fff";
}
if($estado=="PENDIENTE" && $meses>1) {
	$colorestado="#9C27B0";
	$colorestadotexto="#fff";
}
if($estado=="PENDIENTE" && $meses==0 && $mes==$meshoy && $año==$añohoy) {	
	$colorestado="#FFEB3B";
	$colorestadotexto="#fff";
}
if($estado=="PENDIENTE") {	
	$cantPE=$cantPE+1;
}
if($estado=="PAGADO") {	
	$cantPA=$cantPA+1;
}
$cant=$cant+1;
  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
  $pagina.="
<tr onclick='obtener_datos_pagos(this)' ".$bacground."> 
<td id='td_id' style='display:none'>".$cod_Cuotero."</td>
<td id='td_id_1' style='display:none'>".$cod_ventaFK."</td>
<td  id='td_cedula1' class='td_detalles' style='width:0%;background-color: #efeded;display:none'>".$clientes_cedula."</td>
<td  id='td_nombres1' class='td_detalles' style='width:0%;background-color: #efeded;display:none'>".$nombres."</td>
<td  id='td_direccion1' class='td_detalles' style='width:0%;background-color: #efeded;display:none'>".$direccion."</td>
<td  id='td_datosS1' class='td_detalles' style='width:5%;background-color: #efeded;color:red;text-align:center;'>".$plazo."/".$cantcuota."</td>
<td  id='td_datos_2' class='td_detalles' style='width:19%;text-align:center;'>".$fep."</td>
<td id='td_datos_1' class='td_detalles'  style='width:19%;text-align:center;'>".number_format($Monto,'0',',','.')."</td>
<td id='td_datos_9'  class='td_detalles' style='width:0%;text-align:center;display:none'>".$diasdegracia."</td>
<td id='td_datos_9'  class='td_detalles' style='width:0%;text-align:center;display:none;color:red;'>".$meses1."</td>
<td id='td_datos_9'  class='td_detalles' style='width:0%;text-align:center;color:red;display:none'>".$meses."</td>
<td id='td_datos_8' class='td_detalles'  style='width:19%;text-align:center;color:red;'>".$total_interes1."</td>
<td id='td_datos_4' class='td_detalles'  style='width:0%;text-align:center;display:none;' >".$interes."</td>
<td id='td_datos_6' class='td_detalles'  style='width:19%;text-align:center;color:red;' >".number_format($total,'0',',','.')."</td>
<td id='td_datos_11' class='td_detalles' style='width:0%;text-align:center;color:green;display:none'>".number_format($monto_pagado,'0',',','.')."</td>
<td id='td_datos_4' class='td_detalles'  style='width:0%;text-align:center;color:green;display:none' >".number_format($descuentos,'0',',','.')."</td>
<td id='td_datos_5'  class='td_detalles' style='width:19%;text-align:center;'>".$meses1."</td>
</tr>
";
   }
 }
 
$informacion =array("1" => "exito","2" => $pagina,"3" => $cant,"4" => $cantPE,"5" => $cantPA,"6" => $clientes_cedula,"7" => $nombres,"8" => $nrofactura,"9" => $fechaventa,"10" => $clientes_cod,"11" => $cobrador_cod,"12" => $cobrador,"13" => $cod_ventaFK);
echo json_encode($informacion);	
exit;
}

function obtener_cantidad_cuota($ventas_cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "SELECT count(cod) as cantidad FROM cuoteros where ventas_cod='$ventas_cod'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $analista=$valor['cantidad'];  
	  }
 }
 return $analista;
}

function cargarpagos($montopagado,$fechapago, $ventas_cod,$caja_cod,$nrocomprobante,$sucursales_cod,$usuarios_cod,$hora) {
	 $deuda=0;
	 $monto1=0;
	 $pago=0;
	 $control1=0;
	$mysqli=conectar_al_servidor();
	$sql="Select cr.cuota,cr.cod,ifnull(cr.descuento,'0') as descuento,cr.fechaapagar,(cuota+totalinteres)-ifnull(descuento,'0') as total,
	IFNULL((select sum(pg.monto) from cobroscuotasclientes pg where pg.cuoteros_cod=cr.cod and pg.estado='PAGADO'),0) as totalPago
    from cuoteros cr 
    where cr.ventas_cod='".$ventas_cod."' and IFNULL((select sum(pg.monto) from cobroscuotasclientes pg where pg.cuoteros_cod=cr.cod and pg.estado='PAGADO'),0) < cuota order by cr.cod asc"; 
   $stmt = $mysqli->prepare($sql);
   if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {   
		  	  $cuoteros_cod=utf8_encode($valor['cod']);
			  $cuota=utf8_encode($valor['cuota']);
			  $descuento=utf8_encode($valor['descuento']);
			  $fechaapagar=utf8_encode($valor['fechaapagar']);
			  $monto1=utf8_encode($valor['total']);
			  $totalPago=utf8_encode($valor['totalPago']);	
              $deuda = $monto1 - $totalPago;
                 $c = 1;
                if ($montopagado <= 0) {
                    $c = 0;
                    $pago = 0;
                }
                $control1 = $montopagado - $deuda;
                if ($control1 <= 0) {
                    $pago = $montopagado;
                    $montopagado = 0;
                } else {
                    $pago = $deuda;
                    $montopagado = $montopagado - $deuda;
                }
                if ($pago > 0 && $c == 1) {
                    cargarPagosDeudas($pago,$fechapago,$cuoteros_cod, $ventas_cod, $caja_cod,$nrocomprobante,$usuarios_cod,$hora);
                }			  
	  }
 }
 $consulta2="update ajustesfactura set nrocomprobante=? where estado='ACTIVO' and sucursal_cod=?";
$stmt2 = $mysqli->prepare($consulta2);
$ss='ss';
$stmt2->bind_param($ss,$nrocomprobante,$sucursales_cod); 
if ( ! $stmt2->execute()) {
   echo "Error";
   exit;
}
 echo "exito";
exit;
}

function cargarPagosDeudas($pago,$fechapago,$cuoteros_cod, $ventas_cod, $caja_cod,$nrocomprobante,$usuarios_cod,$hora){
if($pago=="" || $fechapago=="" ||  $cuoteros_cod=="" || $ventas_cod=="" || $caja_cod==""  || $nrocomprobante==""  || $usuarios_cod==""  || $hora==""){
    echo "camposvacio";	
    exit;
}

$mysqli=conectar_al_servidor();
$consulta="Insert into cobroscuotasclientes (monto, nrocomprobante, caja_cod, cuoteros_cod, ventas_cod, hora, usuarios_cod, fecha, descuento, estado) values(?,?,?,?,?,?,?,?,(select ifnull(descuento,'0') from cuoteros where cod='".$cuoteros_cod."'),'PAGADO')";	
$stmt = $mysqli->prepare($consulta);
$ss='ssssssss';
$stmt->bind_param($ss,$pago,$nrocomprobante,$caja_cod,$cuoteros_cod, $ventas_cod,$hora,$usuarios_cod,$fechapago); 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
$valor=obtener_valor($cuoteros_cod,$nrocomprobante);
$consulta1="Insert into cajadiaria (origen,tipo,caja_cod, nro,egreso, descripcion, ingreso, fecha, hora, estado) 
values
('PAGO','COBRO',?,?,'0',(SELECT concat('Cobro a ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada,', Fac.No:',v.nrofactura,' Suc:',s.numero,'-') as descripcion FROM ventas v join personas p on v.clientes_cod=p.cod join sucursales s on v.sucursales_cod=s.cod where v.cod='".$ventas_cod."'),?,?,?,'ACTIVO')";	
$stmt1 = $mysqli->prepare($consulta1);
$ss1='sssss';
$stmt1->bind_param($ss1,$caja_cod,$nrocomprobante,$valor,$fechapago,$hora); 
if ( ! $stmt1->execute()) {
   echo "Error";
   exit;
}
cargarpagos_a_cajadiaria($pago,$fechapago,$cuoteros_cod, $ventas_cod, $caja_cod,$nrocomprobante,$usuarios_cod,$hora);
}

function obtener_valor($cod,$nro){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "SELECT (cu.totalinteres+cu.cuota)-((cu.totalinteres+cu.cuota)-(ccc.monto))-cu.totalinteres,case 
  when ((cu.totalinteres+cu.cuota)-((cu.totalinteres+cu.cuota)-(ccc.monto))-cu.totalinteres)<0 
  then
			 ifnull(CASE 
			   WHEN ((cu.totalinteres+cu.cuota)-(ccc.monto)) = 0  THEN cu.cuota 
			   WHEN ((cu.totalinteres+cu.cuota)-(ccc.monto)) != 0 THEN ccc.monto END ,'0')   
   
when ((cu.totalinteres+cu.cuota)-((cu.totalinteres+cu.cuota)-(ccc.monto))-cu.totalinteres)>=0 
  then 
			   ifnull(CASE 
			   WHEN ((cu.totalinteres+cu.cuota)-(ccc.monto)) = 0  THEN cu.cuota 
			   WHEN ((cu.totalinteres+cu.cuota)-(ccc.monto)) != 0 THEN ((cu.totalinteres+cu.cuota)-((cu.totalinteres+cu.cuota)-(ccc.monto))-cu.totalinteres) END ,'0')
  end as valor
 FROM cobroscuotasclientes ccc join cuoteros cu on ccc.cuoteros_cod=cu.cod where cu.cod='".$cod."' and ccc.nrocomprobante='".$nro."'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $analista=$valor['valor'];  
	  }
 }
 return $analista;
}

function cargarpagos_a_cajadiaria($pago,$fechapago,$cuoteros_cod, $ventas_cod, $caja_cod,$nrocomprobante,$usuarios_cod,$hora) {
    $mysqli=conectar_al_servidor();
	$sql="SELECT (cu.totalinteres+cu.cuota)-(select sum(monto) from cobroscuotasclientes ccc where ccc.cuoteros_cod='".$cuoteros_cod."')-cu.descuento as valor,ifnull(cu.totalinteres,'0') as interes,ifnull(cu.descuento,'0') as descuento 
from cuoteros cu 
join cobroscuotasclientes co on co.cuoteros_cod=cu.cod
where cu.cod='".$cuoteros_cod."' and co.nrocomprobante='".$nrocomprobante."'"; 
   $stmt = $mysqli->prepare($sql);
   if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {   
		  	  $interes=utf8_encode($valor['interes']);
			  $descuento=utf8_encode($valor['descuento']);	
			  $valor=utf8_encode($valor['valor']);
if(intVal($valor)==0){
	     if(intVal($interes)>0){
				$consulta1="Insert into cajadiaria (origen,tipo,caja_cod, nro,egreso, descripcion, ingreso, fecha, hora, estado) values('PAGO','INTERES',?,?,'0',(SELECT concat('Int.Cob. a ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada,', S/Fac.No:',v.nrofactura,' Suc:',s.numero,'-') as descripcion FROM ventas v join personas p on v.clientes_cod=p.cod join sucursales s on v.sucursales_cod=s.cod where v.cod='".$ventas_cod."'),(select ifnull(totalinteres,'0') from cuoteros where cod='".$cuoteros_cod."'),?,?,'ACTIVO')";	
				$stmt1 = $mysqli->prepare($consulta1);
				$ss1='ssss';
				$stmt1->bind_param($ss1,$caja_cod,$nrocomprobante,$fechapago,$hora); 
				if ( ! $stmt1->execute()) {
				   echo "Error";
				   exit;
				}
			}
               if(intVal($descuento)>0){
				$consulta1="Insert into cajadiaria (origen,tipo,caja_cod, nro,egreso, descripcion, ingreso, fecha, hora, estado) values('PAGO','DESCUENTO',?,?,(select ifnull(descuento,'0') from cuoteros where cod='".$cuoteros_cod."'),(SELECT concat('Descuento a ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada,', Fac.No:',v.nrofactura,' Suc:',s.numero,'-') as descripcion FROM ventas v join personas p on v.clientes_cod=p.cod join sucursales s on v.sucursales_cod=s.cod where v.cod='".$ventas_cod."'),'0',?,?,'ACTIVO')";	
				$stmt1 = $mysqli->prepare($consulta1);
				$ss1='ssss';
				$stmt1->bind_param($ss1,$caja_cod,$nrocomprobante,$fechapago,$hora); 
				if ( ! $stmt1->execute()) {
				   echo "Error";
				   exit;
				}
			}
}			  
        			
	  }
 }
}

function anular_pagos($nrocomprobante,$clavepermisoanulacion){
$mysqli=conectar_al_servidor();
	if($nrocomprobante==""){
    echo "camposvacio";	
    exit;
	}

	    $sql="update cobroscuotasclientes set permisoanulacion='".$clavepermisoanulacion."',estado='ANULADO' where nrocomprobante='".$nrocomprobante."'";
		$stmt = $mysqli->prepare($sql);
    if(!$stmt->execute()) {
     echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
     exit;
    }
	  $sql1="update cajadiaria set permisoanulacion='".$clavepermisoanulacion."',estado='ANULADO' where nro='".$nrocomprobante."' and origen='PAGO'";
		$stmt1 = $mysqli->prepare($sql1);
    if(!$stmt1->execute()) {
     echo trigger_error('The query execution failed; MySQL said ('.$stmt1->errno.') '.$stmt1->error, E_USER_ERROR);
     exit;
    }
	echo"exito";
}



verificar_datos();

?>