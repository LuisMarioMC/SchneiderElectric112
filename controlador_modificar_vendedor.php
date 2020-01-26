<?php
  
 $error = 0;
 $modificar = 0;
 $nombre = '';
 $correo_electronico = '';
 $celular = '';
  
 require_once ('conexion_sesion.php'); 
  
 if($_POST)
 {
  $nombre = trim(mysqli_real_escape_string($conexion,$_POST['nombre']));
  $correo_electronico = trim(mysqli_real_escape_string($conexion,$_POST['correo_electronico']));
  $celular = trim(mysqli_real_escape_string($conexion,$_POST['celular']));
  
  if($nombre == '')
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nombre.</div>';
   $error = 1;
  }
  if($correo_electronico == '')
  {
   $error_correo_electronico = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Correo Electr&oacute;nico.</div>';
   $error = 1;
  }
  if($celular == '')
  {
   $error_celular = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Celular.</div>';
   $error = 1;
  }
  if(!is_numeric($celular))
  {
   $error_celular = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Debe ser Formato Num&eacute;rico.</div>';
   $error = 1;
  }
  //if($perfil == '')
  //{
  // $error_perfil = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Perfil.</div>';
  // $error = 1;
  //} 
  
  require_once ('modelo_modificar_vendedor.php');
    
  if($modificar)
  { 
   //$modulo = 2;
   //$accion = 'MODIFICAR';
   //$id_afectado = $id_modificar;
   //$descripcion = 'Modificar segmento '.$nombre.'';
   //auditoria($modulo,$accion,$id_afectado,$descripcion);
   //$mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_vendedor.php?m='.$mensaje.'"</script>';
  }
  else
  {
   $mensaje = 32; 
  }
  require_once ('mensajes_vendedor.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_modificar_vendedor.php');
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Vendedor</li>';
 
?>