<?php
 
 $error = 0;
 $crear = 0;
 
 // Leo el id enviado por GET de la Sección a Eliminar
 $id_usuario = !empty($_GET['id'])? $_GET['id']:0;
 
 if($id_usuario == 0)
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 if($_POST)
 {
  require_once ('conexion_sesion.php');
  
  $pais = trim(mysqli_real_escape_string($conexion,$_POST['pais']));
  $segmento = trim(mysqli_real_escape_string($conexion,$_POST['segmento']));
 
  require_once ('modelo_crear_segmento_usuario.php');
 
  if($crear)
  {
   $modulo = 2;
   $accion = 'ELIMINAR';
   $id_afectado = $id_eliminar;
   $descripcion = '';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 11;

  }
 }
 else
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }  
 
 echo '<script language="JavaScript" type="text/javascript">document.location.href="modificar_usuario.php?id='.$id_usuario.'&m='.$mensaje.'"</script>';
 
?>