function Notificacion(){
	this.contador=-1;
	this.crearContenedor=function(){

		if($('.notificacion').css('display') == 'none'){
			$('.notificacion').fadeIn(300).animate({top:"0"},700);	
			$('.notificacion').show();		
		}
		 this.ocultarContenedor();
	}
	this.ocultarContenedor=function(){
		var objeto=this;	
		var intervalo=setInterval(function (){			
			if(objeto.esVacio("notificacion-mensajes")){				
				$('.notificacion').empty();
				$('.notificacion').hide();	
				clearInterval(intervalo);
			}
		},1000);		
	}
	this.esVacio=function(elemento){	
		if($("."+elemento).length >0){
			return false;
		}else{
			return true;
		}			
	}
	this.crearNotificacion=function(mensaje,contenedorNotificacion){
	
		var objeto=this;
		this.contador++;
		var id=this.contador;
		$('.notificacion').append(this.html(mensaje,contenedorNotificacion));
		$('#notificacion-'+id).fadeIn(300);
		 this.ocultarNotificacion(id);		
	}
	this.ocultarNotificacion=function(id){
		setTimeout(function() {
        	$('#notificacion-'+id).fadeOut(400);        	
        	$('#notificacion-'+id).remove();
   		},5000);
	}
	this.html=function(mensaje,contenedorNotificacion){
 		var codigo="";
		switch(contenedorNotificacion) {
		    case "DANGER":		
	            codigo="<div class='notificacion-mensajes col-xs-12 col-sm-12 col-md-12' id='notificacion-"+this.contador+"'>";
		        codigo+="    <div class='alert alert-danger'>";
		        codigo+="        <button  type='button' class='close' data-dismiss='alert' aria-hidden='true'>";
		        codigo+="            ×</button>";
		        codigo+="        <span class='glyphicon glyphicon-hand-right'></span> <strong>Mensaje de peligro</strong>";
		        codigo+="        <hr class='message-inner-separator'>";
		        codigo+="        <p>";
		        codigo+=mensaje;
		        codigo+="</p>";
		        codigo+="   </div>";
		        codigo+="</div>";
			return codigo;
	        break;		
			case "WARNING":		
	            codigo="<div class='notificacion-mensajes col-xs-12 col-sm-12 col-md-12' id='notificacion-"+this.contador+"'>";
		        codigo+="    <div class='alert alert-warning'>";
		        codigo+="        <button  type='button' class='close' data-dismiss='alert' aria-hidden='true'>";
		        codigo+="            ×</button>";
		        codigo+="        <span class='glyphicon glyphicon-record'></span> <strong>Mensaje de advertencia</strong>";
		        codigo+="        <hr class='message-inner-separator'>";
		        codigo+="        <p>";
		        codigo+=mensaje;
		        codigo+="</p>";
		        codigo+="   </div>";
		        codigo+="</div>";
			return codigo;

	        break;	
	        case "INFO":		
	            codigo="<div class='notificacion-mensajes col-xs-12 col-sm-12 col-md-12' id='notificacion-"+this.contador+"'>";
		        codigo+="    <div class='alert alert-info'>";
		        codigo+="        <button  type='button' class='close' data-dismiss='alert' aria-hidden='true'>";
		        codigo+="            ×</button>";
		        codigo+="        <span class='glyphicon glyphicon-info-sign'></span> <strong>Mensaje informativo</strong>";
		        codigo+="        <hr class='message-inner-separator'>";
		        codigo+="        <p>";
		        codigo+=mensaje;
		        codigo+="</p>";
		        codigo+="   </div>";
		        codigo+="</div>";
			return codigo;

	        break;		 
	        case "SUCCESS":
	            codigo="<div class='notificacion-mensajes col-xs-12 col-sm-12 col-md-12' id='notificacion-"+this.contador+"'>";
		        codigo+="    <div class='alert alert-success'>";
		        codigo+="        <button  type='button' class='close' data-dismiss='alert' aria-hidden='true'>";
		        codigo+="            ×</button>";
		        codigo+="        <span class='glyphicon glyphicon-ok'></span> <strong>Mensaje exitoso</strong>";
		        codigo+="        <hr class='message-inner-separator'>";
		        codigo+="        <p>";
		        codigo+=mensaje;
		        codigo+="</p>";
		        codigo+="   </div>";
		        codigo+="</div>";
			return codigo;

	        break;		 	  
		}
		
	}		
	this.cerrar=function(evento){	
		$(evento).parent().remove();
	}

}