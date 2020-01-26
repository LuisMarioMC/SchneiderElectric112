<?php
 require_once ('controlador_listar_producto.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
 
 <?php
  require_once ('metadatos.php');
  echo ' <title>Listar Producto</title>'; 
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
        Listar Producto
       </div>
	   
       <div class="panel-body">
	   
	    <ol class="breadcrumb">
		 <?php echo $miga_pan ?>
		</ol>
		
		<ul class="nav nav-tabs">
 		 <?php
		  echo'<li class="active"><a href="listar_producto.php">Listar</a></li>';
		  echo'<li><a href="crear_producto.php">Crear</a></li>';	      
		 ?>		
		</ul>
	    <br>
		
		<div class="row">
         <div class="col-lg-12">
		 
		  <form class="form-horizontal" role="form" name="formulario" action="listar_producto.php" autocomplete="off" method="post" enctype="multipart/form-data">
	
		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Referencia</label>
             <input class="form-control" id="referencia" name="referencia" type="text" title="Ingrese la Referencia" value="<?php echo $referencia ?>" placeholder="Referencia" autofocus>
			</div>
		   </div>

   		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Nombre</label>
             <input class="form-control" id="nombre" name="nombre" type="text" title="Ingrese el Nombre" value="<?php echo $nombre ?>" placeholder="Nombre">
			</div>
		   </div>
		   
           <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" class="btn btn-default">Buscar</button>
		   </div>
		   
		  </form>
		  
		 </div>
		</div>
		
	    <br>	   
        <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="producto">
          <thead>
           <tr>
		    <th></th>
		    <th>Referencia</th>
		    <th>Nombre</th>
		    <th>Actividad</th>
		    <th>Cantidad Indivisible</th>
			<th></th>
		   </tr>
          </thead>
		  <tfoot>
           <tr>
		    <th></th>
		    <th>Referencia</th>
		    <th>Nombre</th>
		    <th>Actividad</th>
		    <th>Cantidad Indivisible</th>
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
    $('#producto').dataTable({
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