<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin' && $_SESSION['perfil']!='admin_schneider')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_meta_sell_out = mysqli_query($conexion,"select * from meta_sell_out order by id desc");
 
 while ($resultado_consulta_meta_sell_out = mysqli_fetch_array($consulta_meta_sell_out))
 {
  // Id
  $metasellout[$i]['id'] = $resultado_consulta_meta_sell_out['id'];

  // Estado
  $metasellout[$i]['estado'] = $resultado_consulta_meta_sell_out['estado'];
  
  // Distribuidor  
  $consulta_distribuidor = mysqli_query($conexion,"select * from usuario where id = $resultado_consulta_meta_sell_out[distribuidor]");
  $resultado_consulta_distribuidor = mysqli_fetch_array($consulta_distribuidor);
  $metasellout[$i]['distribuidor'] = $resultado_consulta_distribuidor['nombre'];
  
  // Año
  $consulta_anio = mysqli_query($conexion,"select * from anio where id = $resultado_consulta_meta_sell_out[anio]");
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  $metasellout[$i]['anio'] = $resultado_consulta_anio['nombre'];
  
  // Linea
  $consulta_linea = mysqli_query($conexion,"select * from linea where id = $resultado_consulta_meta_sell_out[linea]");
  $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
  $metasellout[$i]['linea'] = $resultado_consulta_linea['nombre'];
  
  // Q
  $consulta_meta_q_sell_out = mysqli_query($conexion,"select * from meta_q_sell_out where meta_sell_out = $resultado_consulta_meta_sell_out[id]");
  while ($resultado_consulta_meta_q_sell_out = mysqli_fetch_array($consulta_meta_q_sell_out))
  {
   $consulta_q = mysqli_query($conexion,"select * from q where id = $resultado_consulta_meta_q_sell_out[q]");
   $resultado_consulta_q = mysqli_fetch_array($consulta_q);
   $q = $resultado_consulta_q['nombre'];
   if($q == 'Q1')
   {
    $metasellout[$i]['q1'] = $resultado_consulta_meta_q_sell_out['meta'];
    $metasellout[$i]['cq1'] = $resultado_consulta_meta_q_sell_out['comision'];
   }
   if($q == 'Q2')
   {
    $metasellout[$i]['q2'] = $resultado_consulta_meta_q_sell_out['meta'];
    $metasellout[$i]['cq2'] = $resultado_consulta_meta_q_sell_out['comision'];
   }
   if($q == 'Q3')
   {
    $metasellout[$i]['q3'] = $resultado_consulta_meta_q_sell_out['meta'];
    $metasellout[$i]['cq3'] = $resultado_consulta_meta_q_sell_out['comision'];
   }
   if($q == 'Q4')
   {
    $metasellout[$i]['q4'] = $resultado_consulta_meta_q_sell_out['meta'];
    $metasellout[$i]['cq4'] = $resultado_consulta_meta_q_sell_out['comision'];
   }
  } 
    
  $i++;
 }

?>