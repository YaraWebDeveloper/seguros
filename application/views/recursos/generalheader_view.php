<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Seguros</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url("themes/admin"); ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url("themes/admin"); ?>/css/font_awesome/font-awesome.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url("themes/admin"); ?>/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo base_url("themes/admin"); ?>/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo base_url("themes/admin"); ?>/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="<?php echo base_url("themes/admin"); ?>/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo base_url("themes/admin"); ?> /css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url("themes/admin"); ?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url("themes/admin"); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url("themes/admin"); ?>/css/personalizado.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:http:// -->
        <!--[if lt IE 9]>
          <script src="https:http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https:http://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo base_url(); ?>" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Seguros
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $nombreUsuario ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo base_url('userfiles/usuario/imagen/' . $fotoUsuario); ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $nombreUsuario ?>
                                        <small><?php echo $apellidoUsuario ?></small>
                                    </p>
                                </li>
                                <!-- Menu de perfil adicional -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Información Adicional</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url("login/cerrarSesion"); ?>" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url('userfiles/usuario/imagen/' . $fotoUsuario); ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $nombreUsuario ?><br />
                                <small><?php echo $apellidoUsuario ?></small>
                            </p>

                            <!--a href="#"><i class="fa fa-circle text-success"></i> Online</a-->
                        </div>
                    </div>
                    <?php
                    if (isset($listaModulos)) {
                        echo $listaModulos;
                    }
                    ?>  
                </section>
                <!-- /.sidebar -->
            </aside>
            <aside class="right-side">
                <!-- Small boxes (Stat box) -->
                <?php
                if ($dataModuloActual != NULL):
                    $dataIcono = $dataModuloActual->mod_clase_icono;
                    $dataNombreModulo = $dataModuloActual->mod_nombre;
                    $dataDescricpion = $dataModuloActual->mod_descripcion;
                else:
                    $dataIcono = "fa-dashboard";
                    $dataNombreModulo = "Inicio";
                    $dataDescricpion = "Panel de Control";

                endif;
                ?>
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <i class="fa <?php echo $dataIcono; ?>"></i>
                        <?php echo $dataNombreModulo; ?>
                        <small><?php echo $dataDescricpion; ?>
                        </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active"><i class="fa <?php echo $dataIcono; ?>"></i> <?php echo $dataNombreModulo; ?></li>
                    </ol>
                </section>
                <section class="content">