<?php
   
 require_once ('conexion_sesion.php'); 
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $id_detalle_sell_out = !empty($_GET['id'])? $_GET['id']:0;
 $id_detalle_sell_out = mysqli_real_escape_string($conexion,$id_detalle_sell_out);

 $id_reporte_ventas = !empty($_GET['id_reporte_ventas'])? $_GET['id_reporte_ventas']:0;
 $id_reporte_ventas = mysqli_real_escape_string($conexion,$id_reporte_ventas);
 
 $consulta_detalle_sell_out = mysqli_query($conexion,"select * from detalle_sell_out where id = $id_detalle_sell_out");
 $resultado_consulta_detalle_sell_out = mysqli_fetch_array($consulta_detalle_sell_out);
 $taxid_cliente = $resultado_consulta_detalle_sell_out[taxid_cliente];

 if($_POST['actualizar'])
 {
  $nombre_cliente = $resultado_consulta_detalle_sell_out[nombre_cliente];
  $telefono_cliente = $resultado_consulta_detalle_sell_out[telefono_cliente];
  $email_cliente = $resultado_consulta_detalle_sell_out[email_cliente];
  $id_segmento = $resultado_consulta_detalle_sell_out[id_segmento];
  
  $consulta_cliente = mysqli_query($conexion,"select * from cliente where taxid_cliente = '$taxid_cliente'");
  $resultado_consulta_cliente = mysqli_fetch_array($consulta_cliente);
  $id_cliente = $resultado_consulta_cliente[id];

  $modificar = mysqli_query($conexion,"update detalle_sell_out set id_cliente = '0' where id_cliente = '$id_cliente' and reporte_ventas = '$id_reporte_ventas'");
  
  $modificar = mysqli_query($conexion,"update cliente set nombre_cliente = '$nombre_cliente', telefono_cliente = '$telefono_cliente', email_cliente = '$email_cliente', id_segmento = '$id_segmento' where id = '$id_cliente'");
  $mensaje = 99;
 }
 
 if($_POST['ajustar'])
 {
  $consulta_cliente = mysqli_query($conexion,"select * from cliente where taxid_cliente = '$taxid_cliente'");
  $resultado_consulta_cliente = mysqli_fetch_array($consulta_cliente);
  $nombre_cliente = $resultado_consulta_cliente[nombre_cliente];
  $telefono_cliente = $resultado_consulta_cliente[telefono_cliente];
  $email_cliente = $resultado_consulta_cliente[email_cliente];
  $id_segmento = $resultado_consulta_cliente[id_segmento];

  $consulta_segmento = mysqli_query($conexion,"select * from segmento where id = '$id_segmento'");
  $resultado_consulta_segmento = mysqli_fetch_array($consulta_segmento);
  $segmento = $resultado_consulta_segmento[nombre];
  
  $modificar = mysqli_query($conexion,"update detalle_sell_out set nombre_cliente = '$nombre_cliente', telefono_cliente = '$telefono_cliente', email_cliente = '$email_cliente', segmento = '$segmento', id_segmento = '$id_segmento' where id = '$id_detalle_sell_out'");
  $mensaje = 98;
 }

 echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_detalle_sell_out.php?id='.$id_reporte_ventas.'&m='.$mensaje.'"</script>';
 
?>