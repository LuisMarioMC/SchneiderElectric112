<?php
  
 if($_SESSION['perfil'] != 'admin' && $_SESSION['perfil']!='admin_schneider')
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
 $consulta_linea = mysqli_query($conexion,"select * from linea where estado = 1 order by nombre ASC ");
 while($resultado_consulta_linea = mysqli_fetch_array($consulta_linea))
 {
  $lineas[$cantidad_linea]['id'] = $resultado_consulta_linea['id'];
  $lineas[$cantidad_linea]['nombre'] = $resultado_consulta_linea['nombre'];
  $cantidad_linea++; 
 }
 
 if($error == 0)
 {
  $consulta_meta_sell_in = mysqli_query($conexion,"select * from meta_sell_in where distribuidor='$id_distribuidor' and anio='$id_anio' and linea='$id_linea'");
  if(mysqli_num_rows($consulta_meta_sell_in) == 1)
  {
   $error_distribuidor = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>La Meta ya existe.</div>';
   $error = 1;
  }
 }
 
 if($error == 0)
 {
  $crear = mysqli_query($conexion,"insert into meta_sell_in (distribuidor,anio,linea) values ('$id_distribuidor','$id_anio','$id_linea')");
 
  $id_crear = mysqli_insert_id($conexion);

  $consulta_q = mysqli_query($conexion,"select * from q where anio = $id_anio");
  while ($resultado_consulta_q = mysqli_fetch_array($consulta_q))
  {
   if($resultado_consulta_q['nombre'] == 'Q1')
   {
    $id_q = $resultado_consulta_q['id'];
	$crear = mysqli_query($conexion,"insert into meta_q_sell_in (meta_sell_in,q,meta) values ('$id_crear','$id_q','$q1')");
   }
   if($resultado_consulta_q['nombre'] == 'Q2')
   {
    $id_q = $resultado_consulta_q['id'];
	$crear = mysqli_query($conexion,"insert into meta_q_sell_in (meta_sell_in,q,meta) values ('$id_crear','$id_q','$q2')");
   }
   if($resultado_consulta_q['nombre'] == 'Q3')
   {
    $id_q = $resultado_consulta_q['id'];
	$crear = mysqli_query($conexion,"insert into meta_q_sell_in (meta_sell_in,q,meta) values ('$id_crear','$id_q','$q3')");
   }
   if($resultado_consulta_q['nombre'] == 'Q4')
   {
    $id_q = $resultado_consulta_q['id'];
	$crear = mysqli_query($conexion,"insert into meta_q_sell_in (meta_sell_in,q,meta) values ('$id_crear','$id_q','$q4')");
   }
  }
    
 }
 
?>