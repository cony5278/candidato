<style>
.cargando{
  position: absolute;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  background-color: #000;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=67)";
  filter: alpha(opacity=67);
  -moz-opacity: 0.67;
  -khtml-opacity: 0.67;
  opacity: 0.77;
  z-index: 1500;
  margin: 0px;
  padding: 0px;
}
.contenedor-cargando{
  position: relative;
  left: 40%;
  top: 30%;
  width: 290px;
  height: 290px;
  background: #fff;
  z-index: 1501;
  border-radius: 200px 200px 200px 200px;
  -moz-border-radius: 200px 200px 200px 200px;
  -webkit-border-radius: 200px 200px 200px 200px;
  border: 0px solid #000000;
}
.titulo-cargando{
  position: absolute;
  left:33%;
  top:10%;
  font-size: 20px;
}
.logo-empresa-cargando{
  position: absolute;
  left:28%;
  top:24%;
}
.gif-cargando{
  position: absolute;
  left:10%;
  top:50%;
}
.contenedor-cargando-body{
  position: absolute;
  left: 24%;
  Top:60%;
}

</style>

<div class="cargando">
  <div class="contenedor-cargando">
    <div class="container-fluid">
    	<div class="row titulo-cargando">
    		<div class="col-md-12 ">
          Cargando
    		</div>
    	</div>
    	<div class="row logo-empresa-cargando">
    		<div class="col-md-12 ">
          <img src="archivos/logo.png" width="150" height="100" class="img-fluid" alt="Responsive image">

    		</div>
    	</div>
    	<div class="row gif-cargando">
    		<div class="col-md-12">
          <img src="archivos/loader.gif" width="150" height="100" class="img-fluid" alt="Responsive image">

    		</div>
    	</div>
    </div>
  </div>
</div>
