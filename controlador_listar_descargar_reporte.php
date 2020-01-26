<?php 
 require_once ('modelo_listar_descargar_reporte.php');
 
 $listar = '';
 
 if($cantidad_reportes > 0)
 {
  foreach($reporte as $reportes)
  {
   $listar .= ' <tr>';
  
   $listar .= '  <td>'.$reportes['nombre'].'</td>';

   if($reportes['tipo'] == 1)
   {
    $listar .= '  <td>VENTAS</td>';   
   }
   if($reportes['tipo'] == 2)
   {
    $listar .= '  <td>INVENTARIO</td>';	   
   }
	
   $listar .= '  <td align="right" width="30px">';
   $listar .= '   <a href="reportes/'.$reportes['nombre'].'.csv" style="text-decoration: none"><i class="fa fa-download fa-fw"></i></a>&nbsp;';
   $listar .= '  </td>';
   
   $listar .= ' </tr>';
  }
 }
 
 $menu_listar = '';
 $menu_listar .= '<th>Reporte</th>';
 $menu_listar .= '<th>Tipo</th>';
 $menu_listar .= '<th></th>';
 
 $miga_pan = '';
 $miga_pan .= '<li>Descargar Reporte</li>';
 
 $mensaje = 0;
 require_once ('mensajes_descargar_reporte.php'); 

?>