<?php
echo $header;

echo mensaje(validation_errors());

//verficar que los mensajes no vengan vacíos
if ($valorMensaje != NULL):
    //escribo el mensaje que se envio.
    echo $valorMensaje;
endif; //fin de verificacion de mensajes 
?>
<div class="col-md-8">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <?php if ($editar == 0) : ?>
                <li class="active"><a href="#uno" data-toggle="tab"><i class="fa fa-male"></i> Roles Activos</a></li>
            <?php else: ?>
                <li><a href="<?php echo base_url($this->uri->segment(1)) ?>"><i class="fa fa-arrow-left"></i> Regresar</a></li>
            <?php endif; ?>
            <?php if ($editar == 1): ?>
                <li class="active"><a href="#dos" data-toggle="tab"><i class="fa fa-user-plus"></i> Asignar Permisos</a></li>
            <?php endif; ?>
        </ul>
        <div class="tab-content">
            <div class="tab-pane <?php if ($editar == 0): ?> active <?php endif ?>" id="uno">
                <section class="col-lg-12 connectedSortable">                            
                    <div class="box box-solid box-success">
                        <div class="box-header">
                            <i class="fa  fa-ticket"></i>
                            <h3 class="box-title"> Registros Actuales</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <?php if ($Registros != NULL): ?>

                                <table id="table_general" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Rol</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($Registros as $itemRol):
                                            echo ' 
                                <tr>             
                                    <td> ' . $itemRol->usu_rol_nombre . ' </td>
                                    <td> <a href="' . base_url($this->uri->segment(1) . "/editarPermisoRol/" . $itemRol->usu_rol_id) . '"> Editar</a> </td>
                                </tr>
                            ';
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="callout callout-warning">
                                    <h4>¡Atención!</h4>
                                    <p>No se encontrarón registros exitentes o activos,por favor
                                        <a href="<?php echo base_url('rol'); ?>">ingresa aquí</a>
                                        .</p>
                                </div>
                            <?php endif; ?>
                        </div><!-- /.box-body -->
                </section><!-- /.Left col -->
                <div class="clearfix"></div>
            </div><!-- /.tab-pane -->
            <div class="tab-pane <?php if ($editar == 1): ?> active <?php endif ?>" id="dos">
                <!-- inicio formulario -->
                <div class="col-lg-12">    
                    <?php
                    $dataAtributos = array(
                        'class' => 'formulario'
                    );

                    //Array del form
                    $dataModulos = controlMultiSelect($dataModulos, 'mod_id', 'mod_nombre');
                    if ($dataPermisos == NULL):
                        //si están vacios, envío un array con las 2 primeras posicisiones en ceros
                        $dataPermisos = array('0' => '0', '1' => '0');
                    else:
                        if (sizeof($dataPermisos) <= 1):
                            $dataPermisos = array_merge($dataPermisos, [1 => (object) ["mod_id" => "0"]]);
                        endif;
                        $dataPermisos = controlMultiSelect($dataPermisos, 'mod_id', 'mod_id');
                    endif;
                    echo form_open($Action, $dataAtributos);
                    ?>
                    <?php
                    $dataConfirmar = array(
                        'name' => 'comprobar',
                        'id' => 'comp',
                        'value' => 'Comprobar Roles',
                        'class' => 'required'
                    );
                    ?>
                    <div class="form-group">
                        <?php echo form_dropdown('permisos[]', $dataModulos, $dataPermisos, 'id="first" class="form-control required"') ?>
                        <?php echo form_hidden('mar_id', $valorId) ?>
                    </div>

                    <div class="form-group">

                        <?php echo form_checkbox($dataConfirmar) ?> 
                        Confirmar permisos de rol
                    </div>
                    <div class="form-group">
                        <?php echo form_hidden('usu_rol_id', $valorId) ?></td>
                        <?php echo form_submit('guardar', 'Guardar', 'class="btn btn-success right"'); ?></td>
                    </div>
                    <?php echo form_close() ?>
                </div><!-- /.tab-pane -->
                <div class="clearfix"></div>
            </div><!-- /.tab-content -->
        </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->
</div>
<div class="col-md-4">
    <div class="box box-info">
        <div class="box-header">
            <i class="fa fa-bullhorn"></i>
            <h3 class="box-title">¿Qué es?</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="callout callout-info">
                <h4>¡Asignar permisos de administración!</h4>
                <p>
                    Puedes asignar permisos a distintos roles. 
                    Así controlas que hace cada uno de los usuarios y que puede o no
                    hacer en est[a plataforma.
                </p>
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.col -->



<?php echo $footer ?>        