<?php echo $header ?>
<div class="page-header">
    <h1>Marcas <small>Administración</small></h1>
</div>
<?php
mensaje(validation_errors());
//verficar que los mensajes no vengan vacíos
if ($valorMensaje != NULL):
    //escribo el mensaje que se envio.
    mensaje($valorMensaje, $valorTipoMensaje);
endif; //fin de verificacion de mensajes
?>
<ul id="myTab" class="nav nav-tabs">
    <?php if ($Registros != NULL && $Registros != '') { ?>
        <li class="active"><a href="#uno" data-toggle="tab">Regístros Actuales</a></li>
    <?php } else { ?>
        <li><a href="<?php echo base_url($this->uri->segment(1)) ?>">Regresar</a></li>
    <?php } ?>
    <li <?php
    if ($Registros == NULL) {
        echo 'class="active"';
    }
    ?>><a href="#dos" data-toggle="tab">Agregar Regístro</a></li>
    <!--<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
            <li><a href="#dropdown2" data-toggle="tab">@mdo</a></li>
        </ul>
    </li> -->
</ul>
<div id="myTabContent" class="tab-content">
    <?php if ($Registros != NULL) { ?>
        <div class="tab-pane fade in active" id="uno">
            <?php if ($Registros != ' ') { ?>
                <h2>Listado Actual</h2>
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>Marcas</th>
                            <th>Estado</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($Registros as $itemMarca):
                            echo ' 
                                <tr>           
                                    <td> ' . $itemMarca->mar_nombre . ' </td>
                                    <td> ' . reemplazarEstado($itemMarca->est_id) . ' </td>
                                    <td> <a href="' . base_url($this->uri->segment(1) . "/editarMarca/" . $itemMarca->mar_id) . '">Editar</a> </td>
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
    <div class="tab-pane fade <?php
    if ($Registros == NULL) {
        echo 'in active';
    }
    ?>" id="dos">
         <?php
         $dataInput = controlInput('mar_nombre', $valorNombre, 'Marca', 'required');
         $dataEstados = controlSelect();
         $dataSelected = array($valorEstado);
         ?>
        <!-- inicio formulario -->
        <h2>Administrar Marca</h2>
        <?php
        $dataAtributos = array(
            'class' => 'formulario'
        );

        echo form_open($Action, $dataAtributos);
        ?>
        <table class="table table-condensed table-striped">
            <tr>
                <td class="align-right"><?php echo form_label('Marca', 'lab_mar_nombre'); ?></td>
                <td><?php echo form_input($dataInput); ?></td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Estado', 'lab_est_id'); ?></td>
                <td><?php echo form_dropdown('est_id', $dataEstados, $dataSelected, 'class="required input-xlarge"'); ?></td>
            </tr>
            <tr>
                <td><?php echo form_hidden('mar_id', $valorId) ?></td>
                <td><?php echo form_submit('guardar', 'Guardar'); ?></td>
            </tr>
        </table>
        <?php echo form_close() ?>
        <!-- fin formulario -->                            
    </div>
    <!--<div class="tab-pane fade" id="dropdown1">
      <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
    </div> -->
</div>    





<?php echo $footer ?>        