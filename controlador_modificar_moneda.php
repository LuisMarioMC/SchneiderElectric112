<?php
  
 $error = 0;
 $modificar = 0;
 
 $nombre = '';
 $sigla = ''; 
  
 require_once ('conexion_sesion.php');
  
 if($_POST)
 {
  $nombre = trim(mysqli_real_escape_string($conexion,$_POST['nombre']));
  $sigla = trim(mysqli_real_escape_string($conexion,$_POST['sigla']));
 
  $error_nombre = '';
  $error_sigla = '';
 
  if($nombre == '')
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nombre.</div>';
   $error = 1;
  }
  if($sigla == '')
  {
   $error_sigla = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Sigla.</div>';
   $error = 1;
  }
 
  require_once ('modelo_modificar_moneda.php');
    
  if($modificar)
  { 
   $modulo = 2;
   $accion = 'MODIFICAR';
   $id_afectado = $id_modificar;
   $descripcion = 'Modificar Moneda '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_moneda.php?m='.$mensaje.'"</script>';
  }
  else
  {
   $mensaje = 32; 
  }
  require_once ('mensajes_moneda.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_modificar_moneda.php');
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Moneda</li>';
 
?>