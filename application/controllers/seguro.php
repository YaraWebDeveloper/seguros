<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 * El siguiente controlador permitirá el manejo de las acciones para adminitrar
 * las Ocupaciones que se manejarán en el sistema. 
 *
 * @author YARA WEB Developer
 */
class Seguro extends Private_Controller {

    /**
     * Variable de tipo
     */
    public $tipoSeguro,
            $dataCiudad,
            $medioTran,
            $claseMerc,
            $dataTomador,
            $dataUsuario,
            $dataParametros,
            $do,
            $poliza,
            $valorAsegurado,
            $usd,
            $pesoBruto,
            $transpor,
            $fechaSalida,
            $observaciones,
            $tipoUsuario,
            $valorDolar

    ;

    /**
     * Constructor de la clase
     * @name Construct
     * @access public
     */
    public function __construct() {
        parent::__construct();
        $this->construccionSitio();
        //ciudad
        $this->ciudad = $this->obtenerData('accesorio_ciudad');
        //medio de transporte
        $this->medioTran = $this->obtenerData('accesorio_medio_transporte');
        //Accesorio clase mercancia
        $this->claseMerc = $this->obtenerData('accesorio_clase_mercancia');
        //Data Usuario
        $this->dataUsuario = $this->obtenerData('usuario', NULL, ['usu_id' => $this->user_id]);
        //data Tomador
        $this->dataTomador = $this->obtenerData('empresa', NULL, ['emp_id' => $this->dataUsuario[0]->emp_id]);
        //Tipo de usuario
        $this->tipoUsuario = $this->obtenerData('accesorio_tipo_usuario', NULL, ['tip_usu_id' => $this->dataUsuario[0]->tip_usu_id]);
        //tipo seguro
        $this->tipoSeguro = $this->obtenerData('accesorio_tipo_seguro', NULL, ['tip_seg_id' => $this->tipoUsuario[0]->tip_seg_id]);
        //Data Aseguradora
        $this->dataAsegurador = $this->obtenerData('accesorio_parametros', NULL, ['par_id =' => 1]);
        //Data Transportadora
        $this->transpor = $this->obtenerData('accesorio_transportadora');
        //VAlor Dolar
        $this->valorDolar = $this->obtenerData('accesorio_parametros', NULL, ['par_key' => 'val_dolar'])[0]->par_value;
    }

    /**
     * Funcion de index
     * 
     */
    public function index($nCerificado = NULL) {
        $this->dataSend['valorMensaje'] = NULL;
        $this->dataSend['Action'] = base_url($this->uri->segment(1) . "/crearSeguro");
        $this->dataSend['redirect'] = $nCerificado;
        //llamar a la vista
        $this->load->view('seguro/seguro_view', $this->dataSend);
    }

    /**
     * Funcion para crear seguro
     */
    public function crearSeguro() {
        //Select
        $nPoliza = sizeof($this->obtenerData('seguro')) + 1;
        $nCerificado = uniqid('berk_');
        //Funcion para generar seguro
        $arrayCreacion = [
            'seg_fecha_creacion' => date('Y-m-d H:i:s'),
            'seg_fecha_salida' => $this->input->post('seg_fecha_salida'),
            'seg_poliza' => $nPoliza,
            'seg_certificado' => $nCerificado,
            'seg_do' => $this->input->post('seg_do'),
            'seg_valor_asegurado' => $this->tipoSeguro[0]->tip_seg_valor,
            'seg_usd' => round($this->tipoSeguro[0]->tip_seg_valor / $this->valorDolar, 2),
            'seg_observaciones' => $this->input->post('seg_observaciones'),
            'cla_mer_id' => $this->input->post('cla_mer_id'),
            'ciu_id_origen' => $this->input->post('ciu_id_origen'),
            'ciu_id_destino' => $this->input->post('ciu_id_destino'),
            'med_tra_id' => $this->input->post('med_tra_id'),
            'emp_id' => $this->input->post('med_tra_id'),
            'med_tra_id' => $this->dataTomador[0]->emp_id,
            'est_id' => 1,
            'est_id' => 1,
            'tip_seg_id' => $this->tipoSeguro[0]->tip_seg_id,
            'usu_id' => $this->user_id,
            'tra_id' => $this->input->post('tra_id'),
            'seg_peso_bruto' => $this->input->post('seg_peso_bruto')
        ];
        //Agregar al crud model
        if ($this->crud_model->agregarRegistro('seguro', $arrayCreacion)):
            //REdireccionar
            $this->index($nCerificado);
        endif;
    }

    /**
     * Funcion para generar pdf
     */
    public function generarPDF($pId = NULL) {
        //Colums
        $colums = 'tomadora.emp_nombre as tom_nombre, tomadora.emp_nit as tom_nit, tomadora.emp_nit as tom_nit,'
                . 'tomadora.emp_direccion as tom_direccion, usu_nombre, usu_apellido, tra_nombre, tra_nit,'
                . 'seg_poliza, seg_valor_asegurado, seg_certificado, seg_do, seg_fecha_salida, seg_observaciones, seg_peso_bruto,'
                . 'cla_mer_nombre, ciudes.ciu_nombre as ciu_destino, ciuor.ciu_nombre as ciu_origen, med_tra_nombre';

        //VErificar si funcion pdf
        if ($pId):
            //Seleecionar la poliza
            $array = [
                'dataTable' => "seguro",
                'dataColumns' => $colums,
                'dataWhere' => ['seg_certificado' => $pId],
                'dataJoin' => [
                    ['table' => 'empresa as tomadora', 'compare' => 'tomadora.emp_id = seguro.emp_id', 'method' => 'inner'],
                    ['table' => 'accesorio_clase_mercancia as mer', 'compare' => 'mer.cla_mer_id = seguro.cla_mer_id', 'method' => 'inner'],
                    ['table' => 'accesorio_transportadora as trans', 'compare' => 'trans.tra_id = seguro.tra_id', 'method' => 'inner'],
                    ['table' => 'usuario as gen', 'compare' => 'gen.usu_id = seguro.usu_id', 'method' => 'inner'],
                    ['table' => 'accesorio_ciudad as ciuor', 'compare' => 'ciuor.ciu_id = seguro.ciu_id_origen', 'method' => 'inner'],
                    ['table' => 'accesorio_ciudad as ciudes', 'compare' => 'ciudes.ciu_id = seguro.ciu_id_destino', 'method' => 'inner'],
                    ['table' => 'accesorio_medio_transporte as med', 'compare' => 'med.med_tra_id = seguro.med_tra_id', 'method' => 'inner'],
                ]
            ];
            //Obtener los adatos
            $seguros = $this->crud_model->obtenerRegistrosFull($array);
            //Ver datos
            //var_dump($seguros);
            //Cargar vista
            $this->load->view('seguro/pdf_view', ['data' => $seguros[0]]);
        endif;
    }

}
