<?php

 require_once ('modelo_listar_detalle_sell_in.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($detalle as $detalles)
  {
   $listar .= ' <tr>';
   
   $listar .= '  <td width="35px">';

   if($detalles['error']==0)
   {
    $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Sin Errores">';
    $listar .= '   <font size="1" color="#FFFFFF">1</font>';
   }
   else
   {
    $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Con Errores">';
    $listar .= '   <font size="1" color="#FFFFFF">0</font>';
   }
  
   $listar .= '  </td>';
   
   // Nombre Distribuidor
   if($detalles['error_nombre_distribuidor'] == 0)
   {
    $listar .= '  <td>'.$detalles['nombre_distribuidor'].'</td>';
   }
   elseif($detalles['error_nombre_distribuidor'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Nombre Distribuidor"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_nombre_distribuidor'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="No Existe el Distribuidor"><font color="red">'.$detalles['nombre_distribuidor'].'</font></div></td>';
   }

   // Producto
   if($detalles['error_producto'] == 0)
   {
    $listar .= '  <td>'.$detalles['producto'].'</td>';
   }   
   elseif($detalles['error_producto'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Producto"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_producto'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="No Existe el Producto"><font color="red">'.$detalles['producto'].'</font></div></td>';
   }
 
   // Unidades
   if($detalles['error_unidades'] == 0)
   {
    $listar .= '  <td>'.$detalles['unidades'].'</td>';
   }
   elseif($detalles['error_unidades'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Unidades"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_unidades'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Dato No Numerico"><font color="red">'.$detalles['unidades'].'</font></div></td>';
   }
   elseif($detalles['error_unidades'] == 3)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Dato No Entero"><font color="red">'.$detalles['unidades'].'</font></div></td>';
   }
   
   // Precio
   if($detalles['error_precio'] == 0)
   {
    $listar .= '  <td>'.$detalles['precio'].'</td>';
   }
   elseif($detalles['error_precio'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Precio"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_precio'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Dato No Numerico"><font color="red">'.$detalles['precio'].'</font></div></td>';
   }
   elseif($detalles['error_precio'] == 3)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Dato negativo"><font color="red">'.$detalles['precio'].'</font></div></td>';
   }   

   // Fecha Compra
   if($detalles['error_fecha'] == 0)
   {
    $listar .= '  <td>'.$detalles['fecha_compra'].'</td>';
   }
   elseif($detalles['error_fecha'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Fecha Venta"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_fecha'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Formato Fecha Incorrecto"><font color="red">'.$detalles['fecha_compra'].'</font></div></td>';
   }
   elseif($detalles['error_fecha'] == 3)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Fecha fuera del periodo"><font color="red">'.$detalles['fecha_compra'].'</font></div></td>';
   }
   elseif($detalles['error_fecha'] == 4)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Fecha no concuerda con Factura"><font color="red">'.$detalles['fecha_compra'].'</font></div></td>';
   }
   
   // Factura
   if($detalles['error_factura'] == 0)
   {
    $listar .= '  <td>'.$detalles['factura'].'</td>';
   }
   elseif($detalles['error_factura'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Factura"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   	
   $listar .= '  <td align="right" width="70px">';
    
   $listar .= '   <a href="modificar_detalle_sell_in.php?id='.$detalles['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
   $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarDetalleSellIn('.$detalles['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';
   
   $listar .= '  </td>';  
   
   $listar .= ' </tr>';
  }
 }
  
 $mensaje = 0;
 require_once ('mensajes_detalle_sell_in.php');

?>