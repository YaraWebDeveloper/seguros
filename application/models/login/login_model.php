<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author jucactru
 */
class Login_model extends CI_Model {

    //constructor
    public function __construct() {
        parent::__construct();
    }

//fin del constructor

    /*
     * -------------------------------------------------------
     *  Método para obtener los datos del usuario 
     * ------------------------------------------------------- 
     * Párametros
     * No tiene variables de parámetros
     * ------------------------------------------------------
     * Retorno
     * @valorRetorno | arreglo | Si se encuentran resultados en la base de datos.
     */

    public function consultarDatos() {
        //creo la variable de retotno
        $valorRetorno = null;
        //preparo el arreglo de la condición where
        /* $dataUsuario = array(
          'usu_documento' => $this->input->post('text_user', TRUE),
          //uso en el campo de contraseña el metodo do hash para convertir en MD5
          'usu_contrasena' => do_hash($this->input->post('text_contrasena', TRUE), 'md5'),
          'usuario.est_id' => 1
          ); */
        //creo la cadena de where manual
        $dataWhere = '( usu_correo = "' . $this->input->post('text_user', TRUE) . '" '
                . 'OR usu_username = "' . $this->input->post('text_user', TRUE) . '") '
                . 'AND usu_contrasena = "' . do_hash($this->input->post('text_contrasena', TRUE), 'md5') . '" '
                . 'AND usuario.est_id = 1';

        //preparo el select
        $this->db->select('usu_id, usu_nombre, usu_apellido, usu_correo, usuario_rol.usu_rol_id, usu_foto');
        //preparo el join
        $this->db->join('usuario_rol', 'usuario_rol.usu_rol_id = usuario.usu_rol_id');
        //ejecuto la consulta de los datos del usuario
        $usuarioLogin = $this->db->get_where('usuario', $dataWhere);
        //verifico los resultados de la consulta
        if ($usuarioLogin->num_rows() == 1):
            //retornamos el valor usuario login
            foreach ($usuarioLogin->result() as $filaTabla):
                $valorRetorno = $filaTabla;
            endforeach;

        endif;
        ////fin del if    
        //devuelvo el valor retorno
        return $valorRetorno;
    }

//fin del metodo
}
