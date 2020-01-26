<?php
 
 $error = 0;
 $activar = 0;
 $inactivar = 0;
 
 // id a Activar o Inactivar
 $id_estado = !empty($_GET['id'])? $_GET['id']:0;
 
 if($id_estado == 0)
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 require_once ('modelo_estado_segmento.php');
  
 if($error==0)
 {
  if($estado==0)
  {
   if($activar)
   {
    $modulo = 2;
	$accion = 'ACTIVAR';
    $id_afectado = $id_estado;
    $descripcion = '';
    auditoria($modulo,$accion,$id_afectado,$descripcion);
    $mensaje = 41;
   }
   else
   {
    $mensaje = 42;
   }
  }
  if($estado==1)
  {
   if($inactivar)
   {
    $modulo = 2;
	$accion = 'INACTIVAR';
    $id_afectado = $id_estado;
    $descripcion = '';
    auditoria($modulo,$accion,$id_afectado,$descripcion);
    $mensaje = 51;
   }
   else
   {
    $mensaje = 52;
   }
  }
 }
 if($error==1)
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_segmento.php?m='.$mensaje.'"</script>';
 
?>