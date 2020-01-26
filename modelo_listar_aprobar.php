<?php

 require_once ('conexion_sesion.php');
  
 $perfil = $_SESSION['perfil'];
 $usuario = $_SESSION['usuario'];
 $id_anio = 10;
 $id_q = 35;
 $fecha_actual = FechaActual();
 $hora_actual = HoraActual();
  
 if($perfil != 'admin' && $perfil != 'cartera' && $perfil != 'canal' && $perfil != 'linea')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 // Nombre de Q y Anio
 $consulta_q = mysqli_query($conexion,"select * from q where id = $id_q");
 $resultado_consulta_q = mysqli_fetch_array($consulta_q);
 $nombre_q = $resultado_consulta_q['nombre'];
 $anio = $resultado_consulta_q['anio'];
	  
 $consulta_anio = mysqli_query($conexion,"select * from anio where id = $anio");
 $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
 $nombre_anio = $resultado_consulta_anio['nombre'];
 
 // Consulta Usuario
 $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $usuario");
 $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
 $nombre_usuario_accion = $resultado_consulta_usuario[nombre];
 $id_linea = $resultado_consulta_usuario[linea];
 $id_canal = $resultado_consulta_usuario[pais];
 
 $aprobado = 0;
 $boton_aprobar = '';
 $consulta_usuario_aprobacion = mysqli_query($conexion,"select * from auditoria_q where q = '$id_q' and usuario = '$usuario' and perfil = '$perfil' and accion = 'APROBAR'");
 if(mysqli_num_rows($consulta_usuario_aprobacion) == 0)
 {
  //$mensaje_alerta = '<div class="alert alert-danger">El Trimestre no ha sido Aprobado.</div>';
  if($_POST[aprobar])
  {
   $crear = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$usuario','$perfil','APROBAR','$fecha_actual','$hora_actual')");
  
   if($crear)
   {
	   
    // Envía Correo a Administradores
    $consulta_usuario = mysqli_query($conexion,"select * from usuario where perfil = 'admin'");
    while ($resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario))
    {
 	 if($perfil == 'linea')
     {
	  $consulta_linea = mysqli_query($conexion,"select * from linea where id = $id_linea");
      $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
	  $nombre_linea = $resultado_consulta_linea[nombre];
	  $asunto = 'SCH Aprobado Linea '.$nombre_linea.' '.$nombre_q.' '.$nombre_anio.'';
     }
	 if($perfil == 'canal')
     {
	  $consulta_canal = mysqli_query($conexion,"select * from pais where id = $id_canal");
      $resultado_consulta_canal = mysqli_fetch_array($consulta_canal);
	  $nombre_canal = $resultado_consulta_canal[nombre];
	  $asunto = 'SCH Aprobado Canal '.$nombre_canal.' '.$nombre_q.' '.$nombre_anio.'';
     }
	 if($perfil == 'cartera')
     {
	  $asunto = 'SCH Aprobado Cartera '.$nombre_q.' '.$nombre_anio.'';
     }
	 
	 $asunto = utf8_decode($asunto);
	 
     $id_usuario = $resultado_consulta_usuario[id];
     $nombre_usuario = $resultado_consulta_usuario[nombre];
	 $perfil_usuario = $resultado_consulta_usuario[perfil];
   	 
	 if($perfil == 'linea')
     {
      $mensaje_email = "
 	   Estimado <i>".$nombre_usuario."</i>.
	   <br>
	   Administrador
	   <br>
	   Informamos que la aprobaci&oacute;n de la L&iacute;nea ".$nombre_linea." de ".$nombre_q." ".$nombre_anio." fue efectuada correctamente el ".$fecha_actual." a las ".$hora_actual." (UTC-5), por el usuario ".$nombre_usuario_accion.".";
	 }
	 if($perfil == 'canal')
     {
      $mensaje_email = "
 	   Estimado <i>".$nombre_usuario."</i>.
	   <br>
	   Administrador
	   <br>
	   Informamos que la aprobaci&oacute;n del Canal ".$nombre_canal." de ".$nombre_q." ".$nombre_anio." fue efectuada correctamente el ".$fecha_actual." a las ".$hora_actual." (UTC-5), por el usuario ".$nombre_usuario_accion.".";
     }
	 if($perfil == 'cartera')
     {
      $mensaje_email = "
 	   Estimado <i>".$nombre_usuario."</i>.
	   <br>
	   Administrador
	   <br>
	   Informamos que la aprobaci&oacute;n de Cartera de ".$nombre_q." ".$nombre_anio." fue efectuada correctamente el ".$fecha_actual." a las ".$hora_actual." (UTC-5), por el usuario ".$nombre_usuario_accion.".";
     }
	  
	 $mensaje_email = utf8_decode($mensaje_email);
	  
	 //$correo_electronico = $resultado_consulta_usuario[correo_electronico];
     $correo_electronico = 'alejandrosantaarciniegas@gmail.com, '.$resultado_consulta_usuario[correo_electronico];
     $correo =  CorreoElectronico($correo_electronico,$asunto,$mensaje_email);
    
     $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$id_usuario','$perfil_usuario','EMAIL APROBAR','$fecha_actual','$hora_actual')");
    }  
   }
   
   $cantidad_usuario_perfil = 0;

   if($perfil == 'linea')
   {
    $consulta_linea = mysqli_query($conexion,"select * from linea");
    while ($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
    {
	 $id_linea = $resultado_consulta_linea[id];
	  
	 $consulta_actividad = mysqli_query($conexion,"select * from actividad where linea = '$id_linea' and sell_out = 1");
	 if(mysqli_num_rows($consulta_actividad) > 0)
	 {
      $cantidad_usuario_perfil++;
     }
    }
   }
   
   if($perfil == 'canal')
   {
	$consulta_pais = mysqli_query($conexion,"select * from pais where estado = 1");
    $cantidad_usuario_perfil = mysqli_num_rows($consulta_pais);
   }
   
   if($perfil == 'cartera')
   {
    $cantidad_usuario_perfil = 1;
   }
    
   $consulta_perfil_aprobacion = mysqli_query($conexion,"select * from auditoria_q where q = '$id_q' and perfil = '$perfil' and accion = 'APROBAR'");
   $cantidad_usuario_aprobacion = mysqli_num_rows($consulta_perfil_aprobacion);
   
   if($perfil == 'linea')
   {
    $accion = ''.$cantidad_usuario_aprobacion.' APROBACIONES DE '.$cantidad_usuario_perfil.' PARA LINEA';
   }
   if($perfil == 'canal')
   {
    $accion = ''.$cantidad_usuario_aprobacion.' APROBACIONES DE '.$cantidad_usuario_perfil.' PARA CANAL';
   }
   if($perfil == 'cartera')
   {
    $accion = ''.$cantidad_usuario_aprobacion.' APROBACIONES DE '.$cantidad_usuario_perfil.' PARA CARTERA';
   }

   $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','sistema','SISTEMA','$accion','$fecha_actual','$hora_actual')");
   
   if($cantidad_usuario_perfil == $cantidad_usuario_aprobacion)
   {	
    if($perfil == 'linea')
    {
	 $consulta_usuario = mysqli_query($conexion,"select * from usuario where perfil = 'canal'");
     while ($resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario))
	 {
	  $asunto = 'SCH Cierre Aprobado por Gerentes de Linea '.$nombre_q.' '.$nombre_anio.'';
      $asunto = utf8_decode($asunto);

      $id_usuario = $resultado_consulta_usuario[id];
      $nombre_usuario = $resultado_consulta_usuario[nombre];
	  $perfil_usuario = $resultado_consulta_usuario[perfil];
   
      $id_pais = $resultado_consulta_usuario[pais];
	  
	  $consulta_pais = mysqli_query($conexion,"select * from pais where id = $id_pais");
      $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
	  $nombre_pais = $resultado_consulta_pais[nombre];
	  
      $mensaje_email = "
 	   Estimado <i>".$nombre_usuario."</i>.
	   <br>
	   Gerente Canal ".$nombre_pais.".
	   <br><br>
	   Informamos que el cierre de ".$nombre_q." ".$nombre_anio." fue efectuado, aprobado por los Gerentes de L&iacute;nea y la informaci&oacute;n del pa&iacute;s ".$nombre_pais." est&aacute; disponible para aprobar cada distribuidor.";
      
	  $mensaje_email = utf8_decode($mensaje_email);
	  
	  $correo_electronico = 'alejandrosantaarciniegas@gmail.com, '.$resultado_consulta_usuario[correo_electronico];
      $correo =  CorreoElectronico($correo_electronico,$asunto,$mensaje_email);
	 
	  $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$id_usuario','$perfil_usuario','EMAIL APROBAR','$fecha_actual','$hora_actual')");
	 }
	}
	if($perfil == 'canal')
    {
	 $consulta_usuario = mysqli_query($conexion,"select * from usuario where perfil = 'cartera'");
     while ($resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario))
	 {
	  $asunto = 'SCH Cierre Aprobado por Gerentes de Canal '.$nombre_q.' '.$nombre_anio.'';
      $asunto = utf8_decode($asunto);
   
      $id_usuario = $resultado_consulta_usuario[id];
      $nombre_usuario = $resultado_consulta_usuario[nombre];
	  $perfil_usuario = $resultado_consulta_usuario[perfil];
	  	  
      $mensaje_email = "
 	   Estimado <i>".$nombre_usuario."</i>.
	   <br>
	   Gerente Cartera.
	   <br><br>
	   Informamos que el cierre de ".$nombre_q." ".$nombre_anio." fue efectuado, aprobado por los Gerentes de L&iacute;nea y Canal, y la informaci&oacute;n est&aacute; disponible para aprobar cada distribuidor.";
      
	  $mensaje_email = utf8_decode($mensaje_email);
	  
	  //$correo_electronico = $resultado_consulta_usuario[correo_electronico];
  	  $correo_electronico = 'alejandrosantaarciniegas@gmail.com, '.$resultado_consulta_usuario[correo_electronico];
	  $correo =  CorreoElectronico($correo_electronico,$asunto,$mensaje_email);
	 
	  $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$id_usuario','$perfil_usuario','EMAIL APROBAR','$fecha_actual','$hora_actual')");
	 }
	}
	if($perfil == 'cartera')
    {
	 $consulta_usuario = mysqli_query($conexion,"select * from usuario where perfil != 'admin' and perfil != 'cartera' and perfil != 'sistema'");
     while ($resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario))
	 {
	  $asunto = 'SCH Cierre de Trimestre Aprobado por Schneider Electric '.$nombre_q.' '.$nombre_anio.'';
      $asunto = utf8_decode($asunto);
   
      $id_usuario = $resultado_consulta_usuario[id];
      $nombre_usuario = $resultado_consulta_usuario[nombre];
	  $perfil_usuario = $resultado_consulta_usuario[perfil];
	  
	  if($perfil_usuario == 'actividad'){$cargo = 'Gerente de Actividad';}
	  if($perfil_usuario == 'canal'){$cargo = 'Gerente de Canal';}
	  if($perfil_usuario == 'distribuidor'){$cargo = 'Distribuidor';}
	  if($perfil_usuario == 'linea'){$cargo = 'Gerente de L&iacute;nea';}
	  if($perfil_usuario == 'segmento'){$cargo = 'Gerente de Segmento';}
	  if($perfil_usuario == 'vendedor'){$cargo = 'Asesor Comercial';}
	  if($perfil_usuario == 'zona'){$cargo = 'Gerente de Zona';}	  
	  
      $mensaje_email = "
 	   Estimado <i>".$nombre_usuario."</i>.
	   <br>
	   ".$cargo.".
	   <br><br>
	   Informamos que el cierre de Trimestre ".$nombre_q." ".$nombre_anio." fue realizado por Schneider Electric, y la informaci&oacute;n est&aacute; disponible en la aplicaci&oacute;n para su respectivo an&aacute;lisis.";
      
	  $mensaje_email = utf8_decode($mensaje_email);
	  
	  //$correo_electronico = $resultado_consulta_usuario[correo_electronico];
  	  $correo_electronico = 'alejandrosantaarciniegas@gmail.com, '.$resultado_consulta_usuario[correo_electronico];
	  $correo =  CorreoElectronico($correo_electronico,$asunto,$mensaje_email);
	 
	  $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$id_usuario','$perfil_usuario','EMAIL APROBAR','$fecha_actual','$hora_actual')");
	 }
	}
	
   }
  
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_aprobar.php"</script>';
  }
 }
 else
 {
  $mensaje_alerta = '<div class="alert alert-success">El Trimestre ya fue Aprobado.</div>';
  $aprobado = 1;
 }
 
 $id_bonificar = !empty($_GET['id'])? $_GET['id']:0;
 $id_bonificar = mysqli_real_escape_string($conexion,$id_bonificar);
 if($id_bonificar != 0)
 {
  if($aprobado == 1)
  {
   $mensaje = 663;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
  }
  
  $consulta_aprobar = mysqli_query($conexion,"select * from aprobacion where id = $id_bonificar");
  if(mysqli_num_rows($consulta_aprobar) == 1)
  {
   $resultado_consulta_aprobar = mysqli_fetch_array($consulta_aprobar);
   $estado = $resultado_consulta_aprobar['estado'];
   $venta = $resultado_consulta_aprobar['venta'];
   $meta = $resultado_consulta_aprobar['meta'];
   $comision = $resultado_consulta_aprobar['comision'];
   $bonificacion = $resultado_consulta_aprobar['bonificacion'];
   $linea = $resultado_consulta_aprobar['linea'];
   $pais = $resultado_consulta_aprobar['pais'];

   if($perfil == 'linea' && $linea != $id_linea)
   {
    $mensaje = 6601;
    echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
   }
   if($perfil == 'canal' && $pais != $id_canal)
   {
    $mensaje = 661;
    echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
   }
  
   if($estado == 0)
   {
	if($venta > 0 && $bonificacion == 0 && $meta > 0)
	{
     $bonificacion = $comision * $venta / 100;
	 $modificar = @mysqli_query($conexion,"update aprobacion set estado = '1', bonificacion = '$bonificacion' where id = '$id_bonificar'");
     echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_aprobar.php"</script>';
	}
    else
    {
     $mensaje = 6602;
     echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
	}
   }	  
   if($estado == 1)
   {
    if($venta < $meta)
	{
	 $modificar = @mysqli_query($conexion,"update aprobacion set estado = '0', bonificacion = 0 where id = '$id_bonificar'");
     echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_aprobar.php"</script>';
	}
	else
    {
     $mensaje = 6603;
     echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
	}
   }  
  }
  else
  {
   $mensaje = 6604;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
  }
 }
 
 if($perfil == 'linea')
 {
  $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $usuario");
  $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
  $id_linea = $resultado_consulta_usuario['linea'];
  
  $consulta_aprobar = mysqli_query($conexion,"select * from aprobacion where linea = $id_linea and a_linea = 0 order by id desc");
 }
 if($perfil == 'canal')
 {
  $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $usuario");
  $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
  $id_pais = $resultado_consulta_usuario[pais];
  
  $consulta_aprobar = mysqli_query($conexion,"select * from aprobacion where pais = $id_pais and a_canal = 0 order by id desc");
 }
 if($perfil == 'cartera')
 {
  $consulta_aprobar = mysqli_query($conexion,"select * from aprobacion order by id desc");
 }
 
 $i = 1;
 while ($resultado_consulta_aprobar = mysqli_fetch_array($consulta_aprobar))
 {
  // Id
  $aprobacion[$i]['id'] = $resultado_consulta_aprobar['id'];

  // Estado
  $aprobacion[$i]['estado'] = $resultado_consulta_aprobar['estado'];
  
  // Distribuidor
  $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = $resultado_consulta_aprobar[distribuidor]");
  $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
  $aprobacion[$i]['distribuidor'] = $resultado_consulta_distribuidor['nombre'];

  // Pais
  $consulta_pais = mysqli_query($conexion,"select * from pais where id = $resultado_consulta_aprobar[pais]");
  $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
  $aprobacion[$i]['pais'] = $resultado_consulta_pais['nombre'];
  
  // Linea
  $consulta_linea = mysqli_query($conexion,"select * from linea where id = $resultado_consulta_aprobar[linea]");
  $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
  $aprobacion[$i]['linea'] = $resultado_consulta_linea['nombre'];
  
  // Actividad
  $consulta_actividad = mysqli_query($conexion,"select * from actividad where id = $resultado_consulta_aprobar[actividad]");
  $resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad);
  $aprobacion[$i]['actividad'] = $resultado_consulta_actividad['nombre'];
  
  // Venta
  $aprobacion[$i]['venta'] = $resultado_consulta_aprobar['venta'];

  // Meta
  $aprobacion[$i]['meta'] = $resultado_consulta_aprobar['meta'];

  // Bonificación
  $aprobacion[$i]['bonificacion'] = $resultado_consulta_aprobar['bonificacion'];
  
  $i++;   
 }

?>