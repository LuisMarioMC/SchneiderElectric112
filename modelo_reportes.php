<?php
 
 $perfil = $_SESSION['perfil'];
 
 if($perfil != 'admin' && $perfil != 'distribuidor' && $perfil != 'super_schneider'  && $perfil != 'admin_schneider')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

 if($perfil == 'admin')
 {
  if($error == 0)
  {
   $modificar = mysqli_query($conexion,"update reporte set motivo_rechazo = '$motivo_rechazo', estado = '2' where id = '$id_modificar'");
  }
  
  if($modificar)
  {
   $consulta_reporte = mysqli_query($conexion,"select * from reporte where id = '$id_modificar'");  
   $resultado_consulta_reporte = mysqli_fetch_array($consulta_reporte);
   $id_distribuidor = $resultado_consulta_reporte['distribuidor'];
   $id_mes = $resultado_consulta_reporte['mes'];
	  
   $consulta_mes = mysqli_query($conexion,"select * from mes where id = $id_mes");
   $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
   $nombre_mes = $resultado_consulta_mes['nombre'];

   $consulta_anio = mysqli_query($conexion,"select * from anio where id = $resultado_consulta_mes[anio]");
   $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
   $nombre_anio = $resultado_consulta_anio['nombre'];
   
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = $id_distribuidor");
   $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
   $nombre_distribuidor = $resultado_consulta_distribuidor['nombre'];
   $correo_electronico_distribuidor = $resultado_consulta_distribuidor['correo_electronico'];
	  	  
   // Correo Distribuidor
   $asunto = 'SCH Hay un inconveniente con su reporte de Inventario y/o Ventas '.$nombre_mes.' '.$nombre_anio.' '.$nombre_distribuidor.'';

   $mensaje_email = "
	Distribuidor ".$nombre_distribuidor.".
	<br><br>
    Nos permitimos informarle que los reportes de inventario y ventas correspondiente al mes de ".$nombre_mes." de ".$nombre_anio." fueron rechazados debido al siguiente motivo:  
	<br><br>
    ".$motivo_rechazo."";
  
   $correo =  CorreoElectronico($correo_electronico_distribuidor,$asunto,$mensaje_email);
  }
  
 }
 
 if($perfil == 'distribuidor')
 {
  $id_distribuidor = !empty($_SESSION['usuario'])? mysqli_real_escape_string($conexion,$_SESSION['usuario']):0;
  
  if($id_distribuidor == 0)
  {
   $mensaje = 666;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
  }
  
  if($error == 0) 
  {
   $consulta_mes = mysqli_query($conexion,"select * from mes where id = $id_mes");
   $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
   $nombre_mes = $resultado_consulta_mes['nombre'];

   $consulta_anio = mysqli_query($conexion,"select * from anio where id = $resultado_consulta_mes[anio]");
   $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
   $nombre_anio = $resultado_consulta_anio['nombre'];
   
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = $id_distribuidor");
   $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
   $nombre_distribuidor = $resultado_consulta_distribuidor['nombre'];
   $correo_electronico_distribuidor = $resultado_consulta_distribuidor['correo_electronico'];
  
   $aleatorio = rand(10000, 99999);
   $version = 1;

   $consulta_reporte_repetido = mysqli_query($conexion,"select * from reporte where mes = $id_mes and distribuidor = $id_distribuidor and estado != 2");
   $cantidad_reportes_repetido = mysqli_num_rows($consulta_reporte_repetido);
   if($cantidad_reportes_repetido > 0)
   {
    echo '<script language="JavaScript" type="text/javascript">document.location.href="principal.php"</script>';
   	exit();
   }
   
   $consulta_reporte = mysqli_query($conexion,"select * from reporte where mes = $id_mes and distribuidor = $id_distribuidor");
   $cantidad_reportes = mysqli_num_rows($consulta_reporte);

   if($cantidad_reportes > 0)
   {
    $consulta_reporte_rechazado = mysqli_query($conexion,"select * from reporte where mes = $id_mes and distribuidor = $id_distribuidor and estado = 2");
    $cantidad_reportes_rechazado = mysqli_num_rows($consulta_reporte_rechazado);
	
    if($cantidad_reportes == $cantidad_reportes_rechazado)
    {
     $version = $cantidad_reportes + 1;   
    }
    else
    {
     $mensaje = 666;
     echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
    }
   }
  }
  
  if($error == 0) 
  {
   $cortar = explode(".", $documento_reporte_ventas);
   $extension = end($cortar);
   $documento_reporte_ventas = 'VENTAS-'.$nombre_distribuidor.'-'.$nombre_mes.'('.$nombre_anio.')-V.'.$version.'-'.$aleatorio.'.'.$extension.'';
   $directorio_reporte_ventas = "reporte_ventas/";
   $destino_reporte_ventas = $directorio_reporte_ventas.$documento_reporte_ventas;
  
   $subir_reporte_ventas = move_uploaded_file($_FILES["reporte_ventas"]["tmp_name"], $destino_reporte_ventas);
  }

  if($error == 0) 
  {
   $cortar = explode(".", $documento_reporte_inventario); 
   $extension = end($cortar);
   $documento_reporte_inventario = 'INVENTARIO-'.$nombre_distribuidor.'-'.$nombre_mes.'('.$nombre_anio.')-V.'.$version.'-'.$aleatorio.'.'.$extension.'';
   $directorio_reporte_inventario = "reporte_inventario/";
   $destino_reporte_inventario = $directorio_reporte_inventario.$documento_reporte_inventario;
   
   $subir_reporte_inventario = move_uploaded_file($_FILES["reporte_inventario"]["tmp_name"], $destino_reporte_inventario);
  }
 
  if($error == 0)
  {
   $fecha = date('Y-m-d');
   $hora = date('H:i:s');
   $crear = @mysqli_query($conexion,"insert into reporte (estado,mes,fecha,hora,version,distribuidor,reporte_ventas,reporte_inventario) values ('0','$id_mes','$fecha','$hora','$version','$id_distribuidor','$documento_reporte_ventas','$documento_reporte_inventario')");
  
   if($crear)
   {   
   	// Correo Distribuidor
	$asunto = 'SCH Información Carga Inventario y Ventas '.$nombre_mes.' '.$nombre_anio.' '.$nombre_distribuidor.''; 

    $mensaje_email = "
	 Distribuidor ".$nombre_distribuidor.".
	 <br><br>
	 Confirmamos la recepción de los reportes de inventario y ventas correspondiente al mes de ".$nombre_mes." de ".$nombre_anio.".  El reporte será validado internamente.";
    
	$correo =  CorreoElectronico($correo_electronico_distribuidor,$asunto,$mensaje_email);

	// Correo Administrador
	$consulta_administrador = mysqli_query($conexion,"select * from usuario where perfil = 'admin' order by id desc");
    while ($resultado_consulta_administrador = mysqli_fetch_array($consulta_administrador))
    {
     // Nombre
     $nombre_administrador = $resultado_consulta_administrador['nombre'];
     // Correo Electrónico
     $correo_electronico_administrador = $resultado_consulta_administrador['correo_electronico'];
	
     $mensaje_email = "
	  Estimado ".$nombre_administrador.".
	  <br><br>
	  Confirmamos la recepción de los reportes de inventario y ventas de ".$nombre_distribuidor." correspondiente al mes de ".$nombre_mes." de ".$nombre_anio." y está disponible para su revisión.";

     $correo =  CorreoElectronico($correo_electronico_administrador,$asunto,$mensaje_email);
    }
   }
  
  }
 }
 
 $i = 1;

 if($perfil == 'admin' || $perfil == 'super_schneider' || $perfil == 'admin_schneider')
 {
  $consulta_reporte = mysqli_query($conexion,"select * from reporte order by id desc");
 }
 if($perfil == 'distribuidor')
 {
  $consulta_reporte = mysqli_query($conexion,"select * from reporte where distribuidor = $id_distribuidor order by id desc");
 }
 
 while ($resultado_consulta_reporte = mysqli_fetch_array($consulta_reporte))
 {
  // Id
  $reporte[$i]['id'] = $resultado_consulta_reporte['id'];

  // Estado
  $reporte[$i]['estado'] = $resultado_consulta_reporte['estado'];
  
  // Nombre Estado
  if($resultado_consulta_reporte['estado'] == 0)
  {
   $reporte[$i]['nombre_estado'] = 'SUBIDO';
  }
  if($resultado_consulta_reporte['estado'] == 1)
  {
   $reporte[$i]['nombre_estado'] = 'EN REVISION';
  }
  if($resultado_consulta_reporte['estado'] == 2)
  {
   $reporte[$i]['nombre_estado'] = 'RECHAZADO';
  }
  if($resultado_consulta_reporte['estado'] == 3)
  {
   $reporte[$i]['nombre_estado'] = 'CONFIRMADO';
  }
    
  // Mes
  $consulta_mes = mysqli_query($conexion,"select * from mes where id = $resultado_consulta_reporte[mes]");
  $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
  $consulta_anio = mysqli_query($conexion,"select * from anio where id = $resultado_consulta_mes[anio]");
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  $reporte[$i]['mes'] = ''.$resultado_consulta_mes['nombre'].' ('.$resultado_consulta_anio['nombre'].')';
  
  // Distribuidor
  $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = $resultado_consulta_reporte[distribuidor]");
  $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
  $reporte[$i]['distribuidor'] = $resultado_consulta_distribuidor['nombre'];

  // Versión
  $reporte[$i]['version'] = $resultado_consulta_reporte['version'];
  
  // Fecha
  $reporte[$i]['fecha'] = $resultado_consulta_reporte['fecha'];
  
  // Hora
  $reporte[$i]['hora'] = $resultado_consulta_reporte['hora'];
  
  // Reporte Ventas
  $reporte[$i]['reporte_ventas'] = $resultado_consulta_reporte['reporte_ventas'];

  // Reporte Inventario
  $reporte[$i]['reporte_inventario'] = $resultado_consulta_reporte['reporte_inventario'];
    
  // Motivo Rechazo
  $reporte[$i]['motivo_rechazo'] = $resultado_consulta_reporte['motivo_rechazo'];
	
  $i++;
 }
 
 $cantidad_mes = 1;
 $consulta_mes = mysqli_query($conexion,"select * from mes where estado = 1 order by id ASC ");
 while($resultado_consulta_mes = mysqli_fetch_array($consulta_mes))
 {
  $consulta_reporte = mysqli_query($conexion,"select * from reporte where distribuidor = $id_distribuidor and mes = $resultado_consulta_mes[id] and estado != 2");
  if(mysqli_num_rows($consulta_reporte) == 0)
  {
   $meses[$cantidad_mes]['id'] = $resultado_consulta_mes['id'];
   $consulta_anio = mysqli_query($conexion,"select * from anio where id = $resultado_consulta_mes[anio]");
   $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  
   $meses[$cantidad_mes]['nombre'] = ''.$resultado_consulta_mes[nombre].' ('.$resultado_consulta_anio[nombre].')';
   $cantidad_mes++;
  }
 }

?>