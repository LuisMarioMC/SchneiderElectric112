<?php
 
 $id_modificar = !empty($_GET['id'])? $_GET['id']:0;
 $id_modificar = mysqli_real_escape_string($conexion,$id_modificar);
 
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666; 
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $cantidad_distribuidor = 1;
 $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where perfil = 'Distribuidor' and estado = 1 order by nombre ASC ");
 while($resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor))
 {
  $distribuidores[$cantidad_distribuidor]['id'] = $resultado_consulta_distribuidor['id'];
  $distribuidores[$cantidad_distribuidor]['nombre'] = $resultado_consulta_distribuidor['nombre'];
  $cantidad_distribuidor++; 
 }
 
 $cantidad_anio = 1;
 $consulta_anio = mysqli_query($conexion,"select * from anio where estado = 1 order by nombre ASC ");
 while($resultado_consulta_anio = mysqli_fetch_array($consulta_anio))
 {
  $anios[$cantidad_anio]['id'] = $resultado_consulta_anio['id'];
  $anios[$cantidad_anio]['nombre'] = $resultado_consulta_anio['nombre'];
  $cantidad_anio++; 
 }
 
 $cantidad_linea = 1;
 //$consulta_linea = mysqli_query($conexion,"select * from linea where estado = 1 and sell_out = 1 order by nombre ASC ");
 $consulta_linea = mysqli_query($conexion,"select * from linea where estado = 1 order by nombre ASC ");
 while($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
 {
  $lineas[$cantidad_linea]['id'] = $resultado_consulta_linea['id'];
  $lineas[$cantidad_linea]['nombre'] = $resultado_consulta_linea['nombre'];
  $cantidad_linea++; 
 }
 
 $consulta_meta_sell_out = @mysqli_query($conexion,"select * from meta_sell_out where id='$id_modificar'");
 $resultado_consulta_meta_sell_out = mysqli_fetch_array($consulta_meta_sell_out);
 if($id_distribuidor == '')
 {
  $id_distribuidor = $resultado_consulta_meta_sell_out['distribuidor'];
  $id_anio = $resultado_consulta_meta_sell_out['anio']; 
  $id_linea = $resultado_consulta_meta_sell_out['linea']; 

  $consulta_meta_q_sell_out = @mysqli_query($conexion,"select * from meta_q_sell_out where meta_sell_out='$id_modificar'");
  while($resultado_consulta_meta_q_sell_out = mysqli_fetch_array($consulta_meta_q_sell_out))
  {
   $consulta_q = @mysqli_query($conexion,"select * from q where id=$resultado_consulta_meta_q_sell_out[q]");
   $resultado_consulta_q = mysqli_fetch_array($consulta_q);
   $nombre_q = $resultado_consulta_q[nombre];
   if($nombre_q=='Q1')
   {
    $q1 = $resultado_consulta_meta_q_sell_out['meta'];
    $cq1 = $resultado_consulta_meta_q_sell_out['comision'];	
   }
   if($nombre_q=='Q2')
   {
    $q2 = $resultado_consulta_meta_q_sell_out['meta'];
    $cq2 = $resultado_consulta_meta_q_sell_out['comision'];	
   }
   if($nombre_q=='Q3')
   {
    $q3 = $resultado_consulta_meta_q_sell_out['meta'];
    $cq3 = $resultado_consulta_meta_q_sell_out['comision'];	
   }
   if($nombre_q=='Q4')
   {
    $q4 = $resultado_consulta_meta_q_sell_out['meta'];
    $cq4 = $resultado_consulta_meta_q_sell_out['comision'];	
   }
  }
 }
 else
 {
  $id_distribuidor2 = $resultado_consulta_meta_sell_out['distribuidor'];
  $id_anio2 = $resultado_consulta_meta_sell_out['anio']; 
  $id_linea2 = $resultado_consulta_meta_sell_out['linea']; 

  $consulta_meta_q_sell_out = @mysqli_query($conexion,"select * from meta_q_sell_out where meta_sell_out='$id_modificar'");
  while($resultado_consulta_meta_q_sell_out = mysqli_fetch_array($consulta_meta_q_sell_out))
  {
   $consulta_q = @mysqli_query($conexion,"select * from q where id='$resultado_consulta_meta_q_sell_out[q]'");
   $resultado_consulta_q = mysqli_fetch_array($consulta_q);
   $nombre_q = $resultado_consulta_q[nombre];
   if($nombre_q=='Q1')
   {
    $q12 = $resultado_consulta_meta_q_sell_out['meta'];
    $cq12 = $resultado_consulta_meta_q_sell_out['comision'];	
   }
   if($nombre_q=='Q2')
   {
    $q22 = $resultado_consulta_meta_q_sell_out['meta'];
    $cq22 = $resultado_consulta_meta_q_sell_out['comision'];	
   }
   if($nombre_q=='Q3')
   {
    $q32 = $resultado_consulta_meta_q_sell_out['meta'];
    $cq32 = $resultado_consulta_meta_q_sell_out['comision'];	
   }
   if($nombre_q=='Q4')
   {
    $q42 = $resultado_consulta_meta_q_sell_out['meta'];
    $cq42 = $resultado_consulta_meta_q_sell_out['comision'];	
   }
  }
 }
  
 if($error == 0)
 {
  $consulta_meta_sell_out = @mysqli_query($conexion,"select * from meta_sell_out where distribuidor='$id_distribuidor' and anio='$id_anio' and linea='$id_linea'");
  $resultado_consulta_meta_sell_out = mysqli_fetch_array($consulta_meta_sell_out);
  $id = $resultado_consulta_meta_sell_out['id'];
 
  if($id != $id_modificar && mysqli_num_rows($consulta_meta_sell_out) == 1)
  {
   $error_distribuidor = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La Meta ya existe.</div>';
   $error = 1;
  }
 }
  
 if($error == 0)
 {
  $modificar = @mysqli_query($conexion,"update meta_sell_out set distribuidor = '$id_distribuidor', anio = '$id_anio', linea = '$id_linea' where id = '$id_modificar'");
 
  $consulta_meta_q_sell_out = @mysqli_query($conexion,"select * from meta_q_sell_out where meta_sell_out='$id_modificar'");
  while($resultado_consulta_meta_q_sell_out = mysqli_fetch_array($consulta_meta_q_sell_out))
  {
   $consulta_q = @mysqli_query($conexion,"select * from q where id='$resultado_consulta_meta_q_sell_out[q]'");
   $resultado_consulta_q = mysqli_fetch_array($consulta_q);
   $nombre_q = $resultado_consulta_q[nombre];
   if($nombre_q=='Q1')
   {
    $modificar = @mysqli_query($conexion,"update meta_q_sell_out set meta = '$q1', comision = '$cq1' where id = '$resultado_consulta_meta_q_sell_out[id]'");
   }
   if($nombre_q=='Q2')
   {
    $modificar = @mysqli_query($conexion,"update meta_q_sell_out set meta = '$q2', comision = '$cq2' where id = '$resultado_consulta_meta_q_sell_out[id]'");
   }
   if($nombre_q=='Q3')
   {
    $modificar = @mysqli_query($conexion,"update meta_q_sell_out set meta = '$q3', comision = '$cq3' where id = '$resultado_consulta_meta_q_sell_out[id]'");
   }
   if($nombre_q=='Q4')
   {
    $modificar = @mysqli_query($conexion,"update meta_q_sell_out set meta = '$q4', comision = '$cq4' where id = '$resultado_consulta_meta_q_sell_out[id]'");
   }
  }
   
 }
 
?>