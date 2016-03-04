<?php echo $header ?>

<div class="page-header">
    <h1>Actualización <small>Contraseña</small></h1>
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
    <li class="active"><a href="#uno" data-toggle="tab">Actualizar mis datos</a></li>
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

        $dataInputContrasenaActual = controlInput('usu_actual_contrasena', $valorPass, 'Contraseña Actual', "required", $inputDisable);
        $dataInputContrasenaNueva = controlInput('usu_contrasena', $valorPass, 'Nueva Contrasena', "required pass", $inputDisable);
        $dataInputConfirmarContrasena = controlInput('usu_confirmar_contrasena', $valorPass, 'Confirme Nueva Contrasena', "required", $inputDisable);
        ?>
        <!-- inicio formulario -->
        <h2>Actualizar Contraseña</h2>
        <?php
        $dataAtributos = array(
            'class' => 'formulario form_contrasena'
        );

        echo form_open($Action, $dataAtributos);
        ?>
        <table class="table table-condensed table-striped">  
            <tr>
                <td class="align-right"><?php echo form_label('Actual Contraseña', 'lab_usu_act_contrasena'); ?></td>
                <td>
<?php echo form_password($dataInputContrasenaActual); ?>
                </td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Nueva Contraseña', 'lab_usu_contrasena'); ?></td>
                <td>
<?php echo form_password($dataInputContrasenaNueva); ?> <i id="pass_input_est" aria-hidden="true"></i> 
                    <div id="pswd_info">
                        <h4>La contraseña debería cumplir con los siguientes requerimientos:</h4>
                        <ul>
                            <li id="letter"><i aria-hidden="true"></i> Al menos debería tener <strong>una letra minúscula</strong></li>
                            <li id="special"> <i aria-hidden="true"></i> Debería tener carácteres especiales como <strong>@!#$%&?¿¡.</strong></li>
                            <li id="capital"><i aria-hidden="true"></i> Al menos debería tener <strong>una letra en mayúsculas</strong></li>
                            <li id="number"><i aria-hidden="true"></i> Al menos debería tener <strong>un número</strong></li>
                            <li id="length"><i aria-hidden="true"></i> Debería tener más de <strong>8 caractéres</strong> como mínimo</li>
                        </ul>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="align-right"><?php echo form_label('Confirmar nueva Contraseña', 'lab_usu_confirmar_contrasena'); ?></td>
                <td>
<?php echo form_password($dataInputConfirmarContrasena); ?>
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
    <script type="text/javascript" src="<?php echo base_url("themes") ?>/general/scripts/securepass.js"></script>
    <script type="text/javascript">
        $('.form_contrasena').validate({
            rules: {
                usu_contrasena: {
                    minlength: 8,
                    securePass: true
                },
                usu_confirmar_contrasena: {
                    equalTo: '#usu_contrasena'
                }
            },
            messages: {
                usu_contrasena: {
                    minlength: "",
                    securePass: ""
                },
                usu_confirmar_contrasena: {
                    equalTo: 'Las contraseñas no coinciden.'
                }
            }
        });
    </script>
</div>    





<?php echo $footer ?>        