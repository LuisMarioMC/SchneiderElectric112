<?php
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $cantidad_actividad = 1;
 $consulta_actividad = mysqli_query($conexion,"select * from actividad where estado = 1 order by nombre ASC ");
 while($resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad))
 {
  $actividades[$cantidad_actividad]['id'] = $resultado_consulta_actividad['id'];
  $actividades[$cantidad_actividad]['nombre'] = $resultado_consulta_actividad['nombre'];
  $cantidad_actividad++; 
 }
 
 $cantidad_pais = 1;
 $consulta_pais = mysqli_query($conexion,"select * from pais where estado = 1 order by nombre ASC ");
 while($resultado_consulta_pais = mysqli_fetch_array($consulta_pais))
 {
  $paises[$cantidad_pais]['id'] = $resultado_consulta_pais['id'];
  $paises[$cantidad_pais]['nombre'] = $resultado_consulta_pais['nombre'];
 
  $id_pais = isset($_POST[$paises[$cantidad_pais]['nombre']]) ? $_POST[$paises[$cantidad_pais]['nombre']] : '0';
  if($id_pais == 0)
  {
   $paises[$cantidad_pais]['check'] = '';
  }
  else
  {
   $paises[$cantidad_pais]['check'] = 'checked';
  }
  
  $cantidad_pais++; 
 }
  
 if($error == 0)
 {
  $consulta_referencia = mysqli_query($conexion,"select * from producto where referencia='$referencia'");
  if(mysqli_num_rows($consulta_referencia) == 1)
  {
   $error_referencia = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La Referencia de Producto ya existe.</div>';
   $error = 1;
  }
 }
 /* 
 if($error == 0)
 {
  $consulta_producto = mysqli_query($conexion,"select * from producto where nombre='$nombre'");
  if(mysqli_num_rows($consulta_producto) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Nombre de Producto ya existe.</div>';
   $error = 1;
  }
 }
 */
 if($error == 0)
 {
  $crear = mysqli_query($conexion,"insert into producto (referencia,nombre,actividad,cant_indi,estado) values ('$referencia','$nombre','$id_actividad','$cant_indi','0')"); 
  $id_producto  = mysqli_insert_id($conexion);
 
  if($crear)
  {
   if($cantidad_pais != 1)
   {
    foreach($paises as $pais)
    {
     $id_estado = isset($_POST[$pais['nombre']]) ? $_POST[$pais['nombre']] : '0';
     if($id_estado == 0)
     {
      $crear = mysqli_query($conexion,"insert into producto_pais (pais,producto,estado) values ('$id_pais','$id_producto','0')");
     }
     else
	 {
      $crear = mysqli_query($conexion,"insert into producto_pais (pais,producto,estado) values ('$id_pais','$id_producto','1')");
     }
	}
   }
  }
 }
 
?>