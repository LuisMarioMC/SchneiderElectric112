<?php 
 
 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_anio = mysqli_query($conexion,"select * from anio where id = $id_estado");
 if(@mysqli_num_rows($consulta_anio)==1)
 {
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  $estado = $resultado_consulta_anio['estado'];
 
  $consulta_q = mysqli_query($conexion,"select * from q where anio = $id_estado and estado = 1");
  if(@mysqli_num_rows($consulta_q)==0)
  {
   if($estado == 0)
   {
    $activar = mysqli_query($conexion,"update anio set estado = 1 where id = $id_estado");
   }
   elseif($estado == 1)
   {
    $inactivar = mysqli_query($conexion,"update anio set estado = 0 where id = $id_estado");
   }
   else
   {
    $error = 1;
	$error1 = 1;
   }
  }
  else
  {
   $error = 1;
   $error2 = 1;
  }
 }
 else
 {
  $error = 1;
  $error1 = 1;
 }
  
?>