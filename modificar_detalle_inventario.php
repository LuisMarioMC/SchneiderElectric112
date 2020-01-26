<?php
 require_once ('controlador_modificar_detalle_inventario.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Modificar Detalle Inventario</title>'; 
   require_once ('librerias_css.php');
   require_once ('funciones_javascript_detalle_inventario.php');
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
        Modificar Detalle Inventario
       </div>
       
	   <div class="panel-body">
	   
	    <ul class="nav nav-tabs">
		 <?php
		  echo'<li><a href="listar_detalle_inventario.php?id='.$id_reporte_inventario.'">Listar</a></li>';
		 ?>
		</ul>
	    <br>
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="modificar_detalle_inventario.php?id=<?php echo $id_modificar ?>" autocomplete="off" method="post" enctype="multipart/form-data">  
		   		 
		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Producto</label>
             <input class="form-control" id="producto" name="producto" type="text" title="Ingrese el Producto" value="<?php echo $producto ?>" placeholder="Producto" required/>
             <?php echo $error_producto ?>
			</div>
		   </div>
				 
		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Unidades</label>
             <input class="form-control" id="unidades" name="unidades" type="text" title="Ingrese las Unidades" value="<?php echo $unidades ?>" placeholder="Unidades" required/>
             <?php echo $error_unidades ?>
			</div>
		   </div>

         <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Sucursal</label>
             <input class="form-control" id="sucursal" name="sucursal" type="text" title="Sucursal" value="<?php echo $sucursal ?>" placeholder="Sucursal" />
             <?php echo $error_sucursal ?>
			</div>
		   </div>

         <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>M1</label>
             <input class="form-control" id="m1" name="m1" type="text" title="M1" value="<?php echo $m1 ?>" placeholder="M1" />
             <?php echo $error_m1 ?>
			</div>
		   </div>

         <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>M2</label>
             <input class="form-control" id="m2" name="m2" type="text" title="M2" value="<?php echo $m2 ?>" placeholder="M2" />
             <?php echo $error_m2 ?>
			</div>
		   </div>

         <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>M3</label>
             <input class="form-control" id="m3" name="m3" type="text" title="M3" value="<?php echo $m3 ?>" placeholder="M3" />
             <?php echo $error_m3 ?>
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