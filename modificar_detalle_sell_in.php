<?php
 require_once ('controlador_modificar_detalle_sell_in.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Modificar Detalle Sell In</title>'; 
   require_once ('librerias_css.php');
   require_once ('funciones_javascript_detalle_sell_in.php');
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
        Modificar Detalle Sell In
       </div>
       
	   <div class="panel-body">
	   
	    <ul class="nav nav-tabs">
		 <?php
		  echo'<li><a href="listar_detalle_sell_in.php?id='.$id_reporte_compras.'">Listar</a></li>';
		 ?>
		</ul>
	    <br>
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="modificar_detalle_sell_in.php?id=<?php echo $id_modificar ?>" autocomplete="off" method="post" enctype="multipart/form-data">  

   		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Nombre Distribuidor</label>
             <input class="form-control" id="nombre_distribuidor" name="nombre_distribuidor" type="text" title="Ingrese el Nombre del Distribuidor" value="<?php echo $nombre_distribuidor ?>" placeholder="Nombre Distribuidor" required/>
             <?php echo $error_nombre_distribuidor ?>
			</div>
		   </div>
		   		 
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Producto</label>
             <input class="form-control" id="producto" name="producto" type="text" title="Ingrese el Producto" value="<?php echo $producto ?>" placeholder="Producto" required/>
             <?php echo $error_producto ?>
			</div>
		   </div>
				 
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Unidades</label>
             <input class="form-control" id="unidades" name="unidades" type="text" title="Ingrese las Unidades" value="<?php echo $unidades ?>" placeholder="Unidades" required/>
             <?php echo $error_unidades ?>
			</div>
		   </div>

		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Precio</label>
             <input class="form-control" id="precio" name="precio" type="text" title="Ingrese el Precio" value="<?php echo $precio ?>" placeholder="Precio" required/>
             <?php echo $error_precio ?>
			</div>
		   </div>

		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Factura</label>
             <input class="form-control" id="factura" name="factura" type="text" title="Ingrese la Factura" value="<?php echo $factura ?>" placeholder="Factura" required/>
             <?php echo $error_factura ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Fecha Compra</label>
             <input class="form-control" id="fecha_compra" name="fecha_compra" type="text" title="Ingrese la Fecha Compra" value="<?php echo $fecha_compra ?>" placeholder="Fecha Compra" required/>
             <?php echo $error_fecha_compra ?>
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