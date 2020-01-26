<?php

 require_once ('modelo_listar_detalle_sell_out.php');
 
 $listar = '';
 
 if($i != 1)
 {
     
  foreach($detalle as $detalles)
  {
   $listar .= ' <tr>';
   
   $listar .= '  <td width="35px">';

   if($detalles['error']==0)
   {
    //$listar .= '  <a href="controlador_estado_detalle_sell_out.php?id='.$detalles['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Sin Errores">';
    $listar .= '   <font size="1" color="#FFFFFF">1</font>';
    //$listar .= '  </a>';
   }
   else
   {
    //$listar .= '  <a href="controlador_estado_detalle_sell_out.php?id='.$detalles['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Con Errores">';
    $listar .= '   <font size="1" color="#FFFFFF">0</font>';
    //$listar .= '  </a>';
   }
  
   $listar .= '  </td>';

   // Factura
   if($detalles['error_factura'] == 0)
   {
    $listar .= '  <td>'.$detalles['factura'].'</td>';
   }
   elseif($detalles['error_factura'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Factura"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }

   // Fecha Venta
   if($detalles['error_fecha'] == 0)
   {
    $listar .= '  <td>'.$detalles['fecha_venta'].'</td>';
   }
   elseif($detalles['error_fecha'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Fecha Venta"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_fecha'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Formato Fecha Incorrecto"><font color="red">'.$detalles['fecha_venta'].'</font></div></td>';
   }
   elseif($detalles['error_fecha'] == 3)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Fecha fuera del periodo"><font color="red">'.$detalles['fecha_venta'].'</font></div></td>';
   }
   elseif($detalles['error_fecha'] == 4)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Fecha no concuerda con Factura"><font color="red">'.$detalles['fecha_venta'].'</font></div></td>';
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
   
   // Tax ID
   if($detalles['error_taxid'] == 0)
   {
    $listar .= '  <td>'.$detalles['taxid_cliente'].'</td>';
   }
   elseif($detalles['error_taxid'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Tax ID Cliente"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_taxid'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Tax ID no concuerda con Factura"><font color="red">'.$detalles['taxid_cliente'].'</font></div></td>';
   }
   elseif($detalles['error_taxid'] == 3)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="La informaci&oacute;n no corresponde"><font color="red">'.$detalles['taxid_cliente'].'</font></div><div data-toggle="modal" data-target="#ModalT'.$detalles[id].'"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }  

   // Nombre
   if($detalles['error_nombre'] == 0)
   {
    $listar .= '  <td>'.$detalles['nombre_cliente'].'</td>';
   }
   elseif($detalles['error_nombre'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Nombre Cliente"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   
   // Telefono
   if($detalles['error_telefono'] == 0)
   {
    $listar .= '  <td>'.$detalles['telefono_cliente'].'</td>';
   }
   elseif($detalles['error_telefono'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Telefono Cliente"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   
   // Email
   if($detalles['error_email'] == 0)
   {
    $listar .= '  <td>'.$detalles['email_cliente'].'</td>';
   }
   elseif($detalles['error_email'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Email Cliente"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   
   // Segmento
   if($detalles['error_segmento'] == 0)
   {
    $listar .= '  <td>'.$detalles['segmento'].'</td>';
   }
   elseif($detalles['error_segmento'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Segmento Cliente"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_segmento'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="No Existe el Segmento"><font color="red">'.$detalles['segmento'].'</font></div></td>';
   }

   // Ciudad
   if($detalles['error_ciudad'] == 0)
   {
    $listar .= '  <td>'.$detalles['ciudad'].'</td>';
   }
   elseif($detalles['error_ciudad'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Ciudad Venta"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_ciudad'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="No Existe la Ciudad"><font color="red">'.$detalles['ciudad'].'</font></div></td>';
   }
   
   // Vendedor   
   if($detalles['error_vendedor'] == 0)
   {
    $listar .= '  <td>'.$detalles['vendedor'].'</td>';
   }
   elseif($detalles['error_vendedor'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Vendedor"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_vendedor'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="No Existe el Vendedor"><font color="red">'.$detalles['vendedor'].'</font></div></td>';
   }
   elseif($detalles['error_vendedor'] == 3)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="El Vendedor no corresponde al Distribuidor"><font color="red">'.$detalles['vendedor'].'</font></div></td>';
   }
   
   // E-commerce
   if($detalles['error_e_commerce'] == 0)
   {
    $listar .= '  <td>'.$detalles['e_commerce'].'</td>';
   }
   elseif($detalles['error_e_commerce'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="El Texto debe ser NO o SI-PAGINA-PROPIA o SI-OTROS "><font color="red"><i class="fa fa-question-circle fa-lg" style="color:red"></i></font></div></td>';
   }
   //DIRECCION
   $listar .= '  <td>'.$detalles['direccion'].'</td>';
   // Tipo de cliente
   if ($detalles['error_tipo_cliente'] !== '') {
    $listar .= '  <td>'.$detalles['tipo_cliente'].'</td>';
   } else {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="El tipo de cliente no puede estar vacío "><font color="red"><i class="fa fa-question-circle fa-lg" style="color:red"></i></font></div></td>';
   } 
   $listar .= '  <td align="right" width="70px">';
    
   if($estado_reporte_ventas == 0)
   {
    $listar .= '   <a href="modificar_detalle_sell_out.php?id='.$detalles['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
    $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarDetalleSellOut('.$detalles['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';
   }
   
   $listar .= '  </td>';  
   
   $listar .= ' </tr>';
  }
 }


 $mensaje = 0;
 require_once ('mensajes_detalle_sell_out.php'); 

?>