<?php
 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin' && $_SESSION['perfil'] != 'admin_schneider' && $_SESSION['perfil'] != 'super_schneider')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $fecha = date("Y-m-d H:i:s");
 $fecha = 'VENTAS '.$fecha;
 
 $nombre_archivo = "reportes/".$fecha.".csv";
 //$nombre_archivo = "reportes/prueba.csv";

  
 if($archivo = fopen($nombre_archivo, "a"))
 {
  $variable = "";

  $consulta = "
   SELECT
   detalle_sell_out.id as Id,
   usuario.nombre as Distribuidor,
   pais.nombre as Pais_Distribuidor,
   anio.nombre as Anio, 
   mes.nombre as Mes, 
   q.nombre as Q,
   detalle_sell_out.factura as Factura,
   detalle_sell_out.fecha_venta as Fecha_Venta,
   detalle_sell_out.producto as Producto,
   detalle_sell_out.unidades as Unidades,
   detalle_sell_out.precio as Precio,
   detalle_sell_out.taxid_cliente as Taxid_Cliente,
   detalle_sell_out.nombre_cliente as Nombre_Cliente,
   detalle_sell_out.telefono_cliente as Telefono_Cliente,
   detalle_sell_out.email_cliente as Email_Cliente,
   detalle_sell_out.segmento as Segmento,
   detalle_sell_out.direccion as Direccion,
   zona.nombre as Zona,
   departamento.nombre as Departamento,
   detalle_sell_out.ciudad as Ciudad,
   detalle_sell_out.vendedor as Vendedor,
   detalle_sell_out.e_commerce as E_Commerce

   FROM detalle_sell_out, pais, usuario, anio, mes, q, departamento, zona

   WHERE detalle_sell_out.estado = '1' AND
   detalle_sell_out.id_pais_distribuidor = pais.id AND
   detalle_sell_out.id_distribuidor = usuario.id AND
   detalle_sell_out.id_anio = anio.id AND
   detalle_sell_out.id_mes = mes.id AND
   detalle_sell_out.id_q = q.id AND
   detalle_sell_out.id_departamento = departamento.id AND
   detalle_sell_out.id_zona = zona.id AND
   detalle_sell_out.id > 2368741

   ORDER BY detalle_sell_out.id ASC";

  $consulta_backup = mysqli_query($conexion, $consulta);
  while ($resultado_consulta_backup = mysqli_fetch_array($consulta_backup))
  {
   $variable = '"'.$resultado_consulta_backup[Id].'","'.$resultado_consulta_backup[Distribuidor].'","'.$resultado_consulta_backup[Pais_Distribuidor].'","'.$resultado_consulta_backup[Anio].'","'.$resultado_consulta_backup[Mes].'","'.$resultado_consulta_backup[Q].'","'.$resultado_consulta_backup[Factura].'","'.$resultado_consulta_backup[Fecha_Venta].'","'.$resultado_consulta_backup[Producto].'","'.$resultado_consulta_backup[Unidades].'","'.$resultado_consulta_backup[Precio].'","'.$resultado_consulta_backup[Taxid_Cliente].'","'.$resultado_consulta_backup[Nombre_Cliente].'","'.$resultado_consulta_backup[Telefono_Cliente].'","'.$resultado_consulta_backup[Email_Cliente].'","'.$resultado_consulta_backup[Segmento].'","'.$resultado_consulta_backup[Zona].'","'.$resultado_consulta_backup[Departamento].'","'.$resultado_consulta_backup[Ciudad].'","'.$resultado_consulta_backup[Vendedor].'","'.$resultado_consulta_backup[E_Commerce].'","'.$resultado_consulta_backup[Direccion].'"';
   
   fwrite($archivo,$variable."\n");  
  }
  
  if(file_exists($nombre_archivo)) 
  {
   $crear = mysqli_query($conexion,"insert into descargar_reporte (nombre,tipo) values ('$fecha','1')");
   
   $mensaje = 21;
  }
  else
  {
   $mensaje = 22;
  }
  fclose($archivo);
 }
 else
 {
  $mensaje = 22;	 
 }


 echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_descargar_reporte.php?m='.$mensaje.'"</script>';

?>