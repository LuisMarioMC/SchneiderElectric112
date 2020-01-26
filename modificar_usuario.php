<?php
 require_once ('controlador_modificar_usuario.php');
?>

<!DOCTYPE html>
<html lang="es">
 <head>
  <?php
   require_once ('metadatos.php');
   echo ' <title>Modificar Usuario</title>'; 
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
        Modificar Usuario
       </div>
       
	   <div class="panel-body">
	   
	    <ul class="nav nav-tabs">
		 <?php
		  echo'<li><a href="listar_usuario.php">Listar</a></li>';
		  echo'<li><a href="crear_usuario.php">Crear</a></li>';	      
		 ?>
		</ul>
	    <br>
	   
        <div class="row">         
		 
         <div class="col-lg-12">		 
		 
		  <form class="form-horizontal" role="form" name="formulario" action="modificar_usuario.php?id=<?php echo $id_modificar ?>" autocomplete="off" method="post" enctype="multipart/form-data">  

	       <div class="col-xs-12 col-sm-12 col-md-8 col-lg-4">
 			<div class="form-group">
			 <label>Nombre (*)</label>
             <input class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>" type="text" placeholder="Nombre" autofocus required/>
 			 <?php echo $error_nombre ?>			 
			</div>
		   </div>
	
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Correo Electr&oacute;nico (*)</label>
             <input class="form-control" id="correo_electronico" name="correo_electronico" type="email" title="Ingrese el Correo Electr&oacute;nico" value="<?php echo $correo_electronico ?>" placeholder="Correo Electr&oacute;nico" required/>
             <?php echo $error_correo_electronico ?>
			</div>
		   </div>
		   
		   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
 			<div class="form-group">
			 <label>Celular (*)</label>
             <input class="form-control" id="celular" name="celular" type="number" title="Ingrese el Celular" value="<?php echo $celular ?>" placeholder="Celular" required/>
             <?php echo $error_celular ?>
			</div>
		   </div>

		   <?php
			if($perfil == 'canal' || $perfil == 'linea' || $perfil == 'actividad')
			{
		     echo'<legend>'.$nombre_perfil.'</legend>';
		    }
		   ?>
		   
		   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 			<div class="form-group">
		     <?php
			  if($perfil == 'canal')
			  {
   			   echo'<label>Pa&iacute;s (*)</label>';
			   echo $menu_pais;
			  }
			  if($perfil == 'linea')
			  {
   			   echo'<label>L&iacute;nea (*)</label>';
			   echo $menu_linea;
			  }
			  if($perfil == 'actividad')
			  {
   			   echo'<label>Actividad (*)</label>';
			   echo $menu_actividad;
			  }
			 ?>
			</div>
		   </div>
		   
		   <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <button type="submit" class="btn btn-default">Modificar</button> 			
		   </div>
		
		  </form>

		  <?php
		   if($perfil == 'segmento' || $perfil == 'zona')
		   {
		    echo'<legend>'.$nombre_perfil.'</legend>';

		    echo'<div class="table-responsive">';
		    echo' <table class="table table-striped table-bordered table-hover" id="segmento_zona">';
		    echo'  <thead>';
		    echo'   <tr>';
		    echo $menu_listar;
		    echo'   </tr>';
		    echo'  </thead>';
		    echo'  <tfoot>';
		    echo'   <tr>';
		    echo $menu_listar;
		    echo'   </tr>';
		    echo'  </tfoot>';
		    echo'  <tbody>';
		    echo $listar;
		    echo'  </tbody>';
		    echo' </table>';
		    echo'</div>';

			echo'<br><br>';
			
            echo'<div class="row">';
            echo' <div class="col-lg-12">';
		    if($perfil == 'segmento')
		    {
			 echo'  <form class="form-horizontal" role="form" name="formulario" action="controlador_crear_segmento_usuario.php?id='.$id_modificar.'" autocomplete="off" method="post" enctype="multipart/form-data">';
		    }
		    if($perfil == 'zona')
		    {
			 echo'  <form class="form-horizontal" role="form" name="formulario" action="controlador_crear_zona_usuario.php?id='.$id_modificar.'" autocomplete="off" method="post" enctype="multipart/form-data">';
		    }			
		    echo'   <div id="opcion1" name="opcion1"></div>';
   		    echo'   <div id="opcion2" name="opcion2"></div>';
		    
			echo'   <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
            echo'   <button type="submit" class="btn btn-default">Crear</button>';		
		    echo'   </div>';
		
		    echo'  </form>';
			
			echo' </div>';
		    echo'</div>';
		   }
		  ?>
		 
		 </div>
         <!-- /.col-lg-12 -->		
        </div>
        <!-- /.row --> 
		      
		<?php echo $listar_mensaje ?>		

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
    $('#segmento_zona').dataTable({
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
  
  <script language="javascript">
   $(document).ready(function(){

	var perfil = '<?php echo $perfil;?>';
	data = '';
	$("#opcion1").html(data);
	$("#opcion2").html(data);
	if (perfil === "segmento") 
	{
	 $.post("controlador_dependiente_usuario2.php", { perfil: perfil, tipo: "pais" }, function(data){
	  $("#opcion1").html(data);
	 });
	 $.post("controlador_dependiente_usuario2.php", { perfil: perfil, tipo: "segmento" }, function(data){
	  $("#opcion2").html(data);
	 });
	}
	if (perfil === "zona") 
	{
	 $.post("controlador_dependiente_usuario2.php", { perfil: perfil, tipo: "pais" }, function(data){
	  $("#opcion1").html(data);
	 });
	 $.post("controlador_dependiente_usuario2.php", { perfil: perfil, tipo: "zona" }, function(data){
	  $("#opcion2").html(data);
	 });
	 $("#opcion1").change(function () {
	  $("#opcion1 option:selected").each(function () {
	   id_pais = $(this).val();
	   $.post("controlador_dependiente_usuario2.php", { perfil: perfil, tipo: "zona", id_pais: id_pais }, function(data){
	    $("#opcion2").html(data);
	   });			
	  });
	 });
	}
	
   });
  </script>
  
 </body>
</html>