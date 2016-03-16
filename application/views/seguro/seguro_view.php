<?php
echo $header;
//Title box 1, caso si es generadora
$dataTitleBx1 = 'Generadora';
$dataTitleBx2 = 'Transportadora';
//CAmpos del bpox 1
$dataNombre = $this->dataEmpresa[0]->emp_nombre;
$dataValNit = $this->dataEmpresa[0]->emp_nit;
$dataDirecc = $this->dataEmpresa[0]->emp_direccion;

//Datos de la empresa sobrante
$dataEmp = $this->empTranspor;
$dataName = 'emp_id_tran';


if ($this->dataEmpresa[0]->tip_seg_id == 3):
    $dataName = 'emp_id_gen';
    $dataEmp = $this->empGene;
    $dataTitleBx1 = 'Transportadora';
    $dataTitleBx2 = 'Generadora';
endif;


//VAlores no editables
//transportadora
$dataEmpR = form_dropdown($dataName, controlSelect($dataEmp, 'emp_id', 'emp_nombre'), NULL, 'class="form-control"');
$dataInpNom = controlInput('', $dataNombre, 'Nit', 'form-control disabled', TRUE);
$dataNit = controlInput('', $dataValNit, 'Nit', 'form-control disabled', TRUE);
$dataDireccion = controlInput('', $dataDirecc, 'Direccion', 'form-control disabled', TRUE);
$dataTomador = controlInput('', strtoupper($this->dataTomador[0]->emp_nombre), 'Tomador', 'form-control disabled', TRUE);
$dataAseguradora = controlInput('', strtoupper($this->dataAsegurador[0]->par_value), 'Tomador', 'form-control disabled number', TRUE);


//Editables
$dataDo = controlInput('seg_do', $this->do, 'D.O', 'form-control disabled');
$dataPesoBruto = controlInput('seg_peso_bruto', $this->pesoBruto, 'Peso bruto', 'form-control disabled');
$dataObservaciones = controlInput('seg_observaciones', $this->observaciones, 'Observaciones', 'form-control disabled');
$dataValor = controlInput('seg_valor_asegurado', NULL, 'Valor', 'form-control disabled');
$dataFechaSalid = controlInput('seg_fecha_salida', $this->fechaSalida, 'Facha Salida', 'form-control disabled');
$dataValorUsd = controlInput('seg_usd', NULL, 'Valor USD', 'form-control disabled', FALSE);


//Campos seleccionables
$dataMer = controlSelect($this->claseMerc, 'cla_mer_id', 'cla_mer_nombre');
$dataMedio = controlSelect($this->medioTran, 'med_tra_id', 'med_tra_nombre');
$dataCiudad = controlSelect($this->ciudad, 'ciu_id', 'ciu_nombre');







//atributos del formulario
$dataAtributos = array(
    'class' => 'formulario'
);
?>
<div class="page-header text-center">

    <h1>
        CONSTANCIA DE SEGURO A LA CARGA<br />
        <small><?php echo $this->tipoSeguro[0]->tip_seg_nombre ?></small>
    </h1>
</div>
<?php if ($redirect != NULL): ?>
    <script>
        setTimeout(
                function OpenInNewTab() {
                    var win = window.open('<?php echo base_url($this->uri->segment(1) . "/generarPDF/$redirect"); ?>', '_blank');
                    win.focus();
                }, 300);
    </script>
<?php endif; ?>
<?php
echo mensaje(validation_errors());

//verficar que los mensajes no vengan vacíos
if ($valorMensaje != NULL):
    //escribo el mensaje que se envio.
    echo $valorMensaje;
endif; //fin de verificacion de mensajes 

echo form_open($Action, $dataAtributos);
?>
<div class="col-md-6">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Información General</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <!-- text input -->
                <div class="form-group">
                    <label>Tomador</label>
                    <?php echo form_input($dataTomador); ?>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Aseguradora</label>
                    <?php echo form_input($dataAseguradora); ?>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>D.O.</label>
                    <?php echo form_input($dataDo); ?>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.box -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Informacion de mercancia</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <!-- text input -->
                <div class="form-group">
                    <label>Clase de mercancia</label>
                    <?php echo form_dropdown('cla_mer_id', $dataMer, NULL, 'class="form-control"'); ?>
                    <div class="clearfix"></div>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Valor asegurado</label>
                    <?php echo form_input($dataValor); ?>
                    <div class="clearfix"></div>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Valor USD</label>
                    <?php echo form_input($dataValorUsd); ?>
                    <div class="clearfix"></div>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Peso bruto</label>
                    <?php echo form_input($dataPesoBruto); ?>
                    <div class="clearfix"></div>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Fecha Salida</label>
                    <?php echo form_input($dataFechaSalid); ?>
                    <div class="clearfix"></div>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Medio de transporte</label>
                    <?php echo form_dropdown('med_tra_id', $dataMedio, NULL, 'class="form-control required"'); ?>
                    <div class="clearfix"></div>
                </div>

            </div>

        </div><!-- /.box-body -->
    </div><!-- /.box -->

</div><!-- /.box -->


<!-- Tenencio -->
<div class="col-md-6">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $dataTitleBx1; ?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <!-- text input -->
                <div class="form-group">
                    <label>Nombre</label>
                    <?php echo form_input($dataInpNom); ?>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>NIT</label>
                    <?php echo form_input($dataNit); ?>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Dirección</label>
                    <?php echo form_input($dataDireccion); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $dataTitleBx2; ?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <!-- text input -->
                <div class="form-group">
                    <label>Nombre</label>
                    <?php echo $dataEmpR; ?>
                    <div class="clearfix"></div>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Ciudad origen</label>
                    <?php echo form_dropdown('ciu_id_origen', $dataCiudad, NULL, 'class="form-control"'); ?>
                    <div class="clearfix"></div>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Ciudad destino</label>
                    <?php echo form_dropdown('ciu_id_destino', $dataCiudad, NULL, 'class="form-control"'); ?>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-default box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Observaciones</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <!-- text input -->
                <div class="form-group">
                    <?php echo form_textarea($dataObservaciones, NULL, 'class="form-control"') ?>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.box -->

<div class="col-md-12">
    <div class="col-md-10"></div>
    <!-- text input -->
    <?php //echo form_hidden('pro_id', $valorId) ?>
    <?php echo form_submit('guardar', 'Guardar', 'class="btn btn-success col-md-2"'); ?>
</div>



<div class="clearfix"></div>
<?php echo form_close() ?>
<?php
echo $footer?>