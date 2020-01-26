<?php
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_segmento_usuario = mysqli_query($conexion,"select * from segmento_usuario where usuario=$id_usuario and pais=$pais and segmento=$segmento order by id desc");
 if(mysqli_num_rows($consulta_segmento_usuario)==0)
 {
  $crear = @mysqli_query($conexion,"insert into segmento_usuario (usuario,pais,segmento) values ('$id_usuario','$pais','$segmento')");
  echo mysqli_error($conexion);
  $mensaje = 25;
 }
 else
 {
  $mensaje = 26; 
 }
 
 echo '<script language="JavaScript" type="text/javascript">document.location.href="modificar_usuario.php?id='.$id_usuario.'&m='.$mensaje.'"</script>';

?>