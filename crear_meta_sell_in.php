<?php
 require_once ('controlador_crear_meta_sell_in.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Crear Meta Sell In</title>'; 
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
        Crear Meta Sell In
       </div>
       
	   <div class="panel-body">
	   
	    <ol class="breadcrumb">
		 <?php echo $miga_pan ?>
		</ol>
	   
	    <ul class="nav nav-tabs">
		 <?php
		  echo'<li><a href="listar_meta_sell_in.php">Listar</a></li>';
		  echo'<li class="active"><a href="crear_meta_sell_in.php">Crear</a></li>';
		 ?>
	    </ul>
	    <br>
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="crear_meta_sell_in.php" autocomplete="off" method="post" enctype="multipart/form-data">  
	
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Distribuidor</label>
             <?php echo $menu_distribuidor ?>
			</div>
		   </div>
		   		
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>A&ntilde;o</label>
             <?php echo $menu_anio ?>
			</div>
		   </div>
				
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>L&iacute;nea</label>
             <?php echo $menu_linea ?>
			</div>
		   </div>

		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Meta Q1</label>
             <input class="form-control" id="q1" name="q1" type="number" title="Ingrese la Meta del Q1" value="<?php echo $q1 ?>" placeholder="Q1" required/>
			</div>
		   </div>

		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Meta Q2</label>
             <input class="form-control" id="q2" name="q2" type="number" title="Ingrese la Meta del Q2" value="<?php echo $q2 ?>" placeholder="Q2" required/>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Meta Q3</label>
             <input class="form-control" id="q3" name="q3" type="number" title="Ingrese la Meta del Q3" value="<?php echo $q3 ?>" placeholder="Q3" required/>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
 			<div class="form-group">
			 <label>Meta Q4</label>
             <input class="form-control" id="q4" name="q4" type="number" title="Ingrese la Meta del Q4" value="<?php echo $q4 ?>" placeholder="Q4" required/>
			</div>
		   </div>

		   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 			<div class="form-group">
			 <?php
			  echo $error_distribuidor;
			  echo $error_anio;
			  echo $error_linea;
			  echo $error_q1;
			  echo $error_q2;
			  echo $error_q3;
			  echo $error_q4;			  
			 ?>
			</div>
		   </div>
		   
		   <?php echo $listar_mensaje ?>
		   
           <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" class="btn btn-default">Crear</button> 			
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