<?php
 
 $error = 0;
 $eliminar = 0;
 
 // Leo el id enviado por GET de la Sección a Eliminar
 $id_eliminar = !empty($_GET['id'])? $_GET['id']:0;
 
 if($id_eliminar == 0)
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 require_once ('modelo_eliminar_zona_usuario.php');
  
 if($error==0)
 {
  if($eliminar)
  {
   $modulo = 2;
   $accion = 'ELIMINAR';
   $id_afectado = $id_eliminar;
   $descripcion = '';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 14;
  }
  else
  {
   $mensaje = 15;
  }
 }
 if($error==1)
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 
 echo '<script language="JavaScript" type="text/javascript">document.location.href="modificar_usuario.php?id='.$id_usuario.'&m='.$mensaje.'"</script>';
 
?>