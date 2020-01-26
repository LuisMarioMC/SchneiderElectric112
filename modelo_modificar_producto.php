<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0; 
 
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
  
  if($referencia == '')
  {
   $id_pais = $resultado_consulta_pais['id'];
   $consulta_producto_pais = mysqli_query($conexion,"select * from producto_pais where pais = $id_pais and producto = $id_modificar");
   $resultado_consulta_producto_pais = mysqli_fetch_array($consulta_producto_pais);
   if($resultado_consulta_producto_pais['estado'] == 1)
   {
    $paises[$cantidad_pais]['check'] = 'checked';
   }
   else
   {
    $paises[$cantidad_pais]['check'] = '';
   }
  }
  else
  {
   $id_pais = isset($_POST[$paises[$cantidad_pais]['nombre']]) ? $_POST[$paises[$cantidad_pais]['nombre']] : '0';
   if($id_pais == 0)
   {
    $paises[$cantidad_pais]['check'] = '';
   }
   else
   {
    $paises[$cantidad_pais]['check'] = 'checked';  
   } 
  }
  
  $cantidad_pais++; 
 }
 
 $consulta_producto = @mysqli_query($conexion,"select * from producto where id='$id_modificar'");
 $resultado_consulta_producto = mysqli_fetch_array($consulta_producto);
 if($referencia == '')
 {
  $referencia = $resultado_consulta_producto['referencia'];
  $nombre = $resultado_consulta_producto['nombre'];
  $id_actividad = $resultado_consulta_producto['actividad'];
  $cant_indi = $resultado_consulta_producto['cant_indi'];
 }
 else
 {
  $referencia2 = $resultado_consulta_producto['referencia'];
  $nombre2 = $resultado_consulta_producto['nombre'];
  $id_actividad2 = $resultado_consulta_producto['actividad'];
  $cant_indi2 = $resultado_consulta_producto['cant_indi'];
 }
  
 if($error == 0)
 {
  $consulta_referencia = @mysqli_query($conexion,"select * from producto where referencia='$referencia'");
  $resultado_consulta_referencia = mysqli_fetch_array($consulta_referencia);
  $id = $resultado_consulta_referencia['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_referencia) == 1)
  {
   $error_referencia = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La Referencia ya existe.</div>';
   $error = 1;
  }
 }
 
 if($error == 0)
 {
  $consulta_producto = @mysqli_query($conexion,"select * from producto where nombre='$nombre'");
  $resultado_consulta_producto = mysqli_fetch_array($consulta_producto);
  $id = $resultado_consulta_producto['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_producto) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El Nombre ya existe.</div>';
   $error = 1;
  }
 }
 
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update producto set referencia = '$referencia', nombre = '$nombre', actividad = '$id_actividad', cant_indi = '$cant_indi' where id = '$id_modificar'");
 
  if($modificar)
  {
   $eliminar = @mysqli_query($conexion,"delete from producto_pais where producto = $id_modificar");
  }
 
  if($eliminar)
  {
   if($cantidad_pais != 1)
   {
    foreach($paises as $pais)
    {
     $estado_pais = isset($_POST[$pais['nombre']]) ? $_POST[$pais['nombre']] : '0';
     if($estado_pais == 0)
     {
      $crear = mysqli_query($conexion,"insert into producto_pais (pais,producto,estado) values ('$pais[id]','$id_modificar','0')");
     }
     else
 	 {
      $crear = mysqli_query($conexion,"insert into producto_pais (pais,producto,estado) values ('$pais[id]','$id_modificar','1')");
     }    	
    }
   }
  }
  
 }
 
?>