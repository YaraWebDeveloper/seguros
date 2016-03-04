<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <!-- Mobile viewport optimized: h5bp.com/viewport -->
        <meta name="viewport" content="width=device-width">

        <title>Instalador Solución IT</title>

        <meta name="robots" content="noindex, nofollow">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="Juan Carlos Castañeda Trujillo"/>

        <!-- remove or comment this line if you want to use the local fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url("themes") ?>/general/content/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("themes") ?>/general/content/css/bootstrap-responsive.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("themes") ?>/general/content/css/bootmetro.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("themes") ?>/general/content/css/bootmetro-tiles.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("themes") ?>/general/content/css/bootmetro-charms.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("themes") ?>/general/content/css/metro-ui-light.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("themes") ?>/general/content/css/icomoon.css">

        <!--  these two css are to use only for documentation -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("themes") ?>/general/content/css/demo.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("themes") ?>/general/scripts/google-code-prettify/prettify.css" >

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url('themes') ?>/general/user_system/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url('themes') ?>/general/user_system/img/favicon/favicon.ico" type="image/x-icon">

        <!-- All JavaScript at the bottom, except for Modernizr and Respond.
           Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
           For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
        <script src="<?php echo base_url("themes") ?>/general/scripts/modernizr-2.6.1.min.js"></script>

        <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script>window.jQuery || document.write("<script src='<?php echo base_url("themes") ?>/general/scripts/jquery-1.8.2.min.js'>\x3C/script>");</script>
        <!--<script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/jquery.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/jquery.validate.js"></script>

        <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/google-code-prettify/prettify.js"></script>
        <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/jquery.scrollTo.js"></script>
        <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/bootmetro.js"></script>
        <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/bootmetro-charms.js"></script>
        <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/demo.js"></script>
        <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/holder.js"></script>

    </head>
    <body>
        <?php
        //verficar que los mensajes no vengan vacíos
        if ($valorMensaje != NULL):
            //escribo el mensaje que se envio.
            mensaje($valorMensaje, $valorTipoMensaje);
        endif; //fin de verificacion de mensajes 
        ?>
        <div class="hero-unit">
            <h1>Bienvenido al instalador de Solucion IT...</h1>
            <p />
            <p>Este solicitará datos necesarios para que la aplicación funcione correctamente</p>
            <p />
            <div class="btn btn-primary btn-large">
                Comencémos
            </div>
        </div>
        <!-- inicio mensaje -->
        <div class="alert alert-success">
            <p>
                <strong>
                    ¡Empecémos!
                </strong>
                Paso N° 1 - Crear Usuario SuperAdministrador
            </p>
        </div>

        <!-- fin de mensaje -->
    </body>
</html>
