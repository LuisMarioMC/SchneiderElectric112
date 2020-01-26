<?php
 require_once ('controlador_crear_segmento.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Crear Segmento</title>'; 
   require_once ('librerias_css.php');
   require_once ('funciones_javascript_segmento.php');
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
        Crear Segmento
       </div>
       
	   <div class="panel-body">
	   
	    <ol class="breadcrumb">
		 <?php echo $miga_pan ?>
		</ol>
	   
	    <ul class="nav nav-tabs">
		 <?php
		  echo'<li><a href="listar_segmento.php">Listar</a></li>';
		  echo'<li class="active"><a href="crear_segmento.php">Crear</a></li>';
		 ?>
	    </ul>
	    <br>
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="crear_segmento.php" autocomplete="off" method="post" enctype="multipart/form-data">  
	
		   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 			<div class="form-group">
			 <label>Nombre</label>
             <input class="form-control" id="nombre" name="nombre" type="text" title="Ingrese el Nombre" value="<?php echo $nombre ?>" placeholder="Nombre" autofocus required/>
             <?php echo $error_nombre ?>
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
  
 </body>
</html>