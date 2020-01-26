<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_anio = mysqli_query($conexion,"select * from anio where id='$id_eliminar'");
 if(@mysqli_num_rows($consulta_anio)==1)
 {
  $consulta_detalle_sell_out = mysqli_query($conexion,"select * from detalle_sell_out where id_anio='$id_eliminar'");
  if(@mysqli_num_rows($consulta_detalle_sell_out)==0)
  {
   // Elimino el registro
   $eliminar = @mysqli_query($conexion,"delete from anio where id=$id_eliminar");
   $consulta_q = mysqli_query($conexion,"select * from q where anio=$id_eliminar");
   while ($resultado_consulta_q = mysqli_fetch_array($consulta_q))
   {
    $id_q = $resultado_consulta_q[id];
	$eliminar = @mysqli_query($conexion,"delete from auditoria_q where q=$id_q");
   }
   
   $eliminar = @mysqli_query($conexion,"delete from q where anio=$id_eliminar");
   $eliminar = @mysqli_query($conexion,"delete from mes where anio=$id_eliminar");
  }
  else
  {
   $error = 2;
  }
 }
 else
 {
  $error = 1;
 }
 
?>