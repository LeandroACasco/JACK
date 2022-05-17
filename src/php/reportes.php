<?php
require("conexion.php");
function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
	
		if($func=='pagare'){
			$nrosolicitud = $_POST['nrosolicitud'];
			$nrosolicitud = utf8_decode($nrosolicitud);
			$montoletras = $_POST['montoletras'];
			$montoletras = utf8_decode($montoletras);
			pagare($nrosolicitud,$montoletras);
		}
        if($func=='recibo'){
			$nrorecibo = $_POST['nrorecibo'];
			$nrorecibo = utf8_decode($nrorecibo);
			$montoletras = $_POST['montoletras'];
			$montoletras = utf8_decode($montoletras);
			recibo($nrorecibo,$montoletras);
		}

		if($func=='obtener_solicitud_credito'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_reporte_solicitud_credito($cod);	
		}
        if($func=='buscar_planilla_caja_reportes'){
			$fecha = $_POST['fecha'];
			$fecha = utf8_decode($fecha);
				
			$resumen = $_POST['resumen'];
			$resumen = utf8_decode($resumen);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);
            $lote = $_POST['lote'];
			$lote = utf8_decode($lote);	
			buscar_planilla_caja_reportes($fecha,$resumen,$caja_cod,$lote);      			
			
			
		}	
	    if($func=='buscar_caja_actual_reporte'){
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);	
			buscar_caja_actual_reporte($caja_cod);
			
		}	
		if($func=='buscar_auditoria_de_compras_reportes'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$proveedores_cod = $_POST['proveedores_cod'];
			$proveedores_cod = utf8_decode($proveedores_cod);
			
			$usocontable = $_POST['usocontable'];
			$usocontable = utf8_decode($usocontable);	
			buscar_auditoria_de_compras_reportes($desde,$hasta,$proveedores_cod,$usocontable);
			
		}
		if($func=='buscar_auditoria_de_otros_ingresos_reportes'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);
				
			buscar_auditoria_de_otros_ingresos_reportes($desde,$hasta,$caja_cod);	
		}
		if($func=='buscar_auditoria_de_otros_egresos_reportes'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);
				
			buscar_auditoria_de_otros_egresos_reportes($desde,$hasta,$caja_cod);	
		}
        if($func=='buscar_auditoria_de_pagos_proveedores_creditos_reportes'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);
				
			buscar_auditoria_de_pagos_proveedores_creditos_reportes($desde,$hasta,$caja_cod);	
		}	
		if($func=='buscar_auditoria_de_cobranzas_reportes'){
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
				
			buscar_auditoria_de_cobranzas_reportes($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable);	
		}		
	    if($func=='buscar_auditoria_de_desembolsos_reportes'){
			$desde = $_POST['desde'];
			$desde = utf8_decode($desde);
				
			$hasta = $_POST['hasta'];
			$hasta = utf8_decode($hasta);	
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);
				
			buscar_auditoria_de_desembolsos_reportes($desde,$hasta,$caja_cod);	
		}		
	    if($func=='buscar_plan_prestamos'){
			
			$ventas_cod = $_POST['ventas_cod'];
			$ventas_cod = utf8_decode($ventas_cod);
				
			buscar_plan_prestamos($ventas_cod);	
		}		
	    if($func=='buscarfactura'){
			
			$ventas_cod = $_POST['ventas_cod'];
			$ventas_cod = utf8_decode($ventas_cod);
				
		     $letras = $_POST['letras'];
			$letras = utf8_decode($letras);
			
			buscarfactura($ventas_cod,$letras);	
		}
			
		}

function buscar_auditoria_de_desembolsos_reportes($desde,$hasta,$caja_cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
  
      $total=0;
     $totalcredito=0;
     $montototal=0;

 $datos='';
$control_datos="d";


$pagina1='';
$provee='';
$paginainicio='';
$filtro='';
$generalporfecha='none';
$sql='';
$total=0;
if($caja_cod=="TODOS"){
		$sql= "SELECT concat(da.nombre,' ',da.nro) as caja,de.fecha,v.nrofactura,v.nrosolicitud,concat('Desembolsado a ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
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
		$sql= "SELECT concat(da.nombre,' ',da.nro) as caja,de.fecha,v.nrofactura,v.nrosolicitud,concat('Desembolsado a ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido) as cliente,
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
			  $caja=utf8_encode($valor['caja']); 
if($caja_cod=="TODOS"){
$provee="TODOS";
}else{
$provee=$caja;
}
	  	 $cant=$cant+1;
	  	 $montototal=$montototal+$monto;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
 if($control_datos=="d"){
			$titulo_pagina="<tr style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Fecha</td>
									<td class='td_titulo' style='width:10%;font-weight: bold;text-align: center;' >Fac.No.</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Soli.No.</td>
									<td class='td_titulo' style='width: 30%;font-weight: bold;text-align: center;' >Cliente</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Monto</td>		
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Suc.</td>			
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Usuario</td>			
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Hora</td>			
				</tr>"; 		
		 }else{
			$titulo_pagina=''; 
		 }
		  $control_datos="x";
$pagina.=" ".$titulo_pagina." <tr ".$bacground.">
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
 
$paginainicio="<center>
	 <h1 class='h1' style='text-align:left;'>GRUPO FARGO EMPRESARIAL S.A</h1>
	 <h1 class='h2 h1' style='font-size:10px;text-align:left;'>".$sucursal."</h1>
     <h1 class='h1'>AUDITORIA DE DESEMBOLSOS</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Caja: ".$provee."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Desde: ".$desde."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Hasta: ".$hasta."</h1>
	 <section class='section'>
	 <!-- titulo del reporte -->

	<div>
                           <table style='background:#fff;padding-left:0px;' id='cnt_listado_para_Gestor' border='1' class='table_5_1' cellspacing='0' cellpadding='0'>
                            ".$pagina."
                            </table>
                            </div>

 
	 </section>
	 <div style='    width: 100%;padding: 10px 0px 10px 10px;display: table;'>
    <h1 class='h2 h1' style='font-size: 12px;font-weight: 900;text-align: end;'>Total General: ".number_format($montototal,'0',',','.')." Gs.</h1>
</div>
	 </center>"; 
	 
	 
$informacion =array("1" => $paginainicio);
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_de_cobranzas_reportes($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
  
      $total=0;
     $totalcredito=0;
     $montototal=0;

 $datos='';
$control_datos="d";


$pagina1='';
$provee='';
$provee1='';
$provee2='';
$paginainicio='';
$filtro='';
$generalporfecha='none';
$sql='';
$total=0;
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
  where c.estado='PAGADO' and v.nrofactura!=false and c.fecha>='".$desde."' and c.fecha<='".$hasta."' ";  
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
  where c.estado='PAGADO' and c.fecha>='".$desde."' and c.fecha<='".$hasta."' ";  	
		}
		
	 }
	 if ($caja_cod!="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod!="TODOS"){
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
where c.estado='PAGADO'  and v.nrofactura!=false and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'";  	
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
		 }

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
where c.estado='PAGADO'  and v.nrofactura!=false  and ca.datoscaja_cod='".$caja_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  	
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
where c.estado='PAGADO' and ca.datoscaja_cod='".$caja_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  	
		}
			 
	 }
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
where c.estado='PAGADO'  and v.nrofactura!=false  and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  
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
			 
	 }
	 if ($caja_cod=="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod!="TODOS"){
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
where c.estado='PAGADO'  and v.nrofactura!=false and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  	 
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
where c.estado='PAGADO' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";  	 	
		}
		
	 }
	 if ($caja_cod!="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod=="TODOS"){
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
where c.estado='PAGADO'  and v.nrofactura!=false and ca.datoscaja_cod='".$caja_cod."' and v.cobrador_cod='".$cobrador_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  "; 
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
		 	 
	 }
	 if ($caja_cod!="TODOS" && $cobrador_cod=="TODOS" && $usuarios_cod!="TODOS"){
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
where c.estado='PAGADO' and v.nrofactura!=false and ca.datoscaja_cod='".$caja_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  "; 
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
		 	 
	 }
	 if ($caja_cod=="TODOS" && $cobrador_cod!="TODOS" && $usuarios_cod!="TODOS"){
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
where c.estado='PAGADO' and v.nrofactura!=false and v.cobrador_cod='".$cobrador_cod."' and c.usuarios_cod='".$usuarios_cod."' and c.fecha>='".$desde."' and c.fecha<='".$hasta."'  ";
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
if($caja_cod=="TODOS"){
$provee="TODOS";
}else{
$provee=$caja;
}
if($cobrador_cod=="TODOS"){
$provee1="TODOS";
}else{
$provee1=$caja;
}
if($usuarios_cod=="TODOS"){
$provee2="TODOS";
}else{
$provee2=$caja;
}
	  	 $cant=$cant+1;
	  	 $montototal=$montototal+$monto;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
 if($control_datos=="d"){
			$titulo_pagina="<tr style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
                                 
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Fecha</td>
									<td class='td_titulo' style='width:6%;font-weight: bold;text-align: center;' >Rec.No.</td>
									<td class='td_titulo' style='width: 6%;font-weight: bold;text-align: center;' >Código.</td>
									<td class='td_titulo' style='width: 20%;font-weight: bold;text-align: center;' >Cliente</td>
									<td class='td_titulo' style='width: 4%;font-weight: bold;text-align: center;' >Cob.</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Fac.No</td>		
									<td class='td_titulo' style='width: 4%;font-weight: bold;text-align: center;' >Sc.</td>			
									<td class='td_titulo' style='width: 6%;font-weight: bold;text-align: center;' >Amortiz.</td>			
									<td class='td_titulo' style='width: 5%;font-weight: bold;text-align: center;' >Int.Fin</td>			
									<td class='td_titulo' style='width: 6%;font-weight: bold;text-align: center;' >Gts.Ad</td>			
									<td class='td_titulo' style='width: 6%;font-weight: bold;text-align: center;' >Int.Mora</td>			
									<td class='td_titulo' style='width: 7%;font-weight: bold;text-align: center;' >Total</td>			
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Usuario</td>			
				</tr>"; 		
		 }else{
			$titulo_pagina=''; 
		 }
		  $control_datos="x";
$pagina.=" ".$titulo_pagina." <tr  ".$bacground.">
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
 
$paginainicio="<center>
	 <h1 class='h1' style='text-align:left;'>GRUPO FARGO EMPRESARIAL S.A</h1>
	 <h1 class='h2 h1' style='font-size:10px;text-align:left;'>".$sucursal."</h1>
     <h1 class='h1'>AUDITORIA DE COBRANZAS</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Caja: ".$provee."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Cobrador: ".$provee1."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Desde: ".$desde."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Hasta: ".$hasta."</h1>
		<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Usuario: ".$provee2."</h1>
	 <section class='section'>
	 <!-- titulo del reporte -->

	<div>
                           <table style='background:#fff;padding-left:0px;'  border='1' class='table_5_1' cellspacing='0' cellpadding='0'>
                            ".$pagina."
                            </table>
						<table  style='width:100%;' border='1' class='table_5' cellspacing='0' cellpadding='0'>
		                ".buscar_auditoria_de_cobranzas_sucursales($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable)."
                        <table> 
						<table  style='width:100%;' border='1' class='table_5' cellspacing='0' cellpadding='0'>
		               ".buscar_auditoria_de_cobranzas_totales($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable)."
                        <table> 
		              
		              <table  style='width:100%;' border='1' class='table_5' cellspacing='0' cellpadding='0'>
		              ".buscar_auditoria_de_cobranzas_diarios_meses_semanas($desde,$hasta,$caja_cod,$cobrador_cod,$usuarios_cod,$usocontable)."
                      <table>
							
                            </div>

 
	 </section>
	 
	 </center>"; 
	 
	 
$informacion =array("1" => $paginainicio);
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
<tr ".$bacground." >
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

function buscar_auditoria_de_pagos_proveedores_creditos_reportes($desde,$hasta,$caja_cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
  
      $total=0;
     $totalcredito=0;
     $montototal=0;

 $datos='';
$control_datos="d";


$pagina1='';
$provee='';
$paginainicio='';
$filtro='';
$generalporfecha='none';
$sql='';
$total=0;
 if($caja_cod=="TODOS"){
		$sql= "SELECT p.fecha,p.nrofactura as nrorecibo,c.nrofactura,pr.cod,pr.nombre as proveedor,s.cod as cod_sucursal,concat(s.nombres,' ',s.numero) as sucursal1,concat(da.nombre,' ',da.nro) as caja,cu.monto,cu.interes,p.monto as total
 FROM pagos_cuotas_proveedores p
 join compras c on p.compras_cod=c.cod
 join cuoteros_compras_proveedores cu on p.cuoteros_compras_proveedores_cod=cu.cod
 join proveedores pr on c.proveedores_cod=pr.cod
 join usuarios u on p.usuarios_cod=u.cod
 join sucursales s on u.sucursales_cod=s.cod
 join caja ca on p.caja_cod=ca.cod
 join datoscaja da on ca.datoscaja_cod=da.cod
 where p.estado='PAGADO' and p.fecha>='".$desde."' and p.fecha<='".$hasta."' ";  
 } else {
		$sql= "SELECT p.fecha,p.nrofactura as nrorecibo,c.nrofactura,pr.cod,pr.nombre as proveedor,s.cod as cod_sucursal,concat(s.nombres,' ',s.numero) as sucursal1,concat(da.nombre,' ',da.nro) as caja,cu.monto,cu.interes,p.monto as total
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
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
              $fecha=utf8_encode($valor['fecha']);
			  $nrorecibo=utf8_encode($valor['nrorecibo']);
			  $nrofactura=utf8_encode($valor['nrofactura']); 
			  $cod=utf8_encode($valor['cod']); 
			  $proveedor=utf8_encode($valor['proveedor']); 
			  $sucursal1=utf8_encode($valor['sucursal1']); 
			  $cod_sucursal=utf8_encode($valor['cod_sucursal']); 
			  $caja=utf8_encode($valor['caja']); 
			  $monto=utf8_encode($valor['monto']); 
			  $interes=utf8_encode($valor['interes']); 
			  $total=utf8_encode($valor['total']); 
if($caja_cod=="TODOS"){
$provee="TODOS";
}else{
$provee=$caja;
}
	  	 $cant=$cant+1;
	  	 $montototal=$montototal+$monto;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
 if($control_datos=="d"){
			$titulo_pagina="<tr style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
                                 
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Fecha</td>
									<td class='td_titulo' style='width:10%;font-weight: bold;text-align: center;' >Rec.No.</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Código.</td>
									<td class='td_titulo' style='width: 20%;font-weight: bold;text-align: center;' >Proveedor</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Fac.No</td>		
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Suc.</td>			
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Importe</td>			
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Interes</td>			
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Total</td>			
				</tr>"; 		
		 }else{
			$titulo_pagina=''; 
		 }
		  $control_datos="x";
$pagina.=" ".$titulo_pagina." <tr  ".$bacground.">
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
 
$paginainicio="<center>
	 <h1 class='h1' style='text-align:left;'>GRUPO FARGO EMPRESARIAL S.A</h1>
	 <h1 class='h2 h1' style='font-size:10px;text-align:left;'>".$sucursal1."</h1>
     <h1 class='h1'>AUDITORIA DE PAGOS</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Caja: ".$provee."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Desde: ".$desde."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Hasta: ".$hasta."</h1>
	 <section class='section'>
	 <!-- titulo del reporte -->

	<div>
                           <table style='background:#fff;padding-left:0px;' id='cnt_listado_para_Gestor' border='1' class='table_5_1' cellspacing='0' cellpadding='0'>
                            ".$pagina."
                            </table>
                            </div>

 
	 </section>
	 <div style='    width: 100%;padding: 10px 0px 10px 10px;display: table;'>
    <h1 class='h2 h1' style='font-size: 12px;font-weight: 900;text-align: end;'>Total General: ".number_format($montototal,'0',',','.')." Gs.</h1>
</div>
	 </center>"; 
	 
	 
$informacion =array("1" => $paginainicio);
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_de_otros_egresos_reportes($desde,$hasta,$caja_cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
  
      $total=0;
     $totalcredito=0;
     $montototal=0;

 $datos='';
$control_datos="d";


$pagina1='';
$provee='';
$paginainicio='';
$filtro='';
$generalporfecha='none';
$sql='';
$total=0;
if($caja_cod=="TODOS"){
		$sql= "SELECT concat(s.nombres,' ',s.numero) as sucursal,concat(d.nombre,' ',d.nro) as caja,e.fecha,e.nro,e.cod,e.personas_cod,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as nombre,e.detalles,e.monto 
FROM otrosegresos e
 join personas p1 on e.personas_cod=p1.cod
 join caja c on e.caja_cod=c.cod
 join datoscaja d on c.datoscaja_cod=d.cod
 join usuarios u on  e.usuarios_cod=u.cod
 join sucursales s on u.sucursales_cod=s.cod
  where e.estado='ACTIVO' and e.fecha>='".$desde."' and e.fecha<='".$hasta."' ";  
	 }else{
		$sql= "SELECT concat(s.nombres,' ',s.numero) as sucursal,concat(d.nombre,' ',d.nro) as caja,e.fecha,e.nro,e.cod,e.personas_cod,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as nombre,e.detalles,e.monto 
FROM otrosegresos e
 join personas p1 on e.personas_cod=p1.cod
 join caja c on e.caja_cod=c.cod
 join datoscaja d on c.datoscaja_cod=d.cod
 join usuarios u on  e.usuarios_cod=u.cod
 join sucursales s on u.sucursales_cod=s.cod
  where e.estado='ACTIVO' and e.cod='".$caja_cod."' and e.fecha>='".$desde."' and e.fecha<='".$hasta."'  ";  
		 
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
		  	  $fecha=utf8_encode($valor['fecha']);
			  $nro=utf8_encode($valor['nro']);
			  $personas_cod=utf8_encode($valor['personas_cod']); 
			  $nombre=utf8_encode($valor['nombre']); 
			  $detalles=utf8_encode($valor['detalles']); 
			  $monto=utf8_encode($valor['monto']); 
			  $sucursal=utf8_encode($valor['sucursal']); 
			  $caja=utf8_encode($valor['caja']);
if($caja_cod=="TODOS"){
$provee="TODOS";
}else{
$provee=$caja;
}
	  	 $cant=$cant+1;
	  	 $montototal=$montototal+$monto;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
 if($control_datos=="d"){
			$titulo_pagina="<tr style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
                                 
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Fecha</td>
									<td class='td_titulo' style='width:10%;font-weight: bold;text-align: center;' >Rec.No.</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Código.</td>
									<td class='td_titulo' style='width: 30%;font-weight: bold;text-align: center;' >Nombre</td>
									<td class='td_titulo' style='width: 30%;font-weight: bold;text-align: center;' >Concepto</td>		
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Importe</td>			
				</tr>"; 		
		 }else{
			$titulo_pagina=''; 
		 }
		  $control_datos="x";
$pagina.=" ".$titulo_pagina." <tr  ".$bacground.">
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
 
$paginainicio="<center>
	 <h1 class='h1' style='text-align:left;'>GRUPO FARGO EMPRESARIAL S.A</h1>
	 <h1 class='h2 h1' style='font-size:10px;text-align:left;'>".$sucursal."</h1>
     <h1 class='h1'>AUDITORIA DE OTROS EGRESOS</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Caja: ".$provee."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Desde: ".$desde."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Hasta: ".$hasta."</h1>
	 <section class='section'>
	 <!-- titulo del reporte -->

	<div>
                           <table style='background:#fff;padding-left:0px;' id='cnt_listado_para_Gestor' border='1' class='table_5_1' cellspacing='0' cellpadding='0'>
                            ".$pagina."
                            </table>
                            </div>

 
	 </section>
	 <div style='    width: 100%;padding: 10px 0px 10px 10px;display: table;'>
    <h1 class='h2 h1' style='font-size: 12px;font-weight: 900;text-align: end;'>Total General: ".number_format($montototal,'0',',','.')." Gs.</h1>
</div>
	 </center>"; 
	 
	 
$informacion =array("1" => $paginainicio);
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_de_otros_ingresos_reportes($desde,$hasta,$caja_cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
  
      $total=0;
     $totalcredito=0;
     $montototal=0;

 $datos='';
$control_datos="d";


$pagina1='';
$provee='';
$paginainicio='';
$filtro='';
$generalporfecha='none';
$sql='';
$total=0;
		 if($caja_cod=="TODOS"){
		$sql= "SELECT concat(s.nombres,' ',s.numero) as sucursal,concat(d.nombre,' ',d.nro) as caja,o.cod,o.fecha,o.nro,o.conceptos_cod,o.personas_cod,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as Cliente,o.detalles,o.monto
 FROM otrosingresos o
 join personas p1 on o.personas_cod=p1.cod
 join caja c on o.caja_cod=c.cod
 join datoscaja d on c.datoscaja_cod=d.cod
join usuarios u on  o.usuarios_cod=u.cod
join sucursales s on u.sucursales_cod=s.cod
  where o.estado='ACTIVO' and o.fecha>='".$desde."' and o.fecha<='".$hasta."' ";  
	 }else{
		$sql= "SELECT concat(s.nombres,' ',s.numero) as sucursal,concat(d.nombre,' ',d.nro) as caja,o.cod,o.fecha,o.nro,o.conceptos_cod,o.personas_cod,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as Cliente,o.detalles,o.monto
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
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
              $cod=utf8_encode($valor['cod']);
		  	  $fecha=utf8_encode($valor['fecha']);
			  $nro=utf8_encode($valor['nro']);
			  $conceptos_cod=utf8_encode($valor['conceptos_cod']);
			  $personas_cod=utf8_encode($valor['personas_cod']); 
			  $Cliente=utf8_encode($valor['Cliente']); 
			  $detalles=utf8_encode($valor['detalles']); 
			  $monto=utf8_encode($valor['monto']); 
			  $sucursal=utf8_encode($valor['sucursal']); 
			  $caja=utf8_encode($valor['caja']);
if($caja_cod=="TODOS"){
$provee="TODOS";
}else{
$provee=$caja;
}
	  	 $cant=$cant+1;
	  	 $montototal=$montototal+$monto;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
 if($control_datos=="d"){
			$titulo_pagina="<tr style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
                                 
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Fecha</td>
									<td class='td_titulo' style='width:10%;font-weight: bold;text-align: center;' >Rec.No.</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Código.</td>
									<td class='td_titulo' style='width: 30%;font-weight: bold;text-align: center;' >Cliente</td>
									<td class='td_titulo' style='width: 30%;font-weight: bold;text-align: center;' >Concepto</td>		
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Importe</td>			
				</tr>"; 		
		 }else{
			$titulo_pagina=''; 
		 }
		  $control_datos="x";
$pagina.=" ".$titulo_pagina." <tr  ".$bacground.">
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
 
$paginainicio="<center>
	 <h1 class='h1' style='text-align:left;'>GRUPO FARGO EMPRESARIAL S.A</h1>
	 <h1 class='h2 h1' style='font-size:10px;text-align:left;'>".$sucursal."</h1>
     <h1 class='h1'>AUDITORIA DE OTROS INGRESOS</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Caja: ".$provee."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Desde: ".$desde."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Hasta: ".$hasta."</h1>
	 <section class='section'>
	 <!-- titulo del reporte -->

	<div>
                           <table style='background:#fff;padding-left:0px;' id='cnt_listado_para_Gestor' border='1' class='table_5_1' cellspacing='0' cellpadding='0'>
                            ".$pagina."
                            </table>
                            </div>

 
	 </section>
	 <div style='    width: 100%;padding: 10px 0px 10px 10px;display: table;'>
    <h1 class='h2 h1' style='font-size: 12px;font-weight: 900;text-align: end;'>Total General: ".number_format($montototal,'0',',','.')." Gs.</h1>
</div>
	 </center>"; 
	 
	 
$informacion =array("1" => $paginainicio);
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_de_compras_reportes($desde,$hasta,$proveedores_cod,$usocontable){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
  
      $total=0;
     $totalcredito=0;
     $totalcontado=0;

 $datos='';
$control_datos="d";


$pagina1='';
$provee='';
$paginainicio='';
$filtro='';
$generalporfecha='none';
$sql='';
$total=0;
	if($proveedores_cod=="TODOS"){
	
	 $sql= "SELECT concat(s.nombres,' ',s.numero) as sucursal,p.nombre as proveedor,c.cod,c.fechacompra,c.nrofactura,c.proveedores_cod,c.condicion,sum(ifnull(d.subtotal,0) ) as subtotal
FROM compras c 
join detalles_compras d on d.compras_cod=c.cod
join usuarios u on  c.usuarios_cod=u.cod
join sucursales s on u.sucursales_cod=s.cod
join proveedores p on c.proveedores_cod=p.cod
where c.estado='ACTIVO' and c.fechacompra>='".$desde."' and c.fechacompra<='".$hasta."' group by c.cod ";	

     
}else{

	$sql= "SELECT concat(s.nombres,' ',s.numero) as sucursal,p.nombre as proveedor,c.cod,c.fechacompra,c.nrofactura,c.proveedores_cod,c.condicion,sum(ifnull(d.subtotal,0) ) as subtotal
FROM compras c 
join detalles_compras d on d.compras_cod=c.cod
join usuarios u on  c.usuarios_cod=u.cod
join sucursales s on u.sucursales_cod=s.cod
join proveedores p on c.proveedores_cod=p.cod
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
		  	    $sucursal=utf8_encode($valor['sucursal']);
			    $condicion=utf8_encode($valor['condicion']);
			   
			    $subtotal=utf8_encode($valor['subtotal']);
			    $proveedor=utf8_encode($valor['proveedor']);
			   if($proveedores_cod=="TODOS"){
                 $provee="TODOS";
               }else{
                  $provee=$proveedor;
               }
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
 if($control_datos=="d"){
			$titulo_pagina="<table style='background:#fff;padding-left:0px;' id='cnt_listado_para_Gestor' border='1' class='table_5_1' cellspacing='0' cellpadding='0'><tr style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
                                 
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Fecha</td>
									<td class='td_titulo' style='width:10%;font-weight: bold;text-align: center;' >Fac.No.</td>
									<td class='td_titulo' style='width: 5%;font-weight: bold;text-align: center;' >Op.</td>
									<td class='td_titulo' style='width: 20%;font-weight: bold;text-align: center;' >Proveedor</td>
									<td class='td_titulo' style='width: 5%;font-weight: bold;text-align: center;' >Codigo</td>
									<td class='td_titulo' style='width: 30%;font-weight: bold;text-align: center;' >Detalle</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Cant.</td>			
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Importe</td>			
				</tr> </table>"; 		
		 }else{
			$titulo_pagina=''; 
		 }
$datos=buscar_auditoria_de_compras_sin_detalles($desde,$hasta,$proveedores_cod,$usocontable);
		  $control_datos="x";
$pagina.=" ".$titulo_pagina."". buscar_auditoria_detalles_de_compras($cod,$usocontable)."
";		  
   }
 }
 
$paginainicio="<center>
	 <h1 class='h1' style='text-align:left;'>GRUPO FARGO EMPRESARIAL S.A</h1>
	 <h1 class='h2 h1' style='font-size:10px;text-align:left;'>".$sucursal."</h1>
     <h1 class='h1'>AUDITORIA DE COMPRAS</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Proveedor: ".$provee."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Desde: ".$desde."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>Fecha Hasta: ".$hasta."</h1>
	 <section class='section'>
	 <!-- titulo del reporte -->

	<div>
                            ".$pagina."
                            </div>

 <div style='padding: 10px 0px 10px 10px;'>

							".$datos."
  
 </div>
 
	 </section>
	 <div style='    width: 100%;padding: 10px 0px 10px 10px;display: table;'>
    <h1 class='h2 h1' style='font-size: 12px;font-weight: 900;text-align: end;'>Total General Contado: ".number_format($totalcontado,'0',',','.')." Gs.</h1>
	<h1 class='h2 h1' style='font-size: 12px;font-weight: 900;text-align: end;'>Total General Credito: ".number_format($totalcredito,'0',',','.')." Gs.</h1>
	<h1 class='h2 h1' style='font-size: 12px;font-weight: 900;text-align: end;'>Total General: ".number_format($total,'0',',','.')." Gs.</h1>
</div>
	 </center>"; 
	 
	 
$informacion =array("1" => $paginainicio);
echo json_encode($informacion);	
exit;
}

function buscar_auditoria_de_compras_sin_detalles($desde,$hasta,$proveedores_cod,$usocontable){
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
return $pagina1;
}

function buscar_auditoria_detalles_de_compras($compras_cod,$usocontable){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $pag='';
	 $pag1='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
     $total=0;
     $totalcredito=0;
     $totalcontado=0;

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
$pagina.= $pag; 
   }
               if($usocontable=="SI"){
		       if($nrofactura==""){
		        $pag1="";
			   }else{
				   $pag1="<div style='width: 100%;    height: 28px; font-weight: 900;' class='table_gris'>
   <h1 class='h2 h1' style='font-size: 10px;font-weight: 900;
    width: 10%;
    text-align: center;
    float: right;'>".number_format($total,'0',',','.')." Gs.</h1>
</div>";
			   }
			   }else{
				   $pag1="<div style='width: 100%;    height: 28px; ' class='table_gris'>
   <h1 class='h2 h1' style='font-size: 10px;font-weight: 900;
   
    width: 10%;
    text-align: center;
    float: right;'>".number_format($total,'0',',','.')." Gs.</h1>
</div>";
			   }
   
   $titulo_pagina=$pagina."".$pag1;
 }

return $titulo_pagina;
}

function buscar_caja_actual_reporte($caja_cod){
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


$control_datos="d";


$pagina1='';
$paginainicio='';
$filtro='';
$generalporfecha='none';
$sql='';
$total=0;
	 $sql= "SELECT concat(s.nombres,' ',s.numero) as sucursal,cd.fecha,cd.nro,cd.cod,cd.descripcion,cd.ingreso,cd.egreso,cd.estado,concat(cd.caja_cod,' - ',da.nombre,' ',da.nro) as caja,c.montoapertura,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as apertura,c.fechaapertura,c.horaapertura,c.fechacierre,c.horacierre,cd.caja_cod 
FROM cajadiaria cd
join caja c on cd.caja_cod=c.cod
join usuarios u on c.usuarios_cod=u.cod
join personas p on u.personas_cod=p.cod
join sucursales s on u.sucursales_cod=s.cod
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
			    $caja=utf8_encode($valor['caja']);
			    $sucursal=utf8_encode($valor['sucursal']);
			    $cod=utf8_encode($valor['cod']);
			   
			    $descripcion=utf8_encode($valor['descripcion']);
			    $ingreso=utf8_encode($valor['ingreso']); 
			    $egreso=utf8_encode($valor['egreso']); 
			    $apertura=utf8_encode($valor['apertura']); 
			    $fechaapertura=utf8_encode($valor['fechaapertura']); 
			    $horaapertura=utf8_encode($valor['horaapertura']); 
			    $fechacierre=utf8_encode($valor['fechacierre']); 
			    $horacierre=utf8_encode($valor['horacierre']); 
				 $caja_cod=utf8_encode($valor['caja_cod']);
				$usuario_cierre=obtener_usuario_cierrecaja($caja_cod);
                $saldo=$saldo+($ingreso-$egreso);
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
 if($control_datos=="d"){
			$titulo_pagina="<tr style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
                                 
									<td class='td_titulo' style='width: 12.5%;font-weight: bold;text-align: center;' >Fecha</td>
									<td class='td_titulo' style='width:12.5%;font-weight: bold;text-align: center;' >No.Comp.</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >No.Int.</td>
									<td class='td_titulo' style='width: 35%;font-weight: bold;text-align: center;' >Detalle</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Ingreso</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Egreso</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Saldo</td>			
				</tr> "; 		
		 }else{
			$titulo_pagina=''; 
		 }
		  $control_datos="x";
$pagina.=" ".$titulo_pagina."
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
$paginainicio="<center>
	 <h1 class='h1' style='text-align:left;'>GRUPO FARGO EMPRESARIAL S.A</h1>
	 <h1 class='h2 h1' style='font-size:10px;text-align:left;'>".$sucursal."</h1>
     <h1 class='h1'>CIERRE DE CAJA</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>CAJA: ".$caja."</h1>
	<h1 class='h2 h1' style='font-size:10px;text-align:left;'>FECHA: ".$fecha1."</h1>

	 <section class='section'>
	 <!-- titulo del reporte -->

	<div><table style='background:#fff;padding-left:0px;' id='cnt_listado_para_Gestor' border='1' class='table_5_1' cellspacing='0' cellpadding='0'>
                            ".$pagina."
                            </table></div>

 <div style='padding: 10px 0px 10px 10px;'>
 	<table border='1' style='width:85%;float:right;' class='table_5_1' cellspacing='0' cellpadding='0'>
                            <thead style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
	                     	        <th class='td_detalles' style='width:30%;text-align:center;'  >Detalle</th>
									<th class='td_detalles' style='width:10%;text-align:center;' >Mn</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >Saldo Anterior</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >Ingreso Dia</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >Egreso Dia</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >Saldo Actual</th>						
					        </thead> 
							
							<thead style='width:100%;color: #000;border: solid 1px #808080;' class='table_5_1'>
	                     	        <th class='td_detalles' style='width:30%;text-align:center;'  >Efectivo</th>
									<th class='td_detalles' style='width:10%;text-align:center;' >Gs.</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >".number_format($montoapertura,'0',',','.')." Gs.</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >".number_format($totalingreso,'0',',','.')." Gs.</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >".number_format($totalegreso,'0',',','.')." Gs.</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >".number_format($saldoactual,'0',',','.')." Gs.</th>						
					        </thead>
     </table>
 </div>
 <div>
  <table style='width:100%;' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td style='width:50%;'>
        <div style='padding: 16px;'>   
         <header style='border-style: solid;border-width: 1px 1px 0px 1px;border-color: #cecece;'>
             <div  style='text-align:center;padding: 6px; background: #cecece;'>APERTURA</div>
         </header>
        <table style='width:100%;' border='0' cellspacing='0' cellpadding='0'>
           <tr>
              <td style='width:50%;'>
                  <div style='padding: 6px;border: solid 1px #cecece;height: 50px;'>
						<article>
						  <div>Hecho por:</div>
						</article>
						<article>
						  <div>".$apertura."</div>
						</article>
                    </div>
              </td>
              <td style='width:50%;background-color:#;'>
                  <div style='padding: 6px;border-style: solid;border-width: 1px 1px 1px 0px;border-color: #cecece;height: 50px;'>
						<article>
						  <div>Hora:</div>
						</article>
						<article>
						  <div>".$horaapertura."</div>
						</article>
	              </div>
              </td>
            </tr>
        </table>
        </div>
        </td>
        

  	   <td style='width:50%;'>
        <div style='padding: 16px;'>   
         <header style='border-style: solid;border-width: 1px 1px 0px 1px;border-color: #cecece;'>
             <div  style='text-align:center;padding: 6px; background: #cecece;'>CIERRE</div>
         </header>
        <table style='width:100%;' border='0' cellspacing='0' cellpadding='0'>
           <tr>
              <td style='width:50%;'>
                  <div style='padding: 6px;border: solid 1px #cecece;height: 50px;'>
						<article>
						  <div>Hecho por:</div>
						</article>
						<article>
						  <div>".$usuario_cierre."</div>
						</article>
                    </div>
              </td>
              <td style='width:25%;background-color:#;'>
                  <div style='padding: 6px;border-style: solid;border-width: 1px 1px 1px 0px;border-color: #cecece;height: 50px;'>
						<article>
						  <div>Fecha:</div>
						</article>
						<article>
						  <div>".$fechacierre."</div>
						</article>
	              </div>
              </td>
			   <td style='width:25%;background-color:#;'>
                  <div style='padding: 6px;border-style: solid;border-width: 1px 1px 1px 0px;border-color: #cecece;height: 50px;'>
						<article>
						  <div>Hora:</div>
						</article>
						<article>
						  <div>".$horacierre."</div>
						</article>
	              </div>
              </td>
            </tr>
        </table>
        </div>
        </td>
    </tr>
  </table>
</div>
	 </section>
	 </center>"; 
	 
	 
$informacion =array("1" => $paginainicio);
echo json_encode($informacion);	
exit;
}

function obtener_usuario_cierrecaja($caja_cod){
	$mysqli=conectar_al_servidor();
	 $cierre='';
		$sql= "SELECT concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as cierre 
from caja c 
join usuarios u on c.usuarios_cod_cierre=u.cod
join personas p on u.personas_cod=p.cod
where c.cod='".$caja_cod."'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $cierre=$valor['cierre'];  
	  }
 }
 return $cierre;
}

function buscar_planilla_caja_reportes($fecha,$resumen,$caja_cod,$lote) {
$mysqli=conectar_al_servidor();

 $pagina='';
	
$c=0;
	 $control="d";
     $saldo=0;
     $totalingreso=0;
     $totalegreso=0;
     $saldoactual=0;
     $montoapertura=0;


$cant=0;
$totaladminitracion=0;
$totalpropietario=0;
$pagina1='';
$paginainicio='';
$filtro='';
$generalporfecha='none';
$sql='';
$total=0;
$titulo_pagina="";
$control_datos="d";

if($resumen=="NO"){
	 $sql= "SELECT c.cod as cod_caja,cd.fecha,cd.nro,cd.cod,cd.descripcion,cd.ingreso,cd.egreso,cd.estado,concat(cd.caja_cod,' - ',da.nombre,' ',da.nro) as caja,c.montoapertura,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as apertura,c.fechaapertura,c.horaapertura,c.fechacierre ,c.horacierre ,cd.caja_cod 
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
		  	    $cod_caja=utf8_encode($valor['cod_caja']);
               $datea = date_create($fecha);
                $fecha1= date_format($datea,"d/m/Y");
			    $nro=utf8_encode($valor['nro']);
			    $cod=utf8_encode($valor['cod']);
			    $descripcion=utf8_encode($valor['descripcion']);
			    $ingreso=utf8_encode($valor['ingreso']); 
			    $egreso=utf8_encode($valor['egreso']);
               $apertura=utf8_encode($valor['apertura']); 
			    $fechaapertura=utf8_encode($valor['fechaapertura']); 
			    $horaapertura=utf8_encode($valor['horaapertura']); 
			    $fechacierre=utf8_encode($valor['fechacierre']); 
			    $horacierre=utf8_encode($valor['horacierre']); 
				 $caja_cod=utf8_encode($valor['caja_cod']);
				$usuario_cierre=obtener_usuario_cierrecaja($caja_cod);
		if($usuario_cierre==""){
			$usuario_cierre="SISTEMA AUTOMÁTICO";
		}				
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
  if($control_datos=="d"){
			$titulo_pagina="<tr style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
                                 
									<td class='td_titulo' style='width: 12.5%;font-weight: bold;text-align: center;' >Fecha</td>
									<td class='td_titulo' style='width:12.5%;font-weight: bold;text-align: center;' >No.Comp.</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >No.Int.</td>
									<td class='td_titulo' style='width: 35%;font-weight: bold;text-align: center;' >Detalle</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Ingreso</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Egreso</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Saldo</td>			
				</tr> "; 
					
		 }else{
			$titulo_pagina=''; 
		 }
		  $control_datos="x";
$pagina.=" ".$titulo_pagina."
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
	 $sql= "SELECT c.cod as cod_caja,cd.origen, cd.tipo,da.cod,cd.fecha,cd.nro,cd.cod,cd.descripcion,sum(cd.ingreso) as ingreso,sum(cd.egreso) as egreso,cd.estado,concat(cd.caja_cod,' - ',da.nombre,' ',da.nro) as caja,c.montoapertura 
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
		  	    $cod_caja=utf8_encode($valor['cod_caja']);
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
  if($control_datos=="d"){
			$titulo_pagina="<tr style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
                                 
									<td class='td_titulo' style='width: 12.5%;font-weight: bold;text-align: center;' >Fecha</td>
									<td class='td_titulo' style='width:12.5%;font-weight: bold;text-align: center;' >No.Comp.</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >No.Int.</td>
									<td class='td_titulo' style='width: 35%;font-weight: bold;text-align: center;' >Detalle</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Ingreso</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Egreso</td>
									<td class='td_titulo' style='width: 10%;font-weight: bold;text-align: center;' >Saldo</td>			
				</tr> "; 
					
		 }else{
			$titulo_pagina=''; 
		 }
		  $control_datos="x";
$pagina.=" ".$titulo_pagina."
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
$paginainicio="<center>
     <h1 class='h1'>PLANILLA DE CAJA</h1>
	</center>
	<center>
	 <section class='section'>
	 <!-- titulo del reporte -->
   <h1 style='width: 100px;font-size: 14px;float: left;'>LOTE ".$cod_caja."</h1>
   
   
	<div><table style='background:#fff;padding-left:0px;' id='cnt_listado_para_Gestor' border='1' class='table_5_1' cellspacing='0' cellpadding='0'>
                            ".$pagina."
                            </table></div>

     <div style='padding: 10px 0px 10px 10px;'>
 	<table border='1' style='width:85%;float:right;' class='table_5_1' cellspacing='0' cellpadding='0'>
                            <thead style='width:100%;background-color:#cecece;color: #000;border: solid 1px #808080;' class='table_5_1'>
	                     	        <th class='td_detalles' style='width:30%;text-align:center;'  >Detalle</th>
									<th class='td_detalles' style='width:10%;text-align:center;' >Mn</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >Saldo Anterior</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >Ingreso Dia</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >Egreso Dia</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >Saldo Actual</th>						
					        </thead> 
							
							<thead style='width:100%;color: #000;border: solid 1px #808080;' class='table_5_1'>
	                     	        <th class='td_detalles' style='width:30%;text-align:center;'  >Efectivo</th>
									<th class='td_detalles' style='width:10%;text-align:center;' >Gs.</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >".number_format($montoapertura,'0',',','.')." Gs.</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >".number_format($totalingreso,'0',',','.')." Gs.</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >".number_format($totalegreso,'0',',','.')." Gs.</th>						
									<th class='td_detalles' style='width:15%;text-align:center;' >".number_format($saldoactual,'0',',','.')." Gs.</th>						
					        </thead>
     </table>
 </div>
 <div>
  <table style='width:100%;' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td style='width:50%;'>
        <div style='padding: 16px;'>   
         <header style='border-style: solid;border-width: 1px 1px 0px 1px;border-color: #cecece;'>
             <div  style='text-align:center;padding: 6px; background: #cecece;'>APERTURA</div>
         </header>
        <table style='width:100%;' border='0' cellspacing='0' cellpadding='0'>
           <tr>
              <td style='width:50%;'>
                  <div style='padding: 6px;border: solid 1px #cecece;height: 50px;'>
						<article>
						  <div>Hecho por:</div>
						</article>
						<article>
						  <div>".$apertura."</div>
						</article>
                    </div>
              </td>
              <td style='width:50%;background-color:#;'>
                  <div style='padding: 6px;border-style: solid;border-width: 1px 1px 1px 0px;border-color: #cecece;height: 50px;'>
						<article>
						  <div>Hora:</div>
						</article>
						<article>
						  <div>".$horaapertura."</div>
						</article>
	              </div>
              </td>
            </tr>
        </table>
        </div>
        </td>
        

  	   <td style='width:50%;'>
        <div style='padding: 16px;'>   
         <header style='border-style: solid;border-width: 1px 1px 0px 1px;border-color: #cecece;'>
             <div  style='text-align:center;padding: 6px; background: #cecece;'>CIERRE</div>
         </header>
        <table style='width:100%;' border='0' cellspacing='0' cellpadding='0'>
           <tr>
              <td style='width:50%;'>
                  <div style='padding: 6px;border: solid 1px #cecece;height: 50px;'>
						<article>
						  <div>Hecho por:</div>
						</article>
						<article>
						  <div>".$usuario_cierre."</div>
						</article>
                    </div>
              </td>
              <td style='width:25%;background-color:#;'>
                  <div style='padding: 6px;border-style: solid;border-width: 1px 1px 1px 0px;border-color: #cecece;height: 50px;'>
						<article>
						  <div>Fecha:</div>
						</article>
						<article>
						  <div>".$fechacierre."</div>
						</article>
	              </div>
              </td>
			   <td style='width:25%;background-color:#;'>
                  <div style='padding: 6px;border-style: solid;border-width: 1px 1px 1px 0px;border-color: #cecece;height: 50px;'>
						<article>
						  <div>Hora:</div>
						</article>
						<article>
						  <div>".$horacierre."</div>
						</article>
	              </div>
              </td>
            </tr>
        </table>
        </div>
        </td>
    </tr>
  </table>
</div>
	 </section>
	 </center>"; 

$informacion =array("1" => $paginainicio);
echo json_encode($informacion);	
exit;
}
	
function pagare($nrosolicitud,$montoletras) {
$mysqli=conectar_al_servidor();
$pagina1='';
$sql='';
$cant=0;

  $sql= "SELECT v.nrosolicitud,((v.monto)+(c.interesfinanciero*count(c.plazo)))as totalcuota,p.cedula,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as cliente
FROM ventas v 
join cuoteros c on c.ventas_cod=v.cod
join personas p on v.clientes_cod=p.cod
where v.nrosolicitud='$nrosolicitud' and v.estado='ACTIVO'"; 

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
		    $nrosolicitud=$valor['nrosolicitud'];  
		    $cedula=$valor['cedula'];  
		    $cliente=$valor['cliente'];  
			$totalcuota1=utf8_encode($valor['totalcuota']);
			$totalcuota=number_format($totalcuota1,'0',',','.');	   
            $cant=$cant+1;
   }
  $pagina1.="<div style='padding: 20px;border-top: solid 1px #717171;border-left: solid 1px #717171;border-right: solid 1px #717171;' >
	 <div style='width:100%;    width: 100%;font-size: 9px;font-family: arial;font-weight: bold;'>
	<BR>
	<center><h1 style='font-size: 20px;letter-spacing: 11px;'>PAGARE A LA ORDEN</h1></center>
	 </div>
	 <div style='width: 100%;height: 30px;'>
	 <center>
	 <table style='width:98%;'>
	 <tr>
	 <td style='width:70%;'>
	 
	 </td>
	 <td style='width:30%;'>

	 <div style='float: right;    width: 150px;
    height: 35px;
    background-color: #cecece;' class='div1'><div id='inp_monto_pagare' style='text-align: center;color: #000;font-family: monospace;font-size: 16px;font-weight: bold;width: 100%;'>".$totalcuota.".=</div></div>
	 <div style='float: right;width: 30px;
    height:35px;' class='div1'>Gs.</div>
	  </td> 
	 </tr>
	 </table>
	 </center>
	 </div>

	 <center>
<p  class='p1' style='line-height: 12pt;font-size: 12px;' >Vencimiento:</p>
<p class='p1' style='line-height: 20pt;font-size: 12px;'>El día<span style='text-align: center;color:transparent;font-family: monospace;font-size: 14px;font-weight: bold;width: 272px;height: 35px;'>pagaré (mos) solidariamente libre de gastos </span>pagaré (mos) solidariamente libre de gastos y sin protesto,
a la orden de 
 <span style='    text-align: center;
    color: #000;
    font-family: monospace;
    font-size: 16px;
    font-weight: bold;
	line-height: 20pt;
    width: 272px;
    height: 35px;
    background-color: #cecece;'>GRUPO FARGO EMPRESARIAL S.A--------------------------------</span> ,la suma de <span id='inp_montoletra_pagare' style='    text-align: center;
    color: #000;
    font-family: monospace;
    font-size: 16px;
    font-weight: bold;
    width: 272px;
	line-height: 12pt;
    height: 35px;
    background-color: #cecece;'>".$montoletras."-----------------------</span></p></center>

<center><p class='p1' style='line-height: 12pt;font-size: 12px;'>Por igual valor recibido en efectivo a mi (nuestra) entera satisfacción. La mora se producirá por el mero vencimiento
del plazo arriba indicado, sin necesidad de protesto ni de ningún requerimiento judicial o extrajudicial por parte del
acreedor. La falta de pago de una cuota a su vencimiento originará automáticamente el decaimiento de los plazos
señalados en este y los demás documentos, produciéndose de pleno derecho el vencimiento anticipado de las
cuotas no vencidas y cualquier otro documento obligacional que obrare en poder del acreedor pudiendo exigir el
pago inmediato del saldo total de la deuda, es obligación del (los) deudor (es) pagar un interés moratorio de %
por el tiempo de la mora hasta el pago total de este documento, además de un interés punitorio equivalente al %
sobre el interés moratorio. El pago de los intereses moratorios y punitorios no implicaran novación, prórroga,espera
o extinción de la obligación principal. Este pagaré se rige por las leyes de la República del Paraguay y en especial
por los artículos 51, 53 siguientes y concordantes de la ley 489/95. El simple vencimiento de una cuota autoriza al
acreedor de forma irrevocable a la consulta e inclusión a la base de datos de INFORMCONF u otra agencia de
informaciones. A todos los efectos legales y procesales queda aceptada la jurisdicción y competencia de los
juzgados en lo civil y comercial de la Circunscripción Judicial Guairá.................................................................................</p></center>



</div>




	<div style='padding: 20px;border: solid 1px #717171;' >
	 <center>
	 <table style='width:98%;'>
	 <tr>
	 <td style='width:50%;'>
	 <div style='float:left;color:#000;font-family: monospace;font-size: 12px;font-weight: bold;line-height: 17pt;'>DEUDOR:	 <span  style='font-family: arial;font-size: 12px;font-weight: 100;'>".$cliente."</span></div>
	 <div style='float:left;font-family: monospace;font-size: 12px;font-weight:100;line-height: 17pt;color:transparent;width: 200px;'>C.I.No:	 <span  style='color:#000;font-family: arial;font-size: 12px;font-weight: 100;'>C.I.No: ".$cedula."</span></div>
	 </td>
	 <td style='width:50%;'>
     <span style='text-align: center;color:#000;font-family: monospace;font-size: 12px;font-weight: bold;line-height: 17pt;'></span>
	  <div style='float:left;color:#000;font-family: monospace;font-size: 12px;font-weight: bold;line-height: 17pt;width: 300px;'>CONYUGE/OTRO:	 </div>
	  <div style='float:left;color:transparent;font-family: monospace;font-size: 12px;font-weight: 100;line-height: 17pt;width: 200px;'>..</div>
	  </td> 
	 </tr>
	 <tr>
	 <td style='width:50%;'>
	 <div style='float:left;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;padding-top: 35px;'>Firma:--------------------------------------------------------- </div>
	 </td>
	 <td style='width:50%;'>
     <span style='float:left;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;padding-top: 35px;'>Firma:----------------------------------------------------------</span>
	  </td> 
	 </tr>
	 <tr>
	 <td style='width:50%;'>
	 <div style='float:left;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>Aclaración:--------------------------------------------------</div>

	 </td>
	 <td style='width:50%;'>
     <span style='text-align: center;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>Aclaración:---------------------------------------------------</span>
	  </td> 
	 </tr>
	 <tr>
	 <td style='width:50%;'>
	 <div style='float:left;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>C.I.No:-------------------------------------------------------- </div>
	 </td>
	 <td style='width:50%;'>
     <span style='text-align: center;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>C.I.No:----------------------------------------------------------</span>
	  </td> 
	 </tr>
	  <td style='width:50%;'>
	 <span style='text-align: center;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>Domicilio:--------------------------------------------------- </span>
	 </td>
	 <td style='width:50%;'>
     <span style='text-align: center;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>Domicilio:----------------------------------------------------</span>
	  </td> 
	 </tr>
	 </table>
	 </center>
	</div>	
	<div style='padding: 20px;border-bottom: solid 1px #717171;border-left: solid 1px #717171;border-right: solid 1px #717171;' >
	 <center>
	 <table style='width:98%;'>
	 <tr>
	 <td style='width:50%;'>
	 <div style='float:left;color:#000;font-family: monospace;font-size: 12px;font-weight: bold;line-height: 17pt;'>CO-DEUDOR:</div>
	<!--  <div style='float:left;font-family: arial;font-size: 12px;text-align: justify;line-height: 17pt;'>AGULAR TOLEDO BLANCA REGINA</div> -->
	 </td>
	 <td style='width:50%;'>
     <span style='text-align: center;color:#000;font-family: monospace;font-size: 12px;font-weight: bold;line-height: 17pt;'>CONYUGE/OTRO:</span>
	  </td> 
	 </tr>
	 <tr>
	 <td style='width:50%;'>
	 <div style='float:left;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;padding-top: 35px;'>Firma:------------------------------------------------------------- </div>
	 </td>
	 <td style='width:50%;'>
     <span style='float:left;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;padding-top: 35px;'>Firma:------------------------------------------------------------- </span>
	  </td> 
	 </tr>
	 <tr>
	 <td style='width:50%;'>
	 <div style='float:left;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>Aclaración:------------------------------------------------------- </div>
	 </td>
	 <td style='width:50%;'>
     <span style='text-align: center;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>Aclaración:------------------------------------------------------- </span>
	  </td> 
	 </tr>
	 <tr>
	 <td style='width:50%;'>
	 <div style='float:left;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>C.I.No:------------------------------------------------------------- </div>
	 </td>
	 <td style='width:50%;'>
     <span style='text-align: center;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>C.I.No:------------------------------------------------------------- </span>
	  </td> 
	 </tr>
	  <td style='width:50%;'>
	 <span style='text-align: center;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>Domicilio:------------------------------------------------------- </span>
	 </td>
	 <td style='width:50%;'>
     <span style='text-align: center;color:#000;font-family: arial;font-size: 12px;line-height: 17pt;'>Domicilio:------------------------------------------------------- </span>
	  </td> 
	 </tr>
	 </table>
	 </center>
	</div>
";  
 
}
 
$informacion1 =array("1" => $pagina1);
echo json_encode($informacion1);	
exit;

}
 
/* function recibo($nrorecibo,$montoletras) {
$mysqli=conectar_al_servidor();
$pagina1='';
$base64='data:image/png;base64,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';
$detalles1='';
$detalles2='';
$paginainicio='';
$sql='';
$cant=0;
$totalmonto=0;
$totalinteres=0;
$totaltotaldescuento=0;
$resultadomonto=0;

  $sql= "SELECT case
WHEN v.condicion='DIAS' then 'DIARIO'
WHEN v.condicion='SEMANAL' then 'SEMANAL'
WHEN v.condicion='MENSUAL' then 'MENSUAL'
WHEN v.condicion='QUINCENAL' then 'QUINCENAL'
END as condicioncobrador,concat( date_format(c.fecha, '%d'),' de ',case
WHEN date_format(c.fecha, '%m')=01 then 'ENERO'
WHEN date_format(c.fecha, '%m')=02 then 'FEBRERO'
WHEN date_format(c.fecha, '%m')=03 then 'MARZO'
WHEN date_format(c.fecha, '%m')=04 then 'ABRIL'
WHEN date_format(c.fecha, '%m')=05 then 'MAYO'
WHEN date_format(c.fecha, '%m')=06 then 'JUNIO'
WHEN date_format(c.fecha, '%m')=07 then 'JULIO'
WHEN date_format(c.fecha, '%m')=08 then 'AGOSTO'
WHEN date_format(c.fecha, '%m')=09 then 'SEPTIEMBRE'
WHEN date_format(c.fecha, '%m')=10 then 'OCTUBRE'
WHEN date_format(c.fecha, '%m')=11 then 'NOVIEMBRE'
WHEN date_format(c.fecha, '%m')=12 then 'DICIEMBRE'
END,' de ',date_format(c.fecha, '%Y')) as fechapagos,c1.ciudades,b.barrios,s.direccion,s.telefono,s.ruc,(select p2.cedula from personas p2 where p2.cod=v.clientes_cod) as cedulacliente,(select concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) from personas p1 where p1.cod=v.clientes_cod) as cliente,concat(p3.primernombre,' ',p3.segundonombre,' ',p3.primerapellido,' ',p3.segundoapellido,' ',p3.apellidocasada) as cobrador
,v.nrofactura,c.nrocomprobante,c.ventas_cod,concat(s.nombres,' ',s.numero) as sucursal,
concat(d.nombre,' ',d.nro) as caja,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as usuario,
cu.plazo as cuota,ifnull(c.monto,'0')-cu.totalinteres as monto,cu.totalinteres,ifnull(c.descuento,'0') as descuento,
ifnull(c.monto,'0') as montointeres,c.fecha as fechacobros,c.hora as horacobro
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join usuarios u on c.usuarios_cod=u.cod
join personas p on u.personas_cod=p.cod
join usuarios u1 on v.cobrador_cod=u1.cod
join personas p3 on u1.personas_cod=p3.cod
join cuoteros cu on cu.cod=c.cuoteros_cod
join caja ca on c.caja_cod=ca.cod
join datoscaja d on ca.datoscaja_cod=d.cod
join sucursales s on d.sucursales_cod=s.cod
join barrios b on s.barrios_cod=b.cod
join ciudades c1 on b.ciudades_idciudades=c1.idciudades
where  c.nrocomprobante='".$nrorecibo."' and c.estado='PAGADO' order by c.cod asc "; 

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
			$condicioncobrador=utf8_encode($valor['condicioncobrador']);
			$montointeres=utf8_encode($valor['montointeres']);
			$cobrador=utf8_encode($valor['cobrador']);
			$ventas_cod=utf8_encode($valor['ventas_cod']);
			$fechapagos=utf8_encode($valor['fechapagos']);
			$ciudades=utf8_encode($valor['ciudades']);
			$barrios=utf8_encode($valor['barrios']);
			$direccion=utf8_encode($valor['direccion']);
			$telefono=utf8_encode($valor['telefono']);
			$ruc=utf8_encode($valor['ruc']);
			$cedulacliente=utf8_encode($valor['cedulacliente']);
			$cliente=utf8_encode($valor['cliente']);
			$nrofactura=utf8_encode($valor['nrofactura']);
			$nrocomprobante=utf8_encode($valor['nrocomprobante']);
			$sucursal=utf8_encode($valor['sucursal']);
			$caja=utf8_encode($valor['caja']);
			$cajero=utf8_encode($valor['usuario']);
			$cuota=utf8_encode($valor['cuota']);
			$monto1=utf8_encode($valor['monto']);
			$monto=number_format($monto1,'0',',','.');	
			$totalinteres1=utf8_encode($valor['totalinteres']);
			$totalinteres=number_format($totalinteres1,'0',',','.');
			$descuento1=utf8_encode($valor['descuento']);
			$descuento=number_format($descuento1,'0',',','.');	 
            $fechacobro1=utf8_encode($valor['fechacobros']);
            $datea = date_create($fechacobro1);
            $fecha= date_format($datea,"d/m/Y");  
            $horacobro=utf8_encode($valor['horacobro']);  
            $cuotac=obtener_cantidad_cuota($ventas_cod);
            $cant=$cant+1;
            $totalmonto=intVal($totalmonto)+intVal($montointeres);
          $resultadomonto1=number_format($totalmonto,'0',',','.');	
  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
if($cant>=1 && $cant<=10){

$detalles1.="<tr ".$bacground.">
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >".$cuota."/".$cuotac."</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >".$fecha."</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >".$monto."</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >".$totalinteres."</td>
			   <td style='width:20%;text-align:center;border-bottom: solid 1px #cecece;' >".$descuento."</td>
			</tr>";
} else if($cant>=11 && $cant<=20){
$detalles2.="<tr ".$bacground.">
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >".$cuota."/".$cuotac."</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >".$fecha."</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >".$monto."</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >".$totalinteres."</td>
			   <td style='width:20%;text-align:center;border-bottom: solid 1px #cecece;' >".$descuento."</td>
			</tr>";
} 
   }
  $paginainicio="
<div style='width: 100%;'>

<div style='padding-bottom: 15px;border-bottom: solid 2px #cecece; border-bottom-style: dashed;' >
     <img style='width: 100%;height: 60px;' src='".$base64."'>
    <div style='float:left;width:100%;' class='div1'>
		 <span style='float:left;color:#000;font-size: 12px;font-weight: bold;font-family: arial;'>RUC: ".$ruc."</span>
	     <span style='float:left;color:#000;font-size: 12px;font-family: arial;;'>&nbsp;&nbsp;&nbsp;&nbsp;Tel ".$telefono."</span>
    </div>
    <div style='float:left;width:100%;display: block;' class='div1'>
		 <div style='width:200px;float:left;color:#000;font-size: 12px;font-family: arial;'>".$direccion." - ".$barrios." ".$ciudades."</div>
         <div style='width:100px;float:right;color:#000;font-size: 16px;text-align:right;font-family: arial;'>Nro.  ".$nrocomprobante." </div>
    </div>
	 <div style='width: 100%;'>
	 <center>
	 <table style='width:100%;'>
	 <tr>
	 <td style='width:70%;'>
	 <center><h1 style='font-size: 14px;text-align:right;letter-spacing: 9px;font-family: -webkit-pictograph;'>RECIBO DE DINERO</h1></center>
	 </td>
	 <td style='width:30%;'>

	 <div style='float:right;width:150px;background-color: #cecece;' class='div1'>
	    <div id='inp_monto_pagare' style='text-align: center;color: #000;font-family:monospace;font-size: 16px;font-weight: bold;width:100%;'>".$resultadomonto1.".==</div>
	 </div>
	 <div style='float:right;width: 30px;' class='div1'>Gs.</div>
	  </td> 
	 </tr>
	 </table>
	 </center>
	 </div>
     <div class='p1'>Recibimos de <span style='text-align: center;color: #000;font-family: monospace;font-size: 14px;font-weight: bold;width: 272px;background-color: #cecece;'>".$cliente.".--------------</span> C.I. ".$cedulacliente." </div>
    <div class='p1'>La suma de <span  style='text-align: center;color: #000;font-family: monospace;font-size:14px;font-weight: bold;width: 272px;background-color: #cecece;'>".$montoletras.".--------------------</span></div>
     <div class='p1'>En concepto de pago a cuenta factura ".$nrofactura.", ".$sucursal." Según detalle:</div>
    <table style='width:100%;height: 200px; margin-top: 5px;margin-bottom: 5px;' border='0' cellspacing='0' cellpadding='0' >
    <tr>
       <td style='width:50%;'>
<div style='width:99%;height: 100%;float:left;border: solid 1px #cecece;'>
        <table class='p1' style='width:100%;' border='0' cellspacing='0' cellpadding='0' >
			 <tr style='background: #e6e5e5;'>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Cuota</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Vencimiento</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Importe</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Interes</td>
			   <td style='width:20%;text-align:center;border-bottom: solid 1px #cecece;' >Descuento</td>
			</tr>
         ".$detalles1."
        </table>
</div>
       </td>
       <td style='width:50%;' >

<div style='width:99%;height: 100%;float:right;border: solid 1px #cecece;'>
        <table class='p1' style='width:100%;' border='0' cellspacing='0' cellpadding='0' >
			<tr style='background: #e6e5e5;'>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Cuota</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Vencimiento</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Importe</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Interes</td>
			   <td style='width:20%;text-align:center;border-bottom: solid 1px #cecece;' >Descuento</td>
			</tr>
      ".$detalles2." 
        </table>
</div>

       </td>
    </tr>
    </table>
 <div class='p1'>".$ciudades.", ".$fechapagos.",.- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ".$horacobro."</div>
	 <div class='p1'>
		<div style='width:50%;float:left;'>Cobrador: ".$cobrador." - ".$condicioncobrador."</div>
		<div style='width:50%;float:right;text-align:center;'>________________________________</div>
	 </div>
     <div class='p1'>
		<div style='width:50%;font-size: 11px;float:left;'> <span style='float:left;color:#000;font-size: 11px;font-weight: bold;font-family: arial;'>Nota:</span>Recibo válido con firma y sello autorizado por la Empresa.</div>
		<div style='width:50%;float:right;text-align:center;'>Recibido por ".$cajero."</div>
	 </div>
     <div class='p1' style='font-size: 11px;'>Conserve su comprobante.</div>

</div>













<div style='margin-top:20px;' >
    
<div style='padding-bottom: 15px;' >
     <img style='width: 100%;height: 60px;' src='".$base64."'>
    <div style='float:left;width:100%;' class='div1'>
		 <span style='float:left;color:#000;font-size: 12px;font-weight: bold;font-family: arial;'>RUC: ".$ruc."</span>
	     <span style='float:left;color:#000;font-size: 12px;font-family: arial;;'>&nbsp;&nbsp;&nbsp;&nbsp;Tel ".$telefono."</span>
    </div>
    <div style='float:left;width:100%;display: block;' class='div1'>
		 <div style='width:200px;float:left;color:#000;font-size: 12px;font-family: arial;'>".$direccion." - ".$barrios." ".$ciudades."</div>
         <div style='width:100px;float:right;color:#000;font-size: 16px;text-align:right;font-family: arial;'>Nro.  ".$nrocomprobante." </div>
    </div>
	 <div style='width: 100%;'>
	 <center>
	 <table style='width:100%;'>
	 <tr>
	 <td style='width:70%;'>
	 <center><h1 style='font-size: 14px;text-align:right;letter-spacing: 9px;font-family: -webkit-pictograph;'>RECIBO DE DINERO</h1></center>
	 </td>
	 <td style='width:30%;'>

	 <div style='float:right;width:150px;background-color: #cecece;' class='div1'>
	    <div id='inp_monto_pagare' style='text-align: center;color: #000;font-family:monospace;font-size: 16px;font-weight: bold;width:100%;'>".$resultadomonto1.".==</div>
	 </div>
	 <div style='float:right;width: 30px;' class='div1'>Gs.</div>
	  </td> 
	 </tr>
	 </table>
	 </center>
	 </div>
     <div class='p1'>Recibimos de <span style='text-align: center;color: #000;font-family: monospace;font-size: 14px;font-weight: bold;width: 272px;background-color: #cecece;'>".$cliente.".--------------</span> C.I. ".$cedulacliente." </div>
    <div class='p1'>La suma de <span  style='text-align: center;color: #000;font-family: monospace;font-size:14px;font-weight: bold;width: 272px;background-color: #cecece;'>".$montoletras.".--------------------</span></div>
     <div class='p1'>En concepto de pago a cuenta factura ".$nrofactura.", ".$sucursal." Según detalle:</div>
    <table style='width:100%;height: 200px; margin-top: 5px;margin-bottom: 5px;' border='0' cellspacing='0' cellpadding='0' >
    <tr>
       <td style='width:50%;'>
<div style='width:99%;height: 100%;float:left;border: solid 1px #cecece;'>
        <table class='p1' style='width:100%;' border='0' cellspacing='0' cellpadding='0' >
			 <tr style='background: #e6e5e5;'>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Cuota</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Vencimiento</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Importe</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Interes</td>
			   <td style='width:20%;text-align:center;border-bottom: solid 1px #cecece;' >Descuento</td>
			</tr>
         ".$detalles1."
        </table>
</div>
       </td>
       <td style='width:50%;' >

<div style='width:99%;height: 100%;float:right;border: solid 1px #cecece;'>
        <table class='p1' style='width:100%;' border='0' cellspacing='0' cellpadding='0' >
			<tr style='background: #e6e5e5;'>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Cuota</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Vencimiento</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Importe</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;' >Interes</td>
			   <td style='width:20%;text-align:center;border-bottom: solid 1px #cecece;' >Descuento</td>
			</tr>
      ".$detalles2." 
        </table>
</div>

       </td>
    </tr>
    </table>
 <div class='p1'>".$ciudades.", ".$fechapagos.",.- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ".$horacobro."</div>
	 <div class='p1'>
		<div style='width:50%;float:left;'>Cobrador: ".$cobrador." - ".$condicioncobrador."</div>
		<div style='width:50%;float:right;text-align:center;'>________________________________</div>
	 </div>
     <div class='p1'>
		<div style='width:50%;font-size: 11px;float:left;'> <span style='float:left;color:#000;font-size: 11px;font-weight: bold;font-family: arial;'>Nota:</span>Recibo válido con firma y sello autorizado por la Empresa.</div>
		<div style='width:50%;float:right;text-align:center;'>Recibido por ".$cajero."</div>
	 </div>
     <div class='p1' style='font-size: 11px;'>Conserve su comprobante.</div>

</div>

";  
 
}
 
$informacion1 =array("1" => $paginainicio);
echo json_encode($informacion1);	
exit;

}
  */

function recibo($nrorecibo,$montoletras) {
$mysqli=conectar_al_servidor();
$pagina1='';
$base64='data:image/png;base64,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';
$detalles1='';
$detalles2='';
$paginainicio='';
$sql='';
$cant=0;
$totalmonto=0;
$totalinteres=0;
$totaltotaldescuento=0;
$resultadomonto=0;

  $sql= "SELECT case
WHEN v.condicion='DIAS' then 'DIARIO'
WHEN v.condicion='SEMANAL' then 'SEMANAL'
WHEN v.condicion='MENSUAL' then 'MENSUAL'
WHEN v.condicion='QUINCENAL' then 'QUINCENAL'
END as condicioncobrador,concat( date_format(c.fecha, '%d'),' de ',case
WHEN date_format(c.fecha, '%m')=01 then 'ENERO'
WHEN date_format(c.fecha, '%m')=02 then 'FEBRERO'
WHEN date_format(c.fecha, '%m')=03 then 'MARZO'
WHEN date_format(c.fecha, '%m')=04 then 'ABRIL'
WHEN date_format(c.fecha, '%m')=05 then 'MAYO'
WHEN date_format(c.fecha, '%m')=06 then 'JUNIO'
WHEN date_format(c.fecha, '%m')=07 then 'JULIO'
WHEN date_format(c.fecha, '%m')=08 then 'AGOSTO'
WHEN date_format(c.fecha, '%m')=09 then 'SEPTIEMBRE'
WHEN date_format(c.fecha, '%m')=10 then 'OCTUBRE'
WHEN date_format(c.fecha, '%m')=11 then 'NOVIEMBRE'
WHEN date_format(c.fecha, '%m')=12 then 'DICIEMBRE'
END,' de ',date_format(c.fecha, '%Y')) as fechapagos,c1.ciudades,b.barrios,s.direccion,s.telefono,s.ruc,(select p2.cedula from personas p2 where p2.cod=v.clientes_cod) as cedulacliente,(select concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) from personas p1 where p1.cod=v.clientes_cod) as cliente,concat(p3.primernombre,' ',p3.segundonombre,' ',p3.primerapellido,' ',p3.segundoapellido,' ',p3.apellidocasada) as cobrador
,v.nrofactura,c.nrocomprobante,c.ventas_cod,concat(s.nombres,' ',s.numero) as sucursal,
concat(d.nombre,' ',d.nro) as caja,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as usuario,
cu.plazo as cuota,ifnull(c.monto,'0')-cu.totalinteres as monto,cu.totalinteres,ifnull(c.descuento,'0') as descuento,
ifnull(c.monto,'0') as montointeres,c.fecha as fechacobros,c.hora as horacobro
FROM cobroscuotasclientes c
join ventas v on c.ventas_cod=v.cod
join usuarios u on c.usuarios_cod=u.cod
join personas p on u.personas_cod=p.cod
join usuarios u1 on v.cobrador_cod=u1.cod
join personas p3 on u1.personas_cod=p3.cod
join cuoteros cu on cu.cod=c.cuoteros_cod
join caja ca on c.caja_cod=ca.cod
join datoscaja d on ca.datoscaja_cod=d.cod
join sucursales s on d.sucursales_cod=s.cod
join barrios b on s.barrios_cod=b.cod
join ciudades c1 on b.ciudades_idciudades=c1.idciudades
where  c.nrocomprobante='".$nrorecibo."' and c.estado='PAGADO' order by c.cod asc "; 

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
			$condicioncobrador=utf8_encode($valor['condicioncobrador']);
			$montointeres=utf8_encode($valor['montointeres']);
			$cobrador=utf8_encode($valor['cobrador']);
			$ventas_cod=utf8_encode($valor['ventas_cod']);
			$fechapagos=utf8_encode($valor['fechapagos']);
			$ciudades=utf8_encode($valor['ciudades']);
			$barrios=utf8_encode($valor['barrios']);
			$direccion=utf8_encode($valor['direccion']);
			$telefono=utf8_encode($valor['telefono']);
			$ruc=utf8_encode($valor['ruc']);
			$cedulacliente=utf8_encode($valor['cedulacliente']);
			$cliente=utf8_encode($valor['cliente']);
			$nrofactura=utf8_encode($valor['nrofactura']);
			$nrocomprobante=utf8_encode($valor['nrocomprobante']);
			$sucursal=utf8_encode($valor['sucursal']);
			$caja=utf8_encode($valor['caja']);
			$cajero=utf8_encode($valor['usuario']);
			$cuota=utf8_encode($valor['cuota']);
			$monto1=utf8_encode($valor['monto']);
			$monto=number_format($monto1,'0',',','.');	
			$totalinteres1=utf8_encode($valor['totalinteres']);
			$totalinteres=number_format($totalinteres1,'0',',','.');
			$descuento1=utf8_encode($valor['descuento']);
			$descuento=number_format($descuento1,'0',',','.');	 
            $fechacobro1=utf8_encode($valor['fechacobros']);
            $datea = date_create($fechacobro1);
            $fecha= date_format($datea,"d/m/Y");  
            $horacobro=utf8_encode($valor['horacobro']);  
            $cuotac=obtener_cantidad_cuota($ventas_cod);
            $cant=$cant+1;
            $totalmonto=intVal($totalmonto)+intVal($montointeres);
          $resultadomonto1=number_format($totalmonto,'0',',','.');	
  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }


$detalles1.="<tr ".$bacground.">
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;font-size:12pt;font-family: serif;' >".$cuota."/".$cuotac."</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;font-size: 12pt;font-family: serif;' >".$fecha."</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;font-size: 12pt;font-family: serif;' >".$monto."</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;font-size: 12pt;font-family: serif;' >".$totalinteres."</td>
			   <td style='width:20%;text-align:center;border-bottom: solid 1px #cecece;font-size: 12pt;font-family: serif;' >".$descuento."</td>
			</tr>";

   }
  $paginainicio="
<div style='width: 100%;'>

<div style='padding-bottom: 15px;border-bottom: solid 2px #cecece; border-bottom-style: dashed;' >
     <img style='width: 100%;height: 60px;' src='".$base64."'>
    <div style='float:left;width:100%;' class='div1'>
		 <span style='float:left;color:#000;font-size: 12pt;font-weight: bold;font-family: serif;'>-RUC:".$ruc."</span>
    </div>
	<div style='float:left;width:100%;' class='div1'>
		    <span style='float:left;color:#000;font-size: 12pt;font-family: serif;;'>-Telefono:".$telefono."</span>
    </div>
	<div style='float:left;width:100%;' class='div1'>
		    <span style='float:left;color:#000;font-size: 12pt;font-family: serif;;'>-Sucursal: ".$sucursal." - ".$ciudades."</span>
    </div>
    <div style='float:left;width:100%;display: block;' class='div1'>
		 <div style='float:left;color:#000;font-size: 12pt;font-family: serif;'>".$direccion." - ".$barrios." </div>
    </div>
	 <div style='width: 100%;padding-top: 10px;'>
	 <center>
	 <table style='width:100%;border-top: solid 2px #808080;padding-top: 10px;border-bottom: solid 2px #808080;border-right: none;border-left: none;border-top-style: dashed;border-bottom-style: dashed;'>
	 <tr>
	 <td style='width:100%;'>
	 <center><h1 style='font-size: 12pt;text-align:center;font-family:serif;'>RECIBO DE DINERO</h1></center>
	 <center><h1 style='font-size: 12pt;text-align:center;font-family:serif;'>Nro: ".$nrocomprobante."</h1></center>
	 </td>
	 </tr>
	 </table>
	 <div class='p1' style='color:#000;font-size: 12pt;font-family: serif;'>Fecha:".$fechapagos."-</div>
	 <div class='p1' style='color:#000;font-size: 12pt;font-family: serif;'>Factura Nro:".$nrofactura."-</div>
	 <div class='p1' style='color:#000;font-size: 12pt;font-family: serif;'>SR(A):".$cliente."-</div>
	 <div class='p1' style='color:#000;font-size: 12pt;font-family: serif;'>Nro.Doc:".$cedulacliente."-</div>
	    <div class='p1' style='color:#000;font-size: 12pt;font-family: serif;'>En concepto de pago a cuenta Factura ".$nrofactura.", Según detalle:</div>
	 </center>
	  
    <table style='width:100%; margin-top: 5px;margin-bottom: 5px;' border='0' cellspacing='0' cellpadding='0' >
    <tr>
       <td style='width:100%;'>
        <div style='width:99%;height: 100%;float:left;border: solid 1px #cecece;'>
        <table class='p1' style='width:100%;' border='0' cellspacing='0' cellpadding='0' >
			 <tr style='background: #e6e5e5;'>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;font-family: serif;font-size: 12pt;' >Cuota</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;font-family: serif;font-size: 12pt;' >Vencimiento</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;font-family: serif;font-size: 12pt;' >Importe</td>
			   <td style='width:20%;border-right: solid 1px #cecece;border-bottom: solid 1px #cecece;text-align:center;font-family: serif;font-size: 12pt;' >Interes</td>
			   <td style='width:20%;text-align:center;border-bottom: solid 1px #cecece;font-family: serif;font-size: 12pt;' >Descuento</td>
			</tr>
         ".$detalles1."
        </table>
        </div>
       </td>
    </tr>
    </table>
	 <div class='p1' style='color:#000;font-size: 12pt;font-family: serif;'>Total:*****".$resultadomonto1." Gs.</div>
	 <div class='p1' style='color:#000;font-size: 12pt;font-family: serif;'>".$montoletras."</div>
	
	
	 </div>
	  <div class='p1' style='color:#000;font-size: 12pt;font-family: serif;'>".$fecha.",. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ".$horacobro."Hs.</div>
     <div class='p1' style='font-family: serif;font-size: 12pt;'>Original.:Cliente.</div>
</div>


";  
 
}
 
$informacion1 =array("1" => $paginainicio);
echo json_encode($informacion1);	
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

function buscar_reporte_listado($cod) {
$mysqli=conectar_al_servidor();
$pagina1='';
$paginainicio='';
$filtro='';
$generalporfecha='none';
$sql='';
$cant=0;
$total=0;

  $sql= "SELECT s.cod,s.nrosolicitud,s.fecha,s.clientes_cod,p.cedula,concat(p.primernombre,' ',p.segundonombre) as nombres,concat(p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as apellidos
,(select concat(p1.primernombre,' ',p1.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) from solicitudescreditos s1 join usuarios u on s1.usuarios_cod=u.cod join personas p1 on u.personas_cod=p1.cod) as usuario
,p.fechanac,p.direccion as calle,p.telefono,e.EstadosCivil,n.nacionalidad,b.barrios,ci.ciudades as localidad,d.departamentos,concat(su.nombres,' ',su.numero) as sucursal,s.estadosolicitud,s.estado 
FROM solicitudescreditos s 
join clientes c on s.clientes_cod=c.cod
join personas p on c.personas_cod=p.cod
join sucursales su on s.sucursales_cod=su.cod
join estadosciviles e on p.estadosciviles_cod=e.cod
join nacionalidad n on p.nacionalidad_cod=n.cod
join barrios b on p.barrios_cod=b.cod
join ciudades ci on b.ciudades_idciudades=ci.idciudades
join departamentos d on ci.departamentos_iddepartamentos=d.iddepartamentos 
where s.estado='ACTIVO' and s.cod='$cod'"; 

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
			$nrosolicitud=utf8_encode($valor['nrosolicitud']);
			$fecha=utf8_encode($valor['fecha']);
			$clientes_cod=utf8_encode($valor['clientes_cod']);
			$cedula=utf8_encode($valor['cedula']);
			$nombres=utf8_encode($valor['nombres']);
			$apellidos=utf8_encode($valor['apellidos']);
			$usuario=utf8_encode($valor['usuario']);
			$fechanac=utf8_encode($valor['fechanac']);
			$calle=utf8_encode($valor['calle']);
			$telefono=utf8_encode($valor['telefono']);
			$EstadosCivil=utf8_encode($valor['EstadosCivil']);
			$nacionalidad=utf8_encode($valor['nacionalidad']);
			$barrios=utf8_encode($valor['barrios']);
			$localidad=utf8_encode($valor['localidad']); 
			$departamentos=utf8_encode($valor['departamentos']); 
			$sucursal=utf8_encode($valor['sucursal']); 
	  	   
$cant=$cant+1;


 $pagina1.="
<tr >
<td class='td_detalles' style='width:1cm;background-color:#fff;border: solid 0.5px #808080;text-align:center;' >".$cant."</td>
<td class='td_detalles' style='width:1.7cm;background-color:#fff;border: solid 0.5px #808080;' >".$nrocontrato."</td>
<td class='td_detalles' style='width:2.8cm;background-color:#fff;border: solid 0.5px #808080;' >".$fraccion."</td>
<td class='td_detalles' style='width:2cm;background-color:#fff;border: solid 0.5px #808080;' >".$lote."</td>
<td class='td_detalles' style='width:2.2cm;background-color:#fff;border: solid 0.5px #808080;' >".$manzana."</td>
<td class='td_detalles' style='width:2cm;background-color:#fff;border: solid 0.5px #808080;' >".$clientes_cedula."</td>
<td class='td_detalles' style='width:5cm;background-color:#fff;border: solid 0.5px #808080;' >".$nombres."</td>
<td class='td_detalles' style='width:2cm;background-color:#fff;border: solid 0.5px #808080;' >".$telefono."</td>
<td class='td_detalles' style='width:2cm;background-color:#fff;border: solid 0.5px #808080;' >".$fecha1."</td>
<td class='td_detalles' style='width:2cm;background-color:#fff;border: solid 0.5px #808080;' >".$fecha2."</td>
<td class='td_detalles' style='width:2cm;background-color:#fff;border: solid 0.5px #808080;' >".$fecha3."</td>
<td class='td_detalles' style='width:2.5cm;background-color:#fff;border: solid 0.5px #808080;' >".$verif."</td>
<td class='td_detalles' style='width:2.5cm;background-color:#fff;border: solid 0.5px #808080;' >".$pago."</td>
</tr> 

";  
   }
   $paginainicio="<center>
     <center><h1 class='h1'>SOLICITUD DE CREDITO</h1></center>
     <center><h1 class='h1'>CREDITO GUARANI - GRUPO FARGO EMPRESARIAL S.A</h1></center>
	 
	 <section class='section'>
	 <!-- titulo del reporte -->
	 
	 
							
	 <table class='table_4'  style='margin-top:7px;text-align:center;border-bottom: none;padding-left:0px;'  cellspacing='0' cellpadding='0'>
								<tr>
									<td class='td_titulo' style='width:1cm;text-align:center;border: solid 0.5px #808080;border-bottom:none;' >N°</td>
									<td class='td_titulo' style='width:1.7cm;border: solid 0.5px #808080;border-bottom:none;'>CONTRATO</td>
									<td class='td_titulo' style='width:2.8cm;border: solid 0.5px #808080;border-bottom:none;' >FRACCION</td>
									<td class='td_titulo' style='width:2cm;border: solid 0.5px #808080;border-bottom:none;' >LOTE</td>
									<td class='td_titulo' style='width:2.2cm;border: solid 0.5px #808080;border-bottom:none;' >MANZANA</td>
									<td class='td_titulo' style='width:2cm;border: solid 0.5px #808080;border-bottom:none;' >CEDULA</td>
									<td class='td_titulo' style='width:5cm;border: solid 0.5px #808080;border-bottom:none;' >NOMBRES Y APELLIDOS</td>
									<td class='td_titulo' style='width:2cm;border: solid 0.5px #808080;border-bottom:none;' >TELEFONO</td>
									<td class='td_titulo' style='width:6cm;border: solid 0.5px #808080;border-bottom:none;' >REGISTRO DE LLAMADAS</td>
									<td class='td_titulo' style='width:2.5cm;border: solid 0.5px #808080;border-bottom:none;'>VERIF.</td>
									<td class='td_titulo' style='width:2.5cm;border: solid 0.5px #808080;border-bottom:none;' >PAGO</td>
								</tr>
	 </table>
	<div><table style='background:#fff;padding-left:0px;' id='cnt_listado_para_Gestor' border='1' class='table_4' cellspacing='0' cellpadding='0'>
                            ".$pagina1."
                            </table></div>

	
	<div style='margin-top: 4px;
    float: right;
    padding: 5px 10px 5px 10px;
    border: solid 1px #2b2b2b;
    border-radius: 5px;'>CANTIDAD: ".$cant."</div>
	 </section>
	 </center>";  
 
}
 
$informacion1 =array("1" => $paginainicio);
echo json_encode($informacion1);	
exit;

}
 
function obtener_fechas_deudas_del_dia($idventas){
	$mysqli=conectar_al_servidor();
	 $mes='';
		$sql= "

Select 
CASE WHEN sum(CASE WHEN c.Monto-ifnull((SELECT sum(p.monto) FROM pagoscuotas p where p.estado='PAGADO' and  p.cuotero_idcuotero=c.idcuotero),0)>0
THEN 
CASE WHEN timestampdiff(month,c.fecha_pagar,current_date())>0
THEN timestampdiff(month,c.fecha_pagar,current_date())
ELSE '0' 
END
ELSE '0' 
END)=0 AND  (CASE WHEN date_format(c.fecha_pagar, '%m')=date_format(current_date(), '%m') AND date_format(c.fecha_pagar, '%Y')=date_format(current_date(), '%Y')
THEN '1'
ELSE '0' 
END)=1
THEN 'A'
ELSE 'N'
END
as meses
from cuotero c
join ventas v on c.idventas=v.idventas 
join clientes c1 on v.clientes_cedula=c1.cedula
where c.idventas =  '$idventas' and v.estado='ACTIVO' and c.estado='PENDIENTE' LIMIT 1";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $mes=$valor['meses'];  
	  }
 }
 return $mes;
}

function buscar_plan_prestamos($ventas_cod){
$url_piepagina="data:image/png;base64,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";	
$url_encabezado="data:image/png;base64,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";

	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $paginainicio='';
	 $control_datos="d";
	 $titulo_pagina='';
	 $cant=0;
	 $cantPE=0;
	 $totalimporte=0;
	 $totalsaldo=0;
	 $totalimportepagado=0;
	 $totalinterespagado=0;
	 $totalinteresvencidas=0;
	 $totalvencidas=0;
	 $cantPA=0;
	 $monto_cuors=0;
 $cants=0;

         $cants_tot=0;
         $cants_tot_pro=0;
         $trab_act="";
         $trab_puest="";
		$sql= "Select  b1.barrios,c.cod,pr.nombre as producto,c1.ciudades as ciudades_suc,b.barrios as barrodsuc,s.direccion as direcsuc,s.telefono as telefsuc,s.ruc as ruc_suc
,concat(s.nombres,' ',s.numero) as sucursal,v.nrosolicitud,v.nrofactura,v.fechaventa,p1.cedula,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as Cliente,
p1.direccion,p1.referenciadireccio,p1.telefono,p1.viviendapropia,  c.cuota as monto,ifnull((SELECT sum(p.monto) from cobroscuotasclientes p where p.estado='PAGADO' and  p.cuoteros_cod=c.cod),0) as totalpagado
,ifnull((SELECT p3.nrocomprobante from cobroscuotasclientes p3 where p3.estado='PAGADO' and  p3.cuoteros_cod=c.cod limit 1),'') as comprobante,ifnull((SELECT p4.fecha from cobroscuotasclientes p4 where p4.estado='PAGADO' and  p4.cuoteros_cod=c.cod limit 1),'') as fecha_pago,
ifnull((SELECT sum(p6.descuento) from cobroscuotasclientes p6 where p6.estado='PAGADO' and  p6.cuoteros_cod=c.cod limit 1),0) as totaldescuento,
 c.plazo,ifnull(c.descuento,0) as descuentos, c.interes, c.fechaapagar,date_format(c.fechaapagar, '%m') as mes,date_format(current_date(), '%m') as meshoy
,date_format(c.fechaapagar, '%Y') as ano,date_format(current_date(), '%Y') as anohoy,date_format(c.fechaapagar, '%d') as dia,
 c.totalinteres, c.estado, c.ventas_cod,c.diasdegracia ,c.diasatrasados,ifnull((SELECT d7.sucursales_cod from cobroscuotasclientes p7  join caja c7 on p7.caja_cod=c7.cod join datoscaja d7 on c7.datoscaja_cod=d7.cod where p7.estado='PAGADO'  and  p7.cuoteros_cod=c.cod limit 1),'') as sucursal_pago
from cuoteros c
join ventas v on c.ventas_cod=v.cod
join sucursales s on v.sucursales_cod=s.cod
join barrios b on s.barrios_cod=b.cod
join ciudades c1 on b.ciudades_idciudades=c1.idciudades
join detalles_ventas de on de.ventas_cod=v.cod
join productos pr on de.codigos_productos_cod=pr.cod
join personas p1 on v.clientes_cod=p1.cod
join barrios b1 on p1.barrios_cod=b1.cod
join usuarios u on v.cobrador_cod=u.cod
join personas p2 on u.personas_cod=p2.cod
where v.nrosolicitud=?";
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
 	      $sucursal_pago=utf8_encode($valor['sucursal_pago']);
 	      $diasatrasados=utf8_encode($valor['diasatrasados']);
 	      $barrios=utf8_encode($valor['barrios']);
 	      $comprobante=utf8_encode($valor['comprobante']);
 	      $ciudades_suc=utf8_encode($valor['ciudades_suc']);
 	      $barrodsuc=utf8_encode($valor['barrodsuc']);
 	      $direcsuc=utf8_encode($valor['direcsuc']);
 	      $telefsuc=utf8_encode($valor['telefsuc']);
 	      $ruc_suc=utf8_encode($valor['ruc_suc']);
 	      $sucursal=utf8_encode($valor['sucursal']);
 	      $producto=utf8_encode($valor['producto']);
 	      $nrosolicitud=utf8_encode($valor['nrosolicitud']);
         $trab_act= obtener_trabajo_actual($nrosolicitud);
         $trab_puest=obtener_puesto_que_ocupa($nrosolicitud);  

 	      $fechaventa=utf8_encode($valor['fechaventa']);
 	     
		   $datea1 = date_create($fechaventa);
           $fep1= date_format($datea1,"d/m/Y"); 
		     $fecha_pago=utf8_encode($valor['fecha_pago']);
		   if($fecha_pago!=""){
		   $datosx = date_create($fecha_pago);
           $fec_pa= date_format($datosx,"d/m/Y");
		   $comprobantetipo="REC";
		   }else{
			  $fec_pa= ""; 
			  $comprobantetipo="";
		   }
 	      $nrofactura=utf8_encode($valor['nrofactura']);
		  $clientes_cedula=utf8_encode($valor['cedula']);
		  $nombres=utf8_encode($valor['Cliente']);
	      $direccion=utf8_encode($valor['direccion']);
		  $viviendapropia=utf8_encode($valor['viviendapropia']);
		  $referenciadireccio=utf8_encode($valor['referenciadireccio']);
		  $telefono=utf8_encode($valor['telefono']);
			  $cod_Cuotero=$valor['cod'];
		  	  $Monto=utf8_encode($valor['monto']);
              $plazo=utf8_encode($valor['plazo']);
             
			  $mes=utf8_encode($valor['mes']);
			   $meshoy=utf8_encode($valor['meshoy']);
			   $diasdegracia=utf8_encode($valor['diasdegracia']);
			   
			    $año=utf8_encode($valor['ano']);
			    $añohoy=utf8_encode($valor['anohoy']);
			    $dia=utf8_encode($valor['dia']);
			   $cantcuota=0;
			    $cod_ventaFK=utf8_encode($valor['ventas_cod']);
			 
              $interes=utf8_encode($valor['interes']);
              $fecha_pagar=utf8_encode($valor['fechaapagar']);
            $datea = date_create($fecha_pagar);
           $fep= date_format($datea,"d/m/Y");
              $estado=utf8_encode($valor['estado']);
             
              $monto_pagado=utf8_encode($valor['totalpagado']);
              $totaldescuento=utf8_encode($valor['totaldescuento']);
              $descuentos=utf8_encode($valor['descuentos']);
              $total=$Monto-($monto_pagado+$descuentos);
			  $total_interes=utf8_encode($valor['totalinteres']);
			  $total_interes3=utf8_encode($valor['totalinteres']);
			  $diff=0;
			  $colorestado="";
			  $colorestadotexto="";
			  $puratorio=1;
			 $fechahoy=date('Y-m-d');
$total_interes=0;
$fechainicial = new DateTime($fecha_pagar);
$fechafinal = new DateTime($fechahoy);
$diferencia = $fechainicial->diff($fechafinal);
$t=0;	
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
	 }
}
if( $total<=0){
	$mpag=0;
	
	$dd= $diferencia->days;
                /* $meses=intval($dd)-intval($diasdegracia); */
                $meses=intval($dd);
                $meses1=intval($dd);
            
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
    $int_paga=$total_numero;
	$total_interes=0;
	 $totalinterespagado=$totalinterespagado+$int_paga;
	 $t=($Monto)+$total_interes;
	$total=0;
	$total_interes1=$total_interes;
	$colorestado="#09c7a0";
	$colorestadotexto="#fff";     
} else {
       
$int_paga=0;
	    $t=($Monto)+$total_interes;
	   $total_interes=$total_numero;
      $total=$total;
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
	$total_interes1=0;
    
}
if($estado=="PAGADO") {	
  
	$cantPA=$cantPA+1;
	$total_interes1=$total_interes1;
	
} 
         $imp_pag=$monto_pagado-$total_interes1;
         if($imp_pag==0){
         $imp_pag="";
         $me=0;
         }else{
           if($estado=="PAGADO") {	
           $me=$diasatrasados; 
          }else{
           $me=$dd; 
           }
          
         $cants=$cants+1;
         $cants_tot=$cants_tot+$me;
       
          $imp_pag=number_format($imp_pag,'0',',','.');
          }
        
        $int_pag=$total_interes1;
         if($int_pag==0){
         $int_pag="";
         }else{
          $int_pag=number_format($int_pag,'0',',','.');
         } 

 if($me==0){
         $me="";
         }else{
          $me=number_format($me,'0',',','.');
         } 

         if($int_paga==0){
         $int_paga="";
         }else{
          $int_paga=number_format($int_paga,'0',',','.');
          }

    $monto_cuot=$Monto-$monto_pagado;
  if($monto_cuot<0){
     $monto_cuot=0;
   }else{
$monto_cuot=$monto_cuot;
   }

if($cants!=0){
$cants_tot_pro=$cants_tot/$cants;
}else{
$cants_tot_pro=$cants_tot;
}
 
  

     $totalimporte=$totalimporte+$Monto;
	 $totalsaldo=$totalsaldo+$total;
	 $totalimportepagado=$totalimportepagado+($monto_pagado-$total_interes1);

	 $totalinteresvencidas=$totalinteresvencidas+$total_interes;
	 $totalvencidas=$totalvencidas+$total;
	 $monto_cuors=$monto_cuors+$monto_cuot;

$cant=$cant+1;
  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
		 if($control_datos=="d"){
			$titulo_pagina="<tr style='width:100%;background-color:#fff;color: #000;border-left:none;border-right:none;border-top: solid 1px #cecece;;border-bottom: solid 1px #cecece;' class='table_5_1'>
									<td class='td_titulo' style='width: 5%;font-weight: bold;text-align: center;border:none;' >Cuot.</td>
									<td class='td_titulo' style='width: 7.9%;font-weight: bold;text-align: center;border:none;' >Vto.</td>
									<td class='td_titulo' style='width: 7.9%;font-weight: bold;text-align: center;border:none;' >Cuota.</td>
									<td class='td_titulo' style='width: 7.9%;font-weight: bold;text-align: center;border:none;' >Saldo Cuota</td>
									<td class='td_titulo' style='width: 7.9%;font-weight: bold;text-align: center;border:none;' >Mont.Cuota Pagado</td>
									<td class='td_titulo' style='width: 7.9%;font-weight: bold;text-align: center;border:none;' >Int.Mora Pagado</td>
									<td class='td_titulo' style='width: 7.9%;font-weight: bold;text-align: center;border:none;' >Fecha Pago</td>
									<td class='td_titulo' style='width: 8%;font-weight: bold;text-align: center;border:none;' >Comp.</td>
                                    <td class='td_titulo' style='width: 5%;font-weight: bold;text-align: center;border:none;' >No.</td>										
                                    <td class='td_titulo' style='width: 5%;font-weight: bold;text-align: center;border:none;' >Suc.</td>										
                                    <td class='td_titulo' style='width: 10.9%;font-weight: bold;text-align: center;border:none;' >Int.Mora. Vencidas</td>										
                                    <td class='td_titulo' style='width: 7.9%;font-weight: bold;text-align: center;border:none;' >Total Vencidas</td>										
                                    <td class='td_titulo' style='width: 11%;font-weight: bold;text-align: center;border:none;' >Dias</td>										
				</tr> "; 
	                         				
		 }else{
			$titulo_pagina=''; 
		 }
		  $control_datos="x";
  $pagina.=" ".$titulo_pagina."
<tr  class='table_blanco' style='border:none;'> 
<td  id='td_datosS1' class='td_detalles' style='width:5%;text-align:center;border:none;'>".$plazo."</td>
<td  id='td_datos_2' class='td_detalles' style='width:7.9%;text-align:center;border:none;'>".$fep."</td>
<td id='td_datos_1' class='td_detalles'  style='width:7.9%;text-align:center;border:none;'>".number_format($Monto,'0',',','.')."</td>
<td id='td_datos_6' class='td_detalles'  style='width:7.9%;text-align:center;border:none;' >".number_format($monto_cuot,'0',',','.')."</td>
<td id='td_datos_11' class='td_detalles' style='width:7.9%;text-align:center;border:none;'>".$imp_pag."</td>
<td id='td_datos_4' class='td_detalles'  style='width:7.9%;text-align:center;border:none;' >".$int_paga."</td>
<td id='td_datos_4' class='td_detalles'  style='width:7.9%;text-align:center;border:none;' >".$fec_pa."</td>
<td id='td_datos_4' class='td_detalles'  style='width:8%;text-align:center;border:none;' >".$comprobantetipo."</td>
<td id='td_datos_4' class='td_detalles'  style='width:5%;text-align:center;border:none;' >".$comprobante."</td>
<td id='td_datos_4' class='td_detalles'  style='width:5%;text-align:center;border:none;' >".$sucursal_pago."</td>
<td id='td_datos_4' class='td_detalles'  style='width:10.9%;text-align:center;border:none;' >".number_format($total_interes,'0',',','.')."</td>
<td id='td_datos_4' class='td_detalles'  style='width:7.9%;text-align:center;border:none;' >".number_format($total,'0',',','.')."</td>
<td id='td_datos_5'  class='td_detalles' style='width:11%;text-align:center;border:none;'>".$me."</td>
</tr>
";
   }
 }
 
$paginainicio="<center>
	<table border='0' style='width:100%;float:right;border: none;' class='table_5_1' cellspacing='0' cellpadding='0'>
	    <thead>
	       <th style='width:50%;'><img style='width: 100%;height: 70px;' src='".$url_encabezado."'/></th>
	       <th style='width:50%;'>
		    <h1 class='h1' style='text-align:center;color:#000;'>GRUPO FARGO EMPRESARIAL S.A</h1>
		      <div style='text-align:center;width:100%;' class='div1'>

	     <span style='width: 100%;text-align:center;color:#000;font-size: 12px;font-family: arial;;'>".$sucursal." - Tel ".$telefono."</span>
    </div>
    <div style='text-align:center;width:100%;display: block;' class='div1'>
		 <div style='width: 100%;text-align:center;color:#000;font-size: 12px;font-family: arial;'>".$direcsuc." - ".$barrodsuc."</div>
		 <div style='width: 100%;text-align:center;color:#000;font-size: 12px;font-family: arial;'>".$ciudades_suc."</div>
    </div>
		   </th>
        </thead> 
	</table>
        <h1 class='h1' style='text-align:left;'>FACTURA A COBRAR No.  ".$nrofactura." - ".$fep1."</h1>
    <section style='text-align: left;
    border-top: solid 1px #cecece;
    border-bottom: solid 1px #cecece;
    padding: 12px 0px 12px 0px;'>
       <div style='width: 100%;text-align:left;color:#000;font-size: 12px;font-family: arial;'>-Cliente :".$nombres." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Cedula ".$clientes_cedula."</div>
	    <div style='width: 100%;text-align:left;color:#000;font-size: 12px;font-family: arial;'>-Dirección :".$direccion." </div>
		 <div style='width: 100%;text-align:left;color:#000;font-size: 12px;font-family: arial;'>-Referencia :".$referenciadireccio." </div>
		 <div style='width: 100%;text-align:left;color:#000;font-size: 12px;font-family: arial;'>-Barrio :".$barrios." </div>
		 <div style='width: 100%;text-align:left;color:#000;font-size: 12px;font-family: arial;'>-Teléfono :".$telefono." </div>
		 <div style='width: 100%;text-align:left;color:#000;font-size: 12px;font-family: arial;'>-Trabajo Actual :".$trab_act." </div>
		 <div style='width: 100%;text-align:left;color:#000;font-size: 12px;font-family: arial;'>-Puesto :".$trab_puest." </div>
     </section>   
	 <section style='text-align: left;
 
    
   
    padding: 12px 0px 12px 0px;'>
       <div style='width: 100%;text-align:left;color:#000;font-size: 12px;font-family: arial;'>-Articulo : 1 ".$producto." S/SOLICITUD No:".$nrosolicitud." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - 1 INTERES FINANCIERO S/SOLICITUD No:".$nrosolicitud."</div>
     </section>
	 <section class='section'>
	 <!-- titulo del reporte -->

	<div>
	<table style='background:#fff;padding-left:0px;border:none;' id='cnt_listado_para_Gestor' border='0' class='table_5_1' cellspacing='0' cellpadding='0'>
                            ".$pagina."



                                <tr style='width:100%;background-color:#fff;color: #000;border-top:none;border-bottom:none;border-left:none;border-right:none;' class='table_5_1'>
									
								</tr>										
				               </tr> 
	                           <tr style='width:100%;background-color:#fff;color: #000;border-top:none;border-bottom: solid 1px #cecece;border-left:none;border-right:none;' class='table_5_1'>
									<td class='td_detalles' style='width: 5%;font-weight: bold;text-align: center;border:none;' ></td>
									<td class='td_detalles' style='width:7.9%;font-weight: bold;text-align: center;border:none;' ></td>
									<td class='td_detalles' style='width: 7.9%;font-weight: bold;text-align: center;border:none;    font-size: 11px;' >".number_format($totalimporte,'0',',','.')."</td>
									<td class='td_detalles' style='width: 7.9%;font-weight: bold;text-align: center;border:none;    font-size: 11px;' >".number_format($monto_cuors,'0',',','.')." </td>
									<td class='td_detalles' style='width: 7.9%;font-weight: bold;text-align: center;border:none;    font-size: 11px;' >".number_format($totalimportepagado,'0',',','.')." </td>
									<td class='td_detalles' style='width: 7.9%;font-weight: bold;text-align: center;border:none;    font-size: 11px;' >".number_format($totalinterespagado,'0',',','.')." </td>
									<td class='td_detalles' style='width: 7.9%;font-weight: bold;text-align: center;border:none;    font-size: 11px;' ></td>
									<td class='td_detalles' style='width: 8%;font-weight: bold;text-align: center;border:none;    font-size: 11px;' ></td>
                                    <td class='td_detalles' style='width: 5%;font-weight: bold;text-align: center;border:none;    font-size: 11px;' ></td>										
                                    <td class='td_detalles' style='width: 5%;font-weight: bold;text-align: center;border:none;    font-size: 11px;' ></td>										
                                    <td class='td_detalles' style='width: 10.9%;font-weight: bold;text-align: center;border:none;    font-size: 11px;' >".number_format($totalinteresvencidas,'0',',','.')." </td>										
                                    <td class='td_detalles' style='width: 7.9%;font-weight: bold;text-align: center;border:none;    font-size: 11px;' >".number_format($totalvencidas,'0',',','.')."</td>										
                                    <td class='td_detalles' style='width: 11%;font-weight: bold;text-align: center;border:none;    font-size: 11px;' >".round($cants_tot_pro)."</td>										
				               </tr> 
     </table>
	</div>

 <div style='padding: 10px 0px 10px 0px;'>
<img style='width: 100%;height:100px;' src='".$url_piepagina."'/>
 </div>

	 </section>
	 </center>"; 
	 
	 
$informacion =array("1" => $paginainicio);
echo json_encode($informacion);	
exit;
}

function obtener_trabajo_actual($nrosolicitud){
	$mysqli=conectar_al_servidor();
	 $mes='';
		$sql= "
SELECT r.trabajoactual 
FROM referenciaslaborales r
join solicitudescreditos s on r.solicitudescreditos_cod=s.cod
where nrosolicitud='".$nrosolicitud."' LIMIT 1";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $mes=$valor['trabajoactual'];  
	  }
 }
 return $mes;
}

function obtener_puesto_que_ocupa($nrosolicitud){
	$mysqli=conectar_al_servidor();
	 $mes='';
		$sql= "
SELECT r.puestoqueocupa 
FROM referenciaslaborales r
join solicitudescreditos s on r.solicitudescreditos_cod=s.cod
where nrosolicitud='".$nrosolicitud."' LIMIT 1";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $mes=$valor['puestoqueocupa'];  
	  }
 }
 return $mes;
}

function obtener_vendedor($nrosolicitud){
	$mysqli=conectar_al_servidor();
	 $mes='';
		$sql= "
SELECT concat(p.primernombre, ' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as VENDEDOR FROM ventas v
join usuarios u on v.vendedor_cod=u.cod
join personas p on u.personas_cod=p.cod where v.nrosolicitud='".$nrosolicitud."' and v.estado='ACTIVO' LIMIT 1";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $mes=$valor['VENDEDOR'];  
	  }
 }
 return $mes;
}



function buscarfactura($codventas,$letrass){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $monto_total=0;
	 $ivadiez=0;
	 $detalles_factura='';
	 $vendedor='';
		$sql= "SELECT ciu.ciudades,concat(date_format(v.fecha, '%d'),' de ', case
WHEN date_format(v.fecha, '%m')=01 then 'ENERO'
WHEN date_format(v.fecha, '%m')=02 then 'FEBRERO'
WHEN date_format(v.fecha, '%m')=03 then 'MARZO'
WHEN date_format(v.fecha, '%m')=04 then 'ABRIL'
WHEN date_format(v.fecha, '%m')=05 then 'MAYO'
WHEN date_format(v.fecha, '%m')=06 then 'JUNIO'
WHEN date_format(v.fecha, '%m')=07 then 'JULIO'
WHEN date_format(v.fecha, '%m')=08 then 'AGOSTO'
WHEN date_format(v.fecha, '%m')=09 then 'SEPTIEMBRE'
WHEN date_format(v.fecha, '%m')=10 then 'OCTUBRE'
WHEN date_format(v.fecha, '%m')=11 then 'NOVIEMBRE'
WHEN date_format(v.fecha, '%m')=12 then 'DICIEMBRE'
END,' de ',date_format(v.fecha, '%Y')) as fechaletra,v.hora,v.nrosolicitud,v.tipooperacion,v.nrofactura,v.moneda,cl.cedula,cl.ruc,cl.telefono,cl.direccion
,concat(cl.primernombre, ' ',cl.segundonombre,' ',cl.primerapellido,' ',cl.segundoapellido,' ',cl.apellidocasada) as cliente
,concat(peru.primernombre, ' ',peru.segundonombre,' ',peru.primerapellido,' ',peru.segundoapellido,' ',peru.apellidocasada) as Cajero
,pro.cod,d.cantidad,pro.nombre as detalles,d.precio
FROM ventas v
join detalles_ventas d on d.ventas_cod=v.cod
join personas cl on v.clientes_cod=cl.cod
join personas ve on v.vendedor_cod=ve.cod
join sucursales s on v.sucursales_cod=s.cod
join barrios ba on s.barrios_cod=ba.cod
join usuarios u on v.usuarios_cod=u.cod
join personas peru on u.personas_cod=peru.cod
join ciudades ciu on ba.ciudades_idciudades=ciu.idciudades
join codigos_productos cp on d.codigos_productos_cod=cp.cod
join productos pro on cp.productos_cod=pro.cod
where v.nrosolicitud=? and v.estado='ACTIVO'"; 
    $stmt = $mysqli->prepare($sql);
  	$s='s';
$codventas="".$codventas."";
$stmt->bind_param($s,$codventas);

if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {	 
			  $ciudades=utf8_encode($valor['ciudades']);
			  $fechaletra=utf8_encode($valor['fechaletra']);
		  	  $hora=utf8_encode($valor['hora']);
		  	  $nrosolicitud=utf8_encode($valor['nrosolicitud']);
              $vendedor=obtener_vendedor($nrosolicitud);
		  	  $nrofactura=utf8_encode($valor['nrofactura']);
              $tipooperacion=utf8_encode($valor['tipooperacion']);
              $moneda=utf8_encode($valor['moneda']);
              $cedula=utf8_encode($valor['cedula']);
              $ruc=utf8_encode($valor['ruc']);
              $telefono=utf8_encode($valor['telefono']);
              $direccion=utf8_encode($valor['direccion']);
              $cliente=utf8_encode($valor['cliente']);
              $codproducto=utf8_encode($valor['cod']);
              $cantidad=utf8_encode($valor['cantidad']);
              $detalles=utf8_encode($valor['detalles']);
              $precio=utf8_encode($valor['precio']);
              $Cajero=utf8_encode($valor['Cajero']);
			  $cedulaa="";
                if($ruc==""){
					$cedulaa=$cedula;
				}else{
					$cedulaa=$ruc;
				}
				$monto_total=$monto_total+$precio;
				$ivadiez=$monto_total/11;
				$detalles_factura.="  
				<tr>
		<td style='width:10%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;'>".$codproducto."</span>
		</td>
		<td style='width:10%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;'>".$cantidad."</span>
		</td>
		<td style='width:30.5%;'>
		<span style='text-align:center;'>".$detalles." S/SOLICITUD Nro.".$nrosolicitud."-</span>
		</td>
		<td style='width:10%;'>
		<span style='text-align:center;'>-</span>
		</td>
		<td style='width:39.5%;'>
		<table style='width:100%;height:100%;'>
		<tr>
		<td style='width:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<table style='width:100%;height:100%;'>
        <tr>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;'>".number_format($precio,'0',',','.')."</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;'>-</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;'>".number_format($precio,'0',',','.')."</span>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		";
			
              }
 $pagina.="
<div >
	 <div style='height:1cm;font-size: 9px;font-family: arial;font-weight: bold;'>
	 </div>
	 <div style='width: 100%;height:3cm;'>
	
	 </div>

<center>
<div style='/* border: solid 0.5px #000000; */ width: 98%; height:2cm;'>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
</td>
<td style='width:10%;'>
</td>
<td style='width:20%;'>
</td>
<td style='width:10%;'>

</td>
<td style='width:10%;'>
<div style='text-align: left;'>".$nrofactura."</div>
</td>
</tr>
</table>
</div>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
<span style='color:transparent;'>Fecha:</span>
<span style=''>".$ciudades.",".$fechaletra."</span>
</td>
<td style='width:10%;'>
<span style='color:transparent;'>Fecha:</span>
<span style=''>".$hora."</span>
</td>
<td style='width:20%;'>
</td>
<td style='width:20%;'>
<div style='text-align: left;'>".$tipooperacion."</div>
</td>
</tr>
</table>
</div>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
<span style='color:transparent;'>Direccion:</span>
<span style=''>".$cliente."</span>
</td>
<td style='width:10%;'>

</td>
<td style='width:20%;'>

</td>
<td style='width:20%;'>
<div style='text-align: left;'>".$cedulaa."</div>
</td>
</tr>
</table>
</div>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
<span style='color:transparent;'>Direccion:</span>
<span style=''>".$direccion."</span>
</td>
<td style='width:10%;'>
</td>
<td style='width:20%;'>
</td>
<td style='width:20%;'>
<div style=''>".$vendedor."</div>
</td>
</tr>
</table>
</div>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
<span style='color:transparent;'>Direccion:</span>
</td>
<td style='width:10%;'>
</td>
<td style='width:20%;'>
<div style=''>".$telefono."</div>
</td>
<td style='width:20%;'>

</td>
</tr>
</table>
</div>

</div>

    <div style='width:100%;height:1cm; '>
		<table style='width:98.5%;height:100%;/* border: solid 0.5px #000000; */'>
        <tr>
			<td style='width:10%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>Codigo.</span>
		</td>
		<td style='width:10%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>Cant.</span>
		</td>
		<td style='width:30.5%;'>
		<span style='text-align:center;color:transparent;'>DESCRIPCION</span>
		</td>
		<td style='width:10%;'>
		<span style='text-align:center;color:transparent;'>P.Unit.</span>
		</td>
		<td style='width:39.5%;'>
		<table style='width:100%;height:100%;'>
        <tr>
		<td style='width:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:left;color:transparent;'>VALOR DE VENTA</span>
		</td>
		</tr>
		<tr>
		<td style='width:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<table style='width:100%;height:100%;'>
        <tr>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>Exentas</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>5%</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>10%</span>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>			
	    </div>

     <div style='width:100%;height:3.5cm; '>
		<table style='width:98.5%;height:100%;/* border: solid 0.5px #000000; */'>
           ".$detalles_factura."
		</table>			
	</div>
	        <div style='width:100%;height:3.5cm; '>
		<table style='width:98.5%;height:8mm;/* border: solid 0.5px #000000; */'>
        <tr>
		<td style='width:60%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>SUBTOTALES</span>
		</td>
		<td style='width:39.5%;'>
		<table style='width:100%;height:100%;'>
		<tr>
		<td style='width:100%;height:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<table style='width:100%;height:100%;'>
        <tr>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
		<span style='text-align:center;'>-</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
		<span style='text-align:center;'>-</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
		<span style='text-align:center;'>".number_format($monto_total,'0',',','.')."</span>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>

       <table style='width:98.5%;height:1.5cm;/* border: solid 0.5px #000000; */'>
        <tr>
		<td style='width:60.5%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<table style='width:100%;height:100%;'>
		<tr>
		<td style='width:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<table style='width:100%;height:100%;'>
        <tr style='width:100%;height:7.5mm;'>
		<td style='width:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>Total a pagar</span>
		</td>
		</tr>
		<tr style='width:100%;height:7.5mm;'>
		<td style='width:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;'>".$letrass."</span>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
		<td style='width:39.5%;'>
<table style='width:100%;height:100%;'>
        <tr>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
		<span style='text-align:center;'>-</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
		<span style='text-align:center;'>-</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
<span style='text-align:center;font-size: 14px;'>".number_format($monto_total,'0',',','.')."</span>
		</td>
		</tr>
		</table>
		
		</td>
		</tr>
		</table>
		
        <table style='width:98.5%;height:5px;/* border: solid 0.5px #000000; */'>
        <tr>
		<td style='width:33.3%;'>
		<center><span style='text-align:left;float: left;color:transparent;'>Liquidacion IVA(5%)</span></center>
		<center><span style='text-align:left;'>---------------</span></center>
		</td>
		<td style='width:33.3%;'>
		<center><span style='text-align:left;float: left;color:transparent;'>IVA(10%)</span></center>
		<center><span style='text-align:left;'>".number_format($ivadiez,'0',',','.')."</span></center>
		</td>
			<td style='width:33.3%;'>
		<center><span style='text-align:left;float: left;color:transparent;'>Total IVA</span></center>
		<center><span style='text-align:left;'>".number_format($ivadiez,'0',',','.')."</span></center>
		</td>
		</tr>
		</table>
		</center>
	</div>
	
	</div>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
<span style='color:transparent;'>Fecha:</span>
<span style=''>".$Cajero."</span>
</td>
<td style='width:10%;'>
</td>
<td style='width:20%;'>
</td>
<td style='width:20%;'>
</td>
</tr>
</table>
</div>

</div>





 <div style='width: 100%;height:1.8cm;'>
	
</div>
	 
	 
	 
<div >
	 <div style='height:1cm;font-size: 9px;font-family: arial;font-weight: bold;'>
	 </div>
	 <div style='width: 100%;height:3cm;'>
	
	 </div>

<center>
<div style='/* border: solid 0.5px #000000; */ width: 98%; height:2cm;'>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
</td>
<td style='width:10%;'>
</td>
<td style='width:20%;'>
</td>
<td style='width:10%;'>

</td>
<td style='width:10%;'>
<div style='text-align: left;'>".$nrofactura."</div>
</td>
</tr>
</table>
</div>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
<span style='color:transparent;'>Fecha:</span>
<span style=''>".$ciudades.",".$fechaletra."</span>
</td>
<td style='width:10%;'>
<span style='color:transparent;'>Fecha:</span>
<span style=''>".$hora."</span>
</td>
<td style='width:20%;'>
</td>
<td style='width:20%;'>
<div style='text-align: left;'>".$tipooperacion."</div>
</td>
</tr>
</table>
</div>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
<span style='color:transparent;'>Direccion:</span>
<span style=''>".$cliente."</span>
</td>
<td style='width:10%;'>

</td>
<td style='width:20%;'>

</td>
<td style='width:20%;'>
<div style='text-align: left;'>".$cedulaa."</div>
</td>
</tr>
</table>
</div>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
<span style='color:transparent;'>Direccion:</span>
<span style=''>".$direccion."</span>
</td>
<td style='width:10%;'>
</td>
<td style='width:20%;'>
</td>
<td style='width:20%;'>
<div style=''>".$vendedor."</div>
</td>
</tr>
</table>
</div>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
<span style='color:transparent;'>Direccion:</span>
</td>
<td style='width:10%;'>
</td>
<td style='width:20%;'>
<div style=''>".$telefono."</div>
</td>
<td style='width:20%;'>

</td>
</tr>
</table>
</div>

</div>

    <div style='width:100%;height:1cm; '>
		<table style='width:98.5%;height:100%;/* border: solid 0.5px #000000; */'>
        <tr>
			<td style='width:10%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>Codigo.</span>
		</td>
		<td style='width:10%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>Cant.</span>
		</td>
		<td style='width:30.5%;'>
		<span style='text-align:center;color:transparent;'>DESCRIPCION</span>
		</td>
		<td style='width:10%;'>
		<span style='text-align:center;color:transparent;'>P.Unit.</span>
		</td>
		<td style='width:39.5%;'>
		<table style='width:100%;height:100%;'>
        <tr>
		<td style='width:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:left;color:transparent;'>VALOR DE VENTA</span>
		</td>
		</tr>
		<tr>
		<td style='width:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<table style='width:100%;height:100%;'>
        <tr>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>Exentas</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>5%</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>10%</span>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>			
	    </div>

     <div style='width:100%;height:3.5cm; '>
		<table style='width:98.5%;height:100%;/* border: solid 0.5px #000000; */'>
           ".$detalles_factura."
		</table>			
	</div>
	        <div style='width:100%;height:3.5cm; '>
		<table style='width:98.5%;height:8mm;/* border: solid 0.5px #000000; */'>
        <tr>
		<td style='width:60%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>SUBTOTALES</span>
		</td>
		<td style='width:39.5%;'>
		<table style='width:100%;height:100%;'>
		<tr>
		<td style='width:100%;height:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<table style='width:100%;height:100%;'>
        <tr>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
		<span style='text-align:center;'>-</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
		<span style='text-align:center;'>-</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
		<span style='text-align:center;'>".number_format($monto_total,'0',',','.')."</span>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>

       <table style='width:98.5%;height:1.5cm;/* border: solid 0.5px #000000; */'>
        <tr>
		<td style='width:60.5%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<table style='width:100%;height:100%;'>
		<tr>
		<td style='width:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<table style='width:100%;height:100%;'>
        <tr style='width:100%;height:7.5mm;'>
		<td style='width:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;color:transparent;'>Total a pagar</span>
		</td>
		</tr>
		<tr style='width:100%;height:7.5mm;'>
		<td style='width:100%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
		<span style='text-align:center;'>".$letrass."</span>
		</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</td>
		<td style='width:39.5%;'>
<table style='width:100%;height:100%;'>
        <tr>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
		<span style='text-align:center;'>-</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
		<span style='text-align:center;'>-</span>
		</td>
		<td style='width:33.3%;font-family: arial;font-size: 12px;font-weight: 600;'>
<span style='text-align:center;font-size: 14px;'>".number_format($monto_total,'0',',','.')."</span>
		</td>
		</tr>
		</table>
		
		</td>
		</tr>
		</table>
		
        <table style='width:98.5%;height:5px;/* border: solid 0.5px #000000; */'>
        <tr>
		<td style='width:33.3%;'>
		<center><span style='text-align:left;float: left;color:transparent;'>Liquidacion IVA(5%)</span></center>
		<center><span style='text-align:left;'>---------------</span></center>
		</td>
		<td style='width:33.3%;'>
		<center><span style='text-align:left;float: left;color:transparent;'>IVA(10%)</span></center>
		<center><span style='text-align:left;'>".number_format($ivadiez,'0',',','.')."</span></center>
		</td>
			<td style='width:33.3%;'>
		<center><span style='text-align:left;float: left;color:transparent;'>Total IVA</span></center>
		<center><span style='text-align:left;'>".number_format($ivadiez,'0',',','.')."</span></center>
		</td>
		</tr>
		</table>
		</center>
	</div>
	
	</div>
<div style='width: 100%;float:left;height:0.66cm;' >
<table style='width:100%;height:100%;margin-left: 30px;'>
<tr>
<td style='width:50%;font-family: arial;font-size: 12px;font-weight: 600;text-align: justify;'>
<span style='color:transparent;'>Fecha:</span>
<span style=''>".$Cajero."</span>
</td>
<td style='width:10%;'>
</td>
<td style='width:20%;'>
</td>
<td style='width:20%;'>
</td>
</tr>
</table>
</div>

</div>
	";
 }
 
$informacion =array("1" => $pagina);
echo json_encode($informacion);	
exit;


}



verificar_datos();
?>