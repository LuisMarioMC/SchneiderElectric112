<?php
 
 require_once ('conexion_sesion.php');
 require_once ('funciones.php');
 
 $perfil = $_SESSION['perfil'];
 $usuario = $_SESSION['usuario'];
 $fecha_actual =  FechaActual();
 $hora_actual =  HoraActual();
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 6663;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_q = mysqli_query($conexion,"select * from q where id = $id_q");
 if(@mysqli_num_rows($consulta_q)==1)
 {
  $resultado_consulta_q = mysqli_fetch_array($consulta_q);
  $nombre_q = $resultado_consulta_q['nombre'];
  
  $id_anio = $resultado_consulta_q['anio'];
  $estado_q = $resultado_consulta_q['estado'];
  
  $consulta_anio = mysqli_query($conexion,"select * from anio where id = $id_anio");
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  $estado_anio = $resultado_consulta_anio['estado'];
  $nombre_anio = $resultado_consulta_anio['nombre'];

  $consulta_mes = mysqli_query($conexion,"select * from mes where q = $id_q and estado = 1");

  $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $usuario");
  $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
  $nombre_usuario_accion = $resultado_consulta_usuario['nombre'];
  
  if($estado_q == 0)
  {
   if($estado_anio == 1)
   {
    $activar = mysqli_query($conexion,"update q set estado = 1 where id = $id_q");
   
    if($activar)
	{
     $eliminar = @mysqli_query($conexion,"delete from aprobacion where q = $id_q");
	 
	 if($eliminar)
	 {
      $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$usuario','$perfil','APERTURA DE Q','$fecha_actual','$hora_actual')");
	 
	  $consulta_usuario = mysqli_query($conexion,"select * from usuario where perfil = 'admin'");
      while ($resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario))
	  {
	   $asunto = 'SCH Apertura '.$nombre_q.' '.$nombre_anio.'';
	   $asunto = utf8_decode($asunto);
	   
	   $id_usuario = $resultado_consulta_usuario[id];
       $nombre_usuario = $resultado_consulta_usuario[nombre];
	   $perfil_usuario = $resultado_consulta_usuario[perfil];
	   
       $mensaje_email = "
 	    Estimado <i>".$nombre_usuario."</i>.
	    <br>
	    Administrador.
	    <br><br>
	    Informamos que la apertura de ".$nombre_q." ".$nombre_anio." fue efectuada correctamente el ".$fecha_actual." a las ".$hora_actual." (UTC-5), por el usuario ".$nombre_usuario_accion." (".$perfil.").";
       $mensaje_email = utf8_decode($mensaje_email);

	   //$correo_electronico = $resultado_consulta_usuario[correo_electronico];
       $correo_electronico = 'alejandrosantaarciniegas@gmail.com, '.$resultado_consulta_usuario[correo_electronico];
	   
	   $correo =  CorreoElectronico($correo_electronico,$asunto,$mensaje_email);
	  
       $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$id_usuario','$perfil_usuario','EMAIL ABRIR Q','$fecha_actual','$hora_actual')");
	  }
	 }
	 
	}	
   }
   else
   {
    $error = 1;   
    $error3 = 1;
   }
  }
  elseif($estado_q == 1)
  {
   if(@mysqli_num_rows($consulta_mes)==0)
   {
    $inactivar = mysqli_query($conexion,"update q set estado = 0 where id = $id_q");
   
    if($inactivar)
	{
	 $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$usuario','$perfil','CIERRE DE Q','$fecha_actual','$hora_actual')");
    
     // Correo Electrónico Gerentes de Linea
	 $consulta_usuario = mysqli_query($conexion,"select * from usuario where perfil = 'linea'");
     while ($resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario))
	 {
	  $id_linea = $resultado_consulta_usuario[linea];
	  
	  $consulta_actividad = mysqli_query($conexion,"select * from actividad where linea = $id_linea and sell_out = 1");
	  if(mysqli_num_rows($consulta_actividad) > 0)
	  {	 
   	   $id_usuario = $resultado_consulta_usuario[id];
	   $nombre_usuario = $resultado_consulta_usuario[nombre];
	   $perfil_usuario = $resultado_consulta_usuario[perfil];

	   $asunto = 'SCH Cierre '.$nombre_q.' '.$nombre_anio.'';
   	   $asunto = utf8_decode($asunto);
	  
	   $consulta_linea = mysqli_query($conexion,"select * from linea where id = $id_linea");
       $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
	  
	   $nombre_linea = $resultado_consulta_linea[nombre];
	  
       $mensaje_email = "
 	    Estimado <i>".$nombre_usuario."</i>.
	    <br>
	    Gerente L&iacute;nea ".$nombre_linea.".
	    <br><br>
	    Informamos que el cierre de ".$nombre_q." ".$nombre_anio." fue efectuado y la informaci&oacute;n de la l&iacute;nea ".$nombre_linea." est&aacute; disponible para aprobar cada distribuidor.";
      
	   $mensaje_email = utf8_decode($mensaje_email);
	  
	   //$correo_electronico = $resultado_consulta_usuario[correo_electronico];
       $correo_electronico = 'alejandrosantaarciniegas@gmail.com, '.$resultado_consulta_usuario[correo_electronico];
	   
	   $correo =  CorreoElectronico($correo_electronico,$asunto,$mensaje_email);
	  
       $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$id_usuario','$perfil_usuario','EMAIL CERRAR Q','$fecha_actual','$hora_actual')");
	  }
	 }

     // Correo Electrónico Administrador		 
	 $consulta_usuario = mysqli_query($conexion,"select * from usuario where perfil = 'admin'");
     while ($resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario))
	 {
	  $asunto = 'SCH Cierre '.$nombre_q.' '.$nombre_anio.'';
	  $asunto = utf8_decode($asunto);

	  $id_usuario = $resultado_consulta_usuario[id];
      $nombre_usuario = $resultado_consulta_usuario[nombre];
	  $perfil_usuario = $resultado_consulta_usuario[perfil];
	   
      $mensaje_email = "
 	   Estimado <i>".$nombre_usuario."</i>.
	   <br>
	   Administrador.
	   <br><br>
	   Informamos que el cierre de ".$nombre_q." ".$nombre_anio." fue efectuada correctamente el ".$fecha_actual." a las ".$hora_actual." (UTC-5), por el usuario ".$nombre_usuario_accion." (".$perfil.").";
      
	  $mensaje_email = utf8_decode($mensaje_email);
	  
	  //$correo_electronico = $resultado_consulta_usuario[correo_electronico];
      $correo_electronico = 'alejandrosantaarciniegas@gmail.com, '.$resultado_consulta_usuario[correo_electronico];
	   
	  $correo =  CorreoElectronico($correo_electronico,$asunto,$mensaje_email);
	 
      $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$id_usuario','$perfil_usuario','EMAIL CERRAR Q','$fecha_actual','$hora_actual')");
	 }
	 	 
	 $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil = 'distribuidor' order by id desc");
     while ($resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor))
     {
      $consulta_actividad = mysqli_query($conexion,"select * from actividad where sell_out = 1 order by nombre asc");
      while ($resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad))
      {
       $id_distribuidor = $resultado_consulta_distribuidor['id'];
       $id_pais = $resultado_consulta_distribuidor['pais'];
	
       $id_actividad = $resultado_consulta_actividad['id'];
       $id_linea = $resultado_consulta_actividad['linea'];
   
       // Venta
	   $venta_actividad = 0;
	   $consulta_detalle_sell_out = mysqli_query($conexion,"select * from detalle_sell_out where id_distribuidor = '$id_distribuidor' and id_anio = '$id_anio' and id_q = '$id_q' and id_actividad = '$id_actividad'");
	   while($resultado_consulta_detalle_sell_out = mysqli_fetch_array($consulta_detalle_sell_out))
	   {
		$venta_actividad = $venta_actividad + ($resultado_consulta_detalle_sell_out['int_unidades'] * $resultado_consulta_detalle_sell_out['float_precio']);
	   }

	   // Meta   
	   $consulta_meta_sell_out = mysqli_query($conexion,"select * from meta_sell_out where distribuidor = '$id_distribuidor' and anio = '$id_anio' and actividad = '$id_actividad'");
	   if(mysqli_num_rows($consulta_meta_sell_out) == 0)
	   {
		$meta = 0;
		$comision = 0;
	   }
	   else
	   {	   
		$resultado_consulta_meta_sell_out = mysqli_fetch_array($consulta_meta_sell_out);
		$id_meta_sell_out = $resultado_consulta_meta_sell_out['id'];
		  
		$consulta_meta_q_sell_out = mysqli_query($conexion,"select * from meta_q_sell_out where meta_sell_out = $id_meta_sell_out and q = $id_q");
		$resultado_consulta_meta_q_sell_out = mysqli_fetch_array($consulta_meta_q_sell_out);
		  
		$meta = $resultado_consulta_meta_q_sell_out['meta'];
		
		$comision = $resultado_consulta_meta_q_sell_out['comision'];
	   }
   
       // Bonificacion
       if($venta_actividad >= $meta)
       {
        $bonificacion = $comision * $venta_actividad / 100;
       }
       else
       {
        $bonificacion = 0;
       }
      
       $crear = mysqli_query($conexion,"insert into aprobacion (q,anio,distribuidor,pais,linea,actividad,venta,meta,comision,bonificacion) values ('$id_q','$id_anio','$id_distribuidor','$id_pais','$id_linea','$id_actividad','$venta_actividad','$meta','$comision','$bonificacion')");
	  }
	 }
	 
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
 }
 else
 {
  $error = 1;
  $error1 = 1;  
 }
  
?>