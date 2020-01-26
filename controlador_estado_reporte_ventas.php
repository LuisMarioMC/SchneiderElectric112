<?php
 
 $error = 0;
 $error1 = 0;
 $activar = 0;
 $inactivar = 0;

 require_once ('conexion_sesion.php');
 
 // id a Activar o Inactivar
 $id_estado = !empty($_GET['id'])? $_GET['id']:0;
 $id_estado = mysqli_real_escape_string($conexion,$id_estado);
 
 if($id_estado == 0)
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 require_once ('modelo_estado_reporte_ventas.php');
  
 if($error==0)
 {
  if($estado_reporte_ventas==0)
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
  if($estado_reporte_ventas==1)
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
 if($error1==1)
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 echo '<script language="JavaScript" type="text/javascript">document.location.href="reporte_ventas.php?m='.$mensaje.'"</script>';
 
?>