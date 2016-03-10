<?php echo $header ?>

<div class="page-header">
    <h1>Usuarios <small>Administración</small></h1>
</div>
<div class="col-md-12">
    <?php
    mensaje(validation_errors());
//verficar que los mensajes no vengan vacíos
    if ($valorMensaje != NULL):
        //escribo el mensaje que se envio.
        mensaje($valorMensaje, $valorTipoMensaje);
    endif; //fin de verificacion de mensajes 
    ?>
    <?php
    $inputDisable = false;
    if ($Registros == NULL):
        $inputDisable = true;
    endif;
    $dataInputUsername = controlInput('usu_username', $valorUsername, 'Username', "required form-control");
    $dataInputNombre = controlInput('usu_nombre', $valorNombre, 'Nombre', "required form-control");
    $dataInputApellido = controlInput('usu_apellido', $valorApellido, 'Apellido', "required form-control");
    $dataInputCedula = controlInput('usu_identificacion', $valorIdentificacion, 'Documento de identidad', " form-control required number");
    $dataInputCelular = controlInput('usu_celular', $valorCelular, 'Célular', " form-control");
    $dataInputCorreo = controlInput('usu_correo', $valorCorreo, 'Correo electrónico', "required email form-control");
    $dataInputContrasena = controlInput('usu_contrasena', "", 'Contrasena', "required pass form-control");
    $dataTipo = controlSelect($dataRolUsuario, "usu_rol_id", "usu_rol_nombre");
    $dataSelectedTipo = array($valorRolUsuario);

    $dataEstados = controlSelect();
    $dataSelectedEstados = array($valorEstado);
    ?>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <?php if ($editar == 0) : ?>
                <li class="active"><a href="#uno" data-toggle="tab"><i class="fa fa-camera"></i> Regístros Actuales</a></li>
            <?php else: ?>
                <li><a href="<?php echo base_url($this->uri->segment(1)) ?>"><i class="fa fa-arrow-left"></i> Regresar</a></li>
            <?php endif; ?>
            <li <?php
            if ($editar == 1):
                echo 'class="active" ';
            endif;
            ?>>
                <a href="#dos" data-toggle="tab"><i class="fa fa-camera-retro"></i>
                    <?php
                    $data = 'Crear';
                    if ($editar == 1):
                        $data = 'Editar';
                    endif;
                    echo $data;
                    ?>  usuario
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane <?php if ($editar == 0): ?> active <?php endif ?>" id="uno">
                <section class="col-lg-12 connectedSortable">                            
                    <div class="box box-solid box-success">
                        <div class="box-body table-responsive">
                            <?php if ($Registros != NULL): ?>

                                <table id="table_general" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Estado</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($Registros as $itemRol):
                                            echo ' 
                                <tr>             
                                    <td> ' . $itemRol->pro_nombre . ' </td>
                                    <td> ' . reemplazarEstado($itemRol->est_id) . ' </td>
                                    <td> <a href="' . base_url($this->uri->segment(1) . "/editarProducto/" . $itemRol->pro_id) . '"> Editar</a> </td>
                                </tr>
                            ';
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="callout callout-info">
                                    <h4>¡Atención!</h4>
                                    <p>Aún no existen registros aquí.</p>
                                </div>
                            <?php endif; ?>
                        </div><!-- /.box-body -->
                    </div><!-- /.box-body -->
                </section><!-- /.Left col -->
                <div class="clearfix"></div>
            </div><!-- /.tab-pane -->
            <div class="tab-pane <?php if ($editar == 1): ?> active <?php endif ?>" id="dos">
                <!-- inicio formulario -->
                <div class="col-lg-12">
                    <!-- Custom Tabs -->

                    <div class="tab-content">
                        <div class="tab-pane active" id="pro_info">
                            <?php
                            $dataAtributos = array(
                                'class' => 'formulario'
                            );

                            echo form_open($Action, $dataAtributos);
                            ?>

                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="box box-default box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Información General</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Identificacion</label>
                                            <?php echo form_input($dataInputCedula); ?>
                                        </div>
                                        <!-- text input -->
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <?php echo form_input($dataInputNombre); ?>
                                        </div>
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Apellido</label>
                                            <?php echo form_input($dataInputApellido); ?>
                                        </div>
                                        <!-- text input -->
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Celular</label>
                                            <?php echo form_input($dataInputCelular); ?>
                                        </div>
                                        <!-- text input -->
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Correo</label>
                                            <?php echo form_input($dataInputCorreo); ?>
                                        </div>
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <?php echo form_dropdown('est_id', $dataEstados, $dataSelectedEstados, 'class="required form-control"'); ?>
                                        </div>
                                        <!-- text input -->
                                        <div class="form-group">

                                            <?php echo form_hidden('pro_id', $valorId) ?>
                                            <?php echo form_submit('guardar', 'Guardar', 'class="btn btn-success"'); ?>
                                            <?php
                                            if ($valorId != NULL):
                                                ?>
                                                <a href="<?php echo base_url($this->uri->segment(1)); ?>" class="btn btn-danger"><i class="fa fa-close"></i> Cancelar</a>
                                                <?php
                                            endif;
                                            ?>
                                        </div>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div><!-- /.box -->

                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="box box-default box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Ingreso al sistema</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Username</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <?php echo form_input($dataInputCorreo); ?>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Contraseña</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                                <?php echo form_input($dataInputContrasena); ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.box -->
                        <div class="clearfix"></div>
                        <?php echo form_close() ?>


                    </div><!-- /.tab-pane -->

                </div><!-- nav-tabs-custom -->
            </div><!-- /.tab-pane -->
            <div class="clearfix"></div>
        </div><!-- /.tab-content -->
    </div><!-- /.tab-content -->
</div><!-- nav-tabs-custom -->
</div>






<?php
echo $footer;
