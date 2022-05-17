
function validar_eliminar_datos_pago_express(){
	var datos=document.getElementById("inp_cant_historial_pago_express").value;
	if(datos=="0" || datos==""){
		ver_cerrar_ventana_cargando("2","NO EXISTEN DATOS PARA ELIMINAR");
		return false;
	}else{
		ver_vetana_eliminar('¿Deseas Eliminar todos los datos de Pago Express?',id_progreso,'33');
	}
	
}

/*BUSCAR LOTE EN COMBO*/
function buscar_lote_combo(){
	var datos = new FormData();
	var fecha=document.getElementById("inp_fecha_planilla_caja").value
	datos.append("func" , "buscar_combo_lote")
	datos.append("fecha" , fecha)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmCierreCaja.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_lote_planilla').innerHTML = datos[2]
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function buscar_cantidad_pago_express() {

	var datos = {
		
		"func": "buscar_cantidad_pago_express"
	};
	$.ajax({
		data: datos, url: "./php/eliminar_datos_pago_express.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					
			document.getElementById("inp_cant_historial_pago_express").value = datos["1"];
	             var limit1=0;
	             var control=0;
	           
				 var totaldatos=parseInt(datos["1"]);
				 var resultdatos=totaldatos/500;
				 
            for(var c = 0; c < resultdatos; c++){
                control=control+1;
				  limit1=limit1+500;
               buscar_historial_pago_express(limit1,totaldatos);
              		   
			}
			
			
				} catch (error) {
				}

			}
		}
	});
}

function buscar_historial_pago_express(pagina,limit1,limit2) {
document.getElementById("cnt_historial_datos_txt").innerHTML ="";
    ver_cerrar_ventana_cargando("1");
	var buscar = document.getElementById('inpt_buscador_historial_pago_express').value
	var limite = document.getElementById('inpt_limite_historial_pago_express').value
	var datos = {
		"buscar": buscar,
		"limit1": limit1,
		"limit2": limite,
		"limite": limite,
		"pag": pagina,
		"func": "buscar_historial_pago_express"
	};
	$.ajax({
		data: datos, url: "./php/eliminar_datos_pago_express.php", type: "post", beforeSend: function () {
		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;	
	        document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';
			document.getElementById("cnt_historial_datos_txt").innerHTML = datos_buscados	
            document.getElementById("inp_cant_historial_pago_express").value = datos["2"];			
				} catch (error) {
				}
			}
		}
	});
}

function eliminar_datos_pago_express_1(){
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func", "eliminar_datos_pago_express")

	var OpAjax = $.ajax({
		data: datos,
		url: "./php/eliminar_datos_pago_express.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");	
				return false;
			}
			if (Respuesta == "exito") {
			ver_cerrar_ventana_cargando("2","DATOS ELIMINADOS CORRECTAMENTE")
            document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';
          buscar_historial_pago_express("1","0","");
           
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
			}
		}
	});


}

//anular compras
var porcentaje_txtd=0;
function eliminar_datos_pago_express(){

	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func", "eliminar_datos_pago_express")

	var OpAjax = $.ajax({
		data: datos,
		url: "./php/eliminar_datos_pago_express.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");	
				return false;
			}
			if (Respuesta == "exito") {
				var control=0;
            for(var c = 0; c < contador_datos_express; c++){
				control=control+1;
                actualizar_datos_pago_express(control);
                porcentaje_txtd=Math.round(c*100/contador_datos_express);
      
              ver_cerrar_ventana_cargando("1");
			}
           
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
			}
		}
	});


}

function actualizar_datos_pago_express(contador) {
   
    var datos = new FormData();
	var control=1;
	
	$("tr[name=trdetalles_datos_txt_"+contador+"]").each(function(i, elementohtml){
	
	var factura=$(elementohtml).children('td[id="td_comprobante_txt"]').html();
    datos.append("factura"+control, factura)
	
	var cedula=$(elementohtml).children('td[id="td_referencia_txt"]').html();
    datos.append("cedula"+control, cedula)
	
	var cuota=$(elementohtml).children('td[id="td_cuota_txt"]').html();
    datos.append("cuota"+control, cuota)
	
	var cliente=$(elementohtml).children('td[id="td_descripcion_txt"]').html();
    datos.append("cliente"+control, cliente)
	
	var fecha=$(elementohtml).children('td[id="td_vencimeinto_txt"]').html();
    datos.append("fecha"+control, fecha)

    var monto=$(elementohtml).children('td[id="td_monto_txt"]').html();
    datos.append("monto"+control, monto.replace(/\./g,''))
   
	control=control+1;
	});
	control=control-1;
	datos.append("totalRegistro", control)

ver_cerrar_ventana_cargando("1","CARGANDO...");
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/actualizar_datos_pago_express.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			verCerrarEfectoCargando("")
			ver_cerrar_ventana_cargando("2","ERROR DE CONECCIÓN")
			return false;
		},
		success: function (responseText) {
			verCerrarEfectoCargando("")
			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					if(contador_datos_express==contador){
			ver_cerrar_ventana_cargando("2","DATOS PAGO EXPRESS ACTUALIZADOS CORRECTAMENTE")

            document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';
            document.getElementById('cnt_datos_txt').innerHTML="";
           buscar_historial_pago_express("1","0","");
		   document.getElementById('btn_actualizar_datos_pago_express').style.display='none'
		   document.getElementById('file_txt').value=''
		   ;
				}
				}
				else {
					ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
				}
			} catch (error) {
				ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
			}
		}
	});
}

/*BUSCAR CONCEPTOS EN COMBO*/
function buscar_conceptos_combo(){
	var datos = new FormData();
	datos.append("func" , "buscar_combo_concepto")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmconceptos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_concepto_auditoriaingreso_egreso').innerHTML = datos[2]
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

//BUSCAR AUDITORIA DE EGRESO INGRESO
function buscar_auditoria_de_ingreso_egreso() {
    ver_cerrar_ventana_cargando("1");
	var caja_cod = document.getElementById('inp_caja_auditoriaingreso_egreso').value
	var desde = document.getElementById('inp_desde_auditoriaingreso_egreso').value
	var hasta = document.getElementById('inp_hasta_auditoriaingreso_egreso').value
	var codconcepto = document.getElementById('inp_concepto_auditoriaingreso_egreso').value
	var resumen = document.getElementById('inp_resumen_ingreso_egreso').value
	document.getElementById("cnt_listado_auditoriadeingreso_egreso").innerHTML = ""
	var datos = {
		
		"caja_cod": caja_cod,
		"desde": desde,
		"hasta": hasta,
		"resumen": resumen,
		"codconcepto": codconcepto,
		"func": "buscar_auditoria_de_ingresos_egresos"
	};
	$.ajax({
		data: datos, url: "./php/abmAuditorias.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_auditoriadeingreso_egreso").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_auditoriadeingreso_egreso").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					 document.getElementById("cnt_listado_auditoriadeingreso_egreso").innerHTML = datos_buscados
		
			document.getElementById("inp_general_auditoriadeingreso_egreso").value = datos["2"]
			document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';  
				   
					
				} catch (error) {

				}

			}
		}
	});
}

//BUSCAR AUDITORIA DE DESEMBOLSOS
function buscar_auditoria_de_desembolsos() {
ver_cerrar_ventana_cargando("1");
	var caja_cod = document.getElementById('inp_caja_auditoriadesembolsos').value
	var desde = document.getElementById('inp_desde_auditoriadesembolsos').value
	var hasta = document.getElementById('inp_hasta_auditoriadesembolsos').value

	document.getElementById("cnt_listado_auditoriadedesembolsos").innerHTML = ""
	var datos = {
		
		"caja_cod": caja_cod,
		"desde": desde,
		"hasta": hasta,
		"func": "buscar_auditoria_de_desembolsos"
	};
	$.ajax({
		data: datos, url: "./php/abmAuditorias.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_auditoriadedesembolsos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_auditoriadedesembolsos").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					 document.getElementById("cnt_listado_auditoriadedesembolsos").innerHTML = datos_buscados
		
			document.getElementById("inp_general_auditoriadedesembolsos").value = datos["2"]
			document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';  
				   
					
				} catch (error) {

				}

			}
		}
	});
}

//BUSCAR AUDITORIA DE PAGOS
function buscar_auditoria_de_cobranzas() {
ver_cerrar_ventana_cargando("1");
	var caja_cod = document.getElementById('inp_caja_auditoriacobranzas').value
	var usocontable = document.getElementById('inp_usocontrable_auditoriacobranzas').value
	var usuarios_cod = document.getElementById('inp_usuarios_auditoriacobranzas').value
	var cobrador_cod = document.getElementById('inp_cobrador_auditoriacobranzas').value
	var desde = document.getElementById('inp_desde_auditoriacobranzas').value
	var hasta = document.getElementById('inp_hasta_auditoriacobranzas').value

	document.getElementById("cnt_listado_auditoriadecobranzas").innerHTML = ""
	var datos = {
		
		"caja_cod": caja_cod,
		"desde": desde,
		"hasta": hasta,
		"usuarios_cod": usuarios_cod,
		"cobrador_cod": cobrador_cod,
		"usocontable": usocontable,
		"func": "buscar_auditoria_de_cobranzas"
	};
	$.ajax({
		data: datos, url: "./php/abmAuditorias.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_auditoriadecobranzas").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_auditoriadecobranzas").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					 document.getElementById("cnt_listado_auditoriadecobranzas").innerHTML = datos_buscados
		
			
			document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';  
				   
					
				} catch (error) {

				}

			}
		}
	});
}//BUSCAR AUDITORIA DE PAGOS
function buscar_auditoria_de_pagos_proveedores() {
ver_cerrar_ventana_cargando("1");
	var caja_cod = document.getElementById('inp_caja_auditoriapagos').value
	var desde = document.getElementById('inp_desde_auditoriapagos').value
	var hasta = document.getElementById('inp_hasta_auditoriapagos').value
	document.getElementById("cnt_listado_auditoriadepagos").innerHTML = ""
	var datos = {
		
		"caja_cod": caja_cod,
		"desde": desde,
		"hasta": hasta,
		"func": "buscar_auditoria_de_pagos_proveedores_creditos"
	};
	$.ajax({
		data: datos, url: "./php/abmAuditorias.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_auditoriadepagos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_auditoriadepagos").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					 document.getElementById("cnt_listado_auditoriadepagos").innerHTML = datos_buscados
		
			document.getElementById("inp_general_auditoriadepagos").value = datos["2"]
			document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';  
				   
					
				} catch (error) {

				}

			}
		}
	});
}
//busccar datos cobradores
function buscar_datos_cobradores_auditoria(){
	var datos = new FormData();
	datos.append("func" , "buscar_combo_cobrador_auditoria")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmUsuarios.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
				  document.getElementById('inp_cobrador_auditoriacobranzas').innerHTML = datos[2]
				}
				else {
				  ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				  ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}
//busccar datos USUARIOS
function buscar_datos_usuarios_auditoria(){
	var datos = new FormData();
	datos.append("func" , "buscar_combo_usuarios_auditoria")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmUsuarios.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
				  document.getElementById('inp_usuarios_auditoriacobranzas').innerHTML = datos[2]
				}
				else {
				  ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				  ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

//BUSCAR AUDITORIA DE OTROS EGRESOS
function buscar_auditoria_de_otros_egresos() {
ver_cerrar_ventana_cargando("1");
	var caja_cod = document.getElementById('inp_caja_auditoriaotrosegresos').value
	var desde = document.getElementById('inp_desde_auditoriaotrosegresos').value
	var hasta = document.getElementById('inp_hasta_auditoriaotrosegresos').value

	document.getElementById("cnt_listado_auditoriadeotrosegresos").innerHTML = ""
	var datos = {
		
		"caja_cod": caja_cod,
		"desde": desde,
		"hasta": hasta,
		"func": "buscar_auditoria_de_otros_egresos"
	};
	$.ajax({
		data: datos, url: "./php/abmAuditorias.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_auditoriadeotrosegresos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_auditoriadeotrosegresos").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					 document.getElementById("cnt_listado_auditoriadeotrosegresos").innerHTML = datos_buscados
		
			document.getElementById("inp_general_auditoriadeotrosegresos").value = datos["2"]
			document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';  
				   
					
				} catch (error) {

				}

			}
		}
	});
}

//BUSCAR AUDITORIA DE OTROS INGRESOS
function buscar_auditoria_de_otros_ingresos() {
ver_cerrar_ventana_cargando("1");
	var caja_cod = document.getElementById('inp_caja_auditoriaotrosingresos').value
	var desde = document.getElementById('inp_desde_auditoriaotrosingresos').value
	var hasta = document.getElementById('inp_hasta_auditoriaotrosingresos').value

	document.getElementById("cnt_listado_auditoriadeotrosingresos").innerHTML = ""
	var datos = {
		
		"caja_cod": caja_cod,
		"desde": desde,
		"hasta": hasta,
		"func": "buscar_auditoria_de_otros_ingresos"
	};
	$.ajax({
		data: datos, url: "./php/abmAuditorias.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_auditoriadeotrosingresos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_auditoriadeotrosingresos").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					 document.getElementById("cnt_listado_auditoriadeotrosingresos").innerHTML = datos_buscados
		
			document.getElementById("inp_general_auditoriadeotrosingresos").value = datos["2"]
			document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';  
				   
					
				} catch (error) {

				}

			}
		}
	});
}

//BUSCAR AUDITORIA DE COMPRAS
function buscar_auditoria_de_compras() {
ver_cerrar_ventana_cargando("1");
	var proveedores_cod = document.getElementById('inp_proveedor_auditoriacompras').value
	var desde = document.getElementById('inp_desde_auditoriacompras').value
	var hasta = document.getElementById('inp_hasta_auditoriacompras').value
	var usocontable = document.getElementById('inp_usocontrable_auditoriacompras').value
	document.getElementById("cnt_listado_auditoriadecompras").innerHTML = ""
	var datos = {
		
		"proveedores_cod": proveedores_cod,
		"desde": desde,
		"hasta": hasta,
		"usocontable": usocontable,
		"func": "buscar_auditoria_de_compras"
	};
	$.ajax({
		data: datos, url: "./php/abmAuditorias.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_auditoriadecompras").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_auditoriadecompras").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   if(datos["0"]=="exito"){
					 document.getElementById("cnt_listado_auditoriadecompras").innerHTML = datos_buscados
					document.getElementById("inp_credito_auditoriadecompras").value = datos["2"]
					document.getElementById("inp_contado_auditoriadecompras").value = datos["3"]
					document.getElementById("inp_general_auditoriadecompras").value = datos["4"]
buscar_auditoria_de_compras_detalles();
			document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';  
				   }
					
				} catch (error) {

				}

			}
		}
	});
}
//BUSCAR AUDITORIA DE COMPRAS
function buscar_auditoria_de_compras_detalles() {
ver_cerrar_ventana_cargando("1");
	var proveedores_cod = document.getElementById('inp_proveedor_auditoriacompras').value
	var desde = document.getElementById('inp_desde_auditoriacompras').value
	var hasta = document.getElementById('inp_hasta_auditoriacompras').value
	var usocontable = document.getElementById('inp_usocontrable_auditoriacompras').value
	document.getElementById("cnt_listado_auditoriadecompras_detalles").innerHTML = ""
	var datos = {
		
		"proveedores_cod": proveedores_cod,
		"desde": desde,
		"hasta": hasta,
		"usocontable": usocontable,
		"func": "buscar_auditoria_de_compras_detalles"
	};
	$.ajax({
		data: datos, url: "./php/abmAuditorias.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_auditoriadecompras_detalles").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_auditoriadecompras_detalles").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   if(datos["0"]=="exito"){
					 document.getElementById("cnt_listado_auditoriadecompras_detalles").innerHTML = datos_buscados
					
			document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';  
				   }
					
				} catch (error) {

				}

			}
		}
	});
}

/*BUSCAR PROVEEDORES EN COMBO*/
function buscar_caja_combo(){
	var datos = new FormData();
	datos.append("func" , "buscar_combo_caja")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmDatosCaja.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_caja_auditoriaotrosingresos').innerHTML = datos[2]
					document.getElementById('inp_caja_auditoriaotrosegresos').innerHTML = datos[2]
					document.getElementById('inp_caja_auditoriadesembolsos').innerHTML = datos[2]
					document.getElementById('inp_caja_auditoriapagos').innerHTML = datos[2]
					document.getElementById('inp_caja_auditoriacobranzas').innerHTML = datos[2]
					document.getElementById('inp_caja_auditoriaingreso_egreso').innerHTML = datos[2]
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

/*BUSCAR PROVEEDORES EN COMBO*/
function buscar_proveedores_combo(){
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmProveedores.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_proveedor_auditoriacompras').innerHTML = datos[2]
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

/*AÑADIR CIERRE CAJA*/
function cerrar_caja(datos) {
	
	ver_cerrar_ventana_cargando("1");
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var horacierre = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var caja_cod = document.getElementById('usuario_idcaja').innerHTML;
	var montocierre = document.getElementById('inp_total_saldo_cierrecaja').value
	var control=document.getElementById("lbltotalcierrecaja").innerHTML;
	ver_cerrar_ventana_cargando("1","Cargando...");
	var datos = new FormData();
	datos.append("func", "cerrar_caja")
	datos.append("horacierre", horacierre)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("caja_cod", caja_cod)
	datos.append("montocierre", montocierre.toString().replace(/\./g,''))
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmCierreCaja.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {
			Respuesta = responseText;
			////console.log(Respuesta);
			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {
                ver_cerrar_ventana_cargando("2","CAJA CERRADA CORRECTAMENTE");
				buscar_caja_actual();
                abrir_cerrar_ventanas_cierrecaja("2"); 
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				
			
				
			}
		}
	});


}

//buscar caja actual
function buscar_caja_actual() {
	var caja_cod = document.getElementById('usuario_idcaja').innerHTML
	document.getElementById("cnt_listado_cierrecaja").innerHTML = ""
	var datos = {
		
		"caja_cod": caja_cod,
		"func": "buscar_caja_actual"
	};
	$.ajax({
		data: datos, url: "./php/abmCierreCaja.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_cierrecaja").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_cierrecaja").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_cierrecaja").innerHTML = datos_buscados
					document.getElementById("inp_saldoanterior_cierrecaja").value = datos["2"]
					document.getElementById("inp_total_ingreso_cierrecaja").value = datos["3"]
					document.getElementById("inp_total_egreso_cierrecaja").value = datos["4"]
					document.getElementById("inp_total_saldo_cierrecaja").value = datos["5"]
					document.getElementById("lbltotalcierrecaja").innerHTML = datos["6"]
		            if(datos["2"]=="0"){
						obtener_montoapertura();
					}
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_montoapertura() {
	var caja_cod = document.getElementById('usuario_idcaja').innerHTML
	
	var datos = {
		
		"caja_cod": caja_cod,
		"func": "obtener_montoapertura"
	};
	$.ajax({
		data: datos, url: "./php/abmCierreCaja.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("inp_saldoanterior_cierrecaja").value = datos["1"];
                    var ingreso=document.getElementById("inp_total_ingreso_cierrecaja").value;
                    var egreso=document.getElementById("inp_total_egreso_cierrecaja").value;
                    var saldoactual=parseInt(datos["1"].toString().replace(/\./g,''))+(parseInt(ingreso)-parseInt(egreso));
                    document.getElementById("inp_total_saldo_cierrecaja").value =format_con_puntos_decimales(saldoactual);
				} catch (error) {

				}

			}
		}
	});
}


//buscar 
function obtener_ultimo_cierre_de_caja() {
		var caja_cod = document.getElementById('combo_nrocaja_datoscaja').value;
		
	var datos = {
		"caja_cod": caja_cod,
		"func": "obtener_monto_anterior_en_caja"
	};
	$.ajax({
		data: datos, url: "./php/abmAperturaCaja.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
				
					document.getElementById("inp_montoapertura_ac").value = datos["2"]
		
					
				} catch (error) {

				}

			}
		}
	});
}

//buscar 
function buscar_planilla_caja() {
	var fecha = document.getElementById('inp_fecha_planilla_caja').value
	var resumen = document.getElementById('inp_resumen_planilla').value
	var caja_cod = document.getElementById('inp_cajanro_planilla').value
	var lote = document.getElementById('inp_lote_planilla').value

	document.getElementById("cnt_listado_planilascaja").innerHTML = ""
	var datos = {
		"fecha": fecha,
		"resumen": resumen,
		"caja_cod": caja_cod,
		"lote": lote,
		"func": "buscar_planilla_caja"
	};
	$.ajax({
		data: datos, url: "./php/abmplanillacaja.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_planilascaja").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_planilascaja").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_planilascaja").innerHTML = datos_buscados
					document.getElementById("inp_saldoanterior_planillacaja").value = datos["2"]
					document.getElementById("inp_total_ingreso_planillacaja").value = datos["3"]
					document.getElementById("inp_total_egreso_planillacaja").value = datos["4"]
					document.getElementById("inp_total_saldo_planillacaja").value = datos["5"]
		
					
				} catch (error) {

				}

			}
		}
	});
}

//anular compras
function anular_compras_insumos(nrocomprobanted){
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func", "anular_compras_insumos")
	datos.append("codcompras", nrocomprobanted.toString())
	datos.append("clavepermisoanulacion", id_clave_permiso)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmComprasInsumos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");	
				return false;
			}
			if (Respuesta == "exito") {
             buscar_datos_historial_compras_a_proveedores();
            document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
			}
		}
	});


}

//buscar_detalles_historial_detallescompras_insumos
function buscar_detalles_historial_detallescompras_insumos(codcompras) {
	document.getElementById("cnt_listado_detalles_historial_detalles_compras_proveedor").innerHTML = ""
	var datos = {
		"codcompras": codcompras,
		"func": "buscar_detalles_historial_detallescompras_insumos"
	};
	$.ajax({
		data: datos, url: "./php/abmComprasInsumos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_detalles_historial_detalles_compras_proveedor").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_detalles_historial_detalles_compras_proveedor").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
				
					var datos_buscados = Respuesta;
					document.getElementById("cnt_listado_detalles_historial_detalles_compras_proveedor").innerHTML = datos["1"]
					document.getElementById("inp_dccant").value=datos["2"];
					document.getElementById("inp_dctotalcompra_c").value=datos["3"];
					document.getElementById("inp_sucursal_dchcompras").value=datos["4"];
					document.getElementById("inp_cajero_dchcompras").value=datos["5"];

					document.getElementById("inp_fecha_dchcompras").value=datos["6"];
					document.getElementById("inp_hora_dchcompras").value=datos["7"];
					
				
				} catch (error) {
				}
			}
		}
	});
}

/*CARGAR COMPRA PROVEEDORES*/
function add_datos_cobros_contados_compras_proveedores() {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var compras_cod = document.getElementById('inp_codcompras_pccobros_proveedores').value;
	var montopagado1 = document.getElementById('inp_totalapagar_pccobros_proveedores').value
	var montopagado=montopagado1.toString().replace(/\./g,'');
	if(montopagado<=0){
		ver_cerrar_ventana_cargando("2","NO HAY MONTO QUE PAGAR");
		return false;
	}
	var fechapago = document.getElementById('inp_fecha_pccobros_proveedores').value
	var caja_cod = document.getElementById('usuario_idcaja').innerHTML;
	var nrofactura = document.getElementById('inp_nrofactura_pccobros_proveedores').value
	var sucursales_cod = document.getElementById('usuario_idsucursal').innerHTML;
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
    var accion="guardar";
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func", "cargarpagos")
	datos.append("hora", hora)
	datos.append("compras_cod", compras_cod)
	datos.append("montopagado", montopagado)
	datos.append("fechapago", fechapago)
	datos.append("caja_cod", caja_cod)
	datos.append("nrofactura", nrofactura)
	datos.append("sucursales_cod", sucursales_cod)
	datos.append("usuarios_cod", usuarios_cod)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmComprasInsumos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");	
				return false;
			}
			if (Respuesta == "exito") {
		    
			ver_cerrar_ventana_cargando("2","PAGO REGISTRADO CORRECTAMENTE");
			abrir_cerrar_ventanas_pagoscuotasproveedores("2");
			var compras_cod=document.getElementById('inp_codcompras_pccobros_proveedores').value
			buscar_compras_contados_pagos_a_proveedores(compras_cod);
		//abrir_cerrar_ventanas_pagoscontadosproveedores("2");("2");
          
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
			}
		}
	});


}

//busccar datos pagos contados compras insumos
function buscar_compras_contados_pagos_a_proveedores(codcompras) {
	document.getElementById("cnt_listado_pagoscontadosproveedores").innerHTML = ""
	var datos = {
		"codcompras": codcompras,
		"func": "buscar_compras_contados_a_pagar_proveedores"
	};
	$.ajax({
		data: datos, url: "./php/abmComprasInsumos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_creditos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_pagoscontadosproveedores").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
				
					var datos_buscados = Respuesta;
					document.getElementById("cnt_listado_pagoscontadosproveedores").innerHTML = datos["2"]
					document.getElementById("inp_totalapagar_pccobros_proveedores").value=datos["4"];
					document.getElementById("inp_total_pagado_pccobros_proveedores").value=datos["5"];
					document.getElementById("inp_nrofactura_pccobros_proveedores").value=datos["6"];
					document.getElementById("inp_ruc_pccobros_proveedores").value=datos["7"];

					document.getElementById("inp_clientes_nombres_pccobros_proveedores").value=datos["8"];
					document.getElementById("inp_codcompras_pccobros_proveedores").value=datos["9"];
					
				
				} catch (error) {
				}
			}
		}
	});
}

function cargar_interes_pagos_proveedores(cod){
	var interes1=document.getElementById('inp_interes_'+cod+'').value;
	var interes=interes1.toString().replace(/\./g,'');
	var datos = new FormData();
	datos.append("func" , "cargar_interes_a_cuotero")
	datos.append("cod" ,cod)
	datos.append("interes" ,interes)

	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmComprasInsumos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
		if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");	
				return false;
			}
		if (Respuesta == "exito") {
			buscar_pagos_cuotas_del_proveedor();
		}
		}
	});
}

function add_datos_compras_credito(){
	                  var total=document.getElementById('inp_total_ingresocuotas_proveedores').value 
                      var totalimporte=document.getElementById('inp_totalimporte_ingresocuotas_proveedores').value 
                      total = total.replace(/\./g,'');
                      totalimporte = totalimporte.replace(/\./g,'');
                     
				
					  var resultado1=(parseInt(total)-parseInt(totalimporte));
					  if(totalimporte>total){
                      ver_cerrar_ventana_cargando("2","HAY UNA DIFERENCIA DE "+format_con_puntos_decimales(resultado1)+ "Gs.");
                      return false;
                      }else  if(totalimporte<total){
                      ver_cerrar_ventana_cargando("2","FALTA ASIGNAR MAS CUOTAS PARA IGUALAR FALTANTE DE "+format_con_puntos_decimales(resultado1)+ "Gs.");
                       return false;
                      }else if(totalimporte==total){
                       add_datos_compras_contado();
                      }
}

/*AGREGAR CUOTA A PROVEEDORES*/
var contador_ingresocuota=1;
function add_ingresar_cuota_a_venta(){

	var dia=0;
	var mess=0;
	var ano=0;
  if(contador_ingresocuota==1){
	var fechahoy = new Date(); 
     dia = fechahoy.getDate(); //obteniendo dia
     mess = fechahoy.getMonth()+1;	
     ano = fechahoy.getFullYear(); 	
  }else{
	  var datosidvto=parseInt(contador_ingresocuota)-1;
      var fechasc=document.getElementById('td_vto_'+datosidvto+'').innerHTML;
	  var parts =fechasc.split('/');

	  var fechahoy1 = new Date(parts[2]+"-"+parts[1]+"-"+parts[0]);
      var  fechax = new Date(fechahoy1.setMonth(fechahoy1.getMonth() + 1));
     
      dia = fechax.getDate()+1;
      mess = fechax.getMonth() + 1;	
      ano = fechax.getFullYear();

      var fh = new Date(ano+"-"+mess+"-"+dia);
	  var ultimoDia = new Date(fh.getFullYear(), fh.getMonth(), 0);
      var fechaobtenido=ultimoDia.getDate()
	  var control=0;
	  
       if(parts[1]==1){
		 control=1; 
		 dia = 30-parseInt(dia);
         mess = fh.getMonth();	
         anno = fh.getFullYear();	
	   }else{
	  if(fechaobtenido<dia){
		var resultado=dia-fechaobtenido;
		if(resultado==1){
		 dia = dia-1;
         mess = fh.getMonth();	
         anno = fh.getFullYear();	
		}else if(resultado==2){
		 dia = dia-2;
         mess = fh.getMonth();	
         anno = fh.getFullYear();	
		}else if(resultado==3){
		 dia = dia-3;
         mess = fh.getMonth();	
         anno = fh.getFullYear();	
		}		
	   
	  }
	 }
	 	
  }

  if(dia<10){
    dia='0'+dia;
  }	//agrega cero si el menor de 10
    if(mess<10){
    mess='0'+mess
    }         
                   var onclick_vto='habilitar_typeo_en_ingresocuota("1","'+contador_ingresocuota+'")';
                   var onclick_importe='habilitar_typeo_en_ingresocuota("2","'+contador_ingresocuota+'")';
                 
                   document.getElementById("lbltotal_ingresocuotas_proveedores").value=contador_ingresocuota;
                   var importe=0;
                  if(contador_ingresocuota==1){
                   importe=importe;
                  }else{
                  var datosid=parseInt(contador_ingresocuota)-1;
                  var importe1=document.getElementById('td_importe_'+datosid+'').innerHTML;
				  if(importe1==0){
					  return false;
				  }else{
                      

                       var total=document.getElementById('inp_total_ingresocuotas_proveedores').value 
                       var totalimporte=document.getElementById('inp_totalimporte_ingresocuotas_proveedores').value 
                      total = total.replace(/\./g,'');
                      totalimporte = totalimporte.replace(/\./g,'');
                      importe1 = importe1.replace(/\./g,'');
					  var resultado=(parseInt(totalimporte)+parseInt(importe1));
					  var resultado1=(parseInt(total)-parseInt(resultado));
					  if(resultado>total){
                        ver_cerrar_ventana_cargando("2","HAY UNA DIFERENCIA DE "+format_con_puntos_decimales(resultado1)+ "Gs.");
                        importe=importe1;
                      }else{
						  importe=importe1; 
					  }
                     
				  }
                
                  }
                    var pagina=	
				"<tr id='"+contador_ingresocuota+"' name='cnt_ingresocuota_agregados' class='table_blanco_compras'>"+
				"<td id='td_cod' class='td_detalles' style='width:0%;display:none' >"+contador_ingresocuota+"</td>"+
				"<td id='td_cuota_"+contador_ingresocuota+"' class='td_detalles' style='width:10%;border-bottom: 1px solid #d6d3d3;' >"+contador_ingresocuota+"</td>"+
				"<td  id='td_vto_"+contador_ingresocuota+"' onclick='"+onclick_vto+"' class='td_detalles' style='width:45%;border-bottom: 1px solid #d6d3d3;cursor: text;' >"+dia+"/"+mess+"/"+ano+"</td>"+
				"<td  id='td_importe_"+contador_ingresocuota+"' onclick='"+onclick_importe+"'  name='td_importe_compras'  onclick='' class='td_detalles' style='width:45%;border-bottom: 1px solid #d6d3d3;cursor: text;' >"+importe+"</td>"+
	          "</tr>"
			   document.getElementById("cnt_listado_ingresocuotas_proveedores").innerHTML += pagina;
			
			     contador_ingresocuota=contador_ingresocuota+1;
				 
				  volver_a_cargar_ingresocuota_compra("1");
}

var datossds=1;
 function quitar_cuota_ingresado(){
var datossds=document.getElementById("lbltotal_ingresocuotas_proveedores").value;
if(datossds>0){
$("tr[id="+datossds+"]").remove(); 
if(datossds<=1){
 contador_ingresocuota=parseInt(datossds);

}else{
 contador_ingresocuota=parseInt(datossds)-1;
 
}
	////console.log(contador_ingresocuota)
	document.getElementById("lbltotal_ingresocuotas_proveedores").value=contador_ingresocuota;
   contador_ingresocuota=contador_ingresocuota+1;
	volver_a_cargar_ingresocuota_compra("1");
}
	
 }

function habilitar_typeo_en_ingresocuota(d,cod){

if(d=="1"){
  var onclick_onblur_vto='onblur_td_ingresocuota("1","'+cod+'")';
  var vto=document.getElementById('td_vto_'+cod+'').innerHTML;
  document.getElementById('td_vto_'+cod+'').innerHTML="";
  document.getElementById('td_vto_'+cod+'').innerHTML="<input onblur="+onclick_onblur_vto+" type='date' style='width: 100%;height: 100%;border: none;text-align: center;color: green;font-weight: bold;font-size: 12px;outline: none;'  id='input_vto_"+cod+"'  value=''/> ";
  var parts =vto.split('/');
  document.getElementById('input_vto_'+cod+'').value=parts[2]+"-"+parts[1]+"-"+parts[0];
document.getElementById('input_vto_'+cod+'').focus();
}
if(d=="2"){
  var onclick_calcular_importe='volver_a_cargar_ingresocuota_compra("1","'+cod+'")';
  var onclick_onblur_importe='onblur_td_ingresocuota("2","'+cod+'")';
  var importe=document.getElementById('td_importe_'+cod+'').innerHTML;
  document.getElementById('td_importe_'+cod+'').innerHTML="";
  document.getElementById('td_importe_'+cod+'').innerHTML="<input onblur="+onclick_onblur_importe+" type='text' style='width: 100%;height: 100%;border: none;text-align: center;color: green;font-weight: bold;font-size: 12px;outline: none;'   onkeyup='"+onclick_calcular_importe+"' onchange='"+onclick_calcular_importe+"' id='input_importe_"+cod+"' value=''/> "
  document.getElementById('input_importe_'+cod+'').focus();
}

}

function onblur_td_ingresocuota(d,cod){
var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var mes1 = fecha.getMonth()+2; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10){
    dia='0'+dia;
  }	//agrega cero si el menor de 10
  if(mes<10){
    mes='0'+mes
  }
  if(mes1<10){
    mes1='0'+mes1
  }

	if(d=="1"){
		 var vto=document.getElementById('input_vto_'+cod+'').value; 
		document.getElementById('td_vto_'+cod+'').innerHTML="";
		 var parts =vto.split('-');
		 if(vto==""){
			document.getElementById('td_vto_'+cod+'').innerHTML=dia+"/"+mes+"/"+ano;
		 }else{
		   document.getElementById('td_vto_'+cod+'').innerHTML=parts[2]+"/"+parts[1]+"/"+parts[0];

		 }  
	}

	if(d=="2"){
			 var precio=document.getElementById('input_importe_'+cod+'').value; 
		 if(precio==""){
			document.getElementById('td_importe_'+cod+'').innerHTML='0';
		    obtener_datos_decimales_compras("1",cod)
		 }else{
		   document.getElementById('td_importe_'+cod+'').innerHTML=format_con_puntos_decimales(precio);
		 }
		 volver_a_cargar_ingresocuota_compra("1");
	}
}

function volver_a_cargar_ingresocuota_compra(d){
if(d=="1"){
   	var subTotal = 0;
    $("tr[name=cnt_ingresocuota_agregados]").each(function(i, elementohtml){
	var liTotal=$(elementohtml).children('td[name="td_importe_compras"]').html();
    liTotal = liTotal.replace(/\./g,'');
     subTotal += parseInt(liTotal);
     document.getElementById('inp_totalimporte_ingresocuotas_proveedores').value=format_con_puntos_decimales(subTotal);
	});
}
 
}

/*CARGAR COMPRA PROVEEDORES*/
function add_datos_cobros_compras_proveedores() {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var compras_cod = document.getElementById('inp_codcompras_pcobros_proveedores').value;
	var montopagado1 = document.getElementById('inp_totalaentregar_pcobros_proveedores').value
	var montopagado=montopagado1.toString().replace(/\./g,'');
	var fechapago = document.getElementById('inp_fecha_pcobros_proveedores').value
	var caja_cod = document.getElementById('usuario_idcaja').innerHTML;
	var nrofactura = document.getElementById('inp_nrofactura_pcobros_proveedores').value
	var sucursales_cod = document.getElementById('usuario_idsucursal').innerHTML;
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
    var accion="guardar";
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func", "cargarpagos")
	datos.append("hora", hora)
	datos.append("compras_cod", compras_cod)
	datos.append("montopagado", montopagado)
	datos.append("fechapago", fechapago)
	datos.append("caja_cod", caja_cod)
	datos.append("nrofactura", nrofactura)
	datos.append("sucursales_cod", sucursales_cod)
	datos.append("usuarios_cod", usuarios_cod)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmComprasInsumos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");	
				return false;
			}
			if (Respuesta == "exito") {
		    
			ver_cerrar_ventana_cargando("2","PAGO REGISTRADO CORRECTAMENTE");
			abrir_cerrar_ventanas_pagoscuotasproveedores("2");
			var compras_cod=document.getElementById('inp_codcompras_pcobros_proveedores').value
			buscar_datos_historial_pagos_a_proveedores(compras_cod);
		abrir_cerrar_ventanas_cuotasproveedores("2");
          
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
			}
		}
	});


}

function validar_campo_total_a_entregar_proveedores(){
	var totalapagar=document.getElementById("inp_totalimporte_pcobros_proveedores").value
	var totalentregar=document.getElementById("inp_totalaentregar_pcobros_proveedores").value
 if (totalentregar== '') {
      ver_cerrar_ventana_cargando("2","FALTO COMPLETAR MONTO ENTREGA");
  
	  return false;
	}else if(parseInt(totalentregar)>parseInt(totalapagar)){
	  ver_cerrar_ventana_cargando("2","EL MONTO A ENTREGAR NO PUEDE SER MAYOR AL MONTO A PAGAR");
	  return false;
	}
}

function validar_campo_cant_cuota_proveedores(){
 if (document.getElementById("inp_cantcuotas_pcobros_proveedores").value == '') {
    	document.getElementById("inp_cantcuotas_pcobros_proveedores").classList.add('input_1_1_error');
        document.getElementById("inp_cantcuotas_pcobros_proveedores").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cantcuotas_pcobros_proveedores").classList.remove('input_1_1_error');
        document.getElementById("inp_cantcuotas_pcobros_proveedores").classList.add('input_1_1');
	}
}

//busccar datos COMPRAS INSUMOS
function buscar_datos_pagos_a_proveedores() {
	var buscar = document.getElementById('inpt_buscador_pagos_a_proveedores').value
 var codsucursal = document.getElementById('usuario_idsucursal').innerHTML;
	document.getElementById("cnt_listado_pagos_a_proveedores").innerHTML = ""
	var datos = {
		"buscar": buscar,
		"codsucursal": codsucursal,
		"func": "buscar_detalles_compras_insumos"
	};
	$.ajax({
		data: datos, url: "./php/abmComprasInsumos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_creditos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_pagos_a_proveedores").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("cnt_listado_pagos_a_proveedores").innerHTML = datos_buscados
					document.getElementById("lbltotal_pagos_a_proveedores").innerHTML="CANTIDAD: "+datos["2"];
				} catch (error) {
				}
			}
		}
	});
}

//busccar datos COMPRAS INSUMOS
function buscar_datos_pagos_a_contado_proveedores() {
	var buscar = document.getElementById('inpt_buscador_pagos_a_contado_proveedores').value
 var codsucursal = document.getElementById('usuario_idsucursal').innerHTML;
	document.getElementById("cnt_listado_pagos_a_contado_proveedores").innerHTML = ""
	var datos = {
		"buscar": buscar,
		"codsucursal": codsucursal,
		"func": "buscar_detalles_compras_insumos_contado"
	};
	$.ajax({
		data: datos, url: "./php/abmComprasInsumos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_creditos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			document.getElementById("cnt_listado_pagos_a_contado_proveedores").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("cnt_listado_pagos_a_contado_proveedores").innerHTML = datos_buscados
					document.getElementById("lbltotal_pagos_a_contado_proveedores").innerHTML="CANTIDAD: "+datos["2"];
				} catch (error) {
				}
			}
		}
	});
}

//busccar datos HISTORIAL COMPRAS INSUMOS
function buscar_datos_historial_compras_a_proveedores() {
	var buscar = document.getElementById('inpt_buscador_historial_pagos_a_proveedores').value
 var codsucursal = document.getElementById('usuario_idsucursal').innerHTML;
	document.getElementById("cnt_listado_historial_pagos_a_proveedores").innerHTML = ""
	var datos = {
		"buscar": buscar,
		"codsucursal": codsucursal,
		"func": "buscar_detalles_historial_compras_insumos"
	};
	$.ajax({
		data: datos, url: "./php/abmComprasInsumos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_creditos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			document.getElementById("cnt_listado_historial_pagos_a_proveedores").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("cnt_listado_historial_pagos_a_proveedores").innerHTML = datos_buscados
					document.getElementById("cant_total_historial_pagos_a_proveedores").innerHTML="CANTIDAD: "+datos["2"];
				} catch (error) {
				}
			}
		}
	});
}

//busccar datos HISTIRIAL COMPRAS INSUMOS
function buscar_datos_historial_pagos_a_proveedores(codcompras) {
	document.getElementById("cnt_listado_cuotasproveedores").innerHTML = ""
	var datos = {
		"codcompras": codcompras,
		"func": "buscar_detalles_pagos_compras_insumos"
	};
	$.ajax({
		data: datos, url: "./php/abmComprasInsumos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_creditos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			document.getElementById("cnt_listado_cuotasproveedores").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("cnt_listado_cuotasproveedores").innerHTML = datos_buscados
					document.getElementById("lbltotalcuotasproveedores").innerHTML="TOTAL CUOTA: "+datos["2"];
					document.getElementById("lbltotalcuotaspendienteproveedores").innerHTML="CUOTA PENDIENTE: "+datos["7"];
					document.getElementById("lbltotalcuotaspagadasproveedores").innerHTML="CUOTA PAGADA: "+datos["8"];
					document.getElementById("inp_proveedores_ruc_cobros_p").value=datos["3"];
					document.getElementById("inp_proveedores_nombres_cobros_p").value=datos["4"];
					document.getElementById("inp_fecha_compra_p").value=datos["5"];
					document.getElementById("inp_nrofactura_cobros_p").value=datos["6"];

					document.getElementById("inp_ruc_pcobros_proveedores").value=datos["3"];
					document.getElementById("inp_clientes_nombres_pcobros_proveedores").value=datos["4"];
					
					document.getElementById("inp_codcompras_pcobros_proveedores").value=datos["9"];
				} catch (error) {
				}
			}
		}
	});
}

function buscar_pagos_cuotas_del_proveedor(){
 var compras_cod = document.getElementById('inp_codcompras_pcobros_proveedores').value;
 var  limit= document.getElementById('inp_cantcuotas_pcobros_proveedores').value;
  if(limit==""){
			return false;
  }
	document.getElementById('cnt_listado_pagoscuotasproveedores').innerHTML = "";
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func" , "buscar_cantidad_cuota_a_pagar_proveedores")
	datos.append("compras_cod" ,compras_cod)
	datos.append("limit" ,limit)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmComprasInsumos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('cnt_listado_pagoscuotasproveedores').innerHTML = datos[2]
					document.getElementById('inp_cant_cuota_proveedores_p').value = datos[3]
				   document.getElementById('inp_totalimporte_pcobros_proveedores').value = datos[4] ;
				   document.getElementById('inp_totalaentregar_pcobros_proveedores').value = datos[4] ;
				
					document.getElementById('inp_totalimporte_pagado_proveedores').value = datos[5]
				
		
				
				    document.getElementById('capa_informativa').style.display='none';
					document.getElementById('div_principal_info_carga').style.display='none';
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function buscar_cuotas_del_cliente(compras_cod){
	document.getElementById('cnt_listado_cuotasclientes').innerHTML = "";
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func" , "buscar_detalles_cuoteros_Clientes")
	datos.append("compras_cod" ,compras_cod)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmPagosCuotasClientes.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('cnt_listado_cuotasclientes').innerHTML = datos["2"]
					document.getElementById('lbltotalcuotasclientes').innerHTML = "TOTAL CUOTA: "+datos["3"]
					document.getElementById('lbltotalcuotaspendienteclientes').innerHTML = " - CUOTA PENDIENTE: "+datos["4"]
					document.getElementById('lbltotalcuotaspagadasclientes').innerHTML = " - CUOTA PAGADA: "+datos["5"]
					document.getElementById('inp_nrofactura_cobros_c').value = datos[8]
					document.getElementById('inp_clientes_cedula_cobros_c').value = datos[6]
					document.getElementById('inp_codclientes_cobros_c').value = datos[10]
					document.getElementById('inp_clientes_nombres_cobros_c').value = datos[7]
					document.getElementById('inp_fecha_cobros_c').value = datos[9];
					document.getElementById('inp_cedula_pcobros_c').value = datos[6];
					document.getElementById('inp_clientes_nombres_pcobros_c').value = datos[7];
					document.getElementById('inp_codcobrador_pcobros_c').value = datos[11];
					document.getElementById('inp_cobrador_nombres_pcobros_c').value = datos[12];
					document.getElementById('inp_factura_pcobros_c').value = datos[8];
					document.getElementById('inp_codventas_pcobros_c').value = datos[13];
				    document.getElementById('capa_informativa').style.display='none';
					document.getElementById('div_principal_info_carga').style.display='none';
				} else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				
			}
		}
	});
}

/*AÑADIR COMPRAS*/
function add_datos_compras_contado() {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
    var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var cod = document.getElementById('inp_idcompras_comprasinsumos').value
	var nrofactura = document.getElementById('inp_facturas_comprasinsumos').value
	var fechacompra = document.getElementById('inp_fecha_comprasinsumos').value
	var condicion = document.getElementById('inp_condicion_comprasinsumos').value
	var moto1 = document.getElementById('inp_total_compras').value
    var monto = moto1.toString().replace(/\./g,'');
    var sucursales_cod = document.getElementById('usuario_idsucursal').innerHTML;
	var proveedores_cod = document.getElementById('inp_idproveedor_comprasinsumos').value
    
	var accion = 'cargar_compras_insumos'
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("nrofactura", nrofactura)
	datos.append("fechacompra", fechacompra)
	datos.append("condicion", condicion)
	datos.append("monto", monto)
	datos.append("proveedores_cod", proveedores_cod)
	datos.append("sucursales_cod", sucursales_cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmComprasInsumos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
		
			ver_cerrar_ventana_cargando("ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {
				if (accion == 'cargar_compras_insumos') {
					cargar_detalles_compras_insumos();
				} 
				
			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				//limpiar_campos_conceptos();
			}
		}
	});


}

function cargar_cuotero_compra_contado() {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
    var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var vto = document.getElementById('inp_fecha_comprasinsumos').value
	var moto1 = document.getElementById('inp_total_compras').value
    var monto = moto1.toString().replace(/\./g,'');
	
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", "cargar_cuotero_compra_contado")
	datos.append("monto", monto)
	datos.append("vto", vto)
	datos.append("hora", hora)
	datos.append("usuarios_cod", usuarios_cod)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmComprasInsumos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
		
			ver_cerrar_ventana_cargando("ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {
				    ver_cerrar_ventana_cargando("2","COMPRA REGISTRADA CORRECTAMENTE")
					 document.getElementById('cnt_listado_insumos_seleccionados').innerHTML=''
					 document.getElementById('inp_facturas_comprasinsumos').value=''
					 document.getElementById('inp_idproveedor_comprasinsumos').value=''
					 document.getElementById('inp_proveedor_comprasinsumos').value=''
					 document.getElementById('inp_total_compras').value=''
                     contador_concepto=0;
				
			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				//limpiar_campos_conceptos();
			}
		}
	});


}

function cargar_detalles_compras_insumos() {
    var datos = new FormData();
	var control=1;
	var f = new Date();
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	datos.append("hora", hora)	
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	datos.append("usuarios_cod", usuarios_cod)
	$("tr[name=cnt_comprasinsumos_agregados]").each(function(i, elementohtml){
	
	var codigo=$(elementohtml).children('td[id="td_cod"]').html();
     ////console.log(codigo)
	var conceptos_cod=$(elementohtml).children('td[id="td_codigo"]').html();
   
    datos.append("conceptos_cod"+control, conceptos_cod)
	
	var concepto=document.getElementById('td_articulo_'+codigo+'').innerHTML
   
    datos.append("concepto"+control, concepto)

      var cantidad=document.getElementById('td_cantidad_'+codigo+'').innerHTML
     
    datos.append("cantidad"+control, cantidad)
  
    var precio=document.getElementById('td_precio_'+codigo+'').innerHTML
    datos.append("precio"+control, precio.replace(/\./g,''))
   
    var subtotal=$(elementohtml).children('td[id="td_subtotal_'+codigo+'"]').html();
    datos.append("subtotal"+control, subtotal.replace(/\./g,''))
   
	control=control+1;
	});
	control=control-1;
	datos.append("totalRegistro", control)

ver_cerrar_ventana_cargando("1","CARGANDO...");
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmDetalles_Compras_Insumos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			verCerrarEfectoCargando("")
			ver_cerrar_ventana_cargando("2","ERROR DE CONECCIÓN")
			return false;
		},
		success: function (responseText) {
			verCerrarEfectoCargando("")
			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
var condicion=document.getElementById('inp_condicion_comprasinsumos').value
	if(condicion=="CONTADO"){
             cargar_cuotero_compra_contado();    
	}
	if(condicion=="CREDITO"){
              add_datos_cuoteros_compra_credito();
	}
					
				}
				else {
					ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
				}
			} catch (error) {
				ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
			}
		}
	});
}

function add_datos_cuoteros_compra_credito() {
    var datos = new FormData();
	var control=1;
	var f = new Date();
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	datos.append("hora", hora)	
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	datos.append("usuarios_cod", usuarios_cod)
	$("tr[name=cnt_ingresocuota_agregados]").each(function(i, elementohtml){
	
	var codigo=$(elementohtml).children('td[id="td_cod"]').html();
    
	var plazo=document.getElementById('td_cuota_'+codigo+'').innerHTML
   
    datos.append("plazo"+control, plazo)
	
	var vto=document.getElementById('td_vto_'+codigo+'').innerHTML
    var parts =vto.split('/');
	vto=parts[2]+"-"+parts[1]+"-"+parts[0];
    datos.append("vto"+control, vto)


    var monto=document.getElementById('td_importe_'+codigo+'').innerHTML
    datos.append("monto"+control, monto.replace(/\./g,''))
   
 
	control=control+1;
	});
	control=control-1;
	datos.append("totalRegistro", control)

ver_cerrar_ventana_cargando("1","CARGANDO...");
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmCuoteros_Compras_Insumos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			verCerrarEfectoCargando("")
			ver_cerrar_ventana_cargando("2","ERROR DE CONECCIÓN")
			return false;
		},
		success: function (responseText) {
			verCerrarEfectoCargando("")
			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {

                     ver_cerrar_ventana_cargando("2","COMPRA REGISTRADA CORRECTAMENTE")
					 document.getElementById('cnt_listado_insumos_seleccionados').innerHTML=''
					 document.getElementById('inp_facturas_comprasinsumos').value=''
					 document.getElementById('inp_idproveedor_comprasinsumos').value=''
					 document.getElementById('inp_proveedor_comprasinsumos').value=''
					 document.getElementById('inp_total_compras').value=''
					 document.getElementById('lbltotal_ingresocuotas_proveedores').value=''
					 document.getElementById('inp_total_ingresocuotas_proveedores').value=''
					 document.getElementById('inp_totalimporte_ingresocuotas_proveedores').value=''
					 document.getElementById('cnt_listado_ingresocuotas_proveedores').innerHTML=''
                     abrir_cerrar_ventanas_ingresocuotas_proveedores("2");
                     contador_concepto=0;
                      contador_ingresocuota=1;
				}
				else {
					ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
				}
			} catch (error) {
				ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
			}
		}
	});
}

function control_contado_credito_compras_conceptos(){
var idproveedor=document.getElementById('inp_idproveedor_comprasinsumos').value
var cantidad=document.getElementById('lbltotal_compra_proveedores').value
var totalcompra=document.getElementById('inp_total_compras').value
if(idproveedor==""){
   	ver_cerrar_ventana_cargando("2","FALTA SELECCIONAR PROVEEDORES");
	return false;
}
if(cantidad==""){
   	ver_cerrar_ventana_cargando("2","FALTA SELECCIONAR INSUMO");
	return false;
}
if(totalcompra==""){
   	ver_cerrar_ventana_cargando("2","FALTA ASIGNAR PRECIO O CANTIDAD INSUMO");
	return false;
}
if(totalcompra=0){
   	ver_cerrar_ventana_cargando("2","FALTA ASIGNAR PRECIO INSUMO");
	return false;
}
var condicion=document.getElementById('inp_condicion_comprasinsumos').value
	if(condicion=="CONTADO"){
       add_datos_compras_contado();
	}
	if(condicion=="CREDITO"){
        abrir_cerrar_ventanas_ingresocuotas_proveedores("1");
	}
}
var lista="";

function seleccionar_conceptos_compras(cod,descripcion){
                 contador_concepto=contador_concepto+1;
                 buscar_datos_conceptosvista_compras();
                
				document.getElementById('lbltotal_compra_proveedores').value=contador_concepto;
					 var id_archivo_obtenido=cod;
                   var onclick_descripcion='habilitar_typeo_en_detallesconceptos_compra("1","'+contador_concepto+'")';
                   var onclick_cantidad='habilitar_typeo_en_detallesconceptos_compra("2","'+contador_concepto+'")';
                   var onclick_precio='habilitar_typeo_en_detallesconceptos_compra("3","'+contador_concepto+'")';
                 
                    var pagina=	
				  "<tr id='"+contador_concepto+"' name='cnt_comprasinsumos_agregados' class='table_blanco_compras'>"+
				"<td id='td_cod' class='td_detalles' style='width:0%;display:none' >"+contador_concepto+"</td>"+
				"<td id='td_codigo' class='td_detalles' style='width:10%;border-bottom: 1px solid #d6d3d3;' >"+cod+"</td>"+
				"<td  id='td_detalles_concepto' class='td_detalles' style='width:30%;border-bottom: 1px solid #d6d3d3;cursor: text;' ><div class='div_td_desc' onclick="+onclick_descripcion+"  id='td_articulo_"+contador_concepto+"' contenteditable='true'>"+descripcion+"</div> </td>"+
				"<td  id='td_cantidad_"+contador_concepto+"' onclick="+onclick_cantidad+" class='td_detalles' style='width:15%;border-bottom: 1px solid #d6d3d3;cursor: text;' >1</td>"+
				"<td  id='td_precio_"+contador_concepto+"' onclick="+onclick_precio+" class='td_detalles' style='width:15%;border-bottom: 1px solid #d6d3d3;cursor: text;' >0</td>"+
				"<td id='td_subtotal_"+contador_concepto+"' name='td_subdetalles_compras' class='td_detalles' style='width:15%;border-bottom: 1px solid #d6d3d3;cursor: text;' >0</td>"+
				"<td class='td_detalles' style='width: 15%;border-bottom: 1px solid #d6d3d3;' ><CENTER><button  onclick='quitar_conceptos_de_la_tabla("+contador_concepto+")' type='button' style='cursor:pointer;float: none;' class='input_eliminar_archivo'><img src='./icono/delete.png' style='width:15px;height:15px;' /></button></CENTER></td>"+
	          "</tr>"
			   document.getElementById("cnt_listado_insumos_seleccionados").innerHTML += pagina;
			   contador_concepto=contador_concepto+1;
                  
			 abrir_cerrar_ventanas_vistaconceptos("2");
}

var contador_concepto=0;
 function quitar_conceptos_de_la_tabla(datos){
	$("tr[id="+datos+"]").remove(); 
	contador_concepto=contador_concepto-1;
	document.getElementById('lbltotal_compra_proveedores').value=contador_concepto;
 }
function habilitar_typeo_en_pagos_cuotas_td_interes(cod){
 var onclick_onblur_interes='cargar_interes_pagos_proveedores("'+cod+'")';
	   var interes= document.getElementById('div_interes_'+cod+'').innerHTML;
		document.getElementById('td_interes_'+cod+'').innerHTML="<input onblur="+onclick_onblur_interes+" type='text' style='width: 100%;height: 100%;border: none;text-align: center;color: green;font-weight: bold;font-size: 12px;outline: none;' name='"+cod+"' onkeyup='' onchange='' id='inp_interes_"+cod+"' value=''/>";
        document.getElementById('inp_interes_'+cod+'').focus();
}

function habilitar_typeo_en_detallesconceptos_compra(d,cod){
if(d=="1"){
    document.getElementById('td_articulo_'+cod+'').contentEditable = true;
}
if(d=="2"){
  var onclick_onblur_cantidad='onblur_td("1","'+cod+'")';
  var onclick_calcular_cantidad='volver_a_cargar_detallesconceptos_compra("1","'+cod+'")';
  var cantidad=document.getElementById('td_cantidad_'+cod+'').innerHTML;

  document.getElementById('td_cantidad_'+cod+'').innerHTML="";
  document.getElementById('td_cantidad_'+cod+'').innerHTML="<input onblur="+onclick_onblur_cantidad+" type='text' style='width: 100%;height: 100%;border: none;text-align: center;color: green;font-weight: bold;font-size: 12px;outline: none;'  id='input_cantidad_"+cod+"' onkeyup='"+onclick_calcular_cantidad+"' onchange='"+onclick_calcular_cantidad+"'  value=''/> ";
document.getElementById('input_cantidad_'+cod+'').focus();
}
if(d=="3"){
  var onclick_onblur_precio='onblur_td("2","'+cod+'")';
  var onclick_calcular_precio='volver_a_cargar_detallesconceptos_compra("2","'+cod+'")';
  var precio=document.getElementById('td_precio_'+cod+'').innerHTML;
  document.getElementById('td_precio_'+cod+'').innerHTML="";
  document.getElementById('td_precio_'+cod+'').innerHTML="<input onblur="+onclick_onblur_precio+" type='text' style='width: 100%;height: 100%;border: none;text-align: center;color: green;font-weight: bold;font-size: 12px;outline: none;'   onkeyup='"+onclick_calcular_precio+"' onchange='"+onclick_calcular_precio+"' id='input_precio_"+cod+"' value=''/> "
  document.getElementById('input_precio_'+cod+'').focus();
}

}

function onblur_td(d,cod){
	if(d=="1"){

		 var cantidad=document.getElementById('input_cantidad_'+cod+'').value; 
		document.getElementById('td_cantidad_'+cod+'').innerHTML="";
		
		 if(cantidad==""){
			document.getElementById('td_cantidad_'+cod+'').innerHTML='0';
			
			
		 }else{
		   document.getElementById('td_cantidad_'+cod+'').innerHTML=cantidad;
		 }  
	}

	if(d=="2"){
			 var precio=document.getElementById('input_precio_'+cod+'').value; 
		 if(precio==""){
			document.getElementById('td_precio_'+cod+'').innerHTML='0';
				obtener_datos_decimales_compras("1",cod)
		 }else{
		   document.getElementById('td_precio_'+cod+'').innerHTML=format_con_puntos_decimales(precio);
		 }
	}
}

function volver_a_cargar_detallesconceptos_compra(d,cod){
if(d=="1"){
   	var cantidad=document.getElementById('input_cantidad_'+cod+'').value;
	var precio=document.getElementById('td_precio_'+cod+'').innerHTML;
	var resultado=parseInt(cantidad)*parseInt(precio.toString().replace(/\./g,''));
	document.getElementById('td_subtotal_'+cod+'').innerHTML=format_con_puntos_decimales(resultado);
	 sumar_columana_subtotal_compra(cod);
}
 if(d=="2"){
   	var cantidad=document.getElementById('td_cantidad_'+cod+'').innerHTML;
	var precio=document.getElementById('input_precio_'+cod+'').value;
	var resultado=parseInt(cantidad)*parseInt(precio.toString().replace(/\./g,''));
	document.getElementById('td_subtotal_'+cod+'').innerHTML=format_con_puntos_decimales(resultado);
	 sumar_columana_subtotal_compra(cod);
}
}

function obtener_datos_decimales_compras(d,cod){
	if(d=="1"){
		var total=document.getElementById('td_precio_'+cod+'').value;
	    document.getElementById('td_precio_'+cod+'').value=format_con_puntos_decimales(total);
		volver_a_cargar_detallesconceptos_compra("2",cod);
       
	}
	}

function sumar_columana_subtotal_compra(cod){
var subTotal = 0;
   $("tr[name=cnt_comprasinsumos_agregados]").each(function(i, elementohtml){
	var liTotal=$(elementohtml).children('td[name="td_subdetalles_compras"]').html();
    liTotal = liTotal.replace(/\./g,'');
     subTotal += parseInt(liTotal);

       document.getElementById('inp_total_compras').value=format_con_puntos_decimales(subTotal);
	});
 }




/*AÑADIR O MODIFICAR NUEVO 	PROVEEDORES*/
function add_datos_proveedores(datos) {
	ver_cerrar_ventana_cargando("1");
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idproveedores').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var nombre = document.getElementById('inp_nombre_proveedores').value
	var ruc = document.getElementById('inp_ruc_proveedores').value
	var telefono = document.getElementById('inp_telefono_proveedores').value
	var direccion = document.getElementById('inp_direccion_proveedores').value
	var email = document.getElementById('inp_email_proveedores').value
	var barrios_cod = document.getElementById('inp_idbarrios_proveedores').value

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_proveedores"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_proveedores"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando...");
	
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("nombre", nombre)
	datos.append("ruc", ruc)
	datos.append("email", email)
	datos.append("telefono", telefono)
	datos.append("direccion", direccion)
	datos.append("barrios_cod", barrios_cod)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmproveedores.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				
			
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_proveedores();
					buscar_datos_proveedores("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
			
					limpiar_campos_proveedores();
					buscar_datos_proveedores("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
				
					limpiar_campos_proveedores();
					buscar_datos_proveedores("ACTIVO");
				}
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				
			
				//limpiar_campos_clientes();
			}
		}
	});


}

function limpiar_campos_proveedores(){

	document.getElementById('inp_idproveedores').value= ''
	document.getElementById('inp_nombre_proveedores').value= ''
	document.getElementById('inp_ruc_proveedores').value= ''	
	document.getElementById('inp_telefono_proveedores').value= ''	
	document.getElementById('inp_direccion_proveedores').value= ''	
	document.getElementById('inp_email_proveedores').value= ''	
	document.getElementById('inp_idbarrios_proveedores').value= ''	
	document.getElementById('inp_barrios_proveedores').value= ''	
	document.getElementById('btn_guardar_proveedores').innerHTML = "<p style='display:none;' id='accion_guardar_proveedores'>guardar</p>GUARDAR";
}

var estado_proveedores = 'ACTIVO';
function buscar_por_opciones_proveedores(d) {
	if (d == "1") {
		estado_proveedores = 'ACTIVO';
		buscar_datos_proveedores(estado_proveedores);
		abrir_cerrar_ventanas_proveedores("6");
	}
     if (d == "2") {
		estado_proveedores = 'ELIMINADO';
		buscar_datos_proveedores(estado_proveedores);
		abrir_cerrar_ventanas_proveedores("6");
	}

}

//busccar datos proveedores
function buscar_datos_proveedores(buscar2) {
	var buscador = document.getElementById('inpt_buscador_proveedores').value
   if(controlseleccion_proveedores=="vista"){
	  buscador = document.getElementById('inpt_buscador_proveedor_vista').value
    }
	document.getElementById("cnt_listado_proveedores").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmproveedores.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_proveedores").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_proveedores").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_proveedores").innerHTML = datos_buscados
					document.getElementById("lbltotalproveedores").innerHTML="CANTIDAD: "+datos["2"];
					if(controlseleccion_proveedores=="vista"){
		              document.getElementById("cnt_listado_proveedor_vista").innerHTML = datos_buscados
		              document.getElementById("lbltotalproveedor_vista").innerHTML="CANTIDAD: "+datos["2"];
	                 }
				} catch (error) {

				}

			}
		}
	});
}

var controlseleccion_proveedores="";
function obtener_datos_proveedores(datospr) {
	document.getElementById('inp_idproveedores').value= $(datospr).children('td[id="td_cod"]').html();
    document.getElementById('inp_nombre_proveedores').value= $(datospr).children('td[id="td_nombre"]').html();
	document.getElementById('inp_ruc_proveedores').value= $(datospr).children('td[id="td_ruc"]').html();
	document.getElementById('inp_telefono_proveedores').value= $(datospr).children('td[id="td_telefono"]').html();
	document.getElementById('inp_direccion_proveedores').value= $(datospr).children('td[id="td_direccion"]').html();
	document.getElementById('inp_email_proveedores').value= $(datospr).children('td[id="td_email"]').html();
	document.getElementById('inp_idbarrios_proveedores').value= $(datospr).children('td[id="td_barrios_cod"]').html();
	document.getElementById('inp_barrios_proveedores').value= $(datospr).children('td[id="td_barrios"]').html();
	document.getElementById('btn_guardar_proveedores').innerHTML = "<p style='display:none;' id='accion_guardar_proveedores'>editar</p>EDITAR";
    if(controlseleccion_proveedores=="vista"){
		  document.getElementById('inp_idproveedor_comprasinsumos').value= $(datospr).children('td[id="td_cod"]').html();
          document.getElementById('inp_proveedor_comprasinsumos').value= $(datospr).children('td[id="td_nombre"]').html();  
          abrir_cerrar_ventanas_vistaproveedores("2");          
	}
	abrir_cerrar_ventanas_proveedores("4");
}

/*AÑADIR O MODIFICAR NUEVO PROVEEDOR*/
function add_datos_nuevo_proveedor(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
    var cod = document.getElementById('inp_idproveedores_nuevo').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var nombre = document.getElementById('inp_nombre_proveedores_nuevo').value
	var ruc = document.getElementById('inp_ruc_proveedores_nuevo').value
	var telefono = document.getElementById('inp_telefono_proveedores_nuevo').value
	var direccion = document.getElementById('inp_direccion_proveedores_nuevo').value
	var email = document.getElementById('inp_email_proveedores_nuevo').value
	var barrios_cod = document.getElementById('inp_idbarrios_proveedores_nuevo').value

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_nuevoBarrios"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_nuevoBarrios"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("nombre", nombre)
	datos.append("ruc", ruc)
	datos.append("email", email)
	datos.append("telefono", telefono)
	datos.append("direccion", direccion)
	datos.append("barrios_cod", barrios_cod)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmproveedores.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
	
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPOS");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}

			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					
	                ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE")
				    limpiar_campos_proveedores_nuevo();
					buscar_datos_proveedores("ACTIVO");
	              
				} 
			    } else {
				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
				limpiar_campos_nuevoBarrios();
			}
		}
	});


}

function limpiar_campos_proveedores_nuevo() {
	document.getElementById('inp_idproveedores_nuevo').value= ''
	document.getElementById('inp_nombre_proveedores_nuevo').value= ''
	document.getElementById('inp_ruc_proveedores_nuevo').value= ''	
	document.getElementById('inp_telefono_proveedores_nuevo').value= ''	
	document.getElementById('inp_direccion_proveedores_nuevo').value= ''	
	document.getElementById('inp_email_proveedores_nuevo').value= ''	
	document.getElementById('inp_idbarrios_proveedores_nuevo').value= ''	
	document.getElementById('inp_barrios_proveedores_nuevo').value= ''


	 abrir_cerrar_ventanas_nuevoproveedores("2");
}

/*AÑADIR O MODIFICAR NUEVO otrosegresos*/
function add_datos_otrosegresos(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
    var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var cod = document.getElementById('inp_idotrosegresos').value
	var nro = document.getElementById('inp_recibonro_oe').value
	var fecha = document.getElementById('inp_fecha_oe').value
	var personas_cod = document.getElementById('inp_idpagadoa_oe').value
	var conceptos_cod = document.getElementById('inp_idconcepto_oe').value
	var detalles = document.getElementById('inp_detalle_oe').value
	var moto1 = document.getElementById('inp_monto_oe').value
    var monto = moto1.toString().replace(/\./g,'');
var caja_cod = document.getElementById('usuario_idcaja').innerHTML;
var sucursales_cod = document.getElementById('usuario_idsucursal').innerHTML;
	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_otrosegresos"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_otrosegresos"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("nro", nro)
	datos.append("personas_cod", personas_cod)
	datos.append("conceptos_cod", conceptos_cod)
	datos.append("detalles", detalles)
	datos.append("monto", monto)
	datos.append("moneda", "GUARANIES")
	datos.append("fecha", fecha)
	datos.append("caja_cod", caja_cod)
	datos.append("sucursales_cod", sucursales_cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmotrosegresos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
		
			ver_cerrar_ventana_cargando("ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_otrosegresos1();
					buscar_datos_otrosegresos();
				} 
				
			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				//limpiar_campos_conceptos();
			}
		}
	});


}

function limpiar_campos_otrosegresos1() {
    document.getElementById('inp_idotrosegresos').value= ''
	document.getElementById('inp_idpagadoa_oe').value= ''
	document.getElementById('inp_cedula_pagadoa_oe').value= ''
	document.getElementById('inp_nombres_pagadoa_oe').value= ''
	document.getElementById('inp_idconcepto_oe').value= ''
	document.getElementById('inp_concepto_oe').value= ''
	document.getElementById('inp_detalle_oe').value= ''
	document.getElementById('inp_monto_oe').value= ''
	document.getElementById('btn_guardar_otrosegresos').innerHTML = "<p style='display:none;' id='accion_guardar_otrosegresos'>guardar</p>CARGAR";
}

//busccar datos otrosingresos
function buscar_datos_otrosegresos() {
	var buscador = document.getElementById('inpt_buscador_otrosegresos').value
	var caja_cod = document.getElementById('usuario_idcaja').innerHTML;
	document.getElementById("cnt_listado_historial_otrosegresos").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"caja_cod": caja_cod,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmotrosegresos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_historial_otrosegresos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_historial_otrosegresos").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("cnt_listado_historial_otrosegresos").innerHTML = datos_buscados
					document.getElementById("lbltotalhistorial_oe").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

/*AÑADIR O MODIFICAR NUEVO otrosingresos*/
function add_datos_otrosingresos(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
    var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var cod = document.getElementById('inp_idotrosingresos').value
	var nro = document.getElementById('inp_recibonro_oi').value
	var fecha = document.getElementById('inp_fecha_oi').value
	var personas_cod = document.getElementById('inp_idcobradoa_oi').value
	var cobrador_cod = document.getElementById('inp_idcobrador_oi').value
	var conceptos_cod = document.getElementById('inp_idconcepto_oi').value
	var detalles = document.getElementById('inp_detalle_oi').value
	var moto1 = document.getElementById('inp_monto_oi').value
    var monto = moto1.toString().replace(/\./g,'');
	if(fecha==""){
		
		ver_vetana_informativa("FALTA COMPLETAR FECHA", id_progreso)
		return false;
	}
	if(personas_cod==""){
		ver_vetana_informativa("FALTA COMPLETAR COBRADO A ", id_progreso)
		return false;
	}
	if(conceptos_cod==""){
		ver_vetana_informativa("FALTA COMPLETAR CONCEPTO ", id_progreso)
		return false;
	}
	if(detalles==""){
		ver_vetana_informativa("FALTA COMPLETAR DETALLE CONCEPTO ", id_progreso)
		return false;
	}
	if(moto1==""){
		ver_vetana_informativa("FALTA COMPLETAR MONTO", id_progreso)
		return false;
	}
var caja_cod = document.getElementById('usuario_idcaja').innerHTML;

	if(caja_cod==""){
		ver_vetana_informativa("FALTA APERTURA CAJA", id_progreso)
		return false;
	}
	var sucursales_cod = document.getElementById('usuario_idsucursal').innerHTML;
	if(sucursales_cod==""){
		ver_vetana_informativa("FALTA SUCURSAL", id_progreso)
		return false;
	}

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_otrosingresos"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_otrosingresos"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("nro", nro)
	datos.append("personas_cod", personas_cod)
	datos.append("cobrador_cod", cobrador_cod)
	datos.append("conceptos_cod", conceptos_cod)
	datos.append("detalles", detalles)
	datos.append("monto", monto)
	datos.append("moneda", "GUARANIES")
	datos.append("fecha", fecha)
	datos.append("caja_cod", caja_cod)
	datos.append("sucursales_cod", sucursales_cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmotrosingresos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
		
			ver_cerrar_ventana_cargando("ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_otrosingresos1();
					buscar_datos_otrosingresos("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
					limpiar_campos_otrosingresos1();
					buscar_datos_otrosingresos("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
					limpiar_campos_otrosingresos1();
					buscar_datos_otrosingresos("ACTIVO");
				}

			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				//limpiar_campos_conceptos();
			}
		}
	});


}

function limpiar_campos_otrosingresos1() {
    document.getElementById('inp_idotrosingresos').value= ''
	document.getElementById('inp_idcobradoa_oi').value= ''
	document.getElementById('inp_cedula_cobradoa_oi').value= ''
	document.getElementById('inp_nombres_cobradoa_oi').value= ''
	document.getElementById('inp_idcobrador_oi').value= ''
	document.getElementById('inp_cedula_cobrador_oi').value= ''
	document.getElementById('inp_cobrador_oi').value= ''
	document.getElementById('inp_idconcepto_oi').value= ''
	document.getElementById('inp_concepto_oi').value= ''
	document.getElementById('inp_detalle_oi').value= ''
	document.getElementById('inp_monto_oi').value= ''
	document.getElementById('btn_guardar_otrosingresos').innerHTML = "<p style='display:none;' id='accion_guardar_otrosingresos'>guardar</p>CARGAR";
}

//busccar datos otrosingresos
function buscar_datos_otrosingresos() {
	var buscador = document.getElementById('inpt_buscador_otrosingresos').value
	var caja_cod = document.getElementById('usuario_idcaja').innerHTML;
	document.getElementById("cnt_listado_historial_otrosingresos").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"caja_cod": caja_cod,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmotrosingresos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_historial_otrosingresos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_historial_otrosingresos").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("cnt_listado_historial_otrosingresos").innerHTML = datos_buscados
					document.getElementById("lbltotalhistorialpago_cuotas_clientes").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}


/*AÑADIR O MODIFICAR NUEVO CONCEPTOS*/
function add_datos_conceptos(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idconceptos').value
	var conceptos = document.getElementById('inp_conceptos').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;


	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_conceptos"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_conceptos"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("conceptos", conceptos)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmconceptos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
		
			ver_cerrar_ventana_cargando("ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_conceptos1();
					buscar_datos_conceptos("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
					limpiar_campos_conceptos1();
					buscar_datos_conceptos("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
					limpiar_campos_conceptos1();
					buscar_datos_conceptos("ACTIVO");
				}

			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				//limpiar_campos_conceptos();
			}
		}
	});


}

function limpiar_campos_conceptos1() {
	
    document.getElementById('inp_idconceptos').value= ''
	document.getElementById('inp_conceptos').value= ''
	
	document.getElementById('btn_guardar_conceptos').innerHTML = "<p style='display:none;' id='accion_guardar_conceptos'>guardar</p>GUARDAR";
	
}

var estado_conceptos = 'ACTIVO';
function buscar_por_opciones_conceptos(d) {
	if (d == "1") {
		estado_conceptos = 'ACTIVO';
		buscar_datos_conceptos(estado_conceptos);
		abrir_cerrar_ventanas_conceptos("6");
	}
	if (d == "2") {
		estado_conceptos = 'ELIMINADO';
		buscar_datos_conceptos(estado_conceptos);
		abrir_cerrar_ventanas_conceptos("6");
	}

}

//busccar datos conceptos
function buscar_datos_conceptos(buscar2) {
	var buscador = document.getElementById('inpt_buscador_conceptos').value
	document.getElementById("cnt_listado_conceptos").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmconceptos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_conceptos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_conceptos").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_conceptos").innerHTML = datos_buscados
					document.getElementById("lbltotalconceptos").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function buscarconceptos_combo() {
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmconceptos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {

					document.getElementById('combo_idrol_df').innerHTML = datos[2]

				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function obtener_datos_conceptos(datospr) {
	document.getElementById('inp_idconceptos').value = $(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_conceptos').value = $(datospr).children('td[id="td_conceptos"]').html();
	document.getElementById('btn_guardar_conceptos').innerHTML = "<p style='display:none;' id='accion_guardar_conceptos'>editar</p>EDITAR";
	abrir_cerrar_ventanas_conceptos("4");
}

function buscar_detalles_historial_cobro_cuotas_cliente(nrofactura,nrorecibo){
	document.getElementById('cnt_listado_detalles_historialpago_cuotas_clientes').innerHTML = "";
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func" , "buscar_mas_detalles_historial_cobros_cuotas_clientes")
	datos.append("nrofactura" ,nrofactura)
	datos.append("nrorecibo" ,nrorecibo)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmPagosCuotasClientes.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('cnt_listado_detalles_historialpago_cuotas_clientes').innerHTML = datos[2]
					document.getElementById('inp_cant_dhpcuota_p').value = datos[3]
					document.getElementById('inp_fecha_dhcobros_c').value = datos[4]
					document.getElementById('inp_hora_dhcobros_c').value = datos[5]
					document.getElementById('inp_sucursal_dhcobros_c').value = datos[6]
					document.getElementById('inp_caja_dhcobros_c').value = datos[7]
					document.getElementById('inp_recibidopor_dhcobros_c').value = datos[8]
					document.getElementById('inp_totalmonto_dhpcobros_c').value = datos[9]
					document.getElementById('inp_totalinteres_dhpcobros_c').value = datos[10]
					document.getElementById('inp_totaldescuento_dhpcobros_c').value = datos[11]
					var total1=datos[9].toString().replace(/\./g,'');
					var total2=datos[10].toString().replace(/\./g,'');
					var resut=parseInt(total1)+parseInt(total2);
					document.getElementById('inp_totalcbrado_dhpcobros_c').value = format_con_puntos_decimales(resut);
                    document.getElementById('capa_informativa').style.display='none';
					document.getElementById('div_principal_info_carga').style.display='none';
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}
function buscar_historial_cobro_cuotas_cliente(){
var nrofactura=document.getElementById('inp_nrofactura_hcobros_c').value
	document.getElementById('cnt_listado_historialpago_cuotas_clientes').innerHTML = "";
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func" , "buscar_historial_cobros_cuotas_clientes")
	datos.append("nrofactura" ,nrofactura)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmPagosCuotasClientes.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('cnt_listado_historialpago_cuotas_clientes').innerHTML = datos[2]
					document.getElementById('lbltotalcuotasclientes').innerHTML = "Catidad: "+datos[3]
                    document.getElementById('capa_informativa').style.display='none';
					document.getElementById('div_principal_info_carga').style.display='none';
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}
function validar_campo_total_a_entregar(){
	var totalapagar=document.getElementById("inp_totalapagar_pcobros_c").value
	var totalentregar=document.getElementById("inp_totalaentregar_pcobros_c").value
 if (totalentregar== '') {
      ver_cerrar_ventana_cargando("2","FALTO COMPLETAR MONTO ENTREGA");
  
	  return false;
	}else if(parseInt(totalentregar)>parseInt(totalapagar)){
	  ver_cerrar_ventana_cargando("2","EL MONTO A ENTREGAR NO PUEDE SER MAYOR AL MONTO A PAGAR");
	  return false;
	}
}

/*AÑADIR O MODIFICAR NUEVO CUOTEROS*/
function add_datos_cobros() {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var ventas_cod = document.getElementById('inp_codventas_pcobros_c').value;
	var montopagado1 = document.getElementById('inp_totalaentregar_pcobros_c').value
	var montopagado=montopagado1.toString().replace(/\./g,'');
	var fechapago = document.getElementById('inp_fecha_pcobros_c').value
	var caja_cod = document.getElementById('usuario_idcaja').innerHTML;
	var nrocomprobante = document.getElementById('inp_nrocomprobante_pcobros_c').value
	var sucursales_cod = document.getElementById('usuario_idsucursal').innerHTML;
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
    var accion="guardar";
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func", "cargarpagos")
	datos.append("hora", hora)
	datos.append("ventas_cod", ventas_cod)
	datos.append("montopagado", montopagado)
	datos.append("fechapago", fechapago)
	datos.append("caja_cod", caja_cod)
	datos.append("nrocomprobante", nrocomprobante)
	datos.append("sucursales_cod", sucursales_cod)
	datos.append("usuarios_cod", usuarios_cod)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmPagosCuotasClientes.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");	
				return false;
			}
			if (Respuesta == "exito") {
			document.getElementById('div_principal_info_carga').style.display='none';
            document.getElementById('btn_finalizarcobro_1').style.display='none'
            document.getElementById('btn_cancelar_cobro').style.display='none'
            document.getElementById('btn_cancelar_cobro1').style.display=''
             var nrocomprobante = document.getElementById('inp_nrocomprobante_pcobros_c').value
   
var monto=QuitarSeparadorMilValor(document.getElementById('inp_totalaentregar_pcobros_c').value);
            cargarreporterecibo(nrocomprobante,monto);
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
			}
		}
	});


}

function anular_cobros_cuotas_clientes(nrocomprobanted){
  
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func", "anular_pagos")
	datos.append("nrocomprobante", nrocomprobanted.toString())
	datos.append("clavepermisoanulacion", id_clave_permiso)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmPagosCuotasClientes.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");	
				return false;
			}
			if (Respuesta == "exito") {
             buscar_historial_cobro_cuotas_cliente();
            document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
			}
		}
	});


}


function anular_otrosingresos(nrocomprobanted){
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func", "anular_otrosingresos")
	datos.append("nrocomprobante", nrocomprobanted.toString())
	datos.append("clavepermisoanulacion", id_clave_permiso)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmotrosingresos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");	
				return false;
			}
			if (Respuesta == "exito") {
             buscar_datos_otrosingresos();
            document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
			}
		}
	});


}

function anular_otrosegresos(nrocomprobanted){
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func", "anular_otrosegresos")
	datos.append("nrocomprobante", nrocomprobanted.toString())
	datos.append("clavepermisoanulacion", id_clave_permiso)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmotrosegresos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");	
				return false;
			}
			if (Respuesta == "exito") {
             buscar_datos_otrosegresos();
            document.getElementById('capa_permiso').style.display='none';
            document.getElementById('capa_permiso').innerHTML="";
		    document.getElementById('div_principal_info_carga').style.display='none';
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
			}
		}
	});


}


function cargar_descuento_pagos_clientes(){
	
	var decuentoinicial=datosprmonto_cob.toString().replace(/\./g,'');
	var decuentofinal1=document.getElementById('div_descuento_'+datosprcod_cob+'').value;
	var decuentofinal=decuentofinal1.toString().replace(/\./g,'');

	if(parseInt(decuentofinal)>parseInt(decuentoinicial)){
		ver_vetana_informativa("DESCUENTO SOBRE PASA AL MONTO TOT. VENC.", id_progreso);
		return;
	}
	var datos = new FormData();
	datos.append("func" , "cargar_decuento_cuotero")
	datos.append("cod1" ,datosprcod_cob)
	datos.append("decuento1" ,decuentofinal)
	datos.append("cod_permiso" ,id_clave_permiso)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/Creditos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				if (datos == "exito") {
					buscar_pagos_cuotas_del_cliente();
                    id_clave_permiso="";
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
id_clave_permiso="";
				}
			   } catch (error) {
				buscar_pagos_cuotas_del_cliente();
id_clave_permiso="";
			}
		}
	});
}


function buscar_pagos_cuotas_del_cliente(){
 var ventas_cod = document.getElementById('inp_codventas_pcobros_c').value;
 var  limit= document.getElementById('inp_cantcuotas_pcobros_c').value;
  if(limit==""){
			return false;
  }
	document.getElementById('cnt_listado_pagoscuotasclientes').innerHTML = "";
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func" , "buscar_cantidad_cuota_a_pagar_clientes")
	datos.append("ventas_cod" ,ventas_cod)
	datos.append("limit" ,limit)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmPagosCuotasClientes.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('cnt_listado_pagoscuotasclientes').innerHTML = datos[2]
					document.getElementById('inp_cant_cuota_p').value = datos[3]
				     var rezx=datos[4].toString().replace(/\./g,'');
                     if(parseInt(rezx)<1000000){

					  var datosconpuntos=datos[4].split(".");
                      var dap=datosconpuntos[0]
					
                      var ddp=datosconpuntos[1];
					 
					  var result=0;
					  if(parseInt(ddp)>0 && parseInt(ddp)<500){
						 result=500;
					  }else if(parseInt(ddp)>500 && parseInt(ddp)<1000){
						 result=1000; 
					  }
					  var datosz=parseInt(dap+"000")+result;
                       document.getElementById('inp_totalapagar_pcobros_c').value = format_con_puntos_decimales(datosz);
					  
                      }
                       
                      else if(parseInt(rezx)>=1000000){
                      var datosconpuntos1=datos[4].split(".");
                      var dap1=datosconpuntos1[0]
                      var dmp1=datosconpuntos1[1];
                      var ddp1=datosconpuntos1[2];
					 
					  var result1=0;
					  if(parseInt(ddp1)>0 && parseInt(ddp1)<500){
						 result1=500;
					  }else if(parseInt(ddp1)>500 && parseInt(ddp1)<1000){
						 result1=1000; 
					  }
					  var datosz1=parseInt(dap1+dmp1+"000")+result1;
                        document.getElementById('inp_totalapagar_pcobros_c').value = format_con_puntos_decimales(datosz1);
					 
                      }
					
					
				      
				     document.getElementById('inp_totalaentregar_pcobros_c').value = datos[4];
					document.getElementById('inp_totaldescuento_pcobros_c').value = datos[5]
					document.getElementById('inp_totalimporte_pcobros_c').value = datos[6]
					document.getElementById('inp_totalinteres_pcobros_c').value = datos[7]
					document.getElementById('cant_ints').innerHTML = datos[8]
				
				    document.getElementById('capa_informativa').style.display='none';
					document.getElementById('div_principal_info_carga').style.display='none';
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}


function buscar_cuotas_del_cliente(ventas_cod){
	document.getElementById('cnt_listado_cuotasclientes').innerHTML = "";
	ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func" , "buscar_detalles_cuoteros_Clientes")
	datos.append("ventas_cod" ,ventas_cod)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmPagosCuotasClientes.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('cnt_listado_cuotasclientes').innerHTML = datos["2"]
					document.getElementById('lbltotalcuotasclientes').innerHTML = "TOTAL CUOTA: "+datos["3"]
					document.getElementById('lbltotalcuotaspendienteclientes').innerHTML = " - CUOTA PENDIENTE: "+datos["4"]
					document.getElementById('lbltotalcuotaspagadasclientes').innerHTML = " - CUOTA PAGADA: "+datos["5"]
					document.getElementById('inp_nrofactura_cobros_c').value = datos[8]
					document.getElementById('inp_clientes_cedula_cobros_c').value = datos[6]
					document.getElementById('inp_codclientes_cobros_c').value = datos[10]
					document.getElementById('inp_clientes_nombres_cobros_c').value = datos[7]
					document.getElementById('inp_fecha_cobros_c').value = datos[9];
					document.getElementById('inp_cedula_pcobros_c').value = datos[6];
					document.getElementById('inp_clientes_nombres_pcobros_c').value = datos[7];
					document.getElementById('inp_codcobrador_pcobros_c').value = datos[11];
					document.getElementById('inp_cobrador_nombres_pcobros_c').value = datos[12];
					document.getElementById('inp_factura_pcobros_c').value = datos[8];
					document.getElementById('inp_codventas_pcobros_c').value = datos[13];
				    document.getElementById('capa_informativa').style.display='none';
					document.getElementById('div_principal_info_carga').style.display='none';
				} else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				
			}
		}
	});
}

function obtener_monto_en_caja(){
	 var caja = document.getElementById('usuario_idcaja').innerHTML;
	var datos = new FormData();
	datos.append("func" , "obtener_monto_en_caja")
	datos.append("cod", caja)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmAperturaCaja.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
                    var resultado=parseInt(datos["2"])-parseInt(monto_de);
                 
                    var caja = document.getElementById('usuario_idcaja').innerHTML;
                    if(caja!=""){
                     if(resultado<0){
                       ver_cerrar_ventana_cargando("2","CAJA INSUFICIENTE Gs."+format_con_puntos_decimales(datos["2"])+" EN CAJA");
                       return false;		
                    }else if(resultado>=0){
                     DesembolsarSolicitud(caja,monto_de,);
                    }
                    }else{
                    ver_vetana_eliminar("CAJA CERRADA.. ¿DESEAS ABRIR CAJA?",id_progreso,"29");
                    }
				}
				else {
                   ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR...!");					
				}
			   } catch (error) {
				 ver_cerrar_ventana_cargando("2","FATAL ERROR...!");	
			}
		}
	});
}
//busccar datos desembolso caja
function buscar_datos_desembolso_caja(estado) {
	var buscador = document.getElementById('inpt_buscador_caja').value
	document.getElementById("cnt_listado_caja").innerHTML = ""
	var datos = {
		"buscador": buscador,
		"func": "buscar_mis_solicitudes_desembolso",
		"estado": estado
	};
	$.ajax({
		data: datos, url: "./php/Solicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_creditos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_caja").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_caja").innerHTML = datos_buscados
					document.getElementById("lbltotalcaja").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

/*buscar Sucursal*/
function obtener_sucurales_usuarios(){
var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var datos = new FormData();
	datos.append("func" , "buscarsucuesales")
	datos.append("usuarios_cod", usuarios_cod)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmSucursales.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
                    buscardatoscaja_combo(datos[2]);
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

//obtener datOS INTERES POR DIA TASAANUAL DIAS DE GRACIA
function obtenerdatos_interes_tasaanual_dias_gracia(){
    var datos = {
		"func": "obtener_tasaanual_interespormora"
	};
	$.ajax({
		data: datos, url: "./php/abmAjustesInteres.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

		},
		success: function (responseText) {

			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					document.getElementById("inp_tasaanual_desembolso").value = datos["1"];
					document.getElementById("inp_interesmora_desembolso").value = datos["2"];
					document.getElementById("inp_diasdegracia_desembolso").value = datos["3"];
					fechamenctrol=datos["4"];
					fechaquincctrol=datos["5"];
					fechasemanctrol=datos["6"];
					fechadiarioctrol=datos["7"];
				} catch (error) {

				}

			}
		}
	});


}

function validar_fec_nac(){
	 var fechanac=document.getElementById('inp_fechanac_dp').value;
 if(parseInt(calcularEdad(fechanac))<=17){
	 ver_vetana_informativa("SISTEMA NO ADMITE MENORES DE 18 AÑOS", id_progreso);
	 document.getElementById('inp_fechanac_dp').value="";
     return;	 
   } 
   if(parseInt(calcularEdad(fechanac))>=66){
	   ver_vetana_validar_fecha("CLIENTE SUPERA LOS 65 AÑOS ¿DESEAS ADMITIR?",id_progreso,"1");
   } 

}

function calcular_fecha_ingreso(e){
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
   var mes1 = fecha.getMonth()+2; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10){
    dia='0'+dia;
  }	//agrega cero si el menor de 10
  if(mes<10){
    mes='0'+mes
  }
  if(mes1<10){
    mes1='0'+mes1
  }  //agrega cero si el menor de 10
  var fechaactual=ano+"-"+mes+"-"+dia
    var fechaseleccionada=e.target.value;
	var fecha1 = moment(fechaactual);
	var fecha2 = moment(fechaseleccionada);
	var resultado=(fecha2.diff(fecha1, 'days'));

	var condicion = document.getElementById('inp_condision_desembolso').value
	
	if(condicion=="DIAS"){
	
		if(resultado>fechadiarioctrol){
			ver_cerrar_ventana_cargando("2","PRIMER VTO. NO PUEDE SER MAYOR A " +fechadiarioctrol+ " DIAS");
			document.getElementById('inp_primerpago_desembolso').value="";
		}
		if(resultado<0){
			ver_cerrar_ventana_cargando("2","PRIMER VTO. NO PUEDE SER ANTES DE LA FECHA DE DESEMBOLSO");
			document.getElementById('inp_primerpago_desembolso').value="";
		}
	}
	if(condicion=="SEMANAL"){
		if(resultado>fechasemanctrol){
			ver_cerrar_ventana_cargando("2","PRIMER VTO. NO PUEDE SER MAYOR A " +fechasemanctrol+ " DIAS");
			document.getElementById('inp_primerpago_desembolso').value="";
		}
		if(resultado<0){
			ver_cerrar_ventana_cargando("2","PRIMER VTO. NO PUEDE SER ANTES DE LA FECHA DE DESEMBOLSO");
			document.getElementById('inp_primerpago_desembolso').value="";
		}
	}
	if(condicion=="QUINCENAL"){
		if(resultado>fechaquincctrol){
			ver_cerrar_ventana_cargando("2","PRIMER VTO. NO PUEDE SER MAYOR A " +fechaquincctrol+ " DIAS");
			document.getElementById('inp_primerpago_desembolso').value="";
		}
		if(resultado<0){
			ver_cerrar_ventana_cargando("2","PRIMER VTO. NO PUEDE SER ANTES DE LA FECHA DE DESEMBOLSO");
			document.getElementById('inp_primerpago_desembolso').value="";
		}
	}
	if(condicion=="MENSUAL"){
		if(resultado>fechamenctrol){
			ver_cerrar_ventana_cargando("2","PRIMER VTO. NO PUEDE SER MAYOR A " +fechamenctrol+ " DIAS");
			document.getElementById('inp_primerpago_desembolso').value="";
		}
		if(resultado<0){
			ver_cerrar_ventana_cargando("2","PRIMER VTO. NO PUEDE SER ANTES DE LA FECHA DE DESEMBOLSO");
			document.getElementById('inp_primerpago_desembolso').value="";
		}
	}
	
}


var fechamenctrol=0;
var fechaquincctrol=0;
var fechasemanctrol=0;
var fechadiarioctrol=0;

//obtenernrofactura
function obtenernrofactura(){
	var sucursales_cod=document.getElementById("usuario_idsucursal").innerHTML;
	var datos = {
		"sucursales_cod": sucursales_cod,
		"func": "obtenernrofactura"
	};
	$.ajax({
		data: datos, url: "./php/abmAjustesFactura.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

		},
		success: function (responseText) {

			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("inp_nrofactura_desembolso").value = datos_buscados
				
				} catch (error) {

				}

			}
		}
	});
}

//obtenernrofactura
function obtenernro_comprobante(){
	var sucursales_cod=document.getElementById("usuario_idsucursal").innerHTML;
 
	var datos = {
		"sucursales_cod": sucursales_cod,
		"func": "obtener_nrocomprobante"
	};
	$.ajax({
		data: datos, url: "./php/abmAjustesFactura.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

		},
		success: function (responseText) {

			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("inp_nrocomprobante_pcobros_c").value = datos_buscados
				
				} catch (error) {

				}

			}
		}
	});
}

//obtenernrofactura
function obtenernro_recibo(){
	var sucursales_cod=document.getElementById("usuario_idsucursal").innerHTML;
 
	var datos = {
		"sucursales_cod": sucursales_cod,
		"func": "obtener_nrorecibo"
	};
	$.ajax({
		data: datos, url: "./php/abmAjustesFactura.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

		},
		success: function (responseText) {

			var Respuesta = responseText;
			//////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("inp_recibonro_oi").value = datos_buscados		
					document.getElementById("inp_recibonro_oe").value = datos_buscados		
				} catch (error) {
				}
			}
		}
	});
}



/*AÑADIR O MODIFICAR NUEVO APERTURA DE CAJA*/
function add_datos_aperturacaja(datos) {
	ver_cerrar_ventana_cargando("1");
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idaperturacaja').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var fechaapertura = document.getElementById('inp_fechaapertura_ac').value
	var datoscaja_cod = document.getElementById('combo_nrocaja_datoscaja').value
	var montoapertura1 = document.getElementById('inp_montoapertura_ac').value
	var montoapertura=montoapertura1.toString().replace(/\./g,'');

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_aperturacaja"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_aperturacaja"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando...");
	
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("fechaapertura", fechaapertura)
	datos.append("datoscaja_cod", datoscaja_cod)
	datos.append("montoapertura", montoapertura)
	datos.append("hora", hora)
	datos.append("horaapertura", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmAperturaCaja.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				
				return false;
			}
            if (Respuesta == "cajaabierta") {
                var cods = document.getElementById('combo_nrocaja_datoscaja').value
				obtener_datos_usuarios_caja_abierta(cods);
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				
			
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","APERTURA REALIZADO CORRECTAMENTE");
					limpiar_campos_aperturacaja();
					buscar_datos_aperturacaja();
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS CAJA ACTUALIZADO CORRECTAMENTE");
			
					limpiar_campos_aperturacaja();
					buscar_datos_aperturacaja();
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
				
					limpiar_campos_aperturacaja();
					buscar_datos_aperturacaja();
				}
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				
			
				//limpiar_campos_clientes();
			}
		}
	});


}

function limpiar_campos_aperturacaja(){
	document.getElementById('inp_idaperturacaja').value= ''
	document.getElementById('inp_montoapertura_ac').value= ''	
	document.getElementById('combo_nrocaja_datoscaja').value= ''	
	document.getElementById('btn_guardar_aperturacaja').innerHTML = "<p style='display:none;' id='accion_guardar_aperturacaja'>guardar</p>ABRIR CAJA";
}

//busccar datos aperturacaja
function buscar_datos_aperturacaja() {
	var buscador = document.getElementById('inpt_buscador_aperturacaja').value
var codusuario = document.getElementById('idusuarios_datos').innerHTML;
	document.getElementById("cnt_listado_aperturacaja").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"codusuario": codusuario,
		
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmAperturaCaja.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_aperturacaja").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			//console.log(Respuesta)
			document.getElementById("cnt_listado_aperturacaja").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_aperturacaja").innerHTML = datos_buscados
					document.getElementById("lbltotalaperturacaja").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_datos_aperturacaja(datospr) {

	document.getElementById('inp_idaperturacaja').value= $(datospr).children('td[id="td_cod"]').html();
	document.getElementById('combo_nrocaja_datoscaja').value= $(datospr).children('td[id="td_datoscaja"]').html();
	document.getElementById('inp_montoapertura_ac').value= $(datospr).children('td[id="td_montoapertura"]').html();
	document.getElementById('btn_guardar_aperturacaja').innerHTML = "<p style='display:none;' id='accion_guardar_aperturacaja'>editar</p>EDITAR";
	abrir_cerrar_ventanas_aperturacaja("4");
}

//busccar datos aperturacaja
function obtener_datos_usuarios_caja_abierta(datoscaja) {
	var datos = {
		"datoscaja": datoscaja,
		"func": "verificar_acaja_abierta"
	};
	$.ajax({
		data: datos, url: "./php/abmAperturaCaja.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

		
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   ver_cerrar_ventana_cargando("2",""+ datos["1"]);
			
					
				} catch (error) {

				}

			}
		}
	});
}


/*AÑADIR O MODIFICAR NUEVO APERTURA DE CAJA*/
function add_datos_datoscaja(datos) {
	ver_cerrar_ventana_cargando("1");
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_iddatoscaja').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var nombre = document.getElementById('inp_nombrecaja_ac').value
	var sucursales_cod = document.getElementById('combo_sucursal_datoscaja').value
	var nro = document.getElementById('inp_nro_ac').value
	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_datoscaja"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_datoscaja"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando...");
	
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("nombre", nombre)
	datos.append("sucursales_cod", sucursales_cod)
	datos.append("nro", nro)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmDatosCaja.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				
			
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_datoscaja();
					buscar_datos_datoscaja("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
			
					limpiar_campos_datoscaja();
					buscar_datos_datoscaja("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
				
					limpiar_campos_datoscaja();
					buscar_datos_datoscaja("ACTIVO");
				}
			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				
			
				//limpiar_campos_clientes();
			}
		}
	});


}

function limpiar_campos_datoscaja(){

	
	
	document.getElementById('inp_iddatoscaja').value= ''
	document.getElementById('inp_nombrecaja_ac').value= ''
	document.getElementById('inp_nro_ac').value= ''	
	document.getElementById('btn_guardar_datoscaja').innerHTML = "<p style='display:none;' id='accion_guardar_datoscaja'>guardar</p>GUARDAR";
}

var estado_datoscaja = 'ACTIVO';
function buscar_por_opciones_datoscaja(d) {
	if (d == "1") {
		estado_datoscaja = 'ACTIVO';
		buscar_datos_datoscaja(estado_datoscaja);
		abrir_cerrar_ventanas_datoscaja("6");
	}
     if (d == "2") {
		estado_datoscaja = 'ELIMINADO';
		buscar_datos_datoscaja(estado_datoscaja);
		abrir_cerrar_ventanas_datoscaja("6");
	}

}

//busccar datos datoscaja
function buscar_datos_datoscaja(buscar2) {
	var buscador = document.getElementById('inpt_buscador_datoscaja').value
	document.getElementById("cnt_listado_datoscaja").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmDatosCaja.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_datoscaja").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_datoscaja").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_datoscaja").innerHTML = datos_buscados
					document.getElementById("lbltotaldatoscaja").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_datos_datoscaja(datospr) {
	document.getElementById('inp_iddatoscaja').value= $(datospr).children('td[id="td_cod"]').html();
    document.getElementById('inp_nombrecaja_ac').value= $(datospr).children('td[id="td_nombre"]').html();
	document.getElementById('inp_nro_ac').value= $(datospr).children('td[id="td_nro"]').html();
	document.getElementById('combo_sucursal_datoscaja').value= $(datospr).children('td[id="td_sucursales_cod"]').html();
	document.getElementById('btn_guardar_datoscaja').innerHTML = "<p style='display:none;' id='accion_guardar_datoscaja'>editar</p>EDITAR";
	abrir_cerrar_ventanas_datoscaja("4");
}

/*buscar datos caja cpmbo*/
function buscardatoscaja_combo(cod) {
	var datos = new FormData();
	datos.append("func" , "buscarcombo");
    datos.append("cod", cod)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmDatosCaja.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('combo_nrocaja_datoscaja').innerHTML = datos[2]
					document.getElementById('inp_cajanro_planilla').innerHTML = datos[2]
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}


/*AÑADIR O MODIFICAR NUEVO AJUSTES INTERES*/
function add_datos_ajustesinteres(datos) {
	ver_cerrar_ventana_cargando("1");
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idajustesinteres').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var tasaanual = document.getElementById('inp_tasaanual_ai').value
	var vtomensual = document.getElementById('inp_vtomensual_ai').value
	var vtoquincenal = document.getElementById('inp_vtoquincenal_ai').value
	var vtosemanal = document.getElementById('inp_vtosemanal_ai').value
	var vtodiario = document.getElementById('inp_vtodiario_ai').value
	
	var interespormora = document.getElementById('inp_interespormora_ai').value
	var diasdegracia = document.getElementById('inp_diasdegracia_ai').value
	
	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_ajustesinteres"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_ajustesinteres"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando...");
	
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("tasaanual", tasaanual)
	datos.append("vtomensual", vtomensual)
	datos.append("vtoquincenal", vtoquincenal)
	datos.append("vtosemanal", vtosemanal)
	datos.append("vtodiario", vtodiario)
	datos.append("interespormora", interespormora)
	datos.append("diasdegracia", diasdegracia)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmAjustesInteres.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				
			
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_ajustesinteres();
					buscar_datos_ajustesinteres("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
			
					limpiar_campos_ajustesinteres();
					buscar_datos_ajustesinteres("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
				
					limpiar_campos_ajustesinteres();
					buscar_datos_ajustesinteres("ACTIVO");
				}

			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				
			
				//limpiar_campos_clientes();
			}
		}
	});


}

function limpiar_campos_ajustesinteres() {
	document.getElementById('inp_idajustesinteres').value= ''
    document.getElementById('inp_tasaanual_ai').value= ''
	document.getElementById('inp_interespormora_ai').value= ''
	document.getElementById('inp_diasdegracia_ai').value= ''
	document.getElementById('inp_vtomensual_ai').value= ''
	document.getElementById('inp_vtoquincenal_ai').value= ''
	document.getElementById('inp_vtosemanal_ai').value= ''
	document.getElementById('inp_vtodiario_ai').value= ''
	document.getElementById('btn_guardar_ajustesinteres').innerHTML = "<p style='display:none;' id='accion_guardar_ajustesinteres'>guardar</p>GUARDAR";
}

var estado_ajustesinteres = 'ACTIVO';
function buscar_por_opciones_ajustesinteres(d) {
	if (d == "1") {
		estado_ajustesinteres = 'ACTIVO';
		buscar_datos_ajustesinteres(estado_ajustesinteres);
		abrir_cerrar_ventanas_ajustesinteres("6");
	}
	if (d == "2") {
		estado_ajustesinteres = 'ELIMINADO';
		buscar_datos_ajustesinteres(estado_ajustesinteres);
		abrir_cerrar_ventanas_ajustesinteres("6");
	}

}

//busccar datos ajustesinteres
function buscar_datos_ajustesinteres(buscar2) {
	
var buscador = document.getElementById('inpt_buscador_ajustesinteres').value
	document.getElementById("cnt_listado_ajustesinteres").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmAjustesInteres.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_ajustesinteres").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_ajustesinteres").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_ajustesinteres").innerHTML = datos_buscados
					document.getElementById("lbltotalajustesinteres").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_datos_ajustesinteres(datospr) {
	document.getElementById('inp_idajustesinteres').value= $(datospr).children('td[id="td_cod"]').html();
    document.getElementById('inp_tasaanual_ai').value= $(datospr).children('td[id="td_tasaanual"]').html();
	document.getElementById('inp_vtomensual_ai').value= $(datospr).children('td[id="td_vtomensual"]').html();
	document.getElementById('inp_vtoquincenal_ai').value= $(datospr).children('td[id="td_vtoquincenal"]').html();
	document.getElementById('inp_vtosemanal_ai').value= $(datospr).children('td[id="td_vtosemanal"]').html();
	document.getElementById('inp_vtodiario_ai').value= $(datospr).children('td[id="td_vtodiario"]').html();
	document.getElementById('inp_interespormora_ai').value= $(datospr).children('td[id="td_interespormora"]').html();
	document.getElementById('inp_diasdegracia_ai').value= $(datospr).children('td[id="td_diasdegracia"]').html();
	document.getElementById('btn_guardar_ajustesinteres').innerHTML = "<p style='display:none;' id='accion_guardar_ajustesinteres'>editar</p>EDITAR";
	abrir_cerrar_ventanas_ajustesinteres("4");
}





/*AÑADIR O MODIFICAR NUEVO AJUSTES FACTURA*/
function add_datos_ajustesfactura(datos) {
	ver_cerrar_ventana_cargando("1");
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idajustesfactura').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var timbrado = document.getElementById('inp_timbrado_af').value
	var ruc = document.getElementById('inp_ruc_af').value
	var iniciovigencia = document.getElementById('inp_iniciovigencia_af').value
	var finvigencia = document.getElementById('inp_finvigencia_af').value
	var nrofactura = document.getElementById('inp_factura_af').value
	var titular = document.getElementById('inp_titular_af').value
	var actividades = document.getElementById('inp_actividades_af').value
	var direccion = document.getElementById('inp_direccion_af').value
	var telefono = document.getElementById('inp_telefono_af').value
	var ciudad = document.getElementById('inp_ciudad_af').value

	

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_ajustesfactura"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_ajustesfactura"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando...");
	
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("timbrado", timbrado)
	datos.append("ruc", ruc)
	datos.append("iniciovigencia", iniciovigencia)
	datos.append("finvigencia", finvigencia)
	datos.append("nrofactura", nrofactura)
	datos.append("titular", titular)
	datos.append("actividades", actividades)
	datos.append("direccion", direccion)
	datos.append("telefono", telefono)
	datos.append("ciudad", ciudad)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmAjustesFactura.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				
			
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_ajustesfactura();
					buscar_datos_ajustesfactura("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
			
					limpiar_campos_ajustesfactura();
					buscar_datos_ajustesfactura("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
				
					limpiar_campos_ajustesfactura();
					buscar_datos_ajustesfactura("ACTIVO");
				}

			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				
			
				//limpiar_campos_clientes();
			}
		}
	});


}

function limpiar_campos_ajustesfactura() {
	document.getElementById('inp_idajustesfactura').value= ''
    document.getElementById('inp_timbrado_af').value= ''
	document.getElementById('inp_ruc_af').value= ''
	document.getElementById('inp_iniciovigencia_af').value= ''
	document.getElementById('inp_finvigencia_af').value= ''
	document.getElementById('inp_factura_af').value= ''
	document.getElementById('inp_titular_af').value= ''
	document.getElementById('inp_actividades_af').value= ''
	document.getElementById('inp_direccion_af').value= ''
	document.getElementById('inp_telefono_af').value= ''
	document.getElementById('inp_ciudad_af').value= ''
	document.getElementById('btn_guardar_ajustesfactura').innerHTML = "<p style='display:none;' id='accion_guardar_ajustesfactura'>guardar</p>GUARDAR";
}

var estado_ajustesfactura = 'ACTIVO';
function buscar_por_opciones_ajustesfactura(d) {
	if (d == "1") {
		estado_ajustesfactura = 'ACTIVO';
		buscar_datos_ajustesfactura(estado_ajustesfactura);
		abrir_cerrar_ventanas_ajustesfactura("6");
	}
	if (d == "2") {
		estado_ajustesfactura = 'ELIMINADO';
		buscar_datos_ajustesfactura(estado_ajustesfactura);
		abrir_cerrar_ventanas_ajustesfactura("6");
	}

}

//busccar datos ajustesfactura
function buscar_datos_ajustesfactura(buscar2) {
	var buscador = document.getElementById('inpt_buscador_ajustesfactura').value
	document.getElementById("cnt_listado_ajustesfactura").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmajustesfactura.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_ajustesfactura").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_ajustesfactura").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_ajustesfactura").innerHTML = datos_buscados
					document.getElementById("lbltotalajustesfactura").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_datos_ajustesfactura(datospr) {
		document.getElementById('inp_idajustesfactura').value= $(datospr).children('td[id="td_cod"]').html();
    document.getElementById('inp_timbrado_af').value= $(datospr).children('td[id="td_timbrado"]').html();
	document.getElementById('inp_ruc_af').value= $(datospr).children('td[id="td_ruc"]').html();
	document.getElementById('inp_iniciovigencia_af').value= $(datospr).children('td[id="td_iniciovigencia"]').html();
	document.getElementById('inp_finvigencia_af').value= $(datospr).children('td[id="td_finvigencia"]').html();
	document.getElementById('inp_factura_af').value= $(datospr).children('td[id="td_nrofactura"]').html();
	document.getElementById('inp_titular_af').value=$(datospr).children('td[id="td_titular"]').html();
	document.getElementById('inp_actividades_af').value= $(datospr).children('td[id="td_actividades"]').html();
	document.getElementById('inp_direccion_af').value= $(datospr).children('td[id="td_direccion"]').html();
	document.getElementById('inp_telefono_af').value= $(datospr).children('td[id="td_telefono"]').html();
	document.getElementById('inp_ciudad_af').value= $(datospr).children('td[id="td_ciudad"]').html();
	document.getElementById('btn_guardar_ajustesfactura').innerHTML = "<p style='display:none;' id='accion_guardar_ajustesfactura'>editar</p>EDITAR";
	abrir_cerrar_ventanas_ajustesfactura("4");
}

//GUARDAR VENTAS Y DETALLES VENTAS
/*AÑADIR O MODIFICAR NUEVO CUOTEROS*/
function add_datos_ventas(datos) {
	validar_campos_ventas();
	ver_cerrar_ventana_cargando("1");
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_cod_desembolso').value
	var codigosolicitud = document.getElementById('inp_codsolicitud_desembolso').value
	var clientes_cod = document.getElementById('inp_codclientes_desembolso').value
	var nrosolicitud = document.getElementById('inp_nrosolicitud_desembolso').value
	var nrofactura = document.getElementById('inp_nrofactura_desembolso').value
	var tipooperacion = document.getElementById('inp_tipooperacion_desembolso').value
	var tipointeres = document.getElementById('inp_tipointeres_desembolso').value
	var fecha_ent_cobrador = document.getElementById('inp_fechacobrador_desembolso').value
	var condicion = document.getElementById('inp_condision_desembolso').value
	var moneda = document.getElementById('inp_moneda_desembolso').value
	var plazo = document.getElementById('inp_cantidadcuota_desembolso').value
	var tasaanual = document.getElementById('inp_tasaanual_desembolso').value
	var fechapago = document.getElementById('inp_primerpago_desembolso').value
	var impuesto1 = document.getElementById('inp_impuestos_desembolso').value
	var sistema = document.getElementById('inp_sistema_desembolso').value
	var impuesto=impuesto1.toString().replace(/\./g,'');
	var vendedor_cod = document.getElementById('inp_codvendedor_desembolso').value
	var cobrador_cod = document.getElementById('inp_cobrador_desembolso').value
	var sucursales_cod = document.getElementById('inp_codsucursal_desembolso').value
	var montocuota1 = document.getElementById('inp_montocuota_desembolso').value
    var montocuota=montocuota1.toString().replace(/\./g,'');
	var interesfinanciero1 = document.getElementById('inp_totalintfinan_desembolso').value
	var porcentaje_interesfinanciero = document.getElementById('inp_int_financiero_desembolso').value
    var interesfinancierox=interesfinanciero1.toString().replace(/\./g,'');
    var interesfinanciero = parseInt(interesfinancierox)/parseInt(plazo);
	 var t_interesfinanciero=interesfinanciero*porcentaje_interesfinanciero/100;
	 var gastosadministrativos=interesfinanciero-t_interesfinanciero;
	var interes = document.getElementById('inp_interesmora_desembolso').value
	var amortizacion1 = document.getElementById('inp_totalamortiz_desembolso').value
	var diasdegracia = document.getElementById('inp_diasdegracia_desembolso').value
    var amortizacionx=amortizacion1.toString().replace(/\./g,'');
    var amortizacion = parseInt(amortizacionx)/parseInt(plazo);
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var monto1 = document.getElementById('inp_montoprestado_desembolso').value
	var monto=monto1.toString().replace(/\./g,'');
    var accion="guardar";
	ver_cerrar_ventana_cargando("1","Cargando...");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("hora", hora)
	datos.append("cod", cod)
	datos.append("clientes_cod", clientes_cod)
	datos.append("codigosolicitud", codigosolicitud)
	datos.append("nrosolicitud", nrosolicitud)
	datos.append("tipooperacion", tipooperacion)
	datos.append("tipointeres", tipointeres)
	datos.append("fecha_ent_cobrador", fecha_ent_cobrador)
	datos.append("condicion", condicion)
	datos.append("moneda", moneda)
	datos.append("plazo", plazo)
	datos.append("tasaanual", tasaanual)
	datos.append("fechapago", fechapago)
	datos.append("impuesto", impuesto)
	datos.append("vendedor_cod", vendedor_cod)
	datos.append("cobrador_cod", cobrador_cod)
	datos.append("sucursales_cod", sucursales_cod)
	datos.append("montocuota", montocuota)
	datos.append("interesfinanciero", t_interesfinanciero)
	datos.append("gastosadministrativos", gastosadministrativos)
	datos.append("int_financ", porcentaje_interesfinanciero)
	datos.append("amortizacion", amortizacion)
	datos.append("monto", monto)
	datos.append("diasdegracia", diasdegracia)
	datos.append("interes", interes)
	datos.append("nrofactura", nrofactura)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("sistema", sistema)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/Creditos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				
			
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DOCUMENTOS GENERADOS CORRECTAMENTE");
                    var nrosolicitud = document.getElementById('inp_nrosolicitud_desembolso').value
					buscar_datos_Cuoteros(nrosolicitud);
	                buscar_datos_creditos();
                    document.getElementById('b_desembolsar_factura').style.display='';
                    document.getElementById('b_planprestamo').style.display='';
	                document.getElementById('b_desembolsar_recibo').style.display='';
	                document.getElementById('b_desembolsar').style.display='none';
					vaciar_campos_ventas();
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
			
					limpiar_campos_cuoteros();
					buscar_datos_cuoteros("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
				
					limpiar_campos_cuoteros();
					buscar_datos_cuoteros("ACTIVO");
				}

			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				
			
				//limpiar_campos_clientes();
			}
		}
	});


}

function vaciar_campos_ventas(){

     document.getElementById('inp_cobrador_desembolso').value="";
     document.getElementById('inp_primerpago_desembolso').value="";
     document.getElementById('inp_fechacobrador_desembolso').value="";

 document.getElementById("inp_cobrador_desembolso").classList.remove('input_1_1_error');
    document.getElementById("inp_cobrador_desembolso").classList.add('input_1_1');
    
    document.getElementById("inp_primerpago_desembolso").classList.remove('input_1_1_error');
    document.getElementById("inp_primerpago_desembolso").classList.add('input_1_1');
    
    document.getElementById("inp_fechacobrador_desembolso").classList.remove('input_1_1_error');
    document.getElementById("inp_fechacobrador_desembolso").classList.add('input_1_1');
    		  
}

function validar_campos_ventas(){
	 if (document.getElementById("inp_cobrador_desembolso").value == '') {
    	document.getElementById("inp_cobrador_desembolso").classList.add('input_1_1_error');
        document.getElementById("inp_cobrador_desembolso").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cobrador_desembolso").classList.remove('input_1_1_error');
        document.getElementById("inp_cobrador_desembolso").classList.add('input_1_1');
	} 
	if (document.getElementById("inp_primerpago_desembolso").value == '') {
    	document.getElementById("inp_primerpago_desembolso").classList.add('input_1_1_error');
        document.getElementById("inp_primerpago_desembolso").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_primerpago_desembolso").classList.remove('input_1_1_error');
        document.getElementById("inp_primerpago_desembolso").classList.add('input_1_1');
	}
	if (document.getElementById("inp_fechacobrador_desembolso").value == '') {
    	document.getElementById("inp_fechacobrador_desembolso").classList.add('input_1_1_error');
        document.getElementById("inp_fechacobrador_desembolso").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_fechacobrador_desembolso").classList.remove('input_1_1_error');
        document.getElementById("inp_fechacobrador_desembolso").classList.add('input_1_1');
	} 
	if (document.getElementById("inp_int_financiero_desembolso").value == '') {
    	document.getElementById("inp_int_financiero_desembolso").classList.add('input_1_1_error');
        document.getElementById("inp_int_financiero_desembolso").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_int_financiero_desembolso").classList.remove('input_1_1_error');
        document.getElementById("inp_int_financiero_desembolso").classList.add('input_1_1');
	} 
	
	var cobrador=document.getElementById('inp_cobrador_desembolso').value;
    var primerpago= document.getElementById('inp_primerpago_desembolso').value;
    var fechacobrador= document.getElementById('inp_fechacobrador_desembolso').value;
	 
	 if( cobrador=="" || primerpago=="" || fechacobrador=="" ){
    return;
   }
	
}

//busccar datos cuoteros
function buscar_datos_Cuoteros(cod){
	var datos = {
		"cod": cod,
		"func": "buscar_detalles_cuoteros"
	};
	$.ajax({
		data: datos, url: "./php/Creditos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_cuotas_prestamos").innerHTML = ''
		},
		success: function (responseText) {

			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_cuotas_prestamos").innerHTML = ''


			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("cnt_listado_cuotas_prestamos").innerHTML = datos_buscados
					document.getElementById("lbltotal_prestamos").innerHTML="TOTAL CUOTA: "+datos["2"];
				} catch (error) {

				}

			}
		}
	});


}


//DESEMBOLSO BUSCAR DETALLES SOLICITUDES
function buscar_detalles_solicitudes_desembolso(cod){
	var datos = {
		"cod": cod,
		"func":"buscar_detalles_solicitudes"
	};
	$.ajax({
		data: datos, url: "./php/Creditos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {	
					var datos = $.parseJSON(Respuesta);
                    document.getElementById("inp_codsolicitud_desembolso").value=datos["1"];
					document.getElementById("inp_nrosolicitud_desembolso").value=datos["2"];
					document.getElementById("inp_codclientes_desembolso").value=datos["3"];
					document.getElementById("inp_clientes_cedula_desembolso").value=datos["4"];
					document.getElementById("inp_clientes_nombres_desembolso").value=datos["5"];
					document.getElementById("inp_codvendedor_desembolso").value=datos["11"];
					document.getElementById("inp_vendedor_desembolso").value=datos["12"];
					document.getElementById("inp_codsucursal_desembolso").value=datos["13"];
					document.getElementById("inp_sucursal_desembolso").value=datos["14"];
					document.getElementById("inp_montoprestado_desembolso").value=datos["9"];
					document.getElementById("inp_cantidadcuota_desembolso").value=datos["7"];
					document.getElementById("inp_condision_desembolso").value=datos["6"];
					document.getElementById("inp_montocuota_desembolso").value=datos["10"];	
					document.getElementById("inp_totalamortiz_desembolso").value=datos["9"];
                    document.getElementById('inp_totalcuota_desembolso').value=datos["15"];
                    document.getElementById('inp_totalintfinan_desembolso').value=datos["16"];
                    document.getElementById('inp_impuestos_desembolso').value=datos["17"];
                    document.getElementById('inp_entregar_desembolso').value=datos["18"];
                   
                   
					obtenerdatos_interes_tasaanual_dias_gracia();
				} catch (error) {

				}

			}
		}
	});
}


//DESEMBOLSO BUSCAR DETALLES VENTAS 
function buscar_detalles_ventas_desembolso(nrosolicitud){
	var datos = {
		"nrosolicitud":nrosolicitud,
		"func":"buscar_detalles_ventas"
	};
	$.ajax({
		data: datos, url: "./php/Creditos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {	
					var datos = $.parseJSON(Respuesta);
				
					document.getElementById("inp_fecha_desembolso").value=datos["2"];
					document.getElementById("inp_nrosolicitud_desembolso").value=datos["3"];
					document.getElementById("inp_condision_desembolso").value=datos["4"];
					document.getElementById("inp_tipooperacion_desembolso").value=datos["5"];
					document.getElementById("inp_nrofactura_desembolso").value=datos["6"];
					document.getElementById("inp_fechacobrador_desembolso").value=datos["7"];
					document.getElementById("inp_montoprestado_desembolso").value=datos["8"];
					document.getElementById("inp_totalamortiz_desembolso").value=datos["8"];
					document.getElementById("inp_totalintfinan_desembolso").value=datos["9"];
					document.getElementById("inp_totalcuota_desembolso").value=datos["10"];
					document.getElementById("inp_entregar_desembolso").value=datos["11"];
					document.getElementById("inp_impuestos_desembolso").value=datos["12"];
					document.getElementById("inp_codsucursal_desembolso").value=datos["13"];
					document.getElementById("inp_sucursal_desembolso").value=datos["14"];	
					document.getElementById("inp_moneda_desembolso").value=datos["15"];
                    document.getElementById('inp_codvendedor_desembolso').value=datos["16"];
                    document.getElementById('inp_vendedor_desembolso').value=datos["17"];
                    document.getElementById('inp_cobrador_desembolso').value=datos["18"];
                    document.getElementById('inp_interesmora_desembolso').value=datos["20"];
                    document.getElementById('inp_primerpago_desembolso').value=datos["21"];
                    document.getElementById('inp_tipointeres_desembolso').value=datos["22"];
                    document.getElementById('inp_tasaanual_desembolso').value=datos["23"];
                    document.getElementById('inp_codclientes_desembolso').value=datos["25"];
                    document.getElementById('inp_clientes_cedula_desembolso').value=datos["26"];
                    document.getElementById('inp_clientes_nombres_desembolso').value=datos["27"];
                    document.getElementById('inp_cantidadcuota_desembolso').value=datos["28"];
                    document.getElementById('inp_montocuota_desembolso').value=datos["29"];
                    document.getElementById('inp_diasdegracia_desembolso').value=datos["30"];
                    document.getElementById('inp_int_financiero_desembolso').value=datos["31"];
				} catch (error) {

				}

			}
		}
	});
}


//busccar detalles egresos
function buscar_detalles_Fotos_desembolso(cod){
	var datos = {
		"cod": cod,
		"func": "buscar_detalles_fotos_creditos"
	};
	$.ajax({
		data: datos, url: "./php/ObtenerDetallesSolicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					document.getElementById("etiqueta_fotos").innerHTML=datos["1"];
					 id=datos["2"]+1;
                     contador=datos["2"]+1;
				} catch (error) {

				}

			}
		}
	});
}

//busccar detalles egresos
function buscar_detalles_Archivos_desembolso(cod){
	var datos = {
		"cod": cod,
		"func": "buscar_detalles_archivos_creditos"
	};
	$.ajax({
		data: datos, url: "./php/ObtenerDetallesSolicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					document.getElementById("table_archivos").innerHTML=datos["1"];
				
					 id1=datos["2"]+1;
                     contador1=datos["2"]+1;
				} catch (error) {

				}

			}
		}
	});
}

//cargar multiples archivos
function CargarAdjustosArchivos() {
    var datos = new FormData();
	var control=1;
	var f = new Date();
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	datos.append("hora", hora)	
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	datos.append("usuarios_cod", usuarios_cod)
	$("tr[name=cnt_adjuntos_archivos]").each(function(i, elementohtml){
	
	var ext=$(elementohtml).children('td[id="td_extencion"]').html();
  
  datos.append("ext"+control, ext)
	
	var archivo=$(elementohtml).children('td[id="td_base64"]').html();
    datos.append("archivo"+control, archivo)	
	
	var nombre=$(elementohtml).children('td[id="td_nombre"]').html();
    datos.append("nombre"+control, nombre)
	
	var tamanho=$(elementohtml).children('td[id="td_tamanho"]').html();
    datos.append("tamanho"+control, tamanho)

	control=control+1;
	});
	control=control-1;

	datos.append("totalRegistro", control)
ver_cerrar_ventana_cargando("1","CARGANDO...");
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/CargarArchivo.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			verCerrarEfectoCargando("")
			ver_cerrar_ventana_cargando("2","ERROR DE CONECCIÓN")
			return false;
		},
		success: function (responseText) {
			verCerrarEfectoCargando("")
			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
				    var nrosolicitud=document.getElementById('inp_nrosolicitud').value;
				 ver_cerrar_ventana_cargando("2", titulo_guardado_solicitud+" NRO: "+nrosolicitud+" REGISTRADA...");
					limpiar_campos_solicitudescredito();
					abrir_cerrar_ventanas_solicitudescredito("2");
					buscar_datos_mis_solicitudes();
				}
				else {
					ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
				}
			} catch (error) {
				ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
			}
		}
	});
}
var titulo_guardado_solicitud="SOLICITUD";


//cargar multiples fotos
function CargarAdjustosFotograficos(){
    var datos = new FormData();
	var control=1;
	var f = new Date();
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	datos.append("hora", hora)	
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	datos.append("usuarios_cod", usuarios_cod)
	$("div[name=cnt_adjuntos_imagenes]").each(function(i, elementohtml){
	var ext=$(elementohtml).children('div[id="div_extension"]').html();
    datos.append("ext"+control, ext)
	var foto=$(elementohtml).children('div[id="div_base64"]').html();
    datos.append("foto"+control, foto)
	control=control+1;
	});
	control=control-1;
	datos.append("totalRegistro", control)
    ver_cerrar_ventana_cargando("1","CARGANDO...");
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/CargarFotos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			verCerrarEfectoCargando("")
			ver_cerrar_ventana_cargando("2","ERROR DE CONECCIÓN")
			return false;
		},
		success: function (responseText) {
			verCerrarEfectoCargando("")
			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
				  CargarAdjustosArchivos();  
				}
				else {
					ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")

				}
			} catch (error) {
				ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
			}
		}
	});
}

//busccar datos mis_solicitudes
function buscar_datos_mis_solicitudes() {
	var buscador = document.getElementById('inpt_buscador_mis_solicitudes').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	document.getElementById("cnt_listado_mis_solicitudes").innerHTML = ""
	var datos = {
		"buscador": buscador,
		"usuario": usuarios_cod,
		"func": "buscar_mis_solicitudes"
	};
	$.ajax({
		data: datos, url: "./php/Solicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_mis_solicitudes").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_mis_solicitudes").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_mis_solicitudes").innerHTML = datos_buscados
					document.getElementById("lbltotalmis_solicitudes").innerHTML="CANTIDAD: "+datos["2"];
					document.getElementById('efe_cargando4').style.display='none';
				} catch (error) {
				}
			}
		}
	});
}

//busccar datos CREDITOS
function buscar_datos_creditos() {
	var buscador = document.getElementById('inpt_buscador_creditos').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	document.getElementById("cnt_listado_creditos").innerHTML = ""
	var datos = {
		"buscador": buscador,
		"usuario": usuarios_cod,
		"func": "buscar_mis_solicitudes_creditos"
	};
	$.ajax({
		data: datos, url: "./php/Solicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_creditos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_creditos").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_creditos").innerHTML = datos_buscados
					document.getElementById("lbltotalcreditos").innerHTML="CANTIDAD: "+datos["2"];
					document.getElementById('efe_cargando3').style.display='none';
				} catch (error) {

				}

			}
		}
	});
}

//buscar detalles analisis
function buscar_detalles_analisis(cod){
	var datos = {
		"cod": cod,
		"func": "buscar_detalles_analisis"
	};
	$.ajax({
		data: datos, url: "./php/Analisis.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
	var datos = $.parseJSON(Respuesta);
	
    document.getElementById('inp_ventapromediodia').value=datos["2"];
	document.getElementById('inp_ventapromediosemana').value=datos["3"];
	document.getElementById('inp_ventapromedioquincena').value=datos["4"];
	document.getElementById('inp_ventapromediomes').value=datos["5"];
	document.getElementById('inp_salarioextrames').value=datos["6"];
	document.getElementById('inp_alquilercasa_analisis').value=datos["7"];
	document.getElementById('inp_alquilernegocio_analisis').value=datos["8"];
	document.getElementById('inp_cuatabanco_analisis').value=datos["9"];
	document.getElementById('inp_cuatafinanciera_analisis').value=datos["10"];
	document.getElementById('inp_cuatacooperativa_analisis').value=datos["11"];
	document.getElementById('inp_cuataelectrodomesticos_analisis').value=datos["12"];
	document.getElementById('inp_cuotausurero_analisis').value=datos["13"];
	document.getElementById('inp_cantidadhijo_analisis').value=datos["14"];
	document.getElementById('inp_condicionaprobado').value=datos["15"];
	document.getElementById('inp_observacion_aprobacionanalista_analisis').value=datos["19"];
	document.getElementById('inp_descripcion_vistamargen').value=datos["20"];
	document.getElementById('inp_porcentaje_vistamargen').value=datos["21"];
    document.getElementById('inp_montoaprobado').innerHTML="<option>"+datos["16"];+"</option>"
    document.getElementById('inp_plazoaprobado').innerHTML="<option>"+datos["17"];+"</option>"
    document.getElementById('inp_preciocuotaaprobado').innerHTML="<option>"+datos["18"];+"</option>"
			calcularanalisis();
				} catch (error) {

				}
			}
		}
	});
}

/*AÑADIR O MODIFICAR NUEVO ANALISIS*/
function add_datos_analisis(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var solicitudescreditos_cod = document.getElementById('inp_idsolicitudescredito_analisis').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var promediodia1 = document.getElementById('inp_ventapromediodia').value
	var promediodia=promediodia1.toString().replace(/\./g,'');
	var promediosemana1 = document.getElementById('inp_ventapromediosemana').value
	var promediosemana=promediosemana1.toString().replace(/\./g,'');
	var promedioquincena1 = document.getElementById('inp_ventapromedioquincena').value
	var promedioquincena=promedioquincena1.toString().replace(/\./g,'');
	var promediomes1 = document.getElementById('inp_ventapromediomes').value
	var promediomes=promediomes1.toString().replace(/\./g,'');
	var ingresosextras1 = document.getElementById('inp_salarioextrames').value
	var ingresosextras=ingresosextras1.toString().replace(/\./g,'');
	var alquilercasa1 = document.getElementById('inp_alquilercasa_analisis').value
	var alquilercasa=alquilercasa1.toString().replace(/\./g,'');
	var alquilernegocio1 = document.getElementById('inp_alquilernegocio_analisis').value
	var alquilernegocio=alquilernegocio1.toString().replace(/\./g,'');
	var cuotabanco1 = document.getElementById('inp_cuatabanco_analisis').value
	var cuotabanco=cuotabanco1.toString().replace(/\./g,'');
	var cuotafinanciera1 = document.getElementById('inp_cuatafinanciera_analisis').value
	var cuotafinanciera=cuotafinanciera1.toString().replace(/\./g,'');
	var cuotacooperativa1 = document.getElementById('inp_cuatacooperativa_analisis').value
	var cuotacooperativa=cuotacooperativa1.toString().replace(/\./g,'');
	var cuotaelectrodomesticos1 = document.getElementById('inp_cuataelectrodomesticos_analisis').value
	var cuotaelectrodomesticos=cuotaelectrodomesticos1.toString().replace(/\./g,'');
	var cuotausureros1 = document.getElementById('inp_cuotausurero_analisis').value
	var cuotausureros=cuotausureros1.toString().replace(/\./g,'');
	var canthijos = document.getElementById('inp_cantidadhijo_analisis').value
	var condicion = document.getElementById('inp_condicionaprobado').value
	var montoaprobado1 = document.getElementById('inp_montoaprobado').value
	var montoaprobado=montoaprobado1.toString().replace(/\./g,'');
	
	var combo = document.getElementById("inp_plazoaprobado");
    var plazo1 = combo.options[combo.selectedIndex].text;
	var plazo=plazo1.toString().replace(/\./g,'');
	var combo1 = document.getElementById("inp_preciocuotaaprobado");
    var cuota1 = combo1.options[combo1.selectedIndex].text;
	var cuota=cuota1.toString().replace(/\./g,'');
	var obsanalista = document.getElementById('inp_observacion_aprobacionanalista_analisis').value
	var descripcionmargen = document.getElementById('inp_descripcion_vistamargen').value
	var porcentajemargen = document.getElementById('inp_porcentaje_vistamargen').value;
	validar_campos_analisis();
    if( solicitudescreditos_cod=="" || promediodia=="" || promediosemana=="" || promedioquincena=="" || promediomes=="" || ingresosextras=="" || alquilercasa=="" || alquilernegocio=="" || cuotabanco=="" || cuotafinanciera=="" || cuotacooperativa=="" || cuotaelectrodomesticos=="" || cuotausureros=="" || condicion=="" || montoaprobado=="" || plazo=="" || cuota=="" || obsanalista=="" || descripcionmargen=="" || porcentajemargen==""){
    ver_vetana_informativa("FALTÓ COMPLETAR ALGUN CAMPO", id_progreso);
	return;
    }



	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_analisis"]').html() == 'guardar') {
		accion = 'guardar'
	}
	
	ver_cerrar_ventana_cargando("1","CARGANDO...");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", "")
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("hora", hora)
	datos.append("promediodia", promediodia)
	datos.append("promediosemana", promediosemana)
	datos.append("promedioquincena", promedioquincena)
	datos.append("promediomes", promediomes)
	datos.append("ingresosextras", ingresosextras)
	datos.append("alquilercasa", alquilercasa)
	datos.append("alquilernegocio", alquilernegocio)
	datos.append("cuotabanco", cuotabanco)
	datos.append("cuotafinanciera", cuotafinanciera)
	datos.append("cuotacooperativa", cuotacooperativa)
	datos.append("cuotaelectrodomesticos", cuotaelectrodomesticos)
	datos.append("cuotausureros", cuotausureros)
	datos.append("canthijos", canthijos)
	datos.append("condicion", condicion)
	datos.append("montoaprobado", montoaprobado)
	datos.append("plazo", plazo)
	datos.append("cuota", cuota)
	datos.append("obsanalista", obsanalista)
	datos.append("solicitudescreditos_cod", solicitudescreditos_cod)
	datos.append("descripcionmargen", descripcionmargen)
	datos.append("porcentajemargen", porcentajemargen)

	var OpAjax = $.ajax({
		data: datos,
		url: "./php/Analisis.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
		
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","ANALISIS REGISTRADO CORRECTAMENTE")
					abrir_cerrar_ventanas_solicitudescredito_analisis("2");
				    abrir_cerrar_ventanas_solicitudes_pendientes("1");
					vaciar_campos_analisis();
				} 
				

			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
				//limpiar_campos_clientes();
			}
		}
	});


}

function retranferirSolicitud(){
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var cod=document.getElementById('inp_idsolicitudescredito_analisis').value;
	var obsanalista=document.getElementById('inp_obsanalista_obs').value;
	ver_cerrar_ventana_cargando("1","CARGANDO...");
	var datos = new FormData();
	datos.append("func" , "retransferir")
	datos.append("cod" ,cod)
	datos.append("usuarios_cod" ,usuarios_cod)
	datos.append("obsanalista" ,obsanalista.toUpperCase())
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/Solicitudes.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")
			return false;
		},
		success: function (responseText){
			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
				ver_cerrar_ventana_cargando("2","SOLICITUD RETRANFERIDO CORRECTAMENTE")
				abrir_cerrar_ventanas_solicitudescredito_analisis("2");
				abrir_cerrar_ventanas_solicitudes_pendientes("1");
				abrir_cerrar_ventanas_obsanalista("2");
				vaciar_campos_analisis();
				
				}
				else {
					ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR...!")
				}
			   } catch (error) {
				ver_cerrar_ventana_cargando("2","SOLICITUD RETRANFERIDO CORRECTAMENTE")
				abrir_cerrar_ventanas_solicitudescredito_analisis("2");
				abrir_cerrar_ventanas_solicitudes_pendientes("1");
				abrir_cerrar_ventanas_obsanalista("2");
				vaciar_campos_analisis();
			}
		}
	});
}
var cod_de="";
var monto_de=0;
function desembolsar_efectivo(cod,monto,nrosolicitud){
	ver_vetana_eliminar("¿DESEAS DESEMBOLSAR Gs. "+monto,id_progreso,"28");
	cod_de=cod;
	nrosolicitud_de=nrosolicitud;
	monto_de=monto.toString().replace(/\./g,'');
}
function DesembolsarSolicitud(caja_cod,monto){
    var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var datos = new FormData();
	datos.append("func" , "desembolsar")
	datos.append("cod" ,cod_de)
	datos.append("caja_cod" ,caja_cod)
	datos.append("nrosolicitud" ,nrosolicitud_de)
	datos.append("usuarios_cod" ,usuarios_cod)
	datos.append("hora" ,hora)
	datos.append("monto" ,monto)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/Solicitudes.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")
			return false;
		},
		success: function (responseText){
			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				if (Respuesta == "exito") {
				ver_cerrar_ventana_cargando("2","DESEMBOLSO EXITOSO")
				 buscar_datos_desembolso_caja();
				}
				else {
					ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR...!")
				}
			   } catch (error) {
			}
		}
	});
}

function rechazarSolicitud(){
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var cod=document.getElementById('inp_idsolicitudescredito_analisis').value;
	var obsanalista=document.getElementById('inp_obsanalista_obs').value;
	ver_cerrar_ventana_cargando("1","CARGANDO...");
	var datos = new FormData();
	datos.append("func" , "rechazar")
	datos.append("cod" ,cod)
	datos.append("usuarios_cod" ,usuarios_cod)
	datos.append("obsanalista" ,obsanalista.toUpperCase())
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/Solicitudes.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")
			return false;
		},
		success: function (responseText){
			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
				ver_cerrar_ventana_cargando("2","SOLICITUD RECHAZADO CORRECTAMENTE")
				abrir_cerrar_ventanas_solicitudescredito_analisis("2");
				abrir_cerrar_ventanas_solicitudes_pendientes("1");
				vaciar_campos_analisis();
				}
				else {
					ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR...!")
				}
			   } catch (error) {
				ver_cerrar_ventana_cargando("2","SOLICITUD RECHAZADO CORRECTAMENTE")
				abrir_cerrar_ventanas_solicitudescredito_analisis("2");
				abrir_cerrar_ventanas_solicitudes_pendientes("1");
				vaciar_campos_analisis();
			}
		}
	});
}

function buscar_monto_cuota_prestamo_credito(){
	var cod = document.getElementById('inp_plazoaprobado').value
	
	var datos = new FormData();
	datos.append("func" , "buscarcombocuotamonto")
	datos.append("cod" ,cod)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmCuoteros.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_preciocuotaaprobado').innerHTML = datos[2]
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function buscar_plazoprestamo_credito(){
	var monto1 = document.getElementById('inp_montoaprobado').value
	var condicion = document.getElementById('inp_condicionaprobado').value
	var monto=monto1.toString().replace(/\./g,'');
	
	var datos = new FormData();
	datos.append("func" , "buscarcomboplazo")
	datos.append("monto" ,monto)
	datos.append("condicion" ,condicion)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmCuoteros.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_plazoaprobado').innerHTML = datos[2]
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function buscar_montoprestamo_credito(){
	var condicion = document.getElementById('inp_condicionaprobado').value
	var datos = new FormData();
	datos.append("func" , "buscarcombomonto")
	datos.append("condicion" ,condicion)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmCuoteros.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_montoaprobado').innerHTML = datos[2]
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}



function buscar_condiciones_solicitud(){
	var datos = new FormData();
	datos.append("func" , "buscarcombomes")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmCuoteros.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			//////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_condicion_s').innerHTML = datos[2];
					buscar_monto_a_solicitar_credito();
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}
function buscar_monto_a_solicitar_credito(){
	var condicion = document.getElementById('inp_condicion_s').value
	var datos = new FormData();
	datos.append("func" , "buscarcombomonto")
	datos.append("condicion" ,condicion)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmCuoteros.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			//////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_montosolicitado').innerHTML = datos[2];
					buscar_plazo_solicitud()
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}


function buscar_plazo_solicitud(){
	var monto1 = document.getElementById('inp_montosolicitado').value
   var condicion = document.getElementById('inp_condicion_s').value
	var monto=monto1.toString().replace(/\./g,'');
	var datos = new FormData();
	datos.append("func" , "buscarcomboplazo")
	datos.append("monto" ,monto)
	datos.append("condicion" ,condicion)
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmCuoteros.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			//////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_cuota_s').innerHTML = datos[2];
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function buscar_condiciones_credito(){
	var datos = new FormData();
	datos.append("func" , "buscarcombomes")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmCuoteros.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_condicionaprobado').innerHTML = datos[2]
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function calcularanalisis(){
	//promedio dia
	var promediodia1= document.getElementById('inp_ventapromediodia').value
	var promediodia=promediodia1.toString().replace(/\./g,'');
	//resultado dia
	var resultadopromediodia=parseInt(promediodia)*26;

	document.getElementById('inp_ventatotaldia').value=format_con_puntos_decimales(resultadopromediodia);
	 document.getElementById('inp_ventapromediodia').value=format_con_puntos_decimales(promediodia);
	
	//promedio semana
	var promediosemana1= document.getElementById('inp_ventapromediosemana').value
	var promediosemana=promediosemana1.toString().replace(/\./g,'');
	//resultado semana
	var resultadopromediosemana=parseInt(promediosemana)*4;
	document.getElementById('inp_ventatotalsemana').value=format_con_puntos_decimales(resultadopromediosemana);
	document.getElementById('inp_ventapromediosemana').value=format_con_puntos_decimales(promediosemana);
	
	//promedio quincena
	var promedioquincena1= document.getElementById('inp_ventapromedioquincena').value
	var promedioquincena=promedioquincena1.toString().replace(/\./g,'');
	//resultado quincena
	var resultadopromedioquincena=parseInt(promedioquincena)*2;
	document.getElementById('inp_ventatotalquincena').value=format_con_puntos_decimales(resultadopromedioquincena);
	document.getElementById('inp_ventapromedioquincena').value=format_con_puntos_decimales(promedioquincena);
	//promedio mes
	var promediomes1= document.getElementById('inp_ventapromediomes').value
	var promediomes=promediomes1.toString().replace(/\./g,'');
	//resultado mes
	var resultadopromediomes=parseInt(promediomes)*1;
	document.getElementById('inp_ventatotalmes').value=format_con_puntos_decimales(resultadopromediomes);
	document.getElementById('inp_ventapromediomes').value=format_con_puntos_decimales(promediomes);
	
	
	//salario extra
	var extras1= document.getElementById('inp_salarioextrames').value
	var extras=extras1.toString().replace(/\./g,'');
    var salariototalextras=parseInt(extras);
    var salariototalporcentaje=parseInt(salariototalextras)*25/100;
	document.getElementById('inp_salarioextrames').value=format_con_puntos_decimales(extras);
	document.getElementById('inp_procentajesalario').value=format_con_puntos_decimales(salariototalporcentaje);
    var a1=parseInt(resultadopromediodia);
    var b1=parseInt(resultadopromediosemana);
    var c1=parseInt(resultadopromedioquincena);
    var d1=parseInt(resultadopromediomes);
	var elementos1 = [a1,b1,c1,d1,0];
var repetidos1 = {};
elementos1.forEach(function(numero1){
  repetidos1[numero1] = (repetidos1[numero1] || 0) + 1;
});

				
	//total ingreso
	var dividendo =(4-(repetidos1[0]-1));

	////console.log(dividendo);
	var totalingreso=parseInt(a1)+parseInt(b1)+parseInt(c1)+parseInt(d1);
	var res=Math.round(parseInt(totalingreso)/parseInt(dividendo));
	document.getElementById('inp_ingresototalmes').value=format_con_puntos_decimales(res);
	 //ganancia Bruta
	 var porcentaje = document.getElementById('inp_porcentaje_vistamargen').value;
	 var porcentajemargen=parseInt(porcentaje);
	 var gananciabruta=(res*porcentajemargen)/100 + salariototalporcentaje;
	 var gananciabrutax=(parseInt(res)*parseInt(porcentajemargen))/100;
	 document.getElementById('inp_gananciabrutames').value=format_con_puntos_decimales(Math.round(gananciabrutax));
	
	
	//3er hijo
	var cantidadhijos1= document.getElementById('inp_cantidadhijo_analisis').value
	var cantidadhijos=cantidadhijos1.toString().replace(/\./g,'');
	var hj=parseInt(cantidadhijos);
	 var consumisioneshijos=0;
	if(hj>=3){
	  consumisioneshijos=200000;
	}if(hj>=4){
	  consumisioneshijos=400000;
	}if(hj>=5){
	  consumisioneshijos=600000;
	}if(hj>=6){
	  consumisioneshijos=800000;
	}if(hj>=7){
	  consumisioneshijos=1000000;
	}if(hj>=8){
	  consumisioneshijos=1200000;
	}if(hj>=9){
	  consumisioneshijos=1400000;
	}if(hj>=10){
	  consumisioneshijos=1600000;
	}if(hj>=11){
	  consumisioneshijos=1800000;
	}if(hj>=12){
	  consumisioneshijos=2000000;
	}if(hj>=13){
	  consumisioneshijos=2200000;
	}if(hj>=14){
	  consumisioneshijos=2400000;
	}if(hj>=15){
	  consumisioneshijos=2600000;
	}if(hj==0){
	  consumisioneshijos=0;
	}
	document.getElementById('inp_consumisioneshijos').value=format_con_puntos_decimales(consumisioneshijos);
	//consumisiones hijos
	var consumisionesh1= document.getElementById('inp_consumisioneshijos').value
	var consumisionesh=consumisionesh1.toString().replace(/\./g,'');
	document.getElementById('inp_consumisioneshijos').value=format_con_puntos_decimales(consumisionesh);
	
	//alquileres de casa
	var alquicasa1= document.getElementById('inp_alquilercasa_analisis').value
	var alquicasa=alquicasa1.toString().replace(/\./g,'');
	document.getElementById('inp_alquilercasa_analisis').value=format_con_puntos_decimales(alquicasa);
	
	// alquileres de negocio
	var alquinego1= document.getElementById('inp_alquilernegocio_analisis').value
	var alquinego=alquinego1.toString().replace(/\./g,'');
	document.getElementById('inp_alquilernegocio_analisis').value=format_con_puntos_decimales(alquinego);
	
	// banco
	var cuotabanco1= document.getElementById('inp_cuatabanco_analisis').value
	var cuotabanco=cuotabanco1.toString().replace(/\./g,'');
	document.getElementById('inp_cuatabanco_analisis').value=format_con_puntos_decimales(cuotabanco);
	
	// financiera
	var cuotafinanciera1= document.getElementById('inp_cuatafinanciera_analisis').value
	var cuotafinanciera=cuotafinanciera1.toString().replace(/\./g,'');
	document.getElementById('inp_cuatafinanciera_analisis').value=format_con_puntos_decimales(cuotafinanciera);
	
	// cooperativa
	var cuotacooperativa1= document.getElementById('inp_cuatacooperativa_analisis').value
	var cuotacooperativa=cuotacooperativa1.toString().replace(/\./g,'');
	document.getElementById('inp_cuatacooperativa_analisis').value=format_con_puntos_decimales(cuotacooperativa);
	
	
	// electrodomesticos
	var cuotaelectrodomesticos1= document.getElementById('inp_cuataelectrodomesticos_analisis').value
	var cuotaelectrodomesticos=cuotaelectrodomesticos1.toString().replace(/\./g,'');
	document.getElementById('inp_cuataelectrodomesticos_analisis').value=format_con_puntos_decimales(cuotaelectrodomesticos);
	
	
	// usureros
	var cuotausureros1= document.getElementById('inp_cuotausurero_analisis').value
	var cuotausureros=cuotausureros1.toString().replace(/\./g,'');
	document.getElementById('inp_cuotausurero_analisis').value=format_con_puntos_decimales(cuotausureros);
	
	var disponibilidadaparente=(parseInt(gananciabruta)-(parseInt(consumisionesh)+parseInt(alquicasa)+parseInt(alquinego)+parseInt(cuotabanco)+parseInt(cuotafinanciera)+parseInt(cuotacooperativa)+parseInt(cuotaelectrodomesticos)+parseInt(cuotausureros)));
	document.getElementById('inp_disponibilidadaparente').value=format_con_puntos_decimales(disponibilidadaparente);
	
	var cm=(parseInt(disponibilidadaparente)*25/100);
	var cq=(parseInt(cm)/2);
	var cs=parseInt(cm)/4;
	var cd=parseInt(cm)/26;
	
	document.getElementById('inp_conclusionesmes').value=format_con_puntos_decimales(Math.round(cm));
	document.getElementById('inp_conclusionesquincena').value=format_con_puntos_decimales(Math.round(cq));
	document.getElementById('inp_conclusionessemana').value=format_con_puntos_decimales(Math.round(cs));
	document.getElementById('inp_conclusionesdia').value=format_con_puntos_decimales(Math.round(cd));
	
	}
		
//busccar detalles referencias creditos comerciales
function buscar_detalles_referencias_creditos_comerciales(cod,nro){
	 if(nro=="1"){
	  document.getElementById("cnt_referencias_comerciales_analisis").innerHTML="";  					   
	 }
	 if(nro=="2"){
	   document.getElementById("cnt_referencias_comerciales").innerHTML=""; 					   
	 }
	
	var datos = {
		"cod": cod,
		"nro": nro,
		"func": "buscar_detalles_referencias_creditos_comerciales"
	};
	$.ajax({
		data: datos, url: "./php/ObtenerDetallesSolicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
if(nro=="1"){
	  document.getElementById("cnt_referencias_comerciales_analisis").innerHTML="";  					   
	 }
	 if(nro=="2"){
	   document.getElementById("cnt_referencias_comerciales").innerHTML=""; 					   
	 }
			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if(nro=="1"){
	  document.getElementById("cnt_referencias_comerciales_analisis").innerHTML="";  					   
	 }
	 if(nro=="2"){
	   document.getElementById("cnt_referencias_comerciales").innerHTML=""; 					   
	 }
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					if(nro=="1"){
	                    document.getElementById("cnt_referencias_comerciales_analisis").innerHTML=datos["1"];	
	                 }
	                if(nro=="2"){
	                    document.getElementById("cnt_referencias_comerciales").innerHTML=datos["1"];	
                        id_temporal1=datos["2"];						
	                 }
						
				} catch (error) {

				}

			}
		}
	});
}

//busccar detalles egresos
function buscar_detalles_fotos(cod){
	var datos = {
		"cod": cod,
		"func": "buscar_detalles_fotos"
	};
	$.ajax({
		data: datos, url: "./php/ObtenerDetallesSolicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					document.getElementById("cont_galery").innerHTML=datos["1"];
					currentSlide(1);

				} catch (error) {

				}

			}
		}
	});
}

//busccar detalles egresos
function buscar_detalles_Archivos(cod){
	var datos = {
		"cod": cod,
		"func": "buscar_detalles_archivos"
	};
	$.ajax({
		data: datos, url: "./php/ObtenerDetallesSolicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					document.getElementById("cont_archivos_table").innerHTML=datos["1"];
				} catch (error) {

				}

			}
		}
	});
}

//busccar detalles egresos
function buscar_detalles_egresos(cod,nro){
	var datos = {
		"cod": cod,
		"func": "buscar_detalles_egresos"
	};
	$.ajax({
		data: datos, url: "./php/ObtenerDetallesSolicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					if(nro=="1"){
					document.getElementById("inp_alquilervivienda_analisis").value=datos["1"];
					document.getElementById("inp_alquilercomercio_analisis").value=datos["2"];
					document.getElementById("inp_banco_analisis").value=datos["3"];
					document.getElementById("inp_cooperativa_analisis").value=datos["4"];
					document.getElementById("inp_financiera_analisis").value=datos["5"];
					document.getElementById("inp_electrodomesticos_analisis").value=datos["6"];	
					document.getElementById("inp_usureros_analisis").value=datos["7"];	
					document.getElementById("inp_cantidaddehijos_analisis").value=datos["8"];
                  	document.getElementById("inp_alquilercasa_analisis").value=datos["1"];
					document.getElementById("inp_alquilernegocio_analisis").value=datos["2"];
					document.getElementById("inp_cuatabanco_analisis").value=datos["3"];
					document.getElementById("inp_cuatacooperativa_analisis").value=datos["4"];
					document.getElementById("inp_cuatafinanciera_analisis").value=datos["5"];
					document.getElementById("inp_cuataelectrodomesticos_analisis").value=datos["6"];	
					document.getElementById("inp_cuotausurero_analisis").value=datos["7"];
					document.getElementById("inp_cantidadhijo_analisis").value=datos["8"];		
					}
					if(nro=="2"){
					document.getElementById("inp_alquilervivienda").value=datos["1"];
					document.getElementById("inp_alquilercomercio").value=datos["2"];
					document.getElementById("inp_banco").value=datos["3"];
					document.getElementById("inp_cooperativa").value=datos["4"];
					document.getElementById("inp_financiera").value=datos["5"];
					document.getElementById("inp_electrodomesticos").value=datos["6"];	
					document.getElementById("inp_usureros").value=datos["7"];	
					document.getElementById("inp_cantidaddehijos").value=datos["8"];
                  	document.getElementById("inp_alquilercasa").value=datos["1"];
					document.getElementById("inp_alquilernegocio").value=datos["2"];
					document.getElementById("inp_cuatabanco").value=datos["3"];
					document.getElementById("inp_cuatacooperativa").value=datos["4"];
					document.getElementById("inp_cuatafinanciera").value=datos["5"];
					document.getElementById("inp_cuataelectrodomesticos").value=datos["6"];	
					document.getElementById("inp_cuotausurero").value=datos["7"];
					document.getElementById("inp_cantidadhijo").value=datos["8"];		
					}

				} catch (error) {

				}

			}
		}
	});
}

//busccar detalles ingresos
function buscar_detalles_ingresos(cod,nro){
	var datos = {
		"cod": cod,
		"func": "buscar_detalles_ingresos"
	};
	$.ajax({
		data: datos, url: "./php/ObtenerDetallesSolicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					if(nro=="1"){
					document.getElementById("inp_pordiapoco_analisis").value=datos["1"];
					document.getElementById("inp_pordiamas_analisis").value=datos["2"];
					document.getElementById("inp_porsemanapoco_analisis").value=datos["3"];
					document.getElementById("inp_porsemanamas_analisis").value=datos["4"];
					document.getElementById("inp_pormespoco_analisis").value=datos["5"];
					document.getElementById("inp_pormesmas_analisis").value=datos["6"];	
					document.getElementById("inp_salariomensual_analisis").value=datos["7"];	
					document.getElementById("inp_salarioextras_analisis").value=datos["10"];
					document.getElementById("inp_porquincenapoco_analisis").value=datos["8"];	
					document.getElementById("inp_porsquincenamas_analisis").value=datos["9"];	
				
					var pd1=datos["1"].toString().replace(/\./g,'');
					var pd2=datos["2"].toString().replace(/\./g,'');
					var rpd=(parseInt(pd1)+parseInt(pd2))/2;
					
					var ps1=datos["3"].toString().replace(/\./g,'');
					var ps2=datos["4"].toString().replace(/\./g,'');
					var rps=(parseInt(ps1)+parseInt(ps2))/2;
					
					var pq1=datos["8"].toString().replace(/\./g,'');
					var pq2=datos["9"].toString().replace(/\./g,'');
					var rpq=(parseInt(pq1)+parseInt(pq2))/2;
										
					var pm1=datos["5"].toString().replace(/\./g,'');
					var pm2=datos["6"].toString().replace(/\./g,'');
					var rpm=(parseInt(pm1)+parseInt(pm2))/2;
					
					var stm=datos["7"].toString().replace(/\./g,'');
					var sem=datos["10"].toString().replace(/\./g,'');
					
					var tvpd=rpd*26;
					var tvps=rps*4;
					var tvpq=rpq*2;
					var tvpm=rpm*1;
                    
					
					document.getElementById("inp_ventapromediodia").value=format_con_puntos_decimales(rpd);
					document.getElementById("inp_ventapromediosemana").value=format_con_puntos_decimales(rps);	
					document.getElementById("inp_ventapromedioquincena").value=format_con_puntos_decimales(rpq);
					document.getElementById("inp_ventapromediomes").value=format_con_puntos_decimales(rpm);
					
					document.getElementById("inp_ventatotaldia").value=format_con_puntos_decimales(tvpd);
					document.getElementById("inp_ventatotalsemana").value=format_con_puntos_decimales(tvps);
					document.getElementById("inp_ventatotalquincena").value=format_con_puntos_decimales(tvpq);
					document.getElementById("inp_ventatotalmes").value=format_con_puntos_decimales(tvpm);
					
				
					document.getElementById("inp_salarioextrames").value=datos["10"];
					var ep=datos["10"].toString().replace(/\./g,'');
					var epf=parseInt(ep)*25/100;
					document.getElementById("inp_procentajesalario").value=format_con_puntos_decimales(epf);
var a = parseInt(tvpd);
var b = parseInt(tvps);
var c = parseInt(tvpq);
var d = parseInt(tvpm);
var elementos = [a,b,c,d,0];
var repetidos = {};
elementos.forEach(function(numero){
  repetidos[numero] = (repetidos[numero] || 0) + 1;
});

						
					var totalingreso=Math.round((tvpd+tvps+tvpq+tvpm)/(4-(repetidos[0]-1)));
                    document.getElementById("inp_ingresototalmes").value=format_con_puntos_decimales(totalingreso);
					}
					if(nro=="2"){
					document.getElementById("inp_pordiapoco").value=datos["1"];
					document.getElementById("inp_pordiamas").value=datos["2"];
					document.getElementById("inp_porsemanapoco").value=datos["3"];
					document.getElementById("inp_porsemanamas").value=datos["4"];
					document.getElementById("inp_pormespoco").value=datos["5"];
					document.getElementById("inp_pormesmas").value=datos["6"];	
					document.getElementById("inp_salariomensual").value=datos["7"];	
					document.getElementById("inp_porquincenapoco").value=datos["8"];	
					document.getElementById("inp_porquincenamas").value=datos["9"];
                    document.getElementById("inp_salarioextras").value=datos["10"];					
					
					}
				} catch (error) {

				}

			}
		}
	});
}

//busccar detalles referencias personales
function buscar_detalles_referencias_personales(cod,nro){
	if(nro=="1"){
	document.getElementById("cnt_datospersonales_analisis").innerHTML="";	
	}
	if(nro=="2"){
	document.getElementById("cnt_datospersonales").innerHTML="";	
	}
	
	var datos = {
		"cod": cod,
		"nro": nro,
		"func": "buscar_detalles_referencias_personales"
	};
	$.ajax({
		data: datos, url: "./php/ObtenerDetallesSolicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
if(nro=="1"){
	document.getElementById("cnt_datospersonales_analisis").innerHTML="";	
	}
	if(nro=="2"){
	document.getElementById("cnt_datospersonales").innerHTML="";	
	}
			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if(nro=="1"){
	document.getElementById("cnt_datospersonales_analisis").innerHTML="";	
	}
	if(nro=="2"){
	document.getElementById("cnt_datospersonales").innerHTML="";	
	}
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					if(nro=="1"){
	                   document.getElementById("cnt_datospersonales_analisis").innerHTML=datos["1"];	
	                }
	                if(nro=="2"){
	                   document.getElementById("cnt_datospersonales").innerHTML=datos["1"];
                       id_temporal=datos["2"];					   
	                }
						
				} catch (error) {

				}

			}
		}
	});
}

//busccar detalles referencias laborales
function buscar_detalles_datos_del_negocio(cod,nro){
	var datos = {
		"cod": cod,
		"func": "buscar_detalles_datos_del_negocio"
	};
	$.ajax({
		data: datos, url: "./php/ObtenerDetallesSolicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					if(nro=="1"){
					document.getElementById("inp_tinesingresoonegociopropio_analisis").value=datos["1"];
					document.getElementById("inp_direccioncomercial_analisis").value=datos["2"];
					document.getElementById("inp_telefonocomercial_analisis").value=datos["3"];
					document.getElementById("inp_funcionarioasucargo_analisis").value=datos["4"];
					}
					if(nro=="2"){
					document.getElementById("inp_tinesingresoonegociopropio").value=datos["1"];
					document.getElementById("inp_direccioncomercial").value=datos["2"];
					document.getElementById("inp_telefonocomercial").value=datos["3"];
					document.getElementById("inp_funcionarioasucargo").value=datos["4"];
					}
					
				
				
					
				} catch (error) {

				}

			}
		}
	});
}

//busccar detalles referencias laborales
function buscar_detalles_referencias_laborales(cod,nro){
	var datos = {
		"cod": cod,
		"func": "buscar_detalles_referencias_laborales"
	};
	$.ajax({
		data: datos, url: "./php/ObtenerDetallesSolicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					if(nro=="1"){
					document.getElementById("inp_trabajoactual_analisis").value=datos["1"];
					document.getElementById("inp_direcciontrabajoactual_analisis").value=datos["2"];
					document.getElementById("inp_puestoqueocupa_analisis").value=datos["3"];
					document.getElementById("inp_telefonopuestoqueocupa_analisis").value=datos["4"];
					document.getElementById("inp_antiguedadpuestoqueocupa_analisis").value=datos["5"];
					document.getElementById("inp_trabajoanterior_analisis").value=datos["6"];
					document.getElementById("inp_telefonotrabajoanterior_analisis").value=datos["7"];
					document.getElementById("inp_antiguedadtrabajoanterior_analisis").value=datos["8"];
					document.getElementById("inp_trabajoantepenultimo_analisis").value=datos["9"];
					document.getElementById("inp_telefonotrabajoantepenultimo_analisis").value=datos["10"];
					document.getElementById("inp_antiguedadtrabajoantepenultimo_analisis").value=datos["11"];
					document.getElementById("inp_periododeinactividad_analisis").value=datos["12"];
					document.getElementById("inp_informacionpositiva_analisis").value=datos["13"];
					document.getElementById("inp_informacionnegativa_analisis").value=datos["14"];
				}		
				if(nro=="2"){
					document.getElementById("inp_trabajoactual").value=datos["1"];
					document.getElementById("inp_direcciontrabajoactual").value=datos["2"];
					document.getElementById("inp_puestoqueocupa").value=datos["3"];
					document.getElementById("inp_telefonopuestoqueocupa").value=datos["4"];
					document.getElementById("inp_antiguedadpuestoqueocupa").value=datos["5"];
					document.getElementById("inp_trabajoanterior").value=datos["6"];
					document.getElementById("inp_telefonotrabajoanterior").value=datos["7"];
					document.getElementById("inp_antiguedadtrabajoanterior").value=datos["8"];
					document.getElementById("inp_trabajoantepenultimo").value=datos["9"];
					document.getElementById("inp_telefonotrabajoantepenultimo").value=datos["10"];
					document.getElementById("inp_antiguedadtrabajoantepenultimo").value=datos["11"];
					document.getElementById("inp_periododeinactividad").value=datos["12"];
					document.getElementById("inp_informacionpositiva").value=datos["13"];
					document.getElementById("inp_informacionnegativa").value=datos["14"];
				}
				
					
				} catch (error) {

				}

			}
		}
	});
}

//busccar detalles solicitudes
function buscar_detalles_solicitudes(cod,nro){
	var datos = {
		"cod": cod,
		"func": "buscar_detalles_solicitudes"
	};
	$.ajax({
		data: datos, url: "./php/ObtenerDetallesSolicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					if(nro=="1"){
					document.getElementById("inp_idsolicitudescredito_analisis").value=datos["1"];
					document.getElementById("inp_nrosolicitud_analisis").value=datos["2"];
					document.getElementById("inp_fecha_analisis").value=datos["3"];
					document.getElementById("inp_cedula_sc_analisis").value=datos["5"];
					document.getElementById("inp_nombres_sc_analisis").value=datos["6"];
					document.getElementById("inp_apellidos_sc_analisis").value=datos["7"];
					document.getElementById("inp_agente_analisis").value=datos["8"];
					document.getElementById("inp_fechanac_sc_analisis").value=datos["9"];
					document.getElementById("inp_direccion_sc_analisis").value=datos["10"];
					document.getElementById("inp_telefono_sc_analisis").value=datos["11"];
					document.getElementById("inp_estadocivil_sc_analisis").value=datos["12"];
					document.getElementById("inp_nacionalidad_sc_analisis").value=datos["13"];
					document.getElementById("inp_barrios_sc_analisis").value=datos["14"];
					document.getElementById("inp_ciudad_sc_analisis").value=datos["15"];
					document.getElementById("inp_departamento_sc_analisis").value=datos["16"];
					document.getElementById("inp_sucursal_analisis").value=datos["17"];
				    document.getElementById("inp_condicion_analisis").value=datos["28"];
					document.getElementById("inp_montosolicitado_analisis").value=datos["18"];
				    document.getElementById("inp_plazo_analisis").value=datos["30"];
					document.getElementById("inp_observacion_vendedor_analisis").value=datos["19"];	
                    if(datos["27"]=="RETRANSFERIDO"){
                        document.getElementById("inp_observacion_aprobacionanalista_analisis").value=datos["22"];
                    }else{
                        document.getElementById("inp_observacion_aprobacionanalista_analisis").value=datos["26"];                     
                    }   
                     var datosx=datos["25"];	
			         var todos=datosx.split(",");
                     mostrarubicacionenmapa(todos[1],todos[0]);
					}
					if(nro=="2"){	 
					document.getElementById("inp_condicion_s").value=datos["28"];
					
                    document.getElementById("inp_montosolicitado").value="<option value="+datos["0"]+">"+datos["0"]+"</option>";
                    document.getElementById("inp_cuota_s").innerHTML="<option value ='"+datos["29"]+"'>"+datos["30"]+"</option>";
					document.getElementById("inp_vendedor").value=datos["24"];
					document.getElementById("inp_idsolicitudescredito").value=datos["1"];
					document.getElementById("inp_nrosolicitud").value=datos["2"];
					document.getElementById("inp_fecha_s").value=datos["3"];
					document.getElementById("inp_idClientes_sc").value=datos["4"];
					document.getElementById("inp_cedula_sc").value=datos["5"];
					document.getElementById("inp_nombres_sc").value=datos["6"]+" "+datos["7"];;
					document.getElementById("inp_sucursal_solicitud").value=datos["20"];
					document.getElementById("inp_observacion_vendedor").value=datos["19"];
					document.getElementById("inp_observacion_analista_solicitud").value=datos["22"];
					document.getElementById("inp_actividadescomerciales").value=datos["23"];
					cerrar_abrir_opciones_detalles_negocios();
					}	
				} catch (error) {
                   
				}

			}
		}
	});
}

function mostrarubicacionenmapa(lat,lng){
mapboxgl.accessToken = 'pk.eyJ1IjoiZXZpbG5hcHNpcyIsImEiOiJjazM2MHZtbXcwNm11M25reGY3NW1zMHhhIn0.FoA72lWHT4bXe2jxfH5uvQ';
var mapx = new mapboxgl.Map({
container: 'verubicacion',
style: 'mapbox://styles/mapbox/streets-v11',
center: [lat, lng], // starting position
zoom: 15
});

var marker = new mapboxgl.Marker().setLngLat([lat, lng]).addTo(mapx);
mapx.addControl(new mapboxgl.NavigationControl());
	mapx.addControl(new mapboxgl.FullscreenControl());
/* mapx.on('mousemove', function (e) {
document.getElementById('info').innerHTML =
JSON.stringify(e.lngLat.wrap());
}); */
}

var estado_solicitudes_pendientes = 'PENDIENTE';
function buscar_por_opciones_solicitudes_pendientes(d) {
	document.getElementById('efe_cargando1').style.display='';
	if (d == "1") {
		estado_solicitudes_pendientes = 'PENDIENTE';
		buscar_datos_solicitudes_pendientes(estado_solicitudes_pendientes);
		abrir_cerrar_ventanas_solicitudes_pendientes("6");
	document.getElementById("id_estado_analisis").innerHTML = estado_solicitudes_pendientes+"S";
	document.getElementById("fecha_ara").innerHTML = "FEC. APRO.";
	}
	if (d == "2") {
		estado_solicitudes_pendientes = 'APROBADO';
		buscar_datos_solicitudes_pendientes(estado_solicitudes_pendientes);
		abrir_cerrar_ventanas_solicitudes_pendientes("6");
	document.getElementById("id_estado_analisis").innerHTML = estado_solicitudes_pendientes+"S";
document.getElementById("fecha_ara").innerHTML = "FEC. APRO.";
	}
	if (d == "3") {
		estado_solicitudes_pendientes = 'RECHAZADO';
		buscar_datos_solicitudes_pendientes(estado_solicitudes_pendientes);
		abrir_cerrar_ventanas_solicitudes_pendientes("6");
	document.getElementById("id_estado_analisis").innerHTML = estado_solicitudes_pendientes+"S";
document.getElementById("fecha_ara").innerHTML = "FEC. RECH.";
	}
	if (d == "4") {
		estado_solicitudes_pendientes = 'RETRANSFERIDO';
		buscar_datos_solicitudes_pendientes(estado_solicitudes_pendientes);
		abrir_cerrar_ventanas_solicitudes_pendientes("6");
	document.getElementById("id_estado_analisis").innerHTML = estado_solicitudes_pendientes+"S";
document.getElementById("fecha_ara").innerHTML = "FEC. RETR.";
	}

}

//busccar datos solicitudes_pendientes
function buscar_datos_solicitudes_pendientes(estado) {
	var buscador = document.getElementById('inpt_buscador_solicitudes_pendientes').value
	document.getElementById("cnt_listado_solicitudes_pendientes").innerHTML = ""
	var datos = {
		"buscador": buscador,
		"estado": estado,
		"func": "buscar_solicitudes_pendientes"
	};
	$.ajax({
		data: datos, url: "./php/Solicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_solicitudes_pendientes").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_solicitudes_pendientes").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_solicitudes_pendientes").innerHTML = datos_buscados
					document.getElementById("lbltotalsolicitudes_pendientes").innerHTML="CANTIDAD: "+datos["2"];
						document.getElementById('efe_cargando1').style.display='none';
				} catch (error) {

				}

			}
		}
	});
}

function CargarReferenciasCreditosComerciales() {
    var datos = new FormData();
	var control=1;
	var f = new Date();
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	datos.append("hora", hora)	
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	datos.append("usuarios_cod", usuarios_cod)
	$("tr[name=trdetalles_referenciascreditoscomerciales]").each(function(i, elementohtml){
	var nambreentidad=$(elementohtml).children('td[id="td_entidad"]').html();
    datos.append("nambreentidad"+control, nambreentidad)
	
	var cuota=$(elementohtml).children('td[id="td_cuota"]').html();
    datos.append("cuota"+control, cuota)

    var plazo=$(elementohtml).children('td[id="td_plazo1"]').html();
    datos.append("plazo"+control, plazo)
	
    var saldo=$(elementohtml).children('td[id="td_saldo1"]').html();
    datos.append("saldo"+control, saldo)
   
   var obs=$(elementohtml).children('td[id="td_observaciones"]').html();
    datos.append("obs"+control, obs)
   
	control=control+1;
	});
	control=control-1;
	datos.append("totalRegistro", control)

ver_cerrar_ventana_cargando("1","CARGANDO...");
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/CargarReferenciasComerciales.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			verCerrarEfectoCargando("")
			ver_cerrar_ventana_cargando("2","ERROR DE CONECCIÓN")
			return false;
		},
		success: function (responseText) {
			verCerrarEfectoCargando("")
			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					CargarAdjustosFotograficos();
				}
				else {
					ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
				}
			} catch (error) {
				ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
			}
		}
	});
}

function CargarReferenciasPersonales() {
    var datos = new FormData();
	var control=1;
	var f = new Date();
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	datos.append("hora", hora)	
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	datos.append("usuarios_cod", usuarios_cod)
	$("tr[name=trdetalles_referenciaspersonales]").each(function(i, elementohtml){
	
	var vinculo=$(elementohtml).children('td[id="td_vinculo"]').html();
    datos.append("vinculo"+control, vinculo)
	
	var nombre=$(elementohtml).children('td[id="td_nombre"]').html();
    datos.append("nombre"+control, nombre)

    var telefono=$(elementohtml).children('td[id="td_telefono"]').html();
    datos.append("telefono"+control, telefono)
   
	control=control+1;
	});
	control=control-1;
	datos.append("totalRegistro", control)

ver_cerrar_ventana_cargando("1","CARGANDO...");
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/CargarReferenciasPersonales.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			verCerrarEfectoCargando("")
			ver_cerrar_ventana_cargando("2","ERROR DE CONECCIÓN")
			return false;
		},
		success: function (responseText) {
			verCerrarEfectoCargando("")
			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					CargarReferenciasCreditosComerciales();
				}
				else {
					ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
				}
			} catch (error) {
				ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR")
			}
		}
	});
}

/*AÑADIR O MODIFICAR NUEVO UTILIDADES*/
function add_datos_utilidades(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idutilidades').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var porcentaje = document.getElementById('inp_utilidades_porcentaje').value
	var descripcion = document.getElementById('inp_utilidades_descripcion').value
	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_utilidades"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_utilidades"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
ver_cerrar_ventana_cargando("1","CARGANDO...");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("porcentaje", porcentaje)
	datos.append("descripcion", descripcion)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmUtilidades.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE")
					limpiar_campos_utilidades();
					buscar_datos_utilidades("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE")
					limpiar_campos_utilidades();
					buscar_datos_utilidades("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE")
					limpiar_campos_utilidades();
					buscar_datos_utilidades("ACTIVO");
				}

			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
				//limpiar_campos_clientes();
			}
		}
	});


}

function limpiar_campos_utilidades() {
    document.getElementById('inp_idutilidades').value= ''
	document.getElementById('inp_utilidades_porcentaje').value= ''
	document.getElementById('inp_utilidades_descripcion').value= ''
	document.getElementById('btn_guardar_utilidades').innerHTML = "<p style='display:none;' id='accion_guardar_utilidades'>guardar</p>GUARDAR";
}

var estado_utilidades = 'ACTIVO';
function buscar_por_opciones_utilidades(d) {
	if (d == "1") {
		estado_utilidades = 'ACTIVO';
		buscar_datos_utilidades(estado_utilidades);
		abrir_cerrar_ventanas_utilidades("6");
	}
	if (d == "2") {
		estado_utilidades = 'ELIMINADO';
		buscar_datos_utilidades(estado_utilidades);
		abrir_cerrar_ventanas_utilidades("6");
	}

}

//busccar datos utilidades
function buscar_datos_utilidades(buscar2) {
	var buscador = document.getElementById('inpt_buscador_utilidades').value
	document.getElementById("cnt_listado_utilidades").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmUtilidades.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_utilidades").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			//////console.log(Respuesta)
			document.getElementById("cnt_listado_utilidades").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_utilidades").innerHTML = datos_buscados
					document.getElementById("lbltotalutilidades").innerHTML="REGISTROS ENCONTRADOS: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

//busccar datos utilidades
function buscar_datos_utilidadesvista() {
	var buscador = document.getElementById('inpt_buscador_utilidades_vista').value
	document.getElementById("cnt_listado_utilidades_vista").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": "ACTIVO",
		"func": "buscarvista"
	};
	$.ajax({
		data: datos, url: "./php/abmUtilidades.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_utilidades_vista").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			//////console.log(Respuesta)
			document.getElementById("cnt_listado_utilidades_vista").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_utilidades_vista").innerHTML = datos_buscados
					document.getElementById("lbltotalutilidades_vista").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_datos_utilidades(datospr) {
	document.getElementById('inp_idutilidades').value=$(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_utilidades_porcentaje').value= $(datospr).children('td[id="td_porcentaje"]').html();
	document.getElementById('inp_utilidades_descripcion').value= $(datospr).children('td[id="td_descripcion"]').html();
	document.getElementById('btn_guardar_utilidades').innerHTML = "<p style='display:none;' id='accion_guardar_utilidades'>editar</p>EDITAR";
	abrir_cerrar_ventanas_utilidades("4");
}

//busccar datos cobradores
function buscar_datos_cobradoresvista() {
	var buscador = document.getElementById('inpt_buscador_cobradores_vista').value
	document.getElementById("cnt_listado_cobradores_vista").innerHTML = ""
	var datos = {
		"nombres": buscador,
		"func": "buscar_cobradores"
	};
	$.ajax({
		data: datos, url: "./php/abmUsuarios.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_cobradores_vista").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			//////console.log(Respuesta)
			document.getElementById("cnt_listado_cobradores_vista").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_cobradores_vista").innerHTML = datos_buscados
					document.getElementById("lbltotalcobradores_vista").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_datos_vistacobradores_3(datospr) {
	if(control_vista_cobradores=="1"){
    document.getElementById('inp_codcobrador_pcobros_c').value=$(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_cobrador_nombres_pcobros_c').value= $(datospr).children('td[id="td_nombres"]').html();
	abrir_cerrar_ventanas_vistacobradores("2");
	}else
	if(control_vista_cobradores=="2"){
    document.getElementById('inp_idcobrador_oi').value=$(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_cedula_cobrador_oi').value= $(datospr).children('td[id="td_cedula"]').html();
	document.getElementById('inp_cobrador_oi').value= $(datospr).children('td[id="td_nombres"]').html();
	abrir_cerrar_ventanas_vistacobradores("2");
	}
}



//busccar datos clientes
function buscar_datos_clientesvista() {
	var buscador = document.getElementById('inpt_buscador_clientes_vista').value
	document.getElementById("cnt_listado_clientes_vista").innerHTML = ""
	var datos = {
		"nombres": buscador,
		"func": "buscar_clientes"
	};
	$.ajax({
		data: datos, url: "./php/abmDatosPersonas.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_clientes_vista").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			//////console.log(Respuesta)
			document.getElementById("cnt_listado_clientes_vista").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_clientes_vista").innerHTML = datos_buscados
					document.getElementById("lbltotalclientes_vista").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_datos_vistaclientes_3(datospr) {
	
	if(control_vista_clientes=="1"){
    document.getElementById('inp_idcobradoa_oi').value=$(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_cedula_cobradoa_oi').value= $(datospr).children('td[id="td_cedula"]').html();
	document.getElementById('inp_nombres_cobradoa_oi').value= $(datospr).children('td[id="td_clientes"]').html();
	abrir_cerrar_ventanas_vistaclientes("2");
	} else
	if(control_vista_clientes=="2"){
    document.getElementById('inp_idpagadoa_oe').value=$(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_cedula_pagadoa_oe').value= $(datospr).children('td[id="td_cedula"]').html();
	document.getElementById('inp_nombres_pagadoa_oe').value= $(datospr).children('td[id="td_clientes"]').html();
	abrir_cerrar_ventanas_vistaclientes("2");
	}
}



//busccar datos clientes
function buscar_datos_conceptosvista() {
	var buscador = document.getElementById('inpt_buscador_conceptos_vista').value
	document.getElementById("cnt_listado_conceptos_vista").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"func": "buscar_conceptos"
	};
	$.ajax({
		data: datos, url: "./php/abmconceptos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_conceptos_vista").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////////console.log(Respuesta)
			document.getElementById("cnt_listado_conceptos_vista").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_conceptos_vista").innerHTML = datos_buscados
					document.getElementById("lbltotalconceptos_vista").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

//busccar datos clientes
function buscar_datos_conceptosvista_compras() {
	var buscador = document.getElementById('inpt_buscador_conceptos_vista').value
	document.getElementById("cnt_listado_conceptos_vista").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"func": "buscar_conceptos_vista_compras"
	};
	$.ajax({
		data: datos, url: "./php/abmconceptos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_conceptos_vista").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			//////console.log(Respuesta)
			document.getElementById("cnt_listado_conceptos_vista").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_conceptos_vista").innerHTML = datos_buscados
					document.getElementById("lbltotalconceptos_vista").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_datos_vistaconceptos_3(datospr) {
	
	if(control_vista_conceptos=="1"){
    document.getElementById('inp_idconcepto_oi').value=$(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_concepto_oi').value= $(datospr).children('td[id="td_conceptos"]').html();
	document.getElementById('inp_detalle_oi').value="Ingreso "+ $(datospr).children('td[id="td_conceptos"]').html();
	abrir_cerrar_ventanas_vistaconceptos("2");
	}else
	if(control_vista_conceptos=="2"){
    document.getElementById('inp_idconcepto_oe').value=$(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_concepto_oe').value= $(datospr).children('td[id="td_conceptos"]').html();
	document.getElementById('inp_detalle_oe').value=$(datospr).children('td[id="td_conceptos"]').html();
	abrir_cerrar_ventanas_vistaconceptos("2");
	}
}



function obtener_datos_utilidadesvista(datospr) {
	document.getElementById('inp_idcod_margen').value=$(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_porcentaje_vistamargen').value= $(datospr).children('td[id="td_porcentaje"]').html();
	document.getElementById('inp_descripcion_vistamargen').value= $(datospr).children('td[id="td_descripcion"]').html();
    calcularanalisis();
	abrir_cerrar_ventanas_vistautilidades("2");
}

//funcion cargar solicitud como borrador
function add_datos_solicitudescredito_a_borrador(){
   validadar_campos_solicitudes();
	var cod = document.getElementById('inp_idsolicitudescredito').value
	var datos = {
		"cod": cod,
		"func": "eliminarsolicitudes"
	};
	$.ajax({
		data: datos, url: "./php/Solicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta == "exito") {
			
			 add_datos_solicitudescredito("BORRADOR","guardar","0");
			}
		}
	});
}

function buscarvendedor_combo(){
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmUsuarios.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('inp_vendedor').innerHTML = datos[2]
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function buscarcobrador_combo(){
	var datos = new FormData();
	datos.append("func" , "buscarcombocobrador")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmUsuarios.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
				  document.getElementById('inp_cobrador_desembolso').innerHTML = datos[2]
				}
				else {
				  ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				  ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}


function eliminarestasolicitud(){

	var cod = document.getElementById('inp_idsolicitudescredito').value
	var datos = {
		"cod": cod,
		"func": "eliminarSolicitudes_retransferido"
	};
	$.ajax({
		data: datos, url: "./php/Solicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta == "exito") {
			 ver_cerrar_ventana_cargando("2", " SOLICITUD ELIMINADA CORRECTAMENTE...");
					limpiar_campos_solicitudescredito();
					abrir_cerrar_ventanas_solicitudescredito("2");
					buscar_datos_mis_solicitudes();
			}
		}
	});
}

function eliminarestasolicitud_analisis(){

	var cod = document.getElementById('inp_idsolicitudescredito_analisis').value
	var datos = {
		"cod": cod,
		"func": "eliminarSolicitudes_retransferido"
	};
	$.ajax({
		data: datos, url: "./php/Solicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta == "exito") {
			 ver_cerrar_ventana_cargando("2", " SOLICITUD ELIMINADA CORRECTAMENTE...");
					abrir_cerrar_ventanas_solicitudescredito_analisis("2");
					buscar_por_opciones_solicitudes_pendientes("1");
			}
		}
	});
}


//funcion cargar solicitud como enviado
function add_datos_solicitudescredito_a_analisis(){
 validadar_campos_solicitudes();
	var cod = document.getElementById('inp_idsolicitudescredito').value
	var datos = {
		"cod": cod,
		"func": "eliminarsolicitudes"
	};
	$.ajax({
		data: datos, url: "./php/Solicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta == "exito") {
			 add_datos_solicitudescredito("PENDIENTE","guardar","0");
			}
		}
	});
}

function vaciar_campos_analisis(){
   $("#inp_condicionaprobado").val("");
     document.getElementById('inp_montoaprobado').innerHTML="";
     document.getElementById('inp_plazoaprobado').innerHTML="";
     document.getElementById('inp_preciocuotaaprobado').innerHTML="";
     document.getElementById('inp_observacion_aprobacionanalista_analisis').value="";
     document.getElementById('inp_descripcion_vistamargen').value="";
     document.getElementById('inp_porcentaje_vistamargen').value="0";
     document.getElementById('inp_informacionpositiva_analisis').value="";
     document.getElementById('inp_informacionnegativa_analisis').value="";
     document.getElementById('inp_condicion_analisis').value="";
     document.getElementById('inp_plazo_analisis').value="";

 document.getElementById("inp_montoaprobado").classList.remove('input_1_1_error');
    document.getElementById("inp_montoaprobado").classList.add('input_1_1');
    
    document.getElementById("inp_plazoaprobado").classList.remove('input_1_1_error');
    document.getElementById("inp_plazoaprobado").classList.add('input_1_1');
    
    document.getElementById("inp_preciocuotaaprobado").classList.remove('input_1_1_error');
    document.getElementById("inp_preciocuotaaprobado").classList.add('input_1_1');
    

    document.getElementById("inp_descripcion_vistamargen").classList.remove('input_1_1_error');
    document.getElementById("inp_descripcion_vistamargen").classList.add('input_1_1');
    
    document.getElementById("inp_porcentaje_vistamargen").classList.remove('input_1_1_error');
    document.getElementById("inp_porcentaje_vistamargen").classList.add('input_1_1');
    
    document.getElementById("inp_informacionpositiva_analisis").classList.remove('input_1_1_error');
    document.getElementById("inp_informacionpositiva_analisis").classList.add('input_1_1');
    
    document.getElementById("inp_informacionnegativa_analisis").classList.remove('input_1_1_error');
    document.getElementById("inp_informacionnegativa_analisis").classList.add('input_1_1');
    
    
    document.getElementById("inp_condicionaprobado").classList.remove('input_1_1_error');
    document.getElementById("inp_condicionaprobado").classList.add('input_1_1');
		 
    document.getElementById("inp_observacion_aprobacionanalista_analisis").classList.remove('input_1_1_error');
    document.getElementById("inp_observacion_aprobacionanalista_analisis").classList.add('input_1_1');
			  
}

function validar_campos_analisis(){
	 if (document.getElementById("inp_alquilercasa_analisis").value == '') {
    	document.getElementById("inp_alquilercasa_analisis").classList.add('input_1_1_error');
        document.getElementById("inp_alquilercasa_analisis").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_alquilercasa_analisis").classList.remove('input_1_1_error');
        document.getElementById("inp_alquilercasa_analisis").classList.add('input_1_1');
	} 
	if (document.getElementById("inp_salarioextrames").value == '') {
    	document.getElementById("inp_salarioextrames").classList.add('input_1_1_error');
        document.getElementById("inp_salarioextrames").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_salarioextrames").classList.remove('input_1_1_error');
        document.getElementById("inp_salarioextrames").classList.add('input_1_1');
	} /* 
	if (document.getElementById("inp_salariototalmes").value == '') {
    	document.getElementById("inp_salariototalmes").classList.add('input_1_1_error');
        document.getElementById("inp_salariototalmes").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_salariototalmes").classList.remove('input_1_1_error');
        document.getElementById("inp_salariototalmes").classList.add('input_1_1');
	}  */
	if (document.getElementById("inp_ventapromediomes").value == '') {
    	document.getElementById("inp_ventapromediomes").classList.add('input_1_1_error');
        document.getElementById("inp_ventapromediomes").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_ventapromediomes").classList.remove('input_1_1_error');
        document.getElementById("inp_ventapromediomes").classList.add('input_1_1');
	} 
	if (document.getElementById("inp_ventapromedioquincena").value == '') {
    	document.getElementById("inp_ventapromedioquincena").classList.add('input_1_1_error');
        document.getElementById("inp_ventapromedioquincena").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_ventapromedioquincena").classList.remove('input_1_1_error');
        document.getElementById("inp_ventapromedioquincena").classList.add('input_1_1');
	} 
	if (document.getElementById("inp_ventapromediosemana").value == '') {
    	document.getElementById("inp_ventapromediosemana").classList.add('input_1_1_error');
        document.getElementById("inp_ventapromediosemana").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_ventapromediosemana").classList.remove('input_1_1_error');
        document.getElementById("inp_ventapromediosemana").classList.add('input_1_1');
	}  
	if (document.getElementById("inp_ventapromediodia").value == '') {
    	document.getElementById("inp_ventapromediodia").classList.add('input_1_1_error');
        document.getElementById("inp_ventapromediodia").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_ventapromediodia").classList.remove('input_1_1_error');
        document.getElementById("inp_ventapromediodia").classList.add('input_1_1');
	} 
	
	if (document.getElementById("inp_descripcion_vistamargen").value == '') {
    	document.getElementById("inp_descripcion_vistamargen").classList.add('input_1_1_error');
        document.getElementById("inp_descripcion_vistamargen").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_descripcion_vistamargen").classList.remove('input_1_1_error');
        document.getElementById("inp_descripcion_vistamargen").classList.add('input_1_1');
	} 
	if (document.getElementById("inp_porcentaje_vistamargen").value == '') {
    	document.getElementById("inp_porcentaje_vistamargen").classList.add('input_1_1_error');
        document.getElementById("inp_porcentaje_vistamargen").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_porcentaje_vistamargen").classList.remove('input_1_1_error');
        document.getElementById("inp_porcentaje_vistamargen").classList.add('input_1_1');
	} 
	if (document.getElementById("inp_alquilernegocio_analisis").value == '') {
    	document.getElementById("inp_alquilernegocio_analisis").classList.add('input_1_1_error');
        document.getElementById("inp_alquilernegocio_analisis").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_alquilernegocio_analisis").classList.remove('input_1_1_error');
        document.getElementById("inp_alquilernegocio_analisis").classList.add('input_1_1');
	}
    
	if (document.getElementById("inp_cuatabanco_analisis").value == '') {
    	document.getElementById("inp_cuatabanco_analisis").classList.add('input_1_1_error');
        document.getElementById("inp_cuatabanco_analisis").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cuatabanco_analisis").classList.remove('input_1_1_error');
        document.getElementById("inp_cuatabanco_analisis").classList.add('input_1_1');
	}
	if (document.getElementById("inp_cuatafinanciera_analisis").value == '') {
    	document.getElementById("inp_cuatafinanciera_analisis").classList.add('input_1_1_error');
        document.getElementById("inp_cuatafinanciera_analisis").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cuatafinanciera_analisis").classList.remove('input_1_1_error');
        document.getElementById("inp_cuatafinanciera_analisis").classList.add('input_1_1');
	}
	if (document.getElementById("inp_cuatacooperativa_analisis").value == '') {
    	document.getElementById("inp_cuatacooperativa_analisis").classList.add('input_1_1_error');
        document.getElementById("inp_cuatacooperativa_analisis").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cuatacooperativa_analisis").classList.remove('input_1_1_error');
        document.getElementById("inp_cuatacooperativa_analisis").classList.add('input_1_1');
	}
	
	if (document.getElementById("inp_cuataelectrodomesticos_analisis").value == '') {
    	document.getElementById("inp_cuataelectrodomesticos_analisis").classList.add('input_1_1_error');
        document.getElementById("inp_cuataelectrodomesticos_analisis").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cuataelectrodomesticos_analisis").classList.remove('input_1_1_error');
        document.getElementById("inp_cuataelectrodomesticos_analisis").classList.add('input_1_1');
	}
	if (document.getElementById("inp_cuotausurero_analisis").value == '') {
    	document.getElementById("inp_cuotausurero_analisis").classList.add('input_1_1_error');
        document.getElementById("inp_cuotausurero_analisis").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cuotausurero_analisis").classList.remove('input_1_1_error');
        document.getElementById("inp_cuotausurero_analisis").classList.add('input_1_1');
	}
	
	if (document.getElementById("inp_condicionaprobado").value == '') {
    	document.getElementById("inp_condicionaprobado").classList.add('input_1_1_error');
        document.getElementById("inp_condicionaprobado").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_condicionaprobado").classList.remove('input_1_1_error');
        document.getElementById("inp_condicionaprobado").classList.add('input_1_1');
	}
	if (document.getElementById("inp_montoaprobado").value == '') {
    	document.getElementById("inp_montoaprobado").classList.add('input_1_1_error');
        document.getElementById("inp_montoaprobado").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_montoaprobado").classList.remove('input_1_1_error');
        document.getElementById("inp_montoaprobado").classList.add('input_1_1');
	}
	
	if (document.getElementById("inp_plazoaprobado").value == '') {
    	document.getElementById("inp_plazoaprobado").classList.add('input_1_1_error');
        document.getElementById("inp_plazoaprobado").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_plazoaprobado").classList.remove('input_1_1_error');
        document.getElementById("inp_plazoaprobado").classList.add('input_1_1');
	}
	
	if (document.getElementById("inp_preciocuotaaprobado").value == '') {
    	document.getElementById("inp_preciocuotaaprobado").classList.add('input_1_1_error');
        document.getElementById("inp_preciocuotaaprobado").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_preciocuotaaprobado").classList.remove('input_1_1_error');
        document.getElementById("inp_preciocuotaaprobado").classList.add('input_1_1');
	}
	
	if (document.getElementById("inp_observacion_aprobacionanalista_analisis").value == '') {
    	document.getElementById("inp_observacion_aprobacionanalista_analisis").classList.add('input_1_1_error');
        document.getElementById("inp_observacion_aprobacionanalista_analisis").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_observacion_aprobacionanalista_analisis").classList.remove('input_1_1_error');
        document.getElementById("inp_observacion_aprobacionanalista_analisis").classList.add('input_1_1');
	}
	
	
}

function validar_campo_cant_cuota(){
 if (document.getElementById("inp_cantcuotas_pcobros_c").value == '') {
    	document.getElementById("inp_cantcuotas_pcobros_c").classList.add('input_1_1_error');
        document.getElementById("inp_cantcuotas_pcobros_c").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cantcuotas_pcobros_c").classList.remove('input_1_1_error');
        document.getElementById("inp_cantcuotas_pcobros_c").classList.add('input_1_1');
	}
}


function validadar_campos_solicitudes(){


    if (document.getElementById("inp_cedula_sc").value == '') {
    	document.getElementById("inp_cedula_sc").classList.add('input_1_1_error');
        document.getElementById("inp_cedula_sc").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cedula_sc").classList.remove('input_1_1_error');
        document.getElementById("inp_cedula_sc").classList.add('input_1_1');
	}
	
    if (document.getElementById("inp_trabajoactual").value == '') {
    	document.getElementById("inp_trabajoactual").classList.add('input_1_1_error');
        document.getElementById("inp_trabajoactual").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_trabajoactual").classList.remove('input_1_1_error');
        document.getElementById("inp_trabajoactual").classList.add('input_1_1');
	}
	
	if (document.getElementById("inp_fecha_s").value == '') {
    	document.getElementById("inp_fecha_s").classList.add('input_1_1_error');
        document.getElementById("inp_fecha_s").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_fecha_s").classList.remove('input_1_1_error');
        document.getElementById("inp_fecha_s").classList.add('input_1_1');
	}
	if (document.getElementById("inp_vendedor").value == '') {
    	document.getElementById("inp_vendedor").classList.add('input_1_1_error');
        document.getElementById("inp_vendedor").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_vendedor").classList.remove('input_1_1_error');
        document.getElementById("inp_vendedor").classList.add('input_1_1');
	}
	if (document.getElementById("inp_direcciontrabajoactual").value == '') {
    	document.getElementById("inp_direcciontrabajoactual").classList.add('input_1_1_error');
        document.getElementById("inp_direcciontrabajoactual").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_direcciontrabajoactual").classList.remove('input_1_1_error');
        document.getElementById("inp_direcciontrabajoactual").classList.add('input_1_1');
	}
	if (document.getElementById("inp_puestoqueocupa").value == '') {
    	document.getElementById("inp_puestoqueocupa").classList.add('input_1_1_error');
        document.getElementById("inp_puestoqueocupa").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_puestoqueocupa").classList.remove('input_1_1_error');
        document.getElementById("inp_puestoqueocupa").classList.add('input_1_1');
	}
	if (document.getElementById("inp_telefonopuestoqueocupa").value == '') {
    	document.getElementById("inp_telefonopuestoqueocupa").classList.add('input_1_1_error');
        document.getElementById("inp_telefonopuestoqueocupa").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_telefonopuestoqueocupa").classList.remove('input_1_1_error');
        document.getElementById("inp_telefonopuestoqueocupa").classList.add('input_1_1');
	}
	if (document.getElementById("inp_antiguedadpuestoqueocupa").value == '') {
    	document.getElementById("inp_antiguedadpuestoqueocupa").classList.add('input_1_1_error');
        document.getElementById("inp_antiguedadpuestoqueocupa").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_antiguedadpuestoqueocupa").classList.remove('input_1_1_error');
        document.getElementById("inp_antiguedadpuestoqueocupa").classList.add('input_1_1');
	}
	if (document.getElementById("inp_trabajoanterior").value == '') {
    	document.getElementById("inp_trabajoanterior").classList.add('input_1_1_error');
        document.getElementById("inp_trabajoanterior").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_trabajoanterior").classList.remove('input_1_1_error');
        document.getElementById("inp_trabajoanterior").classList.add('input_1_1');
	}
    
	if (document.getElementById("inp_telefonotrabajoanterior").value == '') {
    	document.getElementById("inp_telefonotrabajoanterior").classList.add('input_1_1_error');
        document.getElementById("inp_telefonotrabajoanterior").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_telefonotrabajoanterior").classList.remove('input_1_1_error');
        document.getElementById("inp_telefonotrabajoanterior").classList.add('input_1_1');
	}
    
	if (document.getElementById("inp_antiguedadtrabajoanterior").value == '') {
    	document.getElementById("inp_antiguedadtrabajoanterior").classList.add('input_1_1_error');
        document.getElementById("inp_antiguedadtrabajoanterior").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_antiguedadtrabajoanterior").classList.remove('input_1_1_error');
        document.getElementById("inp_antiguedadtrabajoanterior").classList.add('input_1_1');
	}
    
	if (document.getElementById("inp_trabajoantepenultimo").value == '') {
    	document.getElementById("inp_trabajoantepenultimo").classList.add('input_1_1_error');
        document.getElementById("inp_trabajoantepenultimo").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_trabajoantepenultimo").classList.remove('input_1_1_error');
        document.getElementById("inp_trabajoantepenultimo").classList.add('input_1_1');
	}
	
	if (document.getElementById("inp_telefonotrabajoantepenultimo").value == '') {
    	document.getElementById("inp_telefonotrabajoantepenultimo").classList.add('input_1_1_error');
        document.getElementById("inp_telefonotrabajoantepenultimo").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_telefonotrabajoantepenultimo").classList.remove('input_1_1_error');
        document.getElementById("inp_telefonotrabajoantepenultimo").classList.add('input_1_1');
	}
    
	if (document.getElementById("inp_antiguedadtrabajoantepenultimo").value == '') {
    	document.getElementById("inp_antiguedadtrabajoantepenultimo").classList.add('input_1_1_error');
        document.getElementById("inp_antiguedadtrabajoantepenultimo").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_antiguedadtrabajoantepenultimo").classList.remove('input_1_1_error');
        document.getElementById("inp_antiguedadtrabajoantepenultimo").classList.add('input_1_1');
	}
	
	if (document.getElementById("inp_periododeinactividad").value == '') {
    	document.getElementById("inp_periododeinactividad").classList.add('input_1_1_error');
        document.getElementById("inp_periododeinactividad").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_periododeinactividad").classList.remove('input_1_1_error');
        document.getElementById("inp_periododeinactividad").classList.add('input_1_1');
	}
    
	if (document.getElementById("inp_salarioextras").value == '') {
    	document.getElementById("inp_salarioextras").classList.add('input_1_1_error');
        document.getElementById("inp_salarioextras").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_salarioextras").classList.remove('input_1_1_error');
        document.getElementById("inp_salarioextras").classList.add('input_1_1');
	}
	if (document.getElementById("inp_alquilervivienda").value == '') {
    	document.getElementById("inp_alquilervivienda").classList.add('input_1_1_error');
        document.getElementById("inp_alquilervivienda").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_alquilervivienda").classList.remove('input_1_1_error');
        document.getElementById("inp_alquilervivienda").classList.add('input_1_1');
	}
	if (document.getElementById("inp_alquilercomercio").value == '') {
    	document.getElementById("inp_alquilercomercio").classList.add('input_1_1_error');
        document.getElementById("inp_alquilercomercio").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_alquilercomercio").classList.remove('input_1_1_error');
        document.getElementById("inp_alquilercomercio").classList.add('input_1_1');
	}
	if (document.getElementById("inp_banco").value == '') {
    	document.getElementById("inp_banco").classList.add('input_1_1_error');
        document.getElementById("inp_banco").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_banco").classList.remove('input_1_1_error');
        document.getElementById("inp_banco").classList.add('input_1_1');
	}
    
	if (document.getElementById("inp_cooperativa").value == '') {
    	document.getElementById("inp_cooperativa").classList.add('input_1_1_error');
        document.getElementById("inp_cooperativa").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cooperativa").classList.remove('input_1_1_error');
        document.getElementById("inp_cooperativa").classList.add('input_1_1');
	}
    
	if (document.getElementById("inp_financiera").value == '') {
    	document.getElementById("inp_financiera").classList.add('input_1_1_error');
        document.getElementById("inp_financiera").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_financiera").classList.remove('input_1_1_error');
        document.getElementById("inp_financiera").classList.add('input_1_1');
	}
	if (document.getElementById("inp_electrodomesticos").value == '') {
    	document.getElementById("inp_electrodomesticos").classList.add('input_1_1_error');
        document.getElementById("inp_electrodomesticos").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_electrodomesticos").classList.remove('input_1_1_error');
        document.getElementById("inp_electrodomesticos").classList.add('input_1_1');
	}
	if (document.getElementById("inp_usureros").value == '') {
    	document.getElementById("inp_usureros").classList.add('input_1_1_error');
        document.getElementById("inp_usureros").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_usureros").classList.remove('input_1_1_error');
        document.getElementById("inp_usureros").classList.add('input_1_1');
	}
    
	if (document.getElementById("inp_cantidaddehijos").value == '') {
    	document.getElementById("inp_cantidaddehijos").classList.add('input_1_1_error');
        document.getElementById("inp_cantidaddehijos").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cantidaddehijos").classList.remove('input_1_1_error');
        document.getElementById("inp_cantidaddehijos").classList.add('input_1_1');
	}
	if (document.getElementById("inp_montosolicitado").value == '') {
    	document.getElementById("inp_montosolicitado").classList.add('input_1_1_error');
        document.getElementById("inp_montosolicitado").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_montosolicitado").classList.remove('input_1_1_error');
        document.getElementById("inp_montosolicitado").classList.add('input_1_1');
	}
	if (document.getElementById("inp_condicion_s").value == '') {
    	document.getElementById("inp_condicion_s").classList.add('input_1_1_error');
        document.getElementById("inp_condicion_s").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_condicion_s").classList.remove('input_1_1_error');
        document.getElementById("inp_condicion_s").classList.add('input_1_1');
	}
	if (document.getElementById("inp_cuota_s").value == '') {
    	document.getElementById("inp_cuota_s").classList.add('input_1_1_error');
        document.getElementById("inp_cuota_s").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_cuota_s").classList.remove('input_1_1_error');
        document.getElementById("inp_cuota_s").classList.add('input_1_1');
	}
	if (document.getElementById("inp_observacion_vendedor").value == '') {
    	document.getElementById("inp_observacion_vendedor").classList.add('input_1_1_error');
        document.getElementById("inp_observacion_vendedor").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_observacion_vendedor").classList.remove('input_1_1_error');
        document.getElementById("inp_observacion_vendedor").classList.add('input_1_1');
	}
	if (document.getElementById("inp_funcionarioasucargo").value == '') {
    	document.getElementById("inp_funcionarioasucargo").classList.add('input_1_1_error');
        document.getElementById("inp_funcionarioasucargo").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_funcionarioasucargo").classList.remove('input_1_1_error');
        document.getElementById("inp_funcionarioasucargo").classList.add('input_1_1');
	}	
	if (document.getElementById("inp_telefonocomercial").value == '') {
    	document.getElementById("inp_telefonocomercial").classList.add('input_1_1_error');
        document.getElementById("inp_telefonocomercial").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_telefonocomercial").classList.remove('input_1_1_error');
        document.getElementById("inp_telefonocomercial").classList.add('input_1_1');
	}
	if (document.getElementById("inp_direccioncomercial").value == '') {
    	document.getElementById("inp_direccioncomercial").classList.add('input_1_1_error');
        document.getElementById("inp_direccioncomercial").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_direccioncomercial").classList.remove('input_1_1_error');
        document.getElementById("inp_direccioncomercial").classList.add('input_1_1');
	}
	if (document.getElementById("inp_pordiamas").value == '') {
    	document.getElementById("inp_pordiamas").classList.add('input_1_1_error');
        document.getElementById("inp_pordiamas").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_pordiamas").classList.remove('input_1_1_error');
        document.getElementById("inp_pordiamas").classList.add('input_1_1');
	}
	if (document.getElementById("inp_pordiapoco").value == '') {
    	document.getElementById("inp_pordiapoco").classList.add('input_1_1_error');
        document.getElementById("inp_pordiapoco").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_pordiapoco").classList.remove('input_1_1_error');
        document.getElementById("inp_pordiapoco").classList.add('input_1_1');
	}
	if (document.getElementById("inp_porsemanapoco").value == '') {
    	document.getElementById("inp_porsemanapoco").classList.add('input_1_1_error');
        document.getElementById("inp_porsemanapoco").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_porsemanapoco").classList.remove('input_1_1_error');
        document.getElementById("inp_porsemanapoco").classList.add('input_1_1');
	}
	if (document.getElementById("inp_porsemanamas").value == '') {
    	document.getElementById("inp_porsemanamas").classList.add('input_1_1_error');
        document.getElementById("inp_porsemanamas").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_porsemanamas").classList.remove('input_1_1_error');
        document.getElementById("inp_porsemanamas").classList.add('input_1_1');
	}
	if (document.getElementById("inp_porquincenapoco").value == '') {
    	document.getElementById("inp_porquincenapoco").classList.add('input_1_1_error');
        document.getElementById("inp_porquincenapoco").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_porquincenapoco").classList.remove('input_1_1_error');
        document.getElementById("inp_porquincenapoco").classList.add('input_1_1');
	}
	if (document.getElementById("inp_porquincenamas").value == '') {
    	document.getElementById("inp_porquincenamas").classList.add('input_1_1_error');
        document.getElementById("inp_porquincenamas").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_porquincenamas").classList.remove('input_1_1_error');
        document.getElementById("inp_porquincenamas").classList.add('input_1_1');
	}
	if (document.getElementById("inp_pormespoco").value == '') {
    	document.getElementById("inp_pormespoco").classList.add('input_1_1_error');
        document.getElementById("inp_pormespoco").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_pormespoco").classList.remove('input_1_1_error');
        document.getElementById("inp_pormespoco").classList.add('input_1_1');
	}
	if (document.getElementById("inp_pormesmas").value == '') {
    	document.getElementById("inp_pormesmas").classList.add('input_1_1_error');
        document.getElementById("inp_pormesmas").classList.remove('input_1_1');
    }else{	
    	document.getElementById("inp_pormesmas").classList.remove('input_1_1_error');
        document.getElementById("inp_pormesmas").classList.add('input_1_1');
	}
   

    var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var clientes_cod = document.getElementById('inp_idClientes_sc').value
	var monto1 = document.getElementById('inp_montosolicitado').value
	var condicion = document.getElementById('inp_condicion_s').value
	var plazo = document.getElementById('inp_cuota_s').value
	var monto=monto1.toString().replace(/\./g,'');
	var obsvendedor = document.getElementById('inp_observacion_vendedor').value
	var nrosolicitud = document.getElementById('inp_nrosolicitud').value
	var otroingreso = document.getElementById('inp_tinesingresoonegociopropio').value
	var direccion = document.getElementById('inp_direccioncomercial').value
	var telefono = document.getElementById('inp_telefonocomercial').value
	var funcionarioacargo = document.getElementById('inp_funcionarioasucargo').value
	var trabajoactual = document.getElementById('inp_trabajoactual').value
	var direccionta = document.getElementById('inp_direcciontrabajoactual').value
	var puestoqueocupa = document.getElementById('inp_puestoqueocupa').value
	var telefonopo = document.getElementById('inp_telefonopuestoqueocupa').value
	var antiguedadpo = document.getElementById('inp_antiguedadpuestoqueocupa').value
	var trabajoanterior = document.getElementById('inp_trabajoanterior').value
	var telefonota = document.getElementById('inp_telefonotrabajoanterior').value
	var antiguedadta = document.getElementById('inp_antiguedadtrabajoanterior').value
	var trabajoantepenultimo = document.getElementById('inp_trabajoantepenultimo').value
	var telefonotante = document.getElementById('inp_telefonotrabajoantepenultimo').value
	var antiguedadante = document.getElementById('inp_antiguedadtrabajoantepenultimo').value
	var periododeinactividad = document.getElementById('inp_periododeinactividad').value
	var infopositiva = document.getElementById('inp_informacionpositiva').value
	var infonegativa = document.getElementById('inp_informacionnegativa').value
	var diapoco1 = document.getElementById('inp_pordiapoco').value
	var diapoco=diapoco1.toString().replace(/\./g,'');
	var diamas1 = document.getElementById('inp_pordiamas').value
	var diamas=diamas1.toString().replace(/\./g,'');
	var semanapoco1 = document.getElementById('inp_porsemanapoco').value
	var semanapoco=semanapoco1.toString().replace(/\./g,'');
	var semanamas1 = document.getElementById('inp_porsemanamas').value
	var semanamas=semanamas1.toString().replace(/\./g,'');
	var mespoco1 = document.getElementById('inp_pormespoco').value
	var mespoco=mespoco1.toString().replace(/\./g,'');
	var mesmas1 = document.getElementById('inp_pormesmas').value
	var mesmas=mesmas1.toString().replace(/\./g,'');
	var vivienda1 = document.getElementById('inp_alquilervivienda').value
	var vivienda=vivienda1.toString().replace(/\./g,'');
	var comercio1 = document.getElementById('inp_alquilercomercio').value
	var comercio=comercio1.toString().replace(/\./g,'');
	var banco1 = document.getElementById('inp_banco').value
	var banco=banco1.toString().replace(/\./g,'');
	var cooperativa1 = document.getElementById('inp_cooperativa').value
	var cooperativa=cooperativa1.toString().replace(/\./g,'');
	var financiera1 = document.getElementById('inp_financiera').value
	var financiera=financiera1.toString().replace(/\./g,'');
	var electrodomesticos1 = document.getElementById('inp_electrodomesticos').value
	var electrodomesticos=electrodomesticos1.toString().replace(/\./g,'');
	var usureros1 = document.getElementById('inp_usureros').value
	var usureros=usureros1.toString().replace(/\./g,'');
	var salario1 = document.getElementById('inp_salariomensual').value
	var salario=salario1.toString().replace(/\./g,'');
	var quincenapoco1 = document.getElementById('inp_porquincenapoco').value
	var quincenapoco=quincenapoco1.toString().replace(/\./g,'');
	var quincenamas1 = document.getElementById('inp_porquincenamas').value
	var quincenamas=quincenamas1.toString().replace(/\./g,'');
	var extras1 = document.getElementById('inp_salarioextras').value
	var extras=extras1.toString().replace(/\./g,'');
    var actividadeconomica = document.getElementById('inp_actividadescomerciales').value
	var cantidad_hijos = document.getElementById('inp_cantidaddehijos').value

    if( clientes_cod=="" || condicion=="" || plazo=="" || monto=="" || nrosolicitud=="" || otroingreso=="" || direccion=="" || telefono=="" || funcionarioacargo=="" || trabajoactual=="" || direccionta=="" || puestoqueocupa=="" || telefonopo=="" || antiguedadpo=="" || trabajoanterior=="" || telefonota=="" || antiguedadta=="" || trabajoantepenultimo=="" || telefonotante=="" || antiguedadante=="" || periododeinactividad=="" || diapoco=="" || diamas=="" || semanapoco=="" || semanamas=="" || mespoco=="" || mesmas=="" || vivienda=="" || comercio=="" || banco=="" || cooperativa=="" || financiera=="" || electrodomesticos=="" || usureros=="" || salario=="" || quincenapoco=="" || quincenamas=="" || extras=="" || actividadeconomica=="" || cantidad_hijos=="" ){
    return;
   }



 
}  

  
var condicion_solicitudes=1;
/*AÑADIR O MODIFICAR NUEVO CUOTEROS*/
function add_datos_solicitudescredito(estadosolicitud_credito,acc,nrosolici) {
	validadar_campos_solicitudes();
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idsolicitudescredito').value
	var fecha = document.getElementById('inp_fecha_s').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var clientes_cod = document.getElementById('inp_idClientes_sc').value
    var vendedor_cod = document.getElementById('inp_vendedor').value
    var plazosolicitado = document.getElementById('inp_cuota_s').value
    var condicionsolicitado = document.getElementById('inp_condicion_s').value
	var monto1 = document.getElementById('inp_cuota_s').value
	var monto=monto1.toString().replace(/\./g,'');
	var obsvendedor = document.getElementById('inp_observacion_vendedor').value
	var nrosolicitud = document.getElementById('inp_nrosolicitud').value
	var otroingreso = document.getElementById('inp_tinesingresoonegociopropio').value
	var direccion = document.getElementById('inp_direccioncomercial').value
	var telefono = document.getElementById('inp_telefonocomercial').value
	var funcionarioacargo = document.getElementById('inp_funcionarioasucargo').value
	var trabajoactual = document.getElementById('inp_trabajoactual').value
	var direccionta = document.getElementById('inp_direcciontrabajoactual').value
	var puestoqueocupa = document.getElementById('inp_puestoqueocupa').value
	var telefonopo = document.getElementById('inp_telefonopuestoqueocupa').value
	var antiguedadpo = document.getElementById('inp_antiguedadpuestoqueocupa').value
	var trabajoanterior = document.getElementById('inp_trabajoanterior').value
	var telefonota = document.getElementById('inp_telefonotrabajoanterior').value
	var antiguedadta = document.getElementById('inp_antiguedadtrabajoanterior').value
	var trabajoantepenultimo = document.getElementById('inp_trabajoantepenultimo').value
	var telefonotante = document.getElementById('inp_telefonotrabajoantepenultimo').value;
	var antiguedadante = document.getElementById('inp_antiguedadtrabajoantepenultimo').value;
	var periododeinactividad = document.getElementById('inp_periododeinactividad').value;
	var infopositiva = document.getElementById('inp_informacionpositiva').value;
	var infonegativa = document.getElementById('inp_informacionnegativa').value;
	var diapoco1 = document.getElementById('inp_pordiapoco').value;
	var diapoco=diapoco1.toString().replace(/\./g,'');
	var diamas1 = document.getElementById('inp_pordiamas').value
	var diamas=diamas1.toString().replace(/\./g,'');
	var semanapoco1 = document.getElementById('inp_porsemanapoco').value
	var semanapoco=semanapoco1.toString().replace(/\./g,'');
	var semanamas1 = document.getElementById('inp_porsemanamas').value
	var semanamas=semanamas1.toString().replace(/\./g,'');
	var mespoco1 = document.getElementById('inp_pormespoco').value
	var mespoco=mespoco1.toString().replace(/\./g,'');
	var mesmas1 = document.getElementById('inp_pormesmas').value
	var mesmas=mesmas1.toString().replace(/\./g,'');
	var vivienda1 = document.getElementById('inp_alquilervivienda').value
	var vivienda=vivienda1.toString().replace(/\./g,'');
	var comercio1 = document.getElementById('inp_alquilercomercio').value
	var comercio=comercio1.toString().replace(/\./g,'');
	var banco1 = document.getElementById('inp_banco').value
	var banco=banco1.toString().replace(/\./g,'');
	var cooperativa1 = document.getElementById('inp_cooperativa').value
	var cooperativa=cooperativa1.toString().replace(/\./g,'');
	var financiera1 = document.getElementById('inp_financiera').value
	var financiera=financiera1.toString().replace(/\./g,'');
	var electrodomesticos1 = document.getElementById('inp_electrodomesticos').value
	var electrodomesticos=electrodomesticos1.toString().replace(/\./g,'');
	var usureros1 = document.getElementById('inp_usureros').value
	var usureros=usureros1.toString().replace(/\./g,'');
	var salario1 = document.getElementById('inp_salariomensual').value
	var salario=salario1.toString().replace(/\./g,'');
	var quincenapoco1 = document.getElementById('inp_porquincenapoco').value
	var quincenapoco=quincenapoco1.toString().replace(/\./g,'');
	var quincenamas1 = document.getElementById('inp_porquincenamas').value
	var quincenamas=quincenamas1.toString().replace(/\./g,'');
	var extras1 = document.getElementById('inp_salarioextras').value
	var extras=extras1.toString().replace(/\./g,'');
    var actividadeconomica = document.getElementById('inp_actividadescomerciales').value
	var cantidad_hijos = document.getElementById('inp_cantidaddehijos').value

	var accion = 'guardar'
	if (acc == 'guardar') {
		accion = 'guardar'
	} 
	ver_vetana_informativa("Cargando....", id_progreso);
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("condicion", condicion_solicitudes)
	datos.append("cantidad_hijos", cantidad_hijos)
	datos.append("quincenapoco", quincenapoco)
	datos.append("extras", extras)
	datos.append("quincenamas", quincenamas)
	datos.append("usureros", usureros)
	datos.append("salario", salario)
	datos.append("electrodomesticos", electrodomesticos)
	datos.append("financiera", financiera)
	datos.append("cooperativa", cooperativa)
	datos.append("banco", banco)
	datos.append("comercio", comercio)
	datos.append("vivienda", vivienda)
	datos.append("mesmas", mesmas)
	datos.append("mespoco", mespoco)
	datos.append("semanamas", semanamas)
	datos.append("semanapoco", semanapoco)
	datos.append("diamas", diamas)
	datos.append("diapoco", diapoco)
	datos.append("infonegativa", infonegativa)
	datos.append("infopositiva", infopositiva)
	datos.append("periododeinactividad", periododeinactividad)
	datos.append("antiguedadante", antiguedadante)
	datos.append("telefonotante", telefonotante)
	datos.append("trabajoantepenultimo", trabajoantepenultimo)
	datos.append("antiguedadta", antiguedadta)
	datos.append("telefonota", telefonota)
	datos.append("trabajoanterior", trabajoanterior)
	datos.append("antiguedadpo", antiguedadpo)
	datos.append("telefonopo", telefonopo)
	datos.append("puestoqueocupa", puestoqueocupa)
	datos.append("direccionta", direccionta)
	datos.append("trabajoactual", trabajoactual)
	datos.append("cod", cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("clientes_cod", clientes_cod)
	datos.append("monto", monto)
	datos.append("obsvendedor", obsvendedor)
	datos.append("nrosolicitud", nrosolicitud)
	datos.append("otroingreso", otroingreso)
	datos.append("direccion", direccion)
	datos.append("telefono", telefono)
	datos.append("funcionarioacargo", funcionarioacargo)
	datos.append("hora", hora)
	datos.append("actividadeconomica",actividadeconomica)
	datos.append("estadosolicitud", estadosolicitud_credito)
	datos.append("nrosoli", nrosolici)
	datos.append("vendedor_cod", vendedor_cod)
	datos.append("fecha", fecha)
	datos.append("plazosolicitado", plazosolicitado)
	datos.append("condicionsolicitado", condicionsolicitado)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/Solicitudes.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_vetana_informativa("FALTÓ COMPLETAR ALGUN CAMPO", id_progreso);
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_vetana_informativa("DATO DUPLICADO", id_progreso);
				return false;
			}
			if (Respuesta == "in") {
				ver_vetana_informativa("DATO INCORRECTO", id_progreso);
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					/* limpiar_campos_solicitudescredito(); */
					CargarReferenciasPersonales();
				} 
			} else {

				ver_vetana_informativa("LO SENTIMOS OCURRIO ALGO INESPERADO!", id_progreso)
				//limpiar_campos_clientes();
			}
		}
	});


}

function limpiar_campos_solicitudescredito() {
		 buscar_condiciones_solicitud();
        document.getElementById('inp_idsolicitudescredito').value="";
	    document.getElementById('inp_idClientes_sc').value="";
	    document.getElementById('inp_cedula_sc').value="";
	    document.getElementById('inp_salarioextras').value="";
	    document.getElementById('inp_nombres_sc').value="";
	    document.getElementById('inp_observacion_vendedor').value="";
	    document.getElementById('inp_direccioncomercial').value="";
	    document.getElementById('inp_telefonocomercial').value="";
	    document.getElementById('inp_funcionarioasucargo').value="";
	    document.getElementById('inp_trabajoactual').value="";
	    document.getElementById('inp_direcciontrabajoactual').value="";
	    document.getElementById('inp_puestoqueocupa').value="";
	    document.getElementById('inp_telefonopuestoqueocupa').value="";
	    document.getElementById('inp_antiguedadpuestoqueocupa').value="";
	    document.getElementById('inp_trabajoanterior').value="";
	    document.getElementById('inp_telefonotrabajoanterior').value="";
	    document.getElementById('inp_antiguedadtrabajoanterior').value="";
	    document.getElementById('inp_trabajoantepenultimo').value="";
	    document.getElementById('inp_telefonotrabajoantepenultimo').value="";
	    document.getElementById('inp_antiguedadtrabajoantepenultimo').value="";
	    document.getElementById('inp_periododeinactividad').value="";
	    document.getElementById('inp_informacionpositiva').value="";
	    document.getElementById('inp_informacionnegativa').value="";
        document.getElementById('inp_pordiapoco').value="";
	    document.getElementById('inp_pordiamas').value="";
	    document.getElementById('inp_porsemanapoco').value="";
	    document.getElementById('inp_porsemanamas').value="";
	    document.getElementById('inp_pormespoco').value="";
	    document.getElementById('inp_pormesmas').value="";
	    document.getElementById('inp_alquilervivienda').value="";
	    document.getElementById('inp_alquilercomercio').value="";
	    document.getElementById('inp_banco').value="";
	    document.getElementById('inp_cooperativa').value="";
	    document.getElementById('inp_financiera').value="";
	    document.getElementById('inp_electrodomesticos').value="";
	    document.getElementById('inp_usureros').value="";
	    document.getElementById('inp_cantidaddehijos').value="";
	    document.getElementById('inp_observacion_analista_solicitud').value="";
	    document.getElementById('etiqueta_fotos').innerHTML="";
	    document.getElementById('table_archivos').innerHTML="";
	    document.getElementById('cnt_datospersonales').innerHTML="";
	    document.getElementById('cnt_referencias_comerciales').innerHTML="";
        document.getElementById("inp_cedula_sc").classList.remove('input_1_1_error');
        document.getElementById("inp_cedula_sc").classList.add('input_1_1');
        document.getElementById("inp_trabajoactual").classList.remove('input_1_1_error');
        document.getElementById("inp_trabajoactual").classList.add('input_1_1');
        document.getElementById("inp_direcciontrabajoactual").classList.remove('input_1_1_error');
        document.getElementById("inp_direcciontrabajoactual").classList.add('input_1_1');
        document.getElementById("inp_puestoqueocupa").classList.remove('input_1_1_error');
        document.getElementById("inp_puestoqueocupa").classList.add('input_1_1');
        document.getElementById("inp_telefonopuestoqueocupa").classList.remove('input_1_1_error');
        document.getElementById("inp_telefonopuestoqueocupa").classList.add('input_1_1');
        document.getElementById("inp_antiguedadpuestoqueocupa").classList.remove('input_1_1_error');
        document.getElementById("inp_antiguedadpuestoqueocupa").classList.add('input_1_1');
        document.getElementById("inp_telefonotrabajoanterior").classList.remove('input_1_1_error');
        document.getElementById("inp_telefonotrabajoanterior").classList.add('input_1_1');
	    document.getElementById("inp_antiguedadtrabajoanterior").classList.remove('input_1_1_error');
        document.getElementById("inp_antiguedadtrabajoanterior").classList.add('input_1_1');	
		document.getElementById("inp_trabajoantepenultimo").classList.remove('input_1_1_error');
        document.getElementById("inp_trabajoantepenultimo").classList.add('input_1_1');
		document.getElementById("inp_telefonotrabajoantepenultimo").classList.remove('input_1_1_error');
        document.getElementById("inp_telefonotrabajoantepenultimo").classList.add('input_1_1');
		document.getElementById("inp_antiguedadtrabajoantepenultimo").classList.remove('input_1_1_error');
        document.getElementById("inp_antiguedadtrabajoantepenultimo").classList.add('input_1_1');
		document.getElementById("inp_periododeinactividad").classList.remove('input_1_1_error');
        document.getElementById("inp_periododeinactividad").classList.add('input_1_1');
		document.getElementById("inp_salarioextras").classList.remove('input_1_1_error');
        document.getElementById("inp_salarioextras").classList.add('input_1_1');
	    document.getElementById("inp_alquilercomercio").classList.remove('input_1_1_error');
        document.getElementById("inp_alquilercomercio").classList.add('input_1_1');	
	    document.getElementById("inp_cooperativa").classList.remove('input_1_1_error');
        document.getElementById("inp_cooperativa").classList.add('input_1_1');
	    document.getElementById("inp_cooperativa").classList.remove('input_1_1_error');
        document.getElementById("inp_cooperativa").classList.add('input_1_1');
		document.getElementById("inp_financiera").classList.remove('input_1_1_error');
        document.getElementById("inp_financiera").classList.add('input_1_1');
		document.getElementById("inp_electrodomesticos").classList.remove('input_1_1_error');
        document.getElementById("inp_electrodomesticos").classList.add('input_1_1');
		document.getElementById("inp_usureros").classList.remove('input_1_1_error');
        document.getElementById("inp_usureros").classList.add('input_1_1');
		document.getElementById("inp_cantidaddehijos").classList.remove('input_1_1_error');
        document.getElementById("inp_cantidaddehijos").classList.add('input_1_1');
		document.getElementById("inp_montosolicitado").classList.remove('input_1_1_error');
        document.getElementById("inp_montosolicitado").classList.add('input_1_1');
	    document.getElementById("inp_observacion_vendedor").classList.remove('input_1_1_error');
        document.getElementById("inp_observacion_vendedor").classList.add('input_1_1');		
		document.getElementById("inp_trabajoanterior").classList.remove('input_1_1_error');
        document.getElementById("inp_trabajoanterior").classList.add('input_1_1');		
		document.getElementById("inp_alquilervivienda").classList.remove('input_1_1_error');
        document.getElementById("inp_alquilervivienda").classList.add('input_1_1');		
		document.getElementById("inp_banco").classList.remove('input_1_1_error');
        document.getElementById("inp_banco").classList.add('input_1_1');
	
	document.getElementById("inp_funcionarioasucargo").classList.remove('input_1_1_error');
        document.getElementById("inp_funcionarioasucargo").classList.add('input_1_1');
		document.getElementById("inp_telefonocomercial").classList.remove('input_1_1_error');
        document.getElementById("inp_telefonocomercial").classList.add('input_1_1');
		document.getElementById("inp_direccioncomercial").classList.remove('input_1_1_error');
        document.getElementById("inp_direccioncomercial").classList.add('input_1_1');
	document.getElementById("inp_pordiamas").classList.remove('input_1_1_error');
        document.getElementById("inp_pordiamas").classList.add('input_1_1');
		document.getElementById("inp_pordiapoco").classList.remove('input_1_1_error');
        document.getElementById("inp_pordiapoco").classList.add('input_1_1');
		document.getElementById("inp_porsemanapoco").classList.remove('input_1_1_error');
        document.getElementById("inp_porsemanapoco").classList.add('input_1_1');
		document.getElementById("inp_porsemanamas").classList.remove('input_1_1_error');
        document.getElementById("inp_porsemanamas").classList.add('input_1_1');
		document.getElementById("inp_porquincenapoco").classList.remove('input_1_1_error');
        document.getElementById("inp_porquincenapoco").classList.add('input_1_1');
		document.getElementById("inp_porquincenamas").classList.remove('input_1_1_error');
        document.getElementById("inp_porquincenamas").classList.add('input_1_1');
		document.getElementById("inp_pormespoco").classList.remove('input_1_1_error');
        document.getElementById("inp_pormespoco").classList.add('input_1_1');
			document.getElementById("inp_pormesmas").classList.remove('input_1_1_error');
        document.getElementById("inp_pormesmas").classList.add('input_1_1');
			  $("#inp_actividadescomerciales").val("ASALARIADO");
			  $("#inp_tinesingresoonegociopropio").val("NO");
			  $("#inp_tinesingresoonegociopropio").val("NO");
			  $("#inp_montosolicitado").val("");
			  $("#inp_vendedor").val("");
			  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
   var mes1 = fecha.getMonth()+2; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10){
    dia='0'+dia;
  }	//agrega cero si el menor de 10
  if(mes<10){
    mes='0'+mes
  }
  if(mes1<10){
    mes1='0'+mes1
  }  //agrega cero si el menor de 10
  document.getElementById('inp_fecha_s').value=ano+"-"+mes+"-"+dia
	
}

/*AÑADIR O MODIFICAR NUEVO CUOTEROS*/
function add_datos_cuoteros(datos) {
	ver_cerrar_ventana_cargando("1");
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idcuoteros').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var condicion = document.getElementById('inp_condision_c').value
	var montodisponible1 = document.getElementById('inp_monto_c').value
	var montodisponible=montodisponible1.toString().replace(/\./g,'');
	var plazo1 = document.getElementById('inp_cuota_c').value
	var plazo=plazo1.toString().replace(/\./g,'');
	var montocuota1 = document.getElementById('inp_preciocuota_c').value
	var montocuota=montocuota1.toString().replace(/\./g,'');
	

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_cuoteros"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_cuoteros"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando...");
	
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("condicion", condicion)
	datos.append("montodisponible", montodisponible)
	datos.append("plazo", plazo)
	datos.append("montocuota", montocuota)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmCuoteros.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				
			
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_cuoteros();
					buscar_datos_cuoteros("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
			
					limpiar_campos_cuoteros();
					buscar_datos_cuoteros("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
				
					limpiar_campos_cuoteros();
					buscar_datos_cuoteros("ACTIVO");
				}

			} else {
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				
			
				//limpiar_campos_clientes();
			}
		}
	});


}

function limpiar_campos_cuoteros() {
    document.getElementById('inp_idcuoteros').value= ''
	document.getElementById('inp_monto_c').value= ''
	document.getElementById('inp_cuota_c').value= ''
	document.getElementById('inp_preciocuota_c').value= ''
	document.getElementById('btn_guardar_cuoteros').innerHTML = "<p style='display:none;' id='accion_guardar_cuoteros'>guardar</p>GUARDAR";
}

var estado_cuoteros = 'ACTIVO';
function buscar_por_opciones_cuoteros(d) {
	if (d == "1") {
		estado_cuoteros = 'ACTIVO';
		buscar_datos_cuoteros(estado_cuoteros);
		abrir_cerrar_ventanas_cuoteros("6");
	}
	if (d == "2") {
		estado_cuoteros = 'ELIMINADO';
		buscar_datos_cuoteros(estado_cuoteros);
		abrir_cerrar_ventanas_cuoteros("6");
	}

}

//busccar datos cuoteros
function buscar_datos_cuoteros(buscar2) {
	var buscador = document.getElementById('inpt_buscador_cuoteros').value
	document.getElementById("cnt_listado_cuoteros").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmCuoteros.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_cuoteros").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_cuoteros").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_cuoteros").innerHTML = datos_buscados
					document.getElementById("lbltotalcuoteros").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_datos_cuoteros(datospr) {
	

	  document.getElementById('inp_idcuoteros').value=$(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_condision_c').value= $(datospr).children('td[id="td_condicion"]').html();
	document.getElementById('inp_monto_c').value= $(datospr).children('td[id="td_montodisponible"]').html();
	document.getElementById('inp_cuota_c').value= $(datospr).children('td[id="td_plazo"]').html();
	document.getElementById('inp_preciocuota_c').value= $(datospr).children('td[id="td_montocuota"]').html();
	
	
	document.getElementById('btn_guardar_cuoteros').innerHTML = "<p style='display:none;' id='accion_guardar_cuoteros'>editar</p>EDITAR";
	abrir_cerrar_ventanas_cuoteros("4");
}


/*AÑADIR O MODIFICAR NUEVO FUNCIONARIOS*/
function add_datos_usuarios(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	var cod = document.getElementById('inp_idusuarios').value
	 var sucursales_cod = document.getElementById('inp_sucursal_solicitud').value
	var comisionventa1 = document.getElementById('inp_comisionventa').value
	 var comisionventa=comisionventa1.toString().replace(/\./g,'');
	var comisioncobro1 = document.getElementById('inp_comisioncobro').value
	var comisioncobro=comisioncobro1.toString().replace(/\./g,'');
	var accesos_cod = document.getElementById('combo_idrol_df').value
	var personas_cod = document.getElementById('inp_idpersonas_df').value
	var user = document.getElementById('inp_user').value
	var pass = document.getElementById('inp_pass').value
	var clavepermiso = document.getElementById('inp_clavepermiso').value
	var fechaegreso = document.getElementById('inp_fecha_salida').value
	var fechaingreso = document.getElementById('inp_fecha_ingreso').value
	var motivo = document.getElementById('inp_motivosalida').value
	

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_usuarios"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_usuarios"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
ver_cerrar_ventana_cargando("1","Cargando..."); 

	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("comisionventa", comisionventa)
	datos.append("comisioncobro", comisioncobro)
	datos.append("personas_cod", personas_cod)
	datos.append("sucursales_cod", sucursales_cod)
	datos.append("accesos_cod", accesos_cod)
	datos.append("user", user)
	datos.append("pass", pass)
	datos.append("clavepermiso", clavepermiso)
	datos.append("fechaegreso", fechaegreso)
	datos.append("motivo", motivo)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("hora", hora)
	datos.append("fechaingreso", fechaingreso)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmUsuarios.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			
            ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!"); 
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
			
                ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO"); 
				return false;
			}
			if (Respuesta == "duplicado") {
				
               ver_cerrar_ventana_cargando("2","DATO DUPLICADO"); 
				return false;
			}
			if (Respuesta == "in") {
				
               ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					
               ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_usuarios();
					buscar_datos_usuarios("ACTIVO");
				} 
				if (accion == 'editar') {
					
               ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
					limpiar_campos_usuarios();
					buscar_datos_usuarios("ACTIVO");
				} 
				if (accion == 'eliminar') {
					
               ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
					limpiar_campos_usuarios();
					buscar_datos_usuarios("ACTIVO");
				}

			} else {
               ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				//limpiar_campos_tipospersonas();
			}
		}
	});


}

function limpiar_campos_usuarios() {
    document.getElementById('inp_comisionventa').value= ''
    document.getElementById('inp_comisioncobro').value= ''
	document.getElementById('inp_idusuarios').value= ''
    document.getElementById('inp_idpersonas_df').value= ''
    document.getElementById('inp_cedula_df').value= ''
    document.getElementById('inp_nombres_df').value= ''
    document.getElementById('inp_user').value= ''
    document.getElementById('inp_pass').value= ''
    document.getElementById('inp_clavepermiso').value= ''
	document.getElementById('inp_fecha_salida').value= ''
	document.getElementById('inp_fecha_salida').value= ''
	document.getElementById('btn_guardar_usuarios').innerHTML = "<p style='display:none;' id='accion_guardar_usuarios'>guardar</p>GUARDAR";
}

var estado_usuarios = 'ACTIVO';
function buscar_por_opciones_usuarios(d) {
	if (d == "1") {
		estado_usuarios = 'ACTIVO';
		buscar_datos_usuarios(estado_usuarios);
		abrir_cerrar_ventanas_usuarios("6");
	}
	if (d == "2") {
		estado_usuarios = 'ELIMINADO';
		buscar_datos_usuarios(estado_usuarios);
		abrir_cerrar_ventanas_usuarios("6");
	}

}

//busccar datos usuarios
function buscar_datos_usuarios(buscar2) {
	var buscador = document.getElementById('inpt_buscador_usuarios').value
	document.getElementById("cnt_listado_usuarios").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmUsuarios.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_usuarios").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_usuarios").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_usuarios").innerHTML = datos_buscados
					document.getElementById("lbltotalusuarios").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_datos_usuarios(datospr) {
	document.getElementById('inp_comisionventa').value= $(datospr).children('td[id="td_comisionventa"]').html();
    document.getElementById('inp_comisioncobro').value= $(datospr).children('td[id="td_comisioncobro"]').html();
	document.getElementById('inp_idusuarios').value= $(datospr).children('td[id="td_cod"]').html();
    document.getElementById('inp_idpersonas_df').value= $(datospr).children('td[id="td_personas_cod"]').html();
    document.getElementById('inp_cedula_df').value=  $(datospr).children('td[id="td_cedula"]').html();
    document.getElementById('inp_nombres_df').value=  $(datospr).children('td[id="td_nombres"]').html();
    document.getElementById('inp_user').value=  $(datospr).children('td[id="td_user"]').html();
    document.getElementById('inp_pass').value=  $(datospr).children('td[id="td_pass"]').html();
    document.getElementById('inp_clavepermiso').value=  $(datospr).children('td[id="td_clavepermiso"]').html();
	document.getElementById('inp_fecha_salida').value= $(datospr).children('td[id="td_fechaegreso"]').html();
	document.getElementById('inp_motivosalida').value=$(datospr).children('td[id="td_motivo"]').html();
	document.getElementById('combo_idrol_df').value=$(datospr).children('td[id="td_accesos_cod"]').html();
	document.getElementById('inp_sucursal_solicitud').value=$(datospr).children('td[id="td_sucursales_cod"]').html();
	document.getElementById('btn_guardar_usuarios').innerHTML = "<p style='display:none;' id='accion_guardar_usuarios'>editar</p>EDITAR";
	abrir_cerrar_ventanas_usuarios("4");
}

/*AÑADIR O MODIFICAR NUEVO DATOS PERSONALES*/
function add_datos_datospersonales(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_iddatospersonales').value
	var primernombre = document.getElementById('inp_primernombre_dp').value
	
	var segundonombre = document.getElementById('inp_segundonombre_dp').value
	var primerapellido = document.getElementById('inp_primerapellido_dp').value
	var segundoapellido = document.getElementById('inp_segundoapellido_dp').value
	var apellidocasada = document.getElementById('inp_apellidocasada_dp').value
	var cedula = document.getElementById('inp_cedula_dp').value
	var ruc = document.getElementById('inp_ruc_dp').value
	var fechanac = document.getElementById('inp_fechanac_dp').value
	var conyuge = document.getElementById('inp_conyugue_dp').value
	var direccion = document.getElementById('inp_direccion_dp').value
	var referenciadireccio = document.getElementById('inp_referencia_dp').value
	var telefono = document.getElementById('inp_telefono_dp').value
	
	var correo = document.getElementById('inp_correo_dp').value
	var sexo = document.getElementById('inp_sexo_dp').value
	var viviendapropia = document.getElementById('inp_viviendapropia_dp').value
	var observacion = document.getElementById('inp_observacion_dp').value
	var lnglat = document.getElementById('inp_lnglat_dp').value
	
	var barrios_cod = document.getElementById('inp_idbarrios_dp').value
	var nacionalidad_cod = document.getElementById('combo_idnacionalidad_dp').value
	var estadosciviles_cod = document.getElementById('combo_idestadocivil_dp').value
	var tipospersonas_cod = document.getElementById('combo_idtipospersonas_dp').value
	var profesiones_cod = document.getElementById('inp_idprofesiones_dp').value
	var usuarios_cod = document.getElementById('idusuarios_datos').innerHTML;
	
	
	
  
   if(parseInt(calcularEdad(fechanac))<=17){
	 ver_vetana_informativa("SISTEMA NO ADMITE MENORES DE 18 AÑOS", id_progreso);
     return;	 
   } 
    
   if(parseInt(calcularEdad(fechanac))>=66){
	   ver_vetana_validar_fecha("CLIENTE SUPERA LOS 65 AÑOS ¿DESEAS ADMITIR?",id_progreso,"1");
   } 
   if(profesiones_cod==""){
	 ver_vetana_informativa("FALTA SELECCIONAR TIPO PROFESION", id_progreso);
     return;	 
   }
   if(fechanac==""){
	 ver_vetana_informativa("FALTA SELECCIONAR 	FECHA DE NACIMIENTO", id_progreso);
     return;	 
   }
   
   if(tipospersonas_cod==""){
	 ver_vetana_informativa("FALTA SELECCIONAR TIPO PERSONA", id_progreso);
     return;	 
   }
   if(barrios_cod==""){
	 ver_vetana_informativa("FALTA SELECCIONAR BARRIOS", id_progreso);
     return;	 
   }
   if(nacionalidad_cod==""){
	 ver_vetana_informativa("FALTA SELECCIONAR NACIONALIDAD", id_progreso);
	
     return;	 
   }
   if(telefono==""){
	 ver_vetana_informativa("FALTA COMPLETAR CAMPO OBLIGATORIO", id_progreso);
	  document.getElementById("inp_telefono_dp").focus();
     return;	 
   }
   if(primernombre==""){
	 ver_vetana_informativa("FALTA COMPLETAR CAMPO OBLIGATORIO", id_progreso);
	  document.getElementById("inp_primernombre_dp").focus();
     return;	 
   }
	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_datospersonales"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_datospersonales"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	 ver_cerrar_ventana_cargando("1","Cargando..."); 
	
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("primernombre", primernombre)
	datos.append("segundonombre", segundonombre)
	datos.append("primerapellido", primerapellido)
	datos.append("segundoapellido", segundoapellido)
    datos.append("apellidocasada", apellidocasada)
    datos.append("cedula", cedula)
	datos.append("ruc", ruc)
	datos.append("fechanac", fechanac)
	datos.append("conyuge", conyuge)
	datos.append("direccion", direccion)
	datos.append("referenciadireccio", referenciadireccio)
	datos.append("telefono", telefono)
	datos.append("correo", correo)
	datos.append("sexo", sexo)
	datos.append("viviendapropia", viviendapropia)
	datos.append("observacion", observacion)
	datos.append("lnglat", lnglat)
	datos.append("barrios_cod", barrios_cod)
	datos.append("nacionalidad_cod", nacionalidad_cod)
	datos.append("estadosciviles_cod", estadosciviles_cod)
	datos.append("tipospersonas_cod", tipospersonas_cod)
	datos.append("profesiones_cod", profesiones_cod)
	datos.append("usuarios_cod", usuarios_cod)
	datos.append("hora", hora)
	datos.append("clavepermisofech",id_clave_permiso)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmDatosPersonas.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			
               ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!"); 

			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				
                ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO"); 
				return false;
			}
			if (Respuesta == "duplicado") {
			
                ver_cerrar_ventana_cargando("2","DATO DUPLICADO"); 
				return false;
			}
			if (Respuesta == "in") {
				
                ver_cerrar_ventana_cargando("2","DATO INCORRECTO"); 
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
				if (control_cerrar_datospersonales == "1") {
				
                ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE"); 
					limpiar_campos_datospersonales();
					buscar_datos_datospersonales("ACTIVO");
                  id_clave_permiso="";
				}else
				if (control_cerrar_datospersonales == "3") {
				
                ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE"); 
					buscar_datos_iddatospersonas();
					
					limpiar_campos_datospersonales();
					document.getElementById('inp_nombres_df').value=primernombre+" "+segundonombre+" "+primerapellido+" "+segundoapellido+" "+apellidocasada;
					limpiar_campos_datospersonales();
					abrir_cerrar_ventanas_datospersonales("2");
                  id_clave_permiso="";
				}else
				if (control_cerrar_datospersonales == "5") {
				   
                ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE"); 
					 buscar_datos_iddatospersonas_clientes();
					document.getElementById('inp_nombres_dc').value=primernombre+" "+segundonombre+" "+primerapellido+" "+segundoapellido+" "+apellidocasada;
					limpiar_campos_datospersonales(); 
					abrir_cerrar_ventanas_datospersonales("2");
					id_clave_permiso="";
				}else
				if (control_cerrar_datospersonales == "7") {
				   
                ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE"); 
					buscar_datos_idClientes_clientes();
					document.getElementById('inp_cedula_sc').value=cedula;
					document.getElementById('inp_nombres_sc').value=primernombre+" "+segundonombre+" "+primerapellido+" "+segundoapellido+" "+apellidocasada;
					limpiar_campos_datospersonales(); 
					abrir_cerrar_ventanas_datospersonales("2");
					id_clave_permiso="";
				}
				} 
				if (accion == 'editar') {
				if (control_cerrar_datospersonales == "1") {
				
                ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE"); 
					limpiar_campos_datospersonales();
					buscar_datos_datospersonales("ACTIVO");
id_clave_permiso="";
				}
                if (control_cerrar_datospersonales == "2") {
				
                ver_cerrar_ventana_cargando("2","DATOS CONFIRMADOS CORRECTAMENTE"); 
					
					document.getElementById('inp_idpersonas_df').value=cod;
					document.getElementById('inp_nombres_df').value=primernombre+" "+segundonombre+" "+primerapellido+" "+segundoapellido+" "+apellidocasada;
					limpiar_campos_datospersonales();
					abrir_cerrar_ventanas_datospersonales("2");
id_clave_permiso="";
				}
                if (control_cerrar_datospersonales == "4") {
					
                ver_cerrar_ventana_cargando("2","DATOS CONFIRMADOS CORRECTAMENTE"); 
					document.getElementById('inp_idpersonas_dc').value=cod;
					document.getElementById('inp_nombres_dc').value=primernombre+" "+segundonombre+" "+primerapellido+" "+segundoapellido+" "+apellidocasada;
					limpiar_campos_datospersonales();
					abrir_cerrar_ventanas_datospersonales("2");
id_clave_permiso="";
				}
				
				 if (control_cerrar_datospersonales == "6") {
                ver_cerrar_ventana_cargando("2","DATOS CONFIRMADOS CORRECTAMENTE"); 
					var opcion=document.getElementById('inp_viviendapropia_dp').value;
					cerrar_abrir_opciones_detalles_vivienda(opcion);
					document.getElementById('inp_nombres_sc').value=primernombre+" "+segundonombre+" "+primerapellido+" "+segundoapellido+" "+apellidocasada;
					limpiar_campos_datospersonales();
					abrir_cerrar_ventanas_datospersonales("2");
id_clave_permiso="";
				}
				} 
				if (accion == 'eliminar') {
                ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE"); 
					limpiar_campos_datospersonales();
					buscar_datos_datospersonales("ACTIVO");
				}
			} else {

			
                ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!"); 
				//limpiar_campos_datospersonales();
			}
		}
	});
}

function calcularEdad(fecha_nacimiento) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha_nacimiento);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();
    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }
    return edad;
}

function limpiar_campos_datospersonales() {

	document.getElementById('inp_iddatospersonales').value="";
	document.getElementById('inp_primernombre_dp').value="";
	document.getElementById('inp_segundonombre_dp').value="";
	document.getElementById('inp_primerapellido_dp').value="";
	document.getElementById('inp_segundoapellido_dp').value="";
	document.getElementById('inp_apellidocasada_dp').value="";
	document.getElementById('inp_cedula_dp').value="";
	document.getElementById('inp_ruc_dp').value="";
	document.getElementById('inp_fechanac_dp').value="";
	document.getElementById('inp_conyugue_dp').value="";
	document.getElementById('inp_direccion_dp').value="";
	document.getElementById('inp_referencia_dp').value="";
	document.getElementById('inp_telefono_dp').value="";
	document.getElementById('inp_correo_dp').value="";
	document.getElementById('inp_observacion_dp').value="";
	document.getElementById('inp_lnglat_dp').value="";
	document.getElementById('inp_idbarrios_dp').value="";
	document.getElementById('inp_barrios_dp').value="";
	document.getElementById('inp_idprofesiones_dp').value="";
	document.getElementById('inp_profesion_dp').value="";

	document.getElementById('btn_guardar_datospersonales').innerHTML = "<p style='display:none;' id='accion_guardar_datospersonales'>guardar</p>GUARDAR";
}

var estado_datospersonales = 'ACTIVO';
function buscar_por_opciones_datospersonales(d) {
	if (d == "1") {
		estado_datospersonales = 'ACTIVO';
		buscar_datos_datospersonales(estado_datospersonales);
		abrir_cerrar_ventanas_datospersonales("6");
	}
	if (d == "2") {
		estado_datospersonales = 'ELIMINADO';
		buscar_datos_datospersonales(estado_datospersonales);
		abrir_cerrar_ventanas_datospersonales("6");
	}

}

//busccar datos datospersonales
function buscar_datos_datospersonales(buscar2) {
	var buscador = document.getElementById('inpt_buscador_datospersonales').value
	document.getElementById("cnt_listado_datospersonales").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmDatosPersonas.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_datospersonales").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_datospersonales").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_datospersonales").innerHTML = datos_buscados
					document.getElementById("lbltotaldatospersonales").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function obtener_datos_datospersonales(datospr) {
	document.getElementById('inp_iddatospersonales').value= $(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_primernombre_dp').value= $(datospr).children('td[id="td_primernombre"]').html();
	document.getElementById('inp_segundonombre_dp').value= $(datospr).children('td[id="td_segundonombre"]').html();
	document.getElementById('inp_primerapellido_dp').value= $(datospr).children('td[id="td_primerapellido"]').html();
	document.getElementById('inp_segundoapellido_dp').value= $(datospr).children('td[id="td_segundoapellido"]').html();
	document.getElementById('inp_apellidocasada_dp').value= $(datospr).children('td[id="td_apellidocasada"]').html();
	document.getElementById('inp_cedula_dp').value= $(datospr).children('td[id="td_cedula"]').html();
	document.getElementById('inp_ruc_dp').value= $(datospr).children('td[id="td_ruc"]').html();
	document.getElementById('inp_fechanac_dp').value= $(datospr).children('td[id="td_fechanac"]').html();
	document.getElementById('inp_conyugue_dp').value= $(datospr).children('td[id="td_conyuge"]').html();
	document.getElementById('inp_direccion_dp').value= $(datospr).children('td[id="td_direccion"]').html();
	document.getElementById('inp_referencia_dp').value= $(datospr).children('td[id="td_referenciadireccio"]').html();
	document.getElementById('inp_telefono_dp').value= $(datospr).children('td[id="td_telefono"]').html();
	document.getElementById('inp_correo_dp').value= $(datospr).children('td[id="td_correo"]').html();
	document.getElementById('inp_sexo_dp').value= $(datospr).children('td[id="td_sexo"]').html();
	document.getElementById('inp_viviendapropia_dp').value= $(datospr).children('td[id="td_viviendapropia"]').html();
	document.getElementById('inp_observacion_dp').value= $(datospr).children('td[id="td_observacion"]').html();
	document.getElementById('inp_lnglat_dp').value= $(datospr).children('td[id="td_lnglat"]').html();
	document.getElementById('inp_idbarrios_dp').value= $(datospr).children('td[id="td_barrios_cod"]').html();
	document.getElementById('inp_barrios_dp').value= $(datospr).children('td[id="td_barrios"]').html();
	document.getElementById('combo_idnacionalidad_dp').value= $(datospr).children('td[id="td_nacionalidad_cod"]').html();
	document.getElementById('combo_idestadocivil_dp').value= $(datospr).children('td[id="td_estadosciviles_cod"]').html();
	document.getElementById('combo_idtipospersonas_dp').value= $(datospr).children('td[id="td_tipospersonas_cod"]').html();
	document.getElementById('inp_idprofesiones_dp').value= $(datospr).children('td[id="td_profesiones_cod"]').html();
	document.getElementById('inp_profesion_dp').value= $(datospr).children('td[id="td_Profesion"]').html();
	document.getElementById('btn_guardar_datospersonales').innerHTML = "<p style='display:none;' id='accion_guardar_datospersonales'>editar</p>EDITAR";
	abrir_cerrar_ventanas_datospersonales("4");
}

/*AÑADIR O MODIFICAR NUEVO TIPOS PERSONAS*/
function add_datos_tipospersonas(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idtipospersonas').value
	var tipo = document.getElementById('inp_tipospersonas').value
	

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_tipospersonas"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_tipospersonas"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
    ver_cerrar_ventana_cargando("1","Cargando"); 

	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("tipo", tipo)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmTiposPersonas.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
	
    ver_cerrar_ventana_cargando("2","ERROR DE CONEXION...!"); 

			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
    ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO"); 
				
				return false;
			}
			if (Respuesta == "duplicado") {
			
    ver_cerrar_ventana_cargando("2","DATO DUPLICADO"); 
				return false;
			}
			if (Respuesta == "in") {
			
    ver_cerrar_ventana_cargando("2","DATO INCORRECTO"); 
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					
    ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE"); 
					limpiar_campos_tipospersonas();
					buscar_datos_tipospersonas("ACTIVO");
				} 
				if (accion == 'editar') {
				
    ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE"); 
					limpiar_campos_tipospersonas();
					buscar_datos_tipospersonas("ACTIVO");
				} 
				if (accion == 'eliminar') {
					
    ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE"); 
					limpiar_campos_tipospersonas();
					buscar_datos_tipospersonas("ACTIVO");
				}

			} else {

			
    ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!"); 
				//limpiar_campos_tipospersonas();
			}
		}
	});


}

function limpiar_campos_tipospersonas() {
	
    document.getElementById('inp_idtipospersonas').value= ''
	document.getElementById('inp_tipospersonas').value= ''
	document.getElementById('btn_guardar_tipospersonas').innerHTML = "<p style='display:none;' id='accion_guardar_tipospersonas'>guardar</p>GUARDAR";
}

var estado_tipospersonas = 'ACTIVO';
function buscar_por_opciones_tipospersonas(d) {
	if (d == "1") {
		estado_tipospersonas = 'ACTIVO';
		buscar_datos_tipospersonas(estado_tipospersonas);
		abrir_cerrar_ventanas_tipospersonas("6");
	}
	if (d == "2") {
		estado_tipospersonas = 'ELIMINADO';
		buscar_datos_tipospersonas(estado_tipospersonas);
		abrir_cerrar_ventanas_tipospersonas("6");
	}

}

//busccar datos tipospersonas
function buscar_datos_tipospersonas(buscar2) {
	var buscador = document.getElementById('inpt_buscador_tipospersonas').value
	document.getElementById("cnt_listado_tipospersonas").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmTiposPersonas.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_tipospersonas").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_tipospersonas").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_tipospersonas").innerHTML = datos_buscados
					document.getElementById("lbltotaltipospersonas").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function buscartipospersonas_combo() {
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmTiposPersonas.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {

					document.getElementById('combo_idtipospersonas_dp').innerHTML = datos[2]

				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function obtener_datos_tipospersonas(datospr) {
	document.getElementById('inp_idtipospersonas').value = $(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_tipospersonas').value = $(datospr).children('td[id="td_tipo"]').html();

	document.getElementById('btn_guardar_tipospersonas').innerHTML = "<p style='display:none;' id='accion_guardar_tipospersonas'>editar</p>EDITAR";
	abrir_cerrar_ventanas_tipospersonas("4");
}

/*AÑADIR O MODIFICAR NUEVO ESTADOS CIVILES*/
function add_datos_estadosciviles(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idestadosciviles').value
	var estadoscivil = document.getElementById('inp_estadocivil').value
	

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_estadosciviles"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_estadosciviles"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
     ver_cerrar_ventana_cargando("1","CARGANDO.. "); 

	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("estadoscivil", estadoscivil)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmEstadosCiviles.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			
            ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
			
            ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
			
            ver_cerrar_ventana_cargando("2","DATO DUPLICADO ");
				return false;
			}
			if (Respuesta == "in") {
			
            ver_cerrar_ventana_cargando("2","DATO INCORRECTO ");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
			
                   ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE ");
					limpiar_campos_estadosciviles();
					buscar_datos_estadosciviles("ACTIVO");
				} 
				if (accion == 'editar') {
			 	
                    ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE ");
					limpiar_campos_estadosciviles();
					buscar_datos_estadosciviles("ACTIVO");
				} 
				if (accion == 'eliminar') {
			
                    ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE ");
					limpiar_campos_estadosciviles();
					buscar_datos_estadosciviles("ACTIVO");
				}

			} else {

			
            ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO! ");
				//limpiar_campos_estadosciviles();
			}
		}
	});


}

function limpiar_campos_estadosciviles() {
	
    document.getElementById('inp_idestadosciviles').value= ''
	document.getElementById('inp_estadocivil').value= ''
	document.getElementById('btn_guardar_estadosciviles').innerHTML = "<p style='display:none;' id='accion_guardar_estadosciviles'>guardar</p>GUARDAR";
}

var estado_estadosciviles = 'ACTIVO';
function buscar_por_opciones_estadosciviles(d) {
	if (d == "1") {
		estado_estadosciviles = 'ACTIVO';
		buscar_datos_estadosciviles(estado_estadosciviles);
		abrir_cerrar_ventanas_estadosciviles("6");
	}
	if (d == "2") {
		estado_estadosciviles = 'ELIMINADO';
		buscar_datos_estadosciviles(estado_estadosciviles);
		abrir_cerrar_ventanas_estadosciviles("6");
	}

}

//busccar datos estadosciviles
function buscar_datos_estadosciviles(buscar2) {
	var buscador = document.getElementById('inpt_buscador_estadosciviles').value
	document.getElementById("cnt_listado_estadosciviles").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmEstadosCiviles.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_estadosciviles").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_estadosciviles").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_estadosciviles").innerHTML = datos_buscados
					document.getElementById("lbltotalestadosciviles").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function buscarestadosciviles_combo() {
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmEstadosCiviles.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {

					document.getElementById('combo_idestadocivil_dp').innerHTML = datos[2]
cerrar_abrir_opciones_conyuge();
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function obtener_datos_estadosciviles(datospr) {
	document.getElementById('inp_idestadosciviles').value = $(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_estadocivil').value = $(datospr).children('td[id="td_estadoscivil"]').html();

	document.getElementById('btn_guardar_estadosciviles').innerHTML = "<p style='display:none;' id='accion_guardar_estadosciviles'>editar</p>EDITAR";
	abrir_cerrar_ventanas_estadosciviles("4");
}

/*AÑADIR O MODIFICAR NUEVO NACIONALIDADES*/
function add_datos_nacionalidades(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idnacionalidades').value
	var nacionalidad = document.getElementById('inp_nacionalidad').value
	

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_nacionalidades"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_nacionalidades"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
    ver_cerrar_ventana_cargando("1","CARGANDO...");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("nacionalidad", nacionalidad)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmNacionalidades.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			
             ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!");

			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				
             ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
             ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				
             ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
				
             ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_nacionalidades();
					buscar_datos_nacionalidades("ACTIVO");
				} 
				if (accion == 'editar') {
			
             ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
					limpiar_campos_nacionalidades();
					buscar_datos_nacionalidades("ACTIVO");
				} 
				if (accion == 'eliminar') {
					
             ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
					limpiar_campos_nacionalidades();
					buscar_datos_nacionalidades("ACTIVO");
				}

			} else {

			
             ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				//limpiar_campos_nacionalidades();
			}
		}
	});


}

function limpiar_campos_nacionalidades() {
	
    document.getElementById('inp_idnacionalidades').value= ''
	document.getElementById('inp_nacionalidad').value= ''
	document.getElementById('btn_guardar_nacionalidades').innerHTML = "<p style='display:none;' id='accion_guardar_nacionalidades'>guardar</p>GUARDAR";
}

var estado_nacionalidades = 'ACTIVO';
function buscar_por_opciones_nacionalidades(d) {
	if (d == "1") {
		estado_nacionalidades = 'ACTIVO';
		buscar_datos_nacionalidades(estado_nacionalidades);
		abrir_cerrar_ventanas_nacionalidades("6");
	}
	if (d == "2") {
		estado_nacionalidades = 'ELIMINADO';
		buscar_datos_nacionalidades(estado_nacionalidades);
		abrir_cerrar_ventanas_nacionalidades("6");
	}

}

//busccar datos nacionalidades
function buscar_datos_nacionalidades(buscar2) {
	var buscador = document.getElementById('inpt_buscador_nacionalidades').value
	document.getElementById("cnt_listado_nacionalidades").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmNacionalidades.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_nacionalidades").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_nacionalidades").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_nacionalidades").innerHTML = datos_buscados
					document.getElementById("lbltotalnacionalidades").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function buscarnacionalidades_combo() {
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmNacionalidades.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {

					document.getElementById('combo_idnacionalidad_dp').innerHTML = datos[2]

				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function obtener_datos_nacionalidades(datospr) {
	document.getElementById('inp_idnacionalidades').value = $(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_nacionalidad').value = $(datospr).children('td[id="td_nacionalidad"]').html();

	document.getElementById('btn_guardar_nacionalidades').innerHTML = "<p style='display:none;' id='accion_guardar_nacionalidades'>editar</p>EDITAR";
	abrir_cerrar_ventanas_nacionalidades("4");
}


/*AÑADIR O MODIFICAR NUEVO PROFESIONES*/
var controlseleccion_profesiones="";
function add_datos_profesiones(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idprofesiones').value
	var Profesion = document.getElementById('inp_profesion').value
	var SectorEconomico = document.getElementById('inp_sectoreconomico').value


	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_profesiones"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_profesiones"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
 ver_cerrar_ventana_cargando("1","CARGANDO...");
	
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("Profesion", Profesion)
	datos.append("SectorEconomico", SectorEconomico)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmProfesiones.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
             ver_cerrar_ventana_cargando("2","");

			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				
             ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
			
             ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				
             ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					
             ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_profesiones();
					buscar_datos_profesiones("ACTIVO");
				} 
				if (accion == 'editar') {
				
             ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
					limpiar_campos_profesiones();
					buscar_datos_profesiones("ACTIVO");
				} 
				if (accion == 'eliminar') {
					
             ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
					limpiar_campos_profesiones();
					buscar_datos_profesiones("ACTIVO");
				}

			} else {

			
             ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
				//limpiar_campos_profesiones();
			}
		}
	});


}

function limpiar_campos_profesiones() {
	
    document.getElementById('inp_idprofesiones').value= ''
	document.getElementById('inp_profesion').value= ''
	document.getElementById('inp_sectoreconomico').value= ''
	
	document.getElementById('btn_guardar_profesiones').innerHTML = "<p style='display:none;' id='accion_guardar_profesiones'>guardar</p>GUARDAR";
	
}

var estado_profesiones = 'ACTIVO';
function buscar_por_opciones_profesiones(d) {
	if (d == "1") {
		estado_profesiones = 'ACTIVO';
		buscar_datos_profesiones(estado_profesiones);
		abrir_cerrar_ventanas_profesiones("6");
	}
	if (d == "2") {
		estado_profesiones = 'ELIMINADO';
		buscar_datos_profesiones(estado_profesiones);
		abrir_cerrar_ventanas_profesiones("6");
	}

}

//busccar datos profesiones
function buscar_datos_profesiones(buscar2) {
	var buscador="";
	if(controlseleccion_profesiones=="abm"){
		buscador = document.getElementById('inpt_buscador_profesiones').value
	}
	if(controlseleccion_profesiones=="vista"){
		buscador = document.getElementById('inpt_buscador_profesiones_vista').value
	}
	document.getElementById("cnt_listado_profesiones").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmProfesiones.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_profesiones").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_profesiones").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
    if(controlseleccion_profesiones=="abm"){
		document.getElementById("cnt_listado_profesiones").innerHTML = datos_buscados
		document.getElementById("lbltotalprofesiones").innerHTML="CANTIDAD: "+datos["2"];
	}
	if(controlseleccion_profesiones=="vista"){
		document.getElementById("cnt_listado_profesiones_vista").innerHTML = datos_buscados
		document.getElementById("lbltotalprofesiones_vista").innerHTML="CANTIDAD: "+datos["2"];
	}
					
					
				} catch (error) {

				}

			}
		}
	});
}

function buscarprofesiones_combo() {
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmProfesiones.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {

					document.getElementById('combo_iddepartamentos_profesiones').innerHTML = datos[2]

				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function obtener_datos_profesiones(datospr) {
	if(controlseleccion_profesiones=="abm"){
		document.getElementById('inp_idprofesiones').value = $(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_profesion').value = $(datospr).children('td[id="td_Profesion"]').html();
	document.getElementById('inp_sectoreconomico').value = $(datospr).children('td[id="td_SectorEconomico"]').html();
	document.getElementById('btn_guardar_profesiones').innerHTML = "<p style='display:none;' id='accion_guardar_profesiones'>editar</p>EDITAR";
	abrir_cerrar_ventanas_profesiones("4");
	}
	if(controlseleccion_profesiones=="vista"){
    document.getElementById('inp_idprofesiones_dp').value = $(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_profesion_dp').value = $(datospr).children('td[id="td_Profesion"]').html();
	abrir_cerrar_ventanas_vistaprofesiones("2");
	}
	
	
}

/*AÑADIR O MODIFICAR NUEVO ACCESO*/
function add_datos_accesos(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idaccesos').value
	var accesos = document.getElementById('inp_accesos').value
	var funciones = document.getElementsByName('array_accesos[]')

	var funFinal = '';
	$.each(funciones, function(j, fun){
		funFinal += fun.value+':'+fun.checked + ',';
	});
	funFinal = funFinal.substring(0, funFinal.length - 1);

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_accesos"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_accesos"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("accesos", accesos)
	datos.append("hora", hora)
	datos.append("funciones", funFinal)

	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmAccesos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
		
			ver_cerrar_ventana_cargando("ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE");
					limpiar_campos_accesos1();
					buscar_datos_accesos("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE");
					limpiar_campos_accesos1();
					buscar_datos_accesos("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE");
					limpiar_campos_accesos1();
					buscar_datos_accesos("ACTIVO");
				}

			} else {
				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!");
			}
		}
	});


}

function limpiar_campos_accesos1() {
	
    document.getElementById('inp_idaccesos').value= ''
	document.getElementById('inp_accesos').value= ''
	document.getElementById('tabla_funciones_accesos').innerHTML = ''
	
	document.getElementById('btn_guardar_accesos').innerHTML = "<p style='display:none;' id='accion_guardar_accesos'>guardar</p>GUARDAR";
	
}

var estado_accesos = 'ACTIVO';
function buscar_por_opciones_accesos(d) {
	if (d == "1") {
		estado_accesos = 'ACTIVO';
		buscar_datos_accesos(estado_accesos);
		abrir_cerrar_ventanas_accesos("6");
	}
	if (d == "2") {
		estado_accesos = 'ELIMINADO';
		buscar_datos_accesos(estado_accesos);
		abrir_cerrar_ventanas_accesos("6");
	}

}

//busccar datos accesos
function buscar_datos_accesos(buscar2) {
	var buscador = document.getElementById('inpt_buscador_accesos').value
	document.getElementById("cnt_listado_accesos").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmAccesos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_accesos").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			document.getElementById("cnt_listado_accesos").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_accesos").innerHTML = datos_buscados
					document.getElementById("lbltotalaccesos").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}

function buscaraccesos_combo() {
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmAccesos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {

					document.getElementById('combo_idrol_df').innerHTML = datos[2]

				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function obtener_datos_accesos(datospr) {
	var cod = $(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_idaccesos').value = cod;
	document.getElementById('inp_accesos').value = $(datospr).children('td[id="td_accesos"]').html();
	document.getElementById('btn_guardar_accesos').innerHTML = "<p style='display:none;' id='accion_guardar_accesos'>editar</p>EDITAR";

	var datos = new FormData();
	datos.append("func" , "obtenerFunciones");
	datos.append("buscar" , cod);
	datos.append("html" , 1);

	$.ajax({
		data: datos, 
		url: "./php/abmAccesos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {

			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {
			Respuesta = responseText;
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {

					document.getElementById('tabla_funciones_accesos').innerHTML = datos[2]

				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});

	abrir_cerrar_ventanas_accesos("4");
}


/*AÑADIR O MODIFICAR NUEVO SUCURSALES*/

function add_datos_sucursales(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idsucursales').value
	var nombres = document.getElementById('inp_sucursales').value
	var numero = document.getElementById('inp_nrosucursales').value
	var direccion = document.getElementById('inp_direccion_sucursal').value
	var ruc = document.getElementById('inp_ruc_sucursal').value
	var telefono = document.getElementById('inp_telefono_sucursal').value
	var barrios_cod = document.getElementById('combo_idbarrios_sucursales').value
	var lnglat = document.getElementById('inp_lnglat_sucursales').value

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_sucursales"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_sucursales"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("nombres", nombres)
	datos.append("numero", numero)
	datos.append("direccion", direccion)
	datos.append("ruc", ruc)
	datos.append("telefono", telefono)
	datos.append("barrios_cod", barrios_cod)
	datos.append("lnglat", lnglat)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmSucursales.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE")
					limpiar_campos_sucursales();
					buscar_datos_sucursales("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE")
					limpiar_campos_sucursales();
					buscar_datos_sucursales("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE")
					limpiar_campos_sucursales();
					buscar_datos_sucursales("ACTIVO");
				}

			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
				//limpiar_campos_sucursales();
			}
		}
	});


}

function limpiar_campos_sucursales() {
	
    document.getElementById('inp_idsucursales').value= ''
	document.getElementById('inp_sucursales').value= ''
	document.getElementById('inp_nrosucursales').value= ''
	document.getElementById('inp_direccion_sucursal').value= ''
	document.getElementById('inp_ruc_sucursal').value= ''
	document.getElementById('inp_telefono_sucursal').value= ''
    document.getElementById('inp_lnglat_sucursales').value= ''
	
	document.getElementById('btn_guardar_sucursales').innerHTML = "<p style='display:none;' id='accion_guardar_sucursales'>guardar</p>GUARDAR";
	
}

var estado_sucursales = 'ACTIVO';
function buscar_por_opciones_sucursales(d) {
	if (d == "1") {
		estado_sucursales = 'ACTIVO';
		buscar_datos_sucursales(estado_sucursales);
		abrir_cerrar_ventanas_sucursales("6");
	}
	if (d == "2") {
		estado_sucursales = 'ELIMINADO';
		buscar_datos_sucursales(estado_sucursales);
		abrir_cerrar_ventanas_sucursales("6");
	}

}

//busccar datos sucursales
function buscar_datos_sucursales(buscar2) {
	var buscador = document.getElementById('inpt_buscador_sucursales').value
	document.getElementById("cnt_listado_sucursales").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmSucursales.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_sucursales").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_sucursales").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
                   
					document.getElementById("cnt_listado_sucursales").innerHTML = datos_buscados
					document.getElementById("lbltotalsucursales").innerHTML="CANTIDAD: "+datos["2"];
					
				} catch (error) {

				}

			}
		}
	});
}
/*buscar Ciudad*/
function buscarBarrios_combo() {
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmBarrios.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('combo_idbarrios_sucursales').innerHTML = datos[2]

				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}



/*buscar Ciudad*/
function buscarsucursales_combo() {
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmSucursales.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {

					document.getElementById('inp_sucursal_solicitud').innerHTML = datos[2]
					document.getElementById('combo_sucursal_datoscaja').innerHTML = datos[2]

				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function obtener_datos_sucursales(datospr) {
	document.getElementById('inp_idsucursales').value = $(datospr).children('td[id="td_cod"]').html();
	document.getElementById('inp_sucursales').value = $(datospr).children('td[id="td_nombres"]').html();
	document.getElementById('inp_nrosucursales').value = $(datospr).children('td[id="td_numero"]').html();
	document.getElementById('inp_direccion_sucursal').value = $(datospr).children('td[id="td_direccion"]').html();
	document.getElementById('inp_ruc_sucursal').value = $(datospr).children('td[id="td_ruc"]').html();
	document.getElementById('inp_telefono_sucursal').value = $(datospr).children('td[id="td_telefono"]').html();
	document.getElementById('combo_idbarrios_sucursales').value = $(datospr).children('td[id="td_barrios_cod"]').html();	
	document.getElementById('inp_lnglat_sucursales').value = $(datospr).children('td[id="td_lnglat"]').html();	
	document.getElementById('btn_guardar_sucursales').innerHTML = "<p style='display:none;' id='accion_guardar_sucursales'>editar</p>EDITAR";
	abrir_cerrar_ventanas_sucursales("4");
}

/*AÑADIR O MODIFICAR NUEVO BARRIOS*/
function add_datos_Barrios(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idBarrios').value
	var barrios = document.getElementById('inp_Barrios').value
	var ciudades_idciudades = document.getElementById('combo_iddepartamentos_Barrios').value

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_Barrios"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_Barrios"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_vetana_informativa("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("barrios", barrios)
	datos.append("ciudades_idciudades", ciudades_idciudades)
	datos.append("hora", hora)


	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmBarrios.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}

			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					
	                ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE")
					limpiar_campos_Barrios();
					buscar_datos_Barrios("ACTIVO");
	                
					
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE")
					limpiar_campos_Barrios();
					buscar_datos_Barrios("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE")
					limpiar_campos_Barrios();
					buscar_datos_Barrios("ACTIVO");
				}

			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
				limpiar_campos_Barrios();
			}
		}
	});


}

function limpiar_campos_Barrios() {
	document.getElementById('inp_idBarrios').value = ''
	document.getElementById('inp_Barrios').value = ''
	document.getElementById('combo_iddepartamentos_Barrios').value = ''
	document.getElementById('btn_guardar_Barrios').innerHTML = "<p style='display:none;' id='accion_guardar_Barrios'>guardar</p>GUARDAR";
	
}

var estado_Barrios = 'ACTIVO';
function buscar_por_opciones_Barrios(d) {
	if (d == "1") {
		estado_Barrios = 'ACTIVO';
		buscar_datos_Barrios(estado_Barrios);
		abrir_cerrar_ventanas_Barrios("6");
	}
	if (d == "2") {
		estado_Barrios = 'ELIMINADO';
		buscar_datos_Barrios(estado_Barrios);
		abrir_cerrar_ventanas_Barrios("6");
	}

}

//busccar datos Barrios
function buscar_datos_Barrios(buscar2) {
	var buscador="";
	if(controlseleccion_barrios=="abm"){
		buscador = document.getElementById('inpt_buscador_Barrios').value
	}
	if(controlseleccion_barrios=="vista"){
		buscador = document.getElementById('inpt_buscador_Barrios_vista').value
	}
	
	document.getElementById("cnt_listado_Barrios").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmBarrios.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_Barrios").innerHTML = ''
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_Barrios").innerHTML = ''
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;

					document.getElementById("cnt_listado_Barrios").innerHTML = datos_buscados
					document.getElementById("lbltotalBarrios").innerHTML="CANTIDAD: "+datos["2"];
					
					
					document.getElementById("cnt_listado_Barrios_vista").innerHTML = datos_buscados
					document.getElementById("lbltotalBarrios_vista").innerHTML="CANTIDAD: "+datos["2"];
				} catch (error) {

				}

			}
		}
	});
}

function buscarCiudades_combo_combo() {
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmCiudades.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
					document.getElementById('combo_iddepartamentos_Barrios').innerHTML = datos[2]
					document.getElementById('combo_iddepartamentos_Barrios_n').innerHTML = datos[2]
				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

var controlseleccion_barrios="";
function obtener_datos_Barrios(datospr) {
	if(controlseleccion_barrios=="abm"){
	 document.getElementById('inp_idBarrios').value = $(datospr).children('td[id="td_cod"]').html();
	 document.getElementById('inp_Barrios').value = $(datospr).children('td[id="td_barrios"]').html();
	 document.getElementById('combo_iddepartamentos_Barrios').value = $(datospr).children('td[id="td_ciudades_idciudades"]').html();	
	 document.getElementById('btn_guardar_Barrios').innerHTML = "<p style='display:none;' id='accion_guardar_Barrios'>editar</p>EDITAR";
	 abrir_cerrar_ventanas_Barrios("4");
	}
	if(controlseleccion_barrios=="vista"){
	 document.getElementById('inp_idbarrios_dp').value = $(datospr).children('td[id="td_cod"]').html();
	 document.getElementById('inp_barrios_dp').value = $(datospr).children('td[id="td_barrios"]').html();
	 abrir_cerrar_ventanas_vistabarrios("2");
	}
	if(controlseleccion_barrios=="vista_proveedores"){
	 document.getElementById('inp_idbarrios_proveedores').value = $(datospr).children('td[id="td_cod"]').html();
	 document.getElementById('inp_barrios_proveedores').value = $(datospr).children('td[id="td_barrios"]').html();
	 abrir_cerrar_ventanas_vistabarrios("2");
	}
	if(controlseleccion_barrios=="vista_proveedores_nuevo"){
	 document.getElementById('inp_idbarrios_proveedores_nuevo').value = $(datospr).children('td[id="td_cod"]').html();
	 document.getElementById('inp_barrios_proveedores_nuevo').value = $(datospr).children('td[id="td_barrios"]').html();
	 abrir_cerrar_ventanas_vistabarrios("2");
	}
	
}


/*AÑADIR O MODIFICAR NUEVO REGION*/
function add_datos_regiones(datos){
	var f= new Date
	var id_progreso=f.getMinutes()+"_"+f.getMilliseconds()+"_mensaje";
	var idregiones=document.getElementById('inp_idregiones_r').value;
	var regiones=document.getElementById('inp_regiones_r').value;
    var accion='guardar';
	
	if($(datos).children('p[id="accion_guardar_regiones"]').html()=='guardar'){
		accion='guardar';
	}
	if($(datos).children('p[id="accion_guardar_regiones"]').html()=='editar'){
		accion='editar';
	}
	if(datos=='eliminar'){
		accion='eliminar';
	}

	 
			ver_cerrar_ventana_cargando("1","Cargando....");
		
		
			  var datos = new FormData();
			 datos.append("func", accion)
			 datos.append("idregiones" , idregiones)
			 datos.append("regiones" , regiones)
			
		
			
			var OpAjax= $.ajax({
			
			data: datos,
			url: "./php/abmRegiones.php",
			type:"post",
	        cache:false,
			contentType: false,
			processData: false,
				error: function(jqXHR, textstatus, errorThrowm){
			
					ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!") 
					

					 return false;
			},
			success: function(responseText)
			{ 	 

			Respuesta=responseText;			
			////console.log(Respuesta);
			
	  if (Respuesta=="camposvacio"){
		ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");	
						return false;
		}
		if (Respuesta=="duplicado"){
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
						return false;
		}
	if(Respuesta=="in"){
		ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
		return false();
	} 
	  
			if (Respuesta=="exito") {	
			
			if(accion=='guardar'){
				ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE")
				 limpiar_campos_regiones();
				 buscar_datos_regiones("ACTIVO");
			}
			if(accion=='editar'){
				ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE")
				 limpiar_campos_regiones();
				 buscar_datos_regiones("ACTIVO");
			}
			if(accion=='eliminar'){
				ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE")
				 limpiar_campos_regiones();
				 buscar_datos_regiones("ACTIVO");
			}
			
			} else {
		
				 ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
				 limpiar_campos_regiones();
			}		
			}
			});		
}

function limpiar_campos_regiones(){
	 
	document.getElementById('inp_idregiones_r').value=''
	document.getElementById('inp_regiones_r').value=''
   document.getElementById('btn_guardar_regiones').innerHTML = "<p style='display:none;' id='accion_guardar_regiones'>guardar</p>GUARDAR";
}

var tipoestado='ACTIVO';
function buscar_por_opciones_regiones(d){
	if(d=="1"){
	tipoestado='ACTIVO';
    buscar_datos_regiones(tipoestado);
	abrir_cerrar_ventanas_regiones("6");
	}
	if(d=="2"){
	tipoestado='ELIMINADO';
	 buscar_datos_regiones(tipoestado);
    abrir_cerrar_ventanas_regiones("6");	
	}
	
}
//busccar datos regiones
function buscar_datos_regiones(buscar2){
 	
var buscador=document.getElementById('inpt_buscador_regiones').value
		 document.getElementById("cnt_listado_regiones1").innerHTML=""
			var datos = {
			"buscar": buscador,
			"buscar2": buscar2,
			"func": "buscar"
			};
	 $.ajax({
			data: datos,url: "./php/abmRegiones.php",type:"post",beforeSend: function(){
				
			},error: function(jqXHR, textstatus, errorThrowm){
	
			document.getElementById("cnt_listado_regiones1").innerHTML=''
			},
			success: function(responseText)
			{
	
			var Respuesta=responseText;
     ////console.log(Respuesta)
			  document.getElementById("cnt_listado_regiones1").innerHTML=''
			
			
			if (Respuesta != "error")
			{		
				try{
				var datos = $.parseJSON(Respuesta); 
          Respuesta=datos["1"];  
		  var datos_buscados=Respuesta;
		 
			document.getElementById("cnt_listado_regiones1").innerHTML=datos_buscados
			document.getElementById("lbltotalregiones").innerHTML="CANTIDAD REGION: "+datos["2"];
} catch(error)
				{
					
				}
	  
			}
			}
			});
	
	
}

function obtener_datos_regiones_r(datospr){
  document.getElementById('inp_idregiones_r').value=$(datospr).children('td[id="td_idregiones_r"]').html(); 
  document.getElementById('inp_regiones_r').value=$(datospr).children('td[id="td_regiones_r"]').html();
  document.getElementById('btn_guardar_regiones').innerHTML = "<p style='display:none;' id='accion_guardar_regiones'>editar</p>EDITAR";
  abrir_cerrar_ventanas_regiones("4");
}

/*AÑADIR O MODIFICAR NUEVO DEPARTAMENTOS*/
function add_datos_departamentos(datos) {
	var f = new Date
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var iddepartamentos = document.getElementById('inp_iddepartamentos').value
	var departamentos = document.getElementById('inp_departamentos').value
	var regiones_idregiones = document.getElementById('combo_idregiones_departamentos').value
	
	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_departamentos"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_departamentos"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("iddepartamentos", iddepartamentos)
	datos.append("departamentos", departamentos)
	datos.append("regiones_idregiones", regiones_idregiones)


	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmDepartamentos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			cerrar_esta_ventanas(id_progreso);
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}

			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE")
					limpiar_campos_departamentos();
					buscar_datos_departamentos("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE")
					limpiar_campos_departamentos();
					buscar_datos_departamentos("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE")
					limpiar_campos_departamentos();
					buscar_datos_departamentos("ACTIVO");
				}

			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
				limpiar_campos_departamentos();
			}
		}
	});


}

function limpiar_campos_departamentos() {

	document.getElementById('inp_iddepartamentos').value = ''
	document.getElementById('inp_departamentos').value = ''
	document.getElementById('combo_idregiones_departamentos').value = ''
	document.getElementById('btn_guardar_departamentos').innerHTML = "<p style='display:none;' id='accion_guardar_departamentos'>guardar</p>GUARDAR";
	
}

var tipoestado_departamento = 'ACTIVO';
function buscar_por_opciones_departamentos(d) {
	if (d == "1") {
		tipoestado_departamento = 'ACTIVO';
		buscar_datos_departamentos(tipoestado_departamento);
		abrir_cerrar_ventanas_departamentos("6");
	}
	if (d == "2") {
		tipoestado_departamento = 'ELIMINADO';
		buscar_datos_departamentos(tipoestado_departamento);
		abrir_cerrar_ventanas_departamentos("6");
	}

}

//busccar datos departamentos
function buscar_datos_departamentos(buscar2) {

	var buscador = document.getElementById('inpt_buscador_departamentos').value
	document.getElementById("cnt_listado_departamentos").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmDepartamentos.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_departamentos").innerHTML = ''
		},
		success: function (responseText) {

			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_departamentos").innerHTML = ''


			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;

					document.getElementById("cnt_listado_departamentos").innerHTML = datos_buscados
					document.getElementById("lbltotaldepartamentos").innerHTML="CANTIDAD DEPARTAMENTO: "+datos["2"];
				} catch (error) {

				}

			}
		}
	});


}

/*buscar Departamento*/
function buscarDepartametos_combo() {
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmRegiones.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {

					document.getElementById('combo_idregiones_departamentos').innerHTML = datos[2]

				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				
				}

			} catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			

			}


		}
	});

}

function obtener_datos_departamentos(datospr) {
	document.getElementById('inp_iddepartamentos').value = $(datospr).children('td[id="td_iddepartamentos"]').html();
	document.getElementById('inp_departamentos').value = $(datospr).children('td[id="td_departamentos"]').html();
	document.getElementById('combo_idregiones_departamentos').value = $(datospr).children('td[id="td_regiones_idregiones"]').html();	
	document.getElementById('btn_guardar_departamentos').innerHTML = "<p style='display:none;' id='accion_guardar_departamentos'>editar</p>EDITAR";
	abrir_cerrar_ventanas_departamentos("4");
}

/*AÑADIR O MODIFICAR NUEVO CIUDADES*/
function add_datos_Ciudades(datos) {
	var f = new Date
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var idciudades = document.getElementById('inp_idCiudades').value
	
	var ciudades = document.getElementById('inp_Ciudades').value
	var departamentos_iddepartamentos = document.getElementById('combo_iddepartamentos_Ciudades').value
	
	
	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_Ciudades"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_Ciudades"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("idciudades", idciudades)
	datos.append("ciudades", ciudades)
	datos.append("departamentos_iddepartamentos", departamentos_iddepartamentos)


	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmCiudades.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
	
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}

			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE")
					limpiar_campos_Ciudades();
					buscar_datos_Ciudades("ACTIVO");
				} 
				if (accion == 'editar') {
					ver_cerrar_ventana_cargando("2","DATOS ACTUALIZADO CORRECTAMENTE")
					limpiar_campos_Ciudades();
					buscar_datos_Ciudades("ACTIVO");
				} 
				if (accion == 'eliminar') {
					ver_cerrar_ventana_cargando("2","DATOS ELIMINADO CORRECTAMENTE")
					limpiar_campos_Ciudades();
					buscar_datos_Ciudades("ACTIVO");
				}

			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
				limpiar_campos_Ciudades();
			}
		}
	});


}

function limpiar_campos_Ciudades() {

	document.getElementById('inp_idCiudades').value = ''
	document.getElementById('inp_Ciudades').value = ''
	document.getElementById('combo_iddepartamentos_Ciudades').value = ''
	document.getElementById('btn_guardar_Ciudades').innerHTML = "<p style='display:none;' id='accion_guardar_Ciudades'>guardar</p>GUARDAR";
	
}

var tipoestado_ciudades = 'ACTIVO';
function buscar_por_opciones_Ciudades(d) {
	if (d == "1") {
		tipoestado_ciudades = 'ACTIVO';
		buscar_datos_Ciudades(tipoestado_ciudades);
		abrir_cerrar_ventanas_Ciudades("6");
	}
	if (d == "2") {
		tipoestado_ciudades = 'ELIMINADO';
		buscar_datos_Ciudades(tipoestado_ciudades);
		abrir_cerrar_ventanas_Ciudades("6");
	}

}

//busccar datos ciudades
function buscar_datos_Ciudades(buscar2) {

	var buscador = document.getElementById('inpt_buscador_Ciudades').value
	document.getElementById("cnt_listado_Ciudades").innerHTML = ""
	var datos = {
		"buscar": buscador,
		"buscar2": buscar2,
		"func": "buscar"
	};
	$.ajax({
		data: datos, url: "./php/abmCiudades.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			document.getElementById("cnt_listado_Ciudades").innerHTML = ''
		},
		success: function (responseText) {

			var Respuesta = responseText;
			////console.log(Respuesta)
			document.getElementById("cnt_listado_Ciudades").innerHTML = ''


			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;

					document.getElementById("cnt_listado_Ciudades").innerHTML = datos_buscados
					document.getElementById("lbltotalciudades").innerHTML="CANTIDAD CIUDAD: "+datos["2"];
				} catch (error) {

				}

			}
		}
	});


}

/*buscar Ciudad*/
function buscarCiudades_combo() {
	var datos = new FormData();
	datos.append("func" , "buscarcombo")
	var OpAjax = $.ajax({
		data: datos,
		url: "./php/abmDepartamentos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			ver_vetana_informativa("ERROR DE CONEXIÓN...!", id_progreso)
			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {

					document.getElementById('combo_iddepartamentos_Ciudades').innerHTML = datos[2]

				}
				else {
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...!", id_progreso)
				}
			   } catch (error) {
				ver_vetana_informativa("ERROR FATAL...!", id_progreso)
			}
		}
	});
}

function obtener_datos_Ciudades(datospr) {
	document.getElementById('inp_idCiudades').value = $(datospr).children('td[id="td_idCiudades"]').html();
	document.getElementById('inp_Ciudades').value = $(datospr).children('td[id="td_Ciudades"]').html();
	document.getElementById('combo_iddepartamentos_Ciudades').value = $(datospr).children('td[id="td_departamentos_iddepartamentos"]').html();	
	document.getElementById('btn_guardar_Ciudades').innerHTML = "<p style='display:none;' id='accion_guardar_Ciudades'>editar</p>EDITAR";
	abrir_cerrar_ventanas_Ciudades("4");
}

//AGREGAR NUEVOS DATOS EN VISTAS ABM

//VISTA NUEVO BARRIOS

/*AÑADIR O MODIFICAR NUEVO BARRIO*/
function add_datos_nuevoBarrios(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idBarrios_n').value
	var barrios = document.getElementById('inp_Barrios_n').value
	var ciudades_idciudades = document.getElementById('combo_iddepartamentos_Barrios_n').value

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_nuevoBarrios"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_nuevoBarrios"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("barrios", barrios)
	datos.append("ciudades_idciudades", ciudades_idciudades)
	datos.append("hora", hora)


	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmBarrios.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
	
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}

			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					
	                ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE")
					
					buscar_datos_Barrios("ACTIVO");
					limpiar_campos_nuevoBarrios();
	              
				} 
			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
				limpiar_campos_nuevoBarrios();
			}
		}
	});


}

function limpiar_campos_nuevoBarrios() {
	document.getElementById('inp_idBarrios_n').value = ''
	document.getElementById('inp_Barrios_n').value = ''	
	 abrir_cerrar_ventanas_nuevobarrios("2");
}

/*AÑADIR O MODIFICAR NUEVO PROFESION*/
function add_datos_nuevoprofesiones(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idprofesiones_n').value
	var Profesion = document.getElementById('inp_profesion_n').value
	var SectorEconomico = document.getElementById('inp_sectoreconomico_n').value


	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_nuevoprofesiones"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_nuevoprofesiones"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("Profesion", Profesion)
	datos.append("SectorEconomico", SectorEconomico)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmProfesiones.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
			
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE")
					limpiar_campos_nuevoprofesiones();
					buscar_datos_profesiones("ACTIVO");
				} 
				

			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
				//limpiar_campos_profesiones();
			}
		}
	});


}

function limpiar_campos_nuevoprofesiones() {
	
    document.getElementById('inp_idprofesiones_n').value= ''
	document.getElementById('inp_profesion_n').value= ''
	document.getElementById('inp_sectoreconomico_n').value= ''
	 abrir_cerrar_ventanas_nuevoprofesiones("2");
}

/*AÑADIR O MODIFICAR NUEVO NACIONALIDAD*/
function add_datos_nuevonacionalidades(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idnacionalidades_dp').value
	var nacionalidad = document.getElementById('inp_nacionalidad_dp').value
	

	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_nuevonacionalidades"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_nuevonacionalidades"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("nacionalidad", nacionalidad)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmNacionalidades.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
		
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {
				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE")
					limpiar_campos_nuevonacionalidades();
					buscar_datos_nacionalidades("ACTIVO");
				} 
			} else {
				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
			}
		}
	});


}

function limpiar_campos_nuevonacionalidades() {
	
    document.getElementById('inp_idnacionalidades_dp').value= ''
	document.getElementById('inp_nacionalidad_dp').value= ''
	abrir_cerrar_ventanas_nuevonacionalidades("2");
}

/*AÑADIR O MODIFICAR NUEVO ACCESO*/
function add_datos_nuevoaccesos(datos) {
	var f = new Date();
	var id_progreso = f.getMinutes() + "_" + f.getMilliseconds() + "_mensaje";
	var hora = f.getHours() + ':' + f.getMinutes() + ':' + f.getSeconds();
	var cod = document.getElementById('inp_idaccesos_n').value
	var accesos = document.getElementById('inp_accesos_n').value


	var accion = 'guardar'
	if ($(datos).children('p[id="accion_guardar_nuevoaccesos"]').html() == 'guardar') {
		accion = 'guardar'
	}
	if ($(datos).children('p[id="accion_guardar_nuevoaccesos"]').html() == 'editar') {
		accion = 'editar'
	} 
	if (datos == 'eliminar'){
		accion = 'eliminar'
	}
	ver_cerrar_ventana_cargando("1","Cargando....");
	var datos = new FormData();
	datos.append("func", accion)
	datos.append("cod", cod)
	datos.append("accesos", accesos)
	datos.append("hora", hora)
	var OpAjax = $.ajax({

		data: datos,
		url: "./php/abmAccesos.php",
		type: "post",
		cache: false,
		contentType: false,
		processData: false,
		error: function (jqXHR, textstatus, errorThrowm) {
	
			ver_cerrar_ventana_cargando("2","ERROR DE CONEXIÓN...!")


			return false;
		},
		success: function (responseText) {

			Respuesta = responseText;
			////console.log(Respuesta);

			if (Respuesta == "camposvacio") {
				ver_cerrar_ventana_cargando("2","FALTÓ COMPLETAR ALGUN CAMPO");
				return false;
			}
			if (Respuesta == "duplicado") {
				ver_cerrar_ventana_cargando("2","DATO DUPLICADO");
				return false;
			}
			if (Respuesta == "in") {
				ver_cerrar_ventana_cargando("2","DATO INCORRECTO");
				return false();
			}
			if (Respuesta == "exito") {

				if (accion == 'guardar') {
					ver_cerrar_ventana_cargando("2","DATOS REGISTRADO CORRECTAMENTE")
					limpiar_campos_accesos();
				} 
				

			} else {

				ver_cerrar_ventana_cargando("2","LO SENTIMOS OCURRIO ALGO INESPERADO!")
				//limpiar_campos_accesos();
			}
		}
	});
}

function limpiar_campos_accesos() {
	buscaraccesos_combo();
    document.getElementById('inp_idaccesos_n').value= ''
	document.getElementById('inp_accesos_n').value= ''
	abrir_cerrar_ventanas_nuevoaccesos("2");
}

//FUNCIONES ESPECIALES
//busccar datos datospersonales
function buscar_datos_datospersonales_editar() {
	var cedulac = document.getElementById('inp_cedula_df').value
	var datos = {
		"cedulac": cedulac,
		"func": "buscar_datos_personales_editar"
	};
	$.ajax({
		data: datos, url: "./php/abmDatosPersonas.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["25"];
					var datos_buscados = Respuesta;
					
	if(datos_buscados==0){
		ver_vetana_eliminar("CLIENTE NO ENCONTRADO ¿DESEAS REGISTRARLO?",id_progreso,"13");
	}else{
	document.getElementById('inp_iddatospersonales').value= datos["1"];
	document.getElementById('inp_primernombre_dp').value= datos["2"];
	document.getElementById('inp_segundonombre_dp').value=datos["3"];
	document.getElementById('inp_primerapellido_dp').value= datos["4"];
	document.getElementById('inp_segundoapellido_dp').value= datos["5"];
	document.getElementById('inp_apellidocasada_dp').value= datos["6"];
	document.getElementById('inp_cedula_dp').value= datos["8"];
	document.getElementById('inp_ruc_dp').value= datos["9"];
	document.getElementById('inp_fechanac_dp').value= datos["11"];
	document.getElementById('inp_conyugue_dp').value= datos["15"];
	document.getElementById('inp_direccion_dp').value= datos["14"];
	document.getElementById('inp_referencia_dp').value= datos["16"];
	document.getElementById('inp_telefono_dp').value= datos["12"];
	document.getElementById('inp_correo_dp').value= datos["13"];
	document.getElementById('inp_sexo_dp').value= datos["10"];
	document.getElementById('inp_viviendapropia_dp').value= datos["17"];
	document.getElementById('inp_observacion_dp').value= datos["18"];
	document.getElementById('inp_lnglat_dp').value= datos["19"];
	document.getElementById('inp_idbarrios_dp').value= datos["20"];
	document.getElementById('inp_barrios_dp').value= datos["26"];
	document.getElementById('combo_idnacionalidad_dp').value= datos["21"];
	document.getElementById('combo_idestadocivil_dp').value= datos["22"];
	document.getElementById('combo_idtipospersonas_dp').value= datos["23"];
	document.getElementById('inp_idprofesiones_dp').value= datos["24"];
	document.getElementById('inp_profesion_dp').value= datos["27"];
	document.getElementById('btn_guardar_datospersonales').innerHTML = "<p style='display:none;' id='accion_guardar_datospersonales'>editar</p>CONFIRMAR";
	abrir_cerrar_ventanas_datospersonales("8");			
				}
					
				} catch (error) {

				}

			}
		}
	});
}

//busccar datos datospersonales Clientes
function buscar_datos_datospersonales_editar_clientes() {
	
		var cedulac = document.getElementById('inp_cedula_dc').value
	
	
	var datos = {
		"cedulac": cedulac,
		"func": "buscar_datos_personales_editar"
	};
	$.ajax({
		data: datos, url: "./php/abmDatosPersonas.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["25"];
					var datos_buscados = Respuesta;
					
	if(datos_buscados==0){
		ver_vetana_eliminar("CLIENTE NO ENCONTRADO ¿DESEAS REGISTRARLO?",id_progreso,"15");
	}else{
	document.getElementById('inp_iddatospersonales').value= datos["1"];
	document.getElementById('inp_primernombre_dp').value= datos["2"];
	document.getElementById('inp_segundonombre_dp').value=datos["3"];
	document.getElementById('inp_primerapellido_dp').value= datos["4"];
	document.getElementById('inp_segundoapellido_dp').value= datos["5"];
	document.getElementById('inp_apellidocasada_dp').value= datos["6"];
	document.getElementById('inp_cedula_dp').value= datos["8"];
	document.getElementById('inp_ruc_dp').value= datos["9"];
	document.getElementById('inp_fechanac_dp').value= datos["11"];
	document.getElementById('inp_conyugue_dp').value= datos["15"];
	document.getElementById('inp_direccion_dp').value= datos["14"];
	document.getElementById('inp_referencia_dp').value= datos["16"];
	document.getElementById('inp_telefono_dp').value= datos["12"];
	document.getElementById('inp_correo_dp').value= datos["13"];
	document.getElementById('inp_sexo_dp').value= datos["10"];
	document.getElementById('inp_viviendapropia_dp').value= datos["17"];
	document.getElementById('inp_observacion_dp').value= datos["18"];
	document.getElementById('inp_lnglat_dp').value= datos["19"];
	document.getElementById('inp_idbarrios_dp').value= datos["20"];
	document.getElementById('inp_barrios_dp').value= datos["26"];
	document.getElementById('combo_idnacionalidad_dp').value= datos["21"];
	document.getElementById('combo_idestadocivil_dp').value= datos["22"];
	document.getElementById('combo_idtipospersonas_dp').value= datos["23"];
	document.getElementById('inp_idprofesiones_dp').value= datos["24"];
	document.getElementById('inp_profesion_dp').value= datos["27"];
	document.getElementById('btn_guardar_datospersonales').innerHTML = "<p style='display:none;' id='accion_guardar_datospersonales'>editar</p>CONFIRMAR";
	abrir_cerrar_ventanas_datospersonales("10");			
				}
					
				} catch (error) {

				}

			}
		}
	});
}

//busccar datos iddatospersonas
function buscar_datos_iddatospersonas() {
	var cedulac = document.getElementById('inp_cedula_dp').value
	var datos = {
		"cedulac": cedulac,
		"func": "buscar_datos_personales_editar"
	};
	$.ajax({
		data: datos, url: "./php/abmDatosPersonas.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["25"];
					var datos_buscados = Respuesta;
					
	if(datos_buscados==0){
		ver_vetana_eliminar("CLIENTE NO ENCONTRADO ¿DESEAS REGISTRARLO?",id_progreso,"13");
		
	}else{
	document.getElementById('inp_idpersonas_df').value= datos["1"];		
	document.getElementById('inp_cedula_df').value= datos["8"];	
				}
					
				} catch (error) {

				}

			}
		}
	});
}

//busccar datos iddatospersonas clientes
function buscar_datos_iddatospersonas_clientes() {
	var cedulac = document.getElementById('inp_cedula_dp').value
	var datos = {
		"cedulac": cedulac,
		"func": "buscar_datos_personales_editar"
	};
	$.ajax({
		data: datos, url: "./php/abmDatosPersonas.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["25"];
					var datos_buscados = Respuesta;
					
	if(datos_buscados==0){
		ver_vetana_eliminar("CLIENTE NO ENCONTRADO ¿DESEAS REGISTRARLO?",id_progreso,"13");
		
	}else{
	document.getElementById('inp_idpersonas_dc').value= datos["1"];		
	document.getElementById('inp_cedula_dc').value= datos["8"];	
				}
					
				} catch (error) {

				}

			}
		}
	});
}

//busccar datos iddatospersonas clientes
function verificar_clientes_con_solicitudes_pendientes_borrador() {
	var cedula = document.getElementById('inp_cedula_sc').value

	var datos = {
		"cedula": cedula,
		"func": "verificar_clientes_con_solicitudes_pendiente_o_en_borrador"
	};
	$.ajax({
		data: datos, url: "./php/Solicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
	                if(Respuesta=="exito"){
                        var datos1=parseInt(datos["2"]);
                        var contrato=datos["3"];
                        var fecha=datos["4"];
                        var cliente=datos["6"];
                        var cargador=datos["7"];
                        var estado=datos["8"];
						var detalle="";
                        if(estado=="BORRADOR"){
							detalle="EN";
						}
						if(datos1<=0){
                        buscar_datos_editar_clientes();
						buscarestadosciviles_combo();
	                    }else{
						ver_cerrar_ventana_cargando("2","EL CLIENTE "+cliente+" YA TIENE UNA SOLICITUD "+detalle+" "+estado+",Nº:"+contrato+" REGISTRADO EL:"+fecha+ " CARGADO POR:" +cargador);
				        return false;
						}
	                }
					
				} catch (error) {

				}

			}
		}
	});
}

//busccar datos  Clientes CREDITO
function buscar_datos_editar_clientes(){
		var cedulac = document.getElementById('inp_cedula_sc').value
	var datos = {
		"cedulac": cedulac,
		"func": "buscar_datos_clientes_editar"
	};
	$.ajax({
		data: datos, url: "./php/abmClientes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["25"];
					var datos_buscados = Respuesta;
					
	if(datos_buscados==0){
		ver_vetana_eliminar("CLIENTE NO ENCONTRADO ¿DESEAS REGISTRARLO?",id_progreso,"17");
			document.getElementById('inp_cedula_dp').disabled = true;
	}else{
		
	document.getElementById('inp_iddatospersonales').value= datos["1"];
	document.getElementById('inp_primernombre_dp').value= datos["2"];
	document.getElementById('inp_segundonombre_dp').value=datos["3"];
	document.getElementById('inp_primerapellido_dp').value= datos["4"];
	document.getElementById('inp_segundoapellido_dp').value= datos["5"];
	document.getElementById('inp_apellidocasada_dp').value= datos["6"];
	document.getElementById('inp_cedula_dp').value= datos["8"];
	document.getElementById('inp_ruc_dp').value= datos["9"];
	document.getElementById('inp_fechanac_dp').value= datos["11"];
	document.getElementById('inp_conyugue_dp').value= datos["15"];
	document.getElementById('inp_direccion_dp').value= datos["14"];
	document.getElementById('inp_referencia_dp').value= datos["16"];
	document.getElementById('inp_telefono_dp').value= datos["12"];
	document.getElementById('inp_correo_dp').value= datos["13"];
	document.getElementById('inp_sexo_dp').value= datos["10"];
	document.getElementById('inp_viviendapropia_dp').value= datos["17"];
	document.getElementById('inp_observacion_dp').value= datos["18"];
	document.getElementById('inp_lnglat_dp').value= datos["19"];
	document.getElementById('inp_idbarrios_dp').value= datos["20"];
	document.getElementById('inp_barrios_dp').value= datos["26"];
	document.getElementById('combo_idnacionalidad_dp').value= datos["21"];
	

	document.getElementById('combo_idtipospersonas_dp').value= datos["23"];
	document.getElementById('inp_idprofesiones_dp').value= datos["24"];
	document.getElementById('inp_profesion_dp').value= datos["27"];
	document.getElementById('inp_idClientes_sc').value= datos["28"];
	
	document.getElementById('btn_guardar_datospersonales').innerHTML= "<p style='display:none;' id='accion_guardar_datospersonales'>editar</p>CONFIRMAR";
	abrir_cerrar_ventanas_datospersonales("12");
document.getElementById('combo_idestadocivil_dp').value= datos["22"];	
		document.getElementById('inp_cedula_dp').disabled = true;
				}
					
				} catch (error) {

				}

			}
		}
	});
}



//busccar datos iddatospersonas clientes
function buscar_datos_idClientes_clientes() {
	var cedulac = document.getElementById('inp_cedula_dp').value
	var datos = {
		"cedulac": cedulac,
		"func": "buscar_datos_clientes_editar"
	};
	$.ajax({
		data: datos, url: "./php/abmClientes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {
			var Respuesta = responseText;
			////console.log(Respuesta)
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["28"];
					var datos_buscados = Respuesta;
	                document.getElementById('inp_idClientes_sc').value= datos_buscados			
					
				} catch (error) {

				}

			}
		}
	});
}

//CONVERTIR CON PUNTO DECIMALES
function obtener_datos_decimales(d){
	if(d=="1"){
		var total=document.getElementById('inp_comisionventa').value;
	    document.getElementById('inp_comisionventa').value=format_con_puntos_decimales(total);
	}
	if(d=="2"){
		var total=document.getElementById('inp_comisioncobro').value;
	    document.getElementById('inp_comisioncobro').value=format_con_puntos_decimales(total);
	}
	if(d=="3"){
		var total=document.getElementById('inp_monto_c').value;
	    document.getElementById('inp_monto_c').value=format_con_puntos_decimales(total);
	}
	if(d=="4"){
		var total=document.getElementById('inp_cuota_c').value;
	    document.getElementById('inp_cuota_c').value=format_con_puntos_decimales(total);
	}
	if(d=="5"){
		var total=document.getElementById('inp_preciocuota_c').value;
	    document.getElementById('inp_preciocuota_c').value=format_con_puntos_decimales(total);
	}
	if(d=="6"){
		var total=document.getElementById('inp_pordiapoco').value;
	    document.getElementById('inp_pordiapoco').value=format_con_puntos_decimales(total);
	}
	if(d=="7"){
		var total=document.getElementById('inp_pordiamas').value;
	    document.getElementById('inp_pordiamas').value=format_con_puntos_decimales(total);
	}
	if(d=="8"){
		var total=document.getElementById('inp_porsemanapoco').value;
	    document.getElementById('inp_porsemanapoco').value=format_con_puntos_decimales(total);
	}
	if(d=="9"){
		var total=document.getElementById('inp_porsemanamas').value;
	    document.getElementById('inp_porsemanamas').value=format_con_puntos_decimales(total);
	}
	if(d=="10"){
		var total=document.getElementById('inp_pormespoco').value;
	    document.getElementById('inp_pormespoco').value=format_con_puntos_decimales(total);
	}
	if(d=="11"){
		var total=document.getElementById('inp_pormesmas').value;
	    document.getElementById('inp_pormesmas').value=format_con_puntos_decimales(total);
	}
	if(d=="12"){
		var total=document.getElementById('inp_alquilervivienda').value;
	    document.getElementById('inp_alquilervivienda').value=format_con_puntos_decimales(total);
	}
	if(d=="13"){
		var total=document.getElementById('inp_alquilercomercio').value;
	    document.getElementById('inp_alquilercomercio').value=format_con_puntos_decimales(total);
	}
	if(d=="14"){
		var total=document.getElementById('inp_banco').value;
	    document.getElementById('inp_banco').value=format_con_puntos_decimales(total);
	}
	if(d=="15"){
		var total=document.getElementById('inp_cooperativa').value;
	    document.getElementById('inp_cooperativa').value=format_con_puntos_decimales(total);
	}
	if(d=="16"){
		var total=document.getElementById('inp_financiera').value;
	    document.getElementById('inp_financiera').value=format_con_puntos_decimales(total);
	}
	if(d=="17"){
		var total=document.getElementById('inp_electrodomesticos').value;
	    document.getElementById('inp_electrodomesticos').value=format_con_puntos_decimales(total);
	}
	if(d=="18"){
		var total=document.getElementById('inp_usureros').value;
	    document.getElementById('inp_usureros').value=format_con_puntos_decimales(total);
	}
	if(d=="19"){
		var total=document.getElementById('inp_cantidaddehijos').value;
	    document.getElementById('inp_cantidaddehijos').value=format_con_puntos_decimales(total);
	}
	if(d=="20"){
		var total=document.getElementById('inp_cuota_rc').value;
	    document.getElementById('inp_cuota_rc').value=format_con_puntos_decimales(total);
	}
	if(d=="21"){
		var total=document.getElementById('inp_plazo').value;
	    document.getElementById('inp_plazo').value=format_con_puntos_decimales(total);
	}
	if(d=="22"){
		var total=document.getElementById('inp_saldo').value;
	    document.getElementById('inp_saldo').value=format_con_puntos_decimales(total);
	}
	if(d=="23"){
		var total=document.getElementById('inp_salariomensual').value;
	    document.getElementById('inp_salariomensual').value=format_con_puntos_decimales(total);
	}
	if(d=="24"){
		var total=document.getElementById('inp_porquincenapoco').value;
	    document.getElementById('inp_porquincenapoco').value=format_con_puntos_decimales(total);
	}
	if(d=="25"){
		var total=document.getElementById('inp_porquincenamas').value;
	    document.getElementById('inp_porquincenamas').value=format_con_puntos_decimales(total);
	}
	if(d=="26"){
		var total=document.getElementById('inp_salarioextras').value;
	    document.getElementById('inp_salarioextras').value=format_con_puntos_decimales(total);
	}
	if(d=="27"){
		var total=document.getElementById('inp_montoapertura_ac').value;
	    document.getElementById('inp_montoapertura_ac').value=format_con_puntos_decimales(total);
	}

	if(d=="28"){
		var total=document.getElementById('div_descuento_'+datosprcod_cob+'').value;
	    document.getElementById('div_descuento_'+datosprcod_cob+'').value=format_con_puntos_decimales(total);
	}
	if(d=="29"){
		var total=document.getElementById('inp_totalaentregar_pcobros_c').value;
	    document.getElementById('inp_totalaentregar_pcobros_c').value=format_con_puntos_decimales(total);
	}
	
	if(d=="30"){
	 var total=document.getElementById('inp_efectivo_cobrosclientes').value;
	 var total1=document.getElementById('inp_totalaentregar_pcobros_c').value;
	 document.getElementById('inp_efectivo_cobrosclientes').value=format_con_puntos_decimales(total);
     var efectivo=total.toString().replace(/\./g,'');
     var totalapagar=total1.toString().replace(/\./g,'');
     var vuelto=0;
     if(parseInt(efectivo)<parseInt(totalapagar)){
      vuelto=0;
     }else{
      vuelto=parseInt(efectivo)- parseInt(totalapagar);  
     }
      document.getElementById('inp_vuelto_cobrosclientes').value=format_con_puntos_decimales(vuelto);
	}

	if(d=="31"){
		var total=document.getElementById('inp_monto_oi').value;
	    document.getElementById('inp_monto_oi').value=format_con_puntos_decimales(total);
	}
	if(d=="32"){
		var total=document.getElementById('inp_monto_oe').value;
	    document.getElementById('inp_monto_oe').value=format_con_puntos_decimales(total);
	}
    
	if(d=="33"){
		var total=document.getElementById('inp_totalaentregar_pcobros_proveedores').value;
	    document.getElementById('inp_totalaentregar_pcobros_proveedores').value=format_con_puntos_decimales(total);
	}
	
}


function format_con_puntos_decimales(valor){
var num = valor.toString().replace(/\./g,'');
if(!isNaN(num)){
num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
return num;
}else{ 
return "";
}
}

	    function validar_solo_numeros(evt){
			var code = (evt.which) ? evt.which : evt.keyCode;
			if(code==8) { 
			  return true;
			} else if(code>=48 && code<=57) {
			  return true;
			} else{ 
			  return false;
			}
		}


