<?php
  
 $error = 0;
 $crear = 0;
 
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
  
  require_once ('modelo_crear_moneda.php');
    
  if($crear)
  {
   $modulo = 2;
   $accion = 'CREAR';
   $id_afectado = mysqli_insert_id($conexion);
   $descripcion = 'Crear Moneda '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 21;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_moneda.php?m='.$mensaje.'"</script>';
  }
  else
  {      
   $mensaje = 22; 
  }
  require_once ('mensajes_moneda.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_crear_moneda.php');  
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Moneda</li>';
 
?>