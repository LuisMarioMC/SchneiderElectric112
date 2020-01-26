<?php

 require_once ('modelo_listar_anio.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($anio as $anios)
  {
   $listar .= ' <tr>';
   
   $listar .= '  <td width="35px">';

   if($anios['estado']==0)
   {
    $listar .= '  <a href="controlador_estado_anio.php?id='.$anios['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Inactivo">';
    $listar .= '   <font size="1" color="#FFFFFF">0</font>';
    $listar .= '  </a>';
   }
   if($anios['estado']==1)
   {
    $listar .= '  <a href="controlador_estado_anio.php?id='.$anios['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Activo">';
    $listar .= '   <font size="1" color="#FFFFFF">1</font>';
    $listar .= '  </a>';
   }
  
   $listar .= '  </td>';
   
   $listar .= '  <td>'.$anios['nombre'].'</td>';

   $listar .= '  <td align="right" width="50px">';
		
   $listar .= '   <a href="modificar_anio.php?id='.$anios['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
   $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarAnio('.$anios['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';

   $listar .= '  </td>';  
   
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>A&ntilde;o</li>';
 
 $mensaje = 0;
 require_once ('mensajes_anio.php'); 

?>