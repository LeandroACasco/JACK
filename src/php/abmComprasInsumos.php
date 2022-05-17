<?php
require("conexion.php");
function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
	
        
   if($func=='buscar_detalles_compras_insumos'){
			$buscar = $_POST['buscar'];
			$buscar = utf8_decode($buscar);
			
			
			$codsucursal = $_POST['codsucursal'];
			$codsucursal = utf8_decode($codsucursal);
			
			buscar_detalles_compras_insumos_credito($buscar,$codsucursal);
			
		}       
   if($func=='buscar_detalles_compras_insumos_contado'){
			$buscar = $_POST['buscar'];
			$buscar = utf8_decode($buscar);
			
			
			$codsucursal = $_POST['codsucursal'];
			$codsucursal = utf8_decode($codsucursal);
			
			buscar_detalles_compras_insumos_contado($buscar,$codsucursal);
			
		}           
   if($func=='buscar_detalles_historial_compras_insumos'){
			$buscar = $_POST['buscar'];
			$buscar = utf8_decode($buscar);
			
			
			$codsucursal = $_POST['codsucursal'];
			$codsucursal = utf8_decode($codsucursal);
			
			 buscar_detalles_historial_compras_insumos($buscar,$codsucursal);
			
		}   
   if($func=='buscar_detalles_historial_detallescompras_insumos'){
			$codcompras = $_POST['codcompras'];
			$codcompras = utf8_decode($codcompras);
			buscar_detalles_historial_detallescompras_insumos($codcompras);
			
		}       
   if($func=='cargar_interes_a_cuotero'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			
			
			$interes = $_POST['interes'];
			$interes = utf8_decode($interes);
			
			 cargar_interes_a_cuotero($cod,$interes);
			
		} 
   if($func=='buscar_detalles_pagos_compras_insumos'){
	
			$codcompras = $_POST['codcompras'];
			$codcompras = utf8_decode($codcompras);
			
			buscar_detalles_pagos_compras_insumos($codcompras);
			
		}  
   if($func=='buscar_compras_contados_a_pagar_proveedores'){
	
			$codcompras = $_POST['codcompras'];
			$codcompras = utf8_decode($codcompras);
			
			buscar_compras_contados_a_pagar_proveedores($codcompras);
			
		}   
   if($func=='cargar_cuotero_compra_contado'){
	
			$vto = $_POST['vto'];
			$vto = utf8_decode($vto);
			
			$monto = $_POST['monto'];
			$monto = utf8_decode($monto);

			$usuarios_cod = $_POST['usuarios_cod'];
			$usuarios_cod = utf8_decode($usuarios_cod);

			$hora = $_POST['hora'];
			$hora = utf8_decode($hora);
			
			cargarcomprascontado($vto,$monto,$usuarios_cod,$hora);
			
		} 
   if($func=='buscar_cantidad_cuota_a_pagar_proveedores'){
	
			$limit = $_POST['limit'];
			$limit = utf8_decode($limit);
			
			$compras_cod = $_POST['compras_cod'];
			$compras_cod = utf8_decode($compras_cod);
			
		buscar_cantidad_cuota_a_pagar_proveedores($compras_cod,$limit);
			
		} 
   if($func=='cargarpagos'){
	
			$montopagado = $_POST['montopagado'];
			$montopagado = utf8_decode($montopagado);
			
			$fechapago = $_POST['fechapago'];
			$fechapago = utf8_decode($fechapago);
			
			$compras_cod = $_POST['compras_cod'];
			$compras_cod = utf8_decode($compras_cod);
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);
			
			$nrofactura = $_POST['nrofactura'];
			$nrofactura = utf8_decode($nrofactura);
			
			$sucursales_cod = $_POST['sucursales_cod'];
			$sucursales_cod = utf8_decode($sucursales_cod);
			
			$hora = $_POST['hora'];
			$hora = utf8_decode($hora);
			
			$usuarios_cod = $_POST['usuarios_cod'];
			$usuarios_cod = utf8_decode($usuarios_cod);
			
		cargarpagos($montopagado,$fechapago, $compras_cod,$caja_cod,$nrofactura,$sucursales_cod,$usuarios_cod,$hora);
			
		}
   if($func=='cargar_compras_insumos'){
	       
		    
            $cod = $_POST['cod'];
			$cod = utf8_decode($cod);

            $fechacompra = $_POST['fechacompra'];
			$fechacompra = utf8_decode($fechacompra);
		    
		   
            $nrofactura = $_POST['nrofactura'];
			$nrofactura = utf8_decode($nrofactura);
			
			$proveedores_cod = $_POST['proveedores_cod'];
			$proveedores_cod = utf8_decode($proveedores_cod);
			
			$condicion = $_POST['condicion'];
			$condicion = utf8_decode($condicion);
			
            $monto = $_POST['monto'];
			$monto = utf8_decode($monto);
				
			$usuarios_cod = $_POST['usuarios_cod'];
			$usuarios_cod = utf8_decode($usuarios_cod);
			
			$sucursales_cod = $_POST['sucursales_cod'];
			$sucursales_cod = utf8_decode($sucursales_cod);
			
			$hora = $_POST['hora'];
			$hora = utf8_decode($hora);
			
			
			mantenimiento($cod,$fechacompra,$monto,$nrofactura,$proveedores_cod,$condicion,$usuarios_cod,$sucursales_cod,$hora);
		}
   if($func=='anular_compras_insumos'){
	
            $codcompras = $_POST['codcompras'];
			$codcompras = utf8_decode($codcompras);	

            $clavepermisoanulacion = $_POST['clavepermisoanulacion'];
			$clavepermisoanulacion = utf8_decode($clavepermisoanulacion);	
		    anular_compras_insumos($codcompras,$clavepermisoanulacion);	
		}	
}

function anular_compras_insumos($codcompras,$clavepermisoanulacion){
$mysqli=conectar_al_servidor();
	if($codcompras==""){
    echo "camposvacio";	
    exit;
	}

	    $sql="update compras set permisoanulacion='".$clavepermisoanulacion."',estado='ANULADO' where cod='".$codcompras."'";
		$stmt = $mysqli->prepare($sql);
    if(!$stmt->execute()) {
     echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
     exit;
    }
	 /*  $sql1="update cajadiaria set permisoanulacion='".$clavepermisoanulacion."',estado='ANULADO' where nro='".$nrocomprobante."' and origen='OTROSINGRESOS'";
		$stmt1 = $mysqli->prepare($sql1);
    if(!$stmt1->execute()) {
     echo trigger_error('The query execution failed; MySQL said ('.$stmt1->errno.') '.$stmt1->error, E_USER_ERROR);
     exit;
    } */
	echo"exito";
}

function mantenimiento($cod,$fechacompra,$monto,$nrofactura,$proveedores_cod,$condicion,$usuarios_cod,$sucursales_cod,$hora){
	if($fechacompra=="" ||  $proveedores_cod=="" || $condicion=="" || $usuarios_cod=="" || $sucursales_cod==""  || $hora==""){
    echo "camposvacio";	
    exit;
}

$mysqli=conectar_al_servidor();
$totalmonto=0;
$consulta= "Select count(*) from compras where cod=? and estado='ACTIVO' ";
$stmt = $mysqli->prepare($consulta);
$ss='s';
$stmt->bind_param($ss, $nrosolicitud); 
if ( ! $stmt->execute()) {
   echo "Error";
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
   $sql="insert into compras (fechacompra, nrofactura, proveedores_cod, condicion, usuarios_cod,sucursales_cod, hora, estado) value (?,?,?,?,?,?,?,'ACTIVO')";
   $s='sssssss';

   $stmt = $mysqli->prepare($sql);
   $stmt->bind_param($s,$fechacompra,$nrofactura,$proveedores_cod,$condicion,$usuarios_cod,$sucursales_cod,$hora); 
   
   if ( ! $stmt->execute()) {
    echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
   }
  echo "exito";
}
	
function buscar_detalles_compras_insumos_credito($buscar,$codsucursal){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $cant=0;
	 $sql= "SELECT c.cod,c.nrofactura,p.nombre as proveedor,c.condicion,(SELECT sum(subtotal)  FROM detalles_compras where compras_cod=c.cod) as total,s.nombres as sucursal,c.fechacompra,c.estado 
FROM compras c
join proveedores p on c.proveedores_cod=p.cod
join sucursales s on c.sucursales_cod=s.cod
where c.estado='ACTIVO' and c.condicion='CREDITO' and c.sucursales_cod=? and concat(c.nrofactura,' ',p.nombre) like ?  order by c.cod desc"; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
$buscar="%".$buscar."%";
$codsucursal="".$codsucursal."";
$stmt->bind_param($s,$codsucursal,$buscar);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
		      $cod=$valor['cod'];  
		  	  $nrofactura=utf8_encode($valor['nrofactura']);
			  $proveedor=utf8_encode($valor['proveedor']);
			  $sucursal=utf8_encode($valor['sucursal']);
			  $fechacompra=utf8_encode($valor['fechacompra']);
			  $condicion=utf8_encode($valor['condicion']);
			  $total1=utf8_encode($valor['total']);
			  $total=number_format($total1,'0',',','.');
			  $estado=utf8_encode($valor['estado']);
              if($estado=="ACTIVO"){
               $estadoactual="PENDIENTE";
              }
             $datea = date_create($fechacompra);
            $fecha= date_format($datea,"d/m/Y");
 
	  	 $cant=$cant+1;
		if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
		 $accion='abrir_cerrar_ventanas_cuotasproveedores("1","'.$cod.'")';
$pagina.="

<tr ".$bacground." >

<td class='td_detalles' style='width:0%;display:none;'>".$cod."</td>
<td class='td_detalles' style='width:10%;background-color:#e3e2e2;color:red;text-align:center;'>".$nrofactura."</td>
<td class='td_detalles' style='width:15%;' >
<button onclick=".$accion."  style='display:;visibility:initial;box-shadow:inset -1px -1px 2px 0px #00000069;cursor:pointer;border-radius:7px;width:100%;background-color: #795548;height: 35px;border:none;color: #FFF;font-size:10px;' type='button' class='input_eliminar_p'>PAGAR CUENTA</button>
</td>
<td class='td_detalles' style='width:20%;' >".$proveedor."</td>
<td class='td_detalles' style='width:10%;' >".$total." Gs.</td>
<td class='td_detalles' style='width:10%;' >".$condicion."</td>
<td class='td_detalles' style='width:15%;' >".$sucursal."</td>
<td class='td_detalles' style='width:10%;' >".$fecha."</td>
<td class='td_detalles' style='width:10%;' >".$estadoactual."</td>
</tr>
";		  
	  }
 }
  $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_detalles_compras_insumos_contado($buscar,$codsucursal){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $cant=0;
	 $sql= "SELECT c.cod
	 ,c.nrofactura
	 ,p.nombre as proveedor
	 ,c.condicion
	 ,(SELECT sum(subtotal)  FROM detalles_compras where compras_cod=c.cod) as total
	 ,(SELECT sum(monto) from pagos_cuotas_proveedores where compras_cod=c.cod) as pagos
	 ,s.nombres as sucursal
	 ,c.fechacompra
	 ,c.estado 
FROM compras c
join proveedores p on c.proveedores_cod=p.cod
join sucursales s on c.sucursales_cod=s.cod
where c.estado='ACTIVO' and c.condicion='CONTADO' and c.sucursales_cod=? and concat(c.nrofactura,' ',p.nombre) like ?  order by c.cod desc"; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
$buscar="%".$buscar."%";
$codsucursal="".$codsucursal."";
$stmt->bind_param($s,$codsucursal,$buscar);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
		      $cod=$valor['cod'];  
		  	  $nrofactura=utf8_encode($valor['nrofactura']);
			  $proveedor=utf8_encode($valor['proveedor']);
			  $sucursal=utf8_encode($valor['sucursal']);
			  $fechacompra=utf8_encode($valor['fechacompra']);
			  $condicion=utf8_encode($valor['condicion']);
			  @$pago1=utf8_encode(isset($valor['pagos']) ? $valor['pagos'] : 0);
			  @$pago=number_format($pago1,'0',',','.');
			  @$total1=utf8_encode($valor['total'] - $pago1);
			  @$total=number_format($total1,'0',',','.');
			  $estado=utf8_encode($valor['estado']);
              if($estado=="ACTIVO"){
               $estadoactual="PENDIENTE";
              }
             $datea = date_create($fechacompra);
            $fecha= date_format($datea,"d/m/Y");
 
	  	 $cant=$cant+1;
		if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
		 $accion='abrir_cerrar_ventanas_pagoscontadosproveedores("1","'.$cod.'")';
		 $boton = $total1 > 0 ? "<button onclick=".$accion."  style='display:;visibility:initial;box-shadow:inset -1px -1px 2px 0px #00000069;cursor:pointer;border-radius:7px;width:100%;background-color: #795548;height: 35px;border:none;color: #FFF;font-size:10px;' type='button' class='input_eliminar_p'>PAGAR CUENTA</button>" : "";
$pagina.="

<tr ".$bacground." >

<td class='td_detalles' style='width:0%;display:none;'>".$cod."</td>
<td class='td_detalles' style='width:15%;' >
".$boton."
</td>
<td class='td_detalles' style='width:10%;text-align:center;'>".$fecha."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;'>".$nrofactura."</td>
<td class='td_detalles' style='width:20%;' >".$proveedor."</td>
<td class='td_detalles' style='width:10%;' >".$total." Gs.</td>
<td class='td_detalles' style='width:10%;' >".$pago." Gs.</td>
<td class='td_detalles' style='width:20%;' >".$sucursal."</td>
<td class='td_detalles' style='width:10%;' >".$estadoactual."</td>
</tr>
";		  
	  }
 }
  $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_compras_contados_a_pagar_proveedores($compras_cod){	
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $cant=0;
	 $totalapagar=0;
	 $totdescuento=0;
	 $totalMonto=0;
	 $totalInter=0;
	 $is=0;
		$sql= "SELECT cu.cod,cu.plazo,cu.monto,cu.estado,cu.compras_cod,ifnull((SELECT sum(p.monto) from pagos_cuotas_proveedores p where p.estado='PAGADO' and  p.cuoteros_compras_proveedores_cod=cu.cod),0) as totalpagado,co.nrofactura,p.ruc,p.nombre as proveedor,co.fechacompra,cu.estado
FROM cuoteros_compras_proveedores cu
join compras co on cu.compras_cod=co.cod
join proveedores p on co.proveedores_cod=p.cod
where cu.compras_cod=? ";
$stmt = $mysqli->prepare($sql);
  echo $mysqli -> error; 
$s='s';
$compras_cod="".$compras_cod."";
$stmt->bind_param($s,$compras_cod);
if(!$stmt->execute()){
   echo trigger_error('The query execution failed; 
   said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {	 
	  
 	         $cod=utf8_encode($valor['cod']);
 	         $vto=utf8_encode($valor['fechacompra']);
			 $datea = date_create($vto);
             $fep= date_format($datea,"d/m/Y");
 	         $plazo=utf8_encode($valor['plazo']);
		     $monto=utf8_encode($valor['monto']);
			 $compras_cod=utf8_encode($valor['compras_cod']);
			 $totalpagado=utf8_encode($valor['totalpagado']);
			 $total=$monto-$totalpagado;
			 $nrofactura=utf8_encode($valor['nrofactura']);
			 $proveedor=utf8_encode($valor['proveedor']);
			 $ruc=utf8_encode($valor['ruc']);
			 $estado=utf8_encode($valor['estado']);
	 $cantcuota=utf8_encode(obtener_cantidad_cuota($compras_cod));	 
     $cant=$cant+1;
     $totalapagar= $totalapagar+$monto;
	 $totalMonto=$totalMonto+$totalpagado;
  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
				$accion1='habilitar_typeo_en_pagos_cuotas_td_interes("'.$cod.'")';
  $pagina.="
<tr ".$bacground."  style='cursor: default;' '>
 
<td id='td_cod' style='display:none'>".$cod."</td>
<td id='td_compras_cod' style='display:none'>".$compras_cod."</td>
<td id='td_nrofactura' style='display:none'>".$nrofactura."</td>
<td id='td_plazo' class='td_detalles' style='width:10%;background-color: #efeded;color:red;text-align:center;'>".$plazo."</td>
<td id='td_vto' class='td_detalles' style='width:22.5%;text-align:center;'>".$fep."</td>
<td id='td_monto' class='td_detalles'  style='width:22.5%;text-align:center;color:green;'>". number_format($total,'0',',','.')."</td>
<td id='td_totalpagado' class='td_detalles' style='width:22.5%;text-align:center;color:red;'>". number_format($totalpagado,'0',',','.')."</td>
<td id='td_estado'  class='td_detalles' style='width:22.5%;text-align:center;'>".$estado."</td>
</tr>
";
   }
 }
 
$informacion =array("1" => "exito","2" => $pagina,"3" => $cant,"4" => number_format($total,'0',',','.'),"5" => number_format($totalMonto,'0',',','.'),"6" => $nrofactura,"7" => $ruc,"8" => $proveedor,"9" => $compras_cod);
echo json_encode($informacion);	
exit;
}

function buscar_detalles_pagos_compras_insumos($codcompras){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	  $cant=0;
	 $cantPE=0;
	 $cantPA=0;
	 $sql= "SELECT cu.cod,ifnull(cu.interes,0) as interes,cu.vto,cu.plazo,cu.monto,cu.estado,ifnull((SELECT sum(p.monto) from pagos_cuotas_proveedores p where p.estado='PAGADO' and  p.cuoteros_compras_proveedores_cod=cu.cod),0) as totalpagado,cu.compras_cod,co.nrofactura,p.ruc,p.nombre as proveedor,co.fechacompra
FROM cuoteros_compras_proveedores cu
join compras co on cu.compras_cod=co.cod
join proveedores p on co.proveedores_cod=p.cod
where cu.compras_cod=?  order by cu.cod asc"; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$codcompras="".$codcompras."";
$stmt->bind_param($s,$codcompras);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
		      $cod=$valor['cod'];  
		  	  $compras_cod=utf8_encode($valor['compras_cod']);
		  	  $nrofactura=utf8_encode($valor['nrofactura']);
			  $ruc=utf8_encode($valor['ruc']);
			  $proveedor=utf8_encode($valor['proveedor']);
			  $fechacompra=utf8_encode($valor['fechacompra']);
			  $interes=utf8_encode($valor['interes']);
			  $vto=utf8_encode($valor['vto']);
			  $vtos = date_create($vto);
              $vencimiento= date_format($vtos,"d/m/Y"); 
			  $plazo=utf8_encode($valor['plazo']);
			  $monto1=utf8_encode($valor['monto']);
			  $monto=number_format($monto1,'0',',','.');
			  $totalpagado1=utf8_encode($valor['totalpagado']);
			  $totalpagado=number_format($totalpagado1,'0',',','.');
			  $cantcuota=utf8_encode(obtener_cantidad_cuota($compras_cod));
			  $estado=utf8_encode($valor['estado']);
            if($estado=="PENDIENTE") {	
	          $cantPE=$cantPE+1;
            }
			if($estado=="PAGADO") {	
			  $cantPA=$cantPA+1;
			}
		$total=$monto1-$totalpagado1;
    
				if( $total<=0){
				     $total=0;
				     $sql="update cuoteros_compras_proveedores set estado='PAGADO' where cod='".$cod."'";
				     $stmt = $mysqli->prepare($sql);
					 $stmt->execute(); 
			   } else if( $total>0){
				    $total=$total;
				    $sql="update cuoteros_compras_proveedores set estado='PENDIENTE' where cod='".$cod."'";
					$stmt = $mysqli->prepare($sql);
			 	    $stmt->execute(); 
			   }
          
	  	 $cant=$cant+1;
		if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.="

<tr onclick='' ".$bacground."> 
<td id='td_cod' style='display:none'>".$cod."</td>
<td id='td_compras_cod' style='display:none'>".$compras_cod."</td>
<td id='td_ruc' style='display:none'>".$ruc."</td>
<td id='td_proveedor' style='display:none'>".$proveedor."</td>
<td id='td_fechacompra' style='display:none'>".$fechacompra."</td>
<td id='td_nrofactura' style='display:none'>".$nrofactura."</td>
<td id='td_plazo' class='td_detalles' style='width:10%;background-color: #efeded;color:red;text-align:center;'>".$plazo."/".$cantcuota."</td>
<td id='td_vto' class='td_detalles' style='width:18%;text-align:center;'>".$vencimiento."</td>
<td id='td_monto' class='td_detalles'  style='width:18%;text-align:center;color:green;'>".number_format($total,'0',',','.')."</td>
<td id='td_monto' class='td_detalles'  style='width:18%;text-align:center;color:green;'>".number_format($interes,'0',',','.')."</td>
<td id='td_totalpagado' class='td_detalles' style='width:18%;text-align:center;color:red;'>".$totalpagado."</td>
<td id='td_estado'  class='td_detalles' style='width:18%;text-align:center;'>".$estado."</td>
</tr>
";		  
	  }
 }
  $informacion =array("1" => $pagina,"2" => $cant,"3" => $ruc,"4" => $proveedor,"5" => $fechacompra,"6" => $nrofactura,"7" => $cantPE,"8" => $cantPA,"9" => $compras_cod);
echo json_encode($informacion);	
exit;
}

function buscar_cantidad_cuota_a_pagar_proveedores($compras_cod,$limit){	
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $cant=0;
	 $totalapagar=0;
	 $totdescuento=0;
	 $totalMonto=0;
	 $totalInter=0;
	 $is=0;
		$sql= "SELECT cu.cod,ifnull(cu.interes,0) as interes,cu.vto,cu.plazo,cu.monto,cu.estado,cu.compras_cod,ifnull((SELECT sum(p.monto) from pagos_cuotas_proveedores p where p.estado='PAGADO' and  p.cuoteros_compras_proveedores_cod=cu.cod),0) as totalpagado,co.nrofactura,p.ruc,p.nombre as proveedor,co.fechacompra,cu.estado
FROM cuoteros_compras_proveedores cu
join compras co on cu.compras_cod=co.cod
join proveedores p on co.proveedores_cod=p.cod
where cu.compras_cod=? and cu.estado='PENDIENTE' limit ".$limit."";
$stmt = $mysqli->prepare($sql);
  echo $mysqli -> error; 
$s='s';
$compras_cod="".$compras_cod."";
$stmt->bind_param($s,$compras_cod);
if(!$stmt->execute()){
   echo trigger_error('The query execution failed; 
   said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {	 
 	         $cod=utf8_encode($valor['cod']);
 	         $vto=utf8_encode($valor['vto']);
			 $datea = date_create($vto);
             $fep= date_format($datea,"d/m/Y");
 	         $plazo=utf8_encode($valor['plazo']);
		     $monto=utf8_encode($valor['monto']);
			 $compras_cod=utf8_encode($valor['compras_cod']);
			 $interes=utf8_encode($valor['interes']);
			 $totalpagado=utf8_encode($valor['totalpagado']);
			 $nrofactura=utf8_encode($valor['nrofactura']);
			 $estado=utf8_encode($valor['estado']);
	 $cantcuota=utf8_encode(obtener_cantidad_cuota($compras_cod));	 
     $cant=$cant+1;
     $totalapagar= $totalapagar+$monto+$interes;
	 $totalMonto=$totalMonto+$totalpagado;
  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
				$accion1='habilitar_typeo_en_pagos_cuotas_td_interes("'.$cod.'")';
  $pagina.="
<tr ".$bacground."  style='cursor: default;' '> 
<td id='td_cod' style='display:none'>".$cod."</td>
<td id='td_compras_cod' style='display:none'>".$compras_cod."</td>
<td id='td_nrofactura' style='display:none'>".$nrofactura."</td>
<td id='td_plazo' class='td_detalles' style='width:10%;background-color: #efeded;color:red;text-align:center;'>".$plazo."/".$cantcuota."</td>
<td id='td_vto' class='td_detalles' style='width:18%;text-align:center;'>".$fep."</td>
<td id='td_monto' class='td_detalles'  style='width:18%;text-align:center;color:green;'>". number_format($monto,'0',',','.')."</td>
<td id='td_interes_".$cod."' class='td_detalles'  style='width:18%;    cursor: auto;text-align:center;color:green;'>
<div class='div_td_interes' onclick=".$accion1." name='".$cod."' id='div_interes_".$cod."' >".number_format($interes,'0',',','.')."</div>
</td>
<td id='td_totalpagado' class='td_detalles' style='width:18%;text-align:center;color:red;'>". number_format($totalpagado,'0',',','.')."</td>
<td id='td_estado'  class='td_detalles' style='width:18%;text-align:center;'>".$estado."</td>
</tr>
";
   }
 }
 
$informacion =array("1" => "exito","2" => $pagina,"3" => $cant,"4" => number_format($totalapagar,'0',',','.'),"5" => number_format($totalMonto,'0',',','.'));
echo json_encode($informacion);	
exit;
}

function cargarpagos($montopagado,$fechapago, $compras_cod,$caja_cod,$nrofactura,$sucursales_cod,$usuarios_cod,$hora) {
	 $deuda=0;
	 $monto1=0;
	 $pago=0;
	 $control1=0;
	$mysqli=conectar_al_servidor();
	$sql="Select cr.plazo,cr.cod,cr.vto,(ifnull(cr.monto,'0')+ifnull(cr.interes,'0')) as total,ifnull(cr.interes,'0') as interes,
	IFNULL((select sum(pg.monto) from pagos_cuotas_proveedores pg where pg.cuoteros_compras_proveedores_cod=cr.cod and pg.estado='PAGADO'),0) as totalPago
    from  cuoteros_compras_proveedores cr 
    where cr.compras_cod='".$compras_cod."' and IFNULL((select sum(pg.monto) from pagos_cuotas_proveedores pg where pg.cuoteros_compras_proveedores_cod=cr.cod and pg.estado='PAGADO'),0) < cr.monto order by cr.cod asc"; 
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
			  $cuota=utf8_encode($valor['plazo']);
			  $fechaapagar=utf8_encode($valor['vto']);
			  $interes=utf8_encode($valor['interes']);
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
                    cargarPagosDeudas($interes,$pago,$fechapago,$cuoteros_cod, $compras_cod, $caja_cod,$nrofactura,$usuarios_cod,$hora);
                }			  
	  }
 }
  echo "exito";
exit;
}

function cargarPagosDeudas($interes,$pago,$fechapago,$cuoteros_cod, $compras_cod, $caja_cod,$nrofactura,$usuarios_cod,$hora){
if($pago=="" || $fechapago=="" ||  $cuoteros_cod=="" || $compras_cod=="" || $caja_cod==""  ||  $usuarios_cod==""  || $hora==""){
    echo "camposvacio";	
    exit;
}
$mysqli=conectar_al_servidor();
$consulta="Insert into pagos_cuotas_proveedores (monto,interes, nrofactura, caja_cod, cuoteros_compras_proveedores_cod, compras_cod, hora, usuarios_cod, fecha, descuento, estado) values(?,(select totalinteres from cuoteros where cod='".$cuoteros_cod."'),?,?,?,?,?,?,?,'0','PAGADO')";	
$stmt = $mysqli->prepare($consulta);
$ss='ssssssss';
$stmt->bind_param($ss,$pago,$nrofactura,$caja_cod,$cuoteros_cod, $compras_cod,$hora,$usuarios_cod,$fechapago); 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
$consulta1="Insert into cajadiaria (origen,tipo,caja_cod, nro,egreso, descripcion, ingreso, fecha, hora,cuoteros_cod, estado) 
values
('COMPRAS','PAGO',?,?,?,(SELECT concat('Compras a ',p.nombre) FROM compras c join proveedores p on  c.proveedores_cod=p.cod where  c.cod='".$compras_cod."'),'0',?,?,?,'ACTIVO')";	
$stmt1 = $mysqli->prepare($consulta1);
$ss1='ssssss';
$montopaga=$pago-$interes;
$stmt1->bind_param($ss1,$caja_cod,$nrofactura,$montopaga,$fechapago,$hora,$cuoteros_cod); 
if ( ! $stmt1->execute()) {
   echo "Error";
   exit;
}
cargarpagos_a_cajadiaria($fechapago,$cuoteros_cod, $compras_cod, $caja_cod,$nrofactura,$usuarios_cod,$hora);
}

function cargarpagos_a_cajadiaria($fechapago,$cuoteros_cod, $compras_cod, $caja_cod,$nrofactura,$usuarios_cod,$hora) {
    $mysqli=conectar_al_servidor();
	$sql="SELECT ifnull(cu.interes,'0') as interes
from cuoteros_compras_proveedores cu 
join pagos_cuotas_proveedores co on co.cuoteros_compras_proveedores_cod=cu.cod
where cu.cod='".$cuoteros_cod."' and co.nrofactura='".$nrofactura."'"; 
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
	     if(intVal($interes)>0){
				$consulta1="Insert into cajadiaria (origen,tipo,caja_cod, nro,ingreso, descripcion,egreso , fecha, hora,cuoteros_cod, estado) values('COMPRAS','INTERES',?,?,'0',(SELECT concat('Int. pagado a ',p.nombre) FROM compras c join proveedores p on  c.proveedores_cod=p.cod where  c.cod='".$compras_cod."'),(select ifnull(interes,'0') from cuoteros_compras_proveedores where cod='".$cuoteros_cod."'),?,?,?,'ACTIVO')";	
				$stmt1 = $mysqli->prepare($consulta1);
				$ss1='sssss';
				$stmt1->bind_param($ss1,$caja_cod,$nrofactura,$fechapago,$hora,$cuoteros_cod); 
				if ( ! $stmt1->execute()) {
				   echo "Error";
				   exit;
				}
			}
               
		  
        			
	  }
 }
}

function cargarcomprascontado($vto,$monto,$usuarios_cod,$hora){
if($vto=="" || $monto=="" || $usuarios_cod==""  ){
    echo "camposvacio";	
    exit;
}
$mysqli=conectar_al_servidor();
$consulta1="Insert into cuoteros_compras_proveedores (vto, plazo, monto, hora, usuarios_cod,fecha, compras_cod, estado)
values(upper(?),'1',upper(?),upper(?),upper(?),current_date(),(select max(cod) from compras where estado='ACTIVO' limit 1),'ACTIVO')";
$stmt1 = $mysqli->prepare($consulta1);
echo $mysqli -> error;
$ss='ssss';
$stmt1->bind_param($ss,$vto,$monto,$hora,$usuarios_cod);
if ( ! $stmt1->execute()) {
   echo "Error";
   exit;
}
  echo "exito";
}

function obtener_cantidad_cuota($compras_cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "SELECT count(cod) as cantidad FROM cuoteros_compras_proveedores where compras_cod='".$compras_cod."'";
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

function buscar_detalles_historial_compras_insumos($buscar,$codsucursal){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $cant=0;
	 $sql= "SELECT c.cod
	 ,c.nrofactura
	 ,p.nombre as proveedor
	 ,c.condicion
	 ,(SELECT sum(subtotal)  FROM detalles_compras where compras_cod=c.cod) as total
	 ,(SELECT sum(monto) from pagos_cuotas_proveedores where compras_cod=c.cod) as pagos
	 ,s.nombres as sucursal
	 ,c.fechacompra
	 ,c.estado  
FROM compras c
join proveedores p on c.proveedores_cod=p.cod
join sucursales s on c.sucursales_cod=s.cod
where c.estado='ACTIVO' and c.sucursales_cod=? and concat(c.nrofactura,' ',p.nombre) like ?  order by c.cod desc"; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
$buscar="%".$buscar."%";
$codsucursal="".$codsucursal."";
$stmt->bind_param($s,$codsucursal,$buscar);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
		      $cod=$valor['cod'];  
		  	  $nrofactura=utf8_encode($valor['nrofactura']);
			  $proveedor=utf8_encode($valor['proveedor']);
			  $sucursal=utf8_encode($valor['sucursal']);
			  $fechacompra=utf8_encode($valor['fechacompra']);
			  $condicion=utf8_encode($valor['condicion']);
			  $total1=utf8_encode($valor['total']);
			  $total=number_format($total1,'0',',','.');
			  $pago1=utf8_encode($valor['pagos']);
			  $pago=number_format($pago1,'0',',','.');
			  $estado=utf8_encode($valor['estado']);
              if($estado=="ACTIVO"){
               $estadoactual="PENDIENTE";
              }
             $datea = date_create($fechacompra);
            $fecha= date_format($datea,"d/m/Y");
 
	  	 $cant=$cant+1;
		if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
		 $onclick1='abrir_cerrar_ventanas_historial_detalles_compras_proveedores("1","'.$cod.'")';
				$accion2='ver_vetana_permiso(id_progreso,"6","","'.$cod.'")';
$pagina.="

<tr class='table_blanco_compras' >

<td class='td_detalles' style='width:0%;display:none;'>".$cod."</td>
<td class='td_detalles' style='width:10%;background-color:#e3e2e2;color:red;text-align:center;'>".$nrofactura."</td>
<td class='td_detalles' style='width:20%;' >".$proveedor."</td>
<td class='td_detalles' style='width:10%;' >".$total." Gs.</td>
<td class='td_detalles' style='width:10%;' >".$pago." Gs.</td>
<td class='td_detalles' style='width:10%;' >".$condicion."</td>
<td class='td_detalles' style='width:15%;' >".$sucursal."</td>
<td class='td_detalles' style='width:10%;' >".$fecha."</td>
<td class='td_detalles' style='width:10%;' >".$estadoactual."</td>
<td class='td_detalles' style='width:7.5%;text-align:center;'>
<center><button type='button' onclick=".$onclick1." class='input_atras' style='height: 33px;width: 33px;box-shadow: inset 0px -1px 2px 0px #afafaf;background: var(--colorbotonphoto);'><img src='./icono/ver.png' style='width:24px;height:24px;'></button></center>
</td>
<td class='td_detalles' style='width:7.5%;text-align:center;'>
<center><button type='button' onclick=".$accion2." class='input_atras' style='height: 33px;width: 33px;box-shadow: inset 0px -1px 2px 0px #afafaf;background: var(--colorbotoneliminar);'><img src='./icono/delete.png' style='width:20px;height:20px;'></button></center>
</td>
</tr>
";		  
	  }
 }
  $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_detalles_historial_detallescompras_insumos($codcompras){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $cant=0;
	 $subtotales=0;
	 $sql= "SELECT concat(s.nombres,' ',s.numero) as sucursal,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as cajero,co.fechacompra,co.hora,d.cod,c.nombres as concepto,d.concepto as descripcion,d.cantidad,d.precio,d.subtotal,d.estado 
FROM detalles_compras d
join conceptos c on d.conceptos_cod=c.cod
join compras co on d.compras_cod=co.cod
join usuarios u on co.usuarios_cod=u.cod
join personas p on u.personas_cod=p.cod
join sucursales s on u.sucursales_cod=s.cod
where  d.compras_cod=? order by d.cod desc"; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$codcompras="".$codcompras."";
$stmt->bind_param($s,$codcompras);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
		      $cod=$valor['cod'];  
		  	  $concepto=utf8_encode($valor['concepto']);
			  $descripcion=utf8_encode($valor['descripcion']);
			  $cantidad=utf8_encode($valor['cantidad']);
			  $precio1=utf8_encode($valor['precio']);
              $precio=number_format($precio1,'0',',','.');
			  $subtotal1=utf8_encode($valor['subtotal']);
              $subtotal=number_format($subtotal1,'0',',','.');
			  $estado=utf8_encode($valor['estado']);
			  $sucursal=utf8_encode($valor['sucursal']);
			  $cajero=utf8_encode($valor['cajero']);
			  $fechacompra=utf8_encode($valor['fechacompra']);
			  $hora=utf8_encode($valor['hora']);
             
             
 
	  	 $cant=$cant+1;
	  	 $subtotales=$subtotales+$subtotal1;
		if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
		
$pagina.="

<tr ".$bacground." >

<td class='td_detalles' style='width:5%;'>".$cod."</td>
<td class='td_detalles' style='width:20%;' >".$concepto."</td>
<td class='td_detalles' style='width:20%;' >".$descripcion."</td>
<td class='td_detalles' style='width:13.7%;' >".$cantidad."</td>
<td class='td_detalles' style='width:13.7%;' >".$precio." Gs.</td>
<td class='td_detalles' style='width:13.7%;' >".$subtotal." Gs.</td>
<td class='td_detalles' style='width:13.7%;' >".$estado."</td>
</tr>
";		  
	  }
 }
  $informacion =array("1" => $pagina,"2" => $cant,"3" => number_format($subtotales,'0',',','.'),"4" => $sucursal,"5" => $cajero,"6" => $fechacompra,"7" => $hora);
echo json_encode($informacion);	
exit;
}

function cargar_interes_a_cuotero($cod,$interes){
$mysqli=conectar_al_servidor();
	if($cod==""){
    echo "camposvacio";	
    exit;
	}

	    $sql="update cuoteros_compras_proveedores set interes='".$interes."' where cod='".$cod."'";
		$stmt = $mysqli->prepare($sql);
    if(!$stmt->execute()) {
     echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
     exit;
    }
	 
	echo"exito";
}




verificar_datos();
?>