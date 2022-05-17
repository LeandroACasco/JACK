<?php
require("conexion.php");

function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
		if($func=='buscar'){
			$buscar = $_POST['buscar'];
			$buscar = utf8_decode($buscar);
			
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);	
			buscar($buscar,$caja_cod);
		}
		 if($func=='anular_otrosingresos'){
	
            $nrocomprobante = $_POST['nrocomprobante'];
			$nrocomprobante = utf8_decode($nrocomprobante);	

            $clavepermisoanulacion = $_POST['clavepermisoanulacion'];
			$clavepermisoanulacion = utf8_decode($clavepermisoanulacion);	
		    anular_otrosingresos($nrocomprobante,$clavepermisoanulacion);	
		}
		if($func=='buscarcombo'){		
			buscar_combo();	
		}
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
			
			
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);

		$sucursales_cod = $_POST['sucursales_cod'];
		$sucursales_cod = utf8_decode($sucursales_cod);
		
		$monto = $_POST['monto'];
		$monto = utf8_decode($monto);
		
		$personas_cod = $_POST['personas_cod'];
		$personas_cod = utf8_decode($personas_cod);
		
		$cobrador_cod = $_POST['cobrador_cod'];
		$cobrador_cod = utf8_decode($cobrador_cod);
						
		$nro = $_POST['nro'];
		$nro = utf8_decode($nro);

		$conceptos_cod = $_POST['conceptos_cod'];
		$conceptos_cod = utf8_decode($conceptos_cod);
						

		$detalles = $_POST['detalles'];
		$detalles = utf8_decode($detalles);

		$moneda = $_POST['moneda'];
		$moneda = utf8_decode($moneda);

		$caja_cod = $_POST['caja_cod'];
		$caja_cod = utf8_decode($caja_cod);

		$fecha = $_POST['fecha'];
		$fecha = utf8_decode($fecha);
						
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
						
		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
		
		mantenimiento($func,$sucursales_cod,$cod,$monto,$nro,$conceptos_cod,$detalles,$moneda,$caja_cod,$personas_cod,$cobrador_cod,$usuarios_cod,$fecha,$hora);
		}
		}	


function mantenimiento($func,$sucursales_cod,$cod,$monto,$nro,$conceptos_cod,$detalles,$moneda,$caja_cod,$personas_cod,$cobrador_cod,$usuarios_cod,$fecha,$hora){
	 if($hora=="" || $monto=="" || $sucursales_cod=="" ||  $conceptos_cod=="" || $detalles==""  || $caja_cod==""  || $personas_cod==""  ||  $usuarios_cod=="" || $fecha==""  || $hora=="" ){
    echo "camposvacio";	
    exit;
	} 

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from otrosingresos where cod=?  ";
$stmt = $mysqli->prepare($consulta);
$ss='s';
$stmt->bind_param($ss,$cod); 
if ( ! $stmt->execute()) {
   echo "Error1";
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
   $sql="insert into otrosingresos (monto, nro, personas_cod, cobrador_cod, conceptos_cod, detalles, moneda, caja_cod, fecha, hora, usuarios_cod, estado) value (upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),'ACTIVO')";
   $s='sssssssssss';
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
   $stmt->bind_param($s,$monto,$nro,$personas_cod,$cobrador_cod,$conceptos_cod,$detalles,$moneda,$caja_cod,$fecha,$hora,$usuarios_cod); 
$consulta1="Insert into cajadiaria (origen,tipo,caja_cod, nro,egreso, descripcion, ingreso, fecha, hora, estado) 
values
('OTROSINGRESOS','OTROSINGRESOS',?,?,'0',(select concat('".$detalles." ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) from personas p where p.cod='".$personas_cod."' ),?,?,?,'ACTIVO')";	
$stmt1 = $mysqli->prepare($consulta1);
$ss1='sssss';
$stmt1->bind_param($ss1,$caja_cod,$nro,$monto,$fecha,$hora); 
if ( ! $stmt1->execute()) {
   echo "Error";
}
if($nro!=""){
 $consulta2="update ajustesfactura set nrorecibo=? where estado='ACTIVO' and sucursal_cod=?";
$stmt2 = $mysqli->prepare($consulta2);
$ss='ss';
$stmt2->bind_param($ss,$nro,$sucursales_cod); 
if ( ! $stmt2->execute()) {
   echo "Error";
   exit;
}	
}



}
   if ( ! $stmt->execute()) {
     echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
	echo"exito";
}
	
function buscar($buscar,$caja_cod){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT o.cod, o.monto, o.nro, o.personas_cod,p.cedula as cedulacliente,
concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as cliente,
 o.cobrador_cod,p2.cedula as cedulacobrador,
 concat(p2.primernombre,' ',p2.segundonombre,' ',p2.primerapellido,' ',p2.segundoapellido,' ',p2.apellidocasada) as cobrador,
 o.conceptos_cod,c.nombres as concepto, o.detalles, o.moneda, o.caja_cod, o.fecha, o.hora, o.usuarios_cod, o.estado 
FROM otrosingresos o
join personas p on o.personas_cod=p.cod
join usuarios u on o.cobrador_cod=u.cod
join personas p2 on u.personas_cod=p2.cod
join conceptos c on o.conceptos_cod=c.cod
 where o.estado='ACTIVO' and o.caja_cod=? and concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) like ? "; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
$buscar="%".$buscar."%";
$caja_cod="".$caja_cod."";
$stmt->bind_param($s,$caja_cod,$buscar);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result)) {
		     
		    
              $cod=utf8_encode($valor['cod']);
		  	  $monto=utf8_encode($valor['monto']);
		  	  $nro=utf8_encode($valor['nro']);
		  	  $personas_cod=utf8_encode($valor['personas_cod']);
		  	  $cedulacliente=utf8_encode($valor['cedulacliente']);
		  	  $cliente=($valor['cliente']);
		  	  $cobrador_cod=utf8_encode($valor['cobrador_cod']);
		  	  $cedulacobrador=utf8_encode($valor['cedulacobrador']);
		  	  $cobrador=utf8_encode($valor['cobrador']);
		  	  $conceptos_cod=utf8_encode($valor['conceptos_cod']);
		  	  $concepto=utf8_encode($valor['concepto']);
		  	  $detalles=utf8_encode($valor['detalles']);
		  	  $moneda=utf8_encode($valor['moneda']);
		  	  $caja_cod=utf8_encode($valor['caja_cod']);
			  $fecha=utf8_encode($valor['fecha']);
			  $hora=utf8_encode($valor['hora']);
			  $estado=utf8_encode($valor['estado']); 
	  	 $cant=$cant+1;
		 $accion2='ver_vetana_permiso(id_progreso,"4","","'.$nro.'")';
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr onclick='obtener_datos_otrosingresos(this)' ".$bacground.">
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_personas_cod'>".$personas_cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_cobrador_cod'>".$cobrador_cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_conceptos_cod'>".$conceptos_cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_moneda'>".$moneda."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$caja_cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$caja_cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_cedulacliente'>".$cedulacliente."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_cedulacobrador'>".$cedulacobrador."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:5%;text-align:center;' id='td_nro'>".$nro."</td>
<td class='td_detalles' style='width:10%;' id='td_concepto'>".$concepto."</td>
<td class='td_detalles' style='width:25%;' id='td_detalles'>".$detalles."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_monto'>".number_format($monto,'0',',','.')."</td>
<td class='td_detalles' style='width:15%;' id='td_cliente'>".$cliente."</td>
<td class='td_detalles' style='width:15%;' id='td_cobrador'>".$cobrador."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:5%;text-align:center;'>
<center><button type='button' onclick='".$accion2."' class='input_atras' style='height: 33px;width: 33px;box-shadow: inset 0px -1px 2px 0px #afafaf;background: var(--colorbotoneliminar);'><img src='./icono/delete.png' style='width:20px;height:20px;'></button></center>
</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}



function anular_otrosingresos($nrocomprobante,$clavepermisoanulacion){
$mysqli=conectar_al_servidor();
	if($nrocomprobante==""){
    echo "camposvacio";	
    exit;
	}

	    $sql="update otrosingresos set permisoanulacion='".$clavepermisoanulacion."',estado='ANULADO' where nro='".$nrocomprobante."'";
		$stmt = $mysqli->prepare($sql);
    if(!$stmt->execute()) {
     echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
     exit;
    }
	  $sql1="update cajadiaria set permisoanulacion='".$clavepermisoanulacion."',estado='ANULADO' where nro='".$nrocomprobante."' and origen='OTROSINGRESOS'";
		$stmt1 = $mysqli->prepare($sql1);
    if(!$stmt1->execute()) {
     echo trigger_error('The query execution failed; MySQL said ('.$stmt1->errno.') '.$stmt1->error, E_USER_ERROR);
     exit;
    }
	echo"exito";
}

verificar_datos();

?>