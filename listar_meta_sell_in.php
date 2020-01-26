<?php
 require_once ('controlador_listar_meta_sell_in.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
 
 <?php
  require_once ('metadatos.php');
  echo ' <title>Listar Meta Sell In</title>'; 
  require_once ('librerias_css.php');
  require_once ('funciones_javascript_meta_sell_in.php');
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
        Listar Meta Sell In
       </div>
	   
       <div class="panel-body">
	   
	    <ol class="breadcrumb">
		 <?php echo $miga_pan ?>
		</ol>
		
		<ul class="nav nav-tabs">
 		 <?php
		  echo'<li class="active"><a href="listar_meta_sell_in.php">Listar</a></li>';
		  echo'<li><a href="crear_meta_sell_in.php">Crear</a></li>';	      
		 ?>		
		</ul>
	    <br>
	   
        <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="meta_sell_in">
          <thead>
           <tr>
		    <th>Distribuidor</th>
		    <th>A&ntilde;o</th>
			<th>L&iacute;nea</th>
			<th>Q1</th>
			<th>Q2</th>
			<th>Q3</th>
			<th>Q4</th>
			<th></th>
		   </tr>
          </thead>
		  <tfoot>
           <tr>
		    <th>Distribuidor</th>
		    <th>A&ntilde;o</th>
			<th>L&iacute;nea</th>
			<th>Q1</th>
			<th>Q2</th>
			<th>Q3</th>
			<th>Q4</th>
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

  <?php
   require_once ('librerias_javascript.php');
  ?>
  
  <script>
   $(document).ready(function() {
    $('#meta_sell_in').dataTable({
	 <!-- Ordenar por la columna 0 //-->
	 "order": [[ 0, "asc"]],
	 <!-- Guardar el estado de la Tabla //-->
	 <!--stateSave: true,-->
     <!-- Tipo de Páginación: Botones de Primero, Anterior, Siguiente, Ultimo y Numero de Página //-->
	 "pagingType" : "simple_numbers",
	 
     <!-- Configuración de Páginación //-->
	 "lengthMenu" : [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
	 	 
	 columnDefs: [ {
	  targets: [ 0 ],
	  <!-- Ordenar por la columna 0, luego la 1 //-->
      orderData: [ 0, 1 ] 
	 }
	 ]
    });
   });
  </script>
 </body>
</html>