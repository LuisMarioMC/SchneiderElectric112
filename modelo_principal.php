<?php
 
 if($perfil != 'admin_schneider' && $perfil != 'super_schneider')
 {	 
  $id_anio = !empty($_GET['a']) ? $_GET['a'] : 0; 
  $id_q = !empty($_GET['q']) ? $_GET['q'] : 0;
  
  $op = isset($_GET['op']) ? $_GET['op'] : 'out';
  $distri = isset($_GET['distribuidor']) ? $_GET['distribuidor'] : 0;
 }

 if($distri != 0)
 {
  $informacion = '<a href="principal.php?q='.$id_q.'&a='.$id_anio.'&op='.$op.'"><< Regresar </a> | ';
 }
 else
 {
  $informacion = '';
 }
 
 $disclaimer = '';

 if($perfil == 'admin_schneider' || $perfil == 'super_schneider')
 {
  $resultado = '';
	 
  // Año
  $cantidad_anio = 1;
  $consulta_anio = mysqli_query($conexion,"select * from anio where estado = '1' order by nombre ASC");
  while($resultado_consulta_anio = mysqli_fetch_array($consulta_anio))
  {
   $anios[$cantidad_anio]['id'] = $resultado_consulta_anio['id'];
   $anios[$cantidad_anio]['nombre'] = $resultado_consulta_anio['nombre'];
   $cantidad_anio++; 
  } 

  // Distribuidor  
  $cantidad_distribuidor = 1;
  $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil = 'distribuidor' order by pais,nombre ASC");
  while($resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor))
  {
   $distribuidores[$cantidad_distribuidor]['id'] = $resultado_consulta_distribuidor['id'];
   $distribuidores[$cantidad_distribuidor]['nombre'] = $resultado_consulta_distribuidor['nombre'];
   
   $temp_id_pais = $resultado_consulta_distribuidor['pais'];
   $consulta_pais = mysqli_query($conexion,"select * from pais where id = '$temp_id_pais'");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
   $distribuidores[$cantidad_distribuidor]['pais'] = $resultado_consulta_pais['nombre'];
   
   $cantidad_distribuidor++; 
  }
 
  // Línea
  $cantidad_linea = 1;
  $consulta_linea = mysqli_query($conexion,"select * from linea where estado = '1' order by nombre ASC");
  while($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
  {
   $lineas[$cantidad_linea]['id'] = $resultado_consulta_linea['id'];
   $lineas[$cantidad_linea]['nombre'] = $resultado_consulta_linea['nombre'];
   $cantidad_linea++; 
  }
 
  // Actividad
  $cantidad_actividad = 1;
  $consulta_actividad = mysqli_query($conexion,"select * from actividad where estado = '1' order by nombre ASC");
  while($resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad))
  {
   $actividades[$cantidad_actividad]['id'] = $resultado_consulta_actividad['id'];
   $actividades[$cantidad_actividad]['nombre'] = $resultado_consulta_actividad['nombre'];

   $temp_id_linea = $resultado_consulta_actividad['linea'];
   $consulta_linea = mysqli_query($conexion,"select * from linea where id = '$temp_id_linea'");
   $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
   $actividades[$cantidad_actividad]['linea'] = $resultado_consulta_linea['nombre'];

   $cantidad_actividad++; 
  }

  // Segmento
  $cantidad_segmento = 1;
  $consulta_segmento = mysqli_query($conexion,"select * from segmento where estado = '1' order by nombre ASC");
  while($resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento))
  {
   $segmentos[$cantidad_segmento]['id'] = $resultado_consulta_segmento['id'];
   $segmentos[$cantidad_segmento]['nombre'] = $resultado_consulta_segmento['nombre'];
   $cantidad_segmento++; 
  }
  
  // País
  $cantidad_pais = 1;
  $consulta_pais = mysqli_query($conexion,"select * from pais where estado = '1' order by nombre ASC");
  while($resultado_consulta_pais = mysqli_fetch_array($consulta_pais))
  {
   $paises[$cantidad_pais]['id'] = $resultado_consulta_pais['id'];
   $paises[$cantidad_pais]['nombre'] = $resultado_consulta_pais['nombre'];
   $cantidad_pais++; 
  }
 
  // Zona
  $cantidad_zona = 1;
  $consulta_zona = mysqli_query($conexion,"select * from zona where estado = '1' order by nombre ASC");
  while($resultado_consulta_zona = mysqli_fetch_array($consulta_zona))
  {
   $zonas[$cantidad_zona]['id'] = $resultado_consulta_zona['id'];
   $zonas[$cantidad_zona]['nombre'] = $resultado_consulta_zona['nombre'];
   
   $temp_id_pais = $resultado_consulta_zona['pais'];
   $consulta_pais = mysqli_query($conexion,"select * from pais where id = '$temp_id_pais'");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
   $zonas[$cantidad_zona]['pais'] = $resultado_consulta_pais['nombre'];
   
   $cantidad_zona++; 
  }

  $registros = 0;
  $filtros = '';

  if($id_anio != 0)
  {
   $consulta_anio = mysqli_query($conexion,"select * from anio where id = '$id_anio'");
   $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
   $nombre_anio = $resultado_consulta_anio[nombre];
   $filtros .= '<b>Año:</b> '.$nombre_anio.' ';
  }
  if($id_periodo != 0)
  {
   if($id_periodo == 1) { $nombre_periodo = 'Q1'; }
   if($id_periodo == 2) { $nombre_periodo = 'Q2'; }
   if($id_periodo == 3) { $nombre_periodo = 'Q3'; }
   if($id_periodo == 4) { $nombre_periodo = 'Q4'; }
   $filtros .= '- <b>Periodo:</b> '.$nombre_periodo.' ';
  }
  if($id_mes != 0)
  {
   $consulta_mes = mysqli_query($conexion,"select * from mes where mes = '$id_mes'");
   $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
   $nombre_mes = $resultado_consulta_mes[nombre];
   $filtros .= '- <b>Mes:</b> '.$nombre_mes.' ';
  }
  if($id_distribuidor != 0)
  {
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = '$id_distribuidor'");
   $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
   $nombre_distribuidor = $resultado_consulta_distribuidor[nombre];	  
   $filtros .= '- <b>Distribuidor:</b> '.$nombre_distribuidor.' ';
  }
  if($id_linea != 0)
  {
   $consulta_linea = mysqli_query($conexion,"select * from linea where id = '$id_linea'");
   $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
   $nombre_linea = $resultado_consulta_linea[nombre];
   $filtros .= '- <b>Linea:</b> '.$nombre_linea.' ';
  }
  if($id_actividad != 0)
  {
   $consulta_actividad = mysqli_query($conexion,"select * from actividad where id = '$id_actividad'");
   $resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad);
   $nombre_actividad = $resultado_consulta_actividad[nombre];	  
   $filtros .= '- <b>Actividad:</b> '.$nombre_actividad.' ';
  }
  if($id_segmento != 0)
  {
   if($id_segmento != 9999)
   {
    $consulta_segmento = mysqli_query($conexion,"select * from segmento where id = '$id_segmento'");
    $resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento);
    $nombre_segmento = $resultado_consulta_segmento[nombre];
    $filtros .= '- <b>Segmento:</b> '.$nombre_segmento.' ';
   }
   else
   {
	$filtros .= '- <b>Segmento:</b>  Todos';
   }
  }
  if($id_pais != 0)
  {
   $consulta_pais = mysqli_query($conexion,"select * from pais where id = '$id_pais'");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
   $nombre_pais = $resultado_consulta_pais[nombre];	  
   $filtros .= '- <b>País:</b> '.$nombre_pais.' ';
  }
  if($id_zona != 0)
  {
   if($id_zona != 9999)
   {
    $consulta_zona = mysqli_query($conexion,"select * from zona where id = '$id_zona'");
    $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
    $nombre_zona = $resultado_consulta_zona[nombre];	  
    $filtros .= '- <b>Zona:</b> '.$nombre_zona.' ';   
   }
   else
   {
	$filtros .= '- <b>Zona:</b> Todas';
   }
  }

  
  if($id_anio != 0 && $id_distribuidor == 0)
  {
   $resultado .= '<div class="table-responsive">';
   $resultado .= ' <table class="table table-striped table-bordered table-hover" id="distribuidor">';
   $resultado .= '  <thead>';
   $resultado .= '   <tr>';
   $resultado .= '    <th>Distribuidor</th>';
   $resultado .= '    <th>Pa&iacute;s</th>';   
   $resultado .= '    <th>Ventas</th>';			
   $resultado .= '	 </tr>';
   $resultado .= '  </thead>';
   $resultado .= '	<tfoot>';
   $resultado .= '   <tr>';
   $resultado .= '    <th>Distribuidor</th>';
   $resultado .= '    <th>Pa&iacute;s</th>';   
   $resultado .= '    <th>Ventas</th>';  
   $resultado .= '	 </tr>';
   $resultado .= '  </tfoot>';
   $resultado .= '  <tbody>';
   
   $pais_anterior = '';
   $i_contador = 1;
   $sumatoria_pais = 0;
   
   if($id_pais == 0)
   {
    $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil = 'distribuidor' order by pais,nombre ASC");
   }
   else
   {
    $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil = 'distribuidor' and pais = $id_pais order by nombre ASC");
   }

   $total_distribuidores = mysqli_num_rows($consulta_distribuidor);
   
   while($resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor))
   {
	$consulta = '';
	$consulta_registros = '';
	
    $distribuidor_id = $resultado_consulta_distribuidor['id'];
	$pais_id = $resultado_consulta_distribuidor['pais'];
    
	if($i_contador == 1)
	{
	 $pais_anterior = $pais_id;
	}
	
	if($pais_anterior != $pais_id)
	{
	 $resultado .= ' <tr>';
     $resultado .= '  <td></td>';
     $resultado .= '  <td align = "right">Subtotal</td>';
	 $resultado .= '  <td align = "right"><b>'.number_format($sumatoria_pais, 2, ',', '.').'</b></td>';	 
	 $resultado .= ' </tr>';
     $sumatoria_pais = 0;
	}

	$pais_anterior = $pais_id;
	
	$resultado .= ' <tr>';
    $resultado .= '  <td>'.$resultado_consulta_distribuidor['nombre'].'</td>';
   
    $consulta_pais = mysqli_query($conexion,"select * from pais where id = '$pais_id'");
    $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);
    $resultado .= '  <td>'.$resultado_consulta_pais['nombre'].'</td>';

	$consulta = 'select SUM(float_precio*int_unidades) as venta from detalle_sell_out where id_distribuidor = '.$distribuidor_id.' and estado = "1"';
	$consulta_registros = 'select id from detalle_sell_out where id_distribuidor = '.$distribuidor_id.' and estado = "1"';
	
    $consulta .= 'and id_anio = '.$id_anio.' ';
    $consulta_registros .= 'and id_anio = '.$id_anio.' ';
	
    if($id_linea != 0)
    {
     $consulta .= 'and id_linea = '.$id_linea.' ';
     $consulta_registros .= 'and id_linea = '.$id_linea.' ';	 
	}

	if($id_actividad != 0)
    {
     $consulta .= 'and id_actividad = '.$id_actividad.' ';
     $consulta_registros .= 'and id_actividad = '.$id_actividad.' ';
	}
	
	if($id_periodo != 0)	
	{
	 if($id_periodo == 1)
     {
	  $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q1'");	  
	 }
	 if($id_periodo == 2)
     {
	  $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q2'");
	 }
	 if($id_periodo == 3)
     {
	  $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q3'");
	 }
	 if($id_periodo == 4)
     {
	  $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q4'");
	 }
	 $resultado_consulta_q = mysqli_fetch_array($consulta_q);
     $id_q = $resultado_consulta_q['id'];

     $consulta .= 'and id_q = '.$id_q.' ';
     $consulta_registros .= 'and id_q = '.$id_q.' ';	 
	} 
	 	 
	if($id_mes != 0)
    {
	 $consulta_mes = mysqli_query($conexion,"select * from mes where anio = '$id_anio' and q = '$id_q' and mes = '$id_mes'");
	 $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
     $id_mes_f = $resultado_consulta_mes['id'];

     $consulta .= 'and id_mes = '.$id_mes_f.' ';
     $consulta_registros .= 'and id_mes = '.$id_mes_f.' ';
	}
	 
	if($id_pais != 0)
    {
     $consulta .= 'and id_pais = '.$id_pais.' ';
     $consulta_registros .= 'and id_pais = '.$id_pais.' ';	 
	}
	
	if($id_zona != 0)
    {
     $consulta .= 'and id_zona = '.$id_zona.' ';
     $consulta_registros .= 'and id_zona = '.$id_zona.' ';	
	}
	 
	if($id_segmento != 0)
    {
     $consulta .= 'and id_segmento = '.$id_segmento.' ';
     $consulta_registros .= 'and id_segmento = '.$id_segmento.' ';	 
	}
	 
	$consulta_sell_out = mysqli_query($conexion,$consulta);	   	   
    $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);
	
	$consulta_registros_sell_out = mysqli_query($conexion,$consulta_registros);	   	   
	$registros += mysqli_num_rows($consulta_registros_sell_out);
    
	$venta = $resultado_consulta_sell_out['venta'];
    $resultado .= '  <td align = "right">'.number_format($venta, 2, ',', '.').'</td>';
    $resultado .= ' </tr>';

	$sumatoria_pais = $sumatoria_pais + $venta;
	
	if($i_contador == $total_distribuidores)
	{
	 $resultado .= ' <tr>';
     $resultado .= '  <td></td>';
     $resultado .= '  <td align = "right">Subtotal</td>';
	 $resultado .= '  <td align = "right"><b>'.number_format($sumatoria_pais, 2, ',', '.').'</b></td>';
	 $resultado .= ' </tr>';
     $sumatoria_pais = 0;
	}    
	
	$i_contador++; 
   }
   $resultado .= '	</tbody>';
   $resultado .= ' </table>';
   $resultado .= '</div>';
  }
  
  if($id_anio != 0 && $id_distribuidor != 0)
  {
   if($id_actividad == 0)
   {
    $resultado .= '<div class="table-responsive">';
    $resultado .= ' <table class="table table-striped table-bordered table-hover" id="linea">';
    $resultado .= '  <thead>';
    $resultado .= '   <tr>';
    $resultado .= '    <th>L&iacute;nea</th>';
    $resultado .= '    <th>Actividad</th>';   
    $resultado .= '    <th>Ventas</th>';			
    $resultado .= '	 </tr>';
    $resultado .= '  </thead>';
    $resultado .= '	<tfoot>';
    $resultado .= '   <tr>';
    $resultado .= '    <th>L&iacute;nea</th>';
    $resultado .= '    <th>Actividad</th>';   
    $resultado .= '    <th>Ventas</th>';		
    $resultado .= '	  </tr>';
    $resultado .= '  </tfoot>';
    $resultado .= '  <tbody>';

    
	if($id_linea == 0)
    {
     $consulta_linea = mysqli_query($conexion,"select * from linea order by nombre ASC");
	}
	else
	{
     $consulta_linea = mysqli_query($conexion,"select * from linea where id = $id_linea");		
	}
	
	$total_linea = mysqli_num_rows($consulta_linea);
    while($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
    {
	 $consulta = '';
	 $consulta_registros = '';
	 
	 $linea_id = $resultado_consulta_linea['id'];
		
	 $resultado .= '   <tr>';
     $resultado .= '    <td><b>'.$resultado_consulta_linea['nombre'].' (Total)<b></td>';
     $resultado .= '    <td></td>';
	 
	 $consulta = 'select SUM(float_precio*int_unidades) as venta from detalle_sell_out where id_distribuidor = '.$id_distribuidor.' and id_linea = '.$linea_id.' and estado = "1"';
	 $consulta_registros = 'select id from detalle_sell_out where id_distribuidor = '.$id_distribuidor.' and id_linea = '.$linea_id.' and estado = "1"';

     $consulta .= 'and id_anio = '.$id_anio.' ';
     $consulta_registros .= 'and id_anio = '.$id_anio.' ';
	 		
	 if($id_periodo != 0)	
	 {
	  if($id_periodo == 1)
      {
	   $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q1'");
	  }
	  if($id_periodo == 2)
      {
	   $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q2'");
	  }
	  if($id_periodo == 3)
      {
	   $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q3'");
	  }
	  if($id_periodo == 4)
      {
	   $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q4'");
	  }
	  $resultado_consulta_q = mysqli_fetch_array($consulta_q);
      $id_q = $resultado_consulta_q['id'];

      $consulta .= 'and id_q = '.$id_q.' ';
      $consulta_registros .= 'and id_q = '.$id_q.' ';
	 } 
	 	 
	 if($id_mes != 0)
     {
	  $consulta_mes = mysqli_query($conexion,"select * from mes where anio = '$id_anio' and q = '$id_q' and mes = '$id_mes'");
	  $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
      $id_mes_f = $resultado_consulta_mes['id'];

      $consulta .= 'and id_mes = '.$id_mes_f.' ';
      $consulta_registros .= 'and id_mes = '.$id_mes_f.' ';	  
	 }
	 
	 if($id_pais != 0)
     {
      $consulta .= 'and id_pais = '.$id_pais.' ';
      $consulta_registros .= 'and id_pais = '.$id_pais.' ';	  
	 }
	
	 if($id_zona != 0 && $id_zona != 9999)
     {
      $consulta .= 'and id_zona = '.$id_zona.' ';
      $consulta_registros .= 'and id_zona = '.$id_zona.' ';	  
	 }
	 
	 if($id_segmento != 0 && $id_segmento != 9999)
     {
      $consulta .= 'and id_segmento = '.$id_segmento.' ';
      $consulta_registros .= 'and id_segmento = '.$id_segmento.' ';	  
	 }
	 
	 
	 $consulta_sell_out = mysqli_query($conexion,$consulta);	   	   
     $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);
	 
	 $consulta_registros_sell_out = mysqli_query($conexion,$consulta_registros);	   	   
	 $registros += mysqli_num_rows($consulta_registros_sell_out);
	 
     $venta = $resultado_consulta_sell_out['venta'];
     $resultado .= '    <td align = "right"><b>'.number_format($venta, 2, ',', '.').'</b></td>';
	 $resultado .= '   </tr>';
	
	 $consulta_actividad = mysqli_query($conexion,"select * from actividad where linea = $linea_id order by nombre ASC");
     $total_actividad = mysqli_num_rows($consulta_actividad);
     while($resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad))
     {
 	  $actividad_id = $resultado_consulta_actividad['id'];

 	  $resultado .= '   <tr>';
      $resultado .= '    <td></td>';
	  $resultado .= '    <td>'.$resultado_consulta_actividad['nombre'].'</td>';
	  
      $consulta_con_actividad = $consulta.'and id_actividad = '.$actividad_id.' ';
	  
	  $consulta_sell_out = mysqli_query($conexion,$consulta_con_actividad);
      $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);
      $venta = $resultado_consulta_sell_out['venta'];
      $resultado .= '    <td align = "right">'.number_format($venta, 2, ',', '.').'</td>';
	  $resultado .= '   </tr>';	 
	 }
	 
	}
	
    $resultado .= '	 </tbody>';
    $resultado .= ' </table>';
    $resultado .= '</div>';
   }
   else
   {
    $resultado .= '<div class="table-responsive">';
    $resultado .= ' <table class="table table-striped table-bordered table-hover" id="actividad">';
    $resultado .= '  <thead>';
    $resultado .= '   <tr>';
    $resultado .= '    <th>Producto</th>';
    $resultado .= '    <th>C&oacute;digo</th>';
    $resultado .= '    <th>Unidades</th>';	
    $resultado .= '    <th>Ventas</th>';			
    $resultado .= '	 </tr>';
    $resultado .= '  </thead>';
    $resultado .= '	<tfoot>';
    $resultado .= '   <tr>';
    $resultado .= '    <th>Producto</th>';
    $resultado .= '    <th>C&oacute;digo</th>';
    $resultado .= '    <th>Unidades</th>';	
    $resultado .= '    <th>Ventas</th>';			
    $resultado .= '	 </tr>';
    $resultado .= '  </tfoot>';
    $resultado .= '  <tbody>';

	$consulta = "select * from producto where actividad = ".$id_actividad." and U".$nombre_anio." = '1' order by nombre ASC";
	
    $consulta_producto = mysqli_query($conexion,$consulta);
    $total_producto = mysqli_num_rows($consulta_producto);
    while($resultado_consulta_producto = mysqli_fetch_array($consulta_producto))
    {
	 $consulta = '';
	 $consulta_registros = '';	
		
 	 $id_producto = $resultado_consulta_producto['id'];
	 
	 $consulta = 'select SUM(float_precio*int_unidades) as venta, SUM(int_unidades) as unidades from detalle_sell_out where id_distribuidor = '.$id_distribuidor.' and id_linea = '.$id_linea.' and id_actividad = '.$id_actividad.' and id_producto = '.$id_producto.' and estado = "1"';
	 $consulta_registros = 'select id from detalle_sell_out where id_distribuidor = '.$id_distribuidor.' and id_linea = '.$id_linea.' and id_actividad = '.$id_actividad.' and id_producto = '.$id_producto.' and estado = "1"';
		 
     $consulta .= 'and id_anio = '.$id_anio.' ';
     $consulta_registros .= 'and id_anio = '.$id_anio.' ';
		
	 if($id_periodo != 0)	
	 {
	  if($id_periodo == 1)
      {
	   $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q1'");
	  }
	  if($id_periodo == 2)
      {
	   $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q2'");
	  }
	  if($id_periodo == 3)
      {
	   $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q3'");
	  }
	  if($id_periodo == 4)
      {
	   $consulta_q = mysqli_query($conexion,"select * from q where anio = '$id_anio' and nombre = 'Q4'");
	  }
	  $resultado_consulta_q = mysqli_fetch_array($consulta_q);
      $id_q = $resultado_consulta_q['id'];

      $consulta .= 'and id_q = '.$id_q.' '; 
      $consulta_registros .= 'and id_q = '.$id_q.' ';
	 } 
	 	 
	 if($id_mes != 0)
     {
	  $consulta_mes = mysqli_query($conexion,"select * from mes where anio = '$id_anio' and q = '$id_q' and mes = '$id_mes'");
	  $resultado_consulta_mes = mysqli_fetch_array($consulta_mes);
      $id_mes_f = $resultado_consulta_mes['id'];

      $consulta .= 'and id_mes = '.$id_mes_f.' ';
      $consulta_registros .= 'and id_mes = '.$id_mes_f.' ';	  
	 }
	 
	 if($id_pais != 0)
     {
      $consulta .= 'and id_pais = '.$id_pais.' ';
      $consulta_registros .= 'and id_pais = '.$id_pais.' ';
	 }
	
	 if($id_zona != 0 && $id_zona != 9999)
     {
      $consulta .= 'and id_zona = '.$id_zona.' ';
      $consulta_registros .= 'and id_zona = '.$id_zona.' ';
	 }
	 
	 if($id_segmento != 0 && $id_segmento != 9999)
     {
      $consulta .= 'and id_segmento = '.$id_segmento.' ';
      $consulta_registros .= 'and id_segmento = '.$id_segmento.' ';	 
	 }
	  	  
	 $consulta_sell_out = mysqli_query($conexion,$consulta);
     $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);

	 $consulta_registros_sell_out = mysqli_query($conexion,$consulta_registros);	   	   
	 $registros += mysqli_num_rows($consulta_registros_sell_out);
	 
     $venta = $resultado_consulta_sell_out['venta'];
	 $unidades = $resultado_consulta_sell_out['unidades'];
     
	 if($venta > 0)
	 {
	  $resultado .= '   <tr>';
	  $resultado .= '    <td>'.$resultado_consulta_producto['nombre'].'</td>';
	  $resultado .= '    <td>'.$resultado_consulta_producto['referencia'].'</td>';
	  $resultado .= '    <td align = "right">'.number_format($unidades, 0, ',', '.').'</td>';
	  $resultado .= '    <td align = "right">'.number_format($venta, 2, ',', '.').'</td>';	  
	  $resultado .= '   </tr>';
	 }
	 
	}
	
    $resultado .= '	</tbody>';
    $resultado .= ' </table>';
    $resultado .= '</div>';
   }
   
   if($id_segmento == 9999)
   {
    $resultado .= '<div class="table-responsive">';
    $resultado .= ' <table class="table table-striped table-bordered table-hover" id="actividad">';
    $resultado .= '  <thead>';
    $resultado .= '   <tr>';
    $resultado .= '    <th>Segmento</th>';
    $resultado .= '    <th>Ventas</th>';
    $resultado .= '	  </tr>';
    $resultado .= '  </thead>';
    $resultado .= '	 <tfoot>';
    $resultado .= '   <tr>';
    $resultado .= '    <th>Segmento</th>';
    $resultado .= '    <th>Ventas</th>';
    $resultado .= '	  </tr>';
    $resultado .= '  </tfoot>';
    $resultado .= '  <tbody>';
   
    $consulta_segmento = mysqli_query($conexion,"select * from segmento order by nombre ASC");
    while($resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento))
    {
	 $segmento_id = $resultado_consulta_segmento['id'];

	 $consulta = '';
			 
	 $consulta = 'select SUM(float_precio*int_unidades) as venta from detalle_sell_out where id_distribuidor = '.$id_distribuidor.' and id_anio = '.$id_anio.' and id_segmento = '.$segmento_id.' and estado = "1"';

	 $consulta_sell_out = mysqli_query($conexion,$consulta);
     $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);
	 
     $venta = $resultado_consulta_sell_out['venta'];
	 
	 $resultado .= '   <tr>';
     $resultado .= '    <td>'.$resultado_consulta_segmento['nombre'].'</td>';
	 $resultado .= '    <td align = "right">'.number_format($venta, 2, ',', '.').'</td>';	  
	 $resultado .= '   </tr>';
    }
   
    $resultado .= '	 </tbody>';
    $resultado .= ' </table>';
    $resultado .= '</div>';
   
   }
   
   if($id_pais != 0 && $id_zona == 9999)
   {
    $resultado .= '<div class="table-responsive">';
    $resultado .= ' <table class="table table-striped table-bordered table-hover" id="actividad">';
    $resultado .= '  <thead>';
    $resultado .= '   <tr>';
    $resultado .= '    <th>Zona</th>';
    $resultado .= '    <th>Estado / Dpto</th>';	
    $resultado .= '    <th>Ciudad</th>';
	$resultado .= '    <th>Ventas</th>';
    $resultado .= '	  </tr>';
    $resultado .= '  </thead>';
    $resultado .= '	 <tfoot>';
    $resultado .= '   <tr>';
    $resultado .= '    <th>Zona</th>';
    $resultado .= '    <th>Estado / Dpto</th>';
    $resultado .= '    <th>Ciudad</th>';
	$resultado .= '    <th>Ventas</th>';
    $resultado .= '	  </tr>';
    $resultado .= '  </tfoot>';
    $resultado .= '  <tbody>';
   
    $consulta_zona = mysqli_query($conexion,"select * from zona where pais = $id_pais order by nombre ASC");
    while($resultado_consulta_zona = mysqli_fetch_array($consulta_zona))
    {
	 $zona_id = $resultado_consulta_zona['id'];
			 
	 $consulta = 'select SUM(float_precio*int_unidades) as venta from detalle_sell_out where id_distribuidor = '.$id_distribuidor.' and id_anio = '.$id_anio.' and id_pais = '.$id_pais.' and id_zona = '.$zona_id.' and estado = "1"';

	 $consulta_sell_out = mysqli_query($conexion,$consulta);
     $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);
	 
     $venta = $resultado_consulta_sell_out['venta'];
	 
	 $resultado .= '   <tr>';
     $resultado .= '    <td><b>'.$resultado_consulta_zona['nombre'].'</b></td>';
	 $resultado .= '    <td></td>';
	 $resultado .= '    <td></td>';	 
	 $resultado .= '    <td align = "right"><b>'.number_format($venta, 2, ',', '.').'</b></td>';
	 $resultado .= '   </tr>';
	 
     $consulta_departamento = mysqli_query($conexion,"select * from departamento where zona = $zona_id order by nombre ASC");
     while($resultado_consulta_departamento = mysqli_fetch_array($consulta_departamento))
     {

	  $departamento_id = $resultado_consulta_departamento['id'];
 
	  $consulta = 'select SUM(float_precio*int_unidades) as venta from detalle_sell_out where id_distribuidor = '.$id_distribuidor.' and id_anio = '.$id_anio.' and id_pais = '.$id_pais.' and id_zona = '.$zona_id.'  and id_departamento = '.$departamento_id.' and estado = "1"';

	  $consulta_sell_out = mysqli_query($conexion,$consulta);
      $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);
	 
      $venta = $resultado_consulta_sell_out['venta'];
	
	  if($venta != 0)
	  {
	   $resultado .= '   <tr>';
  	   $resultado .= '    <td></td>';
       $resultado .= '    <td>'.$resultado_consulta_departamento['nombre'].'</td>';
	   $resultado .= '    <td></td>';
	   $resultado .= '    <td align = "right">'.number_format($venta, 2, ',', '.').'</td>';
	   $resultado .= '   </tr>';
	  
	   $consulta_ciudad = mysqli_query($conexion,"select * from ciudad where departamento = $departamento_id order by nombre ASC");
       while($resultado_consulta_ciudad = mysqli_fetch_array($consulta_ciudad))
       {

	    $ciudad_id = $resultado_consulta_ciudad['id'];
 
	    $consulta = 'select SUM(float_precio*int_unidades) as venta from detalle_sell_out where id_distribuidor = '.$id_distribuidor.' and id_anio = '.$id_anio.' and id_pais = '.$id_pais.' and id_zona = '.$zona_id.' and id_departamento = '.$departamento_id.' and id_ciudad = '.$ciudad_id.' and estado = "1"';

	    $consulta_sell_out = mysqli_query($conexion,$consulta);
        $resultado_consulta_sell_out = mysqli_fetch_array($consulta_sell_out);
	 
        $venta = $resultado_consulta_sell_out['venta'];
	  
	    if($venta != 0)
	    {
	     $resultado .= '   <tr>';
  	     $resultado .= '    <td></td>';
         $resultado .= '    <td></td>';
	     $resultado .= '    <td>'.$resultado_consulta_ciudad['nombre'].'</td>';
	     $resultado .= '    <td align = "right">'.number_format($venta, 2, ',', '.').'</td>';
	     $resultado .= '   </tr>';
		}
		
	   }
	  
	  }
	  
	 }
	 
    }
   
    $resultado .= '	 </tbody>';
    $resultado .= ' </table>';
    $resultado .= '</div>';
   
   }
   
  }

  $sin_detallado = '';
  if($registros > 7000)
  {
   $sin_detallado = '(Sin informe detallado por tener más de 7000 registros)';
  }
  
  $previo_resultado .= '<div class="alert alert-success">';
  $previo_resultado .= 'Cantidad de registros: '.number_format($registros, 0, ',', '.').' '.$sin_detallado.'<br>';
  $previo_resultado .= '<b>FILTROS = </b>'.$filtros.'<br>';    
  $previo_resultado .= '</div>';
  
  if($perfil == 'super_schneider' && $registros > 0)
  {
   $previo_resultado .= ' <br><br>';	
   $previo_resultado .= ' <div align="right">';
   $previo_resultado .= '  <a class="btn btn-success" href="exportar_resultado.php?id_anio='.$id_anio.'&id_periodo='.$id_periodo.'&id_mes='.$id_mes.'&id_distribuidor='.$id_distribuidor.'&id_linea='.$id_linea.'&id_actividad='.$id_actividad.'&id_pais='.$id_pais.'&id_zona='.$id_zona.'&id_segmento='.$id_segmento.'" target="_blank">Exportar Resultado</a>';
   
   if($registros <= 7000)
   {
	$previo_resultado .= '  <a class="btn btn-success" href="exportar_resultado_detallado.php?id_anio='.$id_anio.'&id_periodo='.$id_periodo.'&id_mes='.$id_mes.'&id_distribuidor='.$id_distribuidor.'&id_linea='.$id_linea.'&id_actividad='.$id_actividad.'&id_pais='.$id_pais.'&id_zona='.$id_zona.'&id_segmento='.$id_segmento.'" target="_blank">Exportar Resultado Detallado</a>';
   }
   $previo_resultado .= ' </div>';
   $previo_resultado .= ' <br><br><br>';	
  }
 }
 
 if($perfil != 'admin_schneider' && $perfil != 'super_schneider')
 {
  $consulta_cartera = mysqli_query($conexion,"select * from auditoria_q where q = '$id_q' and perfil = 'cartera' and accion = 'APROBAR'");
  if(mysqli_num_rows($consulta_cartera) == 0)
  {
   $disclaimer = '<div class="alert alert-danger">La información suministrada no es definitiva hasta finalizar el periodo de aprobación.</div>';
  }
 
  if($id_anio == 0)
  {
   $id_anio = date("Y");
   $consulta_anio = mysqli_query($conexion,"select * from anio where nombre = '$id_anio'");
   $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
   $id_anio = $resultado_consulta_anio[id];
  }
  if($id_q == 0)
  {
   $id_mes = date("m");
   if($id_mes == '01' || $id_mes == '02' || $id_mes == '03')
   {
	$consulta_q = mysqli_query($conexion,"select * from q where nombre = 'Q1' and anio = '$id_anio'");
   }
   if($id_mes == '04' || $id_mes == '05' || $id_mes == '06')
   {
	$consulta_q = mysqli_query($conexion,"select * from q where nombre = 'Q2' and anio = '$id_anio'");
   }
   if($id_mes == '07' || $id_mes == '08' || $id_mes == '09')
   {
	$consulta_q = mysqli_query($conexion,"select * from q where nombre = 'Q3' and anio = '$id_anio'");
   }
   if($id_mes == '10' || $id_mes == '11' || $id_mes == '12')
   {
	$consulta_q = mysqli_query($conexion,"select * from q where nombre = 'Q4' and anio = '$id_anio'");
   }
   $resultado_consulta_q = mysqli_fetch_array($consulta_q);
   $id_q = $resultado_consulta_q[id];
  }
  
  if($op == 'in')
  {
   $informacion .= '<b>SELL IN</b> - ';
  }
  if($op == 'out')
  {
   $informacion .= '<b>SELL OUT</b> - ';
  }
  
  // Año - Periodo
  $consulta_q = mysqli_query($conexion,"select * from q where id = '$id_q'");
  $resultado_consulta_q = mysqli_fetch_array($consulta_q);
  $nombre_q0 = $resultado_consulta_q[nombre];
 
  $cantidad_anio = 1;
  $consulta_anio = mysqli_query($conexion,"select * from anio order by nombre ASC");
  while($resultado_consulta_anio = mysqli_fetch_array($consulta_anio))
  {
   $anios[$cantidad_anio]['id'] = $resultado_consulta_anio['id'];
   $anios[$cantidad_anio]['nombre'] = $resultado_consulta_anio['nombre'];
  
   if($id_anio == $resultado_consulta_anio['id'])
   {
	$informacion .= '<b>A&ntilde;o:</b> '.$resultado_consulta_anio['nombre'];
   }
     
   $consulta_q = mysqli_query($conexion,"select * from q where nombre = '$nombre_q0' and anio = '$resultado_consulta_anio[id]'");
   $resultado_consulta_q = mysqli_fetch_array($consulta_q);
   $anios[$cantidad_anio]['q'] = $resultado_consulta_q[id];
   
   if($id_anio == $resultado_consulta_anio['id'])
   {
    $consulta_q = mysqli_query($conexion,"select * from q where anio = $id_anio and nombre = 'Q1'");
    $resultado_consulta_q = mysqli_fetch_array($consulta_q);
	$q1_id = $resultado_consulta_q['id'];

    $consulta_q = mysqli_query($conexion,"select * from q where anio = $id_anio and nombre = 'Q2'");
    $resultado_consulta_q = mysqli_fetch_array($consulta_q);
	$q2_id = $resultado_consulta_q['id'];

    $consulta_q = mysqli_query($conexion,"select * from q where anio = $id_anio and nombre = 'Q3'");
    $resultado_consulta_q = mysqli_fetch_array($consulta_q);
	$q3_id = $resultado_consulta_q['id'];

    $consulta_q = mysqli_query($conexion,"select * from q where anio = $id_anio and nombre = 'Q4'");
    $resultado_consulta_q = mysqli_fetch_array($consulta_q);
	$q4_id = $resultado_consulta_q['id'];	
   }
	   
   $cantidad_anio++;
  }
  
  $informacion = $informacion.' - <b>Periodo:</b> '.$nombre_q0;
      
  if($distri != 0)
  {
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = $distri");
   $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
   $nombre_distribuidor = $resultado_consulta_distribuidor[nombre];
   
   $informacion = $informacion.' - <b>Ditribuidor:</b> '.$nombre_distribuidor;
  }
  
  $informacion = '<div class="alert alert-info">'.$informacion.'</div>';
 
 }
 
 
 /*
 
 if($perfil == 'canal' || $perfil == 'linea')
 {
  $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $id_usuario");
  $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
  $id_pais = $resultado_consulta_usuario[pais];
  $id_linea = $resultado_consulta_usuario[linea];
  
  $i = 1;
  if($perfil == 'linea')
  {
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil =  'distribuidor' order by nombre asc");
  }
  if($perfil == 'canal')
  {
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil =  'distribuidor' and pais = $id_pais order by nombre asc");
  }
  
  while ($resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor))
  {
   // Id
   $distribuidor[$i]['id'] = $resultado_consulta_distribuidor['id'];
   $id_distribuidor = $resultado_consulta_distribuidor['id'];
   // Nombre
   $distribuidor[$i]['nombre'] = $resultado_consulta_distribuidor['nombre'];
   $i++;
  
   $j = 1;
   if($perfil == 'canal')
   {
    $consulta_actividad = mysqli_query($conexion,"select * from actividad where sell_out = 1 order by nombre asc");
   }
   if($perfil == 'linea')
   {
    $consulta_actividad = mysqli_query($conexion,"select * from actividad where linea = $id_linea and sell_out = 1 order by nombre asc");
   }

   while ($resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad))
   {
    // Id
    $actividad[$i][$j]['id'] = $resultado_consulta_actividad['id'];
    $id_actividad = $resultado_consulta_actividad['id'];
    
	// Meta   
    $consulta_meta_sell_out = mysqli_query($conexion,"select * from meta_sell_out where distribuidor = '$id_distribuidor' and anio = '$id_anio' and actividad = '$id_actividad'");
    if(mysqli_num_rows($consulta_meta_sell_out) == 0)
    {
     $actividad[$i][$j]['meta'] = 0;
     $meta = 0;
    }
    else
    {	   
     $resultado_consulta_meta_sell_out = mysqli_fetch_array($consulta_meta_sell_out);
     $id_meta_sell_out = $resultado_consulta_meta_sell_out['id'];
      
     $consulta_meta_q_sell_out = mysqli_query($conexion,"select * from meta_q_sell_out where meta_sell_out = $id_meta_sell_out and q = $id_q");
     $resultado_consulta_meta_q_sell_out = mysqli_fetch_array($consulta_meta_q_sell_out);
      
     $actividad[$i][$j]['meta'] = $resultado_consulta_meta_q_sell_out['meta'];
     $meta = $resultado_consulta_meta_q_sell_out['meta'];
	
     $comision = $resultado_consulta_meta_q_sell_out['comision'];
    }
   
    // Venta Actividad
    $venta_actividad = 0;
    $consulta_detalle_sell_out = mysqli_query($conexion,"select * from detalle_sell_out where id_distribuidor = '$id_distribuidor' and id_anio = '$id_anio' and id_q = '$id_q' and id_actividad = '$id_actividad'");
    while($resultado_consulta_detalle_sell_out = mysqli_fetch_array($consulta_detalle_sell_out))
    {
     $venta_actividad = $venta_actividad + ($resultado_consulta_detalle_sell_out['int_unidades'] * $resultado_consulta_detalle_sell_out['float_precio']);
    }   
    $actividad[$i][$j]['venta_actividad'] = $venta_actividad;
   
    // Porcentaje
    if($meta == 0)
    {
	 if($venta_actividad == 0)
	 {
	  $actividad[$i][$j]['porcentaje'] = 0;
	  $porcentaje = 0;
     }
	 else
	 {
	  $actividad[$i][$j]['porcentaje'] = 100;
	  $porcentaje = 100;
	 }
    }
    else   
    {
     $actividad[$i][$j]['porcentaje'] = $venta_actividad * 100 / $meta;
     $porcentaje = $actividad[$i][$j]['porcentaje'];
    }

    // Bonificación
    if($meta != 0)
    {
     if($porcentaje >= 100)
     {
      $actividad[$i][$i]['bonificacion'] = 0;
     }
     else
     {
      $actividad[$i][$i]['bonificacion'] = $comision * $meta / 100;
     }
    }  
  
    // Bar Progress
    if($porcentaje > 100)
    {
 	$actividad[$i][$j]['bar_progress'] = 'progress-bar-success';
    }
    else
    {
     if($porcentaje < 80)
     {
 	  $actividad[$i][$j]['bar_progress'] = 'progress-bar-danger';	
	 }   
	 else
	 {
	  $actividad[$i][$j]['bar_progress'] = 'progress-bar-warning';
	 }
    }
	
	// Nombre
    $actividad[$i][$j]['nombre'] = $resultado_consulta_actividad['nombre'];
	
	$j++;
   }
   
  }
  
  // Agrupado
  $k = 1;
  if($perfil == 'linea')
  {
   $consulta_agrupado = mysqli_query($conexion,"select * from pais order by nombre asc");
  }
  if($perfil == 'canal')
  {
   $consulta_agrupado = mysqli_query($conexion,"select * from linea order by nombre asc");
  }
  
  while ($resultado_consulta_agrupado = mysqli_fetch_array($consulta_agrupado))
  {
   // Id
   $id_pais = $resultado_consulta_agrupado['id'];
	  
   // Nombre
   $agrupado[$k]['nombre'] = $resultado_consulta_agrupado['nombre'];
   
   // Contenido
   $agrupado[$k]['contenido'] = '';
   $consulta_linea = mysqli_query($conexion,"select * from linea order by nombre asc");
   while ($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
   {
    $id_linea = $resultado_consulta_linea['id'];
	$nombre_linea = $resultado_consulta_linea['nombre'];
	
	$venta = 0;
    $consulta_aprobacion = mysqli_query($conexion,"select SUM(venta) as venta from aprobacion where q = $id_q and anio = $id_anio and linea = $id_linea and pais = $id_pais");
    $resultado_consulta_aprobacion = mysqli_fetch_array($consulta_aprobacion);
	$venta = $resultado_consulta_aprobacion['venta'];
	
    $agrupado[$k]['contenido'] .= '<div><b>'.$nombre_linea.'</b></div><div align="right">'. number_format($venta, 2, ',', '.').'</div>';
   }
   
   $k++;
  }
  
 } 
 */

 if($perfil == 'segmento')
 {
  $k = 1;
      
  $distri = 0;
  
  $consulta_agrupado = mysqli_query($conexion,"select * from segmento_usuario where usuario = '$id_usuario'");
  while ($resultado_consulta_agrupado = mysqli_fetch_array($consulta_agrupado))
  {
   // Segmento
   $id_segmento = $resultado_consulta_agrupado['segmento'];
   
   $consulta_segmento = mysqli_query($conexion,"select * from segmento where id = '$id_segmento'");
   $resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento);
   
   // País
   $id_pais = $resultado_consulta_agrupado['pais'];
   
   $consulta_pais = mysqli_query($conexion,"select * from pais where id = '$id_pais'");
   $resultado_consulta_pais = mysqli_fetch_array($consulta_pais);

   // Nombre
   $agrupado[$k]['nombre'] = $resultado_consulta_segmento['nombre'].' - '.$resultado_consulta_pais['nombre'];
   
   // Contenido
   $agrupado[$k]['contenido'] = '<table width="100%">';
   $consulta_linea = mysqli_query($conexion,"select * from linea order by nombre asc");
   while ($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
   {
    $id_linea = $resultado_consulta_linea['id'];
    $nombre_linea = $resultado_consulta_linea['nombre'];
	
	$venta = 0;
    if($op == 'in')
    {
	 //$consulta_venta = mysqli_query($conexion,"select SUM(float_precio * int_unidades) as venta from detalle_sell_in where id_q = $id_q and id_anio = $id_anio and id_linea = $id_linea and id_pais_distribuidor = $id_pais and estado = '1'");
    }
	if($op == 'out')
    {  
	 $consulta_venta = mysqli_query($conexion,"select SUM(float_precio * int_unidades) as venta from detalle_sell_out where id_q = $id_q and id_anio = $id_anio and id_linea = $id_linea and id_pais = $id_pais and id_segmento = $id_segmento and estado = '1'");
    }
	$resultado_consulta_venta = mysqli_fetch_array($consulta_venta);
	$venta = $resultado_consulta_venta['venta'];
	
    $agrupado[$k]['contenido'] .= '<tr><td align="left"><b>'.$nombre_linea.'</b></td><td align="right">'. number_format($venta, 2, ',', '.').'</td></tr>';
   }
   $agrupado[$k]['contenido'] .= '</table>';
   
   $k++;
  }
  
 }
 
 if($perfil == 'zona')
 {
  $k = 1;
      
  $distri = 0;
  
  $consulta_agrupado = mysqli_query($conexion,"select * from zona_usuario where usuario = '$id_usuario'");
  while ($resultado_consulta_agrupado = mysqli_fetch_array($consulta_agrupado))
  {
   // Zona
   $id_zona = $resultado_consulta_agrupado['zona'];
   
   $consulta_zona = mysqli_query($conexion,"select * from zona where id = '$id_zona'");
   $resultado_consulta_zona = mysqli_fetch_array($consulta_zona);
      
   // Nombre
   $agrupado[$k]['nombre'] = $resultado_consulta_zona['nombre'];
   
   // Contenido
   $agrupado[$k]['contenido'] = '<table width="100%">';
   $consulta_linea = mysqli_query($conexion,"select * from linea order by nombre asc");
   while ($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
   {
    $id_linea = $resultado_consulta_linea['id'];
    $nombre_linea = $resultado_consulta_linea['nombre'];
	
	$venta = 0;
    if($op == 'in')
    {
	 $consulta_venta = mysqli_query($conexion,"select SUM(float_precio * int_unidades) as venta from detalle_sell_in where id_q = $id_q and id_anio = $id_anio and id_linea = $id_linea and id_pais_distribuidor = $id_pais and estado = '1'");
    }
	if($op == 'out')
    {  
	 $consulta_venta = mysqli_query($conexion,"select SUM(float_precio * int_unidades) as venta from detalle_sell_out where id_q = $id_q and id_anio = $id_anio and id_linea = $id_linea and id_zona = $id_zona and estado = '1'");
    }
	$resultado_consulta_venta = mysqli_fetch_array($consulta_venta);
	$venta = $resultado_consulta_venta['venta'];
	
    $agrupado[$k]['contenido'] .= '<tr><td align="left"><b>'.$nombre_linea.'</b></td><td align="right">'. number_format($venta, 2, ',', '.').'</td></tr>';
   }
   $agrupado[$k]['contenido'] .= '</table>';
   
   $k++;
  }
  
 }
 
 if($perfil == 'canal')
 {
  $k = 1;
  $id_pais = $_SESSION['pais'];
      
  if($distri == 0)
  {
   $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil = 'distribuidor' and pais = $id_pais order by nombre asc");
  
   $consulta_agrupado = mysqli_query($conexion,"select * from linea order by nombre asc");  
   while ($resultado_consulta_agrupado = mysqli_fetch_array($consulta_agrupado))
   {
    // Id
    $id_linea = $resultado_consulta_agrupado['id'];
	  
    // Nombre
    $agrupado[$k]['nombre'] = $resultado_consulta_agrupado['nombre'];
   
    // Contenido
    $agrupado[$k]['contenido'] = '<table width="100%">';
    $consulta_actividad = mysqli_query($conexion,"select * from actividad where linea = $id_linea order by nombre asc");
    while ($resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad))
    {
     $id_actividad = $resultado_consulta_actividad['id'];
 	 $nombre_actividad = $resultado_consulta_actividad['nombre'];
	
	 $venta = 0;
     if($op == 'in')
     {
	  $consulta_venta = mysqli_query($conexion,"select SUM(float_precio * int_unidades) as venta from detalle_sell_in where id_q = $id_q and id_anio = $id_anio and id_linea = $id_linea and id_actividad = $id_actividad and id_pais_distribuidor = $id_pais and estado = '1'");
     }
	 if($op == 'out')
     {  
	  $consulta_venta = mysqli_query($conexion,"select SUM(float_precio * int_unidades) as venta from detalle_sell_out where id_q = $id_q and id_anio = $id_anio and id_linea = $id_linea and id_actividad = $id_actividad and id_pais = $id_pais and estado = '1'");
     }
	 $resultado_consulta_venta = mysqli_fetch_array($consulta_venta);
	 $venta = $resultado_consulta_venta['venta'];
	
     $agrupado[$k]['contenido'] .= '<tr><td align="left"><b>'.$nombre_actividad.'</b></td><td align="right">'. number_format($venta, 2, ',', '.').'</td></tr>';
    }
    $agrupado[$k]['contenido'] .= '</table>';
   
    $k++;
   }
  }
 }
 
 if($perfil == 'linea')
 {
  $k = 1;
  $id_linea = $_SESSION['linea'];
    
  $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil = 'distribuidor' order by nombre asc");
	
  $consulta_agrupado = mysqli_query($conexion,"select * from pais order by nombre asc");
  
  while ($resultado_consulta_agrupado = mysqli_fetch_array($consulta_agrupado))
  {
   // Id
   $id_pais = $resultado_consulta_agrupado['id'];
	 
   // Moneda
   $id_moneda = $resultado_consulta_agrupado['moneda'];
   $consulta_moneda = mysqli_query($conexion,"select sigla from moneda where id = $id_moneda");
   $resultado_consulta_moneda = mysqli_fetch_array($consulta_moneda);
   
   // Nombre
   $agrupado[$k]['nombre'] = ''.$resultado_consulta_agrupado['nombre'].' ('.$resultado_consulta_moneda['sigla'].')';
   
   // Contenido
   $agrupado[$k]['contenido'] = '<table width="100%">';
   $consulta_actividad = mysqli_query($conexion,"select * from actividad where linea = $id_linea order by nombre asc");
   while ($resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad))
   {
    $id_actividad = $resultado_consulta_actividad['id'];
	$nombre_actividad = $resultado_consulta_actividad['nombre'];
	
	$venta = 0;
    if($op == 'in')
    {	 
	 $consulta_venta = mysqli_query($conexion,"select SUM(float_precio * int_unidades) as venta from detalle_sell_in where id_q = $id_q and id_anio = $id_anio and id_linea = $id_linea and id_actividad = $id_actividad and id_pais_distribuidor = $id_pais and estado = '1'");
    }
	if($op == 'out')
    {  
	 $consulta_venta = mysqli_query($conexion,"select SUM(float_precio * int_unidades) as venta from detalle_sell_out where id_q = $id_q and id_anio = $id_anio and id_linea = $id_linea and id_actividad = $id_actividad and id_pais = $id_pais and estado = '1'");
    }
	    
	$resultado_consulta_venta = mysqli_fetch_array($consulta_venta);
	$venta = $resultado_consulta_venta['venta'];
	
    $agrupado[$k]['contenido'] .= '<tr><td align="left"><b>'.$nombre_actividad.'</b></td><td align="right">'. number_format($venta, 2, ',', '.').'</td></tr>';
   }
   $agrupado[$k]['contenido'] .= '</table>';
   
   $k++;
  }
 }
 
 if($perfil == 'canal' || $perfil == 'linea' || $perfil == 'zona' || $perfil == 'segmento')
 {
  $d = 1;
  while ($resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor))
  {
   // Id
   $distribuidor[$d]['id'] = $resultado_consulta_distribuidor['id'];
   $id_distribuidor_metas = $resultado_consulta_distribuidor['id'];
   // Nombre
   $distribuidor[$d]['nombre'] = $resultado_consulta_distribuidor['nombre'];
   
   if($perfil == 'linea')
   { 
    if($op == 'in')
    {
	 //Meta
     $consulta_meta_sell_in = mysqli_query($conexion,"select * from meta_sell_in where distribuidor = '$id_distribuidor_metas' and anio = '$id_anio' and linea = '$id_linea'");
     if(mysqli_num_rows($consulta_meta_sell_in) == 0)
     {
      $distribuidor[$d]['meta'] = 0;
      $meta = 0;
     }
     else
     {	   
      $resultado_consulta_meta_sell_in = mysqli_fetch_array($consulta_meta_sell_in);
      $id_meta_sell_in = $resultado_consulta_meta_sell_in['id'];
       
      $consulta_meta_q_sell_in = mysqli_query($conexion,"select * from meta_q_sell_in where meta_sell_in = '$id_meta_sell_in' and q = '$id_q'");
      $resultado_consulta_meta_q_sell_in = mysqli_fetch_array($consulta_meta_q_sell_in);
       
      $distribuidor[$d]['meta'] = $resultado_consulta_meta_q_sell_in['meta'];
      $meta = $resultado_consulta_meta_q_sell_in['meta'];	
     }

     $consulta_detalle_sell_in = mysqli_query($conexion,"select SUM(float_precio*int_unidades) as compra from detalle_sell_in where id_distribuidor = '$id_distribuidor_metas' and id_anio = '$id_anio' and id_q = '$id_q' and id_linea = '$id_linea' and estado = '1'");
   
     $resultado_consulta_detalle_sell_in = mysqli_fetch_array($consulta_detalle_sell_in);
     $distribuidor[$d]['compra'] = $resultado_consulta_detalle_sell_in['compra'];
     $compra = $resultado_consulta_detalle_sell_in['compra'];
       
     // Porcentaje
     if($meta == 0)
     {
 	  $distribuidor[$d]['porcentaje'] = 0; 
	  $porcentaje = 0;
     }
     else   
     {
      $distribuidor[$d]['porcentaje'] = $compra * 100 / $meta;
      $porcentaje = $distribuidor[$d]['porcentaje'];
     }
    
     // Bar Progress
     if($porcentaje >= 100)
     {
  	  $distribuidor[$d]['bar_progress'] = 'progress-bar-success';
     }
     else
     {
      if($porcentaje < 80)
      {
 	   $distribuidor[$d]['bar_progress'] = 'progress-bar-danger';	
 	  }   
 	  else
	  {
	   $distribuidor[$d]['bar_progress'] = 'progress-bar-warning';
	  }
     }
    }
	if($op == 'out')
    {
     $consulta_meta_sell_out = mysqli_query($conexion,"select * from meta_sell_out where distribuidor = '$id_distribuidor_metas' and anio = '$id_anio' and linea = '$id_linea'");
    
     if(mysqli_num_rows($consulta_meta_sell_out) == 0)
     {
      $distribuidor[$d]['meta'] = 0;
      $meta = 0;
     }
     else
     {
      $resultado_consulta_meta_sell_out = mysqli_fetch_array($consulta_meta_sell_out);
      $id_meta_sell_out = $resultado_consulta_meta_sell_out['id'];
      
      $consulta_meta_q_sell_out = mysqli_query($conexion,"select * from meta_q_sell_out where meta_sell_out = '$id_meta_sell_out' and q = '$id_q'");
      $resultado_consulta_meta_q_sell_out = mysqli_fetch_array($consulta_meta_q_sell_out);
       
      $distribuidor[$d]['meta'] = $resultado_consulta_meta_q_sell_out['meta'];
      $meta = $resultado_consulta_meta_q_sell_out['meta'];
	
      $comision = $resultado_consulta_meta_q_sell_out['comision'];	
     }
   
     // Venta Linea
     $consulta_detalle_sell_out = mysqli_query($conexion,"select SUM(float_precio*int_unidades) as venta from detalle_sell_out where id_distribuidor = '$id_distribuidor_metas' and id_anio = '$id_anio' and id_q = '$id_q' and id_linea = '$id_linea' and estado = '1'");
     $resultado_consulta_detalle_sell_out = mysqli_fetch_array($consulta_detalle_sell_out);
     $distribuidor[$d]['venta_actividad'] = $resultado_consulta_detalle_sell_out['venta'];   
     $venta = $resultado_consulta_detalle_sell_out['venta'];
      
     // Porcentaje
     if($meta == 0)
     {
	  if($venta_actividad == 0)
	  {
	   $distribuidor[$d]['porcentaje'] = 0;
	   $porcentaje = 0;
      }
	  else
	  {
	   $distribuidor[$d]['porcentaje'] = 100;
	   $porcentaje = 100;	
	  }
     }
     else   
     {
      $distribuidor[$d]['porcentaje'] = $venta * 100 / $meta;
      $porcentaje = $distribuidor[$d]['porcentaje'];
     }

     // Bonificación
     if($meta != 0)
     {
      if($porcentaje >= 100)
      {
       $distribuidor[$d]['bonificacion'] = $comision * $venta / 100;
      }
      else
      {
       $distribuidor[$d]['bonificacion'] = $comision * $meta / 100;
      }
     }
  
     // Bar Progress
     if($porcentaje >= 100)
     {
 	  $distribuidor[$d]['bar_progress'] = 'progress-bar-success';
     }
     else
     {
      if($porcentaje < 80)
      {
 	   $distribuidor[$d]['bar_progress'] = 'progress-bar-danger';	 
	  }   
	  else
	  {
	   $distribuidor[$d]['bar_progress'] = 'progress-bar-warning';
	  }
     }
	
	}
   }
   
   $d++;
  }
 }
 
 if($perfil == 'distribuidor' || ($perfil == 'canal' && $distri != 0))
 {
  if($op == 'in')
  {
   $i = 1;
   $consulta_linea = mysqli_query($conexion,"select * from linea order by nombre asc");
   while ($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
   {
    $meta = 0;
  
    // Id
    $linea_sell_in[$i]['id'] = $resultado_consulta_linea['id'];
    $id_linea = $resultado_consulta_linea['id'];
   
    // Nombre
    $linea_sell_in[$i]['nombre'] = $resultado_consulta_linea['nombre'];
   
    // Meta
    if($perfil == 'distribuidor')
    {
     $consulta_meta_sell_in = mysqli_query($conexion,"select * from meta_sell_in where distribuidor = '$id_usuario' and anio = '$id_anio' and linea = '$id_linea'");
    }
    if($perfil == 'canal')
    {
     $consulta_meta_sell_in = mysqli_query($conexion,"select * from meta_sell_in where distribuidor = '$distri' and anio = '$id_anio' and linea = '$id_linea'");
    }
    if(mysqli_num_rows($consulta_meta_sell_in) == 0)
    {
     $linea_sell_in[$i]['meta'] = 0;
     $meta = 0;
    }
    else
    {	   
     $resultado_consulta_meta_sell_in = mysqli_fetch_array($consulta_meta_sell_in);
     $id_meta_sell_in = $resultado_consulta_meta_sell_in['id'];
      
     $consulta_meta_q_sell_in = mysqli_query($conexion,"select * from meta_q_sell_in where meta_sell_in = '$id_meta_sell_in' and q = '$id_q'");
     $resultado_consulta_meta_q_sell_in = mysqli_fetch_array($consulta_meta_q_sell_in);
      
     $linea_sell_in[$i]['meta'] = $resultado_consulta_meta_q_sell_in['meta'];
     $meta = $resultado_consulta_meta_q_sell_in['meta'];	
    }
   
    // Compra Linea
    if($perfil == 'distribuidor')
    {
     $consulta_detalle_sell_in = mysqli_query($conexion,"select SUM(float_precio*int_unidades) as compra from detalle_sell_in where id_distribuidor = '$id_usuario' and id_anio = '$id_anio' and id_q = '$id_q' and id_linea = '$id_linea' and estado = '1'");
    }
    if($perfil == 'canal')
    {
     $consulta_detalle_sell_in = mysqli_query($conexion,"select SUM(float_precio*int_unidades) as compra from detalle_sell_in where id_distribuidor = '$distri' and id_anio = '$id_anio' and id_q = '$id_q' and id_linea = '$id_linea' and estado = '1'");
    }
   
    $resultado_consulta_detalle_sell_in = mysqli_fetch_array($consulta_detalle_sell_in);
    $linea_sell_in[$i]['compra'] = $resultado_consulta_detalle_sell_in['compra'];
    $compra = $resultado_consulta_detalle_sell_in['compra'];
      
    // Porcentaje
    if($meta == 0)
    {
 	 $linea_sell_in[$i]['porcentaje'] = 0; 
	 $porcentaje = 0;
    }
    else   
    {
     $linea_sell_in[$i]['porcentaje'] = $compra * 100 / $meta;
     $porcentaje = $linea_sell_in[$i]['porcentaje'];
    }
   
    // Bar Progress
    if($porcentaje >= 100)
    {
 	 $linea_sell_in[$i]['bar_progress'] = 'progress-bar-success';
    }
    else
    {
     if($porcentaje < 80)
     {
	  $linea_sell_in[$i]['bar_progress'] = 'progress-bar-danger';	
	 }   
	 else
	 {
	  $linea_sell_in[$i]['bar_progress'] = 'progress-bar-warning';
	 }
    }
      
    $i++;
   }
  }
  
  if($op == 'out')
  {
   $i = 1;
   $consulta_linea = mysqli_query($conexion,"select * from linea order by nombre asc");
   while ($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
   {
    $meta = 0;
   
    // Id
    $linea_sell_out[$i]['id'] = $resultado_consulta_linea['id'];
    $id_linea = $resultado_consulta_linea['id'];
   
    // Nombre
    $linea_sell_out[$i]['nombre'] = $resultado_consulta_linea['nombre'];
   
    // Meta
    if($perfil == 'distribuidor')
    {
     $consulta_meta_sell_out = mysqli_query($conexion,"select * from meta_sell_out where distribuidor = '$id_usuario' and anio = '$id_anio' and linea = '$id_linea'");
    }
    if($perfil == 'canal')
    {
     $consulta_meta_sell_out = mysqli_query($conexion,"select * from meta_sell_out where distribuidor = '$distri' and anio = '$id_anio' and linea = '$id_linea'");
    }
    if(mysqli_num_rows($consulta_meta_sell_out) == 0)
    {
     $linea_sell_out[$i]['meta'] = 0;
     $meta = 0;
    }
    else
    {	   
     $resultado_consulta_meta_sell_out = mysqli_fetch_array($consulta_meta_sell_out);
     $id_meta_sell_out = $resultado_consulta_meta_sell_out['id'];
      
     $consulta_meta_q_sell_out = mysqli_query($conexion,"select * from meta_q_sell_out where meta_sell_out = '$id_meta_sell_out' and q = '$id_q'");
     $resultado_consulta_meta_q_sell_out = mysqli_fetch_array($consulta_meta_q_sell_out);
       
     $linea_sell_out[$i]['meta'] = $resultado_consulta_meta_q_sell_out['meta'];
     $meta = $resultado_consulta_meta_q_sell_out['meta'];
	
     $comision = $resultado_consulta_meta_q_sell_out['comision'];	
    }
   
    // Venta Linea
    if($perfil == 'distribuidor')
    {
     $consulta_detalle_sell_out = mysqli_query($conexion,"select SUM(float_precio*int_unidades) as venta from detalle_sell_out where id_distribuidor = '$id_usuario' and id_anio = '$id_anio' and id_q = '$id_q' and id_linea = '$id_linea' and estado = '1'");
    }
    if($perfil == 'canal')
    {
     $consulta_detalle_sell_out = mysqli_query($conexion,"select SUM(float_precio*int_unidades) as venta from detalle_sell_out where id_distribuidor = '$distri' and id_anio = '$id_anio' and id_q = '$id_q' and id_linea = '$id_linea' and estado = '1'");
    }
    $resultado_consulta_detalle_sell_out = mysqli_fetch_array($consulta_detalle_sell_out);
    $linea_sell_out[$i]['venta_actividad'] = $resultado_consulta_detalle_sell_out['venta'];   
    $venta = $resultado_consulta_detalle_sell_out['venta'];
      
    // Porcentaje
    if($meta == 0)
    {
	 if($venta_actividad == 0)
	 {
	  $linea_sell_out[$i]['porcentaje'] = 0;
	  $porcentaje = 0;
     }
	 else
	 {
	  $linea_sell_out[$i]['porcentaje'] = 100;
	  $porcentaje = 100;	
	 }
    }
    else   
    {
     $linea_sell_out[$i]['porcentaje'] = $venta * 100 / $meta;
     $porcentaje = $linea_sell_out[$i]['porcentaje'];
    }

    // Bonificación
    if($meta != 0)
    {
     if($porcentaje >= 100)
     {
      $linea_sell_out[$i]['bonificacion'] = $comision * $venta / 100;
     }
     else
     {
      $linea_sell_out[$i]['bonificacion'] = $comision * $meta / 100;
     }
    }
  
    // Bar Progress
    if($porcentaje >= 100)
    {
 	$linea_sell_out[$i]['bar_progress'] = 'progress-bar-success';
    }
    else
    {
     if($porcentaje < 80)
     {
	  $linea_sell_out[$i]['bar_progress'] = 'progress-bar-danger';	
	 }   
	 else
	 {
	  $linea_sell_out[$i]['bar_progress'] = 'progress-bar-warning';
	 }
    }
    
    $i++;
   }
  }
  
 }
 
 if($perfil == 'vendedor')
 {
  $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $id_usuario");
  $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
  $id_distribuidor = $resultado_consulta_usuario[distribuidor];
	 
  $i = 1;
  $consulta_actividad = mysqli_query($conexion,"select * from linea order by nombre asc");
  while ($resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad))
  {
   // Id
   $actividad[$i]['id'] = $resultado_consulta_actividad['id'];
   $id_actividad = $resultado_consulta_actividad['id'];

   // Meta   
   $consulta_meta_sell_out = mysqli_query($conexion,"select * from meta_sell_out where distribuidor = '$id_distribuidor' and anio = '$id_anio' and linea = '$id_actividad'");
   if(mysqli_num_rows($consulta_meta_sell_out) == 0)
   {
    $actividad[$i]['meta'] = 0;
    $meta = 0;
   }
   else
   {
    $resultado_consulta_meta_sell_out = mysqli_fetch_array($consulta_meta_sell_out);
    $id_meta_sell_out = $resultado_consulta_meta_sell_out['id'];
      
    $consulta_meta_q_sell_out = mysqli_query($conexion,"select * from meta_q_sell_out where meta_sell_out = $id_meta_sell_out and q = $id_q");
    $resultado_consulta_meta_q_sell_out = mysqli_fetch_array($consulta_meta_q_sell_out);
      
    $actividad[$i]['meta'] = $resultado_consulta_meta_q_sell_out['meta'];
    $meta = $resultado_consulta_meta_q_sell_out['meta'];
	
    $comision = $resultado_consulta_meta_q_sell_out['comision'];	
   }
   
   // Venta Actividad
   // Distribuidor
   $venta_actividad = 0;
   $consulta_detalle_sell_out = mysqli_query($conexion,"select * from detalle_sell_out where id_distribuidor = '$id_distribuidor' and id_anio = '$id_anio' and id_q = '$id_q' and id_linea = '$id_actividad' and estado = '1'");
   while($resultado_consulta_detalle_sell_out = mysqli_fetch_array($consulta_detalle_sell_out))
   {
    $venta_actividad = $venta_actividad + ($resultado_consulta_detalle_sell_out['int_unidades'] * $resultado_consulta_detalle_sell_out['float_precio']);
   }   
   $actividad[$i]['venta_actividad'] = $venta_actividad;
   // Vendedor
   $venta_actividad_vendedor = 0;
   $consulta_detalle_sell_out = mysqli_query($conexion,"select * from detalle_sell_out where id_distribuidor = '$id_distribuidor' and id_vendedor = '$id_usuario' and id_anio = '$id_anio' and id_q = '$id_q' and id_linea = '$id_actividad' and estado = '1'");
   while($resultado_consulta_detalle_sell_out = mysqli_fetch_array($consulta_detalle_sell_out))
   {
    $venta_actividad_vendedor = $venta_actividad_vendedor + ($resultado_consulta_detalle_sell_out['int_unidades'] * $resultado_consulta_detalle_sell_out['float_precio']);
   }   
   $actividad[$i]['venta_actividad_vendedor'] = $venta_actividad_vendedor;

   // Porcentaje
   if($meta == 0)
   {
	if($venta_actividad == 0)
	{
	 $actividad[$i]['porcentaje'] = 0;
	 $porcentaje = 0;
    }
	else
	{
	 $actividad[$i]['porcentaje'] = 100;
	 $porcentaje = 100;	
	}
   }
   else   
   {
	// Distribuidor
    $actividad[$i]['porcentaje'] = $venta_actividad * 100 / $meta;
    $porcentaje = $actividad[$i]['porcentaje'];
	// Vendedor
	$actividad[$i]['porcentaje_vendedor'] = $venta_actividad_vendedor * 100 / $meta;
    $porcentaje_vendedor = $actividad[$i]['porcentaje_vendedor'];
   }

   // Bonificación
   if($meta != 0)
   {
    $actividad[$i]['bonificacion'] = $comision * $venta_actividad_vendedor / 100;
   }  
  
   // Bar Progress
   if($porcentaje > 100)
   {
	$actividad[$i]['bar_progress'] = 'progress-bar-success';
   }
   else
   {
    if($porcentaje < 80)
    {
	 $actividad[$i]['bar_progress'] = 'progress-bar-danger';	
	}   
	else
	{
	 $actividad[$i]['bar_progress'] = 'progress-bar-warning';
	}
   }
   
   // Nombre
   $actividad[$i]['nombre'] = $resultado_consulta_actividad['nombre'];
   $i++;
  }
 }
 
?>