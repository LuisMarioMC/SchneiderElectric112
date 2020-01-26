<?php
 require_once ('controlador_auditoria_q.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
 
 <?php
  require_once ('metadatos.php');
  echo ' <title>Auditoria Q</title>'; 
  require_once ('librerias_css.php');
  require_once ('funciones_javascript_q.php');
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
        Auditoria <?php echo $nombre_q?>
       </div>
	   
       <div class="panel-body">
	   
	    <ol class="breadcrumb">
		 <?php echo $miga_pan ?>
		</ol>
		
        <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="auditoria_q">
          <thead>
           <tr>
		    <th>#</th>
		    <th>Acci&oacute;n</th>
		    <th>Usuario</th>
		    <th>Perfil</th>
		    <th>Fecha</th>
		    <th>Hora</th>
		   </tr>
          </thead>
		  <tfoot>
           <tr>
		    <th>#</th>
		    <th>Acci&oacute;n</th>
		    <th>Usuario</th>
		    <th>Perfil</th>
		    <th>Fecha</th>
		    <th>Hora</th>
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
    $('#auditoria_q').dataTable({	 
	 <!-- Ordenar por la columna 0 //-->
	 "order": [[ 0, "desc"]],
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