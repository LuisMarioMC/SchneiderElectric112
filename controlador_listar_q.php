<?php

 require_once ('modelo_listar_q.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($q as $qs)
  {
   $listar .= ' <tr>';
   
   $listar .= '  <td width="35px">';

   if($qs['estado']==0)
   {
    $listar .= '  <a href="controlador_estado_q.php?id='.$qs['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Inactivo">';
    $listar .= '   <font size="1" color="#FFFFFF">0</font>';
    $listar .= '  </a>';
   }
   if($qs['estado']==1)
   {
    $listar .= '  <a href="controlador_estado_q.php?id='.$qs['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Activo">';
    $listar .= '   <font size="1" color="#FFFFFF">1</font>';
    $listar .= '  </a>';
   }
  
   $listar .= '  </td>';
   
   $listar .= '  <td>'.$qs['nombre'].'</td>';
   $listar .= '  <td>'.$qs['anio'].'</td>';

   $listar .= '  <td width="35px">';
   $listar .= '   <a href="auditoria_q.php?id='.$qs['id'].'" style="text-decoration: none">';
   $listar .= '    <img src="img/ver.png" border="0" alt="Auditoria">';
   $listar .= '   </a>';
   $listar .= '  </td>';
   
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Q</li>';
 
 $mensaje = 0;
 require_once ('mensajes_q.php'); 

?>