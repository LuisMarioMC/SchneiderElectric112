<?php
 require_once ('controlador_crear_usuario.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Crear Usuario</title>'; 
   require_once ('librerias_css.php');
   require_once ('funciones_javascript_usuario.php');
  ?>
 </head>
 
 <body>
  <div id="wrapper">
   
   <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <?php require_once ('menu_superior.php'); require_once ('menu_lateral.php');?>
   </nav>
   
   <div id="page-wrapper">
	<br>
    <div class="row">
     <div class="col-lg-12">
      <div class="panel panel-default">
       <div class="panel-heading">
        Crear Usuario
       </div>
       
	   <div class="panel-body">
	   
	    <ol class="breadcrumb">
         <?php echo $miga_pan ?>
		</ol>
	   
	    <ul class="nav nav-tabs">
		 <?php
		  echo'<li><a href="listar_usuario.php">Listar</a></li>';
		  echo'<li class="active"><a href="crear_usuario.php">Crear</a></li>';	      
		 ?>
	    </ul>
	    <br>
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="crear_usuario.php" autocomplete="off" method="post" enctype="multipart/form-data">
	
	       <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Nombre (*)</label>
             <input class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>" type="text" placeholder="Nombre" autofocus required/>
			</div>
		   </div>
	
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Correo Electr&oacute;nico (*)</label>
             <input class="form-control" id="correo_electronico" name="correo_electronico" type="email" title="Ingrese el Correo Electr&oacute;nico" value="<?php echo $correo_electronico ?>" placeholder="Correo Electr&oacute;nico" required/>
			</div>
		   </div>

		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Perfil (*)</label>
             <?php echo $menu_perfil ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Celular (*)</label>
             <input class="form-control" id="celular" name="celular" type="number" title="Ingrese el Celular" value="<?php echo $celular ?>" placeholder="Celular" required/>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
 			<div class="form-group">
			 <label>Contrase&ntilde;a Autom&aacute;tica</label>
             <input class="form-control" type="checkbox" id="contrasenia_automatica" name="contrasenia_automatica" value="1" <?php echo $checked_contrasenia_automatica ?>>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Contrase&ntilde;a</label>
             <input class="form-control" id="contrasenia" name="contrasenia" type="password" title="Ingrese la Contrase&ntilde;a" value="<?php echo $contrasenia ?>" >
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Repetir Contrase&ntilde;a</label>
             <input class="form-control" id="contrasenia2" name="contrasenia2" type="password" title="Ingrese Nuevamente la Contrase&ntilde;a" value="<?php echo $contrasenia2 ?>" >
			</div>
		   </div>

		   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 			<div class="form-group">		   
			</div>
		   </div>

		   <div id="opcion1" name="opcion1"></div>
		   
		   <div id="opcion2" name="opcion2"></div>

		   <div id="opcion3" name="opcion3"></div>

   		   <div id="opcion4" name="opcion4"></div>
		   
  		   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 			<div class="form-group">
			 <?php
 			  echo $error_nombre;
              echo $error_correo_electronico;
              echo $error_perfil;
              echo $error_celular;
              echo $error_contrasenia_automatica;
              echo $error_contrasenia;
              echo $error_contrasenia2;
			 ?>
			</div>
		   </div>
		   
		   <?php echo $listar_mensaje ?>
		   
           <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" class="btn btn-default">Crear</button> 			
		   </div>
		
		  </form>
			
		 </div>
         <!-- /.col-lg-12 -->		
        </div>
        <!-- /.row -->
       </div>
       <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
     </div>
     <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
			
   </div>
   
  </div>
  
  <?php
   require_once ('librerias_javascript.php');
  ?>
  
  <script language="javascript">
   $(document).ready(function(){
   
    $("#contrasenia_automatica").change(function() {
      if($(this).is(":checked")) {
		 $("#contrasenia").attr('disabled', true);
 		 $("#contrasenia2").attr('disabled', true);            
      } else {
		 $("#contrasenia").attr('disabled', false);
 		 $("#contrasenia2").attr('disabled', false);                        
      }
    });
    
    var valor = '<?php echo $contrasenia_automatica;?>';
    if (valor === '0') {
		 $("#contrasenia").attr('disabled', false);
 		 $("#contrasenia2").attr('disabled', false);
    } if (valor === '1') {
		 $("#contrasenia").attr('disabled', true);
 		 $("#contrasenia2").attr('disabled', true);
	}
	
    $("#perfil").on("change", function() {
	  var perfil = $("#perfil").val();
	  data = '';
	  $("#opcion1").html(data);
	  $("#opcion2").html(data);
	  $("#opcion3").html(data);
	  $("#opcion4").html(data);
	  
	  if (perfil === "canal") 
	  {
	   $.post("controlador_dependiente_usuario.php", { perfil: perfil }, function(data){
		$("#opcion1").html(data);
	   });
	  }
	  else if (perfil === "linea") 
	  {
	   $.post("controlador_dependiente_usuario.php", { perfil: perfil }, function(data){
		$("#opcion1").html(data);
	   });
	  }
	  else if (perfil === "distribuidor") 
	  {
	   $.post("controlador_dependiente_usuario2.php", { perfil: perfil, tipo: "pais" }, function(data){
		$("#opcion3").html(data);
	   });
	   $.post("controlador_dependiente_usuario2.php", { perfil: perfil, tipo: "zona" }, function(data){
		$("#opcion4").html(data);
	   });
	   $("#opcion3").change(function () {
	    $("#opcion3 option:selected").each(function () {
	     id_pais = $(this).val();
	     $.post("controlador_dependiente_usuario2.php", { perfil: perfil, tipo: "zona", id_pais: id_pais }, function(data){
	      $("#opcion4").html(data);
	     });			
	    });
       });
	  }	
	  

    });
	
   });
  </script>
  
 </body>
</html>