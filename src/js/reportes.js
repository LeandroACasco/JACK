

function cargarreportefactura(){
    var ventas_cod = document.getElementById('inp_nrosolicitud_desembolso').value
	var monto=QuitarSeparadorMilValor(document.getElementById("inp_totalintfinan_desembolso").value.replace(/\./g,''));
	var letras=numeroALetras(monto, {
  plural: 'GUARANIES',
  singular: 'GUARANIES',
  centPlural: 'GUARANIES',
  centSingular: 'GUARANIES'
});	
	
	var datos = {
		"ventas_cod": ventas_cod,
		"letras": letras,
		"func": "buscarfactura"
	};
	            
					var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	  var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("vistaimpresion", documento);
	 window.open("./reportes/");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}


function cargar_reporte_plan_pago(){
	var ventas_cod = document.getElementById('inp_nrosolicitud_desembolso').value
	

	var datos = {
		"ventas_cod": ventas_cod,
		
		"func": "buscar_plan_prestamos"
	};
	            
					var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	 var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("vistaimpresion", documento);
	 window.open("./reportes/");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}


function cargarreportepagare(){
	var nrosolicitud=document.getElementById("inp_nrosolicitud_desembolso").value
	var monto=QuitarSeparadorMilValor(document.getElementById('inp_totalcuota_desembolso').value);
	var montoletras=numeroALetras(monto, {
  plural: 'GUARANIES',
  singular: 'GUARANIES',
  centPlural: 'GUARANIES',
  centSingular: 'GUARANIES'
});	
	var datos = {
		"nrosolicitud": nrosolicitud,
		"montoletras": montoletras,
		"func": "pagare"
	};
	            
					var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	 var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("pagare", documento);
	 window.open("./reportes/pagare.html");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}

function cargarreporterecibo(nrorecibo,monto){
	var montoletras=numeroALetras(monto, {
  plural: 'GUARANIES',
  singular: 'GUARANIES',
  centPlural: 'GUARANIES',
  centSingular: 'GUARANIES'
});	
	var datos = {
		"nrorecibo": nrorecibo,
		"montoletras": montoletras,
		"func": "recibo"
	};
	            
					var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	 var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("recibo", documento);
	 window.open("./reportes/recibo.html");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}

function cargar_reporte_planilla_caja(){
	var fecha = document.getElementById('inp_fecha_planilla_caja').value
	var resumen = document.getElementById('inp_resumen_planilla').value
	var caja_cod = document.getElementById('inp_cajanro_planilla').value
var lote = document.getElementById('inp_lote_planilla').value
	var datos = {
		"fecha": fecha,
		"resumen": resumen,
		"caja_cod": caja_cod,
		"lote": lote,
		"func": "buscar_planilla_caja_reportes"
	};
	            
					var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	 var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("vistaimpresion", documento);
	 window.open("./reportes/");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}

function buscar_caja_actual_reporte(){
var caja_cod = document.getElementById('usuario_idcaja').innerHTML

	var datos = {
		
		"caja_cod": caja_cod,
		"func": "buscar_caja_actual_reporte"
	};
	            
					var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	 var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("vistaimpresion", documento);
	 window.open("./reportes/");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}

function buscar_auditoria_de_compras_reportes(){
var proveedores_cod = document.getElementById('inp_proveedor_auditoriacompras').value
	var desde = document.getElementById('inp_desde_auditoriacompras').value
	var hasta = document.getElementById('inp_hasta_auditoriacompras').value
var usocontable = document.getElementById('inp_usocontrable_auditoriacompras').value
	var datos = {
		
		"proveedores_cod": proveedores_cod,
		"desde": desde,
		"hasta": hasta,
		"usocontable": usocontable,
		"func": "buscar_auditoria_de_compras_reportes"
	};
	            
					var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	 var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("vistaimpresion", documento);
	 window.open("./reportes/");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}

function buscar_auditoria_de_otros_ingresos_reportes(){
	var caja_cod = document.getElementById('inp_caja_auditoriaotrosingresos').value
	var desde = document.getElementById('inp_desde_auditoriaotrosingresos').value
	var hasta = document.getElementById('inp_hasta_auditoriaotrosingresos').value

	var datos = {
		
		"caja_cod": caja_cod,
		"desde": desde,
		"hasta": hasta,
		"func": "buscar_auditoria_de_otros_ingresos_reportes"
	};     
    var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	 var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("vistaimpresion", documento);
	 window.open("./reportes/");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}

function buscar_auditoria_de_otros_egresos_reportes(){
	var caja_cod = document.getElementById('inp_caja_auditoriaotrosegresos').value
	var desde = document.getElementById('inp_desde_auditoriaotrosegresos').value
	var hasta = document.getElementById('inp_hasta_auditoriaotrosegresos').value

	var datos = {
		
		"caja_cod": caja_cod,
		"desde": desde,
		"hasta": hasta,
		"func": "buscar_auditoria_de_otros_egresos_reportes"
	};     
    var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	 var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("vistaimpresion", documento);
	 window.open("./reportes/");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}

function buscar_auditoria_de_pagos_proveedores_creditos_reportes(){
	var caja_cod = document.getElementById('inp_caja_auditoriapagos').value
	var desde = document.getElementById('inp_desde_auditoriapagos').value
	var hasta = document.getElementById('inp_hasta_auditoriapagos').value

	var datos = {
		
		"caja_cod": caja_cod,
		"desde": desde,
		"hasta": hasta,
		"func": "buscar_auditoria_de_pagos_proveedores_creditos_reportes"
	};     
    var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	 var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("vistaimpresion", documento);
	 window.open("./reportes/");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}

function buscar_auditoria_de_cobranzas_reportes(){
	var caja_cod = document.getElementById('inp_caja_auditoriacobranzas').value
	var usuarios_cod = document.getElementById('inp_usuarios_auditoriacobranzas').value
	var cobrador_cod = document.getElementById('inp_cobrador_auditoriacobranzas').value
	var desde = document.getElementById('inp_desde_auditoriacobranzas').value
	var hasta = document.getElementById('inp_hasta_auditoriacobranzas').value
    var usocontable = document.getElementById('inp_usocontrable_auditoriacobranzas').value

	var datos = {
		
		"caja_cod": caja_cod,
		"desde": desde,
		"hasta": hasta,
		"usuarios_cod": usuarios_cod,
		"cobrador_cod": cobrador_cod,
		"usocontable": usocontable,
		"func": "buscar_auditoria_de_cobranzas_reportes"
	};     
    var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	 var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("vistaimpresion", documento);
	 window.open("./reportes/");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}

function buscar_auditoria_de_desembolsos_reportes(){
	var caja_cod = document.getElementById('inp_caja_auditoriadesembolsos').value
	var desde = document.getElementById('inp_desde_auditoriadesembolsos').value
	var hasta = document.getElementById('inp_hasta_auditoriadesembolsos').value


	var datos = {
		
		"caja_cod": caja_cod,
		"desde": desde,
		"hasta": hasta,
		"func": "buscar_auditoria_de_desembolsos_reportes"
	};     
    var pagina="";
	$.ajax({
		data: datos, url: "./php/reportes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {

			
		},
		success: function (responseText) {

			var Respuesta = responseText;
			console.log(Respuesta)
	
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					 pagina= datos["1"];
					
             
		
	 var documento=pagina;
	 documento=b64EncodeUnicode(documento)
	 localStorage.setItem("vistaimpresion", documento);
	 window.open("./reportes/");
	 document.getElementById("DivImprimir").innerHTML = "";
				} catch (error) {
					
				}
			}
		}
	});
}

function QuitarSeparadorMilValor(inputs){
	var i=inputs;
   i=i.replace(/\./g, '')
	i=i.replace(',','.')
	return i;

	
}