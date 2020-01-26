<?php
 require_once ('controlador_recuperar_contrasenia.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100" rel="stylesheet" type="text/css">
  <style> 
   .fuente_negra{
    color: #000000;
    font-family: 'Roboto Slab';
    font-size: 15px;
    font-weight: 300;
    line-height: 25px;
    text-align: center;
   } 
   .fuente_negra2{
    color: #000000;
    font-family: 'Roboto Slab';
    font-size: 25px;
    font-weight: 300;
    line-height: 25px;
    text-align: center;
   } 

  </style>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Schneider Electrict</title>'; 
   require_once ('librerias_css.php');
   require_once ('funciones_javascript_principal.php');
  ?>
 </head>

  <body class="green-bg">
  
  <div class="container">
   <div class="row">
    <div class="col-md-4 col-md-offset-4">
     <img class="login-logo" src="img/logo-green.png">
     <div class="login-panel panel panel-default">
      <div align="center" class="panel-heading">
       <h3 class="panel-title green-txt"><i class="fa fa-user fa-fw"></i><b>Inicio de Sesi&oacute;n</b></h3>
      </div>
      <div class="panel-body">
       <form action="recuperar_contrasenia.php" method="post">
        <fieldset>
         <div class="form-group">
          <input class="form-control" placeholder="Correo Electr&oacute;nico" name="correo_electronico" title="Introduce tu E-mail." type="text" value="<?php echo $correo_electronico ?>" autofocus required/>
         </div>
		 <?php
		 if($error1 == 1)
		 {
		  echo'<div class="alert alert-danger alert-dismissable">';
          echo' <button type="button" class="close" data-dismiss="alert">&times;</button>';
          echo' El Correo Electr&oacute;nico que has ingresado no esta registrado en nuestro sistema.';
          echo'</div>';
		 }
		 ?>
         
		 <input class="btn btn-lg btn-success btn-block" name="recuperar_contrasenia" type="submit" value="Recuperar Contrase&ntilde;a">

        </fieldset>
       </form>
      </div>
     </div>
    </div>
   </div>

   <div class="row">
    <div class="col-md-4 col-md-offset-4 login-platform">
     <h2><b>Bienvenido al Sistema de </b></h2>
     <h1>Gestión de Canales Schneider</h1>
    </div>
   </div>
   
   <?php echo $listar_mensaje ?>
  
  </div>

  <div class="gray-bg">
   <!-- Green bg -->
  </div>

  <?php
   require_once ('librerias_javascript.php');
  ?>

 </body>
</html>