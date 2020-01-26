<?php
  
 $error = 0;
 $crear = 0;
 
 $nombre = '';
 $correo_electronico = '';
 $celular = '';
 $perfil = '';
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
  $perfil = trim(mysqli_real_escape_string($conexion,$_POST['perfil']));
  $contrasenia_automatica = !empty($_POST['contrasenia_automatica'])? mysqli_real_escape_string($conexion,$_POST['contrasenia_automatica']):0;
  if($contrasenia_automatica == 1)
  {
   $checked_contrasenia_automatica = 'checked';   
  }
  else
  {
   $contrasenia = trim(mysqli_real_escape_string($conexion,$_POST['contrasenia']));
   $contrasenia2 = trim(mysqli_real_escape_string($conexion,$_POST['contrasenia2']));
  }
  
  $error_nombre = '';
  $error_correo_electronico = '';
  $error_celular = '';
  $error_contrasenia = '';
  $error_contrasenia2 = '';
  $error_pais = ''; 
  $error_linea = '';
  $error_zona = '';
  $error_distribuidor = '';
  
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
  
  if($error == 0)
  {
   if($perfil == 'canal')
   {
    $pais = !empty($_POST['pais'])? mysqli_real_escape_string($conexion,$_POST['pais']):0;
    if($pais == 0)
    {
     $error_pais = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Pa&iacute;s.</div>';
     $error = 1;
    }
   }
   if($perfil == 'linea')
   {
    $linea = !empty($_POST['linea'])? mysqli_real_escape_string($conexion,$_POST['linea']):0;
    if($linea == 0)
    {
     $error_linea = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar L&iacute;nea.</div>';
     $error = 1;
    }
   }
   if($perfil == 'distribuidor')
   {
    $pais = !empty($_POST['pais'])? mysqli_real_escape_string($conexion,$_POST['pais']):0;
    if($pais == 0)
    {
	 $error_pais = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Pa&iacute;s.</div>';
 	 $error = 1;
    }
    $zona = !empty($_POST['zona'])? mysqli_real_escape_string($conexion,$_POST['zona']):0;
    if($zona == 0)
    {
 	 $error_zona = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Zona.</div>';
	 $error = 1;
    }
   }
   
  }
  
  require_once ('modelo_crear_usuario.php');
    
  if($crear)
  { 
   if($perfil == 'admin')
   {
    $asunto = 'SCH Creación de Administrador '.$nombre.'';
   
    $mensaje_email = "
 	 Estimado Administrador <i>".$nombre."</i>.
	 <br><br>
	 Confirmamos la creación de su usuario en el Sistema de Gestión de Distribuidores Schneider Electric.
	 <br><br>
	 La información de la cuenta es la siguiente:
	 <br>
	 <b>Nombre:</b> ".$nombre."
	 <br><br>
	 Los datos de acceso son los siguientes:
	 <br>
	 <b>Login:</b> ".$correo_electronico."
	 <br>
	 <b>Contraseña:</b> ".$contrasenia."";
   }
   
   if($perfil == 'cartera')
   {
    $asunto = 'SCH Creación de Gerente de Cartera '.$nombre.'';
   
    $mensaje_email = "
 	 Estimado Gerente de Cartera <i>".$nombre."</i>.
	 <br><br>
	 Confirmamos la creación de su usuario en el Sistema de Gestión de Distribuidores Schneider Electric.
	 <br><br>
	 La información de la cuenta es la siguiente:
	 <br>
	 <b>Nombre:</b> ".$nombre."
	 <br><br>
	 Los datos de acceso son los siguientes:
	 <br>
	 <b>Login:</b> ".$correo_electronico."
	 <br>
	 <b>Contraseña:</b> ".$contrasenia."";
   }
   
   if($perfil == 'canal')
   {
    $asunto = 'SCH Creación de Gerente de Canal '.$nombre.'';
   
    $mensaje_email = "
 	 Estimado Gerente de Canal <i>".$nombre."</i>.
	 <br><br>
	 Confirmamos la creación de su usuario en el Sistema de Gestión de Distribuidores Schneider Electric.
	 <br><br>
	 La información de la cuenta es la siguiente:
	 <br>
	 <b>Nombre:</b> ".$nombre."
	 <br><br>
	 Los datos de acceso son los siguientes:
	 <br>
	 <b>Login:</b> ".$correo_electronico."
	 <br>
	 <b>Contraseña:</b> ".$contrasenia."";
   }

   if($perfil == 'linea')
   {
    $asunto = 'SCH Creación de Gerente de Línea '.$nombre.'';
   
    $mensaje_email = "
 	 Estimado Gerente de Línea <i>".$nombre."</i>.
	 <br><br>
	 Confirmamos la creación de su usuario en el Sistema de Gestión de Distribuidores Schneider Electric.
	 <br><br>
	 La información de la cuenta es la siguiente:
	 <br>
	 <b>Nombre:</b> ".$nombre."
	 <br><br>
	 Los datos de acceso son los siguientes:
	 <br>
	 <b>Login:</b> ".$correo_electronico."
	 <br>
	 <b>Contraseña:</b> ".$contrasenia."";
   }
   
   if($perfil == 'distribuidor')
   {
    $asunto = 'SCH Creación de Distribuidor '.$nombre.'';
   
    $mensaje_email = "
 	 Estimado Distribuidor <i>".$nombre."</i>.
	 <br><br>
	 Confirmamos la creación de su usuario en el Sistema de Gestión de Distribuidores Schneider Electric.
	 <br><br>
	 La información de la cuenta es la siguiente:
	 <br>
	 <b>Nombre:</b> ".$nombre."
	 <br>
	 <b>Pais:</b> ".$nombre_pais."
	 <br>
	 <b>Zona:</b> ".$nombre_zona."
	 <br><br>
	 Los datos de acceso son los siguientes:
	 <br>
	 <b>Login:</b> ".$correo_electronico."
	 <br>
	 <b>Contraseña:</b> ".$contrasenia."";
   }
   
   if($perfil == 'vendedor')
   {
    $asunto = 'SCH Creación de Ejecutivo de Ventas '.$nombre.' para el Distribuidor '.$nombre_distribuidor.'';
   
    $mensaje_email = "
 	 Estimado Ejecutivo de Ventas <i>".$nombre."</i>.
	 <br><br>
	 Confirmamos la creación de su usuario en el Sistema de Gestión de Distribuidores Schneider Electric.
	 <br><br>
	 La información de la cuenta es la siguiente:
	 <br>
	 <b>Nombre:</b> ".$nombre."
	 <br>
	 <b>Distribuidor:</b> ".$nombre_distribuidor."
	 <br><br>
	 Los datos de acceso son los siguientes:
	 <br>
	 <b>Login:</b> ".$correo_electronico."
	 <br>
	 <b>Contraseña:</b> ".$contrasenia."";
    $correo_electronico = ''.$correo_electronico.','.$correo_electronico_distribuidor.'';
   }
   
   $correo =  CorreoElectronico($correo_electronico,$asunto,$mensaje_email);

   $mensaje = 21;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_usuario.php?m='.$mensaje.'"</script>';
  }
  else
  {
   $mensaje = 22; 
  }
  require_once ('mensajes_usuario.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_crear_usuario.php');
 }
 
 $miga_pan .= '<li>Usuario</li>';

 $menu_perfil = '<select id="perfil" name="perfil" class="form-control" required/>';
 $menu_perfil .= '<option value = ""> Seleccionar ';
 if($_SESSION['perfil']=='admin')
 {
  // Admin
  if($perfil == 'admin')
  {
   $menu_perfil .= ' <option value = "admin" selected>Administrador</option>';
  }
  else
  {
   $menu_perfil .= ' <option value = "admin">Administrador</option>';
  }
  // Super Schneider
  if($perfil == 'super_schneider')
  {
   $menu_perfil .= ' <option value = "super_schneider" selected>Super Schneider</option>';
  }
  else
  {
   $menu_perfil .= ' <option value = "super_schneider">Super Schneider</option>';
  }
  // Admin Schneider
  if($perfil == 'admin_schneider')
  {
   $menu_perfil .= ' <option value = "admin_schneider" selected>Administrador Schneider</option>';
  }
  else
  {
   $menu_perfil .= ' <option value = "admin_schneider">Administrador Schneider</option>';
  }
  // Cartera
  if($perfil == 'cartera')
  {
   $menu_perfil .= ' <option value = "cartera" selected>Cartera</option>';
  }
  else
  {
   $menu_perfil .= ' <option value = "cartera">Cartera</option>';
  }
  // Gerente de Canal
  if($perfil == 'canal')
  {
   $menu_perfil .= ' <option value = "canal" selected>Gerente de Canal</option>';
  }
  else
  {
   $menu_perfil .= ' <option value = "canal">Gerente de Canal</option>';
  }
  // Gerente de Linea
  if($perfil == 'linea')
  {
   $menu_perfil .= ' <option value = "linea" selected>Gerente de Linea</option>';
  }
  else
  {
   $menu_perfil .= ' <option value = "linea">Gerente de Linea</option>';
  }
  // Gerente de Actividad
  if($perfil == 'actividad')
  {
   $menu_perfil .= ' <option value = "actividad" selected>Gerente de Actividad</option>';
  }
  else
  {
   $menu_perfil .= ' <option value = "actividad">Gerente de Actividad</option>';
  }
  // Gerente de Segmento
  if($perfil == 'segmento')
  {
   $menu_perfil .= ' <option value = "segmento" selected>Gerente de Segmento</option>';
  }
  else
  {
   $menu_perfil .= ' <option value = "segmento">Gerente de Segmento</option>';
  }
  // Gerente de Zona
  if($perfil == 'zona')
  {
   $menu_perfil .= ' <option value = "zona" selected>Gerente de Zona</option>';
  }
  else
  {
   $menu_perfil .= ' <option value = "zona">Gerente de Zona</option>';
  }
  // Distribuidor
  if($perfil == 'distribuidor')
  {
   $menu_perfil .= ' <option value = "distribuidor" selected>Distribuidor</option>';
  }
  else
  {
   $menu_perfil .= ' <option value = "distribuidor">Distribuidor</option>';
  }
  // Vendedor
  if($perfil == 'vendedor')
  {
   $menu_perfil .= ' <option value = "vendedor" selected>Vendedor</option>';
  }
  else
  {
   $menu_perfil .= ' <option value = "vendedor">Vendedor</option>';
  }
 } 
 $menu_perfil .= '</select>';
 
?>