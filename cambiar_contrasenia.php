<?php
 require_once ('controlador_cambiar_contrasenia.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Cambiar Contrase&ntilde;a</title>'; 
   require_once ('librerias_css.php');
   require_once ('funciones_javascript_cambiar_contrasenia.php');
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
        Cambiar Contrase&ntilde;a
       </div>
       
	   <div class="panel-body">
	   
        <div class="row">
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" onsubmit="return checkform($('#pswd').val());" role="form" name="formulario" action="cambiar_contrasenia.php" autocomplete="off" method="post" enctype="multipart/form-data">
	
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="form-group">
			 <label>Contrase&ntilde;a Actual</label>
			 <input id="contrasenia1" class="form-control" placeholder="Contrase&ntilde;a Actual" name="contrasenia1" title="Ingresa tu contrase&ntilde;a actual." type="password" value="<?php echo $contrasenia1 ?>" autofocus required/>
             <?php echo $error_contrasenia1 ?>
			</div>
		   </div>

		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label for="pswd">Nueva Contrase&ntilde;a</label>
			 <input id="pswd" class="form-control" placeholder="Nueva Contrase&ntilde;a" name="contrasenia2" title="Ingresa tu nueva contrase&ntilde;a." type="password" value="<?php echo $contrasenia2 ?>" required/>
             <?php echo $error_contrasenia2 ?>
			 
			 <div id="pswd_info">
		      <h4>La contrase&ntilde;a debe cumplir con los siguientes requisitos:</h4>
		      <ul>
		 	   <li id="letter" class="invalid">Al menos <strong>una letra</strong></li>
	 		   <li id="capital" class="invalid">Al menos <strong>una letra may&uacute;scula</strong></li>
			   <li id="number" class="invalid">Al menos <strong>un numero</strong></li>
			   <li id="length" class="invalid">Tener al menos <strong>8 caracteres</strong></li>
		      </ul>
		     </div>

			</div>
		   </div>
			 
 		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Repetir Nueva Contrase&ntilde;a</label>
			 <input class="form-control" placeholder="Repetir Nueva Contrase&ntilde;a" name="contrasenia3" title="Ingresa tu nueva contrase&ntilde;a." type="password" value="<?php echo $contrasenia3 ?>" required/>
             <?php echo $error_contrasenia3 ?>
			</div>
		   </div>
		   
   		   <?php echo $listar_mensaje ?>
		   
           <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" class="btn btn-default">Cambiar Contrase&ntilde;a</button>
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