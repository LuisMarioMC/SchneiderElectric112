<?php
 require_once ('controlador_crear_vendedor.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Crear Vendedor</title>'; 
   require_once ('librerias_css.php');
   require_once ('funciones_javascript_vendedor.php');
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
        Crear Vendedor
       </div>
       
	   <div class="panel-body">
	   
	    <ol class="breadcrumb">
         <?php echo $miga_pan ?>
		</ol>
	   
	    <ul class="nav nav-tabs">
		 <?php
		  echo'<li><a href="listar_vendedor.php">Listar</a></li>';
		  echo'<li class="active"><a href="crear_vendedor.php">Crear</a></li>';	      
		 ?>
	    </ul>
	    <br>
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="crear_vendedor.php" autocomplete="off" method="post" enctype="multipart/form-data">
	
	       <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Nombre (*)</label>
             <input class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>" type="text" placeholder="Nombre" autofocus required/>
 			 <?php echo $error_nombre ?>			 
			</div>
		   </div>
	
		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Correo Electr&oacute;nico (*)</label>
             <input class="form-control" id="correo_electronico" name="correo_electronico" type="email" title="Ingrese el Correo Electr&oacute;nico" value="<?php echo $correo_electronico ?>" placeholder="Correo Electr&oacute;nico" required/>
             <?php echo $error_correo_electronico ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Celular (*)</label>
             <input class="form-control" id="celular" name="celular" type="number" title="Ingrese el Celular" value="<?php echo $celular ?>" placeholder="Celular" required/>
             <?php echo $error_celular ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
 			<div class="form-group">
			 <label>Contrase&ntilde;a Autom&aacute;tica</label>
             <input class="form-control" type="checkbox" id="contrasenia_automatica" name="contrasenia_automatica" value="1" <?php echo $checked_contrasenia_automatica ?>>
             <?php echo $error_contrasenia_automatica ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Contrase&ntilde;a</label>
             <input class="form-control" id="contrasenia" name="contrasenia" type="password" title="Ingrese la Contrase&ntilde;a" value="<?php echo $contrasenia ?>" >
             <?php echo $error_contrasenia ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Repetir Contrase&ntilde;a</label>
             <input class="form-control" id="contrasenia2" name="contrasenia2" type="password" title="Ingrese Nuevamente la Contrase&ntilde;a" value="<?php echo $contrasenia2 ?>" >
             <?php echo $error_contrasenia2 ?>
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
			
   });
   
  </script>
  
 </body>
</html>