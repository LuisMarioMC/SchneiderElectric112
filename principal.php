<?php
 require_once ('controlador_principal.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  
 <?php
  require_once ('metadatos.php');
  echo ' <title>Schneider Electric</title>';
  echo ' <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">';
  require_once ('librerias_css.php');
  require_once ('funciones_javascript_principal.php');
 ?>

 </head>
 
 <body>
  <div class="loader"></div>
  <div id="datos"></div>
  
  <div id="wrapper">
  
   <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0"> 
    <?php require_once ('menu_superior.php'); require_once ('menu_lateral.php');?>
   </nav>
   
   <div id="page-wrapper">

    <div class="row">
	 <div class="col-lg-12">
      <br>
	  <?php 
	   echo $miga_pan;
	  ?>
     </div> 
    </div>
   
    <?php 
	 echo $listar;
	 echo $listar_mensaje;	 
	?>
	 
   </div>
   
  </div>
 
  <?php
   require_once ('librerias_javascript.php');
  ?>
  
  <script language="javascript">
   $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    $("#filtrar").click(function () {
     $('#datos').html('<center> <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></center>')
    });
   });
  </script>
  
  <script type="text/javascript">
   $(window).load(function() {
    $(".loader").fadeOut("slow");
   });
  </script>
    
  <?php
   echo $jquery;
  ?>
  
 </body>
</html>