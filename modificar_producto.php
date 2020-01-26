<?php
 require_once ('controlador_modificar_producto.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Modificar Producto</title>';
   require_once ('librerias_css.php');
   require_once ('funciones_javascript_producto.php');
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
        Modificar Producto
       </div>
       
	   <div class="panel-body">
	   
	    <ol class="breadcrumb">
		 <?php echo $miga_pan ?>
		</ol>
	   
	    <ul class="nav nav-tabs">
		 <?php
		  echo'<li><a href="listar_producto.php">Listar</a></li>';
		  echo'<li><a href="crear_producto.php">Crear</a></li>';	      
		 ?>
		</ul>
	    <br>
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="modificar_producto.php?id=<?php echo $id_modificar ?>" autocomplete="off" method="post" enctype="multipart/form-data">  

		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Referencia</label>
             <input class="form-control" id="referencia" name="referencia" type="text" title="Ingrese la Referencia" value="<?php echo $referencia ?>" placeholder="Referencia" autofocus required/>
			</div>
		   </div>
	
		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Nombre</label>
             <input class="form-control" id="nombre" name="nombre" type="text" title="Ingrese el Nombre" value="<?php echo $nombre ?>" placeholder="Nombre" required/>
			</div>
		   </div>
		   		
		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Actividad</label>
             <?php echo $menu_actividad ?>
			</div>
		   </div>
				
		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Cantidad Indivisible</label>
             <input class="form-control" id="cant_indi" name="cant_indi" type="text" title="Ingrese la Cantidad Indivisible" value="<?php echo $cant_indi ?>" placeholder="Cantidad Indivisible" required/>
			</div>
		   </div>
		   
		   <legend>Paises</legend>

		   <?php echo $seleccionar_paises ?>
		    
		   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 			<div class="form-group">
             <?php
			  echo $error_referencia;
			  echo $error_nombre;
			  echo $error_actividad;
			  echo $error_cant_indi;
			 ?>
			</div>
		   </div>
		   
		   <?php echo $listar_mensaje ?>
		   
           <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" class="btn btn-default">Modificar</button> 			
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