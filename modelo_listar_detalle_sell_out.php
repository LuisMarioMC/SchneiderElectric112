<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 $modal = '';
 
 $id_reporte_ventas = !empty($_GET['id'])? $_GET['id']:0;
 $id_reporte_ventas = mysqli_real_escape_string($conexion,$id_reporte_ventas);
 
 $consulta_reporte_ventas = mysqli_query($conexion,"select * from reporte_ventas where id = $id_reporte_ventas");
 $resultado_consulta_reporte_ventas = mysqli_fetch_array($consulta_reporte_ventas);
 $estado_reporte_ventas = $resultado_consulta_reporte_ventas[estado];
 
 // Important for validate the date
 $id_mes = $resultado_consulta_reporte_ventas[mes];

 $consulta_mes = mysqli_query($conexion,"select * from mes where id = '$id_mes'");
 $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
 $id_anio = $resultado_consulta_mes['anio'];
 $mes1 = $resultado_consulta_mes['mes'];
  
 $consulta_anio = mysqli_query($conexion,"select * from anio where id = '$id_anio'");
 $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
 $anio1 = $resultado_consulta_anio['nombre'];

 
 $registros_con_error = 0;
 $i = 1;
 
 $consulta_detalle_sell_out = mysqli_query($conexion,"select * from detalle_sell_out where reporte_ventas = $id_reporte_ventas order by id desc");
 while ($resultado_consulta_detalle_sell_out = mysqli_fetch_array($consulta_detalle_sell_out))
 {
  $detalle[$i]['error'] = 0;
 
  // Id
  $detalle[$i]['id'] = $resultado_consulta_detalle_sell_out['id'];
  $id_detalle_sell_out = $resultado_consulta_detalle_sell_out['id'];

  $estado_detalle_sell_out = $resultado_consulta_detalle_sell_out['estado'];
  
  // Factura
  $detalle[$i]['error_factura'] = 0;
  $detalle[$i]['factura'] = $resultado_consulta_detalle_sell_out['factura'];
  // Fecha Venta
  $detalle[$i]['error_fecha'] = 0;
  $detalle[$i]['fecha_venta'] = $resultado_consulta_detalle_sell_out['fecha_venta'];
  // Producto
  $detalle[$i]['error_producto'] = 0;
  $detalle[$i]['producto'] = $resultado_consulta_detalle_sell_out['producto'];
  // Unidades
  $detalle[$i]['error_unidades'] = 0;
  $detalle[$i]['unidades'] = $resultado_consulta_detalle_sell_out['unidades'];
  // Precio
  $detalle[$i]['error_precio'] = 0;
  $detalle[$i]['precio'] = $resultado_consulta_detalle_sell_out['precio'];
  // TaxID Cliente
  $detalle[$i]['error_taxid'] = 0;
  $detalle[$i]['taxid_cliente'] = $resultado_consulta_detalle_sell_out['taxid_cliente'];
  // Nombre Cliente
  $detalle[$i]['error_nombre'] = 0;
  $detalle[$i]['nombre_cliente'] = $resultado_consulta_detalle_sell_out['nombre_cliente'];
  // Telefono Cliente
  $detalle[$i]['error_telefono'] = 0;
  $detalle[$i]['telefono_cliente'] = $resultado_consulta_detalle_sell_out['telefono_cliente'];
  // Email Cliente
  $detalle[$i]['error_email'] = 0;
  $detalle[$i]['email_cliente'] = $resultado_consulta_detalle_sell_out['email_cliente'];
  // Segmento
  $detalle[$i]['error_segmento'] = 0;
  $detalle[$i]['segmento'] = $resultado_consulta_detalle_sell_out['segmento'];
  // Ciudad
  $detalle[$i]['error_ciudad'] = 0;
  $detalle[$i]['ciudad'] = $resultado_consulta_detalle_sell_out['ciudad'];
  // Vendedor
  $detalle[$i]['error_vendedor'] = 0;
  $detalle[$i]['vendedor'] = $resultado_consulta_detalle_sell_out['vendedor'];  
  // E-Commerce
  $detalle[$i]['error_e_commerce'] = 0;
  $detalle[$i]['e_commerce'] = $resultado_consulta_detalle_sell_out['e_commerce'];
   // Direccion
  $detalle[$i]['error_direccion'] = 0;
  $detalle[$i]['direccion'] = $resultado_consulta_detalle_sell_out['direccion'];
  // Tipo cliente
  $detalle[$i]['error_tipo_cliente'] = 0;
  $detalle[$i]['tipo_cliente'] = $resultado_consulta_detalle_sell_out['tipo_cliente'];
//Sucursal
  $detalle[$i]['error_sucursal'] = 0;
   $detalle[$i]['sucursal'] = $resultado_consulta_detalle_sell_out['sucursal'];




  if($estado_detalle_sell_out == 0)
  {
   // Factura
   $factura = $resultado_consulta_detalle_sell_out['factura'];
   if($factura == '')
   {
    $detalle[$i]['error_factura'] = 1;
    $detalle[$i]['error']++;
   }
  
   // Fecha Venta
   $fecha_venta = $resultado_consulta_detalle_sell_out['fecha_venta'];
   $date_fecha_venta = $resultado_consulta_detalle_sell_out['date_fecha_venta'];
   
   if($fecha_venta == '')
   {
    $detalle[$i]['error_fecha'] = 1;
    $detalle[$i]['error']++;
   }
   else
   {
    if (VerificarFecha($fecha_venta) == 1)
    {
     $detalle[$i]['error_fecha'] = 2;
     $detalle[$i]['error']++;
    }
    else
    {
     if($date_fecha_venta == '0001-01-01')
     {
	  $anio2 = date("Y", strtotime($fecha_venta));
	  $mes2 = date("m", strtotime($fecha_venta));
	
	  if($anio1 == $anio2 && $mes1 == $mes2)
	  {
	   $modificar = mysqli_query($conexion,"update detalle_sell_out set date_fecha_venta = '$fecha_venta' where id = '$id_detalle_sell_out'");
	  }
	  else
	  {
       $detalle[$i]['error_fecha'] = 3;
       $detalle[$i]['error']++;
	  }
	 }
    }
   }

   // Factura - Fecha Venta
   if($detalle[$i]['error_factura'] == 0 && $detalle[$i]['error_fecha'] == 0)
   {
    $consulta_factura = mysqli_query($conexion,"select fecha_venta from detalle_sell_out where reporte_ventas = $id_reporte_ventas and factura = $factura and id != $id_detalle_sell_out");
    while($resultado_consulta_factura = mysqli_fetch_array($consulta_factura))
    {
	 $temp_fecha_venta = $resultado_consulta_factura[fecha_venta];
     if($fecha_venta != $temp_fecha_venta && $detalle[$i]['error_fecha'] == 0)
	 {
      $detalle[$i]['error_fecha'] = 4;
      $detalle[$i]['error']++;
	 }
    }
   }
  
   // Producto
   $producto = $resultado_consulta_detalle_sell_out['producto'];
   $id_producto = $resultado_consulta_detalle_sell_out['id_producto'];
   $id_actividad = $resultado_consulta_detalle_sell_out['id_actividad'];
   $id_linea = $resultado_consulta_detalle_sell_out['id_linea'];

   if($producto == '')
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
	 
	  $modificar = mysqli_query($conexion,"update detalle_sell_out set id_producto = '$id_producto', id_actividad = '$id_actividad', id_linea = '$id_linea' where id = '$id_detalle_sell_out'");
	  	  
      if($resultado_consulta_producto[$variable] == 0)
	  {
	   $variable = 'U'.$anio1;
	   $consulta = "update producto set ".$variable." = '1' where id = '$id_producto'";
	   $modificar = mysqli_query($conexion,$consulta);
	  }
	  	 
	 }
    } 
   }
  
   // Unidades
   $unidades = $resultado_consulta_detalle_sell_out['unidades'];
   $int_unidades = $resultado_consulta_detalle_sell_out['int_unidades'];
  
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
	   $modificar = @mysqli_query($conexion,"update detalle_sell_out set int_unidades = '$unidades' where id = '$id_detalle_sell_out'");
      }
	 }
    }
   }
  
   // Precio
   $precio = $resultado_consulta_detalle_sell_out['precio'];
   $float_precio = $resultado_consulta_detalle_sell_out['float_precio'];

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
	   $modificar = @mysqli_query($conexion,"update detalle_sell_out set float_precio = '$precio' where id = '$id_detalle_sell_out'");	 
	  }
	 }
    }
   }
  
   // TaxID Cliente
   $taxid_cliente = $resultado_consulta_detalle_sell_out['taxid_cliente'];
   if($taxid_cliente == '')
   {
    $detalle[$i]['error_taxid'] = 1;
    $detalle[$i]['error']++;
   }

   // Factura - TaxID
   if($detalle[$i]['error_factura'] == 0 && $detalle[$i]['error_taxid'] == 0)
   {
    $consulta_factura = mysqli_query($conexion,"select taxid_cliente from detalle_sell_out where reporte_ventas = $id_reporte_ventas and factura = $factura and id != $id_detalle_sell_out");
    while($resultado_consulta_factura = mysqli_fetch_array($consulta_factura))
    {
 	 $temp_taxid_cliente = $resultado_consulta_factura[taxid_cliente];
     if($taxid_cliente != $temp_taxid_cliente && $detalle[$i]['error_taxid'] == 0)
	 {
      $detalle[$i]['error_taxid'] = 2;
      $detalle[$i]['error']++;
	 }
    }
   }
  
   // Nombre Cliente
   $nombre_cliente = $resultado_consulta_detalle_sell_out['nombre_cliente'];
   //if($nombre_cliente == '')
   //{
   // $detalle[$i]['error_nombre'] = 1;
   // $detalle[$i]['error']++;  
   //}
  
   // Telefono Cliente
   $telefono_cliente = $resultado_consulta_detalle_sell_out['telefono_cliente'];
   //if($telefono_cliente == '')
   //{
   // $detalle[$i]['error_telefono'] = 1;
   // $detalle[$i]['error']++;  
   //}
  
   // Email Cliente
   $email_cliente = $resultado_consulta_detalle_sell_out['email_cliente'];
   //if($email_cliente == '')
   //{
   // $detalle[$i]['error_email'] = 1;
   // $detalle[$i]['error']++;  
   //}
  
   // Segmento
   $segmento = $resultado_consulta_detalle_sell_out['segmento'];
   $id_segmento = $resultado_consulta_detalle_sell_out['id_segmento'];

   if($segmento != '')
   {
    if($id_segmento == 0)
    {
     $consulta_segmento = mysqli_query($conexion,"select * from segmento where nombre = '$segmento'");
     if(mysqli_num_rows($consulta_segmento)==0)
     {
      $detalle[$i]['error_segmento'] = 2;
      $detalle[$i]['error']++;
     }
     else
     {
      $resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento);
      $id_segmento = $resultado_consulta_segmento['id'];
      $modificar = @mysqli_query($conexion,"update detalle_sell_out set id_segmento = '$id_segmento' where id = '$id_detalle_sell_out'");
     }
    }
   }
  
   // Cliente
   if($taxid_cliente != '' && $nombre_cliente != '' && $telefono_cliente != '' && $email_cliente != '' && $id_segmento != 0)
   {
    $id_cliente = $resultado_consulta_detalle_sell_out['id_cliente'];
   
    if($id_cliente == 0)
    {
	 $consulta_cliente = mysqli_query($conexion,"select * from cliente where taxid_cliente = '$taxid_cliente'");   
     if(mysqli_num_rows($consulta_cliente)==0)
     {
      $crear = mysqli_query($conexion,"insert into cliente (taxid_cliente, nombre_cliente, telefono_cliente, email_cliente, id_segmento, reporte_ventas) values ('$taxid_cliente','$nombre_cliente','$telefono_cliente','$email_cliente','$id_segmento',' $id_reporte_ventas')");
      $id_cliente = mysqli_insert_id($conexion);
	  $modificar = mysqli_query($conexion,"update detalle_sell_out set id_cliente = '$id_cliente' where id = '$id_detalle_sell_out'");
	 }
	 else
	 {
	  /*
      $resultado_consulta_cliente = mysqli_fetch_array($consulta_cliente);
      $id_cliente = $resultado_consulta_cliente['id'];
      $taxid_cliente2 = $resultado_consulta_cliente['taxid_cliente'];
      $nombre_cliente2 = $resultado_consulta_cliente['nombre_cliente'];
      $telefono_cliente2 = $resultado_consulta_cliente['telefono_cliente'];
      $email_cliente2 = $resultado_consulta_cliente['email_cliente'];
      $id_segmento2 = $resultado_consulta_cliente['id_segmento'];
	  $consulta_segmento = mysqli_query($conexion,"select * from segmento where id = '$id_segmento2'");
      $resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento);
      $segmento_cliente2 = $resultado_consulta_segmento['nombre'];
      $consulta_segmento = mysqli_query($conexion,"select * from segmento where id = '$id_segmento'");
      $resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento);
      $segmento_cliente = $resultado_consulta_segmento['nombre'];
	 
	  //if($taxid_cliente == $taxid_cliente2 && $nombre_cliente == $nombre_cliente2 && $telefono_cliente == $telefono_cliente2 && $email_cliente == $email_cliente2 && $id_segmento == $id_segmento2)
	  if($taxid_cliente == $taxid_cliente2 && $nombre_cliente == $nombre_cliente2 && $telefono_cliente == $telefono_cliente2 && $email_cliente == $email_cliente2)
	  {
	   $modificar = @mysqli_query($conexion,"update detalle_sell_out set id_cliente = '$id_cliente' where id = '$id_detalle_sell_out'");
	  }
	  else
	  {
	   $detalle[$i]['error_taxid'] = 3;
       $detalle[$i]['error']++; 
	 
	   $modal .= '<div class="modal fade" id="ModalT'.$id_detalle_sell_out.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
       $modal .= ' <div class="modal-dialog">';
	   $modal .= '  <div class="modal-content">';
	   $modal .= '   <div class="modal-header">';
	   $modal .= '    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
	   $modal .= '    <h4 class="modal-title" id="myModalLabel">Tax ID: '.$taxid_cliente2.'</h4>';
	   $modal .= '   </div>';
	   $modal .= '   <div class="modal-body">'; 

	   $modal .= '    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
	   $modal .= '     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
	   $modal .= '      <h4>En el Registro</h4>';
	   $modal .= '      <b>Nombre: </b>'.$nombre_cliente.'<br>';
	   $modal .= '      <b>Tel&eacute;fono: </b>'.$telefono_cliente.'<br>';
	   $modal .= '      <b>Email: </b>'.$email_cliente.'<br>';
	   $modal .= '      <b>Segmento: </b>'.$segmento_cliente.'<br>';	  	  
	   $modal .= '     </div>';

	   $modal .= '     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
	   $modal .= '      <h4>En el Sistema</h4>';
	   if($nombre_cliente == $nombre_cliente2)
	   {
	    $modal .= '      <b>Nombre: </b>'.$nombre_cliente2.'<br>';
	   }
	   else
	   {
	    $modal .= '      <b>Nombre: </b><font color="red">'.$nombre_cliente2.'</font><br>';	  
	   }
	   if($telefono_cliente == $telefono_cliente2)
	   {	  
	    $modal .= '      <b>Tel&eacute;fono: </b>'.$telefono_cliente2.'<br>';
	   }
	   else
	   {	  
	    $modal .= '      <b>Tel&eacute;fono: </b><font color="red">'.$telefono_cliente2.'</font><br>';
	   }
	   if($email_cliente == $email_cliente2)
	   {
	    $modal .= '      <b>Email: </b>'.$email_cliente2.'<br>';
	   }
	   else
	   {
	    $modal .= '      <b>Email: </b><font color="red">'.$email_cliente2.'</font><br>';
	   }
	   if($segmento_cliente == $segmento_cliente2)
	   {
	    $modal .= '      <b>Segmento: </b>'.$segmento_cliente2.'<br>';
	   }
	   else
	   {
	    $modal .= '      <b>Segmento: </b><font color="red">'.$segmento_cliente2.'</font><br>';
	   }
	   $modal .= '     </div>';
	   $modal .= '    </div>';
	  
	   $modal .= '    <div>';	  
	   $modal .= '     <h1>&nbsp;</h1>';	  
	   $modal .= '    </div>';
	   $modal .= '    <div align="right">';
	  
	   $modal .= '     <form class="form-horizontal" role="form" name="formulario" action="controlador_cliente_taxid.php?id_reporte_ventas='.$id_reporte_ventas.'&id='.$id_detalle_sell_out.'" autocomplete="off" method="post" enctype="multipart/form-data">';
	   $modal .= '      <input id="actualizar" name="actualizar" type="submit" class="btn btn-primary" value="Actualizar Cliente">';
	   $modal .= '      <input id="ajustar" name="ajustar" type="submit" class="btn btn-primary" value="Ajustar Registro">';
	   $modal .= '     </form>';
	   $modal .= '    </div>';	  
	   $modal .= '   </div>';
	   $modal .= '  </div>';
       $modal .= ' </div>';
       $modal .= '</div>';  
	  }
	  */
	 }
    }
   }
  
   // Ciudad
   $ciudad = $resultado_consulta_detalle_sell_out['ciudad'];
   $id_ciudad = $resultado_consulta_detalle_sell_out['id_ciudad'];
   $id_departamento = $resultado_consulta_detalle_sell_out['id_departamento'];
   $id_zona = $resultado_consulta_detalle_sell_out['id_zona'];
   $id_pais = $resultado_consulta_detalle_sell_out['id_pais'];

   if($ciudad == '')
   {
    $detalle[$i]['error_ciudad'] = 1;
    $detalle[$i]['error']++;  
   }
   else
   {
    if($id_ciudad == 0 || $id_departamento == 0 || $id_zona == 0 || $id_pais == 0)
    {
     $consulta_ciudad = mysqli_query($conexion,"select * from ciudad where nombre = '$ciudad'");   
     if(mysqli_num_rows($consulta_ciudad)==0)
     {
      $detalle[$i]['error_ciudad'] = 2;
      $detalle[$i]['error']++;
     }
     else
     {
      $resultado_consulta_ciudad = mysqli_fetch_array($consulta_ciudad);
      $id_ciudad = $resultado_consulta_ciudad['id'];
      $id_departamento = $resultado_consulta_ciudad['departamento'];
      $id_pais = $resultado_consulta_ciudad['pais'];
      $consulta_departamento = mysqli_query($conexion,"select * from departamento where id = '$id_departamento'");
      $resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento);
      $id_zona = $resultado_consulta_departamento[zona];
 	  
      $modificar = @mysqli_query($conexion,"update detalle_sell_out set id_ciudad = '$id_ciudad', id_departamento = '$id_departamento', id_zona = '$id_zona', id_pais = '$id_pais' where id = '$id_detalle_sell_out'");
     }
    }
   }
    
   // Vendedor
   $vendedor = $resultado_consulta_detalle_sell_out['vendedor'];
   if($vendedor == '')
   {
    $detalle[$i]['error_vendedor'] = 1;
    $detalle[$i]['error']++;  
   }
   else
   {
    $consulta_vendedor = mysqli_query($conexion,"select * from usuario where id = '$vendedor' and perfil = 'vendedor' and estado = 1");
    if(mysqli_num_rows($consulta_vendedor)==0)
    {
     $detalle[$i]['error_vendedor'] = 2;
     $detalle[$i]['error']++;
    }
    else
    {
     $id_distribuidor = $resultado_consulta_detalle_sell_out['id_distribuidor'];
     
     $consulta_vendedor = mysqli_query($conexion,"select * from usuario where id = '$vendedor' and perfil = 'vendedor' and distribuidor = '$id_distribuidor' and estado = 1");
     if(mysqli_num_rows($consulta_vendedor)==0)
     {
      $detalle[$i]['error_vendedor'] = 3;
      $detalle[$i]['error']++;
     }
     else
     {
      $modificar = @mysqli_query($conexion,"update detalle_sell_out set id_vendedor = '$vendedor' where id = '$id_detalle_sell_out'");
     }
    }   
   }
  
   // E-Commerce
   $e_commerce = $resultado_consulta_detalle_sell_out['e_commerce'];
   if ($e_commerce != 'NO' && $e_commerce != 'SI-PAGINA-PROPIA' && $e_commerce != 'SI-OTROS')
   {
    $detalle[$i]['error_e_commerce'] = 1;
    $detalle[$i]['error']++;
   }
    
   

    // Tipo de cliente
    $tipo_cliente = $resultado_consulta_detalle_sell_out['tipo_cliente'];
    $getNameOfClient = mysqli_query($conexion, "select *  from tipo_cliente where id = '$tipo_cliente' limit 1");
    if ($tipo_cliente == '') {
      $detalle[$i]['error_tipo_cliente'] = 1;
      $detalle[$i]['error']++;
    } else if($getNameOfClient->num_rows <= 0) {
      $detalle[$i]['error_tipo_cliente'] = 2;
      $detalle[$i]['error']++;
    } else {
      $detalle[$i]['tipo_cliente'] = mysqli_fetch_object($getNameOfClient)->nombre;
    }

    if ($detalle[$i]['error'] > 0) {
      $registros_con_error++;
    } else {
      $modificar = mysqli_query($conexion,"update detalle_sell_out set estado = '1' where id = '$id_detalle_sell_out'");
    }
    
  } 
  //Sucursal
  $detalle[$i]['error_sucursal'] = 0;
   $detalle[$i]['sucursal'] = $resultado_consulta_detalle_sell_out['sucursal'];
 
  $i++;
 }
 $registros = $i - 1;
 
 $modificar = mysqli_query($conexion,"update reporte_ventas set registros = '$registros', registros_error = '$registros_con_error' where id = '$id_reporte_ventas'");

?>