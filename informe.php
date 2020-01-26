<?php
 require_once ('controlador_informe.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Informe</title>'; 
   require_once ('librerias_css.php');
   require_once ('funciones_javascript_informe.php');
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
        Informe
       </div>
       
	   <div class="panel-body">
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="informe.php" autocomplete="off" method="post" enctype="multipart/form-data">  
	
		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Fecha Inicial</label>
             <input class="form-control" id="fecha_inicial" name="fecha_inicial" type="date" title="Ingrese la Fecha Inicial" value="<?php echo $fecha_inicial ?>" placeholder="Fecha Inicial" autofocus required>
			</div>
		   </div>
		   	
		   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
 			<div class="form-group">
			 <label>Fecha Final</label>
             <input class="form-control" id="fecha_final" name="fecha_final" type="date" title="Ingrese la Fecha Final" value="<?php echo $fecha_final ?>" placeholder="Fecha Final" required>
			</div>
		   </div>

		   <?php echo $listar_mensaje ?>
		   
           <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" class="btn btn-default">Obtener Informe</button> 			
		   </div>
			
		  </form>
			
		 </div>
         <!-- /.col-lg-12 -->		
        </div>
        <!-- /.row -->
		
		<div class="row"> 
         <div class="col-lg-12">		 
		  <?php echo $resultado; ?>
		 </div>
		</div>
		 
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