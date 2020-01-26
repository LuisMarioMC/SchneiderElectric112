<?php

 require_once ('modelo_listar_meta_sell_out.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($metasellout as $metassellout)
  {
   $listar .= ' <tr>';
   
   $listar .= '  <td>'.$metassellout['distribuidor'].'</td>';
   $listar .= '  <td>'.$metassellout['anio'].'</td>';
   $listar .= '  <td>'.$metassellout['linea'].'</td>';
   $listar .= '  <td align="right">'.number_format($metassellout['q1'],0,",",".").'</td>';
   $listar .= '  <td>'.$metassellout['cq1'].'</td>';
   $listar .= '  <td align="right">'.number_format($metassellout['q2'],0,",",".").'</td>';
   $listar .= '  <td>'.$metassellout['cq2'].'</td>';
   $listar .= '  <td align="right">'.number_format($metassellout['q3'],0,",",".").'</td>';
   $listar .= '  <td>'.$metassellout['cq3'].'</td>';   
   $listar .= '  <td align="right">'.number_format($metassellout['q4'],0,",",".").'</td>';
   $listar .= '  <td>'.$metassellout['cq4'].'</td>';
      
   $listar .= '  <td align="right" width="50px">';
		
   $listar .= '   <a href="modificar_meta_sell_out.php?id='.$metassellout['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
   $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarMetaSellOut('.$metassellout['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';

   $listar .= '  </td>';  
   
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Meta Sell Out</li>';
 
 $mensaje = 0;
 require_once ('mensajes_meta_sell_out.php'); 

?>