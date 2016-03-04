<?php echo $header ?>
<?php
/* * Elemewntos PHP* */
$dataInput = controlInput('ocu_nombre', $valorNombre, 'Nombre Carrera/Ocupación', 'required form-control');
$dataTipo = controlSelect($dataTipo, 'tip_ocu_id', 'tip_ocu_nombre');
$dataSelectedTipo = array($valorTipo);
$dataEstados = controlSelect();
$dataSelected = array($valorEstado);
?>
<!-- Main row -->
<div class="row">
    <?php
    echo mensaje(validation_errors());
//verficar que los mensajes no vengan vacíos
    //escribo el mensaje que se envio.
    if (isset($valorMensaje)): echo $valorMensaje;
    endif;
    ?>
    <!-- Left col -->
    <?php
    $valorAgregar = "col-lg-7";
    if ($valorId == NULL):
        $valorAgregar = "col-lg-5";
        ?>
        <section class="col-lg-7 connectedSortable">                            
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

                                    <th>Carreras/Ocupación</th>
                                    <th>Tipo ocupación</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($Registros as $itemOcupacion):
                                    if (!isset($dataLock)):
                                        $valorEdicion = '<a href="' . base_url($this->uri->segment(1) . "/editarOcupacion/" . $itemOcupacion->ocu_id) . '">Editar</a>';
                                    else:
                                        $valorEdicion = "<a>Bloqueado</a>";
                                    endif;
                                    echo ' 
                                <tr>
                                    <td> ' . $itemOcupacion->ocu_nombre . ' </td>
                                    <td> ' . $itemOcupacion->tip_ocu_nombre . ' </td>
                                    <td> ' . reemplazarEstado($itemOcupacion->est_id) . ' </td>
                                    <td>' . $valorEdicion . '</td>
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
                        </div
                    <?php endif; ?>
                </div><!-- /.box-body -->
        </section><!-- /.Left col -->
    <?php endif; ?>
    <?php if (!isset($dataLock)): ?>
        <section class="<?php echo $valorAgregar; ?> connectedSortable">                            
            <div class="box box-solid box-warning">
                <div class="box-header">
                    <i class="fa  fa-pencil-square"></i>
                    <h3 class="box-title">Agregar/Editar</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php
                    $dataAtributos = array(
                        'class' => 'formulario'
                    );

                    echo form_open($Action, $dataAtributos);
                    ?>
                    <!-- text input -->
                    <div class="form-group">
                        <label>Nombre:</label>
                        <?php echo form_input($dataInput); ?>
                    </div>
                    <div class="form-group">
                        <label>Perteneciente a:</label>
                        <?php echo form_dropdown('tip_ocu_id', $dataTipo, $dataSelectedTipo, 'class="required form-control"'); ?>
                    </div>
                    <div class="form-group">
                        <label>Estado:</label>
                        <?php echo form_dropdown('est_id', $dataEstados, $dataSelected, 'class="required form-control"'); ?>
                    </div>
                    <div class="form-group">

                        <?php echo form_hidden('ocu_id', $valorId) ?>
                        <?php echo form_submit('guardar', 'Guardar', 'class="btn btn-success"'); ?>
                        <?php
                        if ($valorId != NULL):
                            ?>
                            <a href="<?php echo base_url('ocupacion'); ?>" class="btn btn-danger">Cancelar</a>
                            <?php
                        endif;
                        ?>
                    </div>
                    <?php echo form_close() ?>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </section><!-- /.Left col -->
    <?php endif; ?>
    <?php if (isset($valorUsuarioEdicion)): ?>
        <section class="col-lg-5 connectedSortable">                            
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa  fa-pencil-square"></i>
                    <h3 class="box-title">Información de Modificación</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="callout callout-info">
                        <h4>Fecha de Creación</h4>
                        <p><?= $valorCreacion; ?></p>
                    </div>
                    <div class="callout callout-info">
                        <h4>Fecha de Edición</h4>
                        <p><?= $valorEdicion; ?></p>
                    </div>
                    <div class="callout callout-info">
                        <h4>Último usuario que accesó</h4>
                        <p>
                            <b>Usurname: </b><?= $valorUsuarioEdicion ?>
                            <br />
                            <b>Nombre: </b><?= $valorNombreEdicion . " " . $valorApellidoEdicion ?>
                            <br />
                            <b>Contacto: </b><?= $valorCorreoEdicion ?>
                        </p>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </section><!-- /.Left col -->
    <?php endif; ?>
</div><!-- /.row (main row) -->
<?php
echo $footer;
