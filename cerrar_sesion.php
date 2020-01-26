<?php  

 // Realiza la conexión a la base de datos
 require_once ('conexion.php');
 
 //Funciones en php
 require_once ('funciones.php');
 
 session_start();

 $id = $_SESSION['id']; //Identificacion del usuario que ingreso al sistema
 
 $auditoria = 'Salida del Sistema';
 $modulo = 1;
 //Auditoria - Crear Laboratorio (Depende de funciones.php)
 auditoria($auditoria,$_SESSION['id'],$modulo,$_SESSION['perfil']);
 	 	 
 @mysqli_close($conexion); //Cierra la conexion a la Base de Datos
 
 session_unset();
 session_destroy();
 header('Location: index.php');

?>