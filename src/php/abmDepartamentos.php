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
		
		if($func=='guardar' || $func=='editar' || $func=='eliminar'){
				
			
		$iddepartamentos = $_POST['iddepartamentos'];
		$iddepartamentos = utf8_decode($iddepartamentos);
		
		$departamentos = $_POST['departamentos'];
		$departamentos = utf8_decode($departamentos);
					
		$regiones_idregiones = $_POST['regiones_idregiones'];
		$regiones_idregiones = utf8_decode($regiones_idregiones);
			mantenimiento($func,$iddepartamentos,$departamentos,$regiones_idregiones);
		}
		}	


function mantenimiento($func,$iddepartamentos,$departamentos,$regiones_idregiones){
	if($iddepartamentos=="" || $departamentos=="" || $regiones_idregiones=="" ){
    echo "camposvacio";	
    exit;
	}

$mysqli=conectar_al_servidor();
if($func=='guardar'){
$consulta= "Select count(*) from departamentos where iddepartamentos=?  ";
$stmt = $mysqli->prepare($consulta);
$ss='s';
$stmt->bind_param($ss, $iddepartamentos); 
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
   $sql="insert into departamentos (iddepartamentos,departamentos,regiones_idregiones,estado) value (upper(?),upper(?),upper(?),'ACTIVO')";
   $s='sss';
   $stmt = $mysqli->prepare($sql);
   $stmt->bind_param($s,$iddepartamentos,$departamentos,$regiones_idregiones); 
}else if($func=='editar'){
		
	    $sql='update departamentos set departamentos=upper(?),regiones_idregiones=upper(?),estado="ACTIVO" where iddepartamentos=?';
		$s='ssi';
			$stmt = $mysqli->prepare($sql);
            $stmt->bind_param($s,$departamentos,$regiones_idregiones,$iddepartamentos); 
	} else if($func=='eliminar'){
		
	    $sql="update departamentos set estado='ELIMINADO' where iddepartamentos=?";
		
		$s='i';
			$stmt = $mysqli->prepare($sql);
            $stmt->bind_param($s,$iddepartamentos); 
	}
   if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
	echo"exito";
}
	
	
	
function buscar($buscar,$buscar2)
{
	$mysqli=conectar_al_servidor();
	 $pagina='';
	  $cant=0;
	 $sql= "Select d.iddepartamentos,d.departamentos,d.regiones_idregiones,r.regiones,d.estado from departamentos d join regiones r on r.idregiones=d.regiones_idregiones where d.estado=? and d.departamentos like ?  limit 10"; 
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
 
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result))
	  {
		      $iddepartamentos=$valor['iddepartamentos'];  
		  	  $departamentos=utf8_encode($valor['departamentos']);
			   $regiones_idregiones=utf8_encode($valor['regiones_idregiones']);
			    $regiones=utf8_encode($valor['regiones']);
			  $estado=utf8_encode($valor['estado']); 
	  	  $cant=$cant+1;
		     if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }
$pagina.="

<tr onclick='obtener_datos_departamentos(this)' ".$bacground." >
<td class='td_detalles' style='width:0%;display: none;' id='td_regiones_idregiones'>".$regiones_idregiones."</td>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:20%;' id='td_iddepartamentos'>".$iddepartamentos."</td>
<td class='td_detalles' style='width:30%;' id='td_departamentos'>".$departamentos."</td>
<td class='td_detalles' style='width:25%;' id='td_regiones'>".$regiones."</td>
<td class='td_detalles' style='width:20%;' id='td_estado' >".$estado."</td>
</tr>
";		  
	  }
 }

  $informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;
}

function buscar_combo()
{
	$mysqli=conectar_al_servidor();
	 $pagina='<option value ="">SELECCIONAR</option>';
	 $sql= "Select iddepartamentos,departamentos from departamentos where estado='ACTIVO'"; 
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
		      $iddepartamentos=$valor['iddepartamentos'];  
		  	  $departamentos=utf8_encode($valor['departamentos']);
              $pagina.="<option value ='".$iddepartamentos."'>".$departamentos."</option>";	  
	  }
 }

 $informacion =array("1" => "exito","2" => $pagina);
echo json_encode($informacion);	
exit;
}


verificar_datos();

?>