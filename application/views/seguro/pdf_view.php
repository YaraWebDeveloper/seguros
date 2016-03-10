<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Póliza #<?php echo $data->seg_poliza ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('themes/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue" onload="window.print();">
        <!-- header logo: style can be found in header.less -->

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Main content -->
            <section class="content invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> CONSTANCIA DE SEGURO A LA CARGA
                            <small class="pull-right">Fecha <?php echo date('Y-m-d'); ?></small>
                        </h2>
                    </div><!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-md-12">
                        ASEGURADORA
                        <h4><?php echo $this->dataAsegurador[0]->par_value;?></h4>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        Tomadora
                        <address>
                            <strong><?php echo $data->tom_nombre ?></strong><br>
                            <strong>Dirección: </strong><?php echo $data->tom_direccion ?><br>
                            <strong>NIT: </strong><?php echo $data->tom_nit ?><br>
                        </address>
                        Generador
                        <address>
                            <strong><?php echo $data->usu_nombre ?> <?php echo $data->usu_apellido ?></strong><br>
                        </address>
                    </div><!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        Transportadora
                        <address>
                            <strong><?php echo $data->tra_nombre ?></strong><br>
                            <strong>NIT: </strong><?php echo $data->tra_nit ?><br>


                        </address>
                    </div><!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Poliza #<?php echo $data->seg_poliza ?></b><br/>
                        <br/>
                        <b>DO: </b> <?php echo $data->seg_do ?><br/>
                        <b>Certificado: </b><?php echo $data->seg_certificado ?><br/>
                        <b>Valor: </b><?php echo $data->seg_valor_asegurado ?>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>CLASE DE MERCANCIA</th>
                                    <th>PESO BRUTO</th>
                                    <th>FECHA DE SALIDA</th>
                                    <th>CIUDAD DE ORIGEN:</th>
                                    <th>CIUDAD DE DESTINO</th>
                                    <th>MEDIO DE TRANSPORTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $data->cla_mer_nombre; ?></td>
                                    <td><?php echo $data->seg_peso_bruto; ?></td>
                                    <td><?php echo $data->seg_fecha_salida; ?></td>
                                    <td><?php echo $data->ciu_origen; ?></td>
                                    <td><?php echo $data->ciu_destino; ?></td>
                                    <td><?php echo $data->med_tra_nombre; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-md-12">
                        <p class="lead">Observaciones</p>
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <?php echo $data->seg_observaciones; ?>
                        </p>
                    </div><!-- /.col -->
                    <!--                    <div class="col-xs-6">
                                            <p class="lead">Amount Due 2/22/2014</p>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:50%">Subtotal:</th>
                                                        <td>$250.30</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tax (9.3%)</th>
                                                        <td>$10.34</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping:</th>
                                                        <td>$5.80</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td>$265.24</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div> /.col -->
                </div><!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-xs-12"> 
                        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Imprimir</button>
                    </div>
                </div>
            </section><!-- /.content -->
        </div><!-- ./wrapper -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('themes/admin'); ?>/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url('themes/admin'); ?>/js/AdminLTE/demo.js" type="text/javascript"></script>
    </body>
</html>
