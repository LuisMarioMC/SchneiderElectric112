<?php
 
 ini_set('max_execution_time', 300);
 set_time_limit(20);
 
 require_once('conexion_sesion.php');

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
 detalle_sell_out.id_zona = zona.id

 ORDER BY detalle_sell_out.id ASC LIMIT 1,40000";
 
 $consulta_backup = mysqli_query($conexion, $consulta);
 while ($resultado_consulta_backup = mysqli_fetch_array($consulta_backup))
 {
  //$variable = $variable.'"'.$resultado_consulta_backup[Id].'","'.$resultado_consulta_backup[Distribuidor].'","'.$resultado_consulta_backup[Pais_Distribuidor].'","'.$resultado_consulta_backup[Anio].'","'.$resultado_consulta_backup[Mes].'","'.$resultado_consulta_backup[Q].'","'.$resultado_consulta_backup[Factura].'","'.$resultado_consulta_backup[Fecha_Venta].'","'.$resultado_consulta_backup[Producto].'","'.$resultado_consulta_backup[Unidades].'","'.$resultado_consulta_backup[Precio].'","'.$resultado_consulta_backup[Taxid_Cliente].'","'.$resultado_consulta_backup[Nombre_Cliente].'","'.$resultado_consulta_backup[Telefono_Cliente].'","'.$resultado_consulta_backup[Email_Cliente].'","'$resultado_consulta_backup[Segmento].'","'$resultado_consulta_backup[Zona].'","'$resultado_consulta_backup[Departamento].'","'$resultado_consulta_backup[Ciudad].'","'$resultado_consulta_backup[Vendedor].'","'$resultado_consulta_backup[E_Commerce].'"';
  $variable = $variable.'"'.$resultado_consulta_backup[Id].'","'.$resultado_consulta_backup[Distribuidor].'","'.$resultado_consulta_backup[Pais_Distribuidor].'","'.$resultado_consulta_backup[Anio].'","'.$resultado_consulta_backup[Mes].'","'.$resultado_consulta_backup[Q].'","'.$resultado_consulta_backup[Factura].'","'.$resultado_consulta_backup[Fecha_Venta].'","'.$resultado_consulta_backup[Producto].'","'.$resultado_consulta_backup[Unidades].'","'.$resultado_consulta_backup[Precio].'","'.$resultado_consulta_backup[Taxid_Cliente].'","'.$resultado_consulta_backup[Nombre_Cliente].'","'.$resultado_consulta_backup[Telefono_Cliente].'","'.$resultado_consulta_backup[Email_Cliente].'","'.$resultado_consulta_backup[Segmento].'","'.$resultado_consulta_backup[Zona].'","'.$resultado_consulta_backup[Departamento].'","'.$resultado_consulta_backup[Ciudad].'","'.$resultado_consulta_backup[Vendedor].'","'.$resultado_consulta_backup[E_Commerce].'";';

 }
 
 header("Content-Description: File Transfer");
 header("Content-Type: application/force-download");
 header('Content-Disposition: attachment; filename="backup.csv"');
 
 echo $variable;
 
?> 