<?php
  
 $error = 0;
 $crear = 0;
 
 $referencia = '';
 $nombre = '';
 $id_actividad = 0;
 $cant_indi = '';
 
 require_once ('conexion_sesion.php');
 
 if($_POST)
 {
  $referencia = trim(mysqli_real_escape_string($conexion,$_POST['referencia']));
  $nombre = trim(mysqli_real_escape_string($conexion,$_POST['nombre']));
  $id_actividad = isset($_POST['id_actividad']) ? $_POST['id_actividad'] : '0';
  $cant_indi = trim(mysqli_real_escape_string($conexion,$_POST['cant_indi']));
  
  $error_referencia = '';
  $error_nombre = '';
  $error_id_actividad = '';
  $error_cant_indi = '';
  
  if($referencia == '')
  {
   $error_referencia = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Referencia.</div>';
   $error = 1;
  }
  if($nombre == '')
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nombre.</div>';
   $error = 1;
  }
  if($id_actividad == '')
  {
   $error_actividad = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Actividad.</div>';
   $error = 1;
  }
  if($cant_indi == '')
  {
   $error_cant_indi = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Cantidad Indivisible.</div>';
   $error = 1;
  }
  
  require_once ('modelo_crear_producto.php');
    
  if($crear)
  {
   $modulo = 2;
   $accion = 'CREAR';
   $id_afectado = mysqli_insert_id($conexion);
   $descripcion = 'Crear Actividad '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 21;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_producto.php?m='.$mensaje.'"</script>';
  }
  else
  {  
   $mensaje = 22;
  }
  require_once ('mensajes_producto.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_crear_producto.php');  
 }
 
 $menu_actividad = '<select id="id_actividad" name="id_actividad" class="form-control" required/>';
 $menu_actividad .= '<option value = ""> Seleccionar ';
 if($cantidad_actividad != 1)
 {
  foreach($actividades as $actividad)
  { 
   if($id_actividad == $actividad['id'])
   {
    $menu_actividad .= ' <option value = '.$actividad['id'].' selected> '.$actividad['nombre'].'</option>';
   }
   else
   {
    $menu_actividad .= ' <option value = '.$actividad['id'].'> '.$actividad['nombre'].'</option>';
   }
  }
 }
 $menu_actividad .= '</select>';

 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Producto</li>';
 
 $seleccionar_paises = '';
 if($cantidad_pais != 1)
 {
  foreach($paises as $pais)
  {
   $seleccionar_paises .= '<div class="row">';
		 
   $seleccionar_paises .= ' <div class="col-lg-12">';

   $seleccionar_paises .= '  <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">';
   $seleccionar_paises .= '   <div class="form-group">';
   $seleccionar_paises .= '    <label>'.$pais['nombre'].'</label>';
   $seleccionar_paises .= '   </div>';
   $seleccionar_paises .= '  </div>';
		   
   $seleccionar_paises .= '  <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">';
   $seleccionar_paises .= '   <div class="form-group">';
   $seleccionar_paises .= '    <input class="form-control" id="'.$pais['nombre'].'" name="'.$pais['nombre'].'" type="checkbox" value="'.$pais['id'].'" '.$pais['check'].'>';
   $seleccionar_paises .= '   </div>';
   $seleccionar_paises .= '  </div>';
  
   $seleccionar_paises .= '  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">';
   $seleccionar_paises .= '   <div class="form-group">';
   $seleccionar_paises .= '    <br>';
   $seleccionar_paises .= '   </div>';
   $seleccionar_paises .= '  </div>';

   $seleccionar_paises .= ' </div>';
   $seleccionar_paises .= '</div>';   
  }
 }
?>