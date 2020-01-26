<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin' && $_SESSION['perfil']!='admin_schneider')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_meta_sell_in = mysqli_query($conexion,"select * from meta_sell_in order by id desc");
 
 while ($resultado_consulta_meta_sell_in = mysqli_fetch_array($consulta_meta_sell_in))
 {
  // Id
  $metasellin[$i]['id'] = $resultado_consulta_meta_sell_in['id'];

  // Estado
  $metasellin[$i]['estado'] = $resultado_consulta_meta_sell_in['estado'];
  
  // Distribuidor  
  $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = $resultado_consulta_meta_sell_in[distribuidor]");
  $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
  $metasellin[$i]['distribuidor'] = $resultado_consulta_distribuidor['nombre'];
  
  // Año
  $consulta_anio = mysqli_query($conexion,"select * from anio where id = $resultado_consulta_meta_sell_in[anio]");
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  $metasellin[$i]['anio'] = $resultado_consulta_anio['nombre'];
  
  // Linea
  $consulta_linea = mysqli_query($conexion,"select * from linea where id = $resultado_consulta_meta_sell_in[linea]");
  $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
  $metasellin[$i]['linea'] = $resultado_consulta_linea['nombre'];
  
  // Q
  $consulta_meta_q_sell_in = mysqli_query($conexion,"select * from meta_q_sell_in where meta_sell_in = $resultado_consulta_meta_sell_in[id]");
  while ($resultado_consulta_meta_q_sell_in = mysqli_fetch_array($consulta_meta_q_sell_in))
  {
   $consulta_q = mysqli_query($conexion,"select * from q where id = $resultado_consulta_meta_q_sell_in[q]");
   $resultado_consulta_q = mysqli_fetch_array($consulta_q);
   $q = $resultado_consulta_q['nombre'];
   if($q == 'Q1')
   {
    $metasellin[$i]['q1'] = $resultado_consulta_meta_q_sell_in['meta'];
   }
   if($q == 'Q2')
   {
    $metasellin[$i]['q2'] = $resultado_consulta_meta_q_sell_in['meta'];
   }
   if($q == 'Q3')
   {
    $metasellin[$i]['q3'] = $resultado_consulta_meta_q_sell_in['meta'];
   }
   if($q == 'Q4')
   {
    $metasellin[$i]['q4'] = $resultado_consulta_meta_q_sell_in['meta'];
   }
  } 
    
  $i++;
 }

?>