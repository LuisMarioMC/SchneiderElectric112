<?php

 require_once ('modelo_listar_meta_sell_in.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($metasellin as $metassellin)
  {
   $listar .= ' <tr>';
   
   $listar .= '  <td>'.$metassellin['distribuidor'].'</td>';
   $listar .= '  <td>'.$metassellin['anio'].'</td>';
   $listar .= '  <td>'.$metassellin['linea'].'</td>';   
   $listar .= '  <td align="right">'.number_format($metassellin['q1'],0,",",".").'</td>';
   $listar .= '  <td align="right">'.number_format($metassellin['q2'],0,",",".").'</td>';
   $listar .= '  <td align="right">'.number_format($metassellin['q3'],0,",",".").'</td>';
   $listar .= '  <td align="right">'.number_format($metassellin['q4'],0,",",".").'</td>';
   
   $listar .= '  <td align="right" width="50px">';
		
   $listar .= '   <a href="modificar_meta_sell_in.php?id='.$metassellin['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
   $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarMetaSellIn('.$metassellin['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';

   $listar .= '  </td>';  
   
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Meta Sell In</li>';
 
 $mensaje = 0;
 require_once ('mensajes_meta_sell_in.php'); 

?>