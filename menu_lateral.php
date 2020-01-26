    <div class="navbar-gray sidebar" role="navigation">
     <div class="sidebar-nav navbar-collapse">
      <ul class="nav" id="side-menu">
	   <li>
        <a href="principal.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
       </li>
	  
	   <?php
		if($_SESSION['restablecer']==0)
		{
	   
		 if($_SESSION['perfil']=='admin' || $_SESSION['perfil'] == 'admin_schneider' || $_SESSION['perfil'] == 'super_schneider')
		 {
		  echo ' <li>';
          echo '  <a href="listar_usuario.php"><i class="fa fa-user fa-fw"></i> Usuario</a>';
	      echo ' </li>';
		 }
		 
		 if($_SESSION['perfil']=='distribuidor')
		 {
		  echo ' <li>';
          echo '  <a href="listar_vendedor.php"><i class="fa fa-user fa-fw"></i> Vendedor</a>';
	      echo ' </li>';
		 }
		 
 		 if($_SESSION['perfil']=='admin')
		 {
 		  echo ' <li>';
          echo '  <a href="listar_meta_sell_in.php"><i class="fa fa-trophy fa-fw"></i> Meta Sell In</a>';
	      echo ' </li>';
		 
 		  echo ' <li>';
          echo '  <a href="listar_meta_sell_out.php"><i class="fa fa-trophy fa-fw"></i> Meta Sell Out</a>';
	      echo ' </li>';		 
		 
		  echo ' <li>';
          echo '  <a href="#"><i class="fa fa-wrench fa-fw"></i>Par&aacute;metros <span class="fa arrow"></span></a>';
          echo '  <ul class="nav nav-second-level">';

		  echo '   <li>';
          echo '    <a href="listar_actividad.php"><i class="fa fa-bar-chart-o fa-fw"></i> Actividad</a>';
          echo '   </li>';

		  echo '   <li>';
          echo '    <a href="listar_anio.php"><i class="fa fa-calendar-o fa-fw"></i> A&ntilde;o</a>';
          echo '   </li>';
		  
  		  echo '   <li>';
          echo '    <a href="listar_ciudad.php"><i class="fa fa-map-marker fa-fw"></i> Ciudad</a>';
          echo '   </li>';
		   
   		  echo '   <li>';
          echo '    <a href="listar_departamento.php"><i class="fa fa-location-arrow fa-fw"></i> Departamento</a>';
          echo '   </li>';
		 
		  echo '   <li>';
          echo '    <a href="listar_linea.php"><i class="fa fa-list-alt fa-fw"></i> L&iacute;nea</a>';
          echo '   </li>';

		  echo '   <li>';
          echo '    <a href="listar_mes.php"><i class="fa fa-calendar fa-fw"></i> Mes</a>';
          echo '   </li>';		  
		  
		  echo '   <li>';
          echo '    <a href="listar_moneda.php"><i class="fa fa-dollar fa-fw"></i> Moneda</a>';
          echo '   </li>';

		  echo '   <li>';
          echo '    <a href="listar_pais.php"><i class="fa fa-globe fa-fw"></i> Pa&iacute;s</a>';
          echo '   </li>';

		  echo '   <li>';
          echo '    <a href="listar_producto.php"><i class="fa fa-cube fa-fw"></i> Producto</a>';
          echo '   </li>';

		  echo '   <li>';
          echo '    <a href="listar_q.php"><i class="fa fa-table fa-fw"></i> Q</a>';
          echo '   </li>';
		   
		  echo '   <li>';
          echo '    <a href="listar_segmento.php"><i class="fa fa-th-list fa-fw"></i> Segmento</a>';
          echo '   </li>';
		  
		  echo '   <li>';
          echo '    <a href="listar_zona.php"><i class="fa fa-flag fa-fw"></i> Zona</a>';
          echo '   </li>';
		  
		  echo '  </ul>';
          echo ' </li>';
	     }
		 
		 
		 if($_SESSION['perfil']=='cartera' || $_SESSION['perfil']=='canal' || $_SESSION['perfil']=='linea')
		 {
		  echo ' <li>';
          echo '  <a href="listar_aprobar.php"><i class="fa fa-dropbox fa-fw"></i> Aprobar Informe Trimestral</a>';
	      echo ' </li>';
		 }
		 		 
		 if($_SESSION['perfil']=='admin' || $_SESSION['perfil'] == 'admin_schneider' || $_SESSION['perfil'] == 'super_schneider')
		 {
		  echo ' <li>';
          echo '  <a href="reportes.php"><i class="fa fa-dropbox fa-fw"></i> Reportes Distribuidores</a>';
	      echo ' </li>';
		 }
		 //if($_SESSION['perfil']!='admin')
		 //{
		 // echo ' <li>';
         // echo '  <a href="informe.php"><i class="fa fa-bar-chart fa-fw"></i> Obtener Informes</a>';
	     // echo ' </li>';
		 //}
		 //if($_SESSION['perfil']=='admin')
		 //{
		 // echo ' <li>';
         // echo '  <a href="reporte_inventario.php"><i class="fa fa-dropbox fa-fw"></i> Subir Reporte Inventario</a>';
	     // echo ' </li>';
		 //}
		 if($_SESSION['perfil']=='admin')
		 {
		  echo ' <li>';
          echo '  <a href="reporte_ventas.php"><i class="fa fa-upload fa-fw"></i> Subir Reporte Ventas</a>';
	      echo ' </li>';
		 }
		 if($_SESSION['perfil']=='admin')
		 {
		  echo ' <li>';
          echo '  <a href="reporte_inventario.php"><i class="fa fa-upload fa-fw"></i> Subir Reporte Inventario</a>';
	      echo ' </li>';
		 }
		 if($_SESSION['perfil']=='admin')
		 {
		  echo ' <li>';
          echo '  <a href="reporte_compras.php"><i class="fa fa-upload fa-fw"></i> Subir Reporte Compras</a>';
	      echo ' </li>';
		 }
		 
		 if($_SESSION['perfil']=='distribuidor')
		 {
		  echo ' <li>';
          echo '  <a href="reportes.php"><i class="fa fa-upload fa-fw"></i> Subir Reportes</a>';
	      echo ' </li>';
		 }
		 
		 //if($_SESSION['perfil']=='admin' || $_SESSION['perfil'] == 'admin_schneider' || $_SESSION['perfil'] == 'super_schneider')
		 if($_SESSION['perfil']=='admin' || $_SESSION['perfil'] == 'super_schneider')
		 {
		  echo ' <li>';
          echo '  <a href="listar_descargar_reporte.php"><i class="fa fa-download fa-fw"></i> Descargar Reporte</a>';
	      echo ' </li>';
		 }
		 
	    }
	   ?>
      </ul>
     </div>
     <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->