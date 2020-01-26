<?php
  
 $error = 0;
 $crear = 0;
 
 $nombre = '';
 $id_linea = '';
 $sell_out = 0;
 $sell_out_checked = '';
 
 require_once ('conexion_sesion.php');
 
 if($_POST)
 {
  $nombre = trim(mysqli_real_escape_string($conexion,$_POST['nombre']));
  $id_linea = trim(mysqli_real_escape_string($conexion,$_POST['id_linea']));
  $sell_out = isset($_POST['sell_out']) ? $_POST['sell_out'] : '0';
  
  $error_nombre = '';
  $error_linea = '';
  $error_sell_out = '';
  
  if($nombre == '')
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nombre.</div>';
   $error = 1;
  }
  if($id_linea == '')
  {
   $error_linea = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar L&iacute;nea.</div>';
   $error = 1;
  }
  
  require_once ('modelo_crear_actividad.php');
    
  if($crear)
  {
   $modulo = 2;
   $accion = 'CREAR';
   $id_afectado = mysqli_insert_id($conexion);
   $descripcion = 'Crear Actividad '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 21;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_actividad.php?m='.$mensaje.'"</script>';
  }
  else
  {
   if($sell_out == 1)
   {
    $sell_out_checked = 'checked';	
   }
  
   $mensaje = 22;
  }
  require_once ('mensajes_actividad.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_crear_actividad.php');  
 }
 
 $menu_linea = '<select id="id_linea" name="id_linea" class="form-control" required/>';
 $menu_linea .= '<option value = ""> Seleccionar ';
 if($cantidad_linea != 1)
 {
  foreach($lineas as $linea)
  { 
   if($id_linea == $linea['id'])
   {
    $menu_linea .= ' <option value = '.$linea['id'].' selected> '.$linea['nombre'].'</option>';
   }
   else
   {
    $menu_linea .= ' <option value = '.$linea['id'].'> '.$linea['nombre'].'</option>';
   }
  }
 }
 $menu_linea .= '</select>';

 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Actividad</li>';
  
?>