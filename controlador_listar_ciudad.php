<?php

 require_once ('modelo_listar_ciudad.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($ciudad as $ciudades)
  {
  
   $listar .= ' <tr>';
   
   $listar .= '  <td width="35px">';

   if($ciudades['estado']==0)
   {
    $listar .= '  <a href="controlador_estado_ciudad.php?id='.$ciudades['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Inactivo">';
    $listar .= '   <font size="1" color="#FFFFFF">0</font>';
    $listar .= '  </a>';
   }
   if($ciudades['estado']==1)
   {
    $listar .= '  <a href="controlador_estado_ciudad.php?id='.$ciudades['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Activo">';
    $listar .= '   <font size="1" color="#FFFFFF">1</font>';
    $listar .= '  </a>';
   }
  
   $listar .= '  </td>';
   
   $listar .= '  <td>'.$ciudades['nombre'].'</td>';
   $listar .= '  <td>'.$ciudades['pais'].'</td>';
   $listar .= '  <td>'.$ciudades['departamento'].'</td>';
      
   $listar .= '  <td align="right" width="50px">';
		
   $listar .= '   <a href="modificar_ciudad.php?id='.$ciudades['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
   $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarCiudad('.$ciudades['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';

   $listar .= '  </td>';  
   
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Ciudad</li>';
 
 $mensaje = 0;
 require_once ('mensajes_ciudad.php'); 

?>