<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Listarequipo_library {

    protected $ci; //poder obtener recursos de codeigniter en librerias

    function __construct() {
        $this->ci = & get_instance(); //obtemgo las instancias
        $this->ci->load->helper('recursos'); //cargo el helper
    }

    /* -------------------------------------------------------------------------
     * controlador para construir el html de los equipos por empresa
     * -------------------------------------------------------------------------
     * Parametro
     * @dataGeneral | array | contiene el array de los equipos listados por
     * tipo y empresas
     * -------------------------------------------------------------------------
     * Retorno
     * @valorRetorno | retorna el html construido de los equipos por empresas
     */

    public function listarDatos($dataGeneral) {
        //variable de retorno
        $valorRetorno = '<div class="accordion" id="accordion2">';

        //iterar los datos
        foreach ($dataGeneral as $itemGeneral):
            $valorRetorno .= '<div class="accordion-group"> <div class="accordion-heading"> 
                       <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#' . $itemGeneral->emp_id . '">' . $itemGeneral->emp_razon_social . '</a>'
                    . '</div><div id="' . $itemGeneral->emp_id . '" class="accordion-body collapse"> <div class="accordion-inner">' . $this->listarTipo($itemGeneral->tipoEquipos, $itemGeneral->emp_id)
                    . '</div></div></div>';
        endforeach;

        //fin de la variable retorno
        $valorRetorno .= "</div>";
        return $valorRetorno;
    }

    //fin del controlador


    /* -------------------------------------------------------------------------
     * controlador para construir el html de los equipos por tipo
     * -------------------------------------------------------------------------
     * Parametro
     * @dataTipo | array | contiene el array de los equipos organizados por tipo
     * de equipo
     * @dataEmpresa | int | id de la empresa a la que se le listan los equipo
     * -------------------------------------------------------------------------
     * Retorno
     * @valorRetorno | retorna el html construido de los equipos por tipos
     */
    public function listarTipo($dataTipo, $dataEmpresa) {
        //valor Retorno
        $valorRetorno = '<div class="accordion" id="accordionTipoEquipo_' . $dataEmpresa . '">';
        //iterar los datos
        foreach ($dataTipo as $itemTipo) {
            $valorRetorno .= '<div class="accordion-group"><div class="accordion-heading">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTipoEquipo_' . $dataEmpresa . '" href="#' . $dataEmpresa . $itemTipo->tip_equ_id . '">' . $itemTipo->tipo_equipo
                    . '</a></div><div id="' . $dataEmpresa . $itemTipo->tip_equ_id . '" class="accordion-body collapse"><div class="accordion-inner">' . $this->listarEquipo($itemTipo->equipos)
                    . '</div></div></div>';
            //$valorRetorno .= "<li>" . $itemTipo->tipo_equipo . $this->listarEquipo($itemTipo->equipos) . "</li>"; //iterar los tipo
        }

        $valorRetorno .= "</div>"; //cierro el div

        return $valorRetorno; //Devolver valor
    }

    /* -------------------------------------------------------------------------
     * controlador para construir el html de los equipos
     * -------------------------------------------------------------------------
     * Parametro
     * @dataEquipo | array | contiene el array de los equipos
     * -------------------------------------------------------------------------
     * Retorno
     * @valorRetorno | retorna el html construido de los equipos por tipos
     */

    public function listarEquipo($dataEquipo) {
        //valorRetorno
        $valorRetorno = '
            <table class="table table-condensed table-striped">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Tipo de Equipo</th>
                        <th>Estado</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>';
        //iterar datos y guardarlos en una tabla
        foreach ($dataEquipo as $itemEquipo) {
            $valorRetorno .= '<tr>'
                    . '<td>' . $itemEquipo->equ_codigo . '</td>'
                    . '<td>' . $itemEquipo->tipo_equipo . '</td>'
                    . '<td>' . reemplazarEstado($itemEquipo->est_id) . '</td>'
                    . '<td><a href="' . base_url('equipo/detalleEquipo') . "/" . $itemEquipo->equ_id . '">Detalles</a></td>'
                    . '</tr>';

            //$valorRetorno .= "<li>" . $itemEquipo->equ_codigo . "</li>"; //iterar los tipo
        }
        //valor Retorno
        $valorRetorno .= "</table>";
        return $valorRetorno;
    }

    //fin del controlador
}
