<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title><?php echo $pageTitle ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../css/style.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Font Awesome ---->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../css/css/adminlte.min.css">
  <!-- jQuery-->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery UI -->
  <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../css/js/adminlte.min.js"></script>
  <link rel="shortcut icon" href="../../img/logo1.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
  <div class="wrapper">
    <nav id="lt_nav" class="main-header navbar navbar-expand-md navbar-orange navbar-light sticky-top">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <a class="navbar-brand" onclick="window.open('../horarios.php','_Self')" style="cursor:pointer; font-weight:bold; color:white;">Cenigraf</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false" style="color:white;">
              Perfil
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="../update_usu.php">Cambiar contraseña</a></li>
              <li><a class="dropdown-item" onclick="window.open('../../controlador/exit.php','_Self')" style="cursor: pointer"> Cerrar sesión</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <!--/div2--> 

  <aside id="lt_aside" class="main-sidebar sidebar-dark-primary" style="position: fixed;">

  <a href="../horarios.php" style="color: white;">
    <img src="../../img/logo.png" style="width: 50px;height:50px;margin-left: 10px;margin-top: 5px;">
    <span class="brand-text font-weight-bold">CENIGRAF</span>
  </a>
    <div class="sidebar">
      <div class="user-panel mt-4 pb-4" style="color:white;">
        <i class="bi bi-person-circle ml-3"></i>
        <span class="brand-text font-weight-bold"> Admin-<?php echo $inst; ?></span>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
          <li class="nav-item">
            <a href="../imprimir/horarios_Ins_Im.php?ins=<?php echo $id_ins; ?>" class="nav-link" style="color:white;">
              <i class="nav-icon fas fa-solid fa-print"></i>
              <p>
                Imprimir | Descargar
              </p>
            </a>
          </li>

          <!--   <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class=" far fa-calendar-alt fa-lg"></i>
                      <p>
                        Trimestres del Año
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="horarios_ins.php?instructor=<?php echo $id_ins; ?>&est=I Trimestre" class="nav-link">
                          <i class="fas fa-file-export"></i>
                          <p>I Trimestre del año</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="horarios_ins.php?instructor=<?php echo $id_ins; ?>&est=II Trimestre" class="nav-link">
                          <i class="fas fa-file-export"></i>
                          <p>II Trimestre del año</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="horarios_ins.php?instructor=<?php echo $id_ins; ?>&est=III Trimestre" class="nav-link">
                          <i class="fas fa-file-export"></i>
                          <p>III Trimestre del año</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="horarios_ins.php?instructor=<?php echo $id_ins; ?>&est=IV Trimestre" class="nav-link">
                          <i class="fas fa-file-export"></i>
                          <p>IV Trimestre del año</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="horarios_ins.php?instructor=<?php echo $id_ins; ?>&est=V Trimestre" class="nav-link">
                          <i class="fas fa-file-export"></i>
                          <p>V Trimestre del año</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="horarios_ins.php?instructor=<?php echo $id_ins; ?>&est=VI Trimestre" class="nav-link">
                          <i class="fas fa-file-export"></i>
                          <p>VI Trimestre del año</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>               
              </nav> -->
    </div>
  </aside>