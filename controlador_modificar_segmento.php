<?php
  
 $error = 0;
 $modificar = 0;
 
 $nombre = '';
  
 require_once ('conexion_sesion.php'); 
  
 if($_POST)
 {
  $nombre = trim(mysqli_real_escape_string($conexion,$_POST['nombre']));
 
  $error_nombre = '';
 
  if($nombre == '')
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nombre.</div>';
   $error = 1;
  }
 
  require_once ('modelo_modificar_segmento.php');
    
  if($modificar)
  { 
   $modulo = 2;
   $accion = 'MODIFICAR';
   $id_afectado = $id_modificar;
   $descripcion = 'Modificar segmento '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_segmento.php?m='.$mensaje.'"</script>';
  }
  else
  {
   $mensaje = 32; 
  }
  require_once ('mensajes_segmento.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_modificar_segmento.php');
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Segmento</li>';
 
?>