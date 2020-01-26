<?php
 $listar = '';
 $miga_pan = '';
 
 require_once ('modelo_principal.php');

 if($_SESSION['restablecer']==1)
 {
  echo '<script language="JavaScript" type="text/javascript">document.location.href="cambiar_contrasenia.php"</script>';
 }
 
 require_once ('mensajes_principal.php');

 $listar = ' <div class="row">';
 $listar .= ' <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">';
  
 $listar .= '  <div class="panel panel-default">';
 $listar .= '   <div class="panel-heading">Periodo</div>';
 $listar .= '   <div class="panel-body">';
  
 $listar .= '    <div class="row">';
 $listar .= '     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
 $listar .= '      <a href="" class="btn btn-success btn-lg btn-block">2017</a>';
 $listar .= '      <br>';  
 $listar .= '      <a href="" class="btn btn-default btn-lg btn-block">2018</a>';
 $listar .= '     </div>';
 $listar .= '    </div>';
 $listar .= '    <br>';  
 $listar .= '    <div class="row">';
 $listar .= '     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">';
 if ($id_q == 33)
 {
  $listar .= '      <a href="principal.php?q=33&a=10" class="btn btn-success btn-lg btn-block">Q1</a>';	 
 }
 else
 {
  $listar .= '      <a href="principal.php?q=33&a=10" class="btn btn-default btn-lg btn-block">Q1</a>';	 	 
 }
 $listar .= '      <br>';
 if ($id_q == 35)
 {
  $listar .= '      <a href="principal.php?q=35&a=10" class="btn btn-success btn-lg btn-block">Q3</a>';	 
 }
 else
 {
  $listar .= '      <a href="principal.php?q=35&a=10" class="btn btn-default btn-lg btn-block">Q3</a>';	 	 
 } 
 $listar .= '     </div>';
 $listar .= '     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">'; 
 if ($id_q == 34)
 {
  $listar .= '      <a href="principal.php?q=34&a=10" class="btn btn-success btn-lg btn-block">Q2</a>';	 
 }
 else
 {
  $listar .= '      <a href="principal.php?q=34&a=10" class="btn btn-default btn-lg btn-block">Q2</a>';	 	 
 } 
 $listar .= '      <br>';
 if ($id_q == 36)
 {
  $listar .= '      <a href="principal.php?q=36&a=10" class="btn btn-success btn-lg btn-block">Q4</a>';	 
 }
 else
 {
  $listar .= '      <a href="principal.php?q=36&a=10" class="btn btn-default btn-lg btn-block">Q4</a>';	 	 
 } 
 $listar .= '     </div>';
 $listar .= '    </div>';
  
 $listar .= '   </div>'; 
 $listar .= '  </div>';
  
 $listar .= ' </div>';
 
 if($perfil == 'admin')
 {

 }
 if($perfil == 'canal' || $perfil == 'linea' || $perfil == 'zona' || $perfil == 'segmento')
 {
  $listar .= ' <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">';
  $listar .= '  <ul class="nav nav-tabs">';
  $listar .= '   <li class="active"><a href="principal.php">Sell In</a></li>';
  $listar .= '   <li><a href="principal.php">Sell Out</a></li>';
  $listar .= '   <li><a href="principal.php">Inventario</a></li>';  
  $listar .= '  </ul>';
  $listar .= '  <br>';

  $listar .= '  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
  
  $listar .= $disclaimer;
  
  foreach($agrupado as $agrupados)
  {
   $listar .= '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
   $listar .= '    <div class="panel panel-success">';
   $listar .= '     <div class="panel-heading">';
   $listar .= '      '.$agrupados[nombre].'';
   $listar .= '     </div>';
   $listar .= '     <div class="panel-body">';
   $listar .= '      <p>'.$agrupados[contenido].'</p>';
   $listar .= '     </div>';
   $listar .= '    </div>';
   $listar .= '   </div>';
  }
  
  $listar .= '  </div>';
  
  $listar .= '  <br>';
  
  $listar .= '  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';  
  $listar .= '  <div class="panel panel-default">';
  $listar .= '   <div class="panel-heading">';
  $listar .= '    Distribuidores';
  $listar .= '   </div>';
  $listar .= '   <div class="panel-body">';
  $listar .= '    <div class="panel-group" id="accordion">';
  
  foreach($distribuidor as $distribuidores)
  { 
   $listar .= '     <div class="panel panel-default">';
   $listar .= '      <div class="panel-heading">';
   $listar .= '       <h4 class="panel-title">';
   $listar .= '        <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$distribuidores[id].'">'.$distribuidores[nombre].'</a>';
   $listar .= '       </h4>';
   $listar .= '      </div>';
   $listar .= '      <div id="collapse'.$distribuidores[id].'" class="panel-collapse collapse ">';
   $listar .= '       <div class="panel-body">';
   
   $j = 1;
   foreach($actividad as $actividades)
   {
	$listar .= ' 	   <p>';
    $listar .= '        <strong>'.$actividades[$j][nombre].' </strong>';
    if($actividades[$j][meta] != 0)
    {
     $listar .= '       <span class="pull-right text-muted">Meta: '.number_format($actividades[$j][meta],0,'','.').'</span>';
    }
    $listar .= '       </p>';
   
    $listar .= '       <div class="progress progress-striped active">';
    $listar .= '        <div class="progress-bar '.$actividades[$j][bar_progress].'" role="progressbar" aria-valuenow="'.$actividades[$j][porcentaje].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$actividades[$j][porcentaje].'%">';
    $listar .= '         <span class="sr-only">'.$actividades[$j][porcentaje].'% Complete</span>';
    $listar .= '        </div>';
    $listar .= '       </div>'; 

    $listar .= ' 	  <p>';
    $listar .= '        <span class="pull-left text-muted">Valor Venta: '.number_format($actividades[$j][venta_actividad],0,'','.').'</span>';
    if($actividades[$j][meta] != 0)
    {
     $listar .='        <span class="pull-right text-muted">Porcentaje: '.$actividades[$j][porcentaje].'%</span>';
    }
    $listar .= '       </p>';

    $listar .= '       <br>'; 
   
    $listar .= ' 	  <p>';
    if($actividades[$j][meta] != 0)
    { 	
     //$listar .= '        <span class="pull-left text-muted">Bonificación: '.number_format($actividades[$j][bonificacion],0,'','.').' </span>';
    }
    $listar .= '       </p>';
   
    $listar .= '       <br><br><br>';
	
	$j++;
   } 
   
   $listar .= '       </div>';
   $listar .= '      </div>';
   $listar .= '     </div>';
  }

  $listar .= '    </div>';
  $listar .= '   </div>';
  $listar .= '  </div>';
  $listar .= ' </div>';
  $listar .= '</div>';
  $listar .= '</div>';
 }
 
 if($perfil == 'linea')
 {

 }
 if($perfil == 'zona')
 {

 }
 if($perfil == 'cartera')
 {

 }
 if($perfil == 'segmento')
 {

 }
 
 if($perfil == 'distribuidor')
 {
  $listar .= ' <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">';
  $listar .= '  <div class="panel panel-default">';
  $listar .= '   <div class="panel-heading">';
  $listar .= '    Metas e Inventario';
  $listar .= '   </div>';
  $listar .= '   <div class="panel-body">';
  $listar .= '    <div class="panel-group" id="accordion">';
  $listar .= '     <div class="panel panel-default">';
  $listar .= '      <div class="panel-heading">';
  $listar .= '       <h4 class="panel-title">';
  $listar .= '        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Sell In</a>';
  $listar .= '       </h4>';
  $listar .= '      </div>';
  $listar .= '      <div id="collapseOne" class="panel-collapse collapse ">';
  $listar .= '       <div class="panel-body">';
  foreach($linea as $lineas)
  {
   $listar .= ' 	  <p>';
   $listar .= '        <strong>'.$lineas[nombre].'</strong>';
   $listar .= '        <span class="pull-right text-muted">0%</span>';
   $listar .= '       </p>';
   $listar .= '       <div class="progress progress-striped active">';
   $listar .= '        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">';
   $listar .= '         <span class="sr-only">0% Complete</span>';
   $listar .= '        </div>';
   $listar .= '       </div>';
  } 
  $listar .= '       </div>';
  $listar .= '      </div>';
  $listar .= '     </div>';
  $listar .= '     <div class="panel panel-default">';
  $listar .= '      <div class="panel-heading">';
  $listar .= '       <h4 class="panel-title">';
  $listar .= '        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Sell Out</a>';
  $listar .= '       </h4>';
  $listar .= '      </div>';
  $listar .= '      <div id="collapseTwo" class="panel-collapse collapse">';
  $listar .= '       <div class="panel-body">'; 
  
  foreach($actividad as $actividades)
  {  
   $listar .= ' 	  <p>';
   $listar .= '        <strong>'.$actividades[nombre].' </strong>';   
   if($actividades[meta] != 0)
   {
    $listar .= '       <span class="pull-right text-muted">Meta: '.number_format($actividades[meta],0,'','.').'</span>';
   }
   $listar .= '       </p>';
   
   $listar .= '       <div class="progress progress-striped active">';
   $listar .= '        <div class="progress-bar '.$actividades[bar_progress].'" role="progressbar" aria-valuenow="'.$actividades[porcentaje].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$actividades[porcentaje].'%">';
   $listar .= '         <span class="sr-only">'.$actividades[porcentaje].'% Complete</span>';
   $listar .= '        </div>';
   $listar .= '       </div>';

   $listar .= ' 	  <p>';
   $listar .= '        <span class="pull-left text-muted">Valor Venta: '.number_format($actividades[venta_actividad],0,'','.').'</span>';
   if($actividades[meta] != 0)
   {
    $listar .='        <span class="pull-right text-muted">Porcentaje: '.$actividades[porcentaje].'%</span>';
   }
   $listar .= '       </p>';

   $listar .= '       <br>'; 
   
   $listar .= ' 	  <p>';
   if($actividades[meta] != 0)
   {
	if($actividades[porcentaje] >= 100)
	{
     //$listar .= '        <span class="pull-left text-muted">Bonificación: '.number_format($actividades[bonificacion],0,'','.').' </span>';
    }
	else
	{
     //$listar .= '        <span class="pull-left text-muted">Cumplida la meta la bonificacion seria de: '.number_format($actividades[bonificacion],0,'','.').'</span>';
	}
   }
   $listar .= '       </p>';
   
   $listar .= '       <br><br><br>'; 
  }

  $listar .= '       </div>';
  $listar .= '      </div>';
  $listar .= '     </div>';
  $listar .= '    </div>';
  $listar .= '   </div>';
  $listar .= '  </div>';
  $listar .= ' </div>';
  $listar .= '</div>';  
 }
 
 if($perfil == 'vendedor')
 {  
  $listar .= ' <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">';
  $listar .= '  <div class="panel panel-default">';
  $listar .= '   <div class="panel-heading">';
  $listar .= '    Metas';
  $listar .= '   </div>';
  $listar .= '   <div class="panel-body">';
  $listar .= '    <div class="panel-group" id="accordion">';
  $listar .= '     <div class="panel panel-default">';
  $listar .= '      <div class="panel-heading">';
  $listar .= '       <h4 class="panel-title">';
  $listar .= '        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Sell Out</a>';
  $listar .= '       </h4>';
  $listar .= '      </div>';
  $listar .= '      <div id="collapseTwo" class="panel-collapse collapse in">';
  $listar .= '       <div class="panel-body">'; 
  
  foreach($actividad as $actividades)
  {  
   $listar .= ' 	  <p>';
   $listar .= '        <strong>'.$actividades[nombre].' </strong>';   
   if($actividades[meta] != 0)
   {
    $listar .= '       <span class="pull-right text-muted">Meta Distribuidor: '.number_format($actividades[meta],0,'','.').'</span>';
   }
   $listar .= '       </p>';
   
   $listar .= '       <div class="progress progress-striped active">';
   $listar .= '        <div class="progress-bar '.$actividades[bar_progress].'" role="progressbar" aria-valuenow="'.$actividades[porcentaje].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$actividades[porcentaje].'%">';
   $listar .= '         <span class="sr-only">'.$actividades[porcentaje].'% Complete</span>';
   $listar .= '        </div>';
   $listar .= '       </div>';

   $listar .= ' 	  <p>';
   $listar .= '        <span class="pull-left text-muted">Venta Distribuidor: '.number_format($actividades[venta_actividad],0,'','.').'</span>';
   if($actividades[meta] != 0)
   {
    $listar .='        <span class="pull-right text-muted">Porcentaje Distribuidor: '.$actividades[porcentaje].'%</span>';
   }
   $listar .= '       </p>';

   $listar .= '       <br>'; 

   $listar .= ' 	  <p>';
   $listar .= '        <span class="pull-left text-muted">Su Venta: '.number_format($actividades[venta_actividad_vendedor],0,'','.').'</span>';
   if($actividades[meta] != 0)
   {
    $listar .='        <span class="pull-right text-muted">Su Porcentaje: '.$actividades[porcentaje_vendedor].'%</span>';
   }
   $listar .= '       </p>';

   $listar .= '       <br>';
   
   $listar .= ' 	  <p>';
   if($actividades[meta] != 0)
   {
	if($actividades[porcentaje] >= 100)
	{
     //$listar .= '        <span class="pull-left text-muted">Bonificación: '.number_format($actividades[bonificacion],0,'','.').' </span>';
    }
	else
	{
     //$listar .= '        <span class="pull-left text-muted">Cumplida la meta del Distribuidor su bonificacion seria de: '.number_format($actividades[bonificacion],0,'','.').'</span>';
	}
   }
   $listar .= '       </p>';
   
   $listar .= '       <br><br><br>'; 
  }

  $listar .= '       </div>';
  $listar .= '      </div>';
  $listar .= '     </div>';
  $listar .= '    </div>';
  $listar .= '   </div>';
  $listar .= '  </div>';
  $listar .= ' </div>';
  $listar .= '</div>';  
 }
 
 if($perfil == 'actividad')
 {

 }
 
?>