<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $id_reporte_compras = !empty($_GET['id'])? $_GET['id']:0;
 $id_reporte_compras = mysqli_real_escape_string($conexion,$id_reporte_compras);
 
 $registros_con_error = 0;
 $i = 1;
 
 $consulta_detalle_sell_in = mysqli_query($conexion,"select * from detalle_sell_in where reporte_compras = $id_reporte_compras order by id desc");
 while ($resultado_consulta_detalle_sell_in = mysqli_fetch_array($consulta_detalle_sell_in))
 {
  $detalle[$i]['error'] = 0;
 
  // Id
  $detalle[$i]['id'] = $resultado_consulta_detalle_sell_in['id'];
  $id_detalle_sell_in = $resultado_consulta_detalle_sell_in['id'];
  
  $estado_detalle_sell_in = $resultado_consulta_detalle_sell_in['estado'];

  // Nombre Distribuidor
  $detalle[$i]['error_nombre_distribuidor'] = 0;
  $detalle[$i]['nombre_distribuidor'] = $resultado_consulta_detalle_sell_in['nombre_distribuidor'];
  // Producto
  $detalle[$i]['error_producto'] = 0;
  $detalle[$i]['producto'] = $resultado_consulta_detalle_sell_in['producto'];
  // Unidades
  $detalle[$i]['error_unidades'] = 0;
  $detalle[$i]['unidades'] = $resultado_consulta_detalle_sell_in['unidades'];
  // Precio
  $detalle[$i]['error_precio'] = 0;
  $detalle[$i]['precio'] = $resultado_consulta_detalle_sell_in['precio'];
  // Fecha Compra
  $detalle[$i]['error_fecha'] = 0;
  $detalle[$i]['fecha_compra'] = $resultado_consulta_detalle_sell_in['fecha_compra'];
  // Factura
  $detalle[$i]['error_factura'] = 0;
  $detalle[$i]['factura'] = $resultado_consulta_detalle_sell_in['factura'];

  
  if($estado_detalle_sell_in == 0)
  {
  
   // Nombre Distribuidor
   $nombre_distribuidor = $resultado_consulta_detalle_sell_in['nombre_distribuidor'];
   $id_distribuidor = $resultado_consulta_detalle_sell_in['id_distribuidor'];
   if($nombre_distribuidor == '')
   {
    $detalle[$i]['error_nombre_distribuidor'] = 1;
    $detalle[$i]['error']++;
   }
   else
   {
    if($id_distribuidor == 0)
    {
     $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where nombre = '$nombre_distribuidor' and perfil = 'distribuidor'");
     if(mysqli_num_rows($consulta_distribuidor)==0)
     {
      $detalle[$i]['error_nombre_distribuidor'] = 2;
      $detalle[$i]['error']++;
     }
     else
     {
      $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
      $id_distribuidor = $resultado_consulta_distribuidor['id'];
  	  $pais_distribuidor = $resultado_consulta_distribuidor['pais'];
 	  $modificar = mysqli_query($conexion,"update detalle_sell_in set id_distribuidor = '$id_distribuidor', id_pais_distribuidor = '$pais_distribuidor' where id = '$id_detalle_sell_in'");
     }
    }
   }
  
   // Producto
   $producto = $resultado_consulta_detalle_sell_in['producto'];
   $id_producto = $resultado_consulta_detalle_sell_in['id_producto'];
   $id_actividad = $resultado_consulta_detalle_sell_in['id_actividad'];
   $id_linea = $resultado_consulta_detalle_sell_in['id_linea'];
   if ($producto == '')
   {
    $detalle[$i]['error_producto'] = 1;
    $detalle[$i]['error']++;
   }
   else
   {
    if($id_producto == 0 || $id_actividad == 0 || $id_linea == 0)
    {
     $consulta_producto = mysqli_query($conexion,"select * from producto where referencia = '$producto'");
     if(mysqli_num_rows($consulta_producto)==0)
     {
      $detalle[$i]['error_producto'] = 2;
      $detalle[$i]['error']++;
     }
     else
     {
      $resultado_consulta_producto = mysqli_fetch_array($consulta_producto);
      $id_producto = $resultado_consulta_producto['id'];
      $id_actividad = $resultado_consulta_producto['actividad'];
      $consulta_actividad = mysqli_query($conexion,"select * from actividad where id = '$id_actividad'");
      $resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad);
      $id_linea = $resultado_consulta_actividad['linea'];	 
	 
	  $modificar = mysqli_query($conexion,"update detalle_sell_in set id_producto = '$id_producto', id_actividad = '$id_actividad', id_linea = '$id_linea' where id = '$id_detalle_sell_in'");
     }
    } 
   }
  
   // Unidades
   $unidades = $resultado_consulta_detalle_sell_in['unidades'];
   $int_unidades = $resultado_consulta_detalle_sell_in['int_unidades'];  
   if($unidades == '')
   {
    $detalle[$i]['error_unidades'] = 1;
    $detalle[$i]['error']++;  
   }
   else
   {
    if($int_unidades == 0)
    {
     if(!is_numeric($unidades))
     {
	  $detalle[$i]['error_unidades'] = 2;
      $detalle[$i]['error']++;
     }
     else
     {
      $unidades_sin_signo = str_replace('-', '', $unidades);
	  if(!ctype_digit($unidades_sin_signo))
      {
  	   $detalle[$i]['error_unidades'] = 3;
       $detalle[$i]['error']++; 
	  }
	  else
	  {
	   $modificar = mysqli_query($conexion,"update detalle_sell_in set int_unidades = '$unidades' where id = '$id_detalle_sell_in'");
      }
	 }
    }
   }

   // Precio
   $precio = $resultado_consulta_detalle_sell_in['precio'];
   $float_precio = $resultado_consulta_detalle_sell_in['float_precio'];
   if($precio == '')
   {
    $detalle[$i]['error_precio'] = 1;
    $detalle[$i]['error']++;  
   }
   else
   {
    if($float_precio == 0)
    {
     if(!is_numeric($precio))
     {
      $detalle[$i]['error_precio'] = 2;
      $detalle[$i]['error']++;
     }
	 else
	 {
	  if($precio < 0)
	  {
       $detalle[$i]['error_precio'] = 3;
       $detalle[$i]['error']++; 
	  }
	  else
	  {
	   $modificar = mysqli_query($conexion,"update detalle_sell_in set float_precio = '$precio' where id = '$id_detalle_sell_in'");
	  }
	 }
    }
   }
  
   // Fecha Compra
   $fecha_compra = $resultado_consulta_detalle_sell_in['fecha_compra'];
   $date_fecha_compra = $resultado_consulta_detalle_sell_in['date_fecha_compra'];
   if ($fecha_compra == '')
   {
    $detalle[$i]['error_fecha'] = 1;
    $detalle[$i]['error']++;
   }
   else
   {
    if (VerificarFecha($fecha_compra) == 1)
    {
     $detalle[$i]['error_fecha'] = 2;
     $detalle[$i]['error']++;
    }
    else
    {
     if($date_fecha_compra == '0001-01-01')
     {
      $id_anio = $resultado_consulta_detalle_sell_in['id_anio'];
      $id_mes = $resultado_consulta_detalle_sell_in['id_mes'];
      $consulta_anio = mysqli_query($conexion,"select * from anio where id = '$id_anio'");
      $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
      $anio1 = $resultado_consulta_anio['nombre'];

      $consulta_mes = mysqli_query($conexion,"select * from mes where id = '$id_mes'");
      $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
      $mes1 = $resultado_consulta_mes['mes'];

	  $anio2 = date("Y", strtotime($fecha_compra));
	  $mes2 = date("m", strtotime($fecha_compra));
 	
	  if($anio1 == $anio2 && $mes1 == $mes2)
	  {
	   $modificar = mysqli_query($conexion,"update detalle_sell_in set date_fecha_compra = '$fecha_compra' where id = '$id_detalle_sell_in'");
	  }
	  else
	  {
       $detalle[$i]['error_fecha'] = 3;
       $detalle[$i]['error']++;
	  }
	 }
    }
   }
  
   // Factura
   $factura = $resultado_consulta_detalle_sell_in['factura'];
   if ($factura == '')
   {
    $detalle[$i]['error_factura'] = 1;
    $detalle[$i]['error']++;
   }
   // Factura - Fecha Compra
   if ($detalle[$i]['error_factura'] == 0 && $detalle[$i]['error_fecha'] == 0)
   {
    $consulta_factura = mysqli_query($conexion,"select fecha_compra from detalle_sell_in where reporte_compras = $id_reporte_compras and factura = $factura and id != $id_detalle_sell_in");
    while($resultado_consulta_factura = mysqli_fetch_array($consulta_factura))
    {
 	 $temp_fecha_compra = $resultado_consulta_factura[fecha_compra];
     if($fecha_compra != $temp_fecha_compra && $detalle[$i]['error_fecha'] == 0)
	 {
      $detalle[$i]['error_fecha'] = 4;
      $detalle[$i]['error']++;
	 }
    }
   }
    
   if ($detalle[$i]['error'] > 0)
   {
    $registros_con_error++;
   }
   else
   {
    $modificar = mysqli_query($conexion,"update detalle_sell_in set estado = '1' where id = '$id_detalle_sell_in'");
   }
  
  }
      
  $i++;
 }
 
 $registros = $i - 1;
  
 if($registros_con_error == 0)
 {
  $modificar = mysqli_query($conexion,"update reporte_compras set estado = '2', registros = '$registros', registros_error = '$registros_con_error' where id = '$id_reporte_compras'");
 }
 else
 {
  $modificar = mysqli_query($conexion,"update reporte_compras set estado = '1', registros = '$registros', registros_error = '$registros_con_error' where id = '$id_reporte_compras'");
 }	 
 

?>