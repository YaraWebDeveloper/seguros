<?php echo $header ?>

<div class="page-header">
    <h1>Usuarios <small>Administración</small></h1>
</div>
<?php
mensaje(validation_errors());
//verficar que los mensajes no vengan vacíos
if ($valorMensaje != NULL):
    //escribo el mensaje que se envio.
    mensaje($valorMensaje, $valorTipoMensaje);
endif; //fin de verificacion de mensajes 
?>
<div id="myTabContent" class="tab-content">
    <?php if ($Registros != NULL) { ?>
        <div class="tab-pane fade in active" id="unoa">
            <?php if ($Registros != ' ') { ?>
                <h2>Listado Actual</h2>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Estado</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($Registros as $itemUsuario):
                            echo ' 
                                    <tr>
                                        <td> ' . $itemUsuario->usu_nombre . ' ' . $itemUsuario->usu_apellido . ' </td>
                                        <td> ' . reemplazarEstado($itemUsuario->est_id) . ' </td>
                                        <td> <a href="' . base_url("usuario/editarUsuario/" . $itemUsuario->usu_id) . '">Editar</a> </td>
                                    </tr>
                                    ';
                        endforeach;
                        ?>
                    </tbody>
                </table>             
            <?php }else if ($Registros == ' ') { ?>
                <p>Aún no existe ningún registro para esta sección</p>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="tab-pane fade" id="dosa">
         <?php
         $inputDisable = false;
         if ($Registros == NULL):
             $inputDisable = true;
         endif;
         $dataInputNombre = controlInput('usu_nombre', $valorNombre, 'Nombre', "required form-control");
         $dataInputApellido = controlInput('usu_apellido', $valorApellido, 'Apellido', "required form-control");
         $dataInputCedula = controlInput('usu_documento', $valorCedula, 'Documento de identidad', " form-control required number", $inputDisable);
         $dataInputTelefono = controlInput('usu_telefono', $valorTelefono, 'Teléfono', " form-control");
         $dataInputCelular = controlInput('usu_celular', $valorCelular, 'Célular', " form-control");
         $dataInputCorreo = controlInput('usu_correo', $valorCorreo, 'Correo electrónico', "required email form-control", $inputDisable);
         $dataInputContrasena = controlInput('usu_contrasena', "", 'Contrasena', "required pass form-control", $inputDisable);
         $dataTipo = controlSelect($dataRolUsuario, "usu_rol_id", "usu_rol_nombre");
         $dataSelectedTipo = array($valorRolUsuario);
         $dataEstados = controlSelect();
         $dataSelectedEstados = array($valorEstado);
         ?>
        <!-- inicio formulario -->
        <h2>Administrar Usuario</h2>
        <?php
        $dataAtributos = array(
            'class' => 'formulario form_contrasena'
        );

        echo form_open($Action, $dataAtributos);
        ?>
        <table class="table table-condensed table-striped">
            <tr>
                <td style="width: 220px" class="align-right"><?php echo form_label('Nombre', 'lab_usu_nombre'); ?></td>
                <td>
                    <?php echo form_input($dataInputNombre); ?>
                </td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Apellido', 'lab_usu_apellido'); ?></td>
                <td>
                    <?php echo form_input($dataInputApellido); ?>
                </td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Tipo de Documento', 'lab_tip_doc_id'); ?></td>
                <td><?php //echo form_dropdown('tip_doc_id', array('0' => 'Choose a category...') + $dataTipoDoc, '0', 'disabled="disabled",class="required input-xlarge');                    ?>
                    <?php echo form_dropdown('tip_doc_id', $dataTipoDoc, $dataSelectTipoDoc, 'class="required input-xlarge"'); ?></td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Teléfono', 'lab_usu_telefono'); ?></td>
                <td>
                    <?php echo form_input($dataInputTelefono); ?>
                </td>
            </tr> 
            <tr>
                <td class="align-right"><?php echo form_label('Célular', 'lab_usu_celular'); ?></td>
                <td>
                    <?php echo form_input($dataInputCelular); ?>
                </td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Email', 'lab_usu_correo'); ?></td>
                <td>
                    <?php echo form_input($dataInputCorreo); ?>
                </td>
            </tr> 
            <?php if ($Registros != NULL): ?>
                <tr>
                    <td class="align-right"><?php echo form_label('Contraseña', 'lab_usu_contrasena'); ?></td>
                    <td>
                        <?php echo form_password($dataInputContrasena); ?>
                        <div id="pswd_info">
                            <h4>La contraseña debería cumplir con los siguientes requerimientos:</h4>
                            <ul>
                                <li id="letter"><i aria-hidden="true"></i> Al menos debería tener <strong>una letra minúscula</strong></li>
                                <li id="special"> <i aria-hidden="true"></i> Debería tener carácteres especiales como <strong>@!#$%&?¿¡.</strong></li>
                                <li id="capital"><i aria-hidden="true"></i> Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                                <li id="number"><i aria-hidden="true"></i> Al menos debería tener <strong>un número</strong></li>
                                <li id="length"><i aria-hidden="true"></i> Debería tener más de <strong>8 carácteres</strong> como mínimo</li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <td class="align-right"><?php echo form_label('Rol del usuario', 'lab_rol_usu_id'); ?></td>
                <td><?php echo form_dropdown('usu_rol_id', $dataTipo, $dataSelectedTipo, 'class="required input-xlarge"'); ?></td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Estado', 'lab_est_id'); ?></td>
                <td><?php echo form_dropdown('est_id', $dataEstados, $dataSelectedEstados, 'class="required input-xlarge"'); ?></td>
            </tr>
            <tr>
                <td><?php echo form_hidden('usu_id', $valorId) ?></td>
                <td><?php echo form_submit('guardar', 'Guardar'); ?></td>
            </tr>
        </table>
        <?php echo form_close() ?>
        <!-- fin formulario -->   

        <!-- fin validaciones -->
    </div>
    <!--<div class="tab-pane fade" id="dropdown1">
      <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
    </div> -->
    <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/securepass.js"></script>
    <script type="text/javascript">
        $('.form_contrasena').validate({
            rules: {
                usu_contrasena: {
                    minlength: 8,
                    securePass: true
                }
            },
            messages: {
                usu_contrasena: {
                    minlength: "",
                    securePass: ""
                }
            }
        });
    </script>
</div>    

<div class="col-md-12">
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
                                            <label>Nombre</label>
                                            <?php echo form_input($dataInputNombre); ?>
                                        </div>
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Apellido</label>
                                            <?php echo form_input($dataInputApellido); ?>
                                        </div>
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Recomendaciones</label>
                                            <?php echo form_textarea($dataRec); ?>
                                        </div>
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <?php echo form_dropdown('est_id', $dataEstados, $dataSelected, 'class="required form-control"'); ?>
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
                                        <h3 class="box-title">Origen, Precio y venta</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>País de origen</label>
                                            <?php echo form_dropdown('pai_id', $dataPais, $valorPais, 'class="required form-control mselect select2" style="width: 100%;"'); ?>
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Precio</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                <?php echo form_input($dataPrecio); ?>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Precio con descuento</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                                <?php echo form_input($dataPrecioDesc); ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Código</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                                                <?php echo form_input($dataCodigo); ?>
                                            </div>
                                        </div>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div><!-- /.box -->

                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="box box-default box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Marca y tipo de producto</h3>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <?php echo form_dropdown('mar_id', $dataMarca, $valorMarca, 'class="required form-control mselect select2" style="width: 100%;"'); ?>
                                        </div>

                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Categoría</label>
                                            <?php echo form_dropdown('cat_id', $dataCategoria, $valorCategoria, 'class="required form-control mselect select2" style="width: 100%;"'); ?>
                                        </div>

                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Tipo Subcategoría</label>
                                            <?php echo form_dropdown('sub_cat_tip_id', $dataTipSubCat, $valorTiposubcategoria, 'class="required form-control mselect select2" style="width: 100%;"'); ?>
                                        </div>

                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Subcategoría</label>
                                            <?php echo form_dropdown('sub_cat_id', $dataSubCat, $valorSubcategoria, 'class="required form-control mselect select2" style="width: 100%;"'); ?>
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
