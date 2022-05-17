<?php
require("conexion.php");

function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
		if($func=='buscar_solicitudes_pendientes'){
			$estado = $_POST['estado'];
			$estado = utf8_decode($estado);
			
			$buscador = $_POST['buscador'];
			$buscador = utf8_decode($buscador);	
			buscar_solicitudes_pendientes($estado,$buscador);
		}
		if($func=='buscar_mis_solicitudes'){
			$usuario = $_POST['usuario'];
			$usuario = utf8_decode($usuario);
			
			$buscador = $_POST['buscador'];
			$buscador = utf8_decode($buscador);	
			buscar_mis_solicitudes($buscador,$usuario);
		}
	
	    if($func=='eliminarSolicitudes_retransferido'){	
        $cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		eliminarSolicitudes_retransferido($cod);	
		}
		if($func=='buscar_mis_solicitudes_creditos'){
			$usuario = $_POST['usuario'];
			$usuario = utf8_decode($usuario);
			
			$buscador = $_POST['buscador'];
			$buscador = utf8_decode($buscador);	
			buscar_mis_solicitudes_creditos($buscador,$usuario);
		}
		if($func=='buscar_mis_solicitudes_desembolso'){
			$buscador = $_POST['buscador'];
			$estado = $_POST['estado'];
			$buscador = utf8_decode($buscador);	
			buscar_mis_solicitudes_desembolso($buscador, $estado);
		}
		if($func=='buscarcombo'){		
			buscar_combo();	
		}
		if($func=='eliminarsolicitudes'){	
             $cod = $_POST['cod'];
		    $cod = utf8_decode($cod);		
			eliminarsolicitudes($cod);	
		}
		if($func=='verificar_clientes_con_solicitudes_pendiente_o_en_borrador'){	
             $cedula = $_POST['cedula'];
		    $cedula = utf8_decode($cedula);		
			verificar_clientes_con_solicitudes_pendiente_o_en_borrador($cedula);	
		}
		if($func=='obtenerNroSolicitudes'){	
            		
			obtenerNroSolicitudes();	
		}
		if($func=='retransferir'){	
        $cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$obsanalista= $_POST['obsanalista'];
		$obsanalista = utf8_decode($obsanalista);	
		$usuarios_cod= $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);	
		retransferirSolicitudes($cod,$obsanalista,$usuarios_cod);	
		}
		if($func=='rechazar'){	
        $cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$obsanalista= $_POST['obsanalista'];
		$obsanalista = utf8_decode($obsanalista);	
		
		
		$usuarios_cod= $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);	
		
		rechazarSolicitudes($cod,$obsanalista,$usuarios_cod);	
		}

		if($func=='desembolsar'){	
        $cod = $_POST['cod'];
		$cod = utf8_decode($cod);

		$monto = $_POST['monto'];
		$monto = utf8_decode($monto);

		$caja_cod = $_POST['caja_cod'];
		$caja_cod = utf8_decode($caja_cod);

		$nrosolicitud = $_POST['nrosolicitud'];
		$nrosolicitud = utf8_decode($nrosolicitud);

		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);

        $usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);				
		

		DesembolsarSolicitudes($cod,$monto,$caja_cod,$nrosolicitud,$usuarios_cod,$hora);	
		}

		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
	     $fechasolicitud = $_POST['fecha'];
		$fechasolicitud = utf8_decode($fechasolicitud);
		
		$nrosoli = $_POST['nrosoli'];
		$nrosoli = utf8_decode($nrosoli);
		
		$estadosolicitud = $_POST['estadosolicitud'];
		$estadosolicitud = utf8_decode($estadosolicitud);
		
		$condicion = $_POST['condicion'];
		$condicion = utf8_decode($condicion);

		$monto = $_POST['monto'];
		$monto = utf8_decode($monto);
		
        $plazosolicitado = $_POST['plazosolicitado'];
		$plazosolicitado = utf8_decode($plazosolicitado);
		
        $condicionsolicitado = $_POST['condicionsolicitado'];
		$condicionsolicitado = utf8_decode($condicionsolicitado);
		
		$salario = $_POST['salario'];
		$salario = utf8_decode($salario);
						
		$vendedor_cod = $_POST['vendedor_cod'];
		$vendedor_cod = utf8_decode($vendedor_cod);	
		
		
		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);				
		
		$clientes_cod = $_POST['clientes_cod'];
		$clientes_cod = utf8_decode($clientes_cod);

		// $sucursales_cod = $_POST['sucursales_cod'];
		// $sucursales_cod = utf8_decode($sucursales_cod);
		
		$obsvendedor = $_POST['obsvendedor'];
		$obsvendedor = utf8_decode($obsvendedor);
		
		$nrosolicitud = $_POST['nrosolicitud'];
		$nrosolicitud = utf8_decode($nrosolicitud);
						
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
		
		$otroingreso = $_POST['otroingreso'];
		$otroingreso = utf8_decode($otroingreso);
		
		$direccion = $_POST['direccion'];
		$direccion = utf8_decode($direccion);
		
		$telefono = $_POST['telefono'];
		$telefono = ($telefono);
		
		$funcionarioacargo = $_POST['funcionarioacargo'];
		$funcionarioacargo = utf8_decode($funcionarioacargo);
		//dos
		$trabajoactual = $_POST['trabajoactual'];
		$trabajoactual = utf8_decode($trabajoactual);
		
		$direccionta = $_POST['direccionta'];
		$direccionta = utf8_decode($direccionta);
		
		$puestoqueocupa = $_POST['puestoqueocupa'];
		$puestoqueocupa = utf8_decode($puestoqueocupa);
		
		$telefonopo = $_POST['telefonopo'];
		$telefonopo = utf8_decode($telefonopo);
		
		$antiguedadpo = $_POST['antiguedadpo'];
		$antiguedadpo = ($antiguedadpo);
		
		$trabajoanterior = $_POST['trabajoanterior'];
		$trabajoanterior = ($trabajoanterior);
		
		$telefonota = $_POST['telefonota'];
		$telefonota = utf8_decode($telefonota);
		
		$antiguedadta = $_POST['antiguedadta'];
		$antiguedadta = ($antiguedadta);
		
		$trabajoantepenultimo = $_POST['trabajoantepenultimo'];
		$trabajoantepenultimo = ($trabajoantepenultimo);
		
		$telefonotante = $_POST['telefonotante'];
		$telefonotante = utf8_decode($telefonotante);
		
		$antiguedadante = $_POST['antiguedadante'];
		$antiguedadante = ($antiguedadante);
		
		$periododeinactividad = $_POST['periododeinactividad'];
		$periododeinactividad = utf8_decode($periododeinactividad);
		
		$infopositiva = $_POST['infopositiva'];
		$infopositiva = ($infopositiva);
		
		$infonegativa = $_POST['infonegativa'];
		$infonegativa = ($infonegativa);
		//tres ingreso
		$diapoco = $_POST['diapoco'];
		$diapoco = utf8_decode($diapoco);
		
		$diamas = $_POST['diamas'];
		$diamas = utf8_decode($diamas);
		
		$semanapoco = $_POST['semanapoco'];
		$semanapoco = utf8_decode($semanapoco);
		
		$semanamas = $_POST['semanamas'];
		$semanamas = utf8_decode($semanamas);
		
		$mespoco = $_POST['mespoco'];
		$mespoco = utf8_decode($mespoco);
		
		$mesmas = $_POST['mesmas'];
		$mesmas = utf8_decode($mesmas);
		//cuatro egreso
		$vivienda = $_POST['vivienda'];
		$vivienda = utf8_decode($vivienda);
		
		$comercio = $_POST['comercio'];
		$comercio = utf8_decode($comercio);
		
		$banco = $_POST['banco'];
		$banco = utf8_decode($banco);
		
		$cooperativa = $_POST['cooperativa'];
		$cooperativa = utf8_decode($cooperativa);
		
		$financiera = $_POST['financiera'];
		$financiera = utf8_decode($financiera);
		
		$electrodomesticos = $_POST['electrodomesticos'];
		$electrodomesticos = utf8_decode($electrodomesticos);
		
		$cantidad_hijos = $_POST['cantidad_hijos'];
		$cantidad_hijos = utf8_decode($cantidad_hijos);
		
		$usureros = $_POST['usureros'];
		$usureros = utf8_decode($usureros);
		
		$quincenapoco = $_POST['quincenapoco'];
		$quincenapoco = utf8_decode($quincenapoco);
		
		
		$quincenamas = $_POST['quincenamas'];
		$quincenamas = utf8_decode($quincenamas);
		
		$extras = $_POST['extras'];
		$extras = utf8_decode($extras);
	
		$actividadeconomica = $_POST['actividadeconomica'];
		$actividadeconomica = utf8_decode($actividadeconomica);
		
		mantenimiento($func,$fechasolicitud,$vendedor_cod,$nrosoli,$extras,$quincenapoco,$quincenamas,$salario,$cod,$monto,$plazosolicitado,$condicionsolicitado,$usureros,$trabajoactual,$direccionta,$puestoqueocupa,$telefonopo,$antiguedadpo,$trabajoanterior,$telefonota,$antiguedadta,
		$trabajoantepenultimo,$telefonotante,$antiguedadante,$periododeinactividad,$infopositiva,$infonegativa,
		$diapoco,$diamas,$semanapoco,$semanamas,$mespoco,$mesmas,
		$vivienda,$comercio,$banco,$cooperativa,$financiera,$electrodomesticos,$cantidad_hijos,
		$usuarios_cod,$clientes_cod,$obsvendedor,$nrosolicitud,$hora,$otroingreso,$direccion,$telefono,$funcionarioacargo,$condicion,$estadosolicitud,$actividadeconomica);
		}
		}	

function eliminarSolicitudes_retransferido($cod){
    $mysqli=conectar_al_servidor();
  $sql="update solicitudescreditos set estado='ELIMINADO' where cod='$cod'";
  $stmt = $mysqli->prepare($sql);   
  if ( ! $stmt->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
   }
  
  
		echo"exito";
}

function mantenimiento($func,$fechasolicitud,$vendedor_cod,$nrosoli,$extras,$quincenapoco,$quincenamas,$salario,$cod,$monto,$plazosolicitado,$condicionsolicitado,$usureros,$trabajoactual,$direccionta,$puestoqueocupa,$telefonopo,$antiguedadpo,$trabajoanterior,$telefonota,$antiguedadta,
		$trabajoantepenultimo,$telefonotante,$antiguedadante,$periododeinactividad,$infopositiva,$infonegativa,
		$diapoco,$diamas,$semanapoco,$semanamas,$mespoco,$mesmas,
		$vivienda,$comercio,$banco,$cooperativa,$financiera,$electrodomesticos,$cantidad_hijos,
		$usuarios_cod,$clientes_cod,$obsvendedor,$nrosolicitud,$hora,$otroingreso,$direccion,$telefono,$funcionarioacargo,$condicion,$estadosolicitud,$actividadeconomica){
	
	if($hora=="" ||  $clientes_cod=="" || $condicionsolicitado=="" ||  $vendedor_cod=="" ||  $extras=="" || $plazosolicitado=="" || $quincenapoco=="" || $quincenamas=="" || $usureros=="" || $trabajoactual=="" || $direccionta=="" || $puestoqueocupa=="" || $telefonopo=="" || $antiguedadpo=="" || $trabajoanterior=="" || $telefonota=="" || $antiguedadta=="" || $trabajoantepenultimo=="" || $telefonotante=="" || $antiguedadante=="" || $periododeinactividad=="" ||  $diapoco=="" || $diamas=="" || $semanapoco=="" || $semanamas=="" || $mespoco=="" || $mesmas=="" ||  $comercio=="" || $banco=="" || $cooperativa=="" || $financiera=="" || $electrodomesticos=="" || $cantidad_hijos=="" || $otroingreso=="" || $direccion=="" || $telefono=="" || $funcionarioacargo=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
if($condicion=="1"){
$consulta= "Select count(*) from solicitudescreditos where cod=?  ";
$stmt = $mysqli->prepare($consulta);
$ss='s';
$stmt->bind_param($ss, $cod); 
if ( ! $stmt->execute()) {
   echo "Error1";
   exit;
}
$result = $stmt->get_result();
$nro_total=$result->fetch_row();
  $valor=$nro_total[0];

if($valor>=1) {
echo "duplicado";	
exit;
}
}
   $nrodatos=intval($nrosolicitud+$nrosoli);
   $sql="insert into solicitudescreditos (vendedor_cod,actividadeconomica,monto,plazosolicitado,condicionsolicitado,nrosolicitud, usuarios_cod, clientes_cod,obsvendedor, hora, fecha, estadosolicitud, estado)
   value (upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),?,?,'ACTIVO')";
   $s='ssssssssssss';
   $stmt = $mysqli->prepare($sql);
   echo $mysqli -> error;
   $stmt->bind_param($s,$vendedor_cod,$actividadeconomica,$monto,$plazosolicitado,$condicionsolicitado,$nrodatos,$usuarios_cod,$clientes_cod,$obsvendedor,$hora,$fechasolicitud,$estadosolicitud); 
   
   $sql1="insert into datosdelnegocio (SolicitudesCreditos_cod,otroingreso, direccion, telefono, funcionarioacargo, usuarios_cod, hora, fecha, estado)
   value ((select max(cod) from solicitudescreditos limit 1),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='ssssss';
   $stmt1 = $mysqli->prepare($sql1);
   echo $mysqli -> error;
   $stmt1->bind_param($s,$otroingreso,$direccion,$telefono,$funcionarioacargo,$usuarios_cod,$hora);
   
   $sql2="insert into referenciaslaborales (SolicitudesCreditos_cod,trabajoactual, direccionta, puestoqueocupa, telefonopo, antiguedadpo, trabajoanterior, telefonota, antiguedadta, trabajoantepenultimo, telefonotante, antiguedadante, periododeinactividad, infopositiva, infonegativa, usuarios_cod, hora, fecha, estado)
   value ((select max(cod) from solicitudescreditos limit 1),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='ssssssssssssssss';
   $stmt2 = $mysqli->prepare($sql2);
   echo $mysqli -> error;
   $stmt2->bind_param($s,$trabajoactual,$direccionta,$puestoqueocupa,$telefonopo,$antiguedadpo,$trabajoanterior,$telefonota,$antiguedadta,$trabajoantepenultimo,$telefonotante,$antiguedadante,$periododeinactividad,$infopositiva,$infonegativa,$usuarios_cod,$hora);
   
   $sql3="insert into ingresos (SolicitudesCreditos_cod, diapoco, diamas, semanapoco, semanamas, mespoco, mesmas,quincenapoco,quincenamas,salario,extras, usuarios_cod, hora, fecha, estado)
   value ((select max(cod) from solicitudescreditos limit 1),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='ssssssssssss';
   $stmt3 = $mysqli->prepare($sql3);
   echo $mysqli -> error;
   $stmt3->bind_param($s,$diapoco,$diamas,$semanapoco,$semanamas,$mespoco,$mesmas,$quincenapoco,$quincenamas,$salario,$extras,$usuarios_cod,$hora);
   
   $sql4="insert into egresos (SolicitudesCreditos_cod, vivienda, comercio, banco, cooperativa, financiera, electrodomesticos, usureros, cantidad_hijos, usuarios_cod, hora, fecha, estado)
   value ((select max(cod) from solicitudescreditos limit 1),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='ssssssssss';
   $stmt4 = $mysqli->prepare($sql4);
   echo $mysqli -> error;
   $stmt4->bind_param($s,$vivienda,$comercio,$banco,$cooperativa,$financiera,$electrodomesticos,$usureros,$cantidad_hijos,$usuarios_cod,$hora);
  
   $sql5="update nrosolicitudes set nrosoliciudes='$nrodatos' where idnrosolicitudes='2'";
   $stmt5 = $mysqli->prepare($sql5);
   if (! $stmt5->execute()) {
    echo trigger_error('The query execution failed; MySQL said ('.$stmt5->errno.') '.$stmt5->error, E_USER_ERROR);
    exit;
   } 
 
  
   
}else if($func=='eliminar'){
		
	    $sql="update solicitudescreditos set estado='ELIMINADO' where cod=?";
		
		$s='i';
			$stmt = $mysqli->prepare($sql);
			echo $mysqli -> error;
            $stmt->bind_param($s,$cod); 
	}
	
 if ( ! $stmt->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
}
 if ( ! $stmt1->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt1->errno.') '.$stmt1->error, E_USER_ERROR);
   exit;
}
 if ( ! $stmt2->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt2->errno.') '.$stmt2->error, E_USER_ERROR);
   exit;
}
 if ( ! $stmt3->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt3->errno.') '.$stmt3->error, E_USER_ERROR);
   exit;
}
 if ( ! $stmt4->execute()) {
   echo trigger_error('The query execution failed; MySQL said ('.$stmt4->errno.') '.$stmt4->error, E_USER_ERROR);
   exit;
}
	echo"exito";
}

function eliminarsolicitudes($cod){	
  $mysqli=conectar_al_servidor();
  $sql="DELETE FROM ingresos WHERE solicitudescreditos_cod='$cod'";
  $stmt = $mysqli->prepare($sql);   
  if ( ! $stmt->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
   }
    $sql2="DELETE FROM egresos WHERE solicitudescreditos_cod='$cod'";
  $stmt2 = $mysqli->prepare($sql2);   
  if ( ! $stmt2->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt2->errno.') '.$stmt2->error, E_USER_ERROR);
   exit;
   }   
   $sql3="DELETE FROM datosdelnegocio WHERE solicitudescreditos_cod='$cod'";
  $stmt3 = $mysqli->prepare($sql3);   
  if ( ! $stmt3->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt3->errno.') '.$stmt3->error, E_USER_ERROR);
   exit;
   }
  $sql4="DELETE FROM referenciaslaborales WHERE solicitudescreditos_cod='$cod'";
  $stmt4 = $mysqli->prepare($sql4);   
  if ( ! $stmt4->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt4->errno.') '.$stmt4->error, E_USER_ERROR);
   exit;
   } 
   $sql5="DELETE FROM referenciascreditoscomerciales WHERE solicitudescreditos_cod='$cod'";
  $stmt5 = $mysqli->prepare($sql5);   
  if ( ! $stmt5->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt5->errno.') '.$stmt5->error, E_USER_ERROR);
   exit;
   } 
   $sql6="DELETE FROM referenciaspersonales WHERE solicitudescreditos_cod='$cod'";
  $stmt6 = $mysqli->prepare($sql6);   
  if ( ! $stmt6->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt6->errno.') '.$stmt6->error, E_USER_ERROR);
   exit;
   }  
   $sql7="DELETE FROM fotospersonas WHERE solicitudescreditos_cod='$cod'";
  $stmt7 = $mysqli->prepare($sql7);   
  if ( ! $stmt7->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt7->errno.') '.$stmt7->error, E_USER_ERROR);
   exit;
   }  
   $sql8="DELETE FROM documentospersonas WHERE solicitudescreditos_cod='$cod'";
  $stmt8 = $mysqli->prepare($sql8);   
  if ( ! $stmt8->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt8->errno.') '.$stmt8->error, E_USER_ERROR);
   exit;
   } 
  $sql9="DELETE FROM solicitudescreditos WHERE cod='$cod'";
  $stmt9 = $mysqli->prepare($sql9);   
  if ( ! $stmt9->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt9->errno.') '.$stmt9->error, E_USER_ERROR);
   exit;
   }

   echo"exito";
}

function retransferirSolicitudes($cod,$obsanalista,$usuarios_cod){	
  $mysqli=conectar_al_servidor();
  $sql="update solicitudescreditos set estadosolicitud='RETRANSFERIDO',fechaaprobacion='current_date()',obsretranferencia='$obsanalista',analista_cod='$usuarios_cod' where cod='$cod'";
  $stmt = $mysqli->prepare($sql);   
  if ( ! $stmt->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
   }
   echo"exito";
}

function DesembolsarSolicitudes($cod,$monto,$caja_cod,$nrosolicitud,$usuarios_cod,$hora){	
  $mysqli=conectar_al_servidor();
	$sql= "SELECT cod FROM ventas where nrosolicitud='".$nrosolicitud."'"; 
   $stmt = $mysqli->prepare($sql);
   if ( ! $stmt->execute()) {
   echo "Error1";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){  
		      $cod_ventas=$valor['cod'];    
	  }
     guardar_datos_desembolso($cod,$monto,$caja_cod,$cod_ventas,$usuarios_cod,$hora);
     }


exit;

}

function guardar_datos_desembolso($cod,$monto,$caja_cod,$cod_ventas,$usuarios_cod,$hora){
	 $mysqli=conectar_al_servidor();
	$sql="insert into desembolsos (monto, caja_cod, ventas_cod, usuarios_cod, hora, fecha, estado) value (upper(?),upper(?),upper(?),upper(?),upper(?),current_date(),'ACTIVO')";
   $s='sssss';
   $stmt1 = $mysqli->prepare($sql);
   $stmt1->bind_param($s,$monto,$caja_cod,$cod_ventas,$usuarios_cod,$hora); 

  $sql1="update solicitudescreditos set estadosolicitud='DESEMBOLSADO' where cod='$cod'";
  $stmt2 = $mysqli->prepare($sql1);   
  if (!$stmt1->execute()){
   echo trigger_error('ERROR SQL  ('.$stmt1->errno.') '.$stmt1->error, E_USER_ERROR);
   exit;
   }
   if (!$stmt2->execute()){
   echo trigger_error('ERROR SQL  ('.$stmt2->errno.') '.$stmt2->error, E_USER_ERROR);
   exit;
   }
   
   $consulta1="Insert into cajadiaria (origen,tipo,caja_cod, nro,egreso, descripcion, ingreso, fecha, hora, estado) values('DESEMBOLSO','DESEMBOLSO',?,(SELECT v1.nrofactura FROM ventas v1 where v1.cod='".$cod_ventas."'),?,(SELECT concat('Desembolso a ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada,', Fac.No:',v.nrofactura,' Suc:',s.numero,'-') as descripcion FROM ventas v join personas p on v.clientes_cod=p.cod join sucursales s on v.sucursales_cod=s.cod where v.cod='".$cod_ventas."'),'0',current_date(),?,'ACTIVO')";	
 $stmt3 = $mysqli->prepare($consulta1);
 $ss1='sss';
  echo $mysqli -> error;
$stmt3->bind_param($ss1,$caja_cod,$monto,$hora); 
if ( ! $stmt3->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt2->errno.') '.$stmt2->error, E_USER_ERROR);
   exit;
}

 echo"exito";
}


function rechazarSolicitudes($cod,$obsanalista,$usuarios_cod){	
  $mysqli=conectar_al_servidor();
  $sql="update solicitudescreditos set estadosolicitud='RECHAZADO',fechaaprobacion=current_date(),obsanalista='$obsanalista',analista_cod='$usuarios_cod' where cod='$cod'";
  $stmt = $mysqli->prepare($sql);   
  if ( ! $stmt->execute()) {
   echo trigger_error('ERROR SQL  ('.$stmt->errno.') '.$stmt->error, E_USER_ERROR);
   exit;
   }
   echo"exito";
}

function obtenerNroSolicitudes() {
	$mysqli=conectar_al_servidor();
$nro="";
$sql= "SELECT nrosoliciudes FROM nrosolicitudes where idnrosolicitudes=2";
if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
  $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {  
		
 $nro=utf8_encode($valor['nrosoliciudes']);		   
	  }
    }
$informacion =array("1" => "exito","2" => $nro+1);
echo json_encode($informacion);	
exit;
}

function buscar_combo(){
	 $mysqli=conectar_al_servidor();
	 $pagina='<option value ="">SELECCIONAR</option>';
	 $sql= "SELECT cod,montodisponible FROM planprestamos where estado='ACTIVO' group by montodisponible order by montodisponible asc"; 
   $stmt = $mysqli->prepare($sql);
   if ( ! $stmt->execute()) {
   echo "Error1";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){  
		      $cod=utf8_encode($valor['cod']);  
		  	  $ciudades1=utf8_encode($valor['montodisponible']);
			 $ciudades=number_format($ciudades1,'0',',','.');
              $pagina.="<option value ='".$cod."'>".$ciudades."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}

function buscar_solicitudes_pendientes($estado,$buscador){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $obsdisplay='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT if(p.condicion='DIAS','D',if(p.condicion='SEMANAL','S',if(p.condicion='QUINCENAL','Q',if(p.condicion='MENSUAL','M','')))) as condicions,s.cod,s.nrosolicitud,c.cedula,concat(c.primernombre,' ',c.segundonombre,' ',c.primerapellido,' ',c.segundoapellido,' ',c.apellidocasada) as Cliente,c.telefono
,p.montodisponible as montosolicitado,s.condicionaprobado,s.montoaprobado, s.plazoaprobado,s.montocuotaaprobada, s.fechaaprobacion,s.fecharechazo, s.horaaprobacion,s.obsretranferencia,
s.fecha,s.hora,s.estadosolicitud
FROM solicitudescreditos s 
join planprestamos p on s.monto=p.cod
join personas c on s.clientes_cod=c.cod
 where s.estadosolicitud=? and concat(s.nrosolicitud,' ',c.cedula,' ',c.primernombre,' ',c.segundonombre,' ',c.primerapellido,' ',c.segundoapellido,' ',c.apellidocasada) like ? and s.estado='ACTIVO' order by s.cod desc "; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
 $estado="".$estado."";
$buscador="%".$buscador."%";

$stmt->bind_param($s,$estado,$buscador);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
		      $cod=utf8_encode($valor['cod']);  
		  	  $nrosolicitud=utf8_encode($valor['nrosolicitud']);
		  	  $condicions=utf8_encode($valor['condicions']);
			  $cedula=utf8_encode($valor['cedula']);
			  $Cliente=($valor['Cliente']);
			  $condicionaprobado=utf8_encode($valor['condicionaprobado']);
			  $plazoaprobado=utf8_encode($valor['plazoaprobado']);
			  $montosolicitado1=utf8_encode($valor['montosolicitado']);
			  $montosolicitado=number_format($montosolicitado1,'0',',','.');
			  $montoaprobado1=utf8_encode($valor['montoaprobado']);
			  $montoaprobado="";
			  if($montoaprobado1!=""){
				$montoaprobado=number_format($montoaprobado1,'0',',','.');  
			  }
			  
			  $montocuotaaprobada1=utf8_encode($valor['montocuotaaprobada']);
            $montocuotaaprobada="";			
			if($montocuotaaprobada1!=""){
				$montocuotaaprobada=number_format($montocuotaaprobada1,'0',',','.'); 
			  }
			    $fechaaprobacion="";	
			  $fechaaprobacion=utf8_encode($valor['fechaaprobacion']);
             //echo "fecha aproba".$fechaaprobacion;
			 if($fechaaprobacion!="" ){
			  $datea = date_create($fechaaprobacion);
              $fechaaprobacion= date_format($datea,"d/m/Y");
			  }else{
				$fechaaprobacion="";  
			  }
			  
			  $fecharechazo1=utf8_encode($valor['fecharechazo']);
               $fecharechazo="";			 
			 if($fecharechazo1!=""){
			  $datea = date_create($fecharechazo1);
              $fecharechazo= date_format($datea,"d/m/Y");
			  }
			  
			  
			  $horaaprobacion=utf8_encode($valor['horaaprobacion']);
			  $fecha1=utf8_encode($valor['fecha']);
			  $datea1 = date_create($fecha1);
              $fecha= date_format($datea1,"d/m/Y");
			  $hora=utf8_encode($valor['hora']);
			  $telefono=utf8_encode($valor['telefono']);
			  $estadosolicitud=utf8_encode($valor['estadosolicitud']); 
			  $Vendedor=(obtener_vendedor($cod));
			  $analista=(obtener_analista($cod)); 
			  $obsretranferencia=($valor['obsretranferencia']); 
			 
	  	 $cant=$cant+1;
		 $accion='abrir_cerrar_ventanas_solicitudescredito_analisis("1","'.$cod.'","'.$estadosolicitud.'")';
		 $accion1='abrir_cerrar_ventanas_obsanalista("4","'.str_replace(" ",",",$obsretranferencia).'")'; 
 if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
 if($estadosolicitud=="PENDIENTE"){
			
$pagina.="

<tr onclick=".$accion." ".$bacground." >
<td class='td_detalles' style='width:0%;background-color:#e3e2e2;color:red;text-align:center;display:none;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_estadosolicitud' >".$nrosolicitud."</td>
<td class='td_detalles' style='width:11%;text-align:center;' id='td_nrosolicitud'>".$estadosolicitud."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:14%;' id='td_Cliente'>".$Cliente."</td>
<td class='td_detalles' style='width:5%;text-align:center;' id='td_condicions'>".$condicions."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_montosolicitado'>".$montosolicitado."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_montoaprobado'>".$montoaprobado."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_hora'>".$fechaaprobacion."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_Vendedor' >".$analista."</td>
</tr>
";		  
			
			  } 
			  		  
 if($estadosolicitud=="RETRANSFERIDO"){
			
			
$pagina.="

<tr onclick=".$accion." ".$bacground.">
<td class='td_detalles' style='width:0%;background-color:#e3e2e2;color:red;text-align:center;display:none;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_estadosolicitud' >".$nrosolicitud."</td>
<td class='td_detalles' style='width:11%;text-align:center;' id='td_nrosolicitud'>".$estadosolicitud."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:14%;' id='td_Cliente'>".$Cliente."</td>
<td class='td_detalles' style='width:5%;text-align:center;' id='td_condicions'>".$condicions."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_montosolicitado'>".$montosolicitado."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_montoaprobado'>".$montoaprobado."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_hora'>".$fechaaprobacion."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_Vendedor' >".$analista."</td>
</tr>
";		  
			  }
			 
 if($estadosolicitud=="APROBADO"){
			
			
$pagina.="

<tr onclick=".$accion." ".$bacground." >
<td class='td_detalles' style='width:0%;background-color:#e3e2e2;color:red;text-align:center;display:none;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_estadosolicitud' >".$nrosolicitud."</td>
<td class='td_detalles' style='width:11%;text-align:center;' id='td_nrosolicitud'>".$estadosolicitud."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:14%;' id='td_Cliente'>".$Cliente."</td>
<td class='td_detalles' style='width:5%;text-align:center;' id='td_condicions'>".$condicions."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_montosolicitado'>".$montosolicitado."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_montoaprobado'>".$montoaprobado."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_hora'>".$fechaaprobacion."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_Vendedor' >".$analista."</td>
</tr>
";		  
	 }
	
 if($estadosolicitud=="RECHAZADO"){
$pagina.=" 
<tr onclick=".$accion." ".$bacground." >
<td class='td_detalles' style='width:0%;background-color:#e3e2e2;color:red;text-align:center;display:none;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_estadosolicitud' >".$nrosolicitud."</td>
<td class='td_detalles' style='width:11%;text-align:center;' id='td_nrosolicitud'>".$estadosolicitud."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:14%;' id='td_Cliente'>".$Cliente."</td>
<td class='td_detalles' style='width:5%;text-align:center;' id='td_condicions'>".$condicions."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_montosolicitado'>".$montosolicitado."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_montoaprobado'>".$montoaprobado."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_hora'>".$fechaaprobacion."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_Vendedor' >".$analista."</td>
</tr>
";		  
		}
	 }
 }
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_mis_solicitudes($buscador,$usuario){
	 $mysqli=conectar_al_servidor();
	 $pagina='';
	 $colortex='#fff';
	 $colorbacground='';
	 $obsdisplay='none';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $montoaprobado="";
	 $montocuotaaprobada="";
	 $accion1="";
	 $sql= "SELECT if(p.condicion='DIAS','D',if(p.condicion='SEMANAL','S',if(p.condicion='QUINCENAL','Q',if(p.condicion='MENSUAL','M','')))) as condicions,s.cod,s.nrosolicitud,p1.cedula,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as Cliente,p1.telefono
,p.montodisponible as montosolicitado,s.condicionaprobado,s.obsanalista,s.montoaprobado, s.plazoaprobado,s.montocuotaaprobada, s.fechaaprobacion, s.horaaprobacion,s.obsretranferencia,s.fecha,s.hora,s.estadosolicitud 
FROM solicitudescreditos s 
join planprestamos p on s.monto=p.cod
join personas p1 on s.clientes_cod=p1.cod
join usuarios u on s.vendedor_cod=u.cod
 where  concat(s.nrosolicitud,' ',p1.cedula,' ',p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) like ? and s.estado='ACTIVO' and s.estadosolicitud!='IMPRIMIDO' and s.estadosolicitud!='DESEMBOLSADO' order by s.fecha desc"; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$buscador="%".$buscador."%";

$stmt->bind_param($s,$buscador);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
	
			  $cod=utf8_encode($valor['cod']);
		      $sucursal=utf8_encode(obtener_sucursal_usuarios($cod));
			  $estadosolicitud=utf8_encode($valor['estadosolicitud']); 
			  $condicions=utf8_encode($valor['condicions']);
		  	  $nrosolicitud=utf8_encode($valor['nrosolicitud']);
			  $cedula=utf8_encode($valor['cedula']);
			  $Cliente=($valor['Cliente']);
			 
			  $montosolicitado1=utf8_encode($valor['montosolicitado']);
			  $montosolicitado=number_format($montosolicitado1,'0',',','.');
			  
			  $fecha=utf8_encode($valor['fecha']);
			  $datea = date_create($fecha);
              $fep= date_format($datea,"d/m/Y");
			  $hora=utf8_encode($valor['hora']);
			  $telefono=utf8_encode($valor['telefono']);
			  
			  $Vendedor=utf8_encode(obtener_vendedor($cod));
			 
			  $obsretranferencia=($valor['obsretranferencia']); 
			  $obsanalista=($valor['obsanalista']); 
			  $estadoactual="";
			 if($estadosolicitud=="RETRANSFERIDO"){
				 $condicionaprobado="";
				 $plazoaprobado="";
				 $montoaprobado="";
				 $montocuotaaprobada="";
				 $fechaaprobacion="";
				 $horaaprobacion="";
				 
				 $obsdisplay='';
				$colorbacground='#f44336';
				$colorbacground='#9c27b0';
				$estadoactual="RETRANSFERIDO";
				 $accion1='abrir_cerrar_ventanas_obsanalista("4","'.str_replace(" ",",",$obsretranferencia).'")';
                 $analista=utf8_encode(obtener_analista($cod)); 				 
			 }
			 if($estadosolicitud=="RECHAZADO"){
				 $condicionaprobado="";
				 $plazoaprobado="";
				 $montoaprobado="";
				 $montocuotaaprobada="";
				 $fechaaprobacion="";
				 $horaaprobacion="";
				 $obsdisplay='';
				$colorbacground='#f44336';
				$estadoactual="RECHAZADO";
				$accion1='abrir_cerrar_ventanas_obsanalista("4","'.str_replace(" ",",",$obsanalista).'")'; 
				 $analista=utf8_encode(obtener_analista($cod)); 
			 }
			 if($estadosolicitud=="APROBADO"){
			  $condicionaprobado=utf8_encode($valor['condicionaprobado']);
			  $plazoaprobado=utf8_encode($valor['plazoaprobado']);
			  $montoaprobado1=utf8_encode($valor['montoaprobado']);
			  if($montoaprobado1!=""){
			  $montoaprobado=number_format($montoaprobado1,'0',',','.');  
			  }
			  $montocuotaaprobada1=utf8_encode($valor['montocuotaaprobada']);
			  if($montocuotaaprobada1!=""){
				 $montocuotaaprobada=number_format($montocuotaaprobada1,'0',',','.'); 
			  }
			  $fechaaprobacion=utf8_encode($valor['fechaaprobacion']);
			  $horaaprobacion=utf8_encode($valor['horaaprobacion']);
				$obsdisplay='';
				$colorbacground='#03a9f4';
				$estadoactual="APROBADO";
				$accion1='abrir_cerrar_ventanas_obsanalista("4","'.str_replace(" ",",",$obsanalista).'")';
				 $analista=utf8_encode(obtener_analista($cod)); 
			 }
			 if($estadosolicitud=="PENDIENTE"){
				 $condicionaprobado="";
				 $plazoaprobado="";
				 $montoaprobado="";
				 $montocuotaaprobada="";
				 $fechaaprobacion="";
				 $horaaprobacion="";
				 $obsdisplay='none';
				$colorbacground='#4caf50';
				$estadoactual="ANALISIS";
			 }
			 if($estadosolicitud=="BORRADOR"){
				 $condicionaprobado="";
				 $plazoaprobado="";
				 $montoaprobado="";
				 $montocuotaaprobada="";
				 $fechaaprobacion="";
				 $horaaprobacion="";
				 
				 $obsdisplay='none';
				$estadoactual="PENDIENTE";
				$colorbacground='#607d8b';
			 }
	  	 $cant=$cant+1;
		// $accion='abrir_cerrar_ventanas_solicitudescredito("1")';
		 $accion='abrir_selecionar_mis_solicitudes("'.$cod.'","'.$estadosolicitud.'")';
		 
			
		if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr onclick=".$accion." ".$bacground." >
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:7%;text-align:center;' id='td_nrosolicitud'>".$nrosolicitud."</td>
<td class='td_detalles' style='width:11.5%;text-align:center;background:".$colorbacground.";color:".$colortex.";' id='td_estadosolicitud' >".$estadoactual."</td>
<td class='td_detalles' style='width:7%;text-align:center;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:24%;' id='td_Cliente'>".$Cliente."</td>
<td class='td_detalles' style='width:7%;text-align:center;' id='td_condicion'>".$condicions."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_montosolicitado'>".$montosolicitado."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_fecha'>".$fep."</td>
<td class='td_detalles' style='width:12.5%;text-align:center;' id='td_Vendedor' >".$Vendedor."</td>
<td class='td_detalles' style='width:0%;display:none' id='td_sucursal'>".$sucursal."</td>
<td  class='td_detalles'  style='width:11%;text-align:center;'>
<CENTER>
<button onclick='".$accion1."' style='display:".$obsdisplay.";box-shadow:inset -1px -1px 2px 0px #00000069;cursor:pointer;border-radius:30px;width:5%;background-color: var(--colorbotoneliminar);height: 35px;width: 35px; color: #FFF;'  type='button' class='input_eliminar_p'>
<svg style='height: 19px;display:".$obsdisplay.";'  aria-hidden='true' focusable='false' data-prefix='fas' data-icon='file-alt' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 384 512' class='svg-inline--fa fa-file-alt fa-w-12 fa-3x'><path fill='currentColor' d='M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm64 236c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-64c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-72v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm96-114.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z'></path></svg>
</button>
</CENTER>
</td>
</tr>
";		  
			  
			 	
	  }
 }
 
 $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_mis_solicitudes_creditos($buscador,$usuario){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $colortex='#fff';
	 $colorbacground='';
	 $obsdisplay='none';
	 $visibility='collapse';
	 $obsdisplaydesembolsar='none';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $montoaprobado="";
	 $condicionaprobado="";
	 $plazoaprobado="";
	 $fechaaprobacion="";
	 $accion="";
	 $accion1="";
$control_datos="d";
	 $accion2="";
	 $montocuotaaprobada="";
	 $sql= "SELECT s.cod,s.nrosolicitud,p1.cedula,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as Cliente,p1.telefono
,p.montodisponible as montosolicitado,s.condicionaprobado,s.montoaprobado, s.plazoaprobado,s.montocuotaaprobada, s.fechaaprobacion, s.horaaprobacion,s.obsretranferencia,s.obsanalista,s.fecha,s.hora,s.estadosolicitud
FROM solicitudescreditos s 
join planprestamos p on s.monto=p.cod
join personas p1 on s.clientes_cod=p1.cod
join usuarios u on s.usuarios_cod=u.cod
 where concat(s.nrosolicitud,' ',p1.cedula,' ',p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) like ? and s.estado='ACTIVO' and s.estadosolicitud!='BORRADOR' order by s.cod desc"; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$buscador="%".$buscador."%";

$stmt->bind_param($s,$buscador);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
			   
			   $cod=utf8_encode($valor['cod']);
		      $sucursal=utf8_encode(obtener_sucursal_usuarios($cod));
			  $estadosolicitud=utf8_encode($valor['estadosolicitud']); 
		  	  $nrosolicitud=utf8_encode($valor['nrosolicitud']);
			  $cedula=utf8_encode($valor['cedula']);
			  $Cliente=($valor['Cliente']);
			 
			  $montosolicitado1=utf8_encode($valor['montosolicitado']);
			  $montosolicitado=number_format($montosolicitado1,'0',',','.');
			  
			  $fecha=utf8_encode($valor['fecha']);
			  $hora=utf8_encode($valor['hora']);
			  $telefono=utf8_encode($valor['telefono']);
			  
			  $Vendedor=utf8_encode(obtener_vendedor($cod)); 
			 
			  $obsretranferencia=($valor['obsretranferencia']); 
			  $obsanalista=($valor['obsanalista']); 
			  $estadoactual="";
			  $analista=utf8_encode(obtener_analista($cod)); 
			  
			 if($estadosolicitud=="RETRANSFERIDO"){
			 $condicionaprobado="";
				 $plazoaprobado="";
				 $montoaprobado="";
				 $montocuotaaprobada="";
				 $fechaaprobacion="";
				 $horaaprobacion="";
				 $obsdisplay='';
				 $visibility='initial';
				 $obsdisplaydesembolsar='none';
				$colorbacground='#9c27b0';
				$estadoactual="RETRANSFERIDO";
				 $accion1='abrir_cerrar_ventanas_obsanalista("4","'.str_replace(" ",",",$obsretranferencia).'")'; 
				
			 }
			 if($estadosolicitud=="RECHAZADO"){
				$condicionaprobado="";
				$plazoaprobado="";
				$montoaprobado="";
				$montocuotaaprobada="";
				$fechaaprobacion="";
			    $horaaprobacion="";
				$obsdisplay='';
				$visibility='initial';
				$obsdisplaydesembolsar='none';
				$colorbacground='#f44336';
				$estadoactual="RECHAZADO";
				$accion1='abrir_cerrar_ventanas_obsanalista("4","'.str_replace(" ",",",$obsanalista).'")';
			 }
			 if($estadosolicitud=="APROBADO"){
			$condicionaprobado=utf8_encode($valor['condicionaprobado']);
			  $plazoaprobado=utf8_encode($valor['plazoaprobado']);
			  $montoaprobado1=utf8_encode($valor['montoaprobado']);
			  if($montoaprobado1!=""){
			  $montoaprobado=number_format($montoaprobado1,'0',',','.');  
			  }
			  $montocuotaaprobada1=utf8_encode($valor['montocuotaaprobada']);
			  if($montocuotaaprobada1!=""){
				 $montocuotaaprobada=number_format($montocuotaaprobada1,'0',',','.'); 
			  }
			  $fechaaprobacion=utf8_encode($valor['fechaaprobacion']);
			   if($fechaaprobacion!=""){
			  $datea = date_create($fechaaprobacion);
              $fechaaprobacion= date_format($datea,"d/m/Y");
			  }
			  $horaaprobacion=utf8_encode($valor['horaaprobacion']);
				$obsdisplay='';
				$visibility='initial';
				$obsdisplaydesembolsar='';
				$colorbacground='#03a9f4';
				$estadoactual="APROBADO";
				$accion1='abrir_cerrar_ventanas_obsanalista("4","'.str_replace(" ",",",$obsanalista).'")';
				$accion2='abrir_cerrar_ventanas_desembolso("1","'.$cod.'","'.$estadoactual.'","'.$nrosolicitud.'")';
			 }
              if($estadosolicitud=="IMPRIMIDO"){
			$condicionaprobado=utf8_encode($valor['condicionaprobado']);
			  $plazoaprobado=utf8_encode($valor['plazoaprobado']);
			  $montoaprobado1=utf8_encode($valor['montoaprobado']);
			  if($montoaprobado1!=""){
			  $montoaprobado=number_format($montoaprobado1,'0',',','.');  
			  }
			  $montocuotaaprobada1=utf8_encode($valor['montocuotaaprobada']);
			  if($montocuotaaprobada1!=""){
				 $montocuotaaprobada=number_format($montocuotaaprobada1,'0',',','.'); 
			  }
			  $fechaaprobacion=utf8_encode($valor['fechaaprobacion']);
			  if($fechaaprobacion!=""){
			  $datea = date_create($fechaaprobacion);
              $fechaaprobacion= date_format($datea,"d/m/Y");
			  }
			  $horaaprobacion=utf8_encode($valor['horaaprobacion']);
				$obsdisplay='';
				$visibility='initial';
				$obsdisplaydesembolsar='';
				$colorbacground='var(--colorcabezera)';
				$estadoactual="IMPRIMIDO";
				$accion1='abrir_cerrar_ventanas_obsanalista("4","'.str_replace(" ",",",$obsanalista).'")';
				$accion2='abrir_cerrar_ventanas_desembolso("1","'.$cod.'","'.$estadoactual.'","'.$nrosolicitud.'")';
			 }
              if($estadosolicitud=="DESEMBOLSADO"){
			$condicionaprobado=utf8_encode($valor['condicionaprobado']);
			  $plazoaprobado=utf8_encode($valor['plazoaprobado']);
			  $montoaprobado1=utf8_encode($valor['montoaprobado']);
			  if($montoaprobado1!=""){
			  $montoaprobado=number_format($montoaprobado1,'0',',','.');  
			  }
			  $montocuotaaprobada1=utf8_encode($valor['montocuotaaprobada']);
			  if($montocuotaaprobada1!=""){
				 $montocuotaaprobada=number_format($montocuotaaprobada1,'0',',','.'); 
			  }
			  $fechaaprobacion=utf8_encode($valor['fechaaprobacion']);
			  if($fechaaprobacion!=""){
			  $datea = date_create($fechaaprobacion);
              $fechaaprobacion= date_format($datea,"d/m/Y");
			  }
			  $horaaprobacion=utf8_encode($valor['horaaprobacion']);
				$obsdisplay='';
				$visibility='initial';
				$obsdisplaydesembolsar='';
				$colorbacground='var(--colorcabezera)';
				$estadoactual="DESEMBOLSADO";
				$accion1='abrir_cerrar_ventanas_obsanalista("4","'.str_replace(" ",",",$obsanalista).'")';
				$accion2='abrir_cerrar_ventanas_desembolso("1","'.$cod.'","'.$estadoactual.'","'.$nrosolicitud.'")';
			 }
			 if($estadosolicitud=="PENDIENTE"){
				  $condicionaprobado="";
				 $plazoaprobado="";
				 $montoaprobado="";
				 $montocuotaaprobada="";
				 $fechaaprobacion="";
				 $horaaprobacion="";
				 $obsdisplay='none';
				 $visibility='collapse';
				$colorbacground='#4caf50';
				$estadoactual="ANALISIS";
                $obsdisplaydesembolsar='none';

			 }
			 if($estadosolicitud=="BORRADOR"){
				
				 $condicionaprobado="";
				 $plazoaprobado="";
				 $montoaprobado="";
				 $montocuotaaprobada="";
				 $fechaaprobacion="";
				 $horaaprobacion="";
				 $obsdisplaydesembolsar='none';
				 $obsdisplay='none';
				 $visibility='collapse';
				$estadoactual="PENDIENTE";
				$colorbacground='#607d8b';

			 }
			 if($condicionaprobado=="DIAS"){
				 $condicionaprobado="D";
			 }else  if($condicionaprobado=="SEMANAL"){
				 $condicionaprobado="S";
			 }else if($condicionaprobado=="QUINCENAL"){
				 $condicionaprobado="Q";
			 }else if($condicionaprobado=="MENSUAL"){
				 $condicionaprobado="M";
			 }
	  	 $cant=$cant+1;
		// $accion='abrir_cerrar_ventanas_solicitudescredito("1")';
		if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
		

$pagina.="
<tr ".$bacground.">
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:8%;text-align:center;' id='td_nrosolicitud'>".$nrosolicitud."</td>
<td class='td_detalles' style='width:12%;background:".$colorbacground.";color:".$colortex.";' id='td_estadosolicitud' >".$estadoactual."</td>
<td  class='td_detalles'  style='width:6%;'>
<button onclick='".$accion1."'style='display:".$obsdisplay.";visibility:".$visibility.";box-shadow: inset -1px -1px 2px 0px #00000069;cursor:pointer;border-radius:30px;width:5%;background-color: var(--colorbotoneliminar);height: 35px;width: 35px; color: #FFF;'  type='button' class='input_eliminar_p'>
<svg style='height: 19px;display:".$obsdisplay.";'  aria-hidden='true' focusable='false' data-prefix='fas' data-icon='file-alt' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 384 512' class='svg-inline--fa fa-file-alt fa-w-12 fa-3x'><path fill='currentColor' d='M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm64 236c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-64c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-72v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm96-114.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z'></path></svg>
</button>
</td>
<td class='td_detalles' style='width:6%;'>
<button onclick='".$accion2."' style='display:".$obsdisplaydesembolsar.";visibility:".$visibility.";box-shadow:inset -1px -1px 2px 0px #00000069;cursor:pointer;border-radius:30px;width:5%;background-color: #03a9f4;height: 35px;width: 35px; color: #FFF;'  type='button' class='input_eliminar_p'>
<svg style='height: 19px;display:".$obsdisplaydesembolsar.";'  aria-hidden='true' focusable='false' data-prefix='fas' data-icon='hand-holding-usd' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512' class='svg-inline--fa fa-hand-holding-usd fa-w-18 fa-3x'><path fill='currentColor' d='M271.06,144.3l54.27,14.3a8.59,8.59,0,0,1,6.63,8.1c0,4.6-4.09,8.4-9.12,8.4h-35.6a30,30,0,0,1-11.19-2.2c-5.24-2.2-11.28-1.7-15.3,2l-19,17.5a11.68,11.68,0,0,0-2.25,2.66,11.42,11.42,0,0,0,3.88,15.74,83.77,83.77,0,0,0,34.51,11.5V240c0,8.8,7.83,16,17.37,16h17.37c9.55,0,17.38-7.2,17.38-16V222.4c32.93-3.6,57.84-31,53.5-63-3.15-23-22.46-41.3-46.56-47.7L282.68,97.4a8.59,8.59,0,0,1-6.63-8.1c0-4.6,4.09-8.4,9.12-8.4h35.6A30,30,0,0,1,332,83.1c5.23,2.2,11.28,1.7,15.3-2l19-17.5A11.31,11.31,0,0,0,368.47,61a11.43,11.43,0,0,0-3.84-15.78,83.82,83.82,0,0,0-34.52-11.5V16c0-8.8-7.82-16-17.37-16H295.37C285.82,0,278,7.2,278,16V33.6c-32.89,3.6-57.85,31-53.51,63C227.63,119.6,247,137.9,271.06,144.3ZM565.27,328.1c-11.8-10.7-30.2-10-42.6,0L430.27,402a63.64,63.64,0,0,1-40,14H272a16,16,0,0,1,0-32h78.29c15.9,0,30.71-10.9,33.25-26.6a31.2,31.2,0,0,0,.46-5.46A32,32,0,0,0,352,320H192a117.66,117.66,0,0,0-74.1,26.29L71.4,384H16A16,16,0,0,0,0,400v96a16,16,0,0,0,16,16H372.77a64,64,0,0,0,40-14L564,377a32,32,0,0,0,1.28-48.9Z' class=''></path></svg>

</button>
</td>


<td class='td_detalles' style='width:8%;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:18%;' id='td_Cliente'>".$Cliente."</td>
<td class='td_detalles' style='width:10%;' id='td_montoaprobado'>".$montoaprobado."</td>
<td class='td_detalles' style='width:5%;' id='td_condicionaprobado'>".$condicionaprobado."</td>
<td class='td_detalles' style='width:6%;' id='td_plazoaprobado'>".$plazoaprobado."</td>

<td class='td_detalles' style='width:8%;' id='td_fechaaprobacion'>".$fechaaprobacion."</td>

<td class='td_detalles' style='width:13%;' id='td_Vendedor' >".$Vendedor."</td>


</tr>
";		 	
 }
}
 
 $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_mis_solicitudes_desembolso($buscador, $estado){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $colortex='#fff';
	 $colorbacground='';
	 $obsdisplay='none';
	 $visibility='collapse';
	 $obsdisplaydesembolsar='none';
	 $obsdisplaypagar='none';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $montoaprobado="";
	 $accion="";
	 $montocuotaaprobada="";
	 $sql= "SELECT s.cod,s.nrosolicitud,p1.cedula,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as Cliente,p1.telefono
,p.montodisponible as montosolicitado,s.condicionaprobado,s.montoaprobado, s.plazoaprobado,s.montocuotaaprobada, s.fechaaprobacion, s.horaaprobacion,s.obsretranferencia,s.obsanalista,s.fecha,s.hora,s.estadosolicitud
FROM solicitudescreditos s 
join planprestamos p on s.monto=p.cod
join personas p1 on s.clientes_cod=p1.cod
join usuarios u on s.usuarios_cod=u.cod
 where concat(s.nrosolicitud,' ',p1.cedula,' ',p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) like ? and (s.estadosolicitud=?) and s. estado='ACTIVO' order by s.cod desc"; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
$buscador="%".$buscador."%";
$stmt->bind_param($s,$buscador,$estado);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
			 
			   $cod=utf8_encode($valor['cod']);
		      $sucursal=utf8_encode(obtener_sucursal_usuarios($cod));
			  $estadosolicitud=utf8_encode($valor['estadosolicitud']); 
		  	  $nrosolicitud=utf8_encode($valor['nrosolicitud']);
			  $cedula=utf8_encode($valor['cedula']);
			  $Cliente=($valor['Cliente']);
			 
			  $montosolicitado1=utf8_encode($valor['montosolicitado']);
			  $montosolicitado=number_format($montosolicitado1,'0',',','.');
			  
			  $fecha=utf8_encode($valor['fecha']);
			  $hora=utf8_encode($valor['hora']);
			  $telefono=utf8_encode($valor['telefono']);
			  
			  $Vendedor=utf8_encode(obtener_vendedor($cod)); 
			 
			  $obsretranferencia=($valor['obsretranferencia']); 
			  $obsanalista=($valor['obsanalista']); 
			  $estadoactual="";
			  $analista="";
			  $analista=utf8_encode(obtener_analista($cod)); 
			  
              if($estadosolicitud=="IMPRIMIDO"){
			$condicionaprobado=utf8_encode($valor['condicionaprobado']);
			  $plazoaprobado=utf8_encode($valor['plazoaprobado']);
			  $montoaprobado1=utf8_encode($valor['montoaprobado']);
			  if($montoaprobado1!=""){
			  $montoaprobado=number_format($montoaprobado1,'0',',','.');  
			  }
			  $montocuotaaprobada1=utf8_encode($valor['montocuotaaprobada']);
			  if($montocuotaaprobada1!=""){
				 $montocuotaaprobada=number_format($montocuotaaprobada1,'0',',','.'); 
			  }
			  $fechaaprobacion=utf8_encode($valor['fechaaprobacion']);
			  $horaaprobacion=utf8_encode($valor['horaaprobacion']);
				$obsdisplay='';
				$visibility='initial';
				$obsdisplaydesembolsar='';
				$obsdisplaypagar='none';
				$colorbacground='var(--colorcabezera)';
				$estadoactual="IMPRIMIDO";
				$accion1='abrir_cerrar_ventanas_obsanalista("4","'.str_replace(" ",",",$obsanalista).'")';
				$accion2='desembolsar_efectivo("'.$cod.'","'.$montoaprobado.'","'.$nrosolicitud.'")';
			 }
			 if($estadosolicitud=="DESEMBOLSADO"){
			$condicionaprobado=utf8_encode($valor['condicionaprobado']);
			  $plazoaprobado=utf8_encode($valor['plazoaprobado']);
			  $montoaprobado1=utf8_encode($valor['montoaprobado']);
			  if($montoaprobado1!=""){
			  $montoaprobado=number_format($montoaprobado1,'0',',','.');  
			  }
			  $montocuotaaprobada1=utf8_encode($valor['montocuotaaprobada']);
			  if($montocuotaaprobada1!=""){
				 $montocuotaaprobada=number_format($montocuotaaprobada1,'0',',','.'); 
			  }
			  $fechaaprobacion=utf8_encode($valor['fechaaprobacion']);
			  $horaaprobacion=utf8_encode($valor['horaaprobacion']);
				$obsdisplay='';
				$visibility='initial';
				$obsdisplaydesembolsar='none';
				$obsdisplaypagar='';
				$colorbacground='#03a9f4';
				$estadoactual="DESEMBOLSADO";
                $idventas="";
                $idventas=utf8_encode(obtener_idventas($nrosolicitud));
				$accion1='abrir_cerrar_ventanas_obsanalista("4","'.str_replace(" ",",",$obsanalista).'")';
				$accion2='abrir_cerrar_ventanas_cuotasclientes("1","'.$idventas.'")';
			 }
			
	  	 $cant=$cant+1;
		// $accion='abrir_cerrar_ventanas_solicitudescredito("1")';
		if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
		
$pagina.=" 
<tr ".$bacground.">
<td class='td_detalles' style='width:0%;display:none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:0%;background-color:#808080;color:red;text-align:center;display:none;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:10%;text-align:center;' id='td_nrosolicitud'>".$nrosolicitud."</td>
<td class='td_detalles' style='width:10%;background:".$colorbacground.";color:".$colortex.";' id='td_estadosolicitud' >".$estadoactual."</td>
<td class='td_detalles' style='width:6%;'>
<button onclick='".$accion2."' style='display:".$obsdisplaydesembolsar.";visibility:".$visibility.";box-shadow:inset -1px -1px 2px 0px #00000069;cursor:pointer;border-radius:7px;width:100%;background-color: #03a9f4;height: 35px;border:none;color: #FFF;font-size:10px;'  type='button' class='input_eliminar_p'>
DESEMBOL.
</button>
<button onclick='".$accion2."' style='display:".$obsdisplaypagar.";visibility:".$visibility.";box-shadow:inset -1px -1px 2px 0px #00000069;cursor:pointer;border-radius:7px;width:100%;background-color: #795548;height: 35px;border:none;color: #FFF;font-size:10px;'  type='button' class='input_eliminar_p'>
COBRAR CUOTA
</button>
</td>

<td class='td_detalles' style='width:10%;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:15%;' id='td_Cliente'>".$Cliente."</td>
<td class='td_detalles' style='width:10%;' id='td_telefono'>".$telefono."</td>
<td class='td_detalles' style='width:10%;' id='td_montoaprobado'>".$montoaprobado."</td>
<td class='td_detalles' style='width:7.5%;' id='td_condicionaprobado'>".$condicionaprobado."</td>
<td class='td_detalles' style='width:4%;' id='td_plazoaprobado'>".$plazoaprobado."</td>
<td class='td_detalles' style='width:5%;' id='td_montocuotaaprobada'>".$montocuotaaprobada."</td>
<td class='td_detalles' style='width:7.5%;' id='td_fechaaprobacion'>".$fechaaprobacion."</td>
<td class='td_detalles' style='width:10%;' id='td_sucursal'>".$sucursal."</td>
</tr>
";		 	
 }
}
 
 $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

 function obtener_idventas($nrosolicitud){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "select cod from ventas where nrosolicitud='$nrosolicitud' and estado='ACTIVO'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		  $analista=utf8_encode($valor['cod']);
		 
	  }
 }
 return $analista;
}
 
function obtener_analista($cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "SELECT concat(p2.primernombre,' ',p2.segundonombre,' ',p2.primerapellido,' ',p2.segundoapellido,' ',p2.apellidocasada) as analista 
FROM solicitudescreditos a
join usuarios u on a.analista_cod=u.cod
join personas p2 on u.personas_cod=p2.cod where a.cod='$cod'and a.estado='ACTIVO'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		
		   $analista=utf8_encode($valor['analista']);
	  }
 }
 return $analista;
}

function verificar_clientes_con_solicitudes_pendiente_o_en_borrador($cedula1){
	$mysqli=conectar_al_servidor();
	 $cant=0;
	  $nrosolicitud="";
	  $fecha="";
	  $cedula="";
	  $Cliente="";
	  $cargadopor="";
	  $estadosolicitud="";
	  $fep="";
		$sql= "SELECT s.nrosolicitud,s.fecha,p.cedula,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as cliente,concat(p1.primernombre,' ',p1.segundonombre,' ',p1.primerapellido,' ',p1.segundoapellido,' ',p1.apellidocasada) as cargadopor,s.estadosolicitud
FROM solicitudescreditos s
join personas p on clientes_cod=p.cod
join usuarios u on s.usuarios_cod=u.cod
join personas p1 on p1.cod=u.personas_cod
where (s.estadosolicitud='PENDIENTE' or s.estadosolicitud='BORRADOR') and s.estado='ACTIVO' and p.cedula=".$cedula1."";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		   $nrosolicitud=utf8_encode($valor['nrosolicitud']);
		   $fecha=utf8_encode($valor['fecha']);
		   $datea = date_create($fecha);
           $fep= date_format($datea,"d/m/Y");
		   $cedula=utf8_encode($valor['cedula']);
		   $Cliente=($valor['cliente']); 
		   $cargadopor=utf8_encode($valor['cargadopor']); 
		   $estadosolicitud=utf8_encode($valor['estadosolicitud']); 
		   $cant= $cant+1;
	  }
 }
 $informacion =array("1" => "exito","2" => $cant,"3" => $nrosolicitud,"4" => $fep,"5" => $cedula,"6" => $Cliente,"7" => $cargadopor,"8" => $estadosolicitud);
echo json_encode($informacion);	
exit;
}


function obtener_vendedor($cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "SELECT concat(p2.primernombre,' ',p2.segundonombre,' ',p2.primerapellido,' ',p2.segundoapellido,' ',p2.apellidocasada) as analista 
FROM solicitudescreditos a
join usuarios u on a.vendedor_cod=u.cod
join personas p2 on u.personas_cod=p2.cod where a.cod='$cod'and a.estado='ACTIVO'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		  $analista=utf8_encode($valor['analista']);  
	  }
 }
 return $analista;
}

function obtener_sucursal_usuarios($cod){
	$mysqli=conectar_al_servidor();
	 $sucursal='';
		$sql= "SELECT concat(su.nombres,' ',su.numero) as sucursal 
FROM solicitudescreditos s
join usuarios u on s.usuarios_cod=u.cod
join personas p on u.personas_cod=p.cod
join sucursales su on u.sucursales_cod=su.cod
where s.estado='ACTIVO' and  s.cod='$cod'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		    $sucursal=utf8_encode($valor['sucursal']);
		  
	  }
 }
 return $sucursal;
}

verificar_datos();

?>