<?php echo $header ?>

<div class="page-header">
    <h1>Perfil <small>Administración</small></h1>
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
    <li class="active"><a href="#uno" data-toggle="tab">Mis Datos</a></li>
    <!--<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
            <li><a href="#dropdown2" data-toggle="tab">@mdo</a></li>
        </ul>
    </li> -->
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="uno">
        <?php
        $inputDisable = false;

        $dataInputNombre = controlInput('usu_nombre', $valorNombre, 'Nombre', "required");
        $dataInputApellido = controlInput('usu_apellido', $valorApellido, 'Apellido', "required");
        $dataInputTelefono = controlInput('usu_telefono', $valorTelefono, 'Teléfono');
        $dataInputCelular = controlInput('usu_celular', $valorCelular, 'Célular');
        $dataInputCorreo = controlInput('usu_correo', $valorCorreo, 'Correo electrónico', "required email", $inputDisable);
        $dataInputContrasena = controlInput('usu_contrasena', $valorPass, 'Contrasena', "", $inputDisable);
        $dataInputConfirmarContrasena = controlInput('usu_confirmar_contrasena', $valorPass, 'Contrasena', "", $inputDisable);
        ?>
        <!-- inicio formulario -->
        <h2>Actualizar mis datos</h2>
        <?php
        $dataAtributos = array(
            'class' => 'formulario'
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
            <tr>
                <td><?php echo form_hidden('usu_id', $valorId) ?></td>
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