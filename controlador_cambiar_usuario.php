<?php

 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin')
 {
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 } 
 
 $id_usuario = !empty($_GET['id'])? $_GET['id']:0;
 $id_usuario = mysqli_real_escape_string($conexion,$id_usuario);

 if($id_usuario == 0)
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 session_unset();
 session_destroy();
  
 $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = '$id_usuario'");
 if(mysqli_num_rows($consulta_usuario)==1)
 {
  $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
    	
  // Comprueba en los cookies que existe una sesión y continua con ella
  session_start();

  // Variables de Sesión 
  $_SESSION['acceso'] = true;
  $_SESSION['usuario'] = $resultado_consulta_usuario['id'];
  $_SESSION['perfil'] = $resultado_consulta_usuario['perfil'];
  $_SESSION['pais'] = $resultado_consulta_usuario['pais'];
  $_SESSION['linea'] = $resultado_consulta_usuario['linea'];
  
  $_SESSION['restablecer'] = $resultado_consulta_usuario['restablecer'];
 
  // Envia a la página Principal
  header('Location: principal.php');
  exit;
 }
 else
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

?>