<?php
require("conexion.php");

function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
		if($func=='buscar'){
			$buscar = $_POST['buscar'];
			$buscar = utf8_decode($buscar);
			
			
			$buscar2 = $_POST['buscar2'];
			$buscar2 = utf8_decode($buscar2);	
			buscar($buscar,$buscar2);
			
		}
		if($func=='buscarcombo'){		
			buscar_combo();	
		}
        if($func=='buscarcombocobrador'){		
			buscar_combo_cobrador();	
		}
		if($func=='buscarcombousuario'){		
			buscar_combo_usuarios();	
		}
		if($func=='buscar_combo_cobrador_auditoria'){		
			buscar_combo_cobrador_auditoria();	
		}
		if($func=='buscar_combo_usuarios_auditoria'){		
			buscar_combo_usuarios_auditoria();	
		}
		if($func=='buscar_cobradores'){	
         	$nombres = $_POST['nombres'];
			$nombres = utf8_decode($nombres);	
			buscar_cobradores($nombres);	
		}
		
		 if($func=="buscar_usuarios_conclavepermiso"){
	$clavepermiso=$_POST['clavepermiso'];
	$clavepermiso = utf8_decode($clavepermiso);
	buscar_usuarios_conclavepermiso($clavepermiso);
}

		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
		$cod = $_POST['cod'];
		$cod = utf8_decode($cod);
		
		$user = $_POST['user'];
		$user = utf8_decode($user);
		
		$pass = $_POST['pass'];
		$pass = utf8_decode($pass);
        
        $clavepermiso = $_POST['clavepermiso'];
		$clavepermiso = utf8_decode($clavepermiso);
					
		$personas_cod = $_POST['personas_cod'];
		$personas_cod = utf8_decode($personas_cod);
		
		$accesos_cod = $_POST['accesos_cod'];
		$accesos_cod = utf8_decode($accesos_cod);
		
	    $motivo = $_POST['motivo'];
		$motivo = utf8_decode($motivo);
		
		$fechaegreso = $_POST['fechaegreso'];
		$fechaegreso = utf8_decode($fechaegreso);
		
		$fechaingreso = $_POST['fechaingreso'];
		$fechaingreso = utf8_decode($fechaingreso);
		
		$usuarios_cod = $_POST['usuarios_cod'];
		$usuarios_cod = utf8_decode($usuarios_cod);
		
		$comisionventa = $_POST['comisionventa'];
		$comisionventa = utf8_decode($comisionventa);
		
		$comisioncobro = $_POST['comisioncobro'];
		$comisioncobro = utf8_decode($comisioncobro);
		
		$hora = $_POST['hora'];
		$hora = utf8_decode($hora);
		
		$sucursales_cod = $_POST['sucursales_cod'];
		 $sucursales_cod = utf8_decode($sucursales_cod);
		
		mantenimiento($func,$clavepermiso,$sucursales_cod,$fechaingreso,$cod,$user,$pass,$personas_cod,$accesos_cod,$motivo,$fechaegreso,$hora,$usuarios_cod,$comisionventa,$comisioncobro);
		}
		}	

function buscar_usuarios_conclavepermiso($clavepermiso) {
	$mysqli=conectar_al_servidor();

	 $sql= "SELECT cod,count(cod) cantidad FROM usuarios where clavepermiso='".$clavepermiso."' and estado='ACTIVO'"; 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){     
		      $cod=utf8_encode($valor['cod']);
		  	  $cantidad=utf8_encode($valor['cantidad']);
	  }
 }
 $informacion =array("1" => "exito","2" => $cod,"3" => $cantidad);
echo json_encode($informacion);	
exit;
}




function mantenimiento($func,$clavepermiso,$sucursales_cod,$fechaingreso,$cod,$user,$pass,$personas_cod,$accesos_cod,$motivo,$fechaegreso,$hora,$usuarios_cod,$comisionventa,$comisioncobro){
	if($accesos_cod=="" || $personas_cod=="" || $hora=="" || $sucursales_cod=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from usuarios where cod=?  ";
$stmt = $mysqli->prepare($consulta);
$ss='s';
$stmt->bind_param($ss, $cod); 
if ( ! $stmt->execute()){
   echo "Error";
   exit;
}
$result = $stmt->get_result();
$nro_total=$result->fetch_row();
  $valor=$nro_total[0];

if($valor>=1) {
echo "duplicado";	
exit;
}
   $sql="insert into usuarios (clavepermiso,sucursales_cod,user, pass, personas_cod, accesos_cod, hora,usuarios_cod,comisionventa,comisioncobro,fechaingreso, fecha, estado) value (upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),upper(?),?,?,?,current_date(),'ACTIVO')";
   $s='sssssssssss';
   $stmt = $mysqli->prepare($sql);
   $stmt->bind_param($s,$clavepermiso,$sucursales_cod,$user,$pass,$personas_cod,$accesos_cod,$hora,$usuarios_cod,$comisionventa,$comisioncobro,$fechaingreso); 
}else if($func=='editar'){
		
	    $sql='update usuarios set clavepermiso=?,sucursales_cod=?,user=upper(?), pass=upper(?), personas_cod=upper(?), accesos_cod=upper(?), hora=upper(?), usuarios_cod=upper(?),comisionventa=upper(?),comisioncobro=upper(?), fecha=current_date(),estado="ACTIVO" where cod=?';
		$s='ssssssssssi';
			$stmt = $mysqli->prepare($sql);
            $stmt->bind_param($s,$clavepermiso,$sucursales_cod,$user,$pass,$personas_cod,$accesos_cod,$hora,$usuarios_cod,$comisionventa,$comisioncobro,$cod); 
	} else if($func=='eliminar'){
	    $sql="update usuarios set fechaegreso=upper(?),motivo=upper(?),estado='ELIMINADO' where cod=?";
		$s='ssi';
			$stmt = $mysqli->prepare($sql);
            $stmt->bind_param($s,$fechaegreso,$motivo,$cod); 
	}
   if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
	echo"exito";
}
	
	
function buscar($buscar,$buscar2){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT u.cod,u.personas_cod,p.cedula,p.ruc,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as nombres,
	 p.telefono,u.accesos_cod,a.accesos, u.user,u.sucursales_cod, u.pass,u.clavepermiso,u.fecha,u.hora,u.fechaegreso,u.motivo,u.comisioncobro,u.comisionventa,concat(s.nombres,' ',s.numero) as sucursal ,u.estado  
FROM usuarios u
join personas p on u.personas_cod=p.cod
join accesos a on u.accesos_cod=a.cod
join sucursales s on u.sucursales_cod=s.cod
 where u.estado=? and concat(p.cedula,' ',p.ruc,' ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) like ?"; 
   $stmt = $mysqli->prepare($sql);
  $s='ss';
$buscar="%".$buscar."%";
$buscar2="".$buscar2."";
$stmt->bind_param($s,$buscar2,$buscar);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0) {
	  while ($valor= mysqli_fetch_assoc($result)) {
		      $cod=$valor['cod'];  
		  	  $personas_cod=utf8_encode($valor['personas_cod']);
		  	  $comisioncobro1=utf8_encode($valor['comisioncobro']);
			  $comisioncobro=number_format($comisioncobro1,'0',',','.');
		  	  $comisionventa1=utf8_encode($valor['comisionventa']);
			  $comisionventa=number_format($comisionventa1,'0',',','.');
			  $cedula=utf8_encode($valor['cedula']);
			  $ruc=utf8_encode($valor['ruc']);
			  $nombres=utf8_encode($valor['nombres']);
			  $telefono=utf8_encode($valor['telefono']);
			  $accesos_cod=utf8_encode($valor['accesos_cod']);
			  $accesos=utf8_encode($valor['accesos']);
			 $user=utf8_encode($valor['user']);
			 $sucursal=utf8_encode($valor['sucursal']);
			 $sucursales_cod=utf8_encode($valor['sucursales_cod']);
			 $pass=utf8_encode($valor['pass']);
			 $clavepermiso=utf8_encode($valor['clavepermiso']);
			 $fecha=utf8_encode($valor['fecha']);
			 $fechaegreso=utf8_encode($valor['fechaegreso']);
			 $motivo=utf8_encode($valor['motivo']);
			 $hora=utf8_encode($valor['hora']);
			 $estado=utf8_encode($valor['estado']); 
	  	     $cant=$cant+1;
	 if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.=" 
<tr onclick='obtener_datos_usuarios(this)'  ".$bacground." >
<td class='td_detalles' style='width:0%;display: none;' id='td_accesos_cod'>".$accesos_cod."</td>
<td class='td_detalles' style='width:0%;display: none;' id='td_personas_cod'>".$personas_cod."</td>
<td class='td_detalles' style='width:0%;display: none;' id='td_fechaegreso'>".$fechaegreso."</td>
<td class='td_detalles' style='width:0%;display: none;' id='td_sucursales_cod'>".$sucursales_cod."</td>
<td class='td_detalles' style='width:0%;display: none;' id='td_motivo'>".$motivo."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:6.2%;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:6.2%;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:6.2%;' id='td_ruc'>".$ruc."</td>
<td class='td_detalles' style='width:20%;' id='td_nombres'>".$nombres."</td>
<td class='td_detalles' style='width:6.2%;' id='td_accesos'>".$accesos."</td>
<td class='td_detalles' style='width:6.2%;' id='td_user'>".$user."</td>
<td class='td_detalles' style='width:6.2%;' id='td_pass'>".$pass."</td>
<td class='td_detalles' style='width:6.2%;' id='td_clavepermiso'>".$clavepermiso."</td>
<td class='td_detalles' style='width:6.2%;' id='td_comisioncobro'>".$comisioncobro."</td>
<td class='td_detalles' style='width:6.2%;' id='td_comisionventa'>".$comisionventa."</td>
<td class='td_detalles' style='width:6.2%;' id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:6.2%;' id='td_sucursal'>".$sucursal."</td>
<td class='td_detalles' style='width:6.2%;' id='td_estado' >".$estado."</td>
</tr>
";		  
	  }
 }
  $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

	
function buscar_cobradores($buscar) {
 $mysqli=conectar_al_servidor();
 $pagina='';
 $cant=0; 
 $sql= "SELECT u.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada,' - ',a.accesos) as nombres,a.accesos,p.cedula
FROM usuarios u
join personas p on u.personas_cod=p.cod
join accesos a on u.accesos_cod=a.cod
join sucursales s on u.sucursales_cod=s.cod
 where u.estado='ACTIVO' and a.accesos='EJECUTIVO' and concat(p.cedula,' ',p.ruc,' ',p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) like ?"; 
 $stmt = $mysqli->prepare($sql);
 $s='s';
$buscar="%".$buscar."%";
$stmt->bind_param($s,$buscar);
if (!$stmt->execute()) {
   echo "Error";
   exit;
}
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result))
	  {
		      $cod=$valor['cod'];  
		  	  $nombres=utf8_encode($valor['nombres']);
			   $accesos=utf8_encode($valor['accesos']);
			   $cedula=utf8_encode($valor['cedula']);
		
	  	 $cant=$cant+1;
		if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.="
<tr onclick='obtener_datos_vistacobradores_3(this)' ".$bacground." >
<td class='td_detalles' style='width:0%;display: none;' id='td_cod'>".$cod."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:20%;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:40%;' id='td_nombres'>".$nombres."</td>
<td class='td_detalles' style='width:35%;' id='td_accesos' >".$accesos."</td>
</tr>
";		  
	  }
 }

  $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}


function buscar_combo() {
	$mysqli=conectar_al_servidor();
	 $pagina='<option value ="">SELECCIONAR</option>';
	 $sql= "SELECT u.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada,' - ',a.accesos) as nombres
FROM usuarios u
join personas p on u.personas_cod=p.cod
join accesos a on u.accesos_cod=a.cod
join sucursales s on u.sucursales_cod=s.cod
 where u.estado='ACTIVO' and (a.accesos='VENDEDOR' or a.accesos='EJECUTIVO')"; 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result))
      {     
		      $cod=$valor['cod'];  
		  	  $nombres=utf8_encode($valor['nombres']);
              $pagina.="<option value ='".$cod."'>".$nombres."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}





function buscar_combo_cobrador() {
	$mysqli=conectar_al_servidor();
	 $pagina='<option value ="">SELECCIONAR</option>';
	 $sql= "SELECT u.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada,' - ',a.accesos) as nombres
FROM usuarios u
join personas p on u.personas_cod=p.cod
join accesos a on u.accesos_cod=a.cod
join sucursales s on u.sucursales_cod=s.cod
 where u.estado='ACTIVO' and a.accesos='EJECUTIVO'"; 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result))
 {     
		      $cod=$valor['cod'];  
		  	  $nombres=utf8_encode($valor['nombres']);
              $pagina.="<option value ='".$cod."'>".$nombres."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}

function buscar_combo_cobrador_auditoria() {
	$mysqli=conectar_al_servidor();
	 $pagina='<option value ="TODOS">TODOS</option>';
	 $sql= "SELECT u.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada,' - ',a.accesos) as nombres
FROM usuarios u
join personas p on u.personas_cod=p.cod
join accesos a on u.accesos_cod=a.cod
join sucursales s on u.sucursales_cod=s.cod
 where u.estado='ACTIVO' and a.accesos='COBRADOR'"; 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result))
 {     
		      $cod=$valor['cod'];  
		  	  $nombres=utf8_encode($valor['nombres']);
              $pagina.="<option value ='".$cod."'>".$nombres."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}

function buscar_combo_usuarios_auditoria() {
	$mysqli=conectar_al_servidor();
	 $pagina='<option value ="TODOS">TODOS</option>';
	 $sql= "SELECT u.cod,concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada,' - ',a.accesos) as nombres
FROM usuarios u
join personas p on u.personas_cod=p.cod
join accesos a on u.accesos_cod=a.cod
join sucursales s on u.sucursales_cod=s.cod
 where u.estado='ACTIVO' and a.accesos!='COBRADOR'"; 
   $stmt = $mysqli->prepare($sql);
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
   }
 
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result))
 {     
		      $cod=$valor['cod'];  
		  	  $nombres=utf8_encode($valor['nombres']);
              $pagina.="<option value ='".$cod."'>".$nombres."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}


verificar_datos();
?>