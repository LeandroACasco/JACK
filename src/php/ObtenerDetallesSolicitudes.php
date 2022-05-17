<?php
require("conexion.php");
function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
	
		if($func=='buscar_detalles_solicitudes'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_solicitudes($cod);	
		}
		if($func=='buscar_detalles_referencias_laborales'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_referencias_laborales($cod);	
		}
		if($func=='buscar_detalles_datos_del_negocio'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_datos_del_negocio($cod);	
		}
		if($func=='buscar_detalles_referencias_personales'){
			$nro = $_POST['nro'];
			$nro = utf8_decode($nro);
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_referencias_personales($cod,$nro);	
		}
		if($func=='buscar_detalles_ingresos'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_ingresos($cod);	
		}
		if($func=='buscar_detalles_egresos'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_egresos($cod);	
		}		
		if($func=='buscar_detalles_fotos'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_fotos($cod);	
		}
		if($func=='buscar_detalles_archivos'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_archivos($cod);	
		}
		if($func=='buscar_detalles_archivos_creditos'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_archivos_creditos($cod);	
		}	
		if($func=='buscar_detalles_fotos_creditos'){
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_fotos_creditos($cod);	
		}	
		if($func=='buscar_detalles_referencias_creditos_comerciales'){
			$nro = $_POST['nro'];
			$nro = utf8_decode($nro);
			
			$cod = $_POST['cod'];
			$cod = utf8_decode($cod);
			buscar_detalles_referencias_creditos_comerciales($cod,$nro);	
		}
		}

function buscar_detalles_archivos($cod) {
$mysqli=conectar_al_servidor();
$sql='';
 $pagina='';
 $pagina1='';
 $opcionespagina='';

$cant=0;
$totalcan=0;
$ancho="";
$img="";
$sql= "SELECT url, nombres, tamanho, extencion, solicitudescreditos_cod FROM documentospersonas where estado='ACTIVO' and solicitudescreditos_cod='$cod'"; 

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
		    $cod=utf8_encode($valor['solicitudescreditos_cod']); 
		   $url=utf8_encode($valor['url']); 
		   $extencion=utf8_encode($valor['extencion']); 
		     $nombres=utf8_encode($valor['nombres']); 
		    $tamanho=utf8_encode($valor['tamanho']); 
			$archivo=".".$url;
		   // $foto=base64_encode_image($url,$extencion);		 
		     if($extencion=="pdf"){
		$img="./icono/pdf.png";
	}
	if($extencion=="docx" || $extencion=="doc"){
		$img="./icono/word.png";
	}
	if($extencion=="xlsx" || $extencion=="xltx" || $extencion=="xlsb"){
		$img="./icono/excel.png";
	}
          $cant=$cant+1;
	
	$pagina.="
	<tr class='tr_archivo'>
				<td  class='td_titulo' style='width:10%;text-align:center;' >
				<div class='contenedor_archivo_preview' style='background-image: url(".$img.")' >
				</td>
				<td id='td_nombre' class='td_titulo' style='width: 75%;border-bottom: 1px solid #d6d3d3;' >".$nombres."</td>
				<td id='td_tamanho' class='td_titulo' style='width:10%;border-bottom: 1px solid #d6d3d3;' >".$tamanho."</td>
				<td class='td_titulo' style='width: 5%;border-bottom: 1px solid #d6d3d3;' ><a style='text-decoration: none;' href='".$archivo."' target='_blank'><button type='button' style='cursor:pointer;' class='input_eliminar_archivo'><img src='./icono/descarga.png' style='width:15px;height:15px;' /></button></a></td>
	</tr>
"; 


 }
 
 }
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;

}

function buscar_detalles_fotos_creditos($cod) {
$mysqli=conectar_al_servidor();
$sql='';
 $pagina='';
 $pagina1='';
 $opcionespagina='';

$cant=0;
$totalcan=0;
$ancho="";
 $xdxd="";
$sql= "SELECT url,solicitudescreditos_cod, extencion FROM fotospersonas where estado='ACTIVO' and solicitudescreditos_cod='$cod'"; 

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
		  
		   $cod=utf8_encode($valor['solicitudescreditos_cod']); 
		   $url=utf8_encode($valor['url']); 
		   $extencion=utf8_encode($valor['extencion']); 
		   $totalcan=obtener_maximo_cantidad_imagen($cod);		
		   $foto=".".$url;

	  //$foto1=base64_encode_archivos_varios("C:/wamp/www/CreditoGuarani".$url,$extencion,"IMAGEN");		 
	$foto1=base64_encode_archivos_varios("http://adaroinmobiliaria.com/creditoguarani".$url,$extencion,"IMAGEN");		 
    $cant=$cant+1;
	$ancho=$totalcan*115;
	$pagina.="<div id='".$cant."' name='cnt_adjuntos_imagenes' class='contenedor_img_preview' style='background-image: url(".$foto.")' >
	  <div id='div_nombre' style='display:none;font-size:0px;'></div>
      <div id='div_tamanho'  style='display:none;font-size:0px;'></div>
      <div id='div_extension' style='display:none;font-size:0px;'>".$extencion."</div>
      <div id='div_base64' style='display:none;font-size:0px;'>".$foto1."</div>
      <div id='".$cant."'  class='boton_cerrar_contenedor_img_preview'>x</div>
	  </div>"; 


 }
 
  }
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;

}

function buscar_detalles_archivos_creditos($cod) {
$mysqli=conectar_al_servidor();
$sql='';
 $pagina='';
 $pagina1='';
 $opcionespagina='';

$cant=0;
$totalcan=0;
$ancho="";
$img="";
$sql= "SELECT url, nombres, tamanho, extencion, solicitudescreditos_cod FROM documentospersonas where estado='ACTIVO' and solicitudescreditos_cod='$cod'"; 

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
		    $cod=utf8_encode($valor['solicitudescreditos_cod']); 
		    $url=utf8_encode($valor['url']); 
		    $extencion=utf8_encode($valor['extencion']); 
		    $nombres=utf8_encode($valor['nombres']); 
		    $tamanho=utf8_encode($valor['tamanho']); 
		  
			$archivo=".".$url;
		   // $foto=base64_encode_archivos_varios("C:/wamp/www/CreditoGuarani".$url,$extencion,"ARCHIVO");		 
		   $foto=base64_encode_archivos_varios("http://adaroinmobiliaria.com/creditoguarani".$url,$extencion,"ARCHIVO");		 
		     if($extencion=="pdf"){
		$img="./icono/pdf.png";
	}
	if($extencion=="docx" || $extencion=="doc"){
		$img="./icono/word.png";
	}
	if($extencion=="xlsx" || $extencion=="xltx" || $extencion=="xlsb"){
		$img="./icono/excel.png";
	}
          $cant=$cant+1;
	
	$pagina.="
	<tr id='".$cant."' name='cnt_adjuntos_archivos'  class='tr_archivo'>
				<td  class='td_titulo' style='width:10%;text-align:center;' >
				<div class='contenedor_archivo_preview' style='background-image: url(".$img.")' >
				</td>
				<td id='td_nombre' class='td_titulo' style='width: 75%;border-bottom: 1px solid #d6d3d3;' >".$nombres."</td>
				<td id='td_base64' class='td_titulo' style='width:0%;display:none;' >".$foto."</td>
				<td id='td_extencion' class='td_titulo' style='width:0%;display:none;' >".$extencion."</td>
				<td id='td_tamanho' class='td_titulo' style='width:10%;border-bottom: 1px solid #d6d3d3;' >".$tamanho."</td>
				<td class='td_titulo' style='width: 5%;border-bottom: 1px solid #d6d3d3;' ><button id='".$cant."' onclick='quitar_archivo_de_la_tabla(this)' type='button' style='cursor:pointer;' class='input_eliminar_archivo'><img src='./icono/delete.png' style='width:15px;height:15px;' /></button></td>
	</tr>
"; 


 }
 
 }
$informacion =array("1" => $pagina,"2" => $cant);
echo json_encode($informacion);	
exit;

}

function base64_encode_archivos_varios($filename=string,$filetype=string,$tipo) {
    if ($tipo=="ARCHIVO") {
    $path_archivo =$filename;
    $type_archivo = pathinfo($path_archivo, PATHINFO_EXTENSION);
    $data_archivo = file_get_contents($path_archivo);
    $base64_archivo = "data:application/" . $type_archivo . ";base64," . base64_encode($data_archivo);
    return $base64_archivo;
    
    }else if ($tipo=="IMAGEN") {
    $path_image =$filename;
    $type_image = pathinfo($path_image, PATHINFO_EXTENSION);
    $data_image = file_get_contents($path_image);
    $base64_image = "data:image/" . $type_image . ";base64," . base64_encode($data_image);
    return $base64_image;
    }
}

function buscar_detalles_fotos($cod) {
$mysqli=conectar_al_servidor();
$sql='';
 $pagina='';
 $pagina1='';
 $opcionespagina='';

$cant=0;
$totalcan=0;
$ancho="";
$sql= "SELECT url,solicitudescreditos_cod, extencion FROM fotospersonas where estado='ACTIVO' and solicitudescreditos_cod='$cod'"; 

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
		  $cod=utf8_encode($valor['solicitudescreditos_cod']); 
		  $url=utf8_encode($valor['url']); 
		  $extencion=utf8_encode($valor['extencion']); 

		  
			$totalcan=obtener_maximo_cantidad_imagen($cod);		
		
			$foto=".".$url;
		   // $foto=base64_encode_image($url,$extencion);		 
		     
          $cant=$cant+1;
	$ancho=$totalcan*115;
	$pagina.="
	<div class='mySlides fade'>
        <div class='numbertext'>".$cant."/".$totalcan."</div>
       <div style='background-image: url(".$foto.");
    background-repeat: no-repeat;
    background-size: contain;
	margin: auto;
    text-align: center;
    align-items: center;
    display: grid;
    color:transparent;
    background-position: center;
    height: 500px;background-color:#000;' ><a class='a_a' href='".$foto."' target='_blank'>VER GRANDE</a></div>
    </div>
"; 

$pagina1.="
	 <div style='width: 105px;
    height: 105px;
    color: transparent;
    font-size: 0px;
    display: inline-block;
    vertical-align: middle;
    background-size: cover;
    border-radius: 1px;
    margin: 2px 2px 2px 2px;
    position: inherit;'>
      <div class='demo cursor' style=' background-image: url(".$foto.");width: 105px;
    height: 105px;
    color: transparent;
    font-size: 0px;
    display: inline-block;
    vertical-align: middle;
    background-size: cover;
    border-radius: 1px;
    margin: 2px 2px 2px 2px;
    position: inherit;' onclick='currentSlide(".$cant.")'>dd</div>
    </div>
"; 
 }
 $opcionespagina="<div class='container1'>".$pagina."<a class='prev' onclick='plusSlides(-1)'>❮</a>
  <a class='next' onclick='plusSlides(1)'>❯</a></div><div style='width: 100%;
    height: 128px;
    position: inherit;
    overflow-x: auto;
    overflow-y: hidden;background-color: #000;'><div class='row' style='width:".$ancho."px;'>".$pagina1."</div></div>";
 }
$informacion =array("1" => $opcionespagina,"2" => $cant);
echo json_encode($informacion);	
exit;

}

function obtener_maximo_cantidad_imagen($cod){
	$mysqli=conectar_al_servidor();
	 $id='';
		$sql= "SELECT count(cod) as id FROM fotospersonas where estado='ACTIVO' and solicitudescreditos_cod='$cod'";
   if ($stmt = $mysqli->prepare($sql)) 
if ( ! $stmt->execute()) {
   echo "Error";
   exit;
}
 $result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 if ($valor>0){
	  while ($valor= mysqli_fetch_assoc($result)){
		 $id=$valor['id'];  
	  }
 }
 return $id;
}

function buscar_detalles_solicitudes($cod) {
$mysqli=conectar_al_servidor();
 $sql='';
 $cant=0;
 $cod1="";
 $nrosolicitud="";
 $fecha="";
 $clientes_cod="";
 $cedula1="";
 $nombres="";
 $apellidos="";
 $usuario="";
 $fechanac="";
 $calle="";
 $telefono="";
 $EstadosCivil="";
 $nacionalidad="";
 $barrios="";
 $localidad="";
 $departamentos="";
 $sucursal="";
 $montodisponible="";
 $obsvendedor="";
 $sucursales_cod="";
 $montosoli="";
  $obsretranferencia="";
  $actividadeconomica="";
  $gps="";
$sql= "SELECT s.cod,s.obsvendedor,s.vendedor_cod,s.actividadeconomica,s.obsanalista,s.obsretranferencia,pl.montodisponible,pl.condicion,pl.plazo,s.plazosolicitado,s.nrosolicitud,s.fecha,s.clientes_cod,p.lnglat,p.cedula,concat(p.primernombre,' ',p.segundonombre) as nombres,concat(p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as apellidos
,p.fechanac,p.direccion as calle,s.monto as montosoli,p.telefono,e.EstadosCivil,n.nacionalidad,b.barrios,ci.ciudades as localidad,d.departamentos,s.estadosolicitud,s.estado 
FROM solicitudescreditos s 
join personas p on s.clientes_cod=p.cod
join estadosciviles e on p.estadosciviles_cod=e.cod
join nacionalidad n on p.nacionalidad_cod=n.cod
join barrios b on p.barrios_cod=b.cod
join ciudades ci on b.ciudades_idciudades=ci.idciudades
join departamentos d on ci.departamentos_iddepartamentos=d.iddepartamentos 
join planprestamos pl on s.monto=pl.cod
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
		    $cod1=utf8_encode($valor['cod']);
			$nrosolicitud=utf8_encode($valor['nrosolicitud']);
			$obsanalista=($valor['obsanalista']);
			$vendedor_cod=utf8_encode(obtener_vendedor($cod1));
			$montosoli=utf8_encode($valor['montosoli']);
			$fecha=utf8_encode($valor['fecha']);
			$clientes_cod=utf8_encode($valor['clientes_cod']);
			$cedula1=utf8_encode($valor['cedula']);
			$nombres=($valor['nombres']);
			$apellidos=($valor['apellidos']);
			$usuario=obtener_usuarios($cod);	
			$fechanac=utf8_encode($valor['fechanac']);
			$calle=($valor['calle']);
			$telefono=utf8_encode($valor['telefono']);
			$EstadosCivil=($valor['EstadosCivil']);
			$nacionalidad=utf8_encode($valor['nacionalidad']);
			$barrios=($valor['barrios']);
			$localidad=($valor['localidad']); 
			$departamentos=($valor['departamentos']); 
			$sucursal=(obtener_sucursal_usuarios($cod)); 	   
			$sucursales_cod=utf8_encode(obtener_codsucursal_usuarios($cod));	   
			$montodisponible1=utf8_encode($valor['montodisponible']);
			$condicion=utf8_encode($valor['condicion']);
			$plazosolicitado=utf8_encode($valor['plazosolicitado']);
			$plazo=utf8_encode($valor['plazo']);
			$gps=utf8_encode($valor['lnglat']);
			
            $montodisponible=number_format($montodisponible1,'0',',','.');
	        $obsvendedor=($valor['obsvendedor']);			 
	        $obsretranferencia=($valor['obsretranferencia']);
	        $actividadeconomica=($valor['actividadeconomica']);
	$estadosolicitud=utf8_encode($valor['estadosolicitud']);
$cant=$cant+1;
 }
 }

$informacion1 =array("0" => $montodisponible1,"1" => $cod1,"2" => $nrosolicitud,"3" => $fecha,"4" => $clientes_cod,"5" => $cedula1,
"6" => $nombres,"7" => $apellidos,"8" => $usuario,"9" => $fechanac,"10" => $calle,"11" => $telefono,
"12" => $EstadosCivil,"13" => $nacionalidad,"14" => $barrios,"15" => $localidad,"16" => $departamentos,
"17" => $sucursal,"18" => $montodisponible,"19" => $obsvendedor,"20" => $sucursales_cod,"21" => $montosoli,
"22" => $obsretranferencia,"23" => $actividadeconomica,"24" => $vendedor_cod,"25" => $gps,"26" => $obsanalista,"27" => $estadosolicitud,"28" => $condicion,"29" => $plazosolicitado,"30" => $plazo);
echo json_encode($informacion1);	
exit;

}

 function obtener_vendedor($cod){
	$mysqli=conectar_al_servidor();
	 $analista='';
		$sql= "SELECT a.vendedor_cod as analista 
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
		 $analista=$valor['analista'];  
	  }
 }
 return $analista;
}

function buscar_detalles_referencias_laborales($cod) {
$mysqli=conectar_al_servidor();
$sql='';
$trabajoactual='';
$direccionta='';
$puestoqueocupa='';
$telefonopo='';
$antiguedadpo='';
$trabajoanterior='';
$telefonota='';
$antiguedadta='';
$trabajoantepenultimo='';
$telefonotante='';
$antiguedadante='';
$periododeinactividad='';
$infopositiva='';
$infonegativa='';
$cant=0;
$sql= "SELECT trabajoactual, direccionta, puestoqueocupa, telefonopo, antiguedadpo, trabajoanterior, 
telefonota, antiguedadta, trabajoantepenultimo, telefonotante, antiguedadante, periododeinactividad, 
infopositiva, infonegativa,estado FROM referenciaslaborales where estado='ACTIVO' and SolicitudesCreditos_cod='$cod'"; 

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
		    $trabajoactual=$valor['trabajoactual'];  
			$direccionta=($valor['direccionta']);
			$puestoqueocupa=($valor['puestoqueocupa']);
			$telefonopo=utf8_encode($valor['telefonopo']);
			$antiguedadpo=($valor['antiguedadpo']);
			$trabajoanterior=($valor['trabajoanterior']);
			$telefonota=utf8_encode($valor['telefonota']);
			$antiguedadta=($valor['antiguedadta']);
			$trabajoantepenultimo=($valor['trabajoantepenultimo']);
			$telefonotante=utf8_encode($valor['telefonotante']);
			$antiguedadante=($valor['antiguedadante']);
			$periododeinactividad=($valor['periododeinactividad']);
			$infopositiva=($valor['infopositiva']);
			$infonegativa=($valor['infonegativa']);	   
$cant=$cant+1;
 }
 }
$informacion1 =array("1" => $trabajoactual,"2" => $direccionta,"3" => $puestoqueocupa,"4" => $telefonopo,"5" => $antiguedadpo,
"6" => $trabajoanterior,"7" => $telefonota,"8" => $antiguedadta,"9" => $trabajoantepenultimo,"10" => $telefonotante,"11" => $antiguedadante,
"12" => $periododeinactividad,"13" => $infopositiva,"14" => $infonegativa);
echo json_encode($informacion1);	
exit;

}

function buscar_detalles_datos_del_negocio($cod) {
$mysqli=conectar_al_servidor();
$sql='';
$otroingreso='';
$direccion='';
$telefono='';
$funcionarioacargo='';
$cant=0;
$sql= "SELECT otroingreso, direccion, telefono, funcionarioacargo, estado FROM datosdelnegocio where estado='ACTIVO' and SolicitudesCreditos_cod='$cod'"; 

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
		    $otroingreso=$valor['otroingreso'];  
			$direccion=($valor['direccion']);
			$telefono=utf8_encode($valor['telefono']);
			$funcionarioacargo=utf8_encode($valor['funcionarioacargo']);
				   
$cant=$cant+1;
 }
 }
$informacion1 =array("1" => $otroingreso,"2" => $direccion,"3" => $telefono,"4" => $funcionarioacargo);
echo json_encode($informacion1);	
exit;

}
	
function buscar_detalles_referencias_personales($cod,$nro){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT vinculo,nombre,telefono FROM referenciaspersonales WHERE estado='ACTIVO' and SolicitudesCreditos_cod='$cod'"; 
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
		     
		      $vinculo=$valor['vinculo'];  
		  	  $nombre=utf8_encode($valor['nombre']);
			  $telefono=utf8_encode($valor['telefono']); 
	  	 $cant=$cant+1;
		  if($nro=="1"){
		 if($control=="d"){
		
			$titulo_pagina="<tr style='width:100%;' class='table_titulo'>
									<td class='td_detalles' style='width:5%;text-align:center;' >N°</td>
									<td class='td_detalles' style='width:31.6%;' >VINCULO</td>
									<td class='td_detalles' style='width:31.6%;' >NOMBRE</td>
									<td class='td_detalles' style='width:31.6%;' >TELEFONO</td>							
					 </tr> "; 
					
		 }else{
			$titulo_pagina=''; 
		 }
		  $control="x";
$pagina.=" ".$titulo_pagina."
<tr class='table_5' style='width:100%;'>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:31.6%;' id='td_vinculo'>".$vinculo."</td>
<td class='td_detalles' style='width:31.6%;' id='td_nombre'>".$nombre."</td>
<td class='td_detalles' style='width:31.6%;'   id='td_telefono'>".$telefono."</td>
</tr>
";
		  
  }
  if($nro=="2"){
	$pagina.="
	<tr id='".$cant."' name='trdetalles_referenciaspersonales' class='table_5'>
				<td id='td_vinculo' class='td_titulo' style='width: 31.66%;' >".$vinculo."</td>
				<td id='td_nombre' class='td_titulo' style='width: 31.66%;' >".$nombre."</td>
				<td id='td_telefono' class='td_titulo' style='width: 31.66%;' >".$telefono."</td>
				<td class='td_titulo' style='width: 5%;' ><button id='".$cant."'  onclick='quitar_referenciaspersonales_de_la_tabla(this)' type='button' class='input_eliminar'><img src='./icono/delete.png' style='width:15px;height:15px;' /></button></td>
	</tr>
";  
  }
  }
 }
$informacion =array("1" => $pagina,"2" => $cant+1);
echo json_encode($informacion);	
exit;
}

function buscar_detalles_ingresos($cod) {
$mysqli=conectar_al_servidor();
$sql='';
$diapoco='';
$diamas='';
$semanapoco='';
$semanamas='';
$mespoco='';
$mesmas='';
$salario='';
$quincenapoco='';
$quincenamas='';
$extras='';
$cant=0;
$sql= "SELECT salario,quincenapoco,quincenamas,extras,diapoco, diamas, semanapoco, semanamas, mespoco, mesmas, estado FROM ingresos WHERE estado='ACTIVO' and solicitudescreditos_cod='$cod'"; 

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
		    $diapoco1=$valor['diapoco'];  
			$diapoco=number_format($diapoco1,'0',',','.');			
			$diamas1=utf8_encode($valor['diamas']);
			$diamas=number_format($diamas1,'0',',','.');		
			$semanapoco1=utf8_encode($valor['semanapoco']);
			$semanapoco=number_format($semanapoco1,'0',',','.');	
			$semanamas1=utf8_encode($valor['semanamas']);
			$semanamas=number_format($semanamas1,'0',',','.');	
			$mespoco1=utf8_encode($valor['mespoco']);
			$mespoco=number_format($mespoco1,'0',',','.');
			$mesmas1=utf8_encode($valor['mesmas']);
			$mesmas=number_format($mesmas1,'0',',','.');
		    $salario1=utf8_encode($valor['salario']);
			$salario=number_format($salario1,'0',',','.');
			$quincenapoco1=utf8_encode($valor['quincenapoco']);
			$quincenapoco=number_format($quincenapoco1,'0',',','.');
			$quincenamas1=utf8_encode($valor['quincenamas']);
			$quincenamas=number_format($quincenamas1,'0',',','.');
			$extras1=utf8_encode($valor['extras']);
			$extras=number_format($extras1,'0',',','.');
$cant=$cant+1;
 }
 }
$informacion1 =array("1" => $diapoco,"2" => $diamas,"3" => $semanapoco,"4" => $semanamas,"5" => $mespoco,
"6" => $mesmas,"7" => $salario,"8" => $quincenapoco,"9" => $quincenamas,"10" => $extras);
echo json_encode($informacion1);	
exit;

}

function buscar_detalles_egresos($cod) {
$mysqli=conectar_al_servidor();
$sql='';
$cant=0;
$vivienda="";
$comercio="";
$banco="";
$cooperativa="";
$financiera="";
$electrodomesticos="";
$usureros="";
$cantidad_hijos="";
$sql= "SELECT vivienda, comercio, banco, cooperativa, financiera, electrodomesticos, usureros, cantidad_hijos, estado FROM egresos where estado='ACTIVO' and solicitudescreditos_cod='$cod'"; 

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
		    $vivienda1=$valor['vivienda'];  
			$vivienda=number_format($vivienda1,'0',',','.');			
			$comercio1=utf8_encode($valor['comercio']);
			 $comercio=number_format($comercio1,'0',',','.');		
			$banco1=utf8_encode($valor['banco']);
			 $banco=number_format($banco1,'0',',','.');	
			$cooperativa1=utf8_encode($valor['cooperativa']);
			$cooperativa=number_format($cooperativa1,'0',',','.');	
			$financiera1=utf8_encode($valor['financiera']);
			$financiera=number_format($financiera1,'0',',','.');
			$electrodomesticos1=utf8_encode($valor['electrodomesticos']);
			$electrodomesticos=number_format($electrodomesticos1,'0',',','.');
			$usureros1=utf8_encode($valor['usureros']);
			$usureros=number_format($usureros1,'0',',','.');
			$cantidad_hijos=utf8_encode($valor['cantidad_hijos']);
			 
$cant=$cant+1;
 }
 }
$informacion1 =array("1" => $vivienda,"2" => $comercio,"3" => $banco,"4" => $cooperativa,"5" => $financiera,
"6" => $electrodomesticos,"7" => $usureros,"8" => $cantidad_hijos);
echo json_encode($informacion1);	
exit;

}

function buscar_detalles_referencias_creditos_comerciales($cod,$nro){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT nambreentidad, cuota, plazo, saldo, obs, estado FROM referenciascreditoscomerciales where estado='ACTIVO' and SolicitudesCreditos_cod='$cod'"; 
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
		     
		      $nambreentidad=$valor['nambreentidad'];  
		  	  $cuota=utf8_encode($valor['cuota']);
			   $cuota1=number_format($cuota,'0',',','.');	
			  $plazo=utf8_encode($valor['plazo']); 
			    $plazo1=number_format($plazo,'0',',','.');	
			  $saldo=utf8_encode($valor['saldo']); 
			    $saldo1=number_format($saldo,'0',',','.');	
			  $obs=utf8_encode($valor['obs']); 
	  	 $cant=$cant+1;
		  if($nro=="1"){
		 if($control=="d"){
			$titulo_pagina="<tr style='width:100%;' class='table_titulo'>
									<td class='td_detalles' style='width:5%;text-align:center;' >N°</td>
									<td class='td_detalles' style='width:16.25%;' >ENTIDAD</td>
									<td class='td_detalles' style='width:16.25%;' >MONTO CUOTA</td>
									<td class='td_detalles' style='width:16.25%;' >PLAZO</td>							
									<td class='td_detalles' style='width:16.25%;' >SALDO</td>							
									<td class='td_detalles' style='width:30%;' >OBSERVACION</td>							
					 </tr> "; 
					
		 }else{
			$titulo_pagina=''; 
		 }
		  $control="x";
$pagina.=" ".$titulo_pagina."
<tr class='table_5' style='width:100%;'>
<td class='td_detalles' style='width:5%;background-color:#e3e2e2;color:red;text-align:center;' id='td_cant'>".$cant."</td>
<td class='td_detalles' style='width:16.25%;' >".$nambreentidad."</td>
<td class='td_detalles' style='width:16.25%;' >".$cuota1."</td>
<td class='td_detalles' style='width:16.25%;' >".$plazo1."</td>
<td class='td_detalles' style='width:16.25%;' >".$saldo1."</td>
<td class='td_detalles' style='width:30%;'    >".$obs."</td>
</tr>
";		  
  }
  if($nro=="2"){
  $pagina.="
<tr id='".$cant."' name='trdetalles_referenciascreditoscomerciales' class='table_5'>
				<td id='td_entidad' class='td_titulo' style='width: 32.5%;' >".$nambreentidad."</td>
				<td id='td_cuota' class='td_titulo' style='width: 10%;' >".$cuota1."</td>
				<td id='td_plazo1' class='td_titulo' style='width: 10%;' >".$plazo1."</td>
				<td id='td_saldo1' class='td_titulo' style='width: 10%;' >".$saldo1."</td>
				<td id='td_observaciones' class='td_titulo' style='width: 32.5%;' >".$obs."</td>
				<td class='td_titulo' style='width: 5%;' ><button id='".$cant."'  onclick='quitar_referenciascomerciales_de_la_tabla(this)' type='button' class='input_eliminar'><img src='./icono/delete.png' style='width:15px;height:15px;' /></button></td>
			</tr>
";		
  }
  }
 }
$informacion =array("1" => $pagina,"2" => $cant+1);
echo json_encode($informacion);	
exit;
}

function obtener_usuarios($cod){
	$mysqli=conectar_al_servidor();
	 $nombres='';
		$sql= "SELECT concat(p.primernombre,' ',p.segundonombre,' ',p.primerapellido,' ',p.segundoapellido,' ',p.apellidocasada) as nombres 
FROM solicitudescreditos s
join usuarios u on s.usuarios_cod=u.cod
join personas p on u.personas_cod=p.cod
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
		 $nombres=$valor['nombres'];  
	  }
 }
 return $nombres;
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
		 $sucursal=$valor['sucursal'];  
	  }
 }
 return $sucursal;
}

function obtener_codsucursal_usuarios($cod){
	$mysqli=conectar_al_servidor();
	 $sucursal='';
		$sql= "SELECT su.cod as sucursal 
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
		 $sucursal=$valor['sucursal'];  
	  }
 }
 return $sucursal;
}

verificar_datos();
?>