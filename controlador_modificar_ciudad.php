<?php
  
 $error = 0;
 $modificar = 0;
 
 $nombre = '';
 $id_pais = 0;
 $id_departamento = 0;
  
 require_once ('conexion_sesion.php'); 
  
 if($_POST)
 {
  $nombre = trim(mysqli_real_escape_string($conexion,$_POST['nombre']));
  $id_pais = isset($_POST['pais']) ? mysqli_real_escape_string($conexion,$_POST['pais']) : '0';
  $id_departamento = isset($_POST['departamento']) ? mysqli_real_escape_string($conexion,$_POST['departamento']) : '0';
  
  $error_nombre = '';
  $error_pais = '';
  $error_departamento = '';
 
  if($nombre == '')
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nombre.</div>';
   $error = 1;
  }
  if($id_pais == 0)
  {
   $error_pais = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Pa&iacute;s.</div>';
   $error = 1;
  }
  if($id_departamento == 0)
  {
   $error_departamento = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Departamento.</div>';
   $error = 1;
  }
  
  require_once ('modelo_modificar_ciudad.php');
    
  if($modificar)
  { 
   $modulo = 2;
   $accion = 'MODIFICAR';
   $id_afectado = $id_modificar;
   $descripcion = 'Modificar zona '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_ciudad.php?m='.$mensaje.'"</script>';
  }
  else
  { 
   $mensaje = 32; 
  }
  require_once ('mensajes_ciudad.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_modificar_ciudad.php');
 }
 
 $menu_pais = '<select id="pais" name="pais" class="form-control" required/>';
 $menu_pais .= '<option value = ""> Seleccionar ';
 if($cantidad_pais != 1)
 {
  foreach($paises as $pais)
  { 
   if($id_pais == $pais['id'])
   {
    $menu_pais .= ' <option value = '.$pais['id'].' selected> '.$pais['nombre'].'</option>';
   }
   else
   {
    $menu_pais .= ' <option value = '.$pais['id'].'> '.$pais['nombre'].'</option>';
   }
  }
 }
 $menu_pais .= '</select>';

 $menu_departamento = ' <select name="departamento" id="departamento" class="form-control" required/></select>';
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Ciudad</li>';
 
?>