<?php
  
 $error = 0;
 $modificar = 0;

 $contrasenia1 = '';
 $contrasenia2 = '';
 $contrasenia3 = '';
 
 require_once ('conexion_sesion.php');
 
 if($_POST)
 {
  $contrasenia1 = trim(mysqli_real_escape_string($conexion,$_POST['contrasenia1']));
  $contrasenia2 = trim(mysqli_real_escape_string($conexion,$_POST['contrasenia2']));
  $contrasenia3 = trim(mysqli_real_escape_string($conexion,$_POST['contrasenia3']));
  
  $error_contrasenia1 = '';
  $error_contrasenia2 = '';
  $error_contrasenia3 = '';
  
  if($contrasenia1 == '')
  {
   $error_contrasenia1 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Contrase&ntilde;a Actual.</div>';
   $error = 1;
  }
  if($contrasenia2 == '')
  {
   $error_contrasenia2 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nueva Contrase&ntilde;a.</div>';
   $error = 1;
  }  
  if($contrasenia3 == '')
  {
   $error_contrasenia3 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nueva Contrase&ntilde;a.</div>';
   $error = 1;
  }
  if($contrasenia2 != '' && $contrasenia3 != '' && $contrasenia2 != $contrasenia3)
  {
   $error_contrasenia3 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>No coincide la Nueva Contrase&ntilde;a.</div>';
   $error = 1;   
  }
    
  require_once ('modelo_cambiar_contrasenia.php');
    
  if($modificar)
  { 
   // Auditoria
   
   if($_SESSION['restablecer']==0)
   {
    $mensaje = 21;
    echo '<script language="JavaScript" type="text/javascript">document.location.href="principal.php?m='.$mensaje.'"</script>';
   }
   if($_SESSION['restablecer']==1)
   {
    $mensaje = 21;	   
    echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
   }
  }
  else
  {
   $mensaje = 22;
   require_once ('mensajes_cambiar_contrasenia.php');
  }
  
 }

?>