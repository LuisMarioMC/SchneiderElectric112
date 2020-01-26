<?php 
 require_once ('modelo_listar_vendedor.php');
 
 $listar = '';
 
 if($cantidad_vendedores > 0)
 {
  foreach($vendedor as $vendedores)
  {
   $listar .= ' <tr>';
  
   $listar .= '  <td width="35px">';

   if($vendedores['estado']==0)
   {
    $listar .= '  <a href="controlador_estado_vendedor.php?id='.$vendedores['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Activa">';
    $listar .= '   <font size="1" color="#FFFFFF">0</font>';
    $listar .= '  </a>';
   }
   if($vendedores['estado']==1)
   {
    $listar .= '  <a href="controlador_estado_vendedor.php?id='.$vendedores['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Activa">';
    $listar .= '   <font size="1" color="#FFFFFF">1</font>';
    $listar .= '  </a>';
   }
  
   $listar .= '  </td>';
   $listar .= '  <td>'.$vendedores['id'].'</td>';
   $listar .= '  <td>'.$vendedores['nombre'].'</td>';
   $listar .= '  <td>'.$vendedores['correo_electronico'].'</td>';
   $listar .= '  <td>'.$vendedores['celular'].'</td>';
	
   $listar .= '  <td align="right" width="70px">';
   $listar .= '   <a href="modificar_vendedor.php?id='.$vendedores['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
   $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarVendedor('.$vendedores['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';
   $listar .= '  </td>';  
   $listar .= ' </tr>';
  }
 }
 
 $menu_listar = '';
 $menu_listar .= '<th></th>';
 $menu_listar .= '<th>ID</th>'; 
 $menu_listar .= '<th>Nombre</th>';			
 $menu_listar .= '<th>Correo Electr&oacute;nico</th>';
 $menu_listar .= '<th>Celular</th>';
 $menu_listar .= '<th></th>';
 
 $miga_pan .= '<li>Vendedor</li>';

 $mensaje = 0;
 require_once ('mensajes_vendedor.php'); 

?>