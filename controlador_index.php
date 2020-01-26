<?php
 // Por si queda alguna sesion "viva", elimino todas las variables de la sesión
 // Comprueba en los cookies que existe una sesión y continua con ella
 // session_id() devuelve el identificador actual
 session_start();
 // Elimina todas las variables de la sesión 
 session_unset();
 // Destruye la sesión
 session_destroy();
 
 $usuario = '';
 $error1 = 0; // La dirección de correo electrónico o la contraseña que has introducido no son correctas.
 
 if($_POST) 
 {      
  // Realiza la Conexión a la Base de Datos
  require_once ('conexion.php');
  // Funciones en php
  require_once ('funciones.php');
   
  // Lee el usuario y aplica función para evitar ataques por inyección SQL
  $correo_electronico = mysqli_real_escape_string($conexion,$_POST['correo_electronico']);
  // Lee contraseña y aplica función para evitar ataques por inyección SQL
  $contrasenia = mysqli_real_escape_string($conexion,$_POST['contrasenia']);
  // Encripta contraseña
  $contrasenia = md5($contrasenia);
    
  if($correo_electronico != '' && $contrasenia != '')
  {
   //Consulta de Exitencia Usuario
   $consulta_usuario = mysqli_query($conexion,"select * from usuario where correo_electronico='$correo_electronico' and contrasenia='$contrasenia'");
   if(mysqli_num_rows($consulta_usuario)==1)
   {
    $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
	
	if($resultado_consulta_usuario['estado']==1)
    {
     // Comprueba en los cookies que existe una sesión y continua con ella
     session_start();
   
     // Variables de Sesión 
     // Esta variable de sesión hace de centinela para comprobar que se ha ingresado en la aplicacion
     $_SESSION['acceso'] = true;
	 $_SESSION['usuario'] = $resultado_consulta_usuario['id'];
	 $_SESSION['perfil'] = $resultado_consulta_usuario['perfil'];
	 $_SESSION['pais'] = $resultado_consulta_usuario['pais'];
	 $_SESSION['linea'] = $resultado_consulta_usuario['linea'];
	 $_SESSION['restablecer'] = $resultado_consulta_usuario['restablecer'];
   	
	 $auditoria = 'Ingreso al Sistema';
	 $modulo = 1;
	 //Auditoria - Crear Laboratorio (Depende de funciones.php)
     //auditoria($auditoria,$_SESSION['id'],$modulo,$_SESSION['perfil']);
 		
     // Envia a la página Principal
     header('Location: principal.php');
     exit;
	}
    else
    {
     $error2 = 1;
    }
   }
   else
   {
    $error1 = 1;
   }
  }
  
  // Cierra la Conexión a la Base de Datos
  mysqli_close($conexion);
 }
 
 require_once ('mensajes_principal.php');
 
?>