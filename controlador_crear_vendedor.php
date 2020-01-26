<?php
  
 $error = 0;
 $crear = 0;
 
 $nombre = '';
 $correo_electronico = '';
 $celular = '';
 $contrasenia_automatica = 0;
 $contrasenia = '';
 $contrasenia2 = '';

 $checked_contrasenia_automatica = '';
 
 require_once ('conexion_sesion.php');
 
 if($_POST)
 { 
  $nombre = trim(mysqli_real_escape_string($conexion,$_POST['nombre']));
  $correo_electronico = trim(mysqli_real_escape_string($conexion,$_POST['correo_electronico']));
  $celular = trim(mysqli_real_escape_string($conexion,$_POST['celular']));
  $contrasenia_automatica = !empty($_POST['contrasenia_automatica'])? mysqli_real_escape_string($conexion,$_POST['contrasenia_automatica']):0;
  if($contrasenia_automatica == 1)
  {
   $checked_contrasenia_automatica = 'checked';
  } 
  $contrasenia = trim(mysqli_real_escape_string($conexion,$_POST['contrasenia']));
  $contrasenia2 = trim(mysqli_real_escape_string($conexion,$_POST['contrasenia2']));
  
  if($nombre == '')
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nombre.</div>';
   $error = 1;
  }
  if($correo_electronico == '')
  {
   $error_correo_electronico = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Correo Electr&oacute;nico.</div>';
   $error = 1;
  }
  if($celular == '')
  {
   $error_celular = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Celular.</div>';
   $error = 1;
  }
  if($contrasenia_automatica == 0)
  {
   if($contrasenia == '')
   {
    $error_contrasenia = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Contrase&ntilde;a.</div>';
    $error = 1;	   
   }
   if($contrasenia2 == '')
   {
    $error_contrasenia2 = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Contrase&ntilde;a.</div>';
    $error = 1;	   
   }
   if($contrasenia != '' && $contrasenia2 != '' && $contrasenia != $contrasenia2)
   {
    $error_contrasenia = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Las Contrase&ntilde;as no coinciden.</div>';
    $error = 1;	   
   }
  }
  
  require_once ('modelo_crear_vendedor.php');
    
  if($crear)
  { 
   // Auditoria
   
   //para el envío en formato HTML 
   $headers = "MIME-Version: 1.0\r\n"; 
   $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
   //dirección del remitente 
   $headers .= "From: Schneider Electric<schneider_electric@latonegroup.com>\r\n";

   $asunto = "Nuevo Usuario en Schneider Electric";
   
   $mensaje = "<html>
     <body bgcolor='#FFFFFF' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' style='background-color:#fff'>
      <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center' bgcolor='#fff' style='background-color:#fff'>
	   <tr>
	    <td align='center' width='700'>
		 <table width='700' border='0' cellspacing='0' cellpadding='0' bgcolor='#fff' style='background-color:#fff'>
		  <tr>
		   <td><!--<img src='http://www.alejandrosanta.com/carrera/fotos/header/".$header."' width='700' height='150' border='0' style='display:block;' />--></td>
		  </tr>
		  <tr>
		   <td style='font-family: Arial, Helvetica, sans-serif;color:#000;font-size:16px; padding:20px;' align='left' valign='middle'>
		    (No responda este correo)
			<br><br>
			Un nuevo usuario ha sido creado para usted en nuestro Sistema. Esta es su información de acceso:
            <br><br>
			Correo Electr&oacute;nico: ".$correo_electronico."
			<br>
			Contraseña: ".$contrasenia." (Por favor modifiquela al ingresar al sistema)
			<br><br>
			Para ingresar haga clic <a href='http://13.58.209.73'>AQUÍ</a>
            <br><br>
			Muchas gracias.
			<br>
			Cordialmente
   		   </td>
		  </tr>
		  <tr>
		   <td><!--<img src='http://www.alejandrosanta.com/carrera/fotos/footer/".$footer."' width='700' height='70' border='0' style='display:block;' />--></td>
		  </tr>
		 </table>
	    </td>
       </tr>
      </table>
     </body>
    </html>";
	 
   mail($correo_electronico,$asunto,$mensaje,$headers);
   
   $mensaje = 21;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_vendedor.php?m='.$mensaje.'"</script>';
  }
  else
  {
   $mensaje = 22; 
  }
  require_once ('mensajes_vendedor.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_crear_vendedor.php');
 }
 
 $miga_pan .= '<li>Vendedor</li>';
  
?>