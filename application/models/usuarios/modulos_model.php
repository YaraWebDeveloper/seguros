<?php

/**
 * Description of modulos
 *
 * @author jucactru
 */
class Modulos_model extends CI_Model {

    //constructor
    public function __construct() {
        parent::__construct();
    }

//fin del constructor

    /*
     * -------------------------------------------------------
     * Método para obtener los datos de los módulos superiores
     * a los que el usuario tiene acceso
     * ------------------------------------------------------- 
     */

    public function consultarModulosGeneral($pIdTipoUser) {
        //creo la variable de retorno
        $valorRetorno = null;
        //preparo el arreglo de la condición where
        $dataWhere = array(
            'usu_rol_id' => $pIdTipoUser
        );
        //preparo el select
        $this->db->select('modulo.mod_dependencia');
        //preparo el join
        $this->db->join('modulo', 'modulo.mod_id = modulo_acceso.mod_id');
        //preparo el group by
        $this->db->group_by("modulo.mod_dependencia");
        //ejecuto la consulta de los datos del usuario
        $moduloUsuario = $this->db->get_where('modulo_acceso', $dataWhere);
        //verifico los resultados de la consulta 
        if ($moduloUsuario->num_rows() > 0) {
            //retornamos el valor usuario login
            $valorRetorno = $moduloUsuario->result();
        }//fin del if     
        //
        //devuelvo el valor retorno
        return $valorRetorno;
    }

//fin del metodo


    /*
     * -------------------------------------------------------
     *  Método para obtener el nombre del modulo
     * ------------------------------------------------------- 
     */

    public function consultarNombreModulo($pIdModulo) {
        //creo la variable de retorno
        $valorRetorno = null;
        //preparo el arreglo de la condición where
        $dataWhere = array(
            'mod_id' => $pIdModulo,
        );
        //preparo el select
        $this->db->select('mod_nombre, mod_url, mod_clase_icono');
        //ejecuto la consulta
        $moduloUsuario = $this->db->get_where('modulo', $dataWhere);
        //verifico los resultados de la consulta 
        if ($moduloUsuario->num_rows() > 0) {
            //retornamos el valor usuario login
            $valorRetorno = $moduloUsuario->result();
        }//fin del if     
        //devuelvo el valor retorno
        return $valorRetorno;
    }

//fin del metodo

    public function consultarListaModulos($pIdModulo, $pIdRol) {
        //creo la variable de retotno
        $valorRetorno = null;
        //preparo el ordenamiento de la consulta
        $this->db->order_by("mod_nombre", "asc");
        //preparo el arreglo de la condición where
        $dataWhere = array(
            'usuario_rol.usu_rol_id' => $pIdRol,
            'mod_dependencia' => $pIdModulo,
            'modulo.est_id' => 1
        );
        //preparo el select
        $moduloLista = $this->db->select('modulo.mod_id, mod_nombre, mod_url');
        //preparo el join
        $moduloLista = $this->db->join('modulo_acceso', 'modulo.mod_id = modulo_acceso.mod_id');
        $moduloLista = $this->db->join('usuario_rol', 'usuario_rol.usu_rol_id = modulo_acceso.usu_rol_id');
        //ejecuto la consulta de los datos del usuario
        $moduloLista = $this->db->get_where('modulo', $dataWhere);
        //verifico los resultados de la consulta 
        if ($moduloLista->num_rows() > 0) {
            //retornamos el valor usuario login
            $valorRetorno = $moduloLista->result();
        }//fin del if     
        //devuelvo el valor retorno
        return $valorRetorno;
    }

//fin del metodo



    /* -------------------------------------------------------------------------
     * Metodo para verificar acceso a modulo por rol de usario
     * ------------------------------------------------------------------------
     * Parámetros
     * @pRolId     | INT    | Sin valor por defecto | Este debe ser el valor RolId almacenado el session.
     * @pUrlModulo | STRING | Sin Valor por defecto | Es la url en el segmento 1 donde se verifica el contrlador
     * ------------------------------------------------------------------------
     * Retorno
     * @valorRetorno | boolean | TRUE | Si se encuentra que los datos recibidos tienen alguna coincidencia en la DB
     */

    public function verificarAccesoUrl($pRolId, $pUrlModulo) {
        //variable de retorno
        $valorRetorno = FALSE;
        //creo el array para enviar las comparaciones
        $dataWhere = array(
            'mod_url' => $pUrlModulo,
            'usu_rol_id' => $pRolId,
            'est_id' => 1
        );
        //selecciono los campos de la BD
        $this->db->select('mod_url');
        //Adjunto la tabla modulo_acces para hacer la comparacion de roles
        $this->db->join('modulo_acceso', 'modulo.mod_id = modulo_acceso.mod_id');
        //Ejecuto la consulta a la tabla modulos
        $dataResultado = $this->db->get_where('modulo', $dataWhere);
        //verifico si la consulta arrojó más de un resultado
        if ($dataResultado->num_rows() > 0):
            //cabio el valor de valorRetorno
            $valorRetorno = TRUE;
        endif;

        //retorno la variable de retorno
        return $valorRetorno;
    }

//fin mtodo

    /*
     * -------------------------------------------------------------------------
     * Control para obtener los modulos y comprobar que la url sea un acceso a ellos
     * -------------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -------------------------------------------------------------------------
     * Retorno
     * @dataTipoEmp | array | Si la consulta es correcta retorna los datos encontrados
     */
    public function obtenerModulos($url) {
        //variable de retorno
        $valorRetorno = FALSE;
        //variable de control para busqueda
        $variableBusqueda = 0;
        //crear campos a seleccionar modulos
        $dataSelectModulos = "mod_url";
        //Traer los datos que tengan como estado activo
        $dataWhereModulo = array(
            "est_id" => 1,
            "mod_url" => $url
        );
        //obtener los registros
        $dataModulo = $this->crud_model->obtenerRegistros("modulo", $dataWhereModulo, $dataSelectModulos);
        if ($dataModulo != NULL):
            $valorRetorno = TRUE;
            //retorno la variable
            return $valorRetorno;
        endif;
    }

}

//fin de la clase
