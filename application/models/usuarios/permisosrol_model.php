<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modulos
 *
 * @author jucactru
 */
class Permisosrol_model extends CI_Model {

    //constructor
    public function __construct() {
        parent::__construct();
    }

//fin del constructor

    /*
     * -------------------------------------------------------
     *  Método para obtener los datos del usuario 
     * ------------------------------------------------------- 
     */

    public function eliminarPermisos($pIdRol) {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //preparo el arreglo de la condición where
        $dataWhere = array(
            'usu_rol_id' => $pIdRol
        );
        //ejecuto la consulta
        $eliminar = $this->db->delete('modulo_acceso', $dataWhere);
        //verificamos que se haya efectuado la consulta
        if($eliminar > 0):
            $valorRetorno = TRUE;
        endif;
        //devuelvo el valor retorno
        return $valorRetorno;
    }

//fin del metodo
    
    /*--------------------------------------------------------------------------
     * Método para obtener los roles
     * 
     */
}

//fin de la clase
