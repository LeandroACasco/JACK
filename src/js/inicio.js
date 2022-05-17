/*onload*/
 window.onload=function(){
				if (typeof history.pushState === "function") {
        history.pushState("jibberish", null, null);

        window.onpopstate = function () {
            history.pushState('newjibberish', null, null);
			
            // Handle the back (or forward) buttons here
            // Will NOT handle refresh, use onbeforeunload for this.
        };
    }
    else {
        var ignoreHashChange = true;
        window.onhashchange = function () {
            if (!ignoreHashChange) {
                ignoreHashChange = true;
                window.location.hash = Math.random();
            }
            else {
                ignoreHashChange = false;   
            }
          };
       }
	   
			buscarmisdatos();
			obtener_coodernadas("relieve");
}
		
function ocultarmensaje(){
	document.getElementById('capa_informativa').innerHTML=""
	document.getElementById('capa_informativa').style.display='none'
}

function verCerrarEfectoCargando(d){
	document.getElementById("div_principal_info_carga").style.display='none'
	if(d=="1"){
	document.getElementById("div_principal_info_carga").style.display=''
	}
}

function buscarmisdatos(){
		ver_cerrar_ventana_cargando("1","CARGANDO...");
		 	
				obtener_datos_user();
				 var datos = {
			 "useru":userid,
			 "passu":passuser,
			 "navegador": navegador,
			"funt": "buscarmisdatos"
			};
	 $.ajax({
			
			data: datos,
			url: "./php/abmusuario.php",
			type:"post",
			beforeSend: function(){			
			
			
			},
				error: function(jqXHR, textstatus, errorThrowm){
	ver_cerrar_ventana_cargando("3");
		
			},
			success: function(responseText)
			{
     ver_cerrar_ventana_cargando("3");
			var Respuesta=responseText;
     ////console.log(Respuesta)
			try{
				var datos = $.parseJSON(Respuesta); 
          Respuesta=datos["1"];  
			
		 if (Respuesta=="UI"){
			IrAlogin()
				ver_cerrar_ventana_cargando("2","USUARIO INCORRECTO VUELVA A INICIAR SESION...");
				  return false;
			} 
			if (Respuesta=="NI")
			{
		
			ver_cerrar_ventana_cargando("2","NO PUEDES REALIZAR LA ACCIÓN...");			
				return false;
			} 
	    if (Respuesta == "exito"){	
		  document.cookie="user="+userid+";max-age=864000;path=/";
          document.cookie="pass="+passuser+";max-age=864000;path=/";	
		  var Nusuario=datos[2];
		  var Acceso=datos[3];
		  var IDusuario=datos[4];
		 document.getElementById("usuario_datos").innerHTML=Acceso+"=>"+Nusuario;
		 document.getElementById("usuarios_datos").innerHTML=Nusuario;
		 document.getElementById("idusuarios_datos").innerHTML=IDusuario;
		 document.getElementById("acceso_datos").innerHTML=Acceso;

         if(datos[6]==""){
          document.getElementById("usuario_sucursalycaja").innerHTML=datos[5]+" - CAJA CERRADA";
          document.getElementById("usuario_idcaja").innerHTML="";
         }else{
          document.getElementById("usuario_sucursalycaja").innerHTML=datos[5]+" - "+datos[7];
          document.getElementById("usuario_idcaja").innerHTML=datos[6];
          document.getElementById("usuario_idsucursal").innerHTML=datos[8];
         }
		 document.getElementById("inp_sucursal_pcobros_c").value=datos[5];


		 //se muestran todos los sub menu
		 document.getElementById('m_solicitudes').style.display='';
		 document.getElementById('m_atc').style.display='';
		 document.getElementById('m_cajax').style.display='';
		 document.getElementById('m_mantenimientos').style.display='';
		 document.getElementById('m_ubicaciones').style.display='';
		 document.getElementById('m_reportes').style.display='';


		var accesos_cod=datos[9];

		var datos = new FormData();
		datos.append("func" , "obtenerFunciones");
		datos.append("buscar" , accesos_cod);
		datos.append("html" , 2);

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
				var datos = $.parseJSON(responseText);
				$.each(datos["2"], function(j, obj){
					if(obj[1] === 1){
						document.getElementById(obj[0]).style.display='';
					}
				});
			}
		});

	    //  if(Acceso=="ADMINISTRADOR"){
			
		// 	 //MENU MANTENIMIENTOS
		// 	document.getElementById('m_solicitudes').style.display='';
		// 	document.getElementById('m_solicitudescredito').style.display='';
		// 	document.getElementById('m_solicitudescredito_pendientes').style.display='';
		// 	document.getElementById('m_solicitudes').style.display='';
		// 	document.getElementById('m_creditos').style.display='';
		//  document.getElementById('m_mantenimientos').style.display='';
		// 	document.getElementById('m_ubicaciones').style.display='';
		// 	document.getElementById('m_datospersonales').style.display='';
		// 	document.getElementById('m_sucursales').style.display='';
		// 	document.getElementById('m_accesos').style.display='';
		// 	document.getElementById('m_profesiones').style.display='';
		// 	document.getElementById('m_nacionalidades').style.display='';
		// 	document.getElementById('m_estadosciviles').style.display='';
		// 	document.getElementById('m_tipospersonas').style.display='';
		// 	document.getElementById('m_Barrios').style.display='';
		// 	document.getElementById('m_ciudades').style.display='';
		// 	document.getElementById('m_departamentos').style.display='';
		// 	document.getElementById('m_regiones').style.display='';
		// 	document.getElementById('m_usuarios').style.display='';
	    //     //document.getElementById('m_ajustes').style.display='';
		// 	document.getElementById('m_ajustesfactura').style.display='';
		// 	document.getElementById('m_ajustesinteres').style.display='';
		// 	document.getElementById('m_aperturacaja').style.display='';
		// 	document.getElementById('m_cierrecaja').style.display='';
		// 	document.getElementById('m_caja').style.display='';
		// 	document.getElementById('m_datoscaja').style.display='';
		// 	document.getElementById('m_reportes').style.display='';
		// 	//document.getElementById('m_cuoteros').style.display='';
		// 	document.getElementById('m_utilidades').style.display='';
		// 	document.getElementById('m_atc').style.display='';
		// 	document.getElementById('m_cajax').style.display='';
		// 	document.getElementById('m_conceptos').style.display='';
		// 	document.getElementById('m_otrosingresos').style.display='';
		// 	document.getElementById('m_otrosengresos').style.display='';
        //     document.getElementById('m_cajaegresos').style.display='';
	    //     document.getElementById('m_cajaingresos').style.display='';
	    //     document.getElementById('m_proveedores').style.display='';
	    //    // document.getElementById('m_compras').style.display='';
	    //     document.getElementById('m_pagos_a_proveedores').style.display='';
	    //     document.getElementById('m_pagos_contado_a_proveedores').style.display='';
	    //     document.getElementById('m_planilladecaja').style.display='';
	    //     //document.getElementById('m_auditoriadecompras').style.display='';
	    //     document.getElementById('m_auditoriadeotrosingresos').style.display='';
	    //     document.getElementById('m_auditoriadeotrosegresos').style.display='';
	    //     document.getElementById('m_auditoriadepagos').style.display='';
	    //     document.getElementById('m_cobranzas').style.display='';
	    //     //document.getElementById('m_desembolso').style.display='';
	    //     document.getElementById('m_resumeningresoegreso').style.display='';
	    //     document.getElementById('m_web_pagoexpress').style.display='';
		//  }
		 
		//    if(Acceso=="VENDEDOR"){
			
		// 	 //MENU MANTENIMIENTOS
		// 	document.getElementById('m_solicitudes').style.display='';
		// 	document.getElementById('m_solicitudescredito').style.display='';
		// 	document.getElementById('m_solicitudescredito_pendientes').style.display='';
		// 	document.getElementById('m_solicitudes').style.display='';
		// 	document.getElementById('m_creditos').style.display='';
		// 	document.getElementById('m_mantenimientos').style.display='';
		// 	document.getElementById('m_ubicaciones').style.display='';
		// 	document.getElementById('m_datospersonales').style.display='';
		// 	document.getElementById('m_sucursales').style.display='';
		// 	document.getElementById('m_accesos').style.display='';
		// 	document.getElementById('m_profesiones').style.display='';
		// 	document.getElementById('m_nacionalidades').style.display='';
		// 	document.getElementById('m_estadosciviles').style.display='';
		// 	document.getElementById('m_tipospersonas').style.display='';
		// 	document.getElementById('m_Barrios').style.display='';
		// 	document.getElementById('m_ciudades').style.display='';
		// 	document.getElementById('m_departamentos').style.display='';
		// 	document.getElementById('m_regiones').style.display='';
		// 	document.getElementById('m_usuarios').style.display='';
		// 	document.getElementById('m_cuoteros').style.display='';
		// 	document.getElementById('m_utilidades').style.display='';
	    //     document.getElementById('m_ajustes').style.display='';
		// 	document.getElementById('m_ajustesfactura').style.display='';
		// 	document.getElementById('m_ajustesinteres').style.display='';
		// 	document.getElementById('m_aperturacaja').style.display='';
		// 	document.getElementById('m_cierrecaja').style.display='';
		// 	document.getElementById('m_caja').style.display='';
		// 	document.getElementById('m_datoscaja').style.display='';
	    //     document.getElementById('m_reportes').style.display='';
      
        //     document.getElementById('m_proveedores').style.display='';

        //     document.getElementById('m_compras').style.display='';
        //     document.getElementById('m_pagos_a_proveedores').style.display='';
		// 	document.getElementById('m_pagos_contado_a_proveedores').style.display='';
		// 	//MENU REPORTES
	    //     document.getElementById('m_atc').style.display='';
		// 	document.getElementById('m_cajax').style.display='';
		// 	document.getElementById('m_conceptos').style.display='';
	    //     document.getElementById('m_otrosingresos').style.display='';
	    //     document.getElementById('m_otrosengresos').style.display='';
	    //     document.getElementById('m_cajaegresos').style.display='';
	    //     document.getElementById('m_cajaingresos').style.display='';
	    //     document.getElementById('m_planilladecaja').style.display='';
			
		// 	document.getElementById('m_auditoriadecompras').style.display='';
	    //     document.getElementById('m_auditoriadeotrosingresos').style.display='';
	    //     document.getElementById('m_auditoriadeotrosegresos').style.display='';
	    //     document.getElementById('m_auditoriadepagos').style.display='';
	    //     document.getElementById('m_cobranzas').style.display='';
	    //     document.getElementById('m_desembolso').style.display='';
	    //     document.getElementById('m_resumeningresoegreso').style.display='';
	    //     document.getElementById('m_web_pagoexpress').style.display='';

		//  }

		 }
			}catch(error)
				{
				ver_cerrar_ventana_cargando("2","LO SENTIMOS HA OCURRIDO UN ERROR...");
				}
			}
			});
	
	
}

var paginacargando="<center><br><br><img src='./icono/cargando.gif' style='width:30px' /></center>";
var userid="1";
var passuser="NDE4MQ++";
var navegador="NoDefinido"
   function obtener_datos_user(){
	
	userid=buscar_datos_url_usuario('q');
	passuser=buscar_datos_url_usuario('p');
	navegador=obtener_navegor_en_uso();
	
	if(userid==""){
		 document.cookie="user=;max-age=86400;path=/";
               document.cookie="pass=;max-age=86400;path=/";
IrAlogin();
	}
	if(passuser==""){
			 document.cookie="user=;max-age=86400;path=/";
               document.cookie="pass=;max-age=86400;path=/";
		       IrAlogin()

	}
}
   function IrAlogin(){
	document.cookie="user=;max-age=864000;path=/";
    document.cookie="pass=;max-age=864000;path=/";
	window.location="./index.html";
}
   function obtener_datos(datos){
		
   var loc = datos;
   if (loc.indexOf('?')>0){
   
   var getstring = loc.split('?')[1];
   var GET= getstring.split('&');
   var get ={};
  
   for (var i =0, l = GET.length; i < l;i++)
   {
   var tmp = GET[i].split('=');
   get[tmp[0]]= unescape(decodeURI(tmp[1]));
   
   }
   return get;
   }
	}
   function buscar_datos_url_usuario(datos){
		try{
			valores = document.location.href;
		 valores = obtener_datos(valores);
		 var  datos=valores[datos];
		 return datos;
		}catch(error){
		return "";
		} 
	}
	
 //buscar cookies
	 function buscar_este_cookie(name){
		 var nameEQ=name+"=";
		 var ca= document.cookie.split(";");
		 for(var i=0;i<ca.length;i++)
		 {
			 var c =ca[i];
			 while(c.charAt(0)==' ')c=c.substring(1,c.length);
			 if(c.indexOf(nameEQ)==0){
				 return decodeURIComponent (c.substring(nameEQ.length,c.length));
			 }
		 }
		 return null;
	 }
	 
	  /*Obtener navegador en uso*/
	 function obtener_navegor_en_uso(){
	 	var navegador =navigator.userAgent;
		var na ;
		if((na=navegador.indexOf('MSIE'))!==-1)
		{
		  navegador = "explorer";
		}else{
		if((na=navegador.indexOf('OPERA'))!==-1)
		{
		  navegador = "opera";
		}else{
		if((na=navegador.indexOf('Chrome'))!==-1)
		{
		  navegador = "chrome";
		}else{
		if((na=navegador.indexOf('Firefox'))!==-1)
		{
		  navegador = "Firefox";
		}else{
		navegador ="otros";
		}
	       }
		   }
		   }
		return navegador ;   
	 }


function cerrarSesion(){
	
	
	verCerrarEfectoCargando("1")
	  var datos = new FormData();
			obtener_datos_user();
			 datos.append("useru" , userid)
			 datos.append("passu" , passuser)
			 datos.append("navegador" , navegador)
			 datos.append("funt", "cerrarsesion")
			
		
			
			var OpAjax= $.ajax({
			
			data: datos,
			url: "./php/abmusuario.php",
			type:"post",
	        cache:false,
			contentType: false,
			processData: false,
				error: function(jqXHR, textstatus, errorThrowm){
						verCerrarEfectoCargando("")
					
ver_vetana_informativa("ERROR DE CONECCIÓN...",id_progreso);
					 return false;
			},
			success: function(responseText)
			{
			  	 verCerrarEfectoCargando("")
			Respuesta=responseText;			
				//console.log(Respuesta)
		try{
				var datos = $.parseJSON(Respuesta); 
          Respuesta=datos["1"];  
		 

		 if (Respuesta=="UI")
			{
		
			IrAlogin()
			
						return false;
					


			} 
			
			
			if (Respuesta=="exito")
			{
		
				IrAlogin()
					


			}
			else
			{
			ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...",id_progreso);
	
				

			}
			
			}catch(error)
				{
					ver_vetana_informativa("LO SENTIMOS HA OCURRIDO UN ERROR...",id_progreso);
					
				}
		 
					
			}
			});
			
	
}

	 
	 
	

function controlcerrrarventana(){
	
    //cerrar pagos
	buscarmisdatos();

   //cerrar Barrios
	abrir_cerrar_ventanas_Barrios("2");
	abrir_cerrar_ventanas_Barrios("4");	
	//cerrar ciudades
	abrir_cerrar_ventanas_Ciudades("2");
	abrir_cerrar_ventanas_Ciudades("4");
	//cerrar departamentos
	abrir_cerrar_ventanas_departamentos("2");
	abrir_cerrar_ventanas_departamentos("4");
	//cerrar regiones
	abrir_cerrar_ventanas_regiones("2");
	abrir_cerrar_ventanas_regiones("4");	
    //cerrar sucursales
	abrir_cerrar_ventanas_sucursales("2");
	abrir_cerrar_ventanas_sucursales("4");	
	//cerrar accesos
	abrir_cerrar_ventanas_accesos("2");
	abrir_cerrar_ventanas_accesos("4");	
//cerrar conceptos
	abrir_cerrar_ventanas_conceptos("2");
	abrir_cerrar_ventanas_conceptos("4");	
	
	//cerrar profesiones
	abrir_cerrar_ventanas_profesiones("2");
	abrir_cerrar_ventanas_profesiones("4");	
	
	//cerrar nacionalidades
	abrir_cerrar_ventanas_nacionalidades("2");
	abrir_cerrar_ventanas_nacionalidades("4");	
	
	//cerrar estadosciviles
	abrir_cerrar_ventanas_estadosciviles("2");
	abrir_cerrar_ventanas_estadosciviles("4");	
	
	//cerrar tipospersonas
	abrir_cerrar_ventanas_tipospersonas("2");
	abrir_cerrar_ventanas_tipospersonas("4");	
	
	//cerrar datos personales
	abrir_cerrar_ventanas_datospersonales("2");
	abrir_cerrar_ventanas_datospersonales("4");		
	
	//cerrar usuarios
	abrir_cerrar_ventanas_usuarios("2");
	abrir_cerrar_ventanas_usuarios("4");	
	
	//cerrar utilidades
	abrir_cerrar_ventanas_utilidades("2");
	abrir_cerrar_ventanas_utilidades("4");	
	
	//cerrar utilidades
	abrir_cerrar_ventanas_ajustesfactura("2");
	abrir_cerrar_ventanas_ajustesfactura("4");		
	
	//cerrar utilidades
	abrir_cerrar_ventanas_ajustesinteres("2");
	abrir_cerrar_ventanas_ajustesinteres("4");
	//cerrar utilidades
	abrir_cerrar_ventanas_aperturacaja("2");
	abrir_cerrar_ventanas_aperturacaja("4");

	//cerrar utilidades
	abrir_cerrar_ventanas_caja("2");
	abrir_cerrar_ventanas_caja("4");
	
	//cerrar utilidades
	abrir_cerrar_ventanas_datoscaja("2");
	abrir_cerrar_ventanas_datoscaja("4");	
	
	//cerrar cuoteros
	abrir_cerrar_ventanas_cuoteros("2");
	abrir_cerrar_ventanas_cuoteros("4");	
	
//cerrar cuoteros
	abrir_cerrar_ventanas_otrosingresos("2");
	abrir_cerrar_ventanas_otrosengresos("2");
	
	//cerrar solicitudescredito
	abrir_cerrar_ventanas_solicitudescredito("2");
	abrir_cerrar_ventanas_solicitudescredito_analisis("2");
	abrir_cerrar_ventanas_solicitudes_pendientes("2");
	abrir_cerrar_ventanas_mis_solicitudes("2");
	abrir_cerrar_ventanas_creditos("2");
	abrir_cerrar_ventanas_desembolso("2");
	abrir_cerrar_ventanas_pagoscuotasclientes("2");
	abrir_cerrar_ventanas_solicitudescredito("4");	

	
	//cerrar ubicaciones
	abrir_cerrar_ventanas_ubicaciones("2");
	abrir_cerrar_ventanas_vistautilidades("2");
	abrir_cerrar_ventanas_vistacobradores("2");
	abrir_cerrar_ventanas_vistaclientes("2");
	abrir_cerrar_ventanas_vistaconceptos("2");
	abrir_cerrar_ventanas_historialpago_cuotas_clientes("2");
	abrir_cerrar_ventanas_historial_otrosingresos("2");
	abrir_cerrar_ventanas_historial_otrosegresos("2");
	abrir_cerrar_ventanas_detalles_historialpago_cuotas_clientes("2");
	//empresas y proveedores
    
	abrir_cerrar_ventanas_proveedores("2");

	abrir_cerrar_ventanas_compras("2");
	abrir_cerrar_ventanas_pagos_a_proveedores("2");
	abrir_cerrar_ventanas_cuotasproveedores("2");
	abrir_cerrar_ventanas_pagoscuotasproveedores("2");
	abrir_cerrar_ventanas_pagoscontadosproveedores("2");
	abrir_cerrar_ventanas_historial_pagos_a_proveedores("2");
	abrir_cerrar_ventanas_ingresocuotas_proveedores("2");
	abrir_cerrar_ventanas_pagos_a_contado_proveedores("2");
	abrir_cerrar_ventanas_historial_detalles_compras_proveedores("2");
	abrir_cerrar_ventanas_historialpago_cuotas_proveedores("2");
	abrir_cerrar_ventanas_planilladecaja("2");
	abrir_cerrar_ventanas_cierrecaja("2");
	abrir_cerrar_ventanas_auditoriadeotrosingresos("2");
	abrir_cerrar_ventanas_auditoriadeotrosegresos("2");
	abrir_cerrar_ventanas_auditoriadecompras("2");
	abrir_cerrar_ventanas_auditoriadepagos("2");
	abrir_cerrar_ventanas_auditoriadedesembolsos("2");
	abrir_cerrar_ventanas_auditoriadeingreso_egreso("2");
	abrir_cerrar_ventanas_web_pagoexpress("2");
}

function abrir_cerrar_ventanas_web_pagoexpress(d){
	if(d=="1"){
		controlcerrrarventana();
	   
		var myElemento=document.getElementById('abm_web_pagoexpress');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_web_pagoexpress').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_historial_pago_express("1","0","");
      
    
	} 
	if(d=="2"){
		document.getElementById('abm_web_pagoexpress').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		//buscarmisdatos();
	}

}

function abrir_cerrar_ventanas_auditoriadeingreso_egreso(d){
	if(d=="1"){
		controlcerrrarventana();
	    buscar_proveedores_combo();
		var myElemento=document.getElementById('abm_auditoriadeingreso_egreso');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_auditoriadeingreso_egreso').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_caja_combo();
		buscar_conceptos_combo();
        //buscar_auditoria_de_ingreso_egreso();
		//buscar_datos_cierrecaja(estado_cierrecaja);	
    
	} 
	if(d=="2"){
		document.getElementById('abm_auditoriadeingreso_egreso').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		//buscarmisdatos();
	}

}

function abrir_cerrar_ventanas_auditoriadedesembolsos(d){
	if(d=="1"){
		controlcerrrarventana();
	    buscar_proveedores_combo();
		var myElemento=document.getElementById('abm_auditoriadedesembolsos');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_auditoriadedesembolsos').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_caja_combo();
        buscar_auditoria_de_desembolsos();
		//buscar_datos_cierrecaja(estado_cierrecaja);	
    
	} 
	if(d=="2"){
		document.getElementById('abm_auditoriadedesembolsos').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		//buscarmisdatos();
	}

}

function abrir_cerrar_ventanas_auditoriadecobranzas(d){
	if(d=="1"){
		controlcerrrarventana();
	    //buscar_proveedores_combo();
		var myElemento=document.getElementById('abm_auditoriadecobranzas');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_auditoriadecobranzas').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_caja_combo();
		buscar_datos_cobradores_auditoria();
		buscar_datos_usuarios_auditoria();
		buscar_auditoria_de_cobranzas();
		//buscar_datos_cierrecaja(estado_cierrecaja);	
    
	} 
	if(d=="2"){
		document.getElementById('abm_auditoriadecobranzas').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		//buscarmisdatos();
	}

}

function abrir_cerrar_ventanas_auditoriadepagos(d){
	if(d=="1"){
		controlcerrrarventana();
	    //buscar_proveedores_combo();
		var myElemento=document.getElementById('abm_auditoriadepagos');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_auditoriadepagos').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_caja_combo();
		buscar_auditoria_de_pagos_proveedores();
		//buscar_datos_cierrecaja(estado_cierrecaja);	
    
	} 
	if(d=="2"){
		document.getElementById('abm_auditoriadepagos').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		//buscarmisdatos();
	}

}
function abrir_cerrar_ventanas_auditoriadeotrosingresos(d){
	if(d=="1"){
		controlcerrrarventana();
	    buscar_proveedores_combo();
		var myElemento=document.getElementById('abm_auditoriadeotrosingresos');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_auditoriadeotrosingresos').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_caja_combo();
		buscar_auditoria_de_otros_ingresos();
		//buscar_datos_cierrecaja(estado_cierrecaja);	
    
	} 
	if(d=="2"){
		document.getElementById('abm_auditoriadeotrosingresos').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		//buscarmisdatos();
	}

}

function abrir_cerrar_ventanas_auditoriadeotrosegresos(d){
	if(d=="1"){
		controlcerrrarventana();
	    buscar_proveedores_combo();
		var myElemento=document.getElementById('abm_auditoriadeotrosegresos');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_auditoriadeotrosegresos').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_caja_combo();
buscar_auditoria_de_otros_egresos();
		//buscar_datos_cierrecaja(estado_cierrecaja);	
    
	} 
	if(d=="2"){
		document.getElementById('abm_auditoriadeotrosegresos').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		//buscarmisdatos();
	}

}


function abrir_cerrar_ventanas_auditoriadecompras(d){
	if(d=="1"){
		controlcerrrarventana();
	    buscar_proveedores_combo();
		
		var myElemento=document.getElementById('abm_auditoriadecompras');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_auditoriadecompras').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_caja_actual();
		//buscar_datos_cierrecaja(estado_cierrecaja);	
    
	} 
	if(d=="2"){
		document.getElementById('abm_auditoriadecompras').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		//buscarmisdatos();
	}

}

function abrir_cerrar_ventanas_cierrecaja(d){
	if(d=="1"){
		
		controlcerrrarventana();
	     
		var caja=document.getElementById('usuario_idcaja').innerHTML;
		if(caja==""){
			ver_cerrar_ventana_cargando("2","FALTA HACER APERTURA DE CAJA");
		}else{
		var myElemento=document.getElementById('abm_cierrecaja');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_cierrecaja').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_caja_actual();
		//buscar_datos_cierrecaja(estado_cierrecaja);	
        }
	} 
	if(d=="2"){
		document.getElementById('abm_cierrecaja').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		buscarmisdatos();
	}

}



function abrir_cerrar_ventanas_planilladecaja(d){
	if(d=="1"){
  controlcerrrarventana(); obtener_sucurales_usuarios();
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
  
       document.getElementById('inp_fecha_planilla_caja').value=ano+"-"+mes+"-"+dia
	    var myElemento=document.getElementById('abm_planilladecaja');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_planilladecaja').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_lote_combo();
		//buscar_historial_cobro_cuotas_cliente();
	} 
	if(d=="2"){
		document.getElementById('abm_planilladecaja').style.display='none';
        
	}
}

function abrir_cerrar_ventanas_historialpago_cuotas_proveedores(d){
	if(d=="1"){
	    var myElemento=document.getElementById('abm_historialpago_cuotas_proveedores');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_historialpago_cuotas_proveedores').style.display='';
		document.getElementById('inp_nrofactura_cobros_p').value=document.getElementById('inp_nrofactura_cobros_p').value;
		document.getElementById('inp_proveedor_cedula_hcobros_p').value=document.getElementById('inp_proveedores_ruc_cobros_p').value
		document.getElementById('inp_proveedor_nombres_hcobros_p').value=document.getElementById('inp_proveedores_nombres_cobros_p').value
		//buscar_historial_cobro_cuotas_cliente();
	} 
	if(d=="2"){
		document.getElementById('abm_historialpago_cuotas_proveedores').style.display='none';
        
	}
}


function abrir_cerrar_ventanas_pagoscontadosproveedores(d,cod){
	if(d=="1"){
  
   //controlcerrrarventana();
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
        document.getElementById('inp_fecha_pccobros_proveedores').value=ano+"-"+mes+"-"+dia
		document.getElementById('abm_pagoscontadosproveedores').style.display='';
		buscar_compras_contados_pagos_a_proveedores(cod);
		}
		if(d=="2"){
		document.getElementById('abm_pagoscontadosproveedores').style.display='none';
	}
	
	
		}


function abrir_cerrar_ventanas_historial_detalles_compras_proveedores(d,cod){
	if(d=="1"){
   //controlcerrrarventana();
         var myElemento=document.getElementById('abm_historial_detalles_compras_proveedores');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_historial_detalles_compras_proveedores').style.display='';
		buscar_detalles_historial_detallescompras_insumos(cod);
		}
		if(d=="2"){
		document.getElementById('abm_historial_detalles_compras_proveedores').style.display='none';
	}
	
	
		}


function abrir_cerrar_ventanas_pagoscuotasproveedores(d){
	if(d=="1"){
	
		  //controlcerrrarventana();
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
        document.getElementById('inp_fecha_pcobros_proveedores').value=ano+"-"+mes+"-"+dia
		document.getElementById('abm_pagoscuotasproveedores').style.display='';
		document.getElementById('inp_cantcuotas_pcobros_proveedores').value="";
        document.getElementById('cnt_listado_pagoscuotasproveedores').innerHTML = "";
		document.getElementById('inp_cantcuotas_pcobros_proveedores').focus();
		}
		if(d=="2"){
		document.getElementById('abm_pagoscuotasproveedores').style.display='none';
	}
	
	
		}

function abrir_cerrar_ventanas_ingresocuotas_proveedores(d){
	if(d=="1"){
	var myElemento=document.getElementById('abm_ingresocuotas_proveedores');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_ingresocuotas_proveedores').style.display=''
		document.getElementById('inp_total_ingresocuotas_proveedores').value=document.getElementById('inp_total_compras').value
	} 
	if(d=="2"){
		document.getElementById('abm_ingresocuotas_proveedores').style.display='none';
	}
}
function abrir_cerrar_ventanas_cuotasproveedores(d,compras_cod){
	if(d=="1"){
	var myElemento=document.getElementById('abm_cuotasproveedores');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_cuotasproveedores').style.display='';
		buscar_datos_historial_pagos_a_proveedores(compras_cod);
	} 
	if(d=="2"){
		document.getElementById('abm_cuotasproveedores').style.display='none';
	}
}

function abrir_cerrar_ventanas_historial_pagos_a_proveedores(d){
	if(d=="1"){
	var myElemento=document.getElementById('abm_pagos_a_historial_proveedores');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_pagos_a_historial_proveedores').style.display='';
		buscar_datos_historial_compras_a_proveedores();
	} 
	if(d=="2"){
		document.getElementById('abm_pagos_a_historial_proveedores').style.display='none';
	}
}

function abrir_cerrar_ventanas_pagos_a_proveedores(d){
	if(d=="1"){
		controlcerrrarventana();
		var myElemento=document.getElementById('abm_pagos_a_proveedores');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_pagos_a_proveedores').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_pagos_a_proveedores();
		
	} 
	if(d=="2"){
		document.getElementById('abm_pagos_a_proveedores').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	
}
function abrir_cerrar_ventanas_pagos_a_contado_proveedores(d){
	if(d=="1"){
		controlcerrrarventana();
		var myElemento=document.getElementById('abm_pagos_a_contado_proveedores');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_pagos_a_contado_proveedores').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_pagos_a_contado_proveedores();
		
	} 
	if(d=="2"){
		document.getElementById('abm_pagos_a_contado_proveedores').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	
}

function abrir_cerrar_ventanas_compras(d){
	if(d=="1"){
		controlcerrrarventana();
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
  document.getElementById('inp_fecha_comprasinsumos').value=ano+"-"+mes+"-"+dia;
obtenernro_recibo();
		var myElemento=document.getElementById('abm_compras');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_compras').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_utilidades(estado_utilidades);	
	} 
	if(d=="2"){
		document.getElementById('abm_compras').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
}


//vistas proveedores
function abrir_cerrar_ventanas_vistaproveedores(d){
	if(d=="1"){
	   document.getElementById('abm_vistaproveedores').style.display='';
	   controlseleccion_proveedores="vista";
	   buscar_datos_proveedores(estado_proveedores);
	} 
	
	if(d=="2"){
		document.getElementById('abm_vistaproveedores').style.display='none';	
	}
	
}

function abrir_cerrar_ventanas_nuevoproveedores(d){
	if(d=="1"){
	   document.getElementById('abm_nuevoproveedor').style.display='';
	   controlseleccion_barrios="vista_proveedores_nuevo";
	   controlseleccion_proveedores="vista";
	   buscar_datos_proveedores(estado_proveedores);
	} 
	
	if(d=="2"){
		document.getElementById('abm_nuevoproveedor').style.display='none';	
	}
	
	
}

function abrir_cerrar_ventanas_proveedores(d){
	if(d=="1"){
		
		controlcerrrarventana();
		var myElemento=document.getElementById('abm_proveedores');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_proveedores').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_proveedores(estado_proveedores);	
	} 
	if(d=="2"){
		document.getElementById('abm_proveedores').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_proveedores').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_proveedores').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_proveedores').style.display='none';
	}
	if(d=="7"){
		var idproveedores=document.getElementById('inp_idproveedores').value
		if(idproveedores==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"31");
	} 
}

function abrir_cerrar_ventanas_otrosingresos(d){
	if(d=="1"){
		controlcerrrarventana();
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
  document.getElementById('inp_fecha_oi').value=ano+"-"+mes+"-"+dia;
obtenernro_recibo();
		var myElemento=document.getElementById('abm_otrosingresos');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_otrosingresos').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_utilidades(estado_utilidades);	
	} 
	if(d=="2"){
		document.getElementById('abm_otrosingresos').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
}

function abrir_cerrar_ventanas_otrosengresos(d){
	if(d=="1"){
		controlcerrrarventana();
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
  document.getElementById('inp_fecha_oe').value=ano+"-"+mes+"-"+dia;
        obtenernro_recibo();
		var myElemento=document.getElementById('abm_otrosengresos');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_otrosengresos').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_utilidades(estado_utilidades);	
	} 
	if(d=="2"){
		document.getElementById('abm_otrosengresos').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
}

function abrir_cerrar_ventanas_historial_otrosingresos(d){
	if(d=="1"){
	    var myElemento=document.getElementById('abm_historial_otrosingresos');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_historial_otrosingresos').style.display='';
		buscar_datos_otrosingresos();
	} 
	if(d=="2"){
		document.getElementById('abm_historial_otrosingresos').style.display='none';
        
	}
}
function abrir_cerrar_ventanas_historial_otrosegresos(d){
	if(d=="1"){
	    var myElemento=document.getElementById('abm_historial_otrosegresos');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_historial_otrosegresos').style.display='';
		buscar_datos_otrosegresos();
	} 
	if(d=="2"){
		document.getElementById('abm_historial_otrosegresos').style.display='none';
        
	}
}

function abrir_cerrar_ventanas_historialpago_cuotas_clientes(d){
	if(d=="1"){
	    var myElemento=document.getElementById('abm_historialpago_cuotas_clientes');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_historialpago_cuotas_clientes').style.display='';
		document.getElementById('inp_nrofactura_hcobros_c').value=document.getElementById('inp_nrofactura_cobros_c').value;
		document.getElementById('inp_clientes_cedula_hcobros_c').value=document.getElementById('inp_clientes_cedula_cobros_c').value;
		document.getElementById('inp_clientes_nombres_hcobros_c').value=document.getElementById('inp_clientes_nombres_cobros_c').value;
		buscar_historial_cobro_cuotas_cliente();
	} 
	if(d=="2"){
		document.getElementById('abm_historialpago_cuotas_clientes').style.display='none';
        
	}
}

function abrir_cerrar_ventanas_detalles_historialpago_cuotas_clientes(d,nrofactura,nrorecibo){
	if(d=="1"){
	    var myElemento=document.getElementById('abm_detalles_historialpago_cuotas_clientes');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_detalles_historialpago_cuotas_clientes').style.display='';
		buscar_detalles_historial_cobro_cuotas_cliente(nrofactura,nrorecibo);
	} 
	if(d=="2"){
		document.getElementById('abm_detalles_historialpago_cuotas_clientes').style.display='none';
	}
}
function abrir_cerrar_ventanas_pagoscuotasclientes(d){
	if(d=="1"){
	
		  //controlcerrrarventana();
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
  document.getElementById('inp_fecha_pcobros_c').value=ano+"-"+mes+"-"+dia
		  

		document.getElementById('abm_pagoscuotasclientes').style.display='';
		document.getElementById('inp_cantcuotas_pcobros_c').value="";
        document.getElementById('cnt_listado_pagoscuotasclientes').innerHTML = "";
                    document.getElementById('inp_cant_cuota_p').value = "";
					document.getElementById('inp_totalapagar_pcobros_c').value =  "";
					document.getElementById('inp_totalaentregar_pcobros_c').value = "";
					document.getElementById('inp_totaldescuento_pcobros_c').value =  "";
		document.getElementById('inp_cantcuotas_pcobros_c').focus();
      obtenernro_comprobante();
		}
		if(d=="2"){
		document.getElementById('abm_pagoscuotasclientes').style.display='none';
	//	document.getElementById('cnt_forms').style.display='none';
	}
	
	
		}
		
var control_obs_analista="s";
var dsss=1;
function abrir_cerrar_ventanas_obsanalista(d,observacion1,opcion){
	if(d=="1"){
		if(opcion=="1"){
        dsss=1;
		document.getElementById('retranferir_boton').innerHTML='RETRANFERIR';
		}
		if(opcion=="2"){
			document.getElementById('retranferir_boton').innerHTML='RECHAZAR';
        dsss=2;
		}
		document.getElementById('inp_obsanalista_obs').value="";
		document.getElementById('abm_obsanalista').style.display='';	
		document.getElementById('btn_rechazar_analisis').style.display='';	
	} 
	if(d=="2"){
		document.getElementById('abm_obsanalista').style.display='none';
		if(control_obs_analista=="s"){
		abrir_cerrar_ventanas_solicitudescredito_analisis("2");	
	} 
	} 
	if(d=="3"){
		var idcuoteros=document.getElementById('inp_idsolicitudescredito_analisis').value
		var obs=document.getElementById('inp_obsanalista_obs').value
		if(idcuoteros==""){
			ver_vetana_informativa("FALTA ID SOLICITUD",id_progreso);
			return;
		}
		if(obs==""){
			ver_vetana_informativa("FALTA COMPLETAR OBSERVACION",id_progreso);
			document.getElementById('inp_obsanalista_obs').focus();
			return;
		}
		if(dsss=="1"){
		 ver_vetana_eliminar("¿DESEAS RETRANFERIR ESTA SOLICITUD?",id_progreso,"18");	
		}
		if(dsss=="2"){
		ver_vetana_eliminar("¿DESEAS RECHAZAR ESTA SOLICITUD?",id_progreso,"19");	
		}	
		
		
		
		
	} 
	
	if(d=="4"){
		control_obs_analista="s";
		document.getElementById('abm_obsanalista').style.display='';
		document.getElementById('inp_obsanalista_obs').value="";
		document.getElementById('inp_obsanalista_obs').value=observacion1.replace(/\,/g," ");
		document.getElementById('retranferir_boton').style.display='none';

	}
}
function abrir_cerrar_ventanas_vistautilidades(d){
	if(d=="1"){
		document.getElementById('abm_vistautilidades').style.display='';
		buscar_datos_utilidadesvista();	
	} 
	if(d=="2"){
		document.getElementById('abm_vistautilidades').style.display='none';
		
	}
}
var control_vista_cobradores="";
function abrir_cerrar_ventanas_vistacobradores(d,z){
	 
	if(d=="1"){
     
        var myElemento=document.getElementById('abm_vistacobradores');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_vistacobradores').style.display='';
		buscar_datos_cobradoresvista();	
		control_vista_cobradores=z;
	} 
	if(d=="2"){
		document.getElementById('abm_vistacobradores').style.display='none';
		
	}
}
var control_vista_clientes="";
function abrir_cerrar_ventanas_vistaclientes(d,z){
           
	if(d=="1"){
        var myElemento=document.getElementById('abm_vistaclientes');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_vistaclientes').style.display='';
		buscar_datos_clientesvista();	
		control_vista_clientes=z;
	} 
	if(d=="2"){
		document.getElementById('abm_vistaclientes').style.display='none';
		
	}
}
var control_vista_conceptos="";
function abrir_cerrar_ventanas_vistaconceptos(d,z){
	if(d=="1"){
        var myElemento=document.getElementById('abm_vistaconceptos');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_vistaconceptos').style.display='';
		buscar_datos_conceptosvista();	
		control_vista_conceptos=z;
	} 
	if(d=="2"){
		document.getElementById('abm_vistaconceptos').style.display='none';
		
	}
    if(d=="3"){
        var myElemento=document.getElementById('abm_vistaconceptos');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_vistaconceptos').style.display='';
		buscar_datos_conceptosvista_compras();	
	///	control_vista_conceptos=z;
	}
}

function abrir_cerrar_ventanas_cuotasclientes(d,idventas){
	if(d=="1"){
	var myElemento=document.getElementById('abm_cuotasclientes');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_cuotasclientes').style.display='';
		buscar_cuotas_del_cliente(idventas);
	} 
	if(d=="2"){
		document.getElementById('abm_cuotasclientes').style.display='none';
	}
}

function abrir_cerrar_ventanas_utilidades(d){
	if(d=="1"){
		
		controlcerrrarventana();
		var myElemento=document.getElementById('abm_utilidades');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_utilidades').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_utilidades(estado_utilidades);	
	} 
	if(d=="2"){
		document.getElementById('abm_utilidades').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_utilidades').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_utilidades').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_utilidades').style.display='none';
	}
	if(d=="7"){
		var idutilidades=document.getElementById('inp_idutilidades').value
		if(idutilidades==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"22");
	} 
}

function abrir_cerrar_ventanas_ajustesfactura(d){
	if(d=="1"){
		
		controlcerrrarventana();
		var myElemento=document.getElementById('abm_ajustesfactura');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_ajustesfactura').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_ajustesfactura(estado_ajustesfactura);	
	} 
	if(d=="2"){
		document.getElementById('abm_ajustesfactura').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_ajustesfactura').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_ajustesfactura').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_ajustesfactura').style.display='none';
	}
	if(d=="7"){
		var idajustesfactura=document.getElementById('inp_idajustesfactura').value
		if(idajustesfactura==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"23");
	} 
}

function abrir_cerrar_ventanas_ajustesinteres(d){
	if(d=="1"){
		
		controlcerrrarventana();
		var myElemento=document.getElementById('abm_ajustesinteres');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_ajustesinteres').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_ajustesinteres(estado_ajustesinteres);	
	} 
	if(d=="2"){
		document.getElementById('abm_ajustesinteres').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_ajustesinteres').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_ajustesinteres').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_ajustesinteres').style.display='none';
	}
	if(d=="7"){
		var idajustesinteres=document.getElementById('inp_idajustesinteres').value
		if(idajustesinteres==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"25");
	} 
}

function abrir_cerrar_ventanas_aperturacaja(d){
	if(d=="1"){
		
		controlcerrrarventana();
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
  document.getElementById('inp_fechaapertura_ac').value=ano+"-"+mes+"-"+dia
        document.getElementById('inp_cajero_ac').value= document.getElementById('usuarios_datos').innerHTML;
		var myElemento=document.getElementById('abm_aperturacaja');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_aperturacaja').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_aperturacaja();	
      obtener_sucurales_usuarios();
	  obtener_ultimo_cierre_de_caja();
	} 
	if(d=="2"){
		document.getElementById('abm_aperturacaja').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		buscarmisdatos();
	}
	if(d=="3"){
		document.getElementById('buscador_aperturacaja').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_aperturacaja').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_aperturacaja').style.display='none';
	}
	if(d=="7"){
		var idaperturacaja=document.getElementById('inp_idaperturacaja').value
		if(idaperturacaja==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ANULAR ESTA APERTURA?",id_progreso,"26");
	} 
}


function abrir_cerrar_ventanas_caja(d){
	if(d=="1"){
		controlcerrrarventana();
		var myElemento=document.getElementById('abm_caja');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_caja').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_desembolso_caja('DESEMBOLSADO');
	} 
	if(d=="2"){
		document.getElementById('abm_caja').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_caja').style.display='';
	}
	if(d=="10"){
		controlcerrrarventana();
		var myElemento=document.getElementById('abm_caja');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_caja').style.display='';
		document.getElementById('cnt_forms').style.display='';	
		buscar_datos_desembolso_caja('IMPRIMIDO');
	} 
}

function abrir_cerrar_ventanas_datoscaja(d){
	if(d=="1"){
		
		controlcerrrarventana();
		var myElemento=document.getElementById('abm_datoscaja');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		document.getElementById('abm_datoscaja').style.display='';
		document.getElementById('cnt_forms').style.display='';
        buscarsucursales_combo();		
	    buscar_datos_datoscaja(estado_datoscaja);	
    
	} 
	if(d=="2"){
		document.getElementById('abm_datoscaja').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_datoscaja').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_datoscaja').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_datoscaja').style.display='none';
	}
	if(d=="7"){
		var iddatoscaja=document.getElementById('inp_iddatoscaja').value
		if(iddatoscaja==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR DATO?",id_progreso,"27");
	} 
}

function abrir_cerrar_ventanas_solicitudescredito_analisis(d,cod,estado){
	 var elmnt = document.getElementById("cntscroll");
  elmnt.scrollTop = 1;
	if(d=="1"){
		var myElemento=document.getElementById('abm_solicitudescredito_analisis');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		//controlcerrrarventana();
    document.getElementById('abm_solicitudescredito_analisis').style.display='';
    	vaciar_campos_analisis();
	 buscar_detalles_solicitudes(cod,"1");
	 buscar_detalles_referencias_laborales(cod,"1");
	 buscar_detalles_datos_del_negocio(cod,"1");
	 buscar_detalles_referencias_personales(cod,"1");
	 buscar_detalles_ingresos(cod,"1");
	 buscar_detalles_egresos(cod,"1");
	 buscar_detalles_fotos(cod);
	 buscar_detalles_Archivos(cod);
	 buscar_detalles_referencias_creditos_comerciales(cod,"1");
	 buscar_condiciones_credito();
	 if(estado=="PENDIENTE"){
		document.getElementById('content_opciones_analisis').style.display='';
		document.getElementById('content_opciones_analisis_retranferir').style.display='';
	 }
	 if(estado=="RETRANSFERIDO"){
		document.getElementById('content_opciones_analisis').style.display='none';
		document.getElementById('content_opciones_analisis_retranferir').style.display='none';
	 }
	 if(estado=="RECHAZADO"){
		document.getElementById('content_opciones_analisis').style.display='none';
		document.getElementById('content_opciones_analisis_retranferir').style.display='none';
	 }
	 if(estado=="APROBADO"){
	    buscar_detalles_analisis(cod);
		document.getElementById('content_opciones_analisis').style.display='none';
		document.getElementById('content_opciones_analisis_retranferir').style.display='none';
		
	 }

	document.getElementById('inp_plazoaprobado').innerHTML = "<option value =''>SELECCIONAR</option>"
	 		document.getElementById('inp_montoaprobado').innerHTML = "<option value =''>SELECCIONAR</option>"
	 			document.getElementById('inp_preciocuotaaprobado').innerHTML = "<option value =''>SELECCIONAR</option>"

	} 
	if(d=="2"){
		document.getElementById('abm_solicitudescredito_analisis').style.display='none';
	}
	if(d=="7"){
		var idsolicitudescredito=document.getElementById('inp_idsolicitudescredito_analisis').value
		if(idsolicitudescredito==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"32");
	} 
	
}

var cont_osp=true;
function abrir_cerrar_ventanas_solicitudes_pendientes(d){
	if(d=="1"){
		var myElemento=document.getElementById('abm_solicitudes_pendientes');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		controlcerrrarventana();
		document.getElementById('efe_cargando1').style.display='';
		document.getElementById('abm_solicitudes_pendientes').style.display='';
		document.getElementById('cnt_forms').style.display='';
		buscar_por_opciones_solicitudes_pendientes("1");
	}
	if(d=="2"){
		document.getElementById('abm_solicitudes_pendientes').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		document.getElementById('efe_cargando1').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_solicitudes_pendientes').style.display='';
	}
	if(d=="5"){
        if(cont_osp==true){
		document.getElementById('opciones_solicitudes_pendientes').style.display='';
         cont_osp=false;
	    }else if(cont_osp==false){
		document.getElementById('opciones_solicitudes_pendientes').style.display='none';
         cont_osp=true;
	    }
	} 
	if(d=="6"){
		document.getElementById('opciones_solicitudes_pendientes').style.display='none';
		cont_osp=true;
	} 
}

function abrir_cerrar_ventanas_creditos(d){
	if(d=="1"){
		document.getElementById('efe_cargando3').style.display='';
		controlcerrrarventana();
		var myElemento=document.getElementById('abm_creditos');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		document.getElementById('abm_creditos').style.display='';
		document.getElementById('cnt_forms').style.display='';
		buscar_datos_creditos();
	
	} 
	if(d=="2"){
			var myElemento=document.getElementById('abm_creditos');
	      
		 document.getElementById('abm_creditos').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_creditos').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_creditos').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_creditos').style.display='none';
	} 
}

function abrir_cerrar_ventanas_desembolso(d,cod,estado,nrosolicitud){
	if(d=="1"){
		if(estado=="APROBADO"){
		  //controlcerrrarventana();
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
  document.getElementById('inp_fecha_desembolso').value=ano+"-"+mes+"-"+dia
		      buscarcobrador_combo();

		document.getElementById('abm_desembolso').style.display='';
		buscar_detalles_solicitudes_desembolso(cod);
		            document.getElementById('b_desembolsar_factura').style.display='none';
                    document.getElementById('b_planprestamo').style.display='none';
	                document.getElementById('b_desembolsar_recibo').style.display='none';
	                document.getElementById('b_desembolsar').style.display='';
	                document.getElementById('cnt_listado_cuotas_prestamos').innerHTML="";
					
					  obtenernrofactura();
                      
	} 
		if(estado=="IMPRIMIDO"){
		buscarcobrador_combo();
		document.getElementById('abm_desembolso').style.display='';
		buscar_detalles_ventas_desembolso(nrosolicitud);
		buscar_datos_Cuoteros(nrosolicitud);
	                buscar_datos_creditos();
                    document.getElementById('b_desembolsar_factura').style.display='';
	                document.getElementById('b_desembolsar_recibo').style.display='';
                    document.getElementById('b_planprestamo').style.display='';
	                document.getElementById('b_desembolsar').style.display='none';
                 
		//buscar_detalles_solicitudes_desembolso(cod);
		
	    } 
		if(estado=="DESEMBOLSADO"){
		buscarcobrador_combo();
		document.getElementById('abm_desembolso').style.display='';
		buscar_detalles_ventas_desembolso(nrosolicitud);
		buscar_datos_Cuoteros(nrosolicitud);
	                buscar_datos_creditos();
                    document.getElementById('b_desembolsar_factura').style.display='';
	                document.getElementById('b_desembolsar_recibo').style.display='';
                    document.getElementById('b_planprestamo').style.display='';
	                document.getElementById('b_desembolsar').style.display='none';
                 
		//buscar_detalles_solicitudes_desembolso(cod);
		
	    } 
		
		}
		if(d=="2"){
		document.getElementById('abm_desembolso').style.display='none';
	//	document.getElementById('cnt_forms').style.display='none';
	}
	
	
		}
		
function abrir_cerrar_ventanas_mis_solicitudes(d){
	if(d=="1"){
		
		var myElemento=document.getElementById('abm_mis_solicitudes');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		controlcerrrarventana();
		document.getElementById('efe_cargando4').style.display='';
		document.getElementById('abm_mis_solicitudes').style.display='';
		document.getElementById('cnt_forms').style.display='';
		buscar_datos_mis_solicitudes();
	} 
	if(d=="2"){
		document.getElementById('abm_mis_solicitudes').style.display='none';
		document.getElementById('efe_cargando4').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
		
	}
	if(d=="3"){
		document.getElementById('buscador_mis_solicitudes').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_mis_solicitudes').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_mis_solicitudes').style.display='none';
	} 
}

function abrir_selecionar_mis_solicitudes(cod,estado){
if(estado=="BORRADOR"){
   abrir_cerrar_ventanas_solicitudescredito("1","2");
   buscar_detalles_referencias_laborales(cod,"2");
   buscar_detalles_datos_del_negocio(cod,"2");
   buscar_detalles_solicitudes(cod,"2");
   buscar_detalles_egresos(cod,"2");
   buscar_detalles_ingresos(cod,"2");
   buscar_detalles_referencias_personales(cod,"2");
   buscar_detalles_referencias_creditos_comerciales(cod,"2");
   buscar_detalles_Archivos_desembolso(cod,"2");
   buscar_detalles_Fotos_desembolso(cod,"2");
   //condicion_solicitudes=2;
   
}else
if(estado=="RETRANSFERIDO"){
   abrir_cerrar_ventanas_solicitudescredito("1","2");
   buscar_detalles_referencias_laborales(cod,"2");
   buscar_detalles_datos_del_negocio(cod,"2");
   buscar_detalles_egresos(cod,"2");
   buscar_detalles_referencias_personales(cod,"2");
   buscar_detalles_referencias_creditos_comerciales(cod,"2");
   buscar_detalles_Archivos_desembolso(cod,"2");
   buscar_detalles_Fotos_desembolso(cod,"2");
      buscar_detalles_solicitudes(cod,"2");
   buscar_detalles_ingresos(cod,"2");
   condicion_solicitudes=2;
}

}

function abrir_cerrar_ventanas_solicitudescredito(d,condicion){
	 var elmnt = document.getElementById("scroll_2");
  elmnt.scrollTop = 1;
	if(d=="1"){
		// buscar_condiciones_solicitud_1();
     
		var myElemento=document.getElementById('abm_solicitudescredito');
		myElemento.classList.remove('animate__animated','animate__backInRight','animate__faster');
		myElemento.classList.add('modalemergente','animate__animated','animate__bounceInLeft','animate__faster');
		condicion_solicitudes=1;
		//controlcerrrarventana();
		buscarvendedor_combo();
  
		document.getElementById('abm_solicitudescredito').style.display='';
		//document.getElementById('cnt_forms').style.display='';
		if(condicion=="1"){
		 ObtenerNroSolicitudes();	
		}
	
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
		
		//buscar_datos_cuoteros(estado_cuoteros);
		cerrar_abrir_opciones_detalles_negocios();
	} 
	if(d=="2"){
		document.getElementById('abm_solicitudescredito').style.display='none';
		//document.getElementById('cnt_forms').style.display='none';
		limpiar_campos_solicitudescredito();
		
	}
	if(d=="3"){
		document.getElementById('buscador_solicitudescredito').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_solicitudescredito').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_solicitudescredito').style.display='none';
	}
	if(d=="7"){
		var idsolicitudescredito=document.getElementById('inp_idsolicitudescredito').value
		if(idsolicitudescredito==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"24");
	} 
}

function abrir_cerrar_ventanas_cuoteros(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_cuoteros').style.display='';
		document.getElementById('cnt_forms').style.display='';
		buscar_datos_cuoteros(estado_cuoteros);
		
	} 
	if(d=="2"){
		document.getElementById('abm_cuoteros').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_cuoteros').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_cuoteros').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_cuoteros').style.display='none';
	}
	if(d=="7"){
		var idcuoteros=document.getElementById('inp_idcuoteros').value
		if(idcuoteros==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"16");
	} 
}


function abrir_cerrar_ventanas_usuarios(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_usuarios').style.display='';
		document.getElementById('cnt_forms').style.display='';
		buscaraccesos_combo();
		buscarsucursales_combo();
		buscar_datos_usuarios(estado_usuarios);
	
	} 
	if(d=="2"){
		document.getElementById('abm_usuarios').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_usuarios').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_usuarios').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_usuarios').style.display='none';
	}
	if(d=="7"){
		var idusuarios=document.getElementById('inp_idusuarios').value
		if(idusuarios==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"12");
	} 
}

var control_cerrar_datospersonales="1";
function abrir_cerrar_ventanas_datospersonales(d){
	if(d=="1"){
		
		controlcerrrarventana();
		document.getElementById('abm_datospersonales').style.display='';
		document.getElementById('cnt_detalles_dp').style.display='';
		document.getElementById('btn_cancelar_datospersonales').style.display='';
		document.getElementById('cnt_forms').style.display='';
		buscartipospersonas_combo();
		buscarnacionalidades_combo();
		buscarestadosciviles_combo();
		
		buscar_datos_datospersonales(estado_datospersonales);
		control_cerrar_datospersonales="1";
		
		
	} 
	if(d=="2"){
	if(control_cerrar_datospersonales=="1"){
		document.getElementById('abm_datospersonales').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(control_cerrar_datospersonales=="2"){
		document.getElementById('abm_datospersonales').style.display='none';
	}
	if(control_cerrar_datospersonales=="3"){
		document.getElementById('abm_datospersonales').style.display='none';
	}
	if(control_cerrar_datospersonales=="4"){
		document.getElementById('abm_datospersonales').style.display='none';
	}
	if(control_cerrar_datospersonales=="5"){
		document.getElementById('abm_datospersonales').style.display='none';
	}
	if(control_cerrar_datospersonales=="6"){
		document.getElementById('abm_datospersonales').style.display='none';
	}if(control_cerrar_datospersonales=="7"){
		document.getElementById('abm_datospersonales').style.display='none';
	}
	}
	if(d=="3"){
		document.getElementById('buscador_datospersonales').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_datospersonales').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_datospersonales').style.display='none';
	}
	   if(d=="7"){
		var iddatospersonales=document.getElementById('inp_iddatospersonales').value
		if(iddatospersonales==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"11");
	} 
	
	if(d=="8"){
		
		document.getElementById('abm_datospersonales').style.display='';
		document.getElementById('cnt_detalles_dp').style.display='none';
		document.getElementById('btn_cancelar_datospersonales').style.display='none';
		buscartipospersonas_combo();
		buscarnacionalidades_combo();
		buscarestadosciviles_combo();
		cerrar_abrir_opciones_conyuge();
		control_cerrar_datospersonales="2";
		//buscar_datos_datospersonales(estado_datospersonales);
		
	}
	if(d=="9"){
		
		document.getElementById('abm_datospersonales').style.display='';
		document.getElementById('cnt_detalles_dp').style.display='none';
		document.getElementById('btn_cancelar_datospersonales').style.display='none';
		buscartipospersonas_combo();
		buscarnacionalidades_combo();
		buscarestadosciviles_combo();
		cerrar_abrir_opciones_conyuge();
		control_cerrar_datospersonales="3";
		document.getElementById('inp_cedula_dp').value= document.getElementById('inp_cedula_df').value;
		//buscar_datos_datospersonales(estado_datospersonales);
		
	}
	if(d=="10"){
		
		document.getElementById('abm_datospersonales').style.display='';
		document.getElementById('cnt_detalles_dp').style.display='none';
		document.getElementById('btn_cancelar_datospersonales').style.display='none';
		buscartipospersonas_combo();
		buscarnacionalidades_combo();
		buscarestadosciviles_combo();
		cerrar_abrir_opciones_conyuge();
		control_cerrar_datospersonales="4";
		//buscar_datos_datospersonales(estado_datospersonales);
	}
	if(d=="11"){
		
		document.getElementById('abm_datospersonales').style.display='';
		document.getElementById('cnt_detalles_dp').style.display='none';
		document.getElementById('btn_cancelar_datospersonales').style.display='none';
		buscartipospersonas_combo();
		buscarnacionalidades_combo();
		buscarestadosciviles_combo();
		cerrar_abrir_opciones_conyuge();
		control_cerrar_datospersonales="5";
		//buscar_datos_datospersonales(estado_datospersonales);
	}
	if(d=="12"){
		
		cerrar_abrir_opciones_conyuge();
		document.getElementById('abm_datospersonales').style.display='';
		document.getElementById('cnt_detalles_dp').style.display='none';
		document.getElementById('btn_cancelar_datospersonales').style.display='none';
		buscartipospersonas_combo();
		buscarnacionalidades_combo();
	
		control_cerrar_datospersonales="6";
		
		
		//buscar_datos_datospersonales(estado_datospersonales);
	}
		if(d=="13"){
		document.getElementById('inp_cedula_dp').value=document.getElementById('inp_cedula_sc').value;
		document.getElementById('abm_datospersonales').style.display='';
		document.getElementById('cnt_detalles_dp').style.display='none';
		document.getElementById('btn_cancelar_datospersonales').style.display='none';
		buscartipospersonas_combo();
		buscarnacionalidades_combo();
		buscarestadosciviles_combo();
		cerrar_abrir_opciones_conyuge();
		control_cerrar_datospersonales="7";
		
		//buscar_datos_datospersonales(estado_datospersonales);
	}
	
}

function abrir_cerrar_ventanas_tipospersonas(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_tipospersonas').style.display='';
		document.getElementById('cnt_forms').style.display='';
		
		buscar_datos_tipospersonas(estado_tipospersonas);
		
	} 
	if(d=="2"){
		document.getElementById('abm_tipospersonas').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_tipospersonas').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_tipospersonas').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_tipospersonas').style.display='none';
	}
	if(d=="7"){
		var idtipospersonas=document.getElementById('inp_idtipospersonas').value
		if(idtipospersonas==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"10");
	} 
}

function abrir_cerrar_ventanas_estadosciviles(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_estadosciviles').style.display='';
		document.getElementById('cnt_forms').style.display='';
		
		buscar_datos_estadosciviles(estado_estadosciviles);
		
	} 
	if(d=="2"){
		document.getElementById('abm_estadosciviles').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_estadosciviles').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_estadosciviles').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_estadosciviles').style.display='none';
	}
	if(d=="7"){
		var idestadosciviles=document.getElementById('inp_idestadosciviles').value
		if(idestadosciviles==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"9");
	} 
}

function abrir_cerrar_ventanas_nacionalidades(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_nacionalidades').style.display='';
		document.getElementById('cnt_forms').style.display='';
		
		buscar_datos_nacionalidades(estado_nacionalidades);
		
	} 
	if(d=="2"){
		document.getElementById('abm_nacionalidades').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_nacionalidades').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_nacionalidades').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_nacionalidades').style.display='none';
	}
	if(d=="7"){
		var idnacionalidades=document.getElementById('inp_idnacionalidades').value
		if(idnacionalidades==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"8");
	} 
}

function abrir_cerrar_ventanas_profesiones(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_profesiones').style.display='';
		document.getElementById('cnt_forms').style.display='';
		controlseleccion_profesiones="abm";
		buscar_datos_profesiones(estado_profesiones);
		
	} 
	if(d=="2"){
		document.getElementById('abm_profesiones').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_profesiones').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_profesiones').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_profesiones').style.display='none';
	}
	if(d=="7"){
		var idprofesiones=document.getElementById('inp_idprofesiones').value
		if(idprofesiones==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"7");
	} 
}

function abrir_cerrar_ventanas_accesos(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_accesos').style.display='';
		document.getElementById('cnt_forms').style.display='';
		
		buscar_datos_accesos(estado_accesos);
		
	} 
	if(d=="2"){
		document.getElementById('abm_accesos').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_accesos').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_accesos').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_accesos').style.display='none';
	}
	if(d=="7"){
		var idaccesos=document.getElementById('inp_idaccesos').value
		if(idaccesos==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"6");
	} 
}

function abrir_cerrar_ventanas_conceptos(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_conceptos').style.display='';
		document.getElementById('cnt_forms').style.display='';
		
		buscar_datos_conceptos(estado_conceptos);
		
	} 
	if(d=="2"){
		document.getElementById('abm_conceptos').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_conceptos').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_conceptos').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_conceptos').style.display='none';
	}
	if(d=="7"){
		var idconceptos=document.getElementById('inp_idconceptos').value
		if(idconceptos==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"30");
	} 
}

var acciones_ventana_ubicacion="";
function abrir_cerrar_ventanas_ubicaciones(d){
	if(d=="1"){
		
		document.getElementById("map").style.width = "100%";
		document.getElementById('abm_ubicaciones').style.display='';
	    acciones_ventana_ubicacion="sucursales";
	    obtener_coodernadas("relieve");
	   
	} 
	
	if(d=="2"){
		document.getElementById('abm_ubicaciones').style.display='none';	
	}
	if(d=="3"){
		document.getElementById("map").style.width = "100%";
		document.getElementById('abm_ubicaciones').style.display='';
	    acciones_ventana_ubicacion="datospersonales";
	    obtener_coodernadas("relieve");
	   
	} 
	
}

function abrir_cerrar_ventanas_sucursales(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_sucursales').style.display='';
		document.getElementById('cnt_forms').style.display='';
		buscarBarrios_combo();
		buscar_datos_sucursales(estado_sucursales);
		 abrir_cerrar_ventanas_ubicaciones("2");
	} 
	if(d=="2"){
		document.getElementById('abm_sucursales').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_sucursales').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_sucursales').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_sucursales').style.display='none';
	}
	if(d=="7"){
		var idsucursales=document.getElementById('inp_idsucursales').value
		if(idsucursales==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"5");
	} 
}

function abrir_cerrar_ventanas_Barrios(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_Barrios').style.display='';
		document.getElementById('cnt_forms').style.display='';
		buscarCiudades_combo_combo();
		controlseleccion_barrios="abm";
		buscar_datos_Barrios(estado_Barrios);
		
	} 
	if(d=="2"){
		document.getElementById('abm_Barrios').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_Barrios').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_Barrios').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_Barrios').style.display='none';
	}
	if(d=="7"){
		var idBarrios=document.getElementById('inp_idBarrios').value
		if(idBarrios==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"4");
	} 
}

function abrir_cerrar_ventanas_Ciudades(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_Ciudades').style.display='';
		document.getElementById('cnt_forms').style.display='';
		buscarCiudades_combo();
		buscar_datos_Ciudades(tipoestado_departamento);
	} 
	if(d=="2"){
		document.getElementById('abm_Ciudades').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_Ciudades').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_Ciudades').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_Ciudades').style.display='none';
	}
	if(d=="7"){
		var idCiudades=document.getElementById('inp_idCiudades').value
		if(idCiudades==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"3");
	} 
}

function abrir_cerrar_ventanas_departamentos(d){
	if(d=="1"){
		controlcerrrarventana();
		document.getElementById('abm_departamentos').style.display='';
		document.getElementById('cnt_forms').style.display='';
		buscarDepartametos_combo();
		buscar_datos_departamentos(tipoestado_departamento);
	} 
	if(d=="2"){
		document.getElementById('abm_departamentos').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_departamentos').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_departamentos').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_departamentos').style.display='none';
	}
	if(d=="7"){
		var iddepartamentos=document.getElementById('inp_iddepartamentos').value
		if(iddepartamentos==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"2");
	} 
}

function abrir_cerrar_ventanas_regiones(d){
	if(d=="1"){
	controlcerrrarventana();
		document.getElementById('abm_regiones').style.display='';
		document.getElementById('cnt_forms').style.display='';
		buscar_datos_regiones(tipoestado);
		
	} 
	if(d=="2"){
		document.getElementById('abm_regiones').style.display='none';
		document.getElementById('cnt_forms').style.display='none';
	}
	if(d=="3"){
		document.getElementById('buscador_regiones').style.display='';
		
	} 
	
	if(d=="5"){
		document.getElementById('opciones_regiones').style.display='';
	} 
	if(d=="6"){
		document.getElementById('opciones_regiones').style.display='none';
	}
	if(d=="7"){
		var idregiones=document.getElementById('inp_idregiones').value
		if(idregiones==""){
			ver_vetana_informativa("FALTA SELECCIONAR EL DATO",id_progreso);
			return;
		}
		ver_vetana_eliminar("¿DESEAS ELIMINAR ESTE DATO?",id_progreso,"1");
	} 
}
var cont_cc=true;
function abrir_cerrar_opciones_login(d,opcion){
	
       if(d=="1"){
		if(cont_cc==true){
		document.getElementById('opciones_login').style.display='';
         cont_cc=false;
	    }else 
       if(cont_cc==false){
		document.getElementById('opciones_login').style.display='none';
         cont_cc=true;
	    } 
        } 
	if(d=="2"){
		if(opcion=="1"){
			//cerrar sesion
          cerrarSesion();
		}
		if(opcion=="2"){
        document.getElementById('opciones_login').style.display='none';
         cont_cc=true;
		}
		if(opcion=="3"){
			$('head').append('<link rel="stylesheet" href="./css/iniciooscuro.css" type="text/css" />');
		}
		if(opcion=="4"){
			$('head').append('<link rel="stylesheet" href="./css/inicio.css" type="text/css" />');
		}
	
    }
}

//vistas barrios
function abrir_cerrar_ventanas_vistabarrios(d){
	if(d=="1"){
	   document.getElementById('abm_vistabarrios').style.display='';
	   controlseleccion_barrios="vista";
	   buscar_datos_Barrios(estado_Barrios);
	} 
	
	if(d=="2"){
		document.getElementById('abm_vistabarrios').style.display='none';	
	}
	if(d=="3"){
	   document.getElementById('abm_vistabarrios').style.display='';
	   controlseleccion_barrios="vista_proveedores";
	   buscar_datos_Barrios(estado_Barrios);
	} 
	if(d=="4"){
	   document.getElementById('abm_vistabarrios').style.display='';
	   controlseleccion_barrios="vista_proveedores_nuevo";
	   buscar_datos_Barrios(estado_Barrios);
	} 
}

function abrir_cerrar_ventanas_nuevobarrios(d){
	if(d=="1"){
	   document.getElementById('abm_nuevobarrios').style.display='';
	   buscarCiudades_combo_combo();
	   controlseleccion_barrios="vista";
	   buscar_datos_Barrios(estado_Barrios);
	} 
	
	if(d=="2"){
		document.getElementById('abm_nuevobarrios').style.display='none';	
	}
	if(d=="3"){
	   document.getElementById('abm_nuevobarrios').style.display='';
	   buscarCiudades_combo_combo();
	   controlseleccion_barrios="vista_proveedores";
	   buscar_datos_Barrios(estado_Barrios);
	} 
	if(d=="4"){
	   document.getElementById('abm_nuevobarrios').style.display='';
	   buscarCiudades_combo_combo();
	   controlseleccion_barrios="vista_proveedores_nuevo";
	   buscar_datos_Barrios(estado_Barrios);
	} 
	
}

//vistas profesiones

function abrir_cerrar_ventanas_vistaprofesiones(d){
	if(d=="1"){
	   document.getElementById('abm_vistaprofesiones').style.display='';
	   controlseleccion_profesiones="vista";
	   buscar_datos_profesiones(estado_profesiones);
	} 
	
	if(d=="2"){
		document.getElementById('abm_vistaprofesiones').style.display='none';	
	}
	
}

function abrir_cerrar_ventanas_nuevoprofesiones(d){
	if(d=="1"){
	   document.getElementById('abm_nuevoprofesiones').style.display='';
	   controlseleccion_profesiones="vista";
	   buscar_datos_profesiones(estado_profesiones);
	} 
	
	if(d=="2"){
		document.getElementById('abm_nuevoprofesiones').style.display='none';	
	}
}

function abrir_cerrar_ventanas_nuevoaccesos(d){
	if(d=="1"){
	   document.getElementById('abm_nuevoaccesos').style.display='';
	   controlseleccion_accesos="vista";
	   buscar_datos_accesos(estado_accesos);
	} 
	if(d=="2"){
		document.getElementById('abm_nuevoaccesos').style.display='none';	
	}
}

//vistas profesiones
function abrir_cerrar_ventanas_nuevonacionalidades(d){
	if(d=="1"){
	   document.getElementById('abm_nuevonacionalidades').style.display='';
	} 
	
	if(d=="2"){
		document.getElementById('abm_nuevonacionalidades').style.display='none';
       	buscarnacionalidades_combo();	
	}
}

 	/*EMERGENTE ELIMINAR ACCION */
/*function eliminar_de_la_lista(c){
	if(c=="1"){
		var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_regiones(elememnto_eliminar);
		
	} 
	if(c=="2"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_departamentos(elememnto_eliminar);
		
	} 
	
	if(c=="3"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_Ciudades(elememnto_eliminar);
	} 
    if(c=="4"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_Barrios(elememnto_eliminar);
	} 
	if(c=="5"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_sucursales(elememnto_eliminar);
	} 
	if(c=="6"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_accesos(elememnto_eliminar);
	} 
	if(c=="7"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_profesiones(elememnto_eliminar);
	} 
 
	if(c=="8"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_nacionalidades(elememnto_eliminar);
	} 
	
	if(c=="9"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_estadosciviles(elememnto_eliminar);
	} 
	
	if(c=="10"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_tipospersonas(elememnto_eliminar);
	} 
    if(c=="11"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_datospersonales(elememnto_eliminar);
	} 
   if(c=="12"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_usuarios(elememnto_eliminar);
	} 
	if(c=="13"){
	  abrir_cerrar_ventanas_datospersonales("9");	  
	} 
	if(c=="14"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_clientes(elememnto_eliminar);
	}
	if(c=="15"){
	abrir_cerrar_ventanas_datospersonales("11");
	} 
	if(c=="16"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_cuoteros(elememnto_eliminar);
	}
	if(c=="17"){
	abrir_cerrar_ventanas_datospersonales("13");
	}
	if(c=="18"){
	 retranferirSolicitud();
	}
	if(c=="19"){
	 rechazarSolicitud();
	}
	if(c=="20"){
	
		titulo_guardado_solicitud="BORRADOR";
		var cod = document.getElementById('inp_idsolicitudescredito').value
		if(cod==""){
		 
		add_datos_solicitudescredito("BORRADOR","guardar","1");	
		}else{
		   
		add_datos_solicitudescredito_a_borrador();	
		}
	}
	
	if(c=="21"){

	add_datos_solicitudescredito_a_analisis();
	titulo_guardado_solicitud="SOLICITUD";
	}
		if(c=="22"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_utilidades(elememnto_eliminar);
	}
		
if(c=="23"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_ajustesfactura(elememnto_eliminar);
	}
 if(c=="24"){
	eliminarestasolicitud();
	}
	if(c=="25"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_ajustesinteres(elememnto_eliminar);
	}
	if(c=="26"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_aperturacaja(elememnto_eliminar);
	}
	if(c=="27"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_datoscaja(elememnto_eliminar);
	}
	if(c=="28"){
	 obtener_monto_en_caja();
	}
	if(c=="29"){
   
	 abrir_cerrar_ventanas_aperturacaja("1");
	}
	if(c=="30"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_conceptos(elememnto_eliminar);
	}
} */

function b64EncodeUnicode(str) {
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function(match, p1) {
        return String.fromCharCode('0x' + p1);
    }));
}

function b64_to_utf8( str ) {
  return decodeURIComponent(escape(window.atob( str )));
}

	 var id_progreso="_mensaje";
function cerrar_esta_ventanas(datos){
	$(datos).remove();
	var control='off'
		 $("div[name=ventanas_infos]").each(function(i, historial_publicacion){		
		 control='on'
		});
		if(control=='off') {
			document.getElementById('capa_informativa').style.display='none'
			document.getElementById('capa_informativa').innerHTML="";
		}
}


function ver_vetana_informativa(titulo,id_c){
	
		var pagina_informativa="<center>\
		<div class='cont_emergente_alert_largo'>\
		<div id='barra_de_progreso_"+id_c+"' name='tarea_en_progreso' class='cont_emergente_alert' >\
		<div class='table_emergente_alert' id='"+id_c+"' onclick='cerrar_esta_ventanas(this)' >\
		\
		<div style=' width:90%; margin-left: auto; margin-right: auto;'>\
        <div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>\
        <label   class='input_TEXT'>INFORMACION<label/>\
        </div>\
        </div>\
		\
		<div style=' width:90%; margin-left: auto; margin-right: auto;'>\
        <div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>\
       	<textarea style='height:60px;' type='text'  class='input_progress' placeholder=''  id='titulo_"+id_c+"'>"+titulo+"</textarea></div></div><div style=' width:90%; margin-left: auto; margin-right: auto;margin-top: 1%;'>\
        <div class='input_ok' value=''style='float:right;height:30px;width:35px;' onclick='cerrar_esta_ventanas(this)' id='btn_guardar_regiones'>OK</div>\
         </div>\
         \
        </div>\
        </div>\
		</div>\
		</center>"
			
	
	document.getElementById('capa_informativa').innerHTML=pagina_informativa
	document.getElementById('capa_informativa').style.display=''
}

function ver_vetana_eliminar(titulo,id_c,b){
	
		var pagina_informativa="<center>"+
		"<div class='cont_emergente_alert_largo'>"+
		"<div id='barra_de_progreso_"+id_c+"' name='tarea_en_progreso' class='cont_emergente_alert' >"+
		"<div class='table_emergente_alert' id='"+id_c+"' >"+
		"<div style=' width:90%; margin-left: auto; margin-right: auto;'>"+
        "<div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>"+
        "<label   class='input_TEXT'>OPCION<label/>"+
        "</div>"+
        "</div>"+
		"<div style=' width:90%; margin-left: auto; margin-right: auto;'>"+
        "<div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>"+
        "<input id='titulo_"+id_c+"' type='button' class='input_progress'   value='"+titulo+"' />"+
		"</div>"+
		"</div>"+
		"<div style=' width:90%; margin-left: auto; margin-right: auto;margin-top: 1%;'>"+
		"<div class='input_ok'  style='float:right;height:30px;width:35px;' onclick='eliminar_de_la_lista("+b+");' id='btn_eliminar_1'><p style='display:none;' id='accion_eliminar'>eliminar</p>OK</div>"+
		"<div class='input_cancel' style='float:right;height:30px;width:75px;' onclick='cerrar_esta_ventanas_eliminar(this)'>CANCELAR</div>"+
		 "</div>"+
        "</div>"+
        "</div>"+
		"</div>"+
		"</center>";
			
	
	document.getElementById('capa_informativa').innerHTML=pagina_informativa
	document.getElementById('capa_informativa').style.display=''
}

function cerrar_esta_ventanas_eliminar(datos){
	$(datos).remove();
	var control='off'
		 $("div[name=ventanas_infos]").each(function(i, historial_publicacion){		
		 control='on'
		});
		if(control=='off') {
			document.getElementById('capa_informativa').style.display='none'
			document.getElementById('capa_informativa').innerHTML="";
		}
}

 var imgCargandoA="<img src='./icono/cargando.gif' style='width:30px' />"
	 
	 function ver_cerrar_ventana_cargando(d,titulo){
	 if(d=="1"){
		document.getElementById('div_cargando_info').innerHTML=imgCargandoA
		document.getElementById('lbltitulomensaje_b').innerHTML="CARGANDO..."
		document.getElementById('div_principal_info_carga').style.display=''
	}
   if(d=="2"){
		document.getElementById('div_principal_info_carga').style.display='none';
		 ver_vetana_informativa(titulo, id_progreso);
	}
     if(d=="3"){
		document.getElementById('div_principal_info_carga').style.display='none';
	}
    }

var controlinputfile="";
function exploradorImagen(datos){
	$("input[name=file_1]").click();
	controlinputfile=datos;
}

var foto="";
var ext="";

var foto1="";
var ext1="";


function readFile(input){
	var file=$("input[name="+input.name+"]")[0].files[0];
	var filename=file.name;
	  
	var tamanho=file.size;
	if(tamanho>9000000){
		ver_vetana_informativa("LA FOTO NO PUEDE EXCEDER LOS 5MB",id_progreso);
		return false;
	}
	file_extencion=filename.substring(filename.lastIndexOf('.')+1).toLowerCase();
	if(file_extencion=="jpeg" || file_extencion=="jpg" || file_extencion=="png"){
	}else{
		ver_vetana_informativa("FORMATO DE ARCHIVO INVALIDO SOLO ADMITE JPEG/JPG/PNG",id_progreso);
		return false;
	}
	var reader=new FileReader();
	reader.onload=function(e){
	
	if(controlinputfile=="1"){
		ext=file_extencion;
	    foto=e.target.result;
		//console.log(foto);
		$("div[id=cont_photo1]").css({"background-image":"url("+foto+")"})
	}
	// if(controlinputfile=="2"){
		// ext1=file_extencion;
	    // foto1=e.target.result;
		// $("div[id=cont_photo2]").css({"background-image":"url("+foto1+")"})
	// }
	
	//document.getElementById('cont_photo').style.backgroundImage =e.target.result;
	}
	reader.readAsDataURL(input.files[0]);
}

var placenames="";
var estilomapa="";
var cor_lat='-56.4785247';
var cor_lng='-25.78106';
 var cor_lat1='-25.78106';
 var cor_lng1='-56.4785247';

function obtener_coodernadas(estilo){
      var inp_ubicacion=document.getElementById('inp_lnglat_dp').value;
if(inp_ubicacion!=""){
var lat_limpio=inp_ubicacion.split(",");
cor_lat=lat_limpio[0]
cor_lng=lat_limpio[1]
cor_lng1=lat_limpio[1]
cor_lat1=lat_limpio[0]


}else{
 cor_lat='-56.4785247';
 cor_lng='-25.78106';
 cor_lat1='-25.78106';
 cor_lng1='-56.4785247';
}

	if(estilo=="satelital"){
		estilomapa="mapbox://styles/mapbox/satellite-streets-v11";
	}
	if(estilo=="relieve"){
		estilomapa="mapbox://styles/mapbox/streets-v11";
	}
	mapboxgl.accessToken = 'pk.eyJ1IjoiZ3VpbGxlcm1vOTk1IiwiYSI6ImNrYjg1OTdsbzAweDczMnBocHU1anA5NXUifQ.xa-q2v4CVLR0a-2nUcbmFw';
var map = new mapboxgl.Map({
    container: 'map',
    style: estilomapa,
    center: [cor_lng1,cor_lat1],
   	minZoom: 10,
   zoom: 12
});
document.getElementById('abm_ubicaciones').style.display=''
var geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
    marker: {
        color: 'orange'
	
    },
    mapboxgl: mapboxgl
});
map.addControl(geocoder);
map.addControl(new mapboxgl.NavigationControl());




/* var geolocate = new mapboxgl.GeolocateControl({
 positionOptions: {
   enableHighAccuracy: true
 },
 trackUserLocation: true
}); */


//map.addControl(geolocate);
/* geolocate.on('geolocate', function(e) {
   placenames=e.coords.longitude+","+e.coords.latitude;
	
});
  */



map.on('load', function() {
 //geolocate.trigger(); 


  map.addSource('single-point', {
    type: 'geojson',
    data: {
      type: 'FeatureCollection',
      features: []
    }
  });
  document.getElementById("map").style.width = "100%";
  map.addLayer({
    id: 'point',
    source: 'single-point',
    type: 'circle',
    paint: {
      'circle-radius': 10,
      'circle-color': '#448ee4'
    }
  });



   geocoder.on('result', function(e) {
	//console.log(e.result)
	placenames=e.result["text"];
	placenametodo=e.result["place_name"];
	 longitud=e.result["center"][0];
	 latitud=e.result["center"][1];
  }); 
  
  if(inp_ubicacion!=""){
   var marker = new mapboxgl.Marker();
    marker.setLngLat([cor_lng,cor_lat])
  marker.addTo(map);
   map.addControl(new mapboxgl.FullscreenControl());
}else{
  var marker = new mapboxgl.Marker()
  map.addControl(new mapboxgl.FullscreenControl());
}
 

  map.on('click', function (e) {
//console.log(e.lngLat);
 marker.setLngLat([e.lngLat["lng"],e.lngLat["lat"]])
  marker.addTo(map);
    longitud=e.lngLat["lng"];
	latitud=e.lngLat["lat"];
	placenames=latitud+","+longitud;
		 if(acciones_ventana_ubicacion=="sucursales"){
		 document.getElementById('inp_lnglat_sucursales').value=placenames;
		}
		if(acciones_ventana_ubicacion=="datospersonales"){
		 document.getElementById('inp_lnglat_dp').value=placenames;
		}
 jQuery.ajax({
 
      url: 'https://api.mapbox.com/geocoding/v5/mapbox.places/'+e.lngLat["lng"]+','+e.lngLat["lat"]+'.json?types=poi&access_token=pk.eyJ1IjoiZ3VpbGxlcm1vOTk1IiwiYSI6ImNrYjg1OTdsbzAweDczMnBocHU1anA5NXUifQ.xa-q2v4CVLR0a-2nUcbmFw',
      dataType: 'json',
      error: function(xhr, textStatus, errorThrown) {
          errorUbicacion();
       },
	   success: function(responseText)
			{
		
			var Respuesta=responseText;
			
			try {
			var e=Respuesta["features"]["0"]["place_name"];
          //console.log(Respuesta)
		 placenames=Respuesta["features"]["0"]["text"];
	placenametodo=Respuesta["features"]["0"]["place_name"];
	 placenames=latitud+","+longitud;
			 }catch(error){
          ////console.log(e)
		 placenames=latitud+","+longitud;
		 
			}
	     }
   });
});
  
  

 

  
});

  function  cargarMap(longitude,latitude){

map.flyTo({center:[longitude, latitude]});

   var marker = new mapboxgl.Marker()
 marker.setLngLat([longitude,latitude])
  marker.addTo(map);
  latitud=longitude;
	longitud=latitude;
 jQuery.ajax({
     
      url: 'https://api.mapbox.com/geocoding/v5/mapbox.places/'+longitude+','+latitude+'.json?types=poi&access_token=pk.eyJ1IjoicmFtb245NSIsImEiOiJjazluNWN5cGUwMnAwM2duN3VxaWRpcXlqIn0.5IBjsjLUGZhRHh2lyjkhXw',
      dataType: 'json',
      error: function(xhr, textStatus, errorThrown) {
          errorUbicacion();
       },
	   success: function(responseText)
			{
		
			var Respuesta=responseText;
			   //console.log(Respuesta)
			 placenames=longitude+","+latitude;
			 
	         document.getElementById('inptDireccion').value=placenames
          
		
			}
   });

} 

 

}

var controlmanenimierntos=1;
var controlubicaciones=1;
var controlsolicitudescredito=1;
var controlajustes=1;
var controlreportes=1;
var controlcajax=1;
var controlatc=1;
var controlingresos=1;
var controlegresos=1;
function abrir_cerrar_opciones_menu(d){
  if(d=="1"){
	  if(controlmanenimierntos==0){
		  document.getElementById('cnt_sub_mantenimientos').style.display='none'
		  document.getElementById('f_ar_mantenimientos').style.display='none'
		  document.getElementById('f_ab_mantenimientos').style.display='block'
		  controlmanenimierntos=1;
	  }else if(controlmanenimierntos==1){
		   document.getElementById('cnt_sub_mantenimientos').style.display='block'
		   document.getElementById('f_ar_mantenimientos').style.display='block'
		   document.getElementById('f_ab_mantenimientos').style.display='none'   
		   controlmanenimierntos=0;
	  }  
  }
  
    if(d=="2"){
	  if(controlubicaciones==0){
		  document.getElementById('cnt_sub_ubicaciones').style.display='none'
		  document.getElementById('f_ar_ubicaciones').style.display='none'
		  document.getElementById('f_ab_ubicaciones').style.display='block'
		  controlubicaciones=1;
	  }else if(controlubicaciones==1){
		   document.getElementById('cnt_sub_ubicaciones').style.display='block'
		   document.getElementById('f_ar_ubicaciones').style.display='block'
		   document.getElementById('f_ab_ubicaciones').style.display='none'   
		   controlubicaciones=0;
	  }  
  }
  
 if(d=="3"){
	  if(controlsolicitudescredito==0){
		  document.getElementById('cnt_sub_solicitudescredito').style.display='none'
		  document.getElementById('f_ar_solicitudescredito').style.display='none'
		  document.getElementById('f_ab_solicitudescredito').style.display='block'
		  controlsolicitudescredito=1;
	  }else if(controlsolicitudescredito==1){
		   document.getElementById('cnt_sub_solicitudescredito').style.display='block'
		   document.getElementById('f_ar_solicitudescredito').style.display='block'
		   document.getElementById('f_ab_solicitudescredito').style.display='none'   
		   controlsolicitudescredito=0;
	  }  
  }
 if(d=="4"){
	  if(controlajustes==0){
		  document.getElementById('cnt_sub_ajustes').style.display='none'
		  document.getElementById('f_ar_ajustes').style.display='none'
		  document.getElementById('f_ab_ajustes').style.display='block'
		  controlajustes=1;
	  }else if(controlajustes==1){
		   document.getElementById('cnt_sub_ajustes').style.display='block'
		   document.getElementById('f_ar_ajustes').style.display='block'
		   document.getElementById('f_ab_ajustes').style.display='none'   
		   controlajustes=0;
	  }  
  }
 if(d=="5"){
	  if(controlreportes==0){
		  document.getElementById('cnt_sub_reportes').style.display='none'
		  document.getElementById('f_ar_reportes').style.display='none'
		  document.getElementById('f_ab_reportes').style.display='block'
		  controlreportes=1;
	  }else if(controlreportes==1){
		   document.getElementById('cnt_sub_reportes').style.display='block'
		   document.getElementById('f_ar_reportes').style.display='block'
		   document.getElementById('f_ab_reportes').style.display='none'   
		   controlreportes=0;
	  }  
  }
   if(d=="6"){
	  if(controlcajax==0){
		  document.getElementById('cnt_sub_cajax').style.display='none'
		  document.getElementById('f_ar_cajax').style.display='none'
		  document.getElementById('f_ab_cajax').style.display='block'
		  controlcajax=1;
	  }else if(controlcajax==1){
		   document.getElementById('cnt_sub_cajax').style.display='block'
		   document.getElementById('f_ar_cajax').style.display='block'
		   document.getElementById('f_ab_cajax').style.display='none'   
		   controlcajax=0;
	  }  
  }
   if(d=="7"){
	  if(controlatc==0){
		  document.getElementById('cnt_sub_atc').style.display='none'
		  document.getElementById('f_ar_atc').style.display='none'
		  document.getElementById('f_ab_atc').style.display='block'
		  controlatc=1;
	  }else if(controlatc==1){
		   document.getElementById('cnt_sub_atc').style.display='block'
		   document.getElementById('f_ar_atc').style.display='block'
		   document.getElementById('f_ab_atc').style.display='none'   
		   controlatc=0;
	  }  
    }
   if(d=="8"){
	  if(controlingresos==0){
		  document.getElementById('cnt_sub_cajaingresos').style.display='none'
		  document.getElementById('f_ar_cajaingresos').style.display='none'
		  document.getElementById('f_ab_cajaingresos').style.display='block'
		  controlingresos=1;
	  }else if(controlingresos==1){
		   document.getElementById('cnt_sub_cajaingresos').style.display='block'
		   document.getElementById('f_ar_cajaingresos').style.display='block'
		   document.getElementById('f_ab_cajaingresos').style.display='none'   
		   controlingresos=0;
	  }  
    }
   if(d=="9"){
	  if(controlegresos==0){
		  document.getElementById('cnt_sub_cajaegresos').style.display='none'
		  document.getElementById('f_ar_cajaegresos').style.display='none'
		  document.getElementById('f_ab_cajaegresos').style.display='block'
		  controlegresos=1;
	  }else if(controlegresos==1){
		   document.getElementById('cnt_sub_cajaegresos').style.display='block'
		   document.getElementById('f_ar_cajaegresos').style.display='block'
		   document.getElementById('f_ab_cajaegresos').style.display='none'   
		   controlegresos=0;
	  }  
    }
}
// AGREGAR TABLA REFERENCIAS PERSONALES
var id_referenciap=new Array
var id_temporal=1;
var controlcantidad=0;
function agregar_referencias_personales_a_la_tabla(datos){
	 var f= new Date
 var id_progreso=f.getMinutes()+"_"+f.getMilliseconds()+"_"+"_add";
 var codigo_datos=datos.id
 
 var vinculo=document.getElementById('inp_vinculoreferencia1').value
 var nombre=document.getElementById('inp_nombresferencia1').value
 var telefono=document.getElementById('inp_telefonoreferencia1').value
 if(vinculo==""){
	 ver_vetana_informativa("FALTA COMPLETAR CAMPO VINCULO", id_progreso);
	 return;
 }
 if(nombre==""){
	 ver_vetana_informativa("FALTA COMPLETAR CAMPO NOMBRE", id_progreso);
	 return;
 }
 if(telefono==""){
	 ver_vetana_informativa("FALTA COMPLETAR CAMPO TELEFONO", id_progreso);
	 return;
 }
 var pagina="<tr id='"+id_temporal+"' name='trdetalles_referenciaspersonales' class='table_5'>"+
				"<td id='td_vinculo' class='td_titulo' style='width: 31.66%;' >"+vinculo+"</td>"+
				"<td id='td_nombre' class='td_titulo' style='width: 31.66%;' >"+nombre+"</td>"+
				"<td id='td_telefono' class='td_titulo' style='width: 31.66%;' >"+telefono+"</td>"+
				"<td class='td_titulo' style='width: 5%;' ><button id='"+id_temporal+"'  onclick='quitar_referenciaspersonales_de_la_tabla(this)' type='button' class='input_eliminar'><img src='./icono/delete.png' style='width:15px;height:15px;' /></button></td>"+
			"</tr>";
 //$("tr[id="+codigo_datos+"]").remove();
	 var control='no';
	 for(var i=0;i< id_referenciap.length;i++){
		    if(id_referenciap[i]==id_temporal){
				control='si'
			}
		}
		
		$("table[id=cnt_datospersonales]").each(function(i, elementohtml){
			var idtr=$(elementohtml).children('tr').html();
			var datos=$(idtr).find("td").eq(0).html();
			//alert(datos);
		});
		//$(this).parents("tr").find("td").eq(0).html();
document.getElementById('cnt_datospersonales').innerHTML+=pagina;
id_temporal=id_temporal+1;
controlcantidad=controlcantidad+1;
document.getElementById('inp_vinculoreferencia1').value="";
document.getElementById('inp_nombresferencia1').value="";
document.getElementById('inp_telefonoreferencia1').value="";

}
 
 function quitar_referenciaspersonales_de_la_tabla(datos){
	$("tr[id="+datos.id+"]").remove(); 
	controlcantidad=controlcantidad-1;
	if(controlcantidad==0){
		id_temporal=1;
	}
 }



// AGREGAR TABLA REFERENCIAS COMERCIALES
var id_referenciac=new Array
var id_temporal1=1;
var controlcantidad1=0;
function agregar_referencias_comerciales_a_la_tabla(datos){
	 var f= new Date
 var id_progreso=f.getMinutes()+"_"+f.getMilliseconds()+"_"+"_add";
 var codigo_datos=datos.id
 
 var entidad=document.getElementById('inp_entidad_financiera').value
 var cuota=document.getElementById('inp_cuota_rc').value
 var plazo=document.getElementById('inp_plazo').value
 var saldo=document.getElementById('inp_saldo').value
 var observaciones=document.getElementById('inp_observaciones').value
 if(entidad==""){
	 ver_vetana_informativa("FALTA COMPLETAR CAMPO ENTIDAD FINANCIERA", id_progreso);
	 return;
 }
 if(cuota==""){
	 ver_vetana_informativa("FALTA COMPLETAR CAMPO CUOTA", id_progreso);
	 return;
 }
/*  if(plazo==""){
	 ver_vetana_informativa("FALTA COMPLETAR CAMPO PLAZO", id_progreso);
	 return;
 }
 if(saldo==""){
	 ver_vetana_informativa("FALTA COMPLETAR CAMPO SALDO", id_progreso);
	 return;
 } */
 var pagina="<tr id='"+id_temporal1+"' name='trdetalles_referenciascreditoscomerciales' class='table_5'>"+
				"<td id='td_entidad' class='td_titulo' style='width: 32.5%;' >"+entidad+"</td>"+
				"<td id='td_cuota' class='td_titulo' style='width: 10%;' >"+cuota+"</td>"+
				"<td id='td_plazo1' class='td_titulo' style='width: 10%;' >"+plazo+"</td>"+
				"<td id='td_saldo1' class='td_titulo' style='width: 10%;' >"+saldo+"</td>"+
				"<td id='td_observaciones' class='td_titulo' style='width: 32.5%;' >"+observaciones+"</td>"+
				"<td class='td_titulo' style='width: 5%;' ><button id='"+id_temporal1+"'  onclick='quitar_referenciascomerciales_de_la_tabla(this)' type='button' class='input_eliminar'><img src='./icono/delete.png' style='width:15px;height:15px;' /></button></td>"+
			"</tr>";
 //$("tr[id="+codigo_datos+"]").remove();
	 var control='no';
	 for(var i=0;i< id_referenciac.length;i++){
           
		    if(id_referenciac[i]==id_temporal1){
				control='si'
			}
		}
		
		$("table[id=cnt_referencias_comerciales]").each(function(i, elementohtml){
			var idtr=$(elementohtml).children('tr').html();
			var datos=$(idtr).find("td").eq(0).html();
			//alert(datos);
		});
		//$(this).parents("tr").find("td").eq(0).html();
document.getElementById('cnt_referencias_comerciales').innerHTML+=pagina;
id_temporal1=id_temporal1+1;
controlcantidad1=controlcantidad1+1;

document.getElementById('inp_entidad_financiera').value="";
document.getElementById('inp_cuota_rc').value="";
document.getElementById('inp_plazo').value="";
document.getElementById('inp_saldo').value="";
document.getElementById('inp_observaciones').value="";

}
 
 function quitar_referenciascomerciales_de_la_tabla(datos){
	$("tr[id="+datos.id+"]").remove(); 
	controlcantidad1=controlcantidad1-1;
	if(controlcantidad1==0){
		id_temporal1=1;
	}
 }
 
 
 function ObtenerNroSolicitudes() {
	 var datos = {
		"func": "obtenerNroSolicitudes"
	};
	$.ajax({
		data: datos, url: "./php/Solicitudes.php", type: "post", beforeSend: function () {

		}, error: function (jqXHR, textstatus, errorThrowm) {
		},
		success: function (responseText) {
			var Respuesta = responseText;
			//console.log(Respuesta)
			if (Respuesta != "error") {
				try {
					var datos = $.parseJSON(Respuesta);
					Respuesta = datos["1"];
					var datos_buscados = Respuesta;
					document.getElementById("inp_nrosolicitud").value =datos["2"];
				} catch (error) {

				}

			}
		}
	});


}

function cerrar_abrir_opciones_detalles_negocios(){
	var opcion=document.getElementById('inp_actividadescomerciales').value;
	if(opcion=="COMERCIANTE"){
		document.getElementById('contenedor_detalles_negocios').style.display=''
		document.getElementById('cnt_detalles_ingresos').style.display=''
	
		document.getElementById('inp_funcionarioasucargo').value="";
		document.getElementById('inp_direccioncomercial').value="";
		document.getElementById('inp_telefonocomercial').value="";
		document.getElementById('inp_pordiapoco').value="";
		document.getElementById('inp_pordiamas').value="";
		document.getElementById('inp_porsemanapoco').value="";
		document.getElementById('inp_porsemanamas').value="";
		document.getElementById('inp_porquincenapoco').value="";
		document.getElementById('inp_porquincenamas').value="";
		document.getElementById('inp_pormespoco').value="";
		document.getElementById('inp_pormesmas').value="";
		document.getElementById('inp_salariomensual').value="";
		document.getElementById('inp_alquilercomercio').value="";
	}else
	if(opcion=="ASALARIADO"){
		document.getElementById('contenedor_detalles_negocios').style.display='none'
		document.getElementById('cnt_detalles_ingresos').style.display='none'
		
		document.getElementById('inp_funcionarioasucargo').value="-";
		document.getElementById('inp_direccioncomercial').value="-";
		document.getElementById('inp_telefonocomercial').value="-";
		document.getElementById('inp_pordiapoco').value="0";
		document.getElementById('inp_pordiamas').value="0";
		document.getElementById('inp_porsemanapoco').value="0";
		document.getElementById('inp_porsemanamas').value="0";
		document.getElementById('inp_porquincenapoco').value="0";
		document.getElementById('inp_porquincenamas').value="0";
		document.getElementById('inp_pormespoco').value="0";
		document.getElementById('inp_pormesmas').value="0";
		document.getElementById('inp_salariomensual').value="0";
		document.getElementById('inp_alquilercomercio').value="0";
	}
	
}

function cerrar_abrir_opciones_detalles_vivienda(opcion){
	if(opcion!="PROPIA"){
		document.getElementById('cnt_alqui_vivienda').style.display='block'
		document.getElementById('inp_alquilervivienda').value="";
	}else{
		document.getElementById('cnt_alqui_vivienda').style.display='none'
		document.getElementById('inp_alquilervivienda').value="0";
	}
}
function cerrar_abrir_opciones_conyuge(){
	var datos1 = document.getElementById("combo_idestadocivil_dp");
    var opcion = datos1.options[datos1.selectedIndex].text;
	if(opcion=="SOLTERO"){
		document.getElementById('cnt_conyuge_1').style.display='none'
		document.getElementById('inp_conyugue_dp').value="-";
	}else{
		document.getElementById('cnt_conyuge_1').style.display=''
		document.getElementById('inp_conyugue_dp').value="";
	}
}



//ordenar datos de table
function sortTable(n,idtable,type,variable) {
		document.getElementById(variable+n).classList.add('fa-caret-down');
        document.getElementById(variable+n).classList.remove('fa-caret-up');
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
 
  table = document.getElementById(idtable);
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc";
 
  /*Make a loop that will continue until no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the first, which contains table headers):*/
    for (i = 0; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare, one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place, based on the direction, asc or desc:*/
      if (dir == "asc") {
        if ((type=="str" && x.innerHTML.charAt(0).toLowerCase() > y.innerHTML.charAt(0).toLowerCase()) || (type=="int" && parseFloat(x.innerHTML.replace(/\./g,'')) > parseFloat(y.innerHTML.replace(/\./g,''))) || (type=="date" && myDateParser(x.innerHTML) > myDateParser(y.innerHTML)) ) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
		document.getElementById(variable+n).classList.add('fa-caret-down');
        document.getElementById(variable+n).classList.remove('fa-caret-up');
          break;
        }
      } else if (dir == "desc") {
        if ((type=="str" && x.innerHTML.charAt(0).toLowerCase() < y.innerHTML.charAt(0).toLowerCase()) || (type=="int" && parseFloat(x.innerHTML.replace(/\./g,'')) < parseFloat(y.innerHTML.replace(/\./g,'')))|| (type=="date" && myDateParser(x.innerHTML) < myDateParser(y.innerHTML))) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
		document.getElementById(variable+n).classList.remove('fa-caret-down');
        document.getElementById(variable+n).classList.add('fa-caret-up');
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /*If no switching has been done AND the direction is "asc", set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

function myDateParser(dateString) {
    var comps = dateString.split("/");
    return new Date(comps[2], comps[1], comps[0]);
}

var datosprcod_cob="";
var datosprmonto_cob="";
	/*EMERGENTE ELIMINAR ACCION */
var id_clave_permiso="";
function obtener_permiso_usuario(c,nrocomprobante){
var clavepermiso=document.getElementById('inp_clave_permiso_'+c+'').value
ver_cerrar_ventana_cargando("1");
	var datos = new FormData();
	datos.append("func","buscar_usuarios_conclavepermiso")
	datos.append("clavepermiso" ,clavepermiso)
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
			//console.log(Respuesta)
			try {
				var datos = $.parseJSON(Respuesta);
				Respuesta = datos["1"];
				if (Respuesta == "exito") {
	   var onkeyupevt='obtener_datos_decimales("28")';
       var onchangeevt='obtener_datos_decimales("28")';
	if(c=="1"){
	    if(datos["3"]=="1"){
        id_clave_permiso=datos["2"];
	    var montodescuento= document.getElementById('div_descuento_'+datosprcod_cob+'').innerHTML;
	    datosprmonto_cob= document.getElementById('td_monto_'+datosprcod_cob+'').innerHTML;
		document.getElementById('td_descuento_'+datosprcod_cob+'').innerHTML="<input onblur='cargar_descuento_pagos_clientes();' type='text' style='width: 100%;height: 100%;border: none;text-align: center;color: green;font-weight: bold;font-size: 12px;outline: none;' name='"+datosprcod_cob+"' onkeyup="+onkeyupevt+" onchange="+onchangeevt+" id='div_descuento_"+datosprcod_cob+"' value='"+format_con_puntos_decimales(montodescuento)+"'/>";
        document.getElementById('div_descuento_'+datosprcod_cob+'').focus();
        document.getElementById('capa_permiso').style.display='none'
		document.getElementById('capa_permiso').innerHTML="";
		document.getElementById('div_principal_info_carga').style.display='none';  
	    }else{
	        ver_vetana_informativa("CLAVE INCORRECTO",id_progreso);	       
             document.getElementById('div_principal_info_carga').style.display='none';
	    }
	} 
	if(c=="2"){
	   if(datos["3"]=="1")  {
          id_clave_permiso=datos["2"];
          document.getElementById('capa_permiso').style.display='none';
          document.getElementById('capa_permiso').innerHTML="";
          document.getElementById('div_principal_info_carga').style.display='none';     
	    }else{
	       ver_vetana_informativa("CLAVE INCORRECTO",id_progreso);	
           document.getElementById('div_principal_info_carga').style.display='none';   
	    }
	}
    if(c=="3"){
	   if(datos["3"]=="1")   {
  id_clave_permiso=datos["2"];
          anular_cobros_cuotas_clientes(nrocomprobante);
	    }else{
	       ver_vetana_informativa("CLAVE INCORRECTO",id_progreso);
           document.getElementById('div_principal_info_carga').style.display='none';	   
	    }
	}
    if(c=="4"){
	   if(datos["3"]=="1")   {
  id_clave_permiso=datos["2"];
          anular_otrosingresos(nrocomprobante);
	    }else{
	       ver_vetana_informativa("CLAVE INCORRECTO",id_progreso);
           document.getElementById('div_principal_info_carga').style.display='none';	   
	    }
	}
    if(c=="5"){
	   if(datos["3"]=="1")   {
       id_clave_permiso=datos["2"];
          anular_otrosegresos(nrocomprobante);
	    }else{
	       ver_vetana_informativa("CLAVE INCORRECTO",id_progreso);
           document.getElementById('div_principal_info_carga').style.display='none';	   
	    }
	}
	 if(c=="6"){
	   if(datos["3"]=="1")   {
  id_clave_permiso=datos["2"];
          anular_compras_insumos(nrocomprobante);
	    }else{
	       ver_vetana_informativa("CLAVE INCORRECTO",id_progreso);
           document.getElementById('div_principal_info_carga').style.display='none';	   
	    }
	}
                   
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

function ver_vetana_permiso(id_c,b,datospr,nrocomprobante){
         //obtener name con jquery
         datosprcod_cob = $(datospr).attr('name');
		var pagina_informativa="<center>"+
		"<div class='cont_emergente_alert_largo'>"+
		"<div id='barra_de_progreso_"+id_c+"' name='tarea_en_progreso' class='cont_emergente_alert' >"+
		"<div class='table_emergente_alert' id='"+id_c+"'>"+
		"<div style=' width:90%; margin-left: auto; margin-right: auto;'>"+
        "<div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>"+
        "<label   class='input_TEXT'>INGRESE SU CLAVE DE PERMISO<label/>"+
        "</div>"+
        "</div>"+
		"<div style=' width:90%; margin-left: auto; margin-right: auto;'>"+
        "<div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>"+
        "<input id='inp_clave_permiso_"+b+"' type='password' class='input_1_1' style='text-align:center;'  value='' />"+
		"</div>"+
		"</div>"+
		"<div style=' width:90%; margin-left: auto; margin-right: auto;margin-top: 1%;'>"+
		"<div class='input_ok'  style='float:right;height:30px;width:35px;' onclick='obtener_permiso_usuario("+b+","+nrocomprobante+");' id='btn_obtenerpermiso_1'><p style='display:none;' id='accion_obtenerpermiso'></p>OK</div>"+
		"<div class='input_cancel' style='float:right;height:30px;width:75px;' onclick='cerrar_esta_ventanas_permisos(this)'>CANCELAR</div>"+
		 "</div>"+
        "</div>"+
        "</div>"+
		"</div>"+
		"</center>";
	document.getElementById('capa_permiso').innerHTML=pagina_informativa
	document.getElementById('capa_permiso').style.display=''
	document.getElementById('inp_clave_permiso_'+b+'').focus();
}


function cerrar_esta_ventanas_permisos(datos){
            document.getElementById('capa_permiso').style.display='none'
			document.getElementById('capa_permiso').innerHTML="";
           document.getElementById('inp_fechanac_dp').value="";
            return false;	
}


function ver_vetana_validar_fecha(titulo,id_c,b){
	
		var pagina_informativa="<center>"+
		"<div class='cont_emergente_alert_largo'>"+
		"<div id='barra_de_progreso_"+id_c+"' name='ventanas_infos' class='cont_emergente_alert' >"+
		"<div class='table_emergente_alert' id='"+id_c+"' >"+
		"<div style=' width:90%; margin-left: auto; margin-right: auto;'>"+
        "<div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>"+
        "<label   class='input_TEXT'>OPCION<label/>"+
        "</div>"+
        "</div>"+
		"<div style=' width:90%; margin-left: auto; margin-right: auto;'>"+
        "<div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>"+
        "<textarea style='height:60px;' type='text'  class='input_progress' placeholder=''  id='titulo_"+id_c+"'>"+titulo+"</textarea>"+
		"</div>"+
		"</div>"+
		"<div style=' width:90%; margin-left: auto; margin-right: auto;margin-top: 1%;'>"+
		"<div class='input_ok'  style='float:right;height:30px;width:35px;' onclick='verificar_fecha_lista("+b+");' id='btn_eliminar_1'><p style='display:none;' id='accion_eliminar'>eliminar</p>OK</div>"+
		"<div class='input_cancel' style='float:right;height:30px;width:75px;' onclick='cerrar_esta_validar_fecha(this)'>CANCELAR</div>"+
		 "</div>"+
        "</div>"+
        "</div>"+
		"</div>"+
		"</center>";
			
	
	document.getElementById('capa_informativa').innerHTML=pagina_informativa
	document.getElementById('capa_informativa').style.display=''
}

function cerrar_esta_validar_fecha(datos){
    document.getElementById('capa_informativa').style.display='none'
	document.getElementById('capa_informativa').innerHTML="";
    document.getElementById('inp_fechanac_dp').value="";
    return false;	
}

	function verificar_fecha_lista(c){
	if(c=="1"){
      ver_vetana_permiso(id_progreso,"2");
	  document.getElementById('capa_informativa').style.display='none'
	  document.getElementById('capa_informativa').innerHTML="";
	  }
}


function ver_vetana_vuelto(){
  
	   if(document.getElementById('inp_totalaentregar_pcobros_c').value==""){
		
	   }else{
         //obtener name con jquery
		 var nro='30';
		var pagina_informativa="<center>"+
		"<div class='cont_emergente_alert_largo'>"+
		"<div class='cont_emergente_alert' style='height:260px;'>"+
		"<div class='table_emergente_alert'>"+
		
        "<div style=' width:90%; margin-left: auto; margin-right: auto;'>"+
        "<div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>"+
        "<label   class='input_TEXT'>EFECTIVO<label/>"+
        "</div>"+
        "</div>"+
		"<div style=' width:90%; margin-left: auto; margin-right: auto;'>"+
        "<div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>"+
        "<input id='inp_efectivo_cobrosclientes' onkeyup='obtener_datos_decimales("+nro+")' onchange='obtener_datos_decimales("+nro+")'   onkeypress='return validar_solo_numeros(event);'  type='text' class='input_1_1' style='text-align:center;font-size:26px;font-weight:bold;font-family:monospace;'  value='' />"+
		"</div>"+
		"</div>"+

        
        "<div style=' width:90%; margin-left: auto; margin-right: auto;'>"+
        "<div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>"+
        "<label   class='input_TEXT'>VUELTO<label/>"+
        "</div>"+
        "</div>"+
		"<div style=' width:90%; margin-left: auto; margin-right: auto;'>"+
        "<div class='tit_submenu1' style='padding-left:0px;background-color:transparent'>"+
        "<input id='inp_vuelto_cobrosclientes' readonly='readonly'  type='text' class='input_1_1' style='text-align:center;font-size:26px;font-weight:bold;font-family:monospace;' value='' />"+
		"</div>"+
		"</div>"+

		"<div style=' width:90%; margin-left: auto; margin-right: auto;margin-top: 1%;'>"+
		"<div class='input_ok'  style='float:right;height:30px;width: 115px;' onclick='add_datos_cobros();' id='btn_finalizarcobro_1'><p style='display:none;' id='accion_obtenerpermiso'></p>FINALIZAR COBRO</div>"+
		"<div class='input_cancel' id='btn_cancelar_cobro' style='float:right;height:30px;width:75px;' onclick='cerrar_esta_vetana_vuelto();'>CANCELAR</div>"+
		"<div class='input_cancel'  id='btn_cancelar_cobro1' style='display:none;float:right;height:30px;width:75px;' onclick='cerrar_todas_las_ventanas_pagos()'>CERRAR</div>"+
		 "</div>"+
        "</div>"+
        "</div>"+
		"</div>"+
		"</center>";
	document.getElementById('capa_efectivo_vuelto').innerHTML=pagina_informativa
	document.getElementById('capa_efectivo_vuelto').style.display=''
	document.getElementById('inp_efectivo_cobrosclientes').focus();
	   }
}

function cerrar_esta_vetana_vuelto(){
            document.getElementById('capa_efectivo_vuelto').style.display='none'
			document.getElementById('capa_efectivo_vuelto').innerHTML="";
            return false;	
}
function cerrar_todas_las_ventanas_pagos(){
	abrir_cerrar_ventanas_pagoscuotasclientes("2");
	buscar_cuotas_del_cliente(document.getElementById('inp_codventas_pcobros_c').value);
	cerrar_esta_vetana_vuelto();
}



	/*EMERGENTE ELIMINAR ACCION */
function eliminar_de_la_lista(c){
	if(c=="1"){
		var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_regiones(elememnto_eliminar);
		
	} 
	if(c=="2"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_departamentos(elememnto_eliminar);
		
	} 
	
	if(c=="3"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_Ciudades(elememnto_eliminar);
	} 
    if(c=="4"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_Barrios(elememnto_eliminar);
	} 
	if(c=="5"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_sucursales(elememnto_eliminar);
	} 
	if(c=="6"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_accesos(elememnto_eliminar);
	} 
	if(c=="7"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_profesiones(elememnto_eliminar);
	} 
 
	if(c=="8"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_nacionalidades(elememnto_eliminar);
	} 
	
	if(c=="9"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_estadosciviles(elememnto_eliminar);
	} 
	
	if(c=="10"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_tipospersonas(elememnto_eliminar);
	} 
    if(c=="11"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_datospersonales(elememnto_eliminar);
	} 
   if(c=="12"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_usuarios(elememnto_eliminar);
	} 
	if(c=="13"){
	  abrir_cerrar_ventanas_datospersonales("9");	  
	} 
	if(c=="14"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_clientes(elememnto_eliminar);
	}
	if(c=="15"){
	abrir_cerrar_ventanas_datospersonales("11");
	} 
	if(c=="16"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_cuoteros(elememnto_eliminar);
	}
	if(c=="17"){
	abrir_cerrar_ventanas_datospersonales("13");
	}
	if(c=="18"){
	 retranferirSolicitud();
	}
	if(c=="19"){
	 rechazarSolicitud();
	}
	if(c=="20"){
	
		titulo_guardado_solicitud="BORRADOR";
		var cod = document.getElementById('inp_idsolicitudescredito').value
		if(cod==""){
		 
		add_datos_solicitudescredito("BORRADOR","guardar","1");	
		}else{
		   
		add_datos_solicitudescredito_a_borrador();	
		}
	}
	
	if(c=="21"){

	add_datos_solicitudescredito_a_analisis();
	titulo_guardado_solicitud="SOLICITUD";
	}
		if(c=="22"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_utilidades(elememnto_eliminar);
	}
		
if(c=="23"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_ajustesfactura(elememnto_eliminar);
	}
 if(c=="24"){
	eliminarestasolicitud();
	}
	if(c=="25"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_ajustesinteres(elememnto_eliminar);
	}
	if(c=="26"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_aperturacaja(elememnto_eliminar);
	}
	if(c=="27"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_datoscaja(elememnto_eliminar);
	}
	if(c=="28"){
	 obtener_monto_en_caja();
	}
	if(c=="29"){
   
	 abrir_cerrar_ventanas_aperturacaja("1");
	}
	if(c=="30"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_conceptos(elememnto_eliminar);
	}
	if(c=="31"){
	var elememnto_eliminar=$("div[id=btn_eliminar_1]").children('p[id="accion_eliminar"]').html();
		add_datos_proveedores(elememnto_eliminar);
	}
	if(c=="32"){
	eliminarestasolicitud_analisis();
	}
	if(c=="33"){
	eliminar_datos_pago_express_1();
	}
	
}

