<?php
  
 $error = 0;
 $modificar = 0;
 
 $nombre = '';
 $id_moneda = '';
  
 require_once ('conexion_sesion.php'); 
  
 if($_POST)
 {
  $nombre = trim(mysqli_real_escape_string($conexion,$_POST['nombre']));
  $id_moneda = trim(mysqli_real_escape_string($conexion,$_POST['id_moneda']));
  
  $error_nombre = '';
  $error_moneda = '';
 
  if($nombre == '')
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nombre.</div>';
   $error = 1;
  }
  if($id_moneda == '')
  {
   $error_moneda = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Moneda.</div>';
   $error = 1;
  }
 
  require_once ('modelo_modificar_pais.php');
    
  if($modificar)
  { 
   $modulo = 2;
   $accion = 'MODIFICAR';
   $id_afectado = $id_modificar;
   $descripcion = 'Modificar pais '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_pais.php?m='.$mensaje.'"</script>';
  }
  else
  { 
   $mensaje = 32; 
  }
  require_once ('mensajes_pais.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_modificar_pais.php');
 } 
 
 $menu_moneda = '<select id="id_moneda" name="id_moneda" class="form-control" required/>';
 $menu_moneda .= '<option value = ""> Seleccionar ';
 if($cantidad_moneda != 1)
 {
  foreach($monedas as $moneda)
  { 
   if($id_moneda == $moneda['id'])
   {
    $menu_moneda .= ' <option value = '.$moneda['id'].' selected> '.$moneda['nombre'].'</option>';
   }
   else
   {
    $menu_moneda .= ' <option value = '.$moneda['id'].'> '.$moneda['nombre'].'</option>';
   }
  }
 }
 $menu_moneda .= '</select>';
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Pa&iacute;s</li>';
 
?>