<?php
 $listar = '';
 $jquery = ''; 
 $miga_pan = '';
 
 require_once ('conexion_sesion.php'); 
 
 $perfil = $_SESSION['perfil'];
 $id_usuario = $_SESSION['usuario'];
 
 if($perfil == 'admin_schneider' || $perfil == 'super_schneider')
 {
  $id_anio = 0;
  $id_periodo = 0;
  $id_mes = 0;
  $id_distribuidor = 0;
  $id_linea = 0;
  $id_actividad = 0;
  $id_pais = 0;   
  $id_zona = 0;
  $id_segmento = 0;
	 
  if($_POST)
  {
   $id_anio = isset($_POST['id_anio']) ? $_POST['id_anio'] : '0';
   $id_periodo = isset($_POST['id_periodo']) ? $_POST['id_periodo'] : '0';
   $id_mes = isset($_POST['id_mes']) ? $_POST['id_mes'] : '0';
   $id_distribuidor = isset($_POST['id_distribuidor']) ? $_POST['id_distribuidor'] : '0';
   $id_linea = isset($_POST['id_linea']) ? $_POST['id_linea'] : '0';
   $id_actividad = isset($_POST['id_actividad']) ? $_POST['id_actividad'] : '0';
   $id_pais = isset($_POST['id_pais']) ? $_POST['id_pais'] : '0';   
   $id_zona = isset($_POST['id_zona']) ? $_POST['id_zona'] : '0';
   $id_segmento = isset($_POST['id_segmento']) ? $_POST['id_segmento'] : '0';
  }
 }
 
 require_once ('modelo_principal.php');

 if($_SESSION['restablecer']==1)
 {
  echo '<script language="JavaScript" type="text/javascript">document.location.href="cambiar_contrasenia.php"</script>';
 }
 
 require_once ('mensajes_principal.php');

 if($perfil == 'admin_schneider' || $perfil == 'super_schneider')
 {
  $menu_anio = '<select id="id_anio" name="id_anio" class="form-control" required/>';
  $menu_anio .= '<option value = ""> Seleccionar ';
  if($cantidad_anio != 1)
  {
   foreach($anios as $anio)
   { 
    if($id_anio == $anio['id'])
    {
     $menu_anio .= ' <option value = '.$anio['id'].' selected> '.$anio['nombre'].'</option>';
    }
    else
    {
     $menu_anio .= ' <option value = '.$anio['id'].'> '.$anio['nombre'].'</option>';
    }
   }
  }
  $menu_anio .= '</select>';

  $menu_periodo = '<select id="id_periodo" name="id_periodo" class="form-control">';
  $menu_periodo .= '<option value = ""> Seleccionar ';
  if($id_periodo == "1")
  {
   $menu_periodo .= ' <option value = "1" selected>Q1</option>';
  }
  else
  {
   $menu_periodo .= ' <option value = "1">Q1</option>';
  }
  if($id_periodo == "2")
  {
   $menu_periodo .= ' <option value = "2" selected>Q2</option>';
  }
  else
  {
   $menu_periodo .= ' <option value = "2">Q2</option>';
  }
  if($id_periodo == "3")
  {
   $menu_periodo .= ' <option value = "3" selected>Q3</option>';
  }
  else
  {
   $menu_periodo .= ' <option value = "3">Q3</option>';
  }
  if($id_periodo == "4")
  {
   $menu_periodo .= ' <option value = "4" selected>Q4</option>';
  }
  else
  {
   $menu_periodo .= ' <option value = "4">Q4</option>';
  }
  $menu_periodo .= '</select>';

  $menu_mes = '<select id="id_mes" name="id_mes" class="form-control"></select>';
  	 
  $menu_distribuidor = '<select id="id_distribuidor" name="id_distribuidor" class="form-control">';
  $menu_distribuidor .= '<option value = ""> Seleccionar ';
  $nombre_pais = '';
  
  if($cantidad_actividad != 1)
  {
   foreach($distribuidores as $distribuidor)
   {	
    if($nombre_pais != $distribuidor['pais'])
    {
     $menu_distribuidor .= ' <optgroup label="'.$distribuidor['pais'].'">';
	 $nombre_pais = $distribuidor['pais'];
	}

	if($id_distribuidor == $distribuidor['id'])
    {
     $menu_distribuidor .= ' <option value = '.$distribuidor['id'].' selected> '.$distribuidor['nombre'].'</option>';
    }
    else
    {
     $menu_distribuidor .= ' <option value = '.$distribuidor['id'].'> '.$distribuidor['nombre'].'</option>';
    }

    if($nombre_pais != $distribuidor['pais'])
    {
     $menu_distribuidor .= ' </optgroup>';
	}
   }
  }
  $menu_distribuidor .= '</select>';
	 
  $menu_linea = '<select id="id_linea" name="id_linea" class="form-control">';
  $menu_linea .= '<option value = ""> Seleccionar ';
  if($cantidad_linea != 1)
  {
   foreach($lineas as $linea)
   { 
    if($id_linea == $linea['id'])
    {
     $menu_linea .= ' <option value = '.$linea['id'].' selected> '.$linea['nombre'].'</option>';
    }
    else
    {
     $menu_linea .= ' <option value = '.$linea['id'].'> '.$linea['nombre'].'</option>';
    }
   }
  }
  $menu_linea .= '</select>';	 
	 
  $menu_actividad = '<select id="id_actividad" name="id_actividad" class="form-control"></select>';
	
  $menu_segmento = '<select id="id_segmento" name="id_segmento" class="form-control">';
  $menu_segmento .= '<option value = ""> Seleccionar </option>';
    
  if($id_segmento == 9999)
  {
   $menu_segmento .= '<option value = 9999  selected> <b>Todos</b> </option>';  
  }
  else
  {
   $menu_segmento .= '<option value = 9999> <b>Todos</b> </option>';
  }
  
  if($cantidad_segmento != 1)
  {
   foreach($segmentos as $segmento)
   {
    if($id_segmento == $segmento['id'])
    {
     $menu_segmento .= ' <option value = '.$segmento['id'].' selected> '.$segmento['nombre'].'</option>';
    }
    else
    {
     $menu_segmento .= ' <option value = '.$segmento['id'].'> '.$segmento['nombre'].'</option>';
    }
   }
  }
  $menu_segmento .= '</select>';
	
  $menu_pais = '<select id="id_pais" name="id_pais" class="form-control">';
  $menu_pais .= '<option value = ""> Seleccionar ';
  if($cantidad_pais != 1)
  {
   foreach($paises as $pais)
   { 
    if($id_pais == $pais['id'])
    {
     $menu_pais .= ' <option value = '.$pais['id'].' selected> '.$pais['nombre'].'</option>';
    }
    else
    {
     $menu_pais .= ' <option value = '.$pais['id'].'> '.$pais['nombre'].'</option>';
    }
   }
  }
  $menu_pais .= '</select>';	 

  $menu_zona = '<select id="id_zona" name="id_zona" class="form-control"></select>';
  
  $listar = ' <div class="row">';
  $listar .= ' <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';

  $listar .= '  <form class="form-horizontal" role="form" name="formulario" action="principal.php" autocomplete="off" method="post" enctype="multipart/form-data">';
			   		
  $listar .= '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
  $listar .= '    <div class="form-group">';
  $listar .= '     <label>A&ntilde;o</label>';
  $listar .= $menu_anio;
  $listar .= '    </div>';
  $listar .= '   </div>';

  $listar .= '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
  $listar .= '    <div class="form-group">';
  $listar .= '     <label>Periodo</label>';
  $listar .= $menu_periodo;
  $listar .= '    </div>';
  $listar .= '   </div>';
					
  $listar .= '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
  $listar .= '    <div class="form-group">';
  $listar .= '     <label>Mes</label>';
  $listar .= $menu_mes;
  $listar .= '    </div>';
  $listar .= '   </div>';
					
  $listar .= '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
  $listar .= '    <div class="form-group">';
  $listar .= '     <label>Distribuidor</label>';
  $listar .= $menu_distribuidor;
  $listar .= '    </div>';
  $listar .= '   </div>';
  
  $listar .= '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
  $listar .= '    <div class="form-group">';
  $listar .= '     <label>L&iacute;nea</label>';
  $listar .= $menu_linea;
  $listar .= '    </div>';
  $listar .= '   </div>';
  
  $listar .= '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
  $listar .= '    <div class="form-group">';
  $listar .= '     <label>Actividad</label>';
  $listar .= $menu_actividad;
  $listar .= '    </div>';
  $listar .= '   </div>';

  $listar .= '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
  $listar .= '    <div class="form-group">';
  $listar .= '     <label>Segmento</label>';
  $listar .= $menu_segmento;
  $listar .= '    </div>';
  $listar .= '   </div>';
  
  $listar .= '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
  $listar .= '    <div class="form-group">';
  $listar .= '     <label>Pa&iacute;s</label>';
  $listar .= $menu_pais;
  $listar .= '    </div>';
  $listar .= '   </div>';
  
  $listar .= '   <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">';
  $listar .= '    <div class="form-group">';
  $listar .= '     <label>Zona</label>';
  $listar .= $menu_zona;
  $listar .= '    </div>';
  $listar .= '   </div>';
    
  $listar .= '   <div align="right" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
  $listar .= '    <button id="filtrar" type="submit" class="btn btn-default">Filtrar</button>';
  $listar .= '   </div>';
		
  $listar .= '   </form>';
  
  $listar .= '  </div>';
  $listar .= ' </div>';

  $listar .= ' <br><br>';

  $listar .= $previo_resultado;  
  $listar .= $resultado;
  
  
  $jquery .=
   '<script>
    $(document).ready(function(){  	
     
	 $("#id_linea").change(function () {
	  $("#id_linea option:selected").each(function () {
	   id_linea = $(this).val();
	   $.post("controlador_dependiente_linea.php", { id_linea: id_linea }, function(data){
	    $("#id_actividad").html(data);
	   });
	  });
     });
   
   	 var id_linea = '.json_encode($id_linea).';
     var id_actividad = '.json_encode($id_actividad).';
   
     if (id_linea != "" || id_linea != 0) {
      $.post("controlador_dependiente_linea.php", { id_linea: id_linea, id_actividad: id_actividad }, function(data){
       $("#id_actividad").html(data);
      });
     }
   
   
   	 $("#id_pais").change(function () {
	  $("#id_pais option:selected").each(function () {
	   id_pais = $(this).val();
	   $.post("controlador_dependiente_pais.php", { id_pais: id_pais }, function(data){
	    $("#id_zona").html(data);
	   });
	  });
     });
   
   	 var id_pais = '.json_encode($id_pais).';
     var id_zona = '.json_encode($id_zona).';
   
     if (id_pais != "" || id_pais != 0) {
      $.post("controlador_dependiente_pais.php", { id_pais: id_pais, id_zona: id_zona }, function(data){
       $("#id_zona").html(data);
      });
     }
   
     $("#id_periodo").change(function () {
	  $("#id_periodo option:selected").each(function () {
	   id_periodo = $(this).val();
	   $.post("controlador_dependiente_periodo.php", { id_periodo: id_periodo }, function(data){
	    $("#id_mes").html(data);
	   });
	  });
     });
   
   	 var id_periodo = '.json_encode($id_periodo).';
     var id_mes = '.json_encode($id_mes).';
   
     if (id_periodo != "" || id_periodo != 0) {
      $.post("controlador_dependiente_periodo.php", { id_periodo: id_periodo, id_mes: id_mes }, function(data){
       $("#id_mes").html(data);
      });
     }
   
    });
   </script>';
  
 }

 
 if($perfil != 'admin_schneider' && $perfil != 'super_schneider')
 {
  $listar = ' <div class="row">';
  
  $listar .= ' <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">';
  
  $listar .= '  <div class="panel panel-default">';
  $listar .= '   <div class="panel-heading">Periodo</div>';
  $listar .= '   <div class="panel-body">';
  
  $listar .= '    <div class="row">';
  $listar .= '     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
  if($cantidad_anio != 1)
  {
   foreach($anios as $anio)
   { 
    if($id_anio == $anio['id'])
    {
     $listar .= ' <a href="principal.php?q='.$anio['q'].'&a='.$anio['id'].'&op='.$op.'&distribuidor='.$distri.'" class="btn btn-success btn-lg btn-block">'.$anio['nombre'].'</a>';
    }
    else
    {
     $listar .= ' <a href="principal.php?q='.$anio['q'].'&a='.$anio['id'].'&op='.$op.'&distribuidor='.$distri.'" class="btn btn-default btn-lg btn-block">'.$anio['nombre'].'</a>';
    }
    $listar .= '      <br>';
   }
  }
  $listar .= '     </div>';
  $listar .= '    </div>';
  $listar .= '    <br>';  
  $listar .= '    <div class="row">';
  $listar .= '     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">';
  
  if ($id_q == $q1_id)
  {
   $listar .= '      <a href="principal.php?q='.$q1_id.'&a='.$id_anio.'&op='.$op.'&distribuidor='.$distri.'" class="btn btn-success btn-lg btn-block">Q1</a>';	 
  }
  else
  {
   $listar .= '      <a href="principal.php?q='.$q1_id.'&a='.$id_anio.'&op='.$op.'&distribuidor='.$distri.'" class="btn btn-default btn-lg btn-block">Q1</a>';	 	 
  }
  $listar .= '      <br>';
  if ($id_q == $q3_id)
  {
   $listar .= '      <a href="principal.php?q='.$q3_id.'&a='.$id_anio.'&op='.$op.'&distribuidor='.$distri.'" class="btn btn-success btn-lg btn-block">Q3</a>';	 
  }
  else
  {
   $listar .= '      <a href="principal.php?q='.$q3_id.'&a='.$id_anio.'&op='.$op.'&distribuidor='.$distri.'" class="btn btn-default btn-lg btn-block">Q3</a>';	 	 
  } 
  $listar .= '     </div>';
  $listar .= '     <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">'; 
  if ($id_q == $q2_id)
  {
   $listar .= '      <a href="principal.php?q='.$q2_id.'&a='.$id_anio.'&op='.$op.'&distribuidor='.$distri.'" class="btn btn-success btn-lg btn-block">Q2</a>';	 
  }
  else
  {
   $listar .= '      <a href="principal.php?q='.$q2_id.'&a='.$id_anio.'&op='.$op.'&distribuidor='.$distri.'" class="btn btn-default btn-lg btn-block">Q2</a>';	 	 
  } 
  $listar .= '      <br>';
  if ($id_q == $q4_id)
  {
   $listar .= '      <a href="principal.php?q='.$q4_id.'&a='.$id_anio.'&op='.$op.'&distribuidor='.$distri.'" class="btn btn-success btn-lg btn-block">Q4</a>';	 
  }
  else
  {
   $listar .= '      <a href="principal.php?q='.$q4_id.'&a='.$id_anio.'&op='.$op.'&distribuidor='.$distri.'" class="btn btn-default btn-lg btn-block">Q4</a>';	 	 
  }
 
  $listar .= '     </div>';
  $listar .= '    </div>';
  
  $listar .= '   </div>'; 
  $listar .= '  </div>';
  
  $listar .= ' </div>';
 } 
 
 if($perfil == 'admin')
 {

 }
 
 if($perfil != 'admin_schneider' && $perfil != 'super_schneider')
 {
  $listar .= ' <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">';
  
  $listar .= '  <ul class="nav nav-tabs">';
  if($op == 'in')
  {
   $listar .= '   <li class="active"><a href="principal.php?q='.$id_q.'&a='.$id_anio.'&op=in&distribuidor='.$distri.'">Sell In</a></li>';
  }
  else
  {
   $listar .= '   <li><a href="principal.php?q='.$id_q.'&a='.$id_anio.'&op=in&distribuidor='.$distri.'">Sell In</a></li>';
  }
  if($op == 'out')
  {
   $listar .= '   <li class="active"><a href="principal.php?q='.$id_q.'&a='.$id_anio.'&op=out&distribuidor='.$distri.'">Sell Out</a></li>';
  }
  else
  {
   $listar .= '   <li><a href="principal.php?q='.$id_q.'&a='.$id_anio.'&op=out&distribuidor='.$distri.'">Sell Out</a></li>';
  }
   
  $listar .= '  </ul>';
  $listar .= '  <br>';

  $listar .= '  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
  
  $listar .= $informacion;
  $listar .= $disclaimer;
 }
 
 if($perfil == 'zona' || $perfil == 'segmento')
 {
  foreach($agrupado as $agrupados)
  {
   $listar .= '   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
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
 }
 
 if($perfil == 'canal' || $perfil == 'linea')
 {
  if($distri == 0)
  {
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

   if($perfil == 'canal')
   {
    $listar .= '  <br>';
  
    $listar .= '  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';  
    $listar .= '   <div class="panel panel-default">';
    $listar .= '    <div class="panel-heading">';
    $listar .= '     Distribuidores';
    $listar .= '    </div>';
    $listar .= '    <div class="panel-body">';
    $listar .= '     <div class="table-responsive">';
    $listar .= '      <table class="table table-striped table-bordered table-hover" id="distribuidor">';
    $listar .= '       <tbody>';
    foreach($distribuidor as $distribuidores)
    {
     $listar .= '        <tr><td>';
     $listar .= '         <a href="principal.php?q='.$id_q.'&a='.$id_anio.'&op='.$op.'&distribuidor='.$distribuidores[id].'">'.$distribuidores[nombre].'</a>';
     $listar .= '        </td></tr>';
    }
    $listar .= '       </tbody>';
    $listar .= '      </table>';
    $listar .= '     </div>';

    $listar .= '    </div>';
    $listar .= '   </div>';
    $listar .= '  </div>';
   }
   
   if($perfil == 'linea')
   {
    $listar .= '  <br>';
  
    $listar .= '  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';

	   
    $listar .= '  <div class="panel panel-default">';
    $listar .= '   <div class="panel-heading">';
    $listar .= '    Metas';
    $listar .= '   </div>';

    if($op == 'in')
    {
     $listar .= '   <div class="panel-body">';
     foreach($distribuidor as $distribuidores)
     {
      $listar .= '   <p>';
      $listar .= '    <strong>'.$distribuidores[nombre].' </strong>';   
      
	  if($distribuidores[meta] != 0)
      {
       $listar .= '   <span class="pull-right text-muted">Meta: '.number_format($distribuidores[meta],0,'','.').'</span>';
      }
      $listar .= '   </p>';
   
      $listar .= '   <div class="progress progress-striped active">';
      $listar .= '    <div class="progress-bar '.$distribuidores[bar_progress].'" role="progressbar" aria-valuenow="'.$distribuidores[porcentaje].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$distribuidores[porcentaje].'%">';
      $listar .= '     <span class="sr-only">'.$distribuidores[porcentaje].'% Complete</span>';
      $listar .= '    </div>';
      $listar .= '   </div>';

      $listar .= '   <p>';
      $listar .= '    <span class="pull-left text-muted">Valor Compra: '.number_format($distribuidores[compra],0,'','.').'</span>';
      if($distribuidores[meta] != 0)
      {
       $listar .='    <span class="pull-right text-muted">Porcentaje: '.number_format($distribuidores[porcentaje],2,',','.').'%</span>';
      }
	 
      $listar .= '   </p>';

      $listar .= '   <br><br>';   
     } 
     $listar .= '   </div>';
    }
	
	if($op == 'out')
    {
     $listar .= '   <div class="panel-body">';
     foreach($distribuidor as $distribuidores)
     {
      $listar .= '   <p>';
      $listar .= '    <strong>'.$distribuidores[nombre].' </strong>';   
      if($distribuidores[meta] != 0)
      {
       $listar .= '   <span class="pull-right text-muted">Meta: '.number_format($distribuidores[meta],0,'','.').'</span>';
      }
      $listar .= '   </p>';
   
      $listar .= '   <div class="progress progress-striped active">';
      $listar .= '    <div class="progress-bar '.$distribuidores[bar_progress].'" role="progressbar" aria-valuenow="'.$distribuidores[porcentaje].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$distribuidores[porcentaje].'%">';
      $listar .= '     <span class="sr-only">'.$distribuidores[porcentaje].'% Complete</span>';
      $listar .= '    </div>';
      $listar .= '   </div>';

      $listar .= '   <p>';
      $listar .= '    <span class="pull-left text-muted">Valor Venta: '.number_format($distribuidores[venta_actividad],0,'','.').'</span>';
      if($distribuidores[meta] != 0)
      {
       $listar .='    <span class="pull-right text-muted">Porcentaje: '.number_format($distribuidores[porcentaje],2,',','.').'%</span>';
      }
      $listar .= '   </p>';

      $listar .= '   <br>'; 
   
      $listar .= '   <p>';
      if($distribuidores[meta] != 0)
      {
 	   if($distribuidores[porcentaje] >= 100) 
	   {  
	    if($_SESSION['pais']==123)
        {	
         $listar .= ' <span class="pull-left text-muted">Bonificación: '.number_format($distribuidores[bonificacion],0,'','.').' </span>';
	    }
	   }
	   else
	   {
	    if($_SESSION['pais']==123)
        {
         $listar .= ' <span class="pull-left text-muted">Cumplida la meta la bonificacion seria de: '.number_format($distribuidores[bonificacion],0,'','.').'</span>';
	    }
	   }
      }
      $listar .= '   </p>';
   
      $listar .= '   <br>'; 
     }

     $listar .= '   </div>';
    }
	
    $listar .= '   </div>';   
    
	$listar .= '   </div>';
   }
   
  }
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
 
 if($perfil == 'distribuidor' || ($perfil == 'canal' && $distri != 0))
 {
  $listar .= '  <div class="panel panel-default">';
  $listar .= '   <div class="panel-heading">';
  $listar .= '    Metas';
  $listar .= '   </div>';

  if($op == 'in')
  {
   $listar .= '   <div class="panel-body">';
   foreach($linea_sell_in as $lineas_sell_in)
   {
    $listar .= '   <p>';
    $listar .= '    <strong>'.$lineas_sell_in[nombre].' </strong>';   
    if($lineas_sell_in[meta] != 0)
    {
     $listar .= '   <span class="pull-right text-muted">Meta: '.number_format($lineas_sell_in[meta],0,'','.').'</span>';
    }
    $listar .= '   </p>';
   
    $listar .= '   <div class="progress progress-striped active">';
    $listar .= '    <div class="progress-bar '.$lineas_sell_in[bar_progress].'" role="progressbar" aria-valuenow="'.$lineas_sell_in[porcentaje].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$lineas_sell_in[porcentaje].'%">';
    $listar .= '     <span class="sr-only">'.$lineas_sell_in[porcentaje].'% Complete</span>';
    $listar .= '    </div>';
    $listar .= '   </div>';

    $listar .= '   <p>';
    $listar .= '    <span class="pull-left text-muted">Valor Compra: '.number_format($lineas_sell_in[compra],0,'','.').'</span>';
    if($lineas_sell_in[meta] != 0)
    {
     $listar .='    <span class="pull-right text-muted">Porcentaje: '.number_format($lineas_sell_in[porcentaje],2,',','.').'%</span>';
    }
    $listar .= '   </p>';

    $listar .= '   <br><br>';   
   } 
   $listar .= '   </div>';
  }
  
  if($op == 'out')
  {
   $listar .= '   <div class="panel-body">';
   foreach($linea_sell_out as $lineas_sell_out)
   {
    $listar .= '   <p>';
    $listar .= '    <strong>'.$lineas_sell_out[nombre].' </strong>';   
    if($lineas_sell_out[meta] != 0)
    {
     $listar .= '   <span class="pull-right text-muted">Meta: '.number_format($lineas_sell_out[meta],0,'','.').'</span>';
    }
    $listar .= '   </p>';
   
    $listar .= '   <div class="progress progress-striped active">';
    $listar .= '    <div class="progress-bar '.$lineas_sell_out[bar_progress].'" role="progressbar" aria-valuenow="'.$lineas_sell_out[porcentaje].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$lineas_sell_out[porcentaje].'%">';
    $listar .= '     <span class="sr-only">'.$lineas_sell_out[porcentaje].'% Complete</span>';
    $listar .= '    </div>';
    $listar .= '   </div>';

    $listar .= '   <p>';
    $listar .= '    <span class="pull-left text-muted">Valor Venta: '.number_format($lineas_sell_out[venta_actividad],0,'','.').'</span>';
    if($lineas_sell_out[meta] != 0)
    {
     $listar .='    <span class="pull-right text-muted">Porcentaje: '.number_format($lineas_sell_out[porcentaje],2,',','.').'%</span>';
    }
    $listar .= '   </p>';

    $listar .= '   <br>'; 
   
    $listar .= '   <p>';
    if($lineas_sell_out[meta] != 0)
    {
 	 if($lineas_sell_out[porcentaje] >= 100) 
	 {  
	  if($_SESSION['pais']==123)
      {	
       $listar .= ' <span class="pull-left text-muted">Bonificación: '.number_format($lineas_sell_out[bonificacion],0,'','.').' </span>';
	  }
	 }
	 else
	 {
	  if($_SESSION['pais']==123)
      {	
       $listar .= ' <span class="pull-left text-muted">Cumplida la meta la bonificacion seria de: '.number_format($lineas_sell_out[bonificacion],0,'','.').'</span>';
	  }
	 }
    }
    $listar .= '   </p>';
   
    $listar .= '   <br>'; 
   }

   $listar .= '   </div>';
  }
  $listar .= '   </div>';
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
	 if($_SESSION['pais']==123)
     {	
      $listar .= '        <span class="pull-left text-muted">Bonificación: '.number_format($actividades[bonificacion],0,'','.').' </span>';
     }
	}
	else
	{
	 if($_SESSION['pais']==123)
     {	
      $listar .= '        <span class="pull-left text-muted">Cumplida la meta del Distribuidor su bonificacion seria de: '.number_format($actividades[bonificacion],0,'','.').'</span>';
	 }
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