<?php
require("conexion.php");
function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
	
		if($func=='cargar_decuento_cuotero'){
			$cod1 = $_POST['cod1'];
			$cod1 = utf8_decode($cod1);
			$decuento1 = $_POST['decuento1'];
			$decuento1 = utf8_decode($decuento1);
			$cod_permiso = $_POST['cod_permiso'];
			$cod_permiso = utf8_decode($cod_permiso);
			cargar_decuento_cuotero($decuento1,$cod1,$cod_permiso);
		}
		if($func=='buscar_detalles_cuoteros'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_cuoteros($cod);
		}
        
     if($func=='buscar_detalles_ventas'){
			$nrosolicitud = $_POST['nrosolicitud'];
			$nrosolicitud = utf8_decode($nrosolicitud);
			buscar_detalles_ventas($nrosolicitud);
		}
 
         if($func=='buscar_detalles_solicitudes'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_solicitudes($cod);	
		}
		if($func=='guardar'){
	        
		    $gastosadministrativos = $_POST['gastosadministrativos'];
			$gastosadministrativos = utf8_decode($gastosadministrativos);
			
		    $int_financ = $_POST['int_financ'];
			$int_financ = utf8_decode($int_financ);
			
		    $sistema = $_POST['sistema'];
			$sistema = utf8_decode($sistema);
		    
		    $cod = $_POST['cod'];
			$cod = utf8_decode($cod);


            $clientes_cod = $_POST['clientes_cod'];
			$clientes_cod = utf8_decode($clientes_cod);
			
			$nrosolicitud = $_POST['nrosolicitud'];
			$nrosolicitud = utf8_decode($nrosolicitud);
			
			$condicion = $_POST['condicion'];
			$condicion = utf8_decode($condicion);
			
			$tipooperacion = $_POST['tipooperacion'];
			$tipooperacion = utf8_decode($tipooperacion);
			
			$tipointeres = $_POST['tipointeres'];
			$tipointeres = utf8_decode($tipointeres);
			
			$nrofactura = $_POST['nrofactura'];
			$nrofactura = utf8_decode($nrofactura);
			
			$fecha_ent_cobrador = $_POST['fecha_ent_cobrador'];
			$fecha_ent_cobrador = utf8_decode($fecha_ent_cobrador);
			
			$moneda = $_POST['moneda'];
			$moneda = utf8_decode($moneda);
			
			$monto = $_POST['monto'];
			$monto = utf8_decode($monto);
		    
			$plazo = $_POST['plazo'];
			$plazo = utf8_decode($plazo);
			
			$fechapago = $_POST['fechapago'];
			$fechapago = utf8_decode($fechapago);
			
			$tasaanual = $_POST['tasaanual'];
			$tasaanual = utf8_decode($tasaanual);
			
			$impuesto = $_POST['impuesto'];
			$impuesto = utf8_decode($impuesto);
			
			$vendedor_cod = $_POST['vendedor_cod'];
			$vendedor_cod = utf8_decode($vendedor_cod);
			
			$cobrador_cod = $_POST['cobrador_cod'];
			$cobrador_cod = utf8_decode($cobrador_cod);
			
			$sucursales_cod = $_POST['sucursales_cod'];
			$sucursales_cod = utf8_decode($sucursales_cod);
			
			$usuarios_cod = $_POST['usuarios_cod'];
			$usuarios_cod = utf8_decode($usuarios_cod);
			
			$hora = $_POST['hora'];
			$hora = utf8_decode($hora);
			
			$interes = $_POST['interes'];
			$interes = utf8_decode($interes);
			
			$interesfinanciero = $_POST['interesfinanciero'];
			$interesfinanciero = utf8_decode($interesfinanciero);
			
			$amortizacion = $_POST['amortizacion'];
			$amortizacion = utf8_decode($amortizacion);
			
			$diasdegracia = $_POST['diasdegracia'];
			$diasdegracia = utf8_decode($diasdegracia);	

			$montocuota = $_POST['montocuota'];
			$montocuota = utf8_decode($montocuota);

			$codigosolicitud = $_POST['codigosolicitud'];
			$codigosolicitud = utf8_decode($codigosolicitud);
		    
			mantenimiento($sistema,$int_financ,$gastosadministrativos,$cod,$clientes_cod,$codigosolicitud,$nrosolicitud,$condicion,$tipooperacion,$tipointeres,$nrofactura,$fecha_ent_cobrador,$moneda,$monto,$plazo,$fechapago,$tasaanual,$impuesto,$vendedor_cod,$cobrador_cod,$sucursales_cod,$usuarios_cod,$hora,$interes,$interesfinanciero,$amortizacion,$diasdegracia,$montocuota);
		}
}

function mantenimiento($sistema,$int_financ,$gastosadministrativos,$cod,$clientes_cod,$codigosolicitud,$nrosolicitud,$condicion,$tipooperacion,$tipointeres,$nrofactura,$fecha_ent_cobrador,$moneda,$monto,$plazo,$fechapago,$tasaanual,$impuesto,$vendedor_cod,$cobrador_cod,$sucursales_cod,$usuarios_cod,$hora,$interes,$interesfinanciero,$amortizacion,$diasdegracia,$montocuota){
	if($nrosolicitud=="" || $condicion=="" ||  $sistema=="" ||  $int_financ=="" ||  $gastosadministrativos=="" || $tipooperacion=="" || $tipointeres==""  || $nrofactura==""  || $moneda=="" || $monto==""  || $plazo=="" || $fechapago=="" || $tasaanual=="" || $cobrador_cod=="" || $montocuota=="" || $clientes_cod==""){
    echo "camposvacio";	
    exit;
}

$mysqli=conectar_al_servidor();

$consulta= "Select count(*) from ventas where nrosolicitud=? and estado='ACTIVO' ";
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
   $sql="insert into ventas (int_financ,clientes_cod,nrosolicitud,condicion,tipooperacion,nrofactura,fecha_ent_cobrador,monto,moneda,vendedor_cod,cobrador_cod,sucursales_cod,usuarios_cod,hora,horaventa, cambio,descuento,saldo,fecha,fechaventa,estado) value (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,'0','0','0',current_date(),current_date(),'ACTIVO')";
   $s='sssssssssssssss';


   $stmt = $mysqli->prepare($sql);
   $stmt->bind_param($s,$int_financ,$clientes_cod,$nrosolicitud,$condicion,$tipooperacion,$nrofactura,$fecha_ent_cobrador,$monto,$moneda,$vendedor_cod,$cobrador_cod,$sucursales_cod,$usuarios_cod,$hora,$hora); 
   
   if ( ! $stmt->execute()) {
    echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}

     $sql1="insert into detalles_ventas (ventas_cod, fecha, hora, iva, cantidad, precio, estado, codigos_productos_cod) value ((select max(cod) from ventas limit 1),current_date(),'".$hora."','0','1','".$interesfinanciero*$plazo."','ACTIVO','2')";
     $stmt1 = $mysqli->prepare($sql1);
     if ( ! $stmt1->execute()) {
       echo trigger_error('The query execution failed; MySQL said ('.$stmt1->errno.') '.$stmt1->error, E_USER_ERROR);
     exit;
    }
	 $sql1="insert into detalles_ventas (ventas_cod, fecha, hora, iva, cantidad, precio, estado, codigos_productos_cod) value ((select max(cod) from ventas limit 1),current_date(),'".$hora."','0','1','".$gastosadministrativos*$plazo."','ACTIVO','3')";
     $stmt1 = $mysqli->prepare($sql1);
     if ( ! $stmt1->execute()) {
       echo trigger_error('The query execution failed; MySQL said ('.$stmt1->errno.') '.$stmt1->error, E_USER_ERROR);
     exit;
    }
    
  



  generarcuotero($sistema,$gastosadministrativos,$nrofactura,$codigosolicitud,$condicion,$montocuota,$plazo,$interes,$fechapago,$interesfinanciero,$amortizacion,$tipointeres,$tasaanual,$impuesto,$diasdegracia,$hora,$usuarios_cod);


}
	


function generarcuotero($sistema,$gastosadministrativos,$nrofactura,$codigosolicitud,$condicion,$Monto,$plazo,$interes,$fechapago,$interesfinanciero,$amortizacion,$tipointeres,$tasaanual,$impuesto,$diasdegracia,$hora,$usuario) {

			 $a=0;
			 
			 $estado="PENDIENTE";
			 $F=0;
			 $fechaInicio=$fechapago;
			 $cantidad=$plazo;
			 
			  if($Monto<0){
			$Monto=0;
		}
		if($condicion=='DIAS'){
			while ($a<$cantidad){		
		    $fecha = strtotime('+'.$F." days",strtotime($fechaInicio));
            $fecha=date("Y-m-d H:i:s",$fecha); 
			insertarcuotas($sistema,$gastosadministrativos,$Monto, ($a+1), $interes, $fecha,$interesfinanciero,$amortizacion,$tipointeres,$tasaanual,$impuesto,$diasdegracia,$hora,$usuario);
		    $a++;
	      if(date("w",strtotime($fecha))==6){
          $F=$F+2;
          }else{
          $F=$F+1;
          } 
	     }
		}
		if($condicion=='SEMANAL'){
			while ($a<$cantidad){		
				$fecha = strtotime('+'.$F." days",strtotime($fechaInicio));
			    $fecha=date("Y-m-d H:i:s",$fecha);
				insertarcuotas($sistema,$gastosadministrativos,$Monto, ($a+1), $interes, $fecha,$interesfinanciero,$amortizacion,$tipointeres,$tasaanual,$impuesto,$diasdegracia,$hora,$usuario);
		    $a++;
	     $F=$F+7;
	     }
		}
		if($condicion=='QUINCENAL'){
			while ($a<$cantidad){		
				$fecha = strtotime('+'.$F." days",strtotime($fechaInicio));
			    $fecha=date("Y-m-d H:i:s",$fecha);
				insertarcuotas($sistema,$gastosadministrativos,$Monto, ($a+1), $interes, $fecha,$interesfinanciero,$amortizacion,$tipointeres,$tasaanual,$impuesto,$diasdegracia,$hora,$usuario);
		    $a++;
	     $F=$F+14;
	     }
		}if($condicion=='MENSUAL'){
			while ($a<$cantidad){		
				$fecha = strtotime('+'.$F." month",strtotime($fechaInicio));
			    $fecha=date("Y-m-d H:i:s",$fecha);
				insertarcuotas($sistema,$gastosadministrativos,$Monto, ($a+1), $interes, $fecha,$interesfinanciero,$amortizacion,$tipointeres,$tasaanual,$impuesto,$diasdegracia,$hora,$usuario);
		    $a++;
	     $F=$F+1;
	     }
		}
	$mysqli=conectar_al_servidor();
$consulta1="update solicitudescreditos set estadosolicitud='IMPRIMIDO' where cod=?";
$stmt1 = $mysqli->prepare($consulta1);
$ss='s';
$stmt1->bind_param($ss,$codigosolicitud); 
if ( ! $stmt1->execute()) {
   echo "Error";
   exit;
}
$consulta2="update ajustesfactura set nrofactura=? where estado='ACTIVO'";
$stmt2 = $mysqli->prepare($consulta2);
$ss='s';
$stmt2->bind_param($ss,$nrofactura); 
if ( ! $stmt2->execute()) {
   echo "Error";
   exit;
}

echo"exito";

}

function insertarcuotas($sistema,$gastosadministrativos,$Monto, $plazo, $interes, $fecha_pagar,$interesfinanciero,$amortizacion,$tipointeres,$tasaanual,$impuesto,$diasdegracia,$hora,$usuario){
		$mysqli=conectar_al_servidor();
			$consulta="Insert into cuoteros (sistema,gastosadministrativos,cuota, plazo, interes, totalinteres, fechaapagar, interesfinanciero, amortizacion,impuesto, tipointeres, tasaanual, diasdegracia, diasatrasados, hora, usuarios_cod,ventas_cod, fecha,estado) values(?,?,?,?,?,'0',?,?,?,?,?,?,?,'0',?,?,(select max(cod) from ventas limit 1),current_date(),'PENDIENTE')";	

$stmt = $mysqli->prepare($consulta);
$ss='ssssssssssssss';
$stmt->bind_param($ss,$sistema,$gastosadministrativos,$Monto,$plazo,$interes,$fecha_pagar,$interesfinanciero,$amortizacion,$impuesto,$tipointeres,$tasaanual,$diasdegracia,$hora,$usuario); 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}	
}

function cargar_decuento_cuotero($decuento1,$cod1,$cod_permiso){
		$mysqli=conectar_al_servidor();
			$consulta="update cuoteros set descuento=?,cod_permiso=? where cod=?";	
$stmt = $mysqli->prepare($consulta);
$ss='sss';
$stmt->bind_param($ss,$decuento1,$cod_permiso,$cod1); 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
echo"exito";
}


function buscar_detalles_cuoteros($cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $cant=0;
	 $sql= "SELECT c.plazo,c.fechaapagar,c.amortizacion,c.interesfinanciero,c.cuota 
FROM cuoteros c
join ventas v on c.ventas_cod=v.cod
where v.nrosolicitud=?"; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$cod="".$cod."";
$stmt->bind_param($s,$cod);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
		      $plazo=$valor['plazo'];  
		  	  $fechaapagar=utf8_encode($valor['fechaapagar']);
			  $amortizacion1=utf8_encode($valor['amortizacion']);
              $amortizacion=number_format($amortizacion1,'0',',','.');
			  $interesfinanciero1=utf8_encode($valor['interesfinanciero']);
              $interesfinanciero=number_format($interesfinanciero1,'0',',','.');
			  $cuota1=utf8_encode($valor['cuota']);
              $cuota=number_format($cuota1,'0',',','.'); 
	  	 $cant=$cant+1;
		if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.="

<tr ".$bacground." >

<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;'>".$plazo."</td>
<td class='td_detalles' style='width:23.75%;' >".$fechaapagar."</td>
<td class='td_detalles' style='width:23.75%;' >".$amortizacion."</td>
<td class='td_detalles' style='width:23.75%;' >".$interesfinanciero."</td>
<td class='td_detalles' style='width:23.75%;' >".$cuota."</td>
</tr>
";		  
	  }
 }
  $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_detalles_solicitudes($cod) {
$mysqli=conectar_al_servidor();
$sql='';
$cant=0;
$sql= "SELECT s.usuarios_cod,s.cod,s.nrosolicitud,s.clientes_cod,p1.cedula,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as Cliente
,p.montodisponible as montosolicitado,s.condicionaprobado,s.montoaprobado, s.plazoaprobado,s.montocuotaaprobada,s.estadosolicitud
,u.sucursales_cod,concat(su.nombres,' ',su.numero) as sucursales 
FROM solicitudescreditos s 
join planprestamos p on s.monto=p.cod
join personas p1 on s.clientes_cod=p1.cod
join usuarios u on s.usuarios_cod=u.cod
join personas p2 on u.personas_cod=p2.cod
join sucursales su on u.sucursales_cod=su.cod
 where s.cod='$cod'  and s.estado='ACTIVO' "; 

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
			$clientes_cod=utf8_encode($valor['clientes_cod']);
			$cedula=utf8_encode($valor['cedula']);
			$Cliente=utf8_encode($valor['Cliente']);
			$condicionaprobado=utf8_encode($valor['condicionaprobado']);
			$plazoaprobado=utf8_encode($valor['plazoaprobado']);
			$montosolicitado1=utf8_encode($valor['montosolicitado']);
            $montosolicitado=number_format($montosolicitado1,'0',',','.');
			$montoaprobado1=utf8_encode($valor['montoaprobado']);
            $montoaprobado=number_format($montoaprobado1,'0',',','.');
		    $montocuotaaprobada1=utf8_encode($valor['montocuotaaprobada']);
            $montocuotaaprobada=number_format($montocuotaaprobada1,'0',',','.');
	        $estadosolicitud=utf8_encode($valor['estadosolicitud']);			 
	        $usuarios_cod=utf8_encode($valor['usuarios_cod']);			 
	        $Vendedor=utf8_encode(obtener_vendedor($cod));		 
	        $Vendedor_cod=utf8_encode(obtener_codvendedor($cod));		 
	        $sucursales_cod=utf8_encode($valor['sucursales_cod']);			 
	        $sucursales=utf8_encode($valor['sucursales']);		
            $totalcuota1=$montocuotaaprobada1*$plazoaprobado;
            $totalcuota=number_format($totalcuota1,'0',',','.');
            $interesfinanciero1=$totalcuota1-$montoaprobado1;	
            $interesfinanciero=number_format($interesfinanciero1,'0',',','.');	
            $impuesto1=$interesfinanciero1/11;
            $impuesto=number_format($impuesto1,'0',',','.');
            $entrega1=$montoaprobado1-$impuesto1;
            $entrega=number_format($entrega1,'0',',','.');			
$cant=$cant+1;
 }
 }
$informacion1 =array("1" => $cod,"2" => $nrosolicitud,"3" => $clientes_cod,"4" => $cedula,"5" => $Cliente,
"6" => $condicionaprobado,"7" => $plazoaprobado,"8" => $montosolicitado,"9" => $montoaprobado,"10" => $montocuotaaprobada,"11" => $Vendedor_cod,
"12" => $Vendedor,"13" => $sucursales_cod,"14" => $sucursales,"15" => $totalcuota,"16" => $interesfinanciero,"17" => $impuesto,"18" => $entrega);
echo json_encode($informacion1);	
exit;

}


 function obtener_vendedor($cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "SELECT concat(p2.primernombre,' ',p2.segundonombre,' ',p2.primerapellido,' ',p2.segundoapellido,' ',p2.apellidocasada) as analista 
FROM solicitudescreditos a
join usuarios u on a.vendedor_cod=u.cod
join personas p2 on u.personas_cod=p2.cod where a.cod='$cod' and a.estado='ACTIVO'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $analista=$valor['analista'];  
	  }
 }
 return $analista;
}

 function obtener_codvendedor($cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "SELECT a.vendedor_cod as analista
FROM solicitudescreditos a
join usuarios u on a.vendedor_cod=u.cod
join personas p2 on u.personas_cod=p2.cod where a.cod='$cod' and a.estado='ACTIVO'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $analista=$valor['analista'];  
	  }
 }
 return $analista;
}

function buscar_detalles_ventas($nrosolicitud) {
$mysqli=conectar_al_servidor();
$sql='';
$cant=0;
$sql= "SELECT v.int_financ,v.cod, v.fecha, v.nrosolicitud, v.condicion, v.tipooperacion, v.nrofactura, v.fecha_ent_cobrador, v.monto, c.interesfinanciero*count(c.plazo) as interesfinanciero
,((v.monto)+(c.interesfinanciero*count(c.plazo)))as totalcuota,v.monto-c.impuesto as totalentregar, c.impuesto, v.moneda, v.vendedor_cod,
concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as vendedor, v.cobrador_cod,
concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as cobrador, 
v.sucursales_cod,concat(s.nombres,' ',s.numero) as sucursal, c.interes, c.fechaapagar, c.tipointeres, c.tasaanual, c.ventas_cod,c.diasdegracia
,v.clientes_cod,p2.cedula,concat(p2.primernombre,' ',p2.segundonombre,' ',p2.primerapellido,' ',p2.segundoapellido,' ',p2.apellidocasada) as cliente,count(c.plazo) as cantidad,c.cuota as montocuota
FROM ventas v 
join cuoteros c on c.ventas_cod=v.cod
join sucursales s on v.sucursales_cod=s.cod
join usuarios u on v.vendedor_cod=u.cod
join personas p on u.personas_cod=p.cod
join usuarios u1 on v.cobrador_cod=u1.cod
join personas p1 on u1.personas_cod=p1.cod
join personas p2 on v.clientes_cod=p2.cod
where v.nrosolicitud='$nrosolicitud' and v.estado='ACTIVO' "; 

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
		  
			$cod=utf8_encode($valor['cod']);
			$int_financ=utf8_encode($valor['int_financ']);
			$fecha=utf8_encode($valor['fecha']);
			$cantidad=utf8_encode($valor['cantidad']);
			$nrosolicitud=utf8_encode($valor['nrosolicitud']);
			$condicion=utf8_encode($valor['condicion']);
			$tipooperacion=utf8_encode($valor['tipooperacion']);
			$nrofactura=utf8_encode($valor['nrofactura']);
			$fecha_ent_cobrador=utf8_encode($valor['fecha_ent_cobrador']);
			$monto1=utf8_encode($valor['monto']);
            $monto=number_format($monto1,'0',',','.');
			$montocuota1=utf8_encode($valor['montocuota']);
            $montocuota=number_format($montocuota1,'0',',','.');
			$interesfinanciero1=utf8_encode($valor['interesfinanciero']);
            $interesfinanciero=number_format($interesfinanciero1,'0',',','.');
		    $totalcuota1=utf8_encode($valor['totalcuota']);
            $totalcuota=number_format($totalcuota1,'0',',','.');
            $totalentregar1=utf8_encode($valor['totalentregar']);
            $totalentregar=number_format($totalentregar1,'0',',','.');
            $impuesto1=utf8_encode($valor['impuesto']);
            $impuesto=number_format($impuesto1,'0',',','.');
	        $moneda=utf8_encode($valor['moneda']);			 
	        $vendedor_cod=utf8_encode($valor['vendedor_cod']);			 
	        $vendedor=utf8_encode($valor['vendedor']);		 
	        $cobrador_cod=utf8_encode($valor['cobrador_cod']);			 
	        $cobrador=utf8_encode($valor['cobrador']);			 
	        $sucursales_cod=utf8_encode($valor['sucursales_cod']);			 
	        $sucursal=utf8_encode($valor['sucursal']);		
	        $interes=utf8_encode($valor['interes']);		
	        $fechaapagar=utf8_encode($valor['fechaapagar']);		
	        $tipointeres=utf8_encode($valor['tipointeres']);		
	        $tasaanual=utf8_encode($valor['tasaanual']);		
	        $ventas_cod=utf8_encode($valor['ventas_cod']);		
	        $clientes_cod=utf8_encode($valor['clientes_cod']);		
	        $cedula=utf8_encode($valor['cedula']);		
	        $cliente=utf8_encode($valor['cliente']);		
	        $diasdegracia=utf8_encode($valor['diasdegracia']);		
            		
$cant=$cant+1;
 }
 }
$informacion1 =array("1" => $cod,"2" => $fecha,"3" => $nrosolicitud,"4" => $condicion,"5" => $tipooperacion,
"6" => $nrofactura,"7" => $fecha_ent_cobrador,"8" => $monto,"9" => $interesfinanciero,"10" => $totalcuota,"11" => $totalentregar,
"12" => $impuesto,"13" => $sucursales_cod,"14" => $sucursal,"15" => $moneda,"16" => $vendedor_cod,"17" => $vendedor,"18" => $cobrador_cod
,"19" => $cobrador,"20" => $interes,"21" => $fechaapagar,"22" => $tipointeres,"23" => $tasaanual,"24" => $ventas_cod,"25" => $clientes_cod,
"26" => $cedula,"27" => $cliente,"28" => $cantidad,"29" => $montocuota,"30" => $diasdegracia,"31" => $int_financ);
echo json_encode($informacion1);	
exit;

}

verificar_datos();
?>