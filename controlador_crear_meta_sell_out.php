<?php
  
 $error = 0;
 $crear = 0;
 
 $id_distribuidor = '';
 $id_anio = '';
 $id_linea = '';
 $q1 = '';
 $cq1 = ''; 
 $q2 = '';
 $cq2 = '';
 $q3 = '';
 $cq3 = '';
 $q4 = '';
 $cq4 = '';
  
 require_once ('conexion_sesion.php');
 
 if($_POST)
 {
  $id_distribuidor = trim(mysqli_real_escape_string($conexion,$_POST['id_distribuidor']));
  $id_anio = trim(mysqli_real_escape_string($conexion,$_POST['id_anio']));
  $id_linea = trim(mysqli_real_escape_string($conexion,$_POST['id_linea']));
  
  $q1 = trim(mysqli_real_escape_string($conexion,$_POST['q1']));
  $cq1 = trim(mysqli_real_escape_string($conexion,$_POST['cq1']));
  $q2 = trim(mysqli_real_escape_string($conexion,$_POST['q2']));
  $cq2 = trim(mysqli_real_escape_string($conexion,$_POST['cq2']));
  $q3 = trim(mysqli_real_escape_string($conexion,$_POST['q3']));
  $cq3 = trim(mysqli_real_escape_string($conexion,$_POST['cq3']));
  $q4 = trim(mysqli_real_escape_string($conexion,$_POST['q4']));
  $cq4 = trim(mysqli_real_escape_string($conexion,$_POST['cq4']));
  
  $error_distribuidor = '';
  $error_anio = '';
  $error_linea = '';
  $error_q1 = '';
  $error_cq1 = '';
  $error_q2 = '';
  $error_cq2 = '';
  $error_q3 = '';
  $error_cq3 = '';
  $error_q4 = '';
  $error_cq4 = '';
  
  if($id_distribuidor == '')
  {
   $error_distribuidor = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Distribuidor.</div>';
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
  else
  {
   if(!is_numeric($q1))
   {
    $error_q1 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Q1 no es Num&eacute;rico.</div>';
    $error = 1;	   
   }
   else
   {
	if($q1 < 0)
	{
     $error_q1 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Q1 es menor a cero.</div>';
     $error = 1;	
	}
   }
  }
  if($cq1 == '')
  {
   $error_cq1 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Comisi&oacute;n Q1.</div>';
   $error = 1;
  }
  else
  {
   if(!is_numeric($cq1))
   {
    $error_cq1 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Comisi&oacute;n Q1 no es Num&eacute;rico.</div>';
    $error = 1;	   
   }
   else
   {
	if($cq1 < 0 || $cq1 > 100)
	{
     $error_q1 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Comisi&oacute;n Q1 fuera del rango [0-100].</div>';
     $error = 1;
	}
   }
  }
  if($q2 == '')
  {
   $error_q2 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Q2.</div>';
   $error = 1;
  }
  else
  {
   if(!is_numeric($q2))
   {
    $error_q2 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Q2 no es Num&eacute;rico.</div>';
    $error = 1;	   
   }
   else
   {
	if($q2 < 0)
	{
     $error_q2 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Q2 es menor a cero.</div>';
     $error = 1;
	}
   }
  }
  if($cq2 == '')
  {
   $error_cq2 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Comisi&oacute;n Q2.</div>';
   $error = 1;
  }
  else
  {
   if(!is_numeric($cq2))
   {
    $error_cq2 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Comisi&oacute;n Q2 no es Num&eacute;rico.</div>';
    $error = 1;	   
   }
   else
   {
	if($cq2 < 0 || $cq2 > 100)
	{
     $error_cq2 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Comisi&oacute;n Q2 fuera del rango [0-100].</div>';
     $error = 1;
	}
   }
  }  
  if($q3 == '')
  {
   $error_q3 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Q3.</div>';
   $error = 1;
  }
  else
  {
   if(!is_numeric($q3))
   {
    $error_q3 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Q3 no es Num&eacute;rico.</div>';
    $error = 1;	   
   }
   else
   {
	if($q3 < 0)
	{
     $error_q3 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Q3 es menor a cero.</div>';
     $error = 1;	
	}
   }
  }
  if($cq3 == '')
  {
   $error_cq3 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Comisi&oacute;n Q3.</div>';
   $error = 1;
  }
  else
  {
   if(!is_numeric($cq3))
   {
    $error_cq3 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Comisi&oacute;n Q3 no es Num&eacute;rico.</div>';
    $error = 1;	   
   }
   else
   {
	if($cq3 < 0 || $cq3 > 100)
	{
     $error_cq3 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Comisi&oacute;n Q3 fuera del rango [0-100].</div>';
     $error = 1;
	}
   }
  }
  if($q4 == '')
  {
   $error_q4 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Q4.</div>';
   $error = 1;
  }
  else
  {
   if(!is_numeric($q4))
   {
    $error_q4 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Q4 no es Num&eacute;rico.</div>';
    $error = 1;	   
   }
   else
   {
	if($q4 < 0)
	{
     $error_q4 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Q4 es menor a cero.</div>';
     $error = 1;	
	}
   }
  }
  if($cq4 == '')
  {
   $error_cq4 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Comisi&oacute;n Q4.</div>';
   $error = 1;
  }
  else
  {
   if(!is_numeric($cq4))
   {
    $error_cq4 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Comisi&oacute;n Q4 no es Num&eacute;rico.</div>';
    $error = 1;	   
   }
   else
   {
	if($cq4 < 0 || $cq4 > 100)
	{
     $error_cq4 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Comisi&oacute;n Q4 fuera del rango [0-100].</div>';
     $error = 1;
	}
   }
  }
  
  require_once ('modelo_crear_meta_sell_out.php');
    
  if($crear)
  {
   $modulo = 2;
   $accion = 'CREAR';
   $id_afectado = mysqli_insert_id($conexion);
   $descripcion = 'Crear Meta Sell Out Distribuidor: '.$distribuidor.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 21;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_meta_sell_out.php?m='.$mensaje.'"</script>';
  }
  else
  {      
   $mensaje = 22;
  }
  require_once ('mensajes_meta_sell_out.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_crear_meta_sell_out.php');  
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
 $miga_pan .= '<li>Meta Sell Out</li>';
  
?>