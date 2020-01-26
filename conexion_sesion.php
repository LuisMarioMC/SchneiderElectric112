<?php
 
 session_start();
 
 if(!isset($_SESSION['acceso']))
 {
  session_destroy();
  header('Location: index.php');
  die;
 }
 
 // Realiza la conexión a la base de datos
 require_once ('conexion.php');
 // Funciones en php
 require_once ('funciones.php');
 
 // Mostrar Hora Servidor
 date_default_timezone_set("America/Bogota");
 
?>