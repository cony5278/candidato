function Notificacion(){
	this.contador=-1;
	this.crearContenedor=function(){



	}
	this.ocultarContenedor=function(){
		var objeto=this;
		var intervalo=setInterval(function (){
			if(objeto.esVacio("notificacion-mensajes")){
				$('.notificacion').css("display","none");
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
		$('.notificacion').css("display","block");
		$('.notificacion div:last-child').fadeIn(300).animate({top:"0"},700);
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
		        codigo+="    <div class='alert p-3 mb-2 bg-danger text-white cambiar-notificacion'>";
		        codigo+="        <button  type='button' class='close' data-dismiss='alert' aria-hidden='true'>";
		        codigo+="            ×</button>";
		        codigo+="        <i class='fa fa-hand-o-right' aria-hidden='true'></i></span> <strong>Software Electoral CRD</strong>";
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
		        codigo+="    <div class='alert p-3 mb-2 bg-warning text-dark cambiar-notificacion'>";
		        codigo+="        <button  type='button' class='close' data-dismiss='alert' aria-hidden='true'>";
		        codigo+="            ×</button>";
		        codigo+="        <i class='fa fa-dot-circle-o' aria-hidden='true'></i> <strong>Software Electoral CRD</strong>";
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
		        codigo+="    <div class='alert p-3 mb-2 bg-info text-white cambiar-notificacion'>";
		        codigo+="        <button  type='button' class='close' data-dismiss='alert' aria-hidden='true'>";
		        codigo+="            ×</button>";
		        codigo+="        <i class='fa fa-info-circle' aria-hidden='true'></i> <strong>Software Electoral CRD</strong>";
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
		        codigo+="    <div class='alert p-3 mb-2 bg-success text-white cambiar-notificacion'>";
		        codigo+="        <button  type='button' class='close' data-dismiss='alert' aria-hidden='true'>";
		        codigo+="            ×</button>";
		        codigo+="        <i class='fa fa-check-circle' aria-hidden='true'></i> <strong>Software Electoral CRD</strong>";
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
