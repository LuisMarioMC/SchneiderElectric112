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

 require_once ('modelo_eliminar_anio.php');
  
 if($error==0)
 {
  if($eliminar)
  {
   $modulo = 2;
   $accion = 'ELIMINAR';
   $id_afectado = $id_eliminar;
   $descripcion = '';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 11;
  }
  else
  {
   $mensaje = 12;
  }
 }
 if($error==1)
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 if($error==2)
 {
  $mensaje = 13;
 }
 
 echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_anio.php?m='.$mensaje.'"</script>';
 
?>