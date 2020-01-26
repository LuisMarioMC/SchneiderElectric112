<?php

 require_once ('modelo_listar_aprobar.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($aprobacion as $aprobaciones)
  {  
   $listar .= ' <tr>';
   
   $listar .= '  <td width="35px">';

   if($aprobaciones['estado']==1)
   {
    $listar .= '  &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Activo">';
    $listar .= '  <font size="1" color="#FFFFFF">1</font>';
   }
  
   $listar .= '  </td>';
   
   $listar .= '  <td>'.$aprobaciones['distribuidor'].'</td>';
   $listar .= '  <td>'.$aprobaciones['pais'].'</td>';
   $listar .= '  <td>'.$aprobaciones['linea'].'</td>';      
   $listar .= '  <td>'.$aprobaciones['actividad'].'</td>';
   
   $listar .= '  <td align="right">'.number_format($aprobaciones['venta'], 2, ',', '.').'</td>';
   $listar .= '  <td align="right">'.number_format($aprobaciones['meta'], 2, ',', '.').'</td>';
   $listar .= '  <td align="right"><b><font color="red">'.number_format($aprobaciones['bonificacion'], 2, ',', '.').'</font></b></td>';
      
   $listar .= '  <td align="right" width="50px">';
   if($aprobado == 0)
   {
    if($aprobaciones['venta'] > 0 && $aprobaciones['bonificacion'] == 0 && $perfil == 'linea')
    {
     $listar .= '  <a href="listar_aprobar.php?id='.$aprobaciones[id].'" class="btn btn-success btn-xs">HAGA CLIC <br> PARA APROBAR <br> BONIFICACIÓN</a>';
	}
    if($aprobaciones['estado'] == 1)
    {
     $listar .= '  <a href="listar_aprobar.php?id='.$aprobaciones[id].'" class="btn btn-danger btn-xs">HAGA CLIC <br> PARA RECHAZAR <br> BONIFICACIÓN</a>';
    }
      
    $boton_aprobar = '<input type="submit" class="btn btn-success btn-lg" name="aprobar" value="APROBAR">';
   }

   $listar .= '  </td>';  
   
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Aprobar Informe Trimestral</li>';
 
 $mensaje = 0;
 require_once ('mensajes_aprobar.php');

?>