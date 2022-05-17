<?php
require("conexion.php");

function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func);
		if($func=='buscar_auditoria_de_compras'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$proveedores_cod = $_POST['proveedores_cod'];
			$proveedores_cod = utf8_decode($proveedores_cod);
			
			$usocontable = $_POST['usocontable'];
			$usocontable = utf8_decode($usocontable);	
			buscar_auditoria_de_compras($desde,$hasta,$proveedores_cod,$usocontable);
			
		}
	    if($func=='buscar_auditoria_de_compras_detalles'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$proveedores_cod = $_POST['proveedores_cod'];
			$proveedores_cod = utf8_decode($proveedores_cod);
			
			$usocontable = $_POST['usocontable'];
			$usocontable = utf8_decode($usocontable);	
			buscar_auditoria_de_compras_detalles($desde,$hasta,$proveedores_cod,$usocontable);
			
		}
	    if($func=='buscar_auditoria_de_otros_ingresos'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);
				
			buscar_auditoria_de_otros_ingresos($desde,$hasta,$caja_cod);	
		}
        if($func=='buscar_auditoria_de_otros_egresos'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);
				
			buscar_auditoria_de_otros_egresos($desde,$hasta,$caja_cod);	
		}	
		if($func=='buscar_auditoria_de_desembolsos'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);
				
			buscar_auditoria_de_desembolsos($desde,$hasta,$caja_cod);	
		}	
		if($func=='buscar_auditoria_de_pagos_proveedores_creditos'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);
				
			buscar_auditoria_de_pagos_proveedores_creditos($desde,$hasta,$caja_cod);	
		}		
	    if($func=='buscar_auditoria_de_cobranzas'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);
				
			$cobrador_cod = $_POST['cobrador_cod'];
			$cobrador_cod = utf8_decode($cobrador_cod);

			$usuarios_cod = $_POST['usuarios_cod'];
			$usuarios_cod = utf8_decode($usuarios_cod);
				
			$usocontable = $_POST['usocontable'];
			$usocontable = utf8_decode($usocontable);
				
			buscar_auditoria_de_cobranzas($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable);	
		}		
		 if($func=='buscar_auditoria_de_ingresos_egresos'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);

			$resumen = $_POST['resumen'];
			$resumen = utf8_decode($resumen);

			$codconcepto = $_POST['codconcepto'];
			$codconcepto = utf8_decode($codconcepto);
				
			buscar_auditoria_de_ingresos_egresos($desde,$hasta,$caja_cod,$resumen,$codconcepto);	
		}
		
		}

function buscar_auditoria_de_ingresos_egresos($desde,$hasta,$caja_cod,$resumen,$codconcepto){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $egresototal=0;
	 $control="d";
	 if($caja_cod=="TODOS"){
		$sql= "SELECT e.fecha,e.nro,concat('Pago a ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,', ',e.detalles ) as detalle,'0' as ingreso,e.monto as egreso
FROM otrosegresos e
join personas p on e.personas_cod=p.cod
join caja c on  e.caja_cod=c.cod
join datoscaja d on c.datoscaja_cod=d.cod
  where e.estado='ACTIVO' and e.fecha>='".$desde."' and e.fecha<='".$hasta."' ";  
	 }else{
		$sql= "SELECT e.fecha,e.nro,concat('Pago a ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,', ',e.detalles ) as detalle,'0' as ingreso,e.monto as egreso
FROM otrosegresos e
join personas p on e.personas_cod=p.cod
join caja c on  e.caja_cod=c.cod
join datoscaja d on c.datoscaja_cod=d.cod
where e.estado='ACTIVO' and c.datoscaja_cod='".$caja_cod."' and e.conceptos_cod='".$codconcepto."' and e.fecha>='".$desde."' and e.fecha<='".$hasta."  ";   
	 }
	 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		    
		  	  $fecha=utf8_encode($valor['fecha']);
			  $nro=utf8_encode($valor['nro']);
			  $detalle=utf8_encode($valor['detalle']); 
			  $ingreso=utf8_encode($valor['ingreso']); 
			  $egreso=utf8_encode($valor['egreso']); 
	  	 $cant=$cant+1;
	  	 $egresototal=$egresototal+$egreso;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr  ".$bacground.">
<td class='td_detalles' style='width:10%;' >".$fecha."</td>
<td class='td_detalles' style='width:10%;' >".$nro."</td>
<td class='td_detalles' style='width:60%;'   >".$detalle."</td>
<td class='td_detalles' style='width:10%;'  >".$ingreso."</td>
<td class='td_detalles' style='width:10%;'   >".number_format($egreso,'0',',','.')."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => number_format($egresototal,'0',',','.'));
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_de_desembolsos($desde,$hasta,$caja_cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $montototal=0;
	 $control="d";
	 if($caja_cod=="TODOS"){
		$sql= "SELECT de.fecha,v.nrofactura,v.nrosolicitud,concat('Desembolsado a ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido) as usuario,concat(s.nombres,' ',s.numero) as sucursal,
de.usuarios_cod,de.monto,de.hora
FROM desembolsos de
join ventas v on de.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios u on de.usuarios_cod=u.cod
join personas p1 on u.personas_cod=p1.cod
join sucursales s on u.sucursales_cod=s.cod
join caja ca on de.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
  where de.estado='ACTIVO' and de.fecha>='".$desde."' and de.fecha<='".$hasta."' ";  
	 }else{
		$sql= "SELECT de.fecha,v.nrofactura,v.nrosolicitud,concat('Desembolsado a ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido) as usuario,concat(s.nombres,' ',s.numero) as sucursal,
de.usuarios_cod,de.monto,de.hora
FROM desembolsos de
join ventas v on de.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios u on de.usuarios_cod=u.cod
join personas p1 on u.personas_cod=p1.cod
join sucursales s on u.sucursales_cod=s.cod
join caja ca on de.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
  where de.estado='ACTIVO' and da.cod='".$caja_cod."' and de.fecha>='".$desde."' and de.fecha<='".$hasta."'  ";  
		 
	 }
	 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {  
		  	  $fecha=utf8_encode($valor['fecha']);
			  $nrofactura=utf8_encode($valor['nrofactura']);
			  $nrosolicitud=utf8_encode($valor['nrosolicitud']); 
			  $cliente=utf8_encode($valor['cliente']); 
			  $monto=utf8_encode($valor['monto']); 
			  $sucursal=utf8_encode($valor['sucursal']); 
			  $usuario=utf8_encode($valor['usuario']); 
			  $hora=utf8_encode($valor['hora']); 
	  	 $cant=$cant+1;
	  	 $montototal=$montototal+$monto;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr  ".$bacground.">
<td class='td_detalles' style='width:10%;' >".$fecha."</td>
<td class='td_detalles' style='width:10%;' >".$nrofactura."</td>
<td class='td_detalles' style='width:10%;'   >".$nrosolicitud."</td>
<td class='td_detalles' style='width:30%;'  >".$cliente."</td>
<td class='td_detalles' style='width:10%;'   >".number_format($monto,'0',',','.')."</td>
<td class='td_detalles' style='width:10%;'   >".$sucursal."</td>
<td class='td_detalles' style='width:10%;'   >".$usuario."</td>
<td class='td_detalles' style='width:10%;'   >".$hora."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => number_format($montototal,'0',',','.'));
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_de_cobranzas($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $pagina1='';
	 $where="";
	 $titulo_pagina="";
	 $cant=0;
	 $montototal=0;
	 $control="d";
 
	 if($caja_cod=="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod=="TODOS"){
  if($usocontable=="SI"){
       		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
  where c.estado='PAGADO' and v.nrofactura!=false and ".$where." c.fecha>='".$desde."' and c.fecha<='".$hasta."' ";  
   }else{
   		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
  where c.estado='PAGADO' and ".$where." c.fecha>='".$desde."' and c.fecha<='".$hasta."' ";  
   }

	 }else if ($caja_cod!="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod!="TODOS"){

  if($usocontable=="SI"){
       		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
  where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'"; 
   }else{
   		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'"; 
   }


	
 }else
 if ($caja_cod!="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod=="TODOS"){


  if($usocontable=="SI"){
       		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
  where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' "; 
   }else{
   		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' "; 
   }
	 }else
if ($caja_cod=="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod=="TODOS"){
if($usocontable=="SI"){
       		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  "; 
   }else{
   		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  "; 
   }
		 	 
	 }else if ($caja_cod=="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod!="TODOS"){

if($usocontable=="SI"){
       		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' "; 
   }else{
   		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' "; 
   }

 	 
	 }else if ($caja_cod!="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod=="TODOS"){
if($usocontable=="SI"){
       		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  "; 
   }else{
   		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  "; 
   }

		 	 
	 }else if ($caja_cod!="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod!="TODOS"){
if($usocontable=="SI"){
       		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' "; 
   }else{
   		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  "; 
   }

		 
	 }else if ($caja_cod=="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod!="TODOS"){
if($usocontable=="SI"){
       		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' "; 
   }else{
   		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,cu.amortizacion,cu.interesfinanciero,ifnull(cu.gastosadministrativos,0) as gastosadmin,
cu.totalinteres,c.monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' "; 
   }

	
	 }
	 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result)) {
		    
		  	  $condicion=utf8_encode($valor['condicion']);
			  $fecha=utf8_encode($valor['fecha']);
			  $nrocomprobante=utf8_encode($valor['nrocomprobante']); 
			  $cod=utf8_encode($valor['cod']); 
			  $cliente=utf8_encode($valor['cliente']); 
			  $Cobrador=utf8_encode($valor['Cobrador']); 
              $resultado = substr($Cobrador, 0, 2);
			  $nrofactura=utf8_encode($valor['nrofactura']); 
			  $codsucursal=utf8_encode($valor['codsucursal']); 
			  $amortizacion=utf8_encode($valor['amortizacion']); 
              if($amortizacion!=""){
               $amortizacion=number_format($amortizacion,'0',',','.');
              }
			  $interesfinanciero=utf8_encode($valor['interesfinanciero']); 
              if($interesfinanciero!=""){
               $interesfinanciero=number_format($interesfinanciero,'0',',','.');
              }
			  $gastosadmin=utf8_encode($valor['gastosadmin']);
              if($gastosadmin!=""){
               $gastosadmin=number_format($gastosadmin,'0',',','.');
              } 
			  $totalinteres=utf8_encode($valor['totalinteres']); 
              if($totalinteres!=""){
               $totalinteres=number_format($totalinteres,'0',',','.');
              }
			  $monto=utf8_encode($valor['monto']); 
             if($monto!=""){
               $monto=number_format($monto,'0',',','.');
              } 
			  $usuario=utf8_encode($valor['usuario']); 
			  $sucursal=utf8_encode($valor['sucursal']); 
			 
			  
	  	 $cant=$cant+1;
	  
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.="
<tr  ".$bacground.">
<td class='td_detalles' style='width:10%;' >".$fecha."</td>
<td class='td_detalles' style='width:6%;' >".$nrocomprobante."</td>
<td class='td_detalles' style='width:6%;'   >".$cod."</td>
<td class='td_detalles' style='width:20%;'  >".$cliente."</td>
<td class='td_detalles' style='width:4%;'   >".$resultado."</td>
<td class='td_detalles' style='width:10%;'   >".$nrofactura."</td>
<td class='td_detalles' style='width:4%;'   >".$codsucursal."</td>
<td class='td_detalles' style='width:6%;'   >".$amortizacion."</td>
<td class='td_detalles' style='width:5%;'   >".$interesfinanciero."</td>
<td class='td_detalles' style='width:6%;'   >".$gastosadmin."</td>
<td class='td_detalles' style='width:6%;'   >".$totalinteres."</td>
<td class='td_detalles' style='width:7%;'   >".$monto." Gs.</td>
<td class='td_detalles' style='width:10%;'   >".$usuario."</td>
</tr>
";		  
   }
}
 $pagina1="<table id='cnt_listado_auditoriadecompras' style='width:100%;' border='1' class='table_5' cellspacing='0' cellpadding='0'>
            ".$pagina."
           <table> 
		   <table id='cnt_listado_auditoriadecompras' style='width:100%;' border='1' class='table_5' cellspacing='0' cellpadding='0'>
		   ".buscar_auditoria_de_cobranzas_sucursales($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable)."
           <table> 
		   <table id='cnt_listado_auditoriadecompras' style='width:100%;' border='1' class='table_5' cellspacing='0' cellpadding='0'>
		   ".buscar_auditoria_de_cobranzas_totales($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable)."
           <table>
		   <table id='cnt_listado_auditoriadecompras' style='width:100%;' border='1' class='table_5' cellspacing='0' cellpadding='0'>
		   ".buscar_auditoria_de_cobranzas_diarios_meses_semanas($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable)."
           <table>";
$informacion =array("1" => $pagina1);
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_de_cobranzas_sucursales($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $montototal=0;
	 $control="d";


	 if($caja_cod=="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod=="TODOS"){
if($usocontable=="SI"){
       		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
  where c.estado='PAGADO' and v.nrofactura!=false and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod
   ";  
   }else{
   		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
  where c.estado='PAGADO' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' ";  
   }


		 
	 }else if ($caja_cod!="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod!="TODOS"){
if($usocontable=="SI"){
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and v.nrofactura!=false  and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod  ";
}else{
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod  ";
}
}

 if ($caja_cod!="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod=="TODOS"){
if($usocontable=="SI"){
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and v.nrofactura!=false   and ca.datoscaja_cod='".$caja_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod   "; 
}else{
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod   "; 
}
		 	 
	 }
if ($caja_cod=="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod=="TODOS"){
if($usocontable=="SI"){
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.nrofactura!=false and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod  "; 
}else{
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod  "; 
}
		 	 
	 }

 if ($caja_cod=="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod!="TODOS"){
if($usocontable=="SI"){
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.nrofactura!=false  and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod   "; 
}else{
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod   "; 
}
		 	 
	 }

if ($caja_cod!="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod=="TODOS"){
if($usocontable=="SI"){
	$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and v.nrofactura!=false  and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod "; 
}else{
	$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod "; 
}
	 	 
	 }

if ($caja_cod!="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod!="TODOS"){
if($usocontable=="SI"){
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and v.nrofactura!=false  and ca.datoscaja_cod='".$caja_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod ";  	 

}else{
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.nrofactura!=false  and ca.datoscaja_cod='".$caja_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod ";  	 
}
		
	 }

 if ($caja_cod=="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod!="TODOS"){
if($usocontable=="SI"){
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and v.nrofactura!=false and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod  ";  
}else{
$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.sucursales_cod  ";  
}
			 
	 }
	 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result)) {
		    
		  	  $condicion=utf8_encode($valor['condicion']);
			  $fecha=utf8_encode($valor['fecha']);
			  $nrocomprobante=utf8_encode($valor['nrocomprobante']); 
			  $cod=utf8_encode($valor['cod']); 
			  $cliente=utf8_encode($valor['cliente']); 
			  $Cobrador=utf8_encode($valor['Cobrador']); 
              $resultado = substr($Cobrador, 0, 2);
			  $nrofactura=utf8_encode($valor['nrofactura']); 
			  $codsucursal=utf8_encode($valor['codsucursal']); 
			  $amortizacion=utf8_encode($valor['amortizacion']); 
              if($amortizacion!=""){
               $amortizacion=number_format($amortizacion,'0',',','.');
              }
			  $interesfinanciero=utf8_encode($valor['interesfinanciero']); 
              if($interesfinanciero!=""){
               $interesfinanciero=number_format($interesfinanciero,'0',',','.');
              }
			  $gastosadmin=utf8_encode($valor['gastosadmin']);
              if($gastosadmin!=""){
               $gastosadmin=number_format($gastosadmin,'0',',','.');
              } 
			  $totalinteres=utf8_encode($valor['totalinteres']); 
              if($totalinteres!=""){
               $totalinteres=number_format($totalinteres,'0',',','.');
              }
			  $monto=utf8_encode($valor['monto']); 
             if($monto!=""){
               $monto=number_format($monto,'0',',','.');
              } 
			  $usuario=utf8_encode($valor['usuario']); 
			  $sucursal=utf8_encode($valor['sucursal']); 
			 
	  	 $cant=$cant+1;
	  
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.="
<tr  ".$bacground.">
<td class='td_detalles' style='width:60%;' >Total ".$sucursal."</td>
<td class='td_detalles' style='width:6%;'   >".$amortizacion."</td>
<td class='td_detalles' style='width:5%;'   >".$interesfinanciero."</td>
<td class='td_detalles' style='width:6%;'   >".$gastosadmin."</td>
<td class='td_detalles' style='width:6%;'   >".$totalinteres."</td>
<td class='td_detalles' style='width:7%;'   >".$monto." Gs.</td>
<td class='td_detalles' style='width:10%;'   ></td>
</tr>
";		  
   }
}
 
return $pagina;
}

function buscar_auditoria_de_cobranzas_totales($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $montototal=0;
	 $control="d";
	 if($caja_cod=="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod=="TODOS"){
		 if($usocontable=="SI"){
			$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
  where c.estado='PAGADO' and v.nrofactura!=false and  c.fecha>='".$desde."' and c.fecha<='".$hasta."'";   
		 }else{
			$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
  where c.estado='PAGADO' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'";   
		 }
			 
		
	 }else if ($caja_cod!="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod!="TODOS"){
		  if($usocontable=="SI"){
			$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and v.nrofactura!=false and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  "; 
		 }else{
		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";	 
		 }
		   }

 if ($caja_cod!="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod=="TODOS"){
	   if($usocontable=="SI"){
			$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.nrofactura!=false and ca.datoscaja_cod='".$caja_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'   ";  
		 }else{
			$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'   ";  
		 }
		 	 
	 }
if ($caja_cod=="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod=="TODOS"){
	  if($usocontable=="SI"){
			$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and v.nrofactura!=false and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  	 
		 }else{
			$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  	 
		 }
		 
	 }
	 if ($caja_cod=="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod!="TODOS"){
		   if($usocontable=="SI"){
			 $sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and v.nrofactura!=false and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  	
		 }else{
		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  		 
		 }
		 
	 }
 if ($caja_cod!="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod=="TODOS"){
		   if($usocontable=="SI"){
			 	$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and v.nrofactura!=false and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  	
		 }else{
				$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  	 
		 }
	 
	 }
 if ($caja_cod!="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod!="TODOS"){
		   if($usocontable=="SI"){
			$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and v.nrofactura!=false and ca.datoscaja_cod='".$caja_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  "; 
		 }else{
		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' ";	 
		 }
		  	 
	 }
 if ($caja_cod=="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod!="TODOS"){
		   if($usocontable=="SI"){
			 $sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.nrofactura!=false  and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  
		 }else{
			 $sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  
		 }
			 
	 }
	 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
    $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		  	  $condicion=utf8_encode($valor['condicion']);
			  $fecha=utf8_encode($valor['fecha']);
			  $nrocomprobante=utf8_encode($valor['nrocomprobante']); 
			  $cod=utf8_encode($valor['cod']); 
			  $cliente=utf8_encode($valor['cliente']); 
			  $Cobrador=utf8_encode($valor['Cobrador']); 
              $resultado = substr($Cobrador, 0, 2);
			  $nrofactura=utf8_encode($valor['nrofactura']); 
			  $codsucursal=utf8_encode($valor['codsucursal']); 
			    $amortizacion=utf8_encode($valor['amortizacion']); 
			  if($amortizacion!=""){
               $amortizacion=number_format($amortizacion,'0',',','.');
              }
			  $interesfinanciero=utf8_encode($valor['interesfinanciero']); 
              if($interesfinanciero!=""){
               $interesfinanciero=number_format($interesfinanciero,'0',',','.');
              }
			  $gastosadmin=utf8_encode($valor['gastosadmin']);
              if($gastosadmin!=""){
               $gastosadmin=number_format($gastosadmin,'0',',','.');
              } 
			  $totalinteres=utf8_encode($valor['totalinteres']); 
              if($totalinteres!=""){
               $totalinteres=number_format($totalinteres,'0',',','.');
              }
			  $monto=utf8_encode($valor['monto']); 
             if($monto!=""){
               $monto=number_format($monto,'0',',','.');
              } 
			  $usuario=utf8_encode($valor['usuario']); 
			  $sucursal=utf8_encode($valor['sucursal']); 
	  	  $cant=$cant+1;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.="
<tr  >
<td class='td_detalles' style='width:60%;background: #a5a5a5;font-weight:900;' >TOTAL GENERAL</td>
<td class='td_detalles' style='width:6%;background: #a5a5a5;'   >".$amortizacion."</td>
<td class='td_detalles' style='width:5%;background: #a5a5a5;'   >".$interesfinanciero."</td>
<td class='td_detalles' style='width:6%;background: #a5a5a5;'   >".$gastosadmin."</td>
<td class='td_detalles' style='width:6%;background: #a5a5a5;'   >".$totalinteres."</td>
<td class='td_detalles' style='width:7%;background: #a5a5a5;'   >".$monto." Gs.</td>
<td class='td_detalles' style='width:10%;background: #a5a5a5;'   ></td>
</tr>
";		  
   }
}
 
return $pagina;
}

function buscar_auditoria_de_cobranzas_diarios_meses_semanas($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $montototal=0;
	 $control="d";
	 if($caja_cod=="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod=="TODOS"){
		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
  where c.estado='PAGADO' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.condicion ";  
	 }else if ($caja_cod!="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod!="TODOS"){
		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.condicion  ";   }

 if ($caja_cod!="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod=="TODOS"){
		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.condicion   ";  	 
	 }
if ($caja_cod=="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod=="TODOS"){
		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.condicion  ";  	 
	 }else if ($caja_cod=="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod!="TODOS"){
		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.condicion   ";  	 
	 }else if ($caja_cod!="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod=="TODOS"){
		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.condicion ";  	 
	 }else if ($caja_cod!="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod!="TODOS"){
		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.condicion   ";  	 
	 }else if ($caja_cod=="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod!="TODOS"){
		$sql= "SELECT v.condicion,c.fecha,c.nrocomprobante,c.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
pr.primernombre as Cobrador,v.nrofactura,v.sucursales_cod as codsucursal,concat(s.nombres,' ',s.numero) as sucursal,sum(cu.amortizacion) as amortizacion,sum(cu.interesfinanciero) as interesfinanciero,sum(ifnull(cu.gastosadministrativos,0)) as gastosadmin,
sum(cu.totalinteres) as totalinteres,sum(c.monto) as monto,concat(pco.primernombre,' ',pco.segundonombre,' ',pco.primerapellido,' ',pco.segundoapellido) as usuario
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
join usuarios co on c.usuarios_cod=co.cod
join personas pco on co.personas_cod=pco.cod
join caja ca on c.caja_cod=ca.cod
join datoscaja da on ca.datoscaja_cod=da.cod
join cuoteros cu on c.cuoteros_cod=cu.cod
join usuarios u on v.cobrador_cod=u.cod
join personas pr on u.personas_cod=pr.cod
join sucursales s on v.sucursales_cod=s.cod
where c.estado='PAGADO'  and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' group by v.condicion  ";  	 
	 }
	 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result)) {
		    
		  	  $condicion=utf8_encode($valor['condicion']);
			  $fecha=utf8_encode($valor['fecha']);
			  $nrocomprobante=utf8_encode($valor['nrocomprobante']); 
			  $cod=utf8_encode($valor['cod']); 
			  $cliente=utf8_encode($valor['cliente']); 
			  $Cobrador=utf8_encode($valor['Cobrador']); 
              $resultado = substr($Cobrador, 0, 2);
			  $nrofactura=utf8_encode($valor['nrofactura']); 
			  $codsucursal=utf8_encode($valor['codsucursal']); 
			  $amortizacion=utf8_encode($valor['amortizacion']); 
			  if($amortizacion!=""){
               $amortizacion=number_format($amortizacion,'0',',','.');
              }
			  $interesfinanciero=utf8_encode($valor['interesfinanciero']); 
              if($interesfinanciero!=""){
               $interesfinanciero=number_format($interesfinanciero,'0',',','.');
              }
			  $gastosadmin=utf8_encode($valor['gastosadmin']);
              if($gastosadmin!=""){
               $gastosadmin=number_format($gastosadmin,'0',',','.');
              } 
			  $totalinteres=utf8_encode($valor['totalinteres']); 
              if($totalinteres!=""){
               $totalinteres=number_format($totalinteres,'0',',','.');
              }
			  $monto=utf8_encode($valor['monto']); 
              if($monto!=""){
               $monto=number_format($monto,'0',',','.');
              }
			  $usuario=utf8_encode($valor['usuario']); 
			  $sucursal=utf8_encode($valor['sucursal']); 
			 
			  
	  	 $cant=$cant+1;
	  
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.="
<tr  ".$bacground.">
<td class='td_detalles' style='width:60%;' >".$condicion."</td>
<td class='td_detalles' style='width:6%;'   >".$amortizacion."</td>
<td class='td_detalles' style='width:5%;'   >".$interesfinanciero."</td>
<td class='td_detalles' style='width:6%;'   >".$gastosadmin."</td>
<td class='td_detalles' style='width:6%;'   >".$totalinteres."</td>
<td class='td_detalles' style='width:7%;'   >".$monto." Gs.</td>
<td class='td_detalles' style='width:10%;'   ></td>
</tr>
";		  
   }
}
 
return $pagina;
}

function buscar_auditoria_de_pagos_proveedores_creditos($desde,$hasta,$caja_cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $montototal=0;
	 $control="d";
	 if($caja_cod=="TODOS"){
		$sql= "SELECT p.fecha,p.nrofactura as nrorecibo,c.nrofactura,pr.cod,pr.nombre as proveedor,s.cod as cod_sucursal,concat(s.nombres,' ',s.numero) as sucursal,concat(da.nombre,' ',da.nro) as caja,cu.monto,cu.interes,p.monto as total
 FROM pagos_cuotas_proveedores p
 join compras c on p.compras_cod=c.cod
 join cuoteros_compras_proveedores cu on p.cuoteros_compras_proveedores_cod=cu.cod
 join proveedores pr on c.proveedores_cod=pr.cod
 join usuarios u on p.usuarios_cod=u.cod
 join sucursales s on u.sucursales_cod=s.cod
 join caja ca on p.caja_cod=ca.cod
 join datoscaja da on ca.datoscaja_cod=da.cod
  where p.estado='PAGADO' and p.fecha>='".$desde."' and p.fecha<='".$hasta."' ";  
	 }else{
		$sql= "SELECT p.fecha,p.nrofactura as nrorecibo,c.nrofactura,pr.cod,pr.nombre as proveedor,s.cod as cod_sucursal,concat(s.nombres,' ',s.numero) as sucursal,concat(da.nombre,' ',da.nro) as caja,cu.monto,cu.interes,p.monto as total
 FROM pagos_cuotas_proveedores p
 join compras c on p.compras_cod=c.cod
 join cuoteros_compras_proveedores cu on p.cuoteros_compras_proveedores_cod=cu.cod
 join proveedores pr on c.proveedores_cod=pr.cod
 join usuarios u on p.usuarios_cod=u.cod
 join sucursales s on u.sucursales_cod=s.cod
 join caja ca on p.caja_cod=ca.cod
 join datoscaja da on ca.datoscaja_cod=da.cod
  where p.estado='PAGADO' and ca.cod='".$caja_cod."' and p.fecha>='".$desde."' and p.fecha<='".$hasta."'  ";  
		 
	 }
	 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result)) {
		    
		  	  $fecha=utf8_encode($valor['fecha']);
			  $nrorecibo=utf8_encode($valor['nrorecibo']);
			  $nrofactura=utf8_encode($valor['nrofactura']); 
			  $cod=utf8_encode($valor['cod']); 
			  $proveedor=utf8_encode($valor['proveedor']); 
			  $sucursal=utf8_encode($valor['sucursal']); 
			  $cod_sucursal=utf8_encode($valor['cod_sucursal']); 
			  $caja=utf8_encode($valor['caja']); 
			  $monto=utf8_encode($valor['monto']); 
			  $interes=utf8_encode($valor['interes']); 
			  $total=utf8_encode($valor['total']); 
	  	 $cant=$cant+1;
	  	 $montototal=$montototal+$total;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr  ".$bacground.">
<td class='td_detalles' style='width:10%;' >".$fecha."</td>
<td class='td_detalles' style='width:10%;' >".$nrorecibo."</td>
<td class='td_detalles' style='width:10%;'   >".$cod."</td>
<td class='td_detalles' style='width:20%;'  >".$proveedor."</td>
<td class='td_detalles' style='width:10%;'   >".$nrofactura."</td>
<td class='td_detalles' style='width:10%;'   >".$cod_sucursal."</td>
<td class='td_detalles' style='width:10%;'   >".number_format($monto,'0',',','.')."</td>
<td class='td_detalles' style='width:10%;'   >".number_format($interes,'0',',','.')."</td>
<td class='td_detalles' style='width:10%;'   >".number_format($total,'0',',','.')."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => number_format($montototal,'0',',','.'));
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_de_otros_egresos($desde,$hasta,$caja_cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $montototal=0;
	 $control="d";
	 if($caja_cod=="TODOS"){
		$sql= "SELECT e.fecha,e.nro,e.cod,e.personas_cod,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as nombre,e.detalles,e.monto 
FROM otrosegresos e
 join personas p1 on e.personas_cod=p1.cod
 join caja c on e.caja_cod=c.cod
 join datoscaja d on c.datoscaja_cod=d.cod
  where e.estado='ACTIVO' and e.fecha>='".$desde."' and e.fecha<='".$hasta."' ";  
	 }else{
		$sql= "SELECT e.fecha,e.nro,e.cod,e.personas_cod,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as nombre,e.detalles,e.monto 
FROM otrosegresos e
 join personas p1 on e.personas_cod=p1.cod
 join caja c on e.caja_cod=c.cod
 join datoscaja d on c.datoscaja_cod=d.cod
  where e.estado='ACTIVO' and e.cod='".$caja_cod."' and e.fecha>='".$desde."' and e.fecha<='".$hasta."'  ";  
		 
	 }
	 
   $stmt = $mysqli->prepare($sql);
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
		  	  $fecha=utf8_encode($valor['fecha']);
			    $nro=utf8_encode($valor['nro']);
			  $personas_cod=utf8_encode($valor['personas_cod']); 
			  $nombre=utf8_encode($valor['nombre']); 
			  $detalles=utf8_encode($valor['detalles']); 
			  $monto=utf8_encode($valor['monto']); 
	  	 $cant=$cant+1;
	  	 $montototal=$montototal+$monto;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr  ".$bacground.">
<td class='td_detalles' style='width:10%;' >".$fecha."</td>
<td class='td_detalles' style='width:10%;' >".$nro."</td>
<td class='td_detalles' style='width:10%;'   >".$cod."</td>
<td class='td_detalles' style='width:30%;'  >".$nombre."</td>
<td class='td_detalles' style='width:30%;'   >".$detalles."</td>
<td class='td_detalles' style='width:10%;'   >".number_format($monto,'0',',','.')."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => number_format($montototal,'0',',','.'));
echo json_encode($informacion);	
exit;
}
	
function buscar_auditoria_de_otros_ingresos($desde,$hasta,$caja_cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $montototal=0;
	 $control="d";
	 if($caja_cod=="TODOS"){
		$sql= "SELECT o.cod,o.fecha,o.nro,o.conceptos_cod,o.personas_cod,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as Cliente,o.detalles,o.monto
 FROM otrosingresos o
 join personas p1 on o.personas_cod=p1.cod
 join caja c on o.caja_cod=c.cod
 join datoscaja d on c.datoscaja_cod=d.cod
  where o.estado='ACTIVO' and o.fecha>='".$desde."' and o.fecha<='".$hasta."' ";  
	 }else{
		$sql= "SELECT o.cod,o.fecha,o.nro,o.conceptos_cod,o.personas_cod,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as Cliente,o.detalles,o.monto
 FROM otrosingresos o
 join personas p1 on o.personas_cod=p1.cod
 join caja c on o.caja_cod=c.cod
 join datoscaja d on c.datoscaja_cod=d.cod
  where o.estado='ACTIVO' and d.cod='".$caja_cod."' and o.fecha>='".$desde."' and o.fecha<='".$hasta."'  ";  
		 
	 }
	 
   $stmt = $mysqli->prepare($sql);
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
		  	  $fecha=utf8_encode($valor['fecha']);
			    $nro=utf8_encode($valor['nro']);
			    $conceptos_cod=utf8_encode($valor['conceptos_cod']);
			  $personas_cod=utf8_encode($valor['personas_cod']); 
			  $Cliente=utf8_encode($valor['Cliente']); 
			  $detalles=utf8_encode($valor['detalles']); 
			  $monto=utf8_encode($valor['monto']); 
	  	 $cant=$cant+1;
	  	 $montototal=$montototal+$monto;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr  ".$bacground.">
<td class='td_detalles' style='width:10%;' >".$fecha."</td>
<td class='td_detalles' style='width:10%;' >".$nro."</td>
<td class='td_detalles' style='width:10%;'   >".$cod."</td>
<td class='td_detalles' style='width:30%;'  >".$Cliente."</td>
<td class='td_detalles' style='width:30%;'   >".$detalles."</td>
<td class='td_detalles' style='width:10%;'   >".number_format($monto,'0',',','.')."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => number_format($montototal,'0',',','.'));
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_de_compras($desde,$hasta,$proveedores_cod,$usocontable){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $datos='';
	 $pagina1='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
     $total=0;
     $totalcredito=0;
     $totalcontado=0;
   
if($proveedores_cod=="TODOS"){
	
	 $sql= "SELECT c.cod,c.fechacompra,c.nrofactura,c.proveedores_cod,c.condicion,sum(ifnull(d.subtotal,0) ) as subtotal
FROM compras c 
join detalles_compras d on d.compras_cod=c.cod
where c.estado='ACTIVO' and c.fechacompra>='".$desde."' and c.fechacompra<='".$hasta."' group by c.cod  ";	
	
     
}else{

	$sql= "SELECT c.cod,c.fechacompra,c.nrofactura,c.proveedores_cod,c.condicion,sum(ifnull(d.subtotal,0) ) as subtotal
FROM compras c 
join detalles_compras d on d.compras_cod=c.cod
where c.estado='ACTIVO' and c.proveedores_cod='".$proveedores_cod."' and c.fechacompra>='".$desde."' and c.fechacompra<='".$hasta."' group by c.cod";
	
 

}
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
                $fechacompra=utf8_encode($valor['fechacompra']);
		  	    $nrofactura=utf8_encode($valor['nrofactura']);
			    $condicion=utf8_encode($valor['condicion']);
			    $proveedores_cod=utf8_encode($valor['proveedores_cod']);
			    $subtotal=utf8_encode($valor['subtotal']);
                if($condicion=="CREDITO"){ 
                  $condicion="Credito"; 
				  if($usocontable=="SI"){
					  if($nrofactura==""){
					   $total=$total+0;
					   $totalcredito=$totalcredito+0;
					  }else{
						  $total=$total+$subtotal;
						 $totalcredito=$totalcredito+$subtotal;
					   }
				  }else{
					   $total=$total+$subtotal;
					  $totalcredito=$totalcredito+$subtotal;
				  }
                 
                }else if($condicion=="CONTADO"){ 
                  $condicion="Contado"; 
				   if($usocontable=="SI"){
					  if($nrofactura==""){
					  $total=$total+0;
					  $totalcontado=$totalcontado+0;
					  }else{
						    $total=$total+$subtotal;
						   $totalcontado=$totalcontado+$subtotal;
					   }
				  }else{
					    $total=$total+$subtotal;
					    $totalcontado=$totalcontado+$subtotal;
				  }

                }
	  	        $cant=$cant+1;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
          
$pagina.=" 
<div >".buscar_auditoria_detalles_de_compras($cod,$usocontable)."</div>

";		  
   }
  
 }
    
 
   $pagina1=$pagina;
$informacion =array("0" => "exito","1" => $pagina1,"2" => number_format($totalcredito,'0',',','.')." Gs.","3" => number_format($totalcontado,'0',',','.')." Gs.","4" => number_format($total,'0',',','.')." Gs.");
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_de_compras_detalles($desde,$hasta,$proveedores_cod,$usocontable){
	$mysqli=conectar_al_servidor();
	$pagina="";
	$pagina1="";
	$titulo_pagina="";
	$cant=0;
	$control="d";
    $total=0;
    $totalcredito=0;
    $totalcontado=0;
    $texto='';
if($proveedores_cod=="TODOS"){
     if($usocontable=="SI"){
      $sql= "SELECT c.nrofactura,c.nrofactura,c.condicion,co.nombres as concepto,sum(ifnull(d.subtotal,0)) as monto
FROM compras c
join detalles_compras d on d.compras_cod=c.cod
join proveedores p on c.proveedores_cod=p.cod
join conceptos co on d.conceptos_cod=co.cod
 where c.estado='ACTIVO'  and c.fechacompra>='".$desde."' and c.fechacompra<='".$hasta."' and c.nrofactura!=false group by  d.conceptos_cod order by c.cod asc ";
     }else{
     $sql= "SELECT c.nrofactura,c.nrofactura,c.condicion,co.nombres as concepto,sum(ifnull(d.subtotal,0)) as monto
FROM compras c
join detalles_compras d on d.compras_cod=c.cod
join proveedores p on c.proveedores_cod=p.cod
join conceptos co on d.conceptos_cod=co.cod
 where c.estado='ACTIVO'  and c.fechacompra>='".$desde."' and c.fechacompra<='".$hasta."' group by  d.conceptos_cod order by c.cod asc "; 
     }
}else{
if($usocontable=="SI"){
 $sql= "SELECT c.nrofactura,c.condicion,co.nombres as concepto,sum(ifnull(d.subtotal,0)) as monto
FROM compras c
join detalles_compras d on d.compras_cod=c.cod
join proveedores p on c.proveedores_cod=p.cod
join conceptos co on d.conceptos_cod=co.cod
 where c.estado='ACTIVO' and c.proveedores_cod='".$proveedores_cod."' and c.fechacompra>='".$desde."' and c.fechacompra<='".$hasta."' and c.nrofactura!=false group by  d.conceptos_cod order by c.cod asc";
}else{
$sql= "SELECT c.nrofactura,c.condicion,co.nombres as concepto,sum(ifnull(d.subtotal,0)) as monto
FROM compras c
join detalles_compras d on d.compras_cod=c.cod
join proveedores p on c.proveedores_cod=p.cod
join conceptos co on d.conceptos_cod=co.cod
 where c.estado='ACTIVO' and c.proveedores_cod='".$proveedores_cod."' and c.fechacompra>='".$desde."' and c.fechacompra<='".$hasta."' group by  d.conceptos_cod order by c.cod asc";
}
}
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
                $condicion=utf8_encode($valor['condicion']);
		  	    $concepto=utf8_encode($valor['concepto']);
              
			    $monto=utf8_encode($valor['monto']);
			  
                if($condicion=="CREDITO"){ 
                  $texto=" A ";        
                }else if($condicion=="CONTADO"){ 
                  $texto=" AL "; 
                }
	  	        $cant=$cant+1;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<thead  ".$bacground.">
<th class='td_detalles' style='width:80%;' >".$concepto.$texto.$condicion."</th>
<th class='td_detalles' style='width:20%;' >".number_format($monto,'0',',','.')." Gs.</th>
</thead>
";		  
   }

 }
 $pagina1=" <div style='padding: 10px 0px 10px 10px;'>
 	<table border='1' style='width:50%;float:right;' class='table_5_1' cellspacing='0' cellpadding='0'>
           <thead style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
	                     	        <th class='td_detalles' style='width:80%;text-align:center;'  >DETALLES</th>
									<th class='td_detalles' style='width:20%;text-align:center;' >MONTO</th>										
			</thead> 
             ".$pagina."		
     </table>
 </div>";
$informacion =array("0" => "exito","1" => $pagina1);
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_detalles_de_compras($compras_cod,$usocontable){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
     $total=0;
     $totalcredito=0;
     $totalcontado=0;
$pag='';
	 $pag1='';
      $sql= "SELECT c.cod,c.fechacompra,c.nrofactura,c.condicion,c.proveedores_cod,d.conceptos_cod,d.concepto,d.cantidad,d.subtotal,p.nombre as proveedor,(select sum(ifnull(subtotal,0)) from detalles_compras where compras_cod='".$compras_cod."') as total 
FROM compras c
join detalles_compras d on d.compras_cod=c.cod
join proveedores p on c.proveedores_cod=p.cod where c.estado='ACTIVO'  and c.cod='".$compras_cod."'";

   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
                
                $fechacompra1=utf8_encode($valor['fechacompra']);
                $datea = date_create($fechacompra1);
                $fechacompra= date_format($datea,"d/m/Y");
		  	    $nrofactura=utf8_encode($valor['nrofactura']);
			    $condicion=utf8_encode($valor['condicion']);
			    $proveedor=utf8_encode($valor['proveedor']);
			    $conceptos_cod=utf8_encode($valor['conceptos_cod']);
			    $concepto=utf8_encode($valor['concepto']);
			    $cantidad=utf8_encode($valor['cantidad']); 
			    $subtotal=utf8_encode($valor['subtotal']); 
			    $total=utf8_encode($valor['total']); 
               
                if($condicion=="CREDITO"){ 
                  $condicion="Credito"; 
                }else if($condicion=="CONTADO"){ 
                  $condicion="Contado";       
                }
	  	        $cant=$cant+1;
                if($usocontable=="SI"){
		       if($nrofactura==""){
		        $pag="";
			   }else{
				$pag=" 
<table id='cnt_listado_auditoriadecompras' style='width:100%;' border='1' class='table_5' cellspacing='0' cellpadding='0'>
 <tr  class='table_blanco'>
<td class='td_detalles' style='width:10%;' >".$fechacompra."</td>
<td class='td_detalles' style='width:10%;' >".$nrofactura."</td>
<td class='td_detalles' style='width:5%;' >".$condicion."</td>
<td class='td_detalles' style='width:20%;' >".$proveedor."</td>
<td class='td_detalles' style='width:5%;' >".$conceptos_cod."</td>
<td class='td_detalles' style='width:30%;' >".$concepto."</td>
<td class='td_detalles' style='width:10%;' >".number_format($cantidad,'0',',','.')."</td>
<td class='td_detalles' style='width:10%;' >".number_format($subtotal,'0',',','.')." Gs.</td>
</tr>                           
</table>
";		   
			   }
			}else{
				$pag=" 
<table id='cnt_listado_auditoriadecompras' style='width:100%;' border='1' class='table_5' cellspacing='0' cellpadding='0'>
 <tr  class='table_blanco'>
<td class='td_detalles' style='width:10%;' >".$fechacompra."</td>
<td class='td_detalles' style='width:10%;' >".$nrofactura."</td>
<td class='td_detalles' style='width:5%;' >".$condicion."</td>
<td class='td_detalles' style='width:20%;' >".$proveedor."</td>
<td class='td_detalles' style='width:5%;' >".$conceptos_cod."</td>
<td class='td_detalles' style='width:30%;' >".$concepto."</td>
<td class='td_detalles' style='width:10%;' >".number_format($cantidad,'0',',','.')."</td>
<td class='td_detalles' style='width:10%;' >".number_format($subtotal,'0',',','.')." Gs.</td>
</tr>                           
</table>
";	
			}	
$pagina.=$pag;		  
   }
   
if($usocontable=="SI"){
		       if($nrofactura==""){
		        $pag1="";
			   }else{
				   $pag1="<div style='width: 100%;    height: 28px; font-weight: 900;' class='table_gris'>
   <h1 class='h2 h1' style='font-size: 11px;
   
    width: 10%;
    text-align: center;
    float: right;'>".number_format($total,'0',',','.')." Gs.</h1>
</div>";
			   }
			   }else{
				   $pag1="<div style='width: 100%;    height: 28px; font-weight: 900;' class='table_gris'>
   <h1 class='h2 h1' style='font-size: 11px;
   
    width: 10%;
    text-align: center;
    float: right;'>".number_format($total,'0',',','.')." Gs.</h1>
</div>";
			   }
			   
			   
  $titulo_pagina=$pagina."".$pag1;
 }

return $titulo_pagina;
}

verificar_datos();

?>