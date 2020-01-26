<?php
 
 $error1 = 0; // La dirección de correo electrónico o la contraseña que has introducido no son correctas.
 
 require_once ('conexion.php');

 // Funciones en php
 require_once ('funciones.php');

 if($_POST)
 {
  $correo_electronico = trim(mysqli_real_escape_string($conexion,$_POST['correo_electronico']));
  
  $consulta_usuario = mysqli_query($conexion,"select * from usuario where correo_electronico='$correo_electronico'");
  if(mysqli_num_rows($consulta_usuario)==1)
  {
   $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
    
   $correo_electronico = $resultado_consulta_usuario[correo_electronico];
   $nombre = $resultado_consulta_usuario[nombre];
	
   $id_usuario = $resultado_consulta_usuario[id];
	
   $contrasenia = rand(100000, 999999);
   $contrasenia_encriptada = md5($contrasenia);
   $modificar = mysqli_query($conexion,"update usuario set contrasenia = '$contrasenia_encriptada', restablecer = '1' where id = '$id_usuario'");  

   $asunto = 'SCH Restablecer contraseña';
   
   $mensaje_email = "
 	Estimado Usuario <i>".$nombre."</i>.
	<br><br>
	Su contrase&ntilde;a se restableci&oacute; correctamente. Esta es su informaci&oacute;n temporal de acceso:
	<br><br>
	Contrase&ntilde;a: ".$contrasenia."  (Por favor modifiquela al ingresar al sistema)";
   
   $correo =  CorreoElectronico($correo_electronico,$asunto,$mensaje_email);	 
   
   $mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
  }
  else
  {
   $error1 = 1;
  }
 }

 require_once ('mensajes_principal.php');

?>