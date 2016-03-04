<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 *
 * @author YARA WEB Developer
 */
class Permisorol extends Private_Controller {

    //Obtener los roles
    public $dataRoles;

    //constructor de la clase
    public function __construct() {
        parent::__construct();
        $this->construccionSitio();


        //preparo el arreglo Where
        $dataWhere = array(
            'est_id' => 1,
            'usu_rol_id >' => 1
        );
        //Data Roles
        $this->dataRoles = $this->obtenerData('usuario_rol', NULL, $dataWhere);
    }

//fin del constructor de la clase

    /*
     * -----------------------------------------------------------------------
     * controlador index
     * -----------------------------------------------------------------------
     */

    public function index($pMensaje = NULL) {
        //determino el valor de editar 
        $editar = 0;
        //determino cual es el acción
        $dataAction = NULL;
        //preparo el array que se enviará

        $dataDatos = array(
            'editar' => $editar,
            'Action' => $dataAction,
            'Registros' => $this->dataRoles,
            'dataModulos' => array(),
            'dataPermisos' => array(),
            'dataNombreRol' => NULL,
            'valorId' => NULL,
            'valorMensaje' => $pMensaje
        );
        //uno el arreglo al dataSend 
        $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
        //abro la vista
        $this->load->view("usuarios/permisorol_view", $this->dataSend);
    }

//fin del metodo


    /*
     * -----------------------------------------------------------------------
     * Controlador para cargar en los controladores los datos para editar un permiso
     * de rol
     * -----------------------------------------------------------------------
     * Párametros
     * @pId |   Int   | Valor defecto: NULL | Párametro identificador para filtrar roles en la DB
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */
    public function editarPermisoRol($pIdRol) {
        //Comprobar que el id desde que se accede cexiste
        if ($this->validarIdRol($pIdRol)):
            //verifico que no esten intentando modificar el Superadministrador
            if ($pIdRol > 1):
                $this->controlarAcceso("get");
                //determino el valor de editar 
                $editar = 1;
                //determino cual es el acción
                $dataAction = $this->uri->segment(1) . "/actualizarPermisoRol";
                //obtengo los registros
                $dataModulos = $this->obtenerData('modulo', NULL, array('mod_dependencia !=' => '0'));
                //Select permisos
                $dataPermisos = $this->obtenerData('modulo_acceso', 'mod_id', array('usu_rol_id' => $pIdRol));
                //nombre del rol
                $dataNombreRol = $this->obtenerData('usuario_rol', 'usu_rol_nombre', array('usu_rol_id' => $pIdRol))[0]->usu_rol_nombre;
                //array de datos a enviar
                $dataDatos = array(
                    'editar' => $editar,
                    'Action' => $dataAction,
                    'Registros' => $this->dataRoles,
                    'dataModulos' => $dataModulos,
                    'dataPermisos' => $dataPermisos,
                    'valorId' => $pIdRol,
                    'valorMensaje' => $this->alerts_library->getInfoMessages($dataNombreRol)
                );
                //uno el arreglo al dataSend 
                $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
                //abro la vista
                $this->load->view("usuarios/permisorol_view", $this->dataSend);
            else: //si intenta entrar como superadministrador
                //lo llevo al inicio de la aplicacion
                //preparo el array de mensaje y tipo de mensaje
                $dataMensaje = array(
                    'mensaje' => '
                 <p>
                    <strong>
                    ¡Algo ha ido mal!
                    </strong>
                    No puedes ingresar a este Rol.
                 </p>',
                    'tipo' => 'alert-error'
                );
                //envio el array de mensaje a index
                $this->index($dataMensaje);
            //redirect(base_url());
            endif;
        else:
            //lo llevo al inicio de la aplicacion
            //preparo el array de mensaje y tipo de mensaje
            $dataMensaje = array(
                'mensaje' => '
                 <p>
                    <strong>
                    ¡Algo ha ido mal!
                    </strong>
                    No puedes ingresar a este Id.
                 </p>',
                'tipo' => 'alert-error'
            );
            //envio el array de mensaje a index
            $this->index($dataMensaje);
        endif;
    }

    /**
     * -----------------------------------------------------------------------
     *  controlador para actualizar los permisos de roles
     * ------------------------------------------------------------------------
     * Parametros
     * No hay variables de parametros
     * ------------------------------------------------------------------------
     * Retorno
     * No hay variable de retono.
     * ------------------------------------------------------------------------
     */
    public function actualizarPermisoRol() {
        $this->controlarAcceso('post', 'guardar');
        //validamos que los roles estén confirmados
        if ($this->validarControles('guardar')):
            if ($this->eliminarPermisoRol($this->input->post('usu_rol_id', TRUE))):
                //creo el arreglo de insertar
                $dataInsert = array();
                //iteramos el arreglo que llega del post
                foreach ($this->input->post('permisos', TRUE) as $itemPermiso):
                    $dataInsert[] = array(
                        'mod_id' => $itemPermiso,
                        'usu_rol_id' => $this->input->post('usu_rol_id', TRUE)
                    );
                endforeach;
                //realizo la inserción
                $agregarPermisos = $this->crud_model->agregarRegistroMultiple('modulo_acceso', $dataInsert);
                if ($agregarPermisos) :
                    //Obtener el nombre del rol
                    $dataNombreRol = $this->obtenerData('usuario_rol', 'usu_rol_nombre', array('usu_rol_id' => $this->input->post('usu_rol_id', TRUE)))[0]->usu_rol_nombre;
                    //preparo el array de mensaje y tipo de mensaje
                    $this->index($this->alerts_library->getUpdateMessage($dataNombreRol));
                endif;
            endif;
        else:
            $this->index();
        endif;
    }

    //fin del controlador  

    /*
     * ------------------------------------------------------------------------
     *  Funcion para eliminar los permisos de rol
     * ------------------------------------------------------------------------
     * Parametros
     * @pIdRol | Int | sin valor por defecto | Este es el id del rol, con el fin de eliminar todos los datos de
     *                                         esta tabla pertenecientes a un rol.
     * ------------------------------------------------------------------------
     * Retorno
     * @valorRetorno | boolean | TRUE | Este se retornoara si la eliminación de datos fue exitosa
     */
    private function eliminarPermisoRol($pIdRol) {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //cargo el modelo de permisos de Rol
        $this->load->model('usuarios/permisosrol_model');
        //elimino los permisos del rol
        if ($this->permisosrol_model->eliminarPermisos($pIdRol)):
            $valorRetorno = TRUE;
        endif;
        //devuelvo la variable de retorno
        return $valorRetorno;
    }

    /**
     * -----------------------------------------------------------------------
     *  controlador validar los controles de la vista
     * ----------------------------------------------------------------------- 
     * Párametros
     * @pControl | String | Sin valor por defecto | Este es necesario para saber que tipo de accion se realizara e
     *                                              ejemplo:  'guardar'
     * 
     * @pTipo | int | Valor por defecto: 0 | Validacion desde otro metodo | valores posibles: 0, 1
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | boolean | true   | Si todos los controles de la vista son aceptados
     */
    private function validarControles($pControl) {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //validamos los datos
        if ($this->input->post($pControl)) {
            //creo la variable de validación del checkbox de Comfirmar Permisos Rol
            $this->form_validation->set_rules('comprobar', 'Confirmar permisos de rol', 'required|trim');
            //seteamos los mensajes para las funciones
            $this->form_validation->set_message('required', 'El campo <strong>%s</strong> debe estar activo');
            //verificamos las validaciones
            if ($this->form_validation->run() == TRUE) {
                //cambio el valor retono
                $valorRetorno = TRUE;
            }//fin del if
        }
        //devuelvo el valor retorno
        return $valorRetorno;
    }

    /*
     * -----------------------------------------------------------------------
     *  Controlador para confirmar un registro por Id
     * -----------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | TRUE | Este se retorna si no en la DB valores similares en Id.
     */

    public function validarIdRol($pId) {
        //creo la variable de retorno
        $valorRetorno = TRUE;
        //creo el arreglo where
        $dataWhere = array(
            'usu_rol_id' => $pId
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'usuario_rol',
            'dataColumns' => 'usu_rol_id',
            'dataWhere' => $dataWhere,
            'dataWhereOr' => NULL
        );
        if ($this->crud_model->scalarRegistro($dataSendQuery)) :
            //cambio el valor Retorno
            $valorRetorno = FALSE;
        endif;
        //devolvemos el valor retorno
        return $valorRetorno;
    }

    //fin del controlador
}
