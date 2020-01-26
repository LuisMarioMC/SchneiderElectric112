<?php
 require_once ('controlador_listar_detalle_sell_out.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
 
 <?php
  require_once ('metadatos.php');
  echo ' <title>Listar Detalle Sell Out</title>'; 
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
        Listar Detalle Sell Out
       </div>
	   
       <div class="panel-body">
	   
	   	<ol class="breadcrumb">
		 <li>Registros con error: <?php echo $registros_con_error ?></li>
		</ol>
	   	   
        <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="detalle_sell_out">
          <thead>
           <tr>
		    <th></th>
		    <th>Factura</th>
		    <th>Fecha Venta</th>
		    <th>Producto</th>
		    <th>Unidades</th>
		    <th>Precio</th>
		    <th>Tax ID</th>
		    <th>Nombre</th>
		    <th>Telefono</th>
		    <th>Email</th>
		    <th>Segmento</th>
		    <th>Ciudad</th>
		    <th>Vendedor</th>
		    <th>E-Commerce</th>
			  <th>Dirección</th>
        <th>Tipo de cliente</th>
		<th>Sucursal</th>				
			<th></th>
		   </tr>
          </thead>
		  <tfoot>
           <tr>
		    <th></th>
		    <th>Factura</th>
		    <th>Fecha Venta</th>
		    <th>Producto</th>
		    <th>Unidades</th>
		    <th>Precio</th>
		    <th>Tax ID</th>
		    <th>Nombre</th>
		    <th>Telefono</th>
		    <th>Email</th>
		    <th>Segmento</th>
		    <th>Ciudad</th>
		    <th>Vendedor</th>	
			  <th>E-Commerce</th>
			  <th>Dirección</th>
        <th>Tipo de cliente</th>
		<th>Sucursal</th>	
			<th></th>
		   </tr>
          </tfoot>
          <tbody>
           <?php echo $listar.$listar_mensaje?>
		  </tbody>
         </table>
        </div>
        <!-- /.table-responsive -->
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
  
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
	<div class="modal-content">
	 <div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	  <h4 class="modal-title" id="myModalLabel">Tax ID</h4>
	 </div>
	 <div class="modal-body">
	  <b>Nombre: </b><br>
	  <b>Tel&eacute;fono: </b><br>
	  <b>Email: </b><br>
	  <b>Segmento: </b><br>	  
	 </div>
	 <div class="modal-footer">
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	 </div>
	</div>
   </div>
  </div>

  <?php
   echo $modal;
   require_once ('librerias_javascript.php');
  ?>
  
  <script>
   $(document).ready(function() {
    $('#detalle_sell_out').dataTable({
	 <!-- Cantidad de registros por defecto //-->
	 "pageLength": 1000,
	 <!-- Ordenar por la columna 0 //-->
	 "order": [[ 0, "asc"]],
	 <!-- Guardar el estado de la Tabla //-->
	 <!--stateSave: true,-->
     <!-- Tipo de P�ginaci�n: Botones de Primero, Anterior, Siguiente, Ultimo y Numero de P�gina //-->
	 "pagingType" : "simple_numbers",
	 
     <!-- Configuraci�n de P�ginaci�n //-->
	 "lengthMenu" : [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
	 	 
	 columnDefs: [ {
	  targets: [ 0 ],
	  <!-- Ordenar por la columna 0, luego la 1 //-->
      orderData: [ 0, 1 ] 
	 }
	 ]
    });
 
	// PopOver
    $('[data-toggle="popover"]').popover();
	
   });

  </script>
 </body>
</html>