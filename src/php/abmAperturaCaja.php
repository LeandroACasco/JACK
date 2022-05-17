<?php
require("conexion.php");

function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
		if($func=='buscar'){
			$codusuario = $_POST['codusuario'];
			$codusuario = utf8_decode($codusuario);
			
			$buscar = $_POST['buscar'];
			$buscar = utf8_decode($buscar);
				
			buscar($buscar,$codusuario);
		}	
	
        if($func=='verificar_acaja_abierta'){
			$datoscaja = $_POST['datoscaja'];
			$datoscaja = utf8_decode($datoscaja);	
			verificar_acaja_abierta($datoscaja);
		}		
	
        if($func=='obtener_monto_en_caja'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);	
			 obtener_monto_en_caja($cod);
		}
        if($func=='obtener_monto_anterior_en_caja'){
			$caja_cod = $_POST['caja_cod'];
			$caja_cod = utf8_decode($caja_cod);	
			 obtener_monto_anterior_en_caja($caja_cod);
		}	
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
			
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
        $montoapertura = $_POST['montoapertura'];
		$montoapertura = utf8_decode($montoapertura );
        
		$fechaapertura = $_POST['fechaapertura'];
		$fechaapertura = utf8_decode($fechaapertura);
       
		$horaapertura = $_POST['horaapertura'];
		$horaapertura = utf8_decode($horaapertura);
		
		$datoscaja_cod = $_POST['datoscaja_cod'];
		$datoscaja_cod = utf8_decode($datoscaja_cod);
	
		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
						
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
		
		mantenimiento($func,$cod,$montoapertura ,$fechaapertura,$horaapertura,$datoscaja_cod,$usuarios_cod,$hora);
		

		}	
		}	

  function obtener_monto_anterior_en_caja($caja_cod){

	$nrocaja =obtener_cod_caja($caja_cod);
   
	$mysqli=conectar_al_servidor();
	 $montocierre=0;
	 $sql= "SELECT ifnull(montocierre,0) as montocierre FROM caja where cod=?"; 
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
  $s='s';
$nrocaja="".$nrocaja."";
$stmt->bind_param($s,$nrocaja);
 
if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {

		 $montocierre=$valor['montocierre'];   
   }
 }
 
$informacion =array("1" => "exito","2"=>number_format($montocierre,'0',',','.'));
echo json_encode($informacion);	
exit;
}



   function obtener_cod_caja($caja_cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "SELECT max(c.cod) as analista FROM caja c join datoscaja d on c.datoscaja_cod=d.cod where d.cod='".$caja_cod."' and c.estado='CERRADO'";
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
		 $analista=$valor['analista'];  
	  }
  }
   return $analista;
  }

  function mantenimiento($func,$cod,$montoapertura ,$fechaapertura,$horaapertura,$datoscaja_cod,$usuarios_cod,$hora){
	if($hora=="" || $fechaapertura==""  || $horaapertura==""   || $montoapertura =="" || $datoscaja_cod=="" ||  $usuarios_cod==""  || $hora==""  ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
	if($func=='guardar'){   
          $consulta1= "SELECT count(c.cod) as cantidad
                      FROM caja c
					  join usuarios u on c.usuarios_cod=u.cod
					  join personas p on u.personas_cod=p.cod
					  where c.estado='ABIERTO' and c.datoscaja_cod=?";
		$stmt1 = $mysqli->prepare($consulta1);
		$ss='s';
		$stmt1->bind_param($ss,$datoscaja_cod); 
		if ( ! $stmt1->execute()) {
		   echo "Error1";
		   exit;
		}
		$result1 = $stmt1->get_result();
		$nro_total1=$result1->fetch_row();
		  $valor1=$nro_total1[0];

		if($valor1>=1){
	   echo "cajaabierta";	
		exit;
		}

		   $sql="insert into caja (fechaapertura,montoapertura,horaapertura,datoscaja_cod, usuarios_cod, hora, fecha, estado) value (?,?,?,?,?,?,current_date(),'ABIERTO')";
		   $s='ssssss';
		   $stmt = $mysqli->prepare($sql);
		   echo $mysqli -> error;
		   $stmt->bind_param($s,$fechaapertura,$montoapertura ,$horaapertura,$datoscaja_cod,$usuarios_cod,$hora); 
	}
    if($func=='editar'){
	    $sql='update caja set fechaapertura=upper(?), montoapertura=upper(?), horaapertura=upper(?),datoscaja_cod=upper(?), usuarios_cod=upper(?),hora=upper(?),fecha=current_date(),estado="ABIERTO" where cod=?';
		$s='ssssssi';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$fechaapertura,$montoapertura ,$horaapertura,$datoscaja_cod,$usuarios_cod,$hora,$cod); 
	} 

	if($func=='eliminar'){
		
	    $sql="update caja set estado='ANULADO' where cod=?";
		
		$s='i';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$cod); 
	}
   if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
	echo"exito";
}

  function obtener_datos_caja_abierto($usuarios_cod){
 $mysqli=conectar_al_servidor();
$cod2="0";
 $sql= " SELECT c.cod, c.datoscaja_cod,concat(nombre,' ',nro) as caja
 FROM caja c
 join datoscaja d on c.datoscaja_cod=d.cod 
 where c.usuarios_cod=? and  c.estado='ABIERTO'"; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$$usuarios_cod="".$$usuarios_cod."";
$stmt->bind_param($s,$$usuarios_cod);
if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		        $cod2=$valor['cod'];  
		        $caja=$valor['caja'];		
   }
 }

$informacion =array("1" => $cod2,"2" => $caja);
echo json_encode($informacion);			
exit;
}

  function verificar_acaja_abierta($datoscaja){
 $mysqli=conectar_al_servidor();
 $sql= " SELECT count(c.cod) as cantidad,concat(d.nombre,' ',d.nro) as caja,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as cajero,c.fechaapertura,TIME_FORMAT(c.horaapertura, '--- %H:%i Hs.') as horaapertura
 FROM caja c
 join usuarios u on c.usuarios_cod=u.cod
 join personas p on u.personas_cod=p.cod
 join datoscaja d on c.datoscaja_cod=d.cod
 where c.estado='ABIERTO' and c.datoscaja_cod=?"; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$datoscaja="".$datoscaja."";
$stmt->bind_param($s,$datoscaja);
if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		        $cantidad=$valor['cantidad'];  
		        $cajero=$valor['cajero'];  
		        $caja=$valor['caja'];  

		        $fechaapertura1=$valor['fechaapertura'];  
                $date = date_create($fechaapertura1);
                $fechaapertura=date_format($date,"d/m/Y"); 	  
		        $horaapertura=$valor['horaapertura'];
                $datos="ERROR                                                                            ".$caja." ESTA ABIERTA YA POR ".$cajero." ".$fechaapertura." ".$horaapertura;		
   }
 }

$informacion =array("1" => $datos);
echo json_encode($informacion);			
exit;
}
	
  function buscar($buscar,$codusuario){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT c.cod,c.usuarios_cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as cajero,c.datoscaja_cod,concat(d.nombre,' ',d.nro) as caja,concat(s.nombres,' ',s.numero) as sucursal, c.fechaapertura,c.montoapertura ,c.montocierre,c.horaapertura,c.horacierre,c.datoscaja_cod,c.fecha,c.hora,c.estado 
FROM caja c
join usuarios u on c.usuarios_cod=u.cod
join personas p on u.personas_cod=p.cod
join datoscaja d on c.datoscaja_cod=d.cod
join sucursales s on d.sucursales_cod=s.cod
 where  c.usuarios_cod=? and concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) like ? order by c.cod desc "; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
$buscar="%".$buscar."%";

$codusuario="".$codusuario."";
$stmt->bind_param($s,$codusuario,$buscar);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		        $cod=$valor['cod'];  
		        $usuarios_cod=$valor['usuarios_cod'];  
		        $cajero=$valor['cajero'];  
		        $caja=$valor['caja']; 
		        $sucursal=$valor['sucursal'];  
		  	    $montoapertura1 =utf8_encode($valor['montoapertura']);
				 $montoapertura=0;
                if($montoapertura1<>""){
					$montoapertura=number_format($montoapertura1,'0',',','.');  
				}
		  	    $montocierre1=utf8_encode($valor['montocierre']);
                $montocierre=0;
                if($montocierre1<>""){
					$montocierre=number_format($montocierre1,'0',',','.');  
				}
				$fechaapertura=utf8_encode($valor['fechaapertura']);
              if($fechaapertura!=""){
			  $datea = date_create($fechaapertura);
              $fechaapertura= date_format($datea,"d/m/Y");
			  }
			    $horaapertura=utf8_encode($valor['horaapertura']);
			    $horacierre=utf8_encode($valor['horacierre']);
			    $datoscaja_cod=utf8_encode($valor['datoscaja_cod']);
			    $estado=utf8_encode($valor['estado']); 
	  	 $cant=$cant+1;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr  ".$bacground.">
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cod."</td>
<td class='td_detalles' style='width:0%;display:none;' id='td_usuarios_cod'>".$usuarios_cod."</td>

<td class='td_detalles' style='width:0%;display:none;' id='td_datoscaja'>".$datoscaja_cod."</td>

<td class='td_detalles' style='width:13.5%;'   id='td_caja'>".$caja."</td>
<td class='td_detalles' style='width:13.5%;'   id='td_montoapertura'>".$montoapertura."</td>
<td class='td_detalles' style='width:13.5%;'   id='td_montocierre'>".$montocierre."</td>
<td class='td_detalles' style='width:13.5%;'   id='td_fechaapertura'>".$fechaapertura."</td>
<td class='td_detalles' style='width:13.5%;'   id='td_horaapertura'>".$horaapertura."</td>
<td class='td_detalles' style='width:13.5%;'   id='td_cajero'>".$horacierre."</td>
<td class='td_detalles' style='width:13.5%;'   id='td_estado'>".$estado."</td>
</tr>
";		  
   }
 }
 
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

  function obtener_monto_en_caja($cod){
$totalotrosingresos=0;
	$mysqli=conectar_al_servidor();
	 $sql= "SELECT (c.montoapertura)+(select IFNULL(sum(co.monto), 0) as monto from cobroscuotasclientes co where co.caja_cod=c.cod)+(select IFNULL(sum(o.monto), 0) as otrosmonto from otrosingresos o where o.caja_cod=c.cod)-(select IFNULL(sum(d.monto), 0) as dmonto from desembolsos d where d.caja_cod=c.cod)+(select IFNULL(sum(oi.monto), 0) as monto from otrosingresos oi where oi.caja_cod=c.cod) as totalotrosingresos
 FROM caja c
 join datoscaja d on c.datoscaja_cod=d.cod 
 where c.cod=? and c.estado='ABIERTO'"; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$cod="".$cod."";
$stmt->bind_param($s,$cod);
if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {

		 $totalotrosingresos=$valor['totalotrosingresos'];   
   }
 }
 
$informacion =array("1" => "exito","2"=>$totalotrosingresos);
echo json_encode($informacion);	
exit;
}




verificar_datos();

?>