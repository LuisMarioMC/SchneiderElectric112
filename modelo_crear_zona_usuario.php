<?php
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_zona_usuario = mysqli_query($conexion,"select * from zona_usuario where usuario=$id_usuario and pais=$pais and zona=$zona order by id desc");
 if(mysqli_num_rows($consulta_zona_usuario)==0)
 {
  $crear = @mysqli_query($conexion,"insert into zona_usuario (usuario,pais,zona) values ('$id_usuario','$pais','$zona')");
  echo mysqli_error($conexion);
  $mensaje = 23;
 }
 else
 {
  $mensaje = 24; 
 }
 
 echo '<script language="JavaScript" type="text/javascript">document.location.href="modificar_usuario.php?id='.$id_usuario.'&m='.$mensaje.'"</script>';	 	 

?>