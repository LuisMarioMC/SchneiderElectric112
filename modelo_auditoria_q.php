<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 // id a Activar o Inactivar
 $id_q = !empty($_GET['id'])? $_GET['id']:0;
 
 $i = 1;

 $consulta_q = mysqli_query($conexion,"select * from q where id = $id_q");
 if(@mysqli_num_rows($consulta_q)==1)
 { 
  $resultado_consulta_q = mysqli_fetch_array($consulta_q);
  $nombre_q = $resultado_consulta_q['nombre'];
  $anio = $resultado_consulta_q['anio'];
  
  $consulta_anio = mysqli_query($conexion,"select * from anio where id = $anio");
  $resultado_consulta_anio = mysqli_fetch_array($consulta_anio);
  $nombre_q = $nombre_q.' ('.$resultado_consulta_anio['nombre'].')';

  $consulta_auditoria_q = mysqli_query($conexion,"select * from auditoria_q where q = $id_q order by id asc");
 
  while ($resultado_consulta_auditoria_q = mysqli_fetch_array($consulta_auditoria_q))
  {
   // No
   $q_auditoria[$i]['no'] = $i;  

   // Acción
   $q_auditoria[$i]['accion'] = $resultado_consulta_auditoria_q['accion'];
  
   // Usuario
   $consulta_usuario = mysqli_query($conexion,"select * from usuario where id = $resultado_consulta_auditoria_q[usuario]");
   $resultado_consulta_usuario = mysqli_fetch_array($consulta_usuario);
   $q_auditoria[$i]['usuario'] = $resultado_consulta_usuario['nombre'];
  
   // Perfil
   $q_auditoria[$i]['perfil'] = $resultado_consulta_auditoria_q['perfil'];
  
   if($q_auditoria[$i]['perfil'] == 'linea')
   {
    $consulta_linea = mysqli_query($conexion,"select * from linea where id = $resultado_consulta_usuario[linea]");
    $resultado_consulta_linea = mysqli_fetch_array($consulta_linea);
    $q_auditoria[$i]['usuario'] = $resultado_consulta_usuario['nombre'].' ('.$resultado_consulta_linea['nombre'].')';
   }
  
   // Fecha
   $q_auditoria[$i]['fecha'] = $resultado_consulta_auditoria_q['fecha'];
  
   // Hora
   $q_auditoria[$i]['hora'] = $resultado_consulta_auditoria_q['hora'];
  
   $i++;
  }
 }
 else
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }

?>