<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('mensaje')) {

    function mensaje($pMensaje, $pTipo = "") {
        //si tipo viene vacío
        if ($pTipo == NULL):
            $pTipo = "alert-danger";
        endif;
        //valido que el mensaje no llegue vacio
        if ($pMensaje != '') {
            return '
            <!-- inicio mensaje -->
            <div class="col-lg-12"><div class="alert ' . $pTipo . ' alert-dismissable">
                <i class="fa fa-bullhorn"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                ' . $pMensaje . '
            </div></div>

            <!-- fin de mensaje -->
            ';
        }//fin del if
    }

}//fin de la función


if (!function_exists('reemplazarEstado')) {

    function reemplazarEstado($pIdEstado) {

        //creo el valor retorno
        $valorRetorno = 'Activo';
        if ($pIdEstado == 2) {
            $valorRetorno = 'Inactivo';
        }//fin del if
        //devolvemos el valor retorno
        return $valorRetorno;
    }

}//fin de la función

if (!function_exists('controlSelect')) {

    function controlSelect($pDataRegistros = NULL, $pCampoValue = NULL, $pCampoNombre = NULL) {

        //validamos el parámetro
        if ($pDataRegistros != NULL) {
            //iteramos el arreglo que llega
            $dataRegistros[''] = 'Seleccione una opción';
            foreach ($pDataRegistros as $filaRegistros):
                $dataRegistros[$filaRegistros->$pCampoValue] = $filaRegistros->$pCampoNombre;
            endforeach;
        }//fin del if
        else {
            $dataRegistros = array(
                '' => 'Estado',
                '1' => 'Activo',
                '2' => 'Inactivo',
            );
        }//fin del if else
        //devolvemos los datos
        return $dataRegistros;
    }

}//fin de la función

if (!function_exists('controlMultiSelect')) {

    function controlMultiSelect($pDataRegistros = NULL, $pCampoValue = NULL, $pCampoNombre = NULL) {

        //validamos el parámetro
        if ($pDataRegistros != NULL) {
            //iteramos el arreglo que llega
            foreach ($pDataRegistros as $filaRegistros):
                $dataRegistros[$filaRegistros->$pCampoValue] = $filaRegistros->$pCampoNombre;
            endforeach;
        }//fin del if
        //devolvemos los datos
        return $dataRegistros;
    }

}//fin de la función

if (!function_exists('controlInput')) {

    function controlInput($pNombre, $pValor, $pPlaceHolder, $pClase = "", $pDisabled = FALSE, $pMaxLength = 45) {
        $valorInput = array(
            'name' => $pNombre,
            'id' => $pNombre,
            'class' => "input-xlarge " . $pClase,
            'value' => $pValor,
            'maxlength' => $pMaxLength,
            'placeholder' => $pPlaceHolder,
            'placeholder' => $pPlaceHolder,
            'autocomplete' => 'off'
        );
        if ($pDisabled):
            $valorAdicional = array(
                //'disabled' => 'disabled'
                'readonly' => 'readonly',
            );
            $valorInput = array_merge((array) $valorInput, (array) $valorAdicional);
        endif;
        return $valorInput;
    }

}

if (!function_exists('getHoraExacta')) {

    function getHoraExacta() {
        $dateHora = date('Y-m-d H:i:s', strtotime("-6 hour", strtotime(date("H:i:s"))));
        return $dateHora;
    }

}


