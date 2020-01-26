<?php
  
 $error = 0;
 $modificar = 0;
 
 $nombre = '';
 $id_pais = '';
  
 require_once ('conexion_sesion.php'); 
  
 if($_POST)
 {
  $nombre = trim(mysqli_real_escape_string($conexion,$_POST['nombre']));
  $id_pais = trim(mysqli_real_escape_string($conexion,$_POST['id_pais']));
  
  $error_nombre = '';
  $error_pais = '';
 
  if($nombre == '')
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nombre.</div>';
   $error = 1;
  }
  if($id_pais == '')
  {
   $error_pais = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Pa&iacute;s.</div>';
   $error = 1;
  }
 
  require_once ('modelo_modificar_zona.php');
    
  if($modificar)
  { 
   $modulo = 2;
   $accion = 'MODIFICAR';
   $id_afectado = $id_modificar;
   $descripcion = 'Modificar zona '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_zona.php?m='.$mensaje.'"</script>';
  }
  else
  { 
   $mensaje = 32; 
  }
  require_once ('mensajes_zona.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_modificar_zona.php');
 }
 
 $menu_pais = '<select id="id_pais" name="id_pais" class="form-control" required/>';
 $menu_pais .= '<option value = ""> Seleccionar ';
 if($cantidad_pais != 1)
 {
  foreach($paises as $pais)
  { 
   if($id_pais == $pais['id'])
   {
    $menu_pais .= ' <option value = '.$pais['id'].' selected> '.$pais['nombre'].'</option>';
   }
   else
   {
    $menu_pais .= ' <option value = '.$pais['id'].'> '.$pais['nombre'].'</option>';
   }
  }
 }
 $menu_pais .= '</select>';
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Zona</li>';
 
?>