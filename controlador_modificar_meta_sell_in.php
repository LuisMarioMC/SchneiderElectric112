<?php
 
 $error = 0;
 $modificar = 0;
 
 $id_distribuidor = '';
 $id_anio = '';
 $id_linea = '';
 $q1 = '';
 $q2 = '';
 $q3 = '';
 $q4 = '';
   
 require_once ('conexion_sesion.php'); 
  
 if($_POST)
 {
  $id_distribuidor = trim(mysqli_real_escape_string($conexion,$_POST['id_distribuidor']));
  $id_anio = trim(mysqli_real_escape_string($conexion,$_POST['id_anio']));
  $id_linea = trim(mysqli_real_escape_string($conexion,$_POST['id_linea']));
  
  $q1 = trim(mysqli_real_escape_string($conexion,$_POST['q1']));
  $q2 = trim(mysqli_real_escape_string($conexion,$_POST['q2']));
  $q3 = trim(mysqli_real_escape_string($conexion,$_POST['q3']));
  $q4 = trim(mysqli_real_escape_string($conexion,$_POST['q4']));
    
  $error_distribuidor = '';
  $error_anio = '';
  $error_linea = '';
  $error_q1 = '';
  $error_q2 = '';
  $error_q3 = '';
  $error_q4 = '';
  
  if($id_distribuidor == '')
  {
   $error_distribuidor = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Distribuidor.</div>';
   $error = 1;
  }
  if($id_anio == '')
  {
   $error_anio = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar A&ntilde;o.</div>';
   $error = 1;
  }
  if($id_linea == '')
  {
   $error_linea = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar L&iacute;nea.</div>';
   $error = 1;
  }
  if($q1 == '')
  {
   $error_q1 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Q1.</div>';
   $error = 1;
  }
  if($q2 == '')
  {
   $error_q2 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Q2.</div>';
   $error = 1;
  }  
  if($q3 == '')
  {
   $error_q3 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Q3.</div>';
   $error = 1;
  }  
  if($q4 == '')
  {
   $error_q4 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Q4.</div>';
   $error = 1;
  }  
 
  require_once ('modelo_modificar_meta_sell_in.php');
    
  if($modificar)
  {
   $modulo = 2;
   $accion = 'MODIFICAR';
   $id_afectado = $id_modificar;
   $descripcion = 'Modificar Linea'.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_meta_sell_in.php?m='.$mensaje.'"</script>';
  }
  else
  {
   $mensaje = 32; 
  }
  require_once ('mensajes_meta_sell_in.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_modificar_meta_sell_in.php');
 }
 
 $menu_distribuidor = '<select id="id_distribuidor" name="id_distribuidor" class="form-control" required/ autofocus/>';
 $menu_distribuidor .= '<option value = ""> Seleccionar ';
 if($cantidad_distribuidor != 1)
 {
  foreach($distribuidores as $distribuidor)
  { 
   if($id_distribuidor == $distribuidor['id'])
   {
    $menu_distribuidor .= ' <option value = '.$distribuidor['id'].' selected> '.$distribuidor['nombre'].'</option>';
   }
   else
   {
    $menu_distribuidor .= ' <option value = '.$distribuidor['id'].'> '.$distribuidor['nombre'].'</option>';
   }
  }
 }
 $menu_distribuidor .= '</select>';

 $menu_anio = '<select id="id_anio" name="id_anio" class="form-control" required/>';
 $menu_anio .= '<option value = ""> Seleccionar ';
 if($cantidad_anio != 1)
 {
  foreach($anios as $anio)
  { 
   if($id_anio == $anio['id'])
   {
    $menu_anio .= ' <option value = '.$anio['id'].' selected> '.$anio['nombre'].'</option>';
   }
   else
   {
    $menu_anio .= ' <option value = '.$anio['id'].'> '.$anio['nombre'].'</option>';
   }
  }
 }
 $menu_anio .= '</select>';

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
 $miga_pan .= '<li>Meta Sell In</li>';
 
?>