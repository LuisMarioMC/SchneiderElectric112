<?php
 require_once ('controlador_modificar_vendedor.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Modificar Vendedor</title>'; 
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
        Modificar Vendedor
       </div>
       
	   <div class="panel-body">
	   
	    <ol class="breadcrumb">
		 <?php echo $miga_pan ?>
		</ol>
	   
	    <ul class="nav nav-tabs">
		 <?php
		  echo'<li><a href="listar_vendedor.php">Listar</a></li>';
		  echo'<li><a href="crear_vendedor.php">Crear</a></li>';	      
		 ?>
		</ul>
	    <br>
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="modificar_vendedor.php?id=<?php echo $id_modificar ?>" autocomplete="off" method="post" enctype="multipart/form-data">  

	       <div class="col-xs-12 col-sm-12 col-md-8 col-lg-4">
 			<div class="form-group">
			 <label>Nombre (*)</label>
             <input class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>" type="text" placeholder="Nombre" autofocus required/>
 			 <?php echo $error_nombre ?>			 
			</div>
		   </div>
	
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
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
		   
		   <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" class="btn btn-default">Modificar</button> 			
		   </div>
		
		  </form>
		 
		 </div>
         <!-- /.col-lg-12 -->		
        </div>
        <!-- /.row --> 
		   
		<?php echo $listar_mensaje ?>  			

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
    
 </body>
</html>