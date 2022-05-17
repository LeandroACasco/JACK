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
		
			
		if($func=='buscar_datos_clientes_editar'){
			$cedulac = $_POST['cedulac'];
			$cedulac = utf8_decode($cedulac);
			buscar_datos_clientes_editar($cedulac);
		}
		
		}	




function buscar_datos_clientes_editar($cedulac){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d"; 
		      $idclientes=""; 
		      $cod=""; 
		  	  $primernombre=""; 
		  	  $segundonombre=""; 
		  	  $primerapellido=""; 
		  	  $segundoapellido=""; 
		  	  $apellidocasada=""; 	  
			  $nombres=""; 
		  	  $cedula=""; 
		  	  $ruc=""; 
		  	  $sexo=""; 
		  	  $fechanac=""; 
		  	  $telefono=""; 
		  	  $correo=""; 
		  	  $direccion=""; 
		  	  $conyuge=""; 
		  	  $referenciadireccio=""; 
		  	  $viviendapropia=""; 
		  	  $observacion=""; 
		  	  $lnglat=""; 
		  	  $barrios_cod=""; 
		  	  $barrios=""; 
		  	  $ciudades=""; 
		  	  $departamentos=""; 
		  	  $nacionalidad_cod=""; 
		  	  $nacionalidad=""; 
		  	  $estadosciviles_cod=""; 
		  	  $EstadosCivil=""; 
		  	  $tipospersonas_cod=""; 
		  	  $Tipo=""; 
		  	  $profesiones_cod=""; 
		  	  $Profesion=""; 
		  	  $usuarios_cod=""; 
			  $fecha=""; 
			  $hora=""; 
			  $estado=""; 
			  
	 $sql= "SELECT p.cod, p.primernombre, p.segundonombre, p.primerapellido, p.segundoapellido, p.apellidocasada,
 p.cedula, p.ruc, p.sexo, p.fechanac, p.telefono, p.correo,p.direccion, p.conyuge,p.referenciadireccio,
 p.viviendapropia, p.observacion, p.lnglat, p.barrios_cod,b.barrios,c.ciudades,d.departamentos, p.nacionalidad_cod,n.nacionalidad,
 p.estadosciviles_cod,e.EstadosCivil, p.tipospersonas_cod,t.Tipo, p.profesiones_cod,pr.Profesion, p.usuarios_cod
 , p.fecha, p.hora, p.estado 
 from personas p 
 join barrios b on p.barrios_cod=b.cod
 join ciudades c on b.ciudades_idciudades=c.idciudades
 join departamentos d on c.departamentos_iddepartamentos=d.iddepartamentos
 join nacionalidad n on p.nacionalidad_cod=n.cod
 join estadosciviles e on p.estadosciviles_cod=e.cod
 join tipospersonas t on p.tipospersonas_cod=t.cod
 join profesiones pr on p.profesiones_cod=pr.cod
 where p.estado='ACTIVO' and p.cedula=? "; 
   $stmt = $mysqli->prepare($sql);
  $s='s';
$cedulac="".$cedulac."";
$stmt->bind_param($s,$cedulac);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)) {
		     
		        
		      $cod=$valor['cod'];  
		  	  $primernombre=($valor['primernombre']);
		  	  $segundonombre=($valor['segundonombre']);
		  	  $primerapellido=($valor['primerapellido']);
		  	  $segundoapellido=($valor['segundoapellido']);
		  	  $apellidocasada=utf8_encode($valor['apellidocasada']);	  
			  $nombres=$primernombre." ".$segundonombre." ".$primerapellido." ".$segundoapellido." ".$apellidocasada;
		  	  $cedula=utf8_encode($valor['cedula']);
		  	  $ruc=utf8_encode($valor['ruc']);
		  	  $sexo=utf8_encode($valor['sexo']);
		  	  $fechanac=utf8_encode($valor['fechanac']);
		  	  $telefono=utf8_encode($valor['telefono']);
		  	  $correo=utf8_encode($valor['correo']);
		  	  $direccion=utf8_encode($valor['direccion']);
		  	  $conyuge=utf8_encode($valor['conyuge']);
		  	  $referenciadireccio=utf8_encode($valor['referenciadireccio']);
		  	  $viviendapropia=utf8_encode($valor['viviendapropia']);
		  	  $observacion=utf8_encode($valor['observacion']);
		  	  $lnglat=utf8_encode($valor['lnglat']);
		  	  $barrios_cod=utf8_encode($valor['barrios_cod']);
		  	  $barrios=utf8_encode($valor['barrios']);
		  	  $ciudades=utf8_encode($valor['ciudades']);
		  	  $departamentos=utf8_encode($valor['departamentos']);
		  	  $nacionalidad_cod=utf8_encode($valor['nacionalidad_cod']);
		  	  $nacionalidad=utf8_encode($valor['nacionalidad']);
		  	  $estadosciviles_cod=utf8_encode($valor['estadosciviles_cod']);
		  	  $EstadosCivil=utf8_encode($valor['EstadosCivil']);
		  	  $tipospersonas_cod=utf8_encode($valor['tipospersonas_cod']);
		  	  $Tipo=utf8_encode($valor['Tipo']);
		  	  $profesiones_cod=utf8_encode($valor['profesiones_cod']);
		  	  $Profesion=utf8_encode($valor['Profesion']);
		  	  $usuarios_cod=utf8_encode($valor['usuarios_cod']);
			  $fecha=utf8_encode($valor['fecha']);
			  $hora=utf8_encode($valor['hora']);
			  $estado=utf8_encode($valor['estado']); 
	  	      $cant=$cant+1;
			  
   }
 }
 
$informacion =array("1" => $cod,
                    "2" => $primernombre,
					"3" => $segundonombre,
					"4" => $primerapellido,
					"5" => $segundoapellido,
					"6" => $apellidocasada,
					"7" => $nombres,
					"8" => $cedula,
					"9" => $ruc,
					"10" => $sexo,
					"11" => $fechanac,
					"12" => $telefono,
					"13" => $correo,
					"14" => $direccion,
					"15" => $conyuge,
					"16" => $referenciadireccio,
					"17" => $viviendapropia,
					"18" => $observacion,
					"19" => $lnglat,
					"20" => $barrios_cod,
					"21" => $nacionalidad_cod,
					"22" => $estadosciviles_cod,
					"23" => $tipospersonas_cod,
					"24" => $profesiones_cod,
					"25" => $cant,
					"26" => $barrios,
					"27" => $Profesion,
					"28" => $cod, 
					
);
echo json_encode($informacion);	
exit;
}


verificar_datos();

?>