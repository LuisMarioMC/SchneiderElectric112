<?php
 require_once ('controlador_listar_usuario.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
 
 <?php
  require_once ('metadatos.php');
  echo ' <title>Listar Usuarios</title>'; 
  require_once ('librerias_css.php');
  require_once ('funciones_javascript_usuario.php');
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
        Listar Usuario
       </div>
	   
       <div class="panel-body">
	   
	    <ol class="breadcrumb">
         <?php echo $miga_pan ?>
		</ol>
		
		<ul class="nav nav-tabs">
		 <?php
		  echo'<li class="active"><a href="listar_usuario.php">Listar</a></li>';
		  echo'<li><a href="crear_usuario.php">Crear</a></li>';	      
		 ?>
	    </ul>
	    <br>
	   
        <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="usuario">
          <thead>
           <tr>
            <?php echo $menu_listar ?>
		   </tr>
          </thead>
		  <tfoot>
           <tr>
            <?php echo $menu_listar ?>            
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
    $('#usuario').dataTable({
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