<?php

 require_once ('modelo_auditoria_q.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($q_auditoria as $q_auditorias)
  {
   $listar .= ' <tr>';
   $listar .= '  <td>'.$q_auditorias['no'].'</td>';
   $listar .= '  <td>'.$q_auditorias['accion'].'</td>';
   $listar .= '  <td>'.$q_auditorias['usuario'].'</td>';
   $listar .= '  <td>'.$q_auditorias['perfil'].'</td>';
   $listar .= '  <td>'.$q_auditorias['fecha'].'</td>';
   $listar .= '  <td>'.$q_auditorias['hora'].'</td>';   
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li><a href="listar_q.php">Q</a></li>'; 
 $miga_pan .= '<li>Auditoria Q</li>';
 
 $mensaje = 0;
 require_once ('mensajes_q.php'); 

?>