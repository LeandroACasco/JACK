<?php
require("conexion.php");

function verificar_datos(){
	    $func = $_POST['func'];
		$func = utf8_decode($func );
		if($func=='eliminar_datos_pago_express'){	
			eliminar_datos_pago_express();
		}
		
		if($func=='paginacion'){	
			paginacion();
		}
		
         if($func=='buscar_historial_pago_express'){
			 
			$buscar = $_POST['buscar'];
			$buscar = utf8_decode($buscar);
			
			$limit1 = $_POST['limit1'];
			$limit1 = utf8_decode($limit1);
			
			$limit2 = $_POST['limit2'];
			$limit2 = utf8_decode($limit2);

			$pag = $_POST['pag'];
			$pag = utf8_decode($pag);

			$limite = $_POST['limite'];
			$limite = utf8_decode($limite);
			
			buscar_historial_pago_express($buscar,$pag,$limite,$limit1,$limit2);	
		}
		}	
		
function eliminar_datos_pago_express(){
    $mysqli=conectar_al_servidor();
  $sql="DELETE FROM pagoexpress WHERE cod > 0";
  $stmt = $mysqli->prepare($sql);
echo $mysqli -> error;  
  if ( ! $stmt->execute()) {
  echo trigger_error('The query execution failed; MySQL said ('.$stmt1->errno.') '.$stmt1->error, E_USER_ERROR);
   exit;
   }
		echo"exito";
}

function buscar_historial_pago_express($buscar,$pag,$limite,$limit1,$limit2){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $pagina1='';
	 $titulo_pagina="";
$control_datos="d";
	 $cantidad=0;
	 $cant=0;
	 $cantnum=0;
	 $control="d";
if($buscar!=""){
 $sql= "SELECT factura,cedula,cliente,cuota,fecha,monto,cod FROM pagoexpress where concat(cedula,' ',cliente) like ? order by factura,cuota asc limit ".intVal($limit2)." "; 
}else{
 $sql= "SELECT factura,cedula,cliente,cuota,fecha,monto,cod FROM pagoexpress where concat(cedula,' ',cliente) like ? order by factura,cuota asc limit ".intVal($limit1).",".intVal($limit2)."  "; 
}
	
   $stmt = $mysqli->prepare($sql);
  
  $s='s';
$buscar="%".$buscar."%";
$stmt->bind_param($s,$buscar);
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
		  	  $factura=utf8_encode($valor['factura']);
			  $cedula=utf8_encode($valor['cedula']);
			  $cuota=utf8_encode($valor['cuota']);
			  $cliente=utf8_encode($valor['cliente']);
			  $fecha=utf8_encode($valor['fecha']); 
			  $monto=utf8_encode($valor['monto']);
              $monto=number_format(intVal($monto),'0',',','.'); 			  
			  $cantidad=utf8_encode(total_datos_pago_express($buscar));
               if($cantidad<=$limite){
                 $cantnum=1;
              }else{
                $cantnum=$cantidad/$limite;
              }
             
	  	 $cant=$cant+1;
		  if ($cant%2==0){
          $bacground="class='table_gris'";
        }else{
          $bacground="class='table_blanco'";
        }

 if($control_datos=="d"){
			$titulo_pagina="
                                <tr>
									<td class='td_titulo' style='width: 10%;'>Comprobante</td>
									<td class='td_titulo' style='width: 10%;'>Referencia</td>
									<td class='td_titulo' style='width: 5%;'>Cuota</td>
									<td class='td_titulo'style='width: 55%;'>Descripción</td>
									<td class='td_titulo' style='width: 10%;'>Fecha Vencimiento</td>
									<td class='td_titulo' style='width: 10%;'>Importe</td>
								</tr>
"; 		
		 }else{
			$titulo_pagina=''; 
		 }
		  $control_datos="x";

$pagina.=" ".$titulo_pagina."
<tr  ".$bacground." >
<td class='td_detalles' style='width:10%;' id='td_factura'>".$factura."</td>
<td class='td_detalles' style='width:10%;' id='td_cedula'>".$cedula."</td>
<td class='td_detalles' style='width:5%;' id='td_cuota'>".$cuota."</td>
<td class='td_detalles' style='width:55%;text-align:left;' id='td_cliente'>".$cliente."</td>
<td class='td_detalles' style='width:10%;' id='td_fecha'>".$fecha."</td>
<td class='td_detalles' style='width:10%;text-align:right;padding: 0px 10px 0px 0px;' id='td_monto'>".$monto."</td>
</tr>
";		  
   }


 }
  
 $pagina1="<div style='overflow-x: hidden;overflow-y:auto;height:100%;width:100%;' class='contenedor_tabla'><div style='background: var(--color_emergente_cabezera);width:100%;'>Página ".$pag." de ".Round($cantnum)." </div>
 <table  border='1' class='table_5' cellspacing='0'cellpadding='0'>
                            ".$pagina."   
                            </table>".paginar($cantidad,$limite,$pag)."</div>
 ";
$informacion =array("1" => $pagina1,"2" => $cantidad);
echo json_encode($informacion);	
exit;
}

function paginar($cantidad,$limitador,$pag){
	$paginacion="";
	$paginar="";
	$bacground="";
	
	$controllimitador=0;
	$tot=0;
	$del=0;
if ($cantidad > 1) {
     $totalpagina=$cantidad/$limitador;
    $del=Round($totalpagina);
    if($cantidad>($del*$limitador)){
     if(is_int($totalpagina)){
       $totalpagina=$totalpagina;
     }else{
     $totalpagina=$totalpagina+1;
     }
    }
$tot=Round($totalpagina);
     if ($tot != 1) {
        for ($i=1;$i<=$tot;$i++) {
           
            if ($pag==$i){
          $bacground="class='page-link active'";
        }else{
          $bacground="class='page-link'";
        }
           $onclick1='buscar_historial_pago_express("'.$i.'","'.$controllimitador.'","'.$limitador.'")';
           $paginacion.="<li class='page-item'><a ".$bacground." onclick='".$onclick1."'>".$i."</a></li>";
		   $controllimitador=$controllimitador+$limitador;
        }
       $paginar="<center><div style='width:100%;
    overflow-x: auto;
    overflow-y: hidden;
    background: var(--color_emergente_cabezera);
    height: 100%;'><nav><ul class='pagination' >".$paginacion."</ul></nav><div></center>	";
     }
}
  return $paginar;  
}	

function total_datos_pago_express($buscar){
	$mysqli=conectar_al_servidor();
	 $pagina='';
	 $pagina1='';
	 $titulo_pagina="";
	 $cant=0;
	 $control="d";
	 $sql= "SELECT count(cod) as cantidad FROM pagoexpress where concat(cedula,' ',cliente) like ?"; 
   $stmt = $mysqli->prepare($sql);
$s='s';
$buscar="%".$buscar."%";
$stmt->bind_param($s,$buscar);
if ( ! $stmt->execute()) {
   echo "Error3";
   exit;
}
	$result = $stmt->get_result();
 $valor= mysqli_num_rows($result);
 
 if ($valor>0)
 {
	  while ($valor= mysqli_fetch_assoc($result)) {	     
		      $pagina=utf8_encode($valor['cantidad']);  
   }
 }
 
return $pagina;
}


verificar_datos();

?>