<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>UIA Dev - Sis Matricula.</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

  <!-- Modal -->
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="profileModalInfo" class="modal fade">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title"><img src="" class="img-circle profilePhoto" width="60">&nbsp;&nbsp;Información de Usuario.</h4>
              </div>
              <div class="modal-body">
                  <!-- Body de Modal con la informacion de Usuario Actualmente logeado -->
              </div>
              <div class="modal-footer">
                  <button data-dismiss="modal" class="btn btn-theme" type="button">Entendido</button>
              </div>
          </div>
      </div>
  </div>
  <!-- modal -->

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>SISTEMA DE MATRICULAS.</b></a>
            <!--logo end-->
            <div class="top-menu">
              <ul class="nav pull-right top-menu">
                  <li><a class="logout" href="login.html">Salir de Sesión</a></li>
                  <li><a class="blockSession" href="lock_screen.html">Bloquear</a></li>
              </ul>
            </div>
      </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="#"><img src="" class="img-circle profilePhoto" width="60"></a></p>
                  <h5 class="centered userNameProfile"></h5>

                  <li class="mt">
                      <a href="index.html">
                          <i class="fa fa-dashboard"></i>
                          <span>Inicio</span>
                      </a>
                  </li>

                  <li>
                      <a href="frmCrearMatricula.php">
                          <i class="fa fa-puzzle-piece"></i>
                          <span>Crear Matricula</span>
                      </a>
                  </li>

                  <li>
                      <a href="#">
                          <i class="fa fa-pencil-square-o"></i>
                          <span>Asigacion de Notas</span>
                      </a>
                  </li>

                  <li>
                      <a href="#">
                          <i class="fa fa-wrench"></i>
                          <span>Mantenimientos</span>
                      </a>
                  </li>

                  <li>
                      <a href="#">
                          <i class="fa fa-clock-o"></i>
                          <span>Horarios</span>
                      </a>
                  </li>

                  <li>
                      <a href="#">
                          <i class="fa fa-graduation-cap"></i>
                          <span>Consulta de Notas</span>
                      </a>
                  </li>

                  <li>
                      <a href="#">
                          <i class="fa fa-newspaper-o"></i>
                          <span>Noticias</span>
                      </a>
                  </li>

                  <li>
                      <a href="#">
                          <i class="fa fa-university"></i>
                          <span>Acerca de.</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper site-min-height">