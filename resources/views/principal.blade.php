<?php use Illuminate\Support\Facades\Session; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>SISTEMA DE RESERVAS MEDICAS</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo asset('admin') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo asset('admin') ?>/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!--iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- jQuery -->
        <script src="<?php echo asset('admin') ?>/plugins/jquery/jquery.min.js"></script>
        <!-- datatables-->
        <link rel="stylesheet"href="<?php echo asset('admin') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet"href="<?php echo asset('admin') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet"href="<?php echo asset('admin') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- datatables script-->
        <script src="<?php echo asset('admin') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo asset('admin') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo asset('admin') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo asset('admin') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="<?php echo asset('admin') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo asset('admin') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo asset('admin') ?>/plugins/jszip/jszip.min.js"></script>
        <script src="<?php echo asset('admin') ?>/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="<?php echo asset('admin') ?>/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="<?php echo asset('admin') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo asset('admin') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo asset('admin') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- sweetAlert-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
        <!--full calendar-->
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

<!--sweetAlert -->
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.26/dist/sweetalert2.min.css">



<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.26/dist/sweetalert2.all.min.js"></script>


        <!-- Navbar -->

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/panel" class="nav-link">SISTEMAS DE RESERVAS MEDICAS</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <span class="brand-text font-weight-light">NOMBRE CLINICA</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::check() ? Auth::user()->roles->pluck('name')->first() : 'Invitado' }}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        @can('usuarios.index')
                            <li class="nav-item">
                                <a href="/listaconfig" class="nav-link active">
                                    <i class="nav-icon fas bi bi-gear"></i>
                                    <p>Configuraciones</p>
                                </a>
                            </li>
                        @endcan

                        <!-- Menú Usuarios -->
                        @can('usuarios.index')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas bi bi-people"></i>
                                    <p>
                                        USUARIOS
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('usuarios.index')
                                        <li class="nav-item">
                                            <a href="/usuarios" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>LISTA USUARIOS</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('usuarios.registro.form')
                                        <li class="nav-item">
                                            <a href="/registroUsuario" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>REGISTRO USUARIOS</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        <!-- Menú Pacientes -->
                        @can('pacientes.lista')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas bi bi-people"></i>
                                    <p>
                                        PACIENTES
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('pacientes.lista')
                                        <li class="nav-item">
                                            <a href="/listaPacientes" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>LISTADO DE PACIENTES</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('paciente.registrar')
                                        <li class="nav-item">
                                            <a href="/verPaciente" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>CREACION DE PACIENTES</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        <!-- Menú Consultorios -->
                        @can('consultorios.lista')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas bi bi-building-fill-add"></i>
                                    <p>
                                        CONSULTORIOS
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('consultorios.lista')
                                        <li class="nav-item">
                                            <a href="/listaConsultorio" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>LISTA DE CONSULTORIOS</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('consultorio.registrar.form')
                                        <li class="nav-item">
                                            <a href="/consultorioreg" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>CREAR CONSULTORIOS</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        <!-- Menú Doctores -->
                        @can('doctores.lista')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas bi bi-person-lines-fill"></i>
                                    <p>
                                        DOCTORES
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('doctores.lista')
                                        <li class="nav-item">
                                            <a href="/listaDoctores" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>LISTA DE DOCTORES</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('doctor.registrar.form')
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>REGISTRO DE DOCTORES</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        <!-- Menú Horarios -->
                        @can('horarios.lista')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas bi bi-person-lines-fill"></i>
                                    <p>
                                        HORARIOS
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @can('horarios.lista')
                                        <li class="nav-item">
                                            <a href="/listaHorarios" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>LISTA DE HORARIOS</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('horario.registrar.form')
                                        <li class="nav-item">
                                            <a href="RegistroHorario" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>REGISTRO DE HORARIOS</p>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan

                        <!-- Cerrar sesión -->
                        <li class="nav-item">
                            <form action="/logout" method="post">
                                @csrf
                                <a href="#" onclick="this.closest('form').submit()" class="nav-link"
                                    style="background-color: #a9200e">
                                    <i class="nav-icon fas bi bi-door-closed-fill"></i>
                                    Cerrar sesión
                                </a>
                            </form>
                        </li>
                    </ul>
                </nav>

            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container">
                @yield('contenido')
            </div>


        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->

        </footer>
    </div>

    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- Bootstrap 4 -->
    <script src="<?php echo asset('admin') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo asset('admin') ?>/dist/js/adminlte.min.js"></script>
</body>

</html>