<?php
  
 // Hallar IP Visita
 function getRealIP()
 {
  if( @$_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
  {
   $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : "unknown" );
   $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
   reset($entries);
   while (list(, $entry) = each($entries))
   {
    $entry = trim($entry);
    if ( preg_match("/^([0-9]+\\.[0-9]+\\.[0-9]+\\.[0-9]+)/", $entry, $ip_list) )
    {
     $private_ip = array('/^0\\./','/^127\\.0\\.0\\.1/','/^192\\.168\\..*/','/^172\\.((1[6-9])|(2[0-9])|(3[0-1]))\\..*/','/^10\\..*/');
     $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
     if ($client_ip != $found_ip)
     {
      $client_ip = $found_ip;
      break;
     }
    }
   }
  }
  else
  {
   $client_ip = ( !empty($_SERVER['REMOTE_ADDR']) ) ? $_SERVER['REMOTE_ADDR'] : ( ( !empty($_ENV['REMOTE_ADDR']) ) ? $_ENV['REMOTE_ADDR'] : "unknown" );
  }
  return $client_ip;
 }
 
 // Almacena acciones de usuarios en Auditoria
 function auditoria($variable1,$variable2,$variable3,$variable4)
 {
  global $conexion; 

  // Mostrar Hora Servidor
  date_default_timezone_set("America/Bogota");
  
  // De la fecha actual, Halla el día, mes y año 
  $fecha = date('Y-m-d');
  // Halla la hora, minuto y segundo
  $hora = date('H:i:s');
  // IP Visitante
  $ip = getRealIP();
	
  //Se almacena accion, usuario y fecha 
  $auditoria1 = mysqli_query($conexion,"insert into auditoria (accion, modulo, perfil, usuario, fecha, hora, ip) values ('$variable1', '$variable3', '$variable4', '$variable2', '$fecha', '$hora', '$ip')"); 
 }

 function VerificarFecha($fecha) 
 {
  list($y,$m,$d) = explode("-",$fecha);
  if (is_numeric($y) && strlen($y)==4 && is_numeric($m) && strlen($m)==2 && is_numeric($d) && strlen($d)==2 && checkdate($m,$d,$y)) 
  {
   $validacion = 0;
  }
  else
  {
   $validacion = 1;
  }
  return $validacion;
 } 
 
 function CorreoElectronico($email,$asunto,$mensaje_email)
 {
  $mensaje = "<html>
   <body bgcolor='#FFFFFF' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' style='background-color:#fff'>
    <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center' bgcolor='#fff' style='background-color:#fff'>
	 <tr>
	  <td align='center' width='700'>
	   <table width='700' border='0' cellspacing='0' cellpadding='0' bgcolor='#fff' style='background-color:#fff'>
		<tr>
		 <td><img src='http://13.58.209.73/img/header.jpg' width='700' height='100' border='0' style='display:block;' /></td>
		</tr>
		<tr>
		 <td style='font-family: Arial, Helvetica, sans-serif;color:#000;font-size:16px; padding:20px;' align='left' valign='middle'>";
  $mensaje .= $mensaje_email;
  $mensaje .= "<br><br>
		  Cordialmente.
		  <br>
		  Sistema de Gestión de Canales Schneider Electric
   		 </td>
		</tr>
		<tr>
		 <td><img src='http://13.58.209.73/img/footer.jpg' width='700' height='40' border='0' style='display:block;' /></td>
		</tr>
	   </table>
	  </td>
     </tr>
    </table>
   </body>
  </html>";
 
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
  $headers .= "From: Sistema de Gestión de Distribuidores Schneider Electric <schneiderelectric@latonegroup.com>\r\n";
  
  $correo =  mail($email,$asunto,$mensaje,$headers);
 } 
 
 function FechaActual() 
 {
  $fecha_actual = date("Y-m-d");  
  return $fecha_actual;
 }
 
 function HoraActual() 
 {
  $hora_actual = date("H:i:s");
  return $hora_actual;
 }
 
?>