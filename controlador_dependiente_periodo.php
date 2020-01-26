<?php
 
 require_once ('conexion_sesion.php');

 $id_periodo = $_POST['id_periodo'];
 $id_mes = $_POST['id_mes'];
 
 $html = '<option value="">Seleccionar</option>';

 if($id_periodo == "1")
 {	  
  if($id_mes == "01")
  {
   $html .= ' <option value = "01" selected>Enero</option>';
  }
  else
  {
   $html .= ' <option value = "01">Enero</option>';
  }
  if($id_mes == "02")
  {
   $html .= ' <option value = "02" selected>Febrero</option>';
  }
  else
  {
   $html .= ' <option value = "02">Febrero</option>';
  }
  if($id_mes == "03")
  {
   $html .= ' <option value = "03" selected>Marzo</option>';
  }
  else
  {
   $html .= ' <option value = "03">Marzo</option>';
  }
 }

 if($id_periodo == "2")
 {
  if($id_mes == "04")
  {
   $html .= ' <option value = "04" selected>Abril</option>';
  }
  else
  {
   $html .= ' <option value = "04">Abril</option>';
  }
  if($id_mes == "05")
  {
   $html .= ' <option value = "05" selected>Mayo</option>';
  }
  else
  {
   $html .= ' <option value = "05">Mayo</option>';
  }
  if($id_mes == "06")
  {
   $html .= ' <option value = "06" selected>Junio</option>';
  }
  else
  {
   $html .= ' <option value = "06">Junio</option>';
  }
 }

 if($id_periodo == "3")
 {
  if($id_mes == "07")
  {
   $html .= ' <option value = "07" selected>Julio</option>';
  }
  else
  {
   $html .= ' <option value = "07">Julio</option>';
  }
  if($id_mes == "08")
  {
   $html .= ' <option value = "08" selected>Agosto</option>';
  }
  else
  {
   $html .= ' <option value = "08">Agosto</option>';
  }
  if($id_mes == "09")
  {
   $html .= ' <option value = "09" selected>Septiembre</option>';
  }
  else
  {
   $html .= ' <option value = "09">Septiembre</option>';
  }
 }

 if($id_periodo == "4")
 { 
  if($id_mes == "10")
  {
   $html .= ' <option value = "10" selected>Octubre</option>';
  }
  else
  {
   $html .= ' <option value = "10">Octubre</option>';
  }
  if($id_mes == "11")
  {
   $html .= ' <option value = "11" selected>Noviembre</option>';
  }
  else
  {
   $html .= ' <option value = "11">Noviembre</option>';
  }
  if($id_mes == "12")
  {
   $html .= ' <option value = "12" selected>Diciembre</option>';
  }
  else
  {
   $html .= ' <option value = "12">Diciembre</option>';
  }
 } 
 
 echo $html;

?>