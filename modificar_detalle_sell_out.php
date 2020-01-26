<?php
 require_once ('controlador_modificar_detalle_sell_out.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Modificar Detalle Sell Out</title>'; 
   require_once ('librerias_css.php');
   require_once ('funciones_javascript_detalle_sell_out.php');
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
        Modificar Detalle Sell Out
       </div>
       
	   <div class="panel-body">
	   
	    <ul class="nav nav-tabs">
		 <?php
		  echo'<li><a href="listar_detalle_sell_out.php?id='.$id_reporte_ventas.'">Listar</a></li>';
		 ?>
		</ul>
	    <br>
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="modificar_detalle_sell_out.php?id=<?php echo $id_modificar ?>" autocomplete="off" method="post" enctype="multipart/form-data">  

		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Factura</label>
             <input class="form-control" id="factura" name="factura" type="text" title="Ingrese la Factura" value="<?php echo $factura ?>" placeholder="Factura" required/>
             <?php echo $error_factura ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Fecha Venta</label>
             <input class="form-control" id="fecha_venta" name="fecha_venta" type="text" title="Ingrese la Fecha Venta" value="<?php echo $fecha_venta ?>" placeholder="Fecha Venta" required/>
             <?php echo $error_fecha_venta ?>
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
			 <label>TAX ID Cliente</label>
             <input class="form-control" id="taxid_cliente" name="taxid_cliente" type="text" title="Ingrese el TAX ID del Cliente" value="<?php echo $taxid_cliente ?>" placeholder="TAX ID" required/>
             <?php echo $error_taxid_cliente ?>
			</div>
		   </div>
		   
   		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Nombre Cliente</label>
             <input class="form-control" id="nombre_cliente" name="nombre_cliente" type="text" title="Ingrese el Nombre del Cliente" value="<?php echo $nombre_cliente ?>" placeholder="Nombre">
             <?php echo $error_nombre_cliente ?>
			</div>
		   </div>
		   
   		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Telefono Cliente</label>
             <input class="form-control" id="telefono_cliente" name="telefono_cliente" type="text" title="Ingrese el Telefono del Cliente" value="<?php echo $telefono_cliente ?>" placeholder="Telefono">
             <?php echo $error_telefono_cliente ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Email Cliente</label>
             <input class="form-control" id="email_cliente" name="email_cliente" type="text" title="Ingrese el Email del Cliente" value="<?php echo $email_cliente ?>" placeholder="Email">
             <?php echo $error_email_cliente ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Segmento</label>
             <input class="form-control" id="segmento" name="segmento" type="text" title="Ingrese el Segmento del Cliente" value="<?php echo $segmento ?>" placeholder="Segmento" />
             <?php echo $error_segmento ?>
			</div>
		   </div>
				 
		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Ciudad</label>
             <input class="form-control" id="ciudad" name="ciudad" type="text" title="Ingrese la Ciudad" value="<?php echo $ciudad ?>" placeholder="Ciudad" required/>
             <?php echo $error_ciudad ?>
			</div>
		   </div>
				 
		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Vendedor</label>
             <input class="form-control" id="vendedor" name="vendedor" type="text" title="Ingrese el Vendedor" value="<?php echo $vendedor ?>" placeholder="Vendedor" required/>
             <?php echo $error_vendedor ?>
			</div>
		   </div>

		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>E-Commerce</label>
             <input class="form-control" id="e_commerce" name="e_commerce" type="text" title="Ingrese si la Venta fue por E-Commerce" value="<?php echo $e_commerce ?>" placeholder="E-Commerce">
             <?php echo $error_e_commerce ?>
			</div>
		   </div>

      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
        <label>Dirección</label>
          <input class="form-control" id="direccion" name="direccion" type="text" title="Ingrese la dirección" value="<?php echo $direccion ?>" placeholder="Dirección">
          <?php echo $error_direccion ?>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
        <label>Tipo de cliente</label>
          <input class="form-control" id="tipo_cliente" name="tipo_cliente" type="text" title="Ingrese el tipo de cliente" value="<?php echo $tipo_cliente ?>" placeholder="Tipo de Cliente" required>
          <?php echo $error_tipo_cliente ?>
        </div>
      </div>
	  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
        <label>Sucursal</label>
          <input class="form-control" id="sucursal" name="sucrusal" type="text" title="Ingrese sucursal" value="<?php echo $sucursal ?>" placeholder="Sucursal" required>
          <?php echo $errror_sucursal ?>
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