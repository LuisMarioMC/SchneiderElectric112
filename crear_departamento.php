<?php
 require_once ('controlador_crear_departamento.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Crear Departamento</title>'; 
   require_once ('librerias_css.php');
   require_once ('funciones_javascript_departamento.php');
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
        Crear Departamento
       </div>
       
	   <div class="panel-body">
	   
	    <ol class="breadcrumb">
		 <?php echo $miga_pan ?>
		</ol>
	   
	    <ul class="nav nav-tabs">
		 <?php
		  echo'<li><a href="listar_departamento.php">Listar</a></li>';
		  echo'<li class="active"><a href="crear_departamento.php">Crear</a></li>';
		 ?>
	    </ul>
	    <br>
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="crear_departamento.php" autocomplete="off" method="post" enctype="multipart/form-data">  
	
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Nombre</label>
             <input class="form-control" id="nombre" name="nombre" type="text" title="Ingrese el Nombre" value="<?php echo $nombre ?>" placeholder="Nombre" autofocus required/>
			</div>
		   </div>
		   		
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Pa&iacute;s</label>
             <?php echo $menu_pais ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Zona</label>
             <?php echo $menu_zona ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 			<div class="form-group">
             <?php
			  echo $error_nombre;
			  echo $error_pais;
			  echo $error_zona;
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

  <script>  
   $(document).ready(function(){
   	
    $("#pais").change(function () {
	 $("#pais option:selected").each(function () {
	  id_pais = $(this).val();
	  $.post("controlador_dependiente_departamento.php", { id_pais: id_pais }, function(data){
	   $("#zona").html(data);
	  });			
	 });
    })
	
	var id_pais = '<?php echo $id_pais;?>';
    var id_zona = '<?php echo $id_zona;?>';
   
    if (id_pais != "" || id_pais != 0) {   
     $.post("controlador_dependiente_departamento.php", { id_pais: id_pais, id_zona: id_zona }, function(data){
      $("#zona").html(data);
     });
    }

   });
  </script>
  
 </body>
</html>