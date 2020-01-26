<?php
 
 $error = 0;
 $error1 = 0;
 $error2 = 0;
 $error3 = 0;
 $activar = 0;
 $inactivar = 0;
 
 // id a Activar o Inactivar
 $id_q = !empty($_GET['id'])? $_GET['id']:0;
 
 if($id_q == 0)
 {
  $mensaje = 6661; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 require_once ('modelo_estado_q.php');
  
 if($error==0)
 {
  if($estado_q==0)
  {
   if($activar)
   {
	$modulo = 2;
	$accion = 'ACTIVAR';
    $id_afectado = $id_q;
    $descripcion = '';
    auditoria($modulo,$accion,$id_afectado,$descripcion);
    $mensaje = 41;
   }
   else
   {
    $mensaje = 42;
   }
  }
  if($estado_q==1)
  {
   if($inactivar)
   {   	   
    $modulo = 2;
	$accion = 'INACTIVAR';
    $id_afectado = $id_q;
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
 if($error1==1)
 {
  $mensaje = 6662;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 if($error2==1)
 {
  $mensaje = 53;
 }
 if($error3==1)
 {
  $mensaje = 43;
 }
 
 echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_q.php?m='.$mensaje.'"</script>';
 
?>