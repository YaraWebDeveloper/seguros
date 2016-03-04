<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 *
 * @author YARA WEB Developer
 */
class Rol extends Private_Controller {

    //constructor de la clase
    public function __construct() {
        parent::__construct();
        $this->construccionSitio();
    }

    //fin del constructor de la clase

    /*
     * -----------------------------------------------------------------------
     * controlador index
     * -----------------------------------------------------------------------
     */

    public function index($pMensaje = NULL) {
        //determino cual es el acción
        $dataAction = $this->uri->segment(1) . "/crearRol";
        //obtengo los registros
        $dataWhere = array(
            'usu_rol_id !=' => '1'
        );
        $dataRegistros = $this->crud_model->obtenerRegistros("usuario_rol", $dataWhere);
        if ($dataRegistros == NULL) :
            $dataRegistros = ' ';
        endif;
        //fin del if
        //preparo el array que se enviará
        $valorNombre = NULL;
        $valorEstado = NULL;
        $valorId = NULL;
        $dataDatos = array(
            'Action' => $dataAction,
            'Registros' => $dataRegistros,
            'valorNombre' => $valorNombre,
            'valorEstado' => $valorEstado,
            'valorId' => $valorId,
            'valorMensaje' => $pMensaje,
        );
        $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
        //abro la vista
        $this->load->view("usuarios/rol_view", $this->dataSend);
    }

//fin del metodo


    /*
     * -----------------------------------------------------------------------
     * Controlador para cargar en los controladores los datos para editar un rol
     * -----------------------------------------------------------------------
     * Párametros
     * @pId |   Int   | Valor defecto: NULL | Párametro identificador para filtrar rol en la DB
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */

    public function editarRol($pId = NULL) {
        //Comprobar que el id desde que se accede cexiste
        if ($this->validarIdRol($pId)):
            //verifico que no esten intentando modificar el Superadministrador
            if ($pId > 1):
                $this->controlarAcceso("get");
                //determino cual es el acción
                $dataAction = $this->uri->segment(1) . "/actualizarRol";
                //creo el arreglo where
                $dataWhere = array(
                    "usu_rol_id" => $pId
                );
                //consulto el registro
                $dataRegistros = $this->crud_model->obtenerRegistros("usuario_rol", $dataWhere);
                //itero los resultados
                foreach ($dataRegistros as $itemAccesorio):
                    $valorNombre = $itemAccesorio->usu_rol_nombre;
                    $valorEstado = $itemAccesorio->est_id;
                    $valorId = $itemAccesorio->usu_rol_id;
                    $valorCreacion = $itemAccesorio->usu_rol_fecha_creacion;
                    $valorEdicion = $itemAccesorio->usu_rol_fecha_edicion;
                    $valorUsuId = $itemAccesorio->usu_id;
                endforeach;
                //preparo el array que enviará
                $dataDatos = array(
                    'Action' => $dataAction,
                    'Registros' => $dataRegistros,
                    'valorNombre' => $valorNombre,
                    'valorEstado' => $valorEstado,
                    'valorId' => $valorId,
                    'valorMensaje' => $this->alerts_library->getInfoMessages($valorNombre),
                    'valorCreacion' => $valorCreacion,
                    'valorEdicion' => $valorEdicion,
                    'valorUsuarioEdicion' => $this->getUserDataById($valorUsuId)->usu_username,
                    'valorNombreEdicion' => $this->getUserDataById($valorUsuId)->usu_nombre,
                    'valorApellidoEdicion' => $this->getUserDataById($valorUsuId)->usu_apellido,
                    'valorCorreoEdicion' => $this->getUserDataById($valorUsuId)->usu_correo
                );
                $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
                //abro la vista
                $this->load->view("usuarios/rol_view", $this->dataSend);
            else: //si intenta entrar como superadministrador
                //lo llevo al inicio de la aplicacion
                $mensaje = ' No puedes ingresar a este registro.';
                //envio el mensaje
                $this->index($this->alerts_library->getErrorMessage($mensaje));
            endif; //fin de verificación superusuario
        else:
            //lo llevo al inicio de la aplicacion
            $mensaje = ' No puedes ingresar a este registro.';
            //envio el mensaje
            $this->index($this->alerts_library->getErrorMessage($mensaje));
        endif;
    }

//fin del controlador

    /*
     * -----------------------------------------------------------------------
     * Controlador para crear un usuario rol
     * ----------------------------------------------------------------------- 
     * Parametros
     * Sin varables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */

    public function crearRol() {

        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar', 1)) :
            //creo el data insert
            $dataInsert = array(
                'usu_rol_nombre' => $this->input->post('usu_rol_nombre', TRUE),
                'est_id' => $this->input->post('est_id', TRUE),
                'usu_id' => $this->user_id,
                'usu_rol_fecha_creacion' => getHoraExacta()
            );
            if ($this->crud_model->agregarRegistro('usuario_rol', $dataInsert) > 0) :
                //preparo el mensaje y el tipo de mesaje
                $this->index($this->alerts_library->getSaveMessage($this->input->post('usu_rol_nombre')));
            endif;
        //fin del if
        else :
            $this->index();
        endif;
    }

    //fin del controlador

    /*
     * -----------------------------------------------------------------------
     * Controlador para actualizar un rol
     * ----------------------------------------------------------------------- 
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */

    public function actualizarRol() {
        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar')) :
            //creo el data actualizar
            $dataActualizar = array(
                'usu_rol_nombre' => $this->input->post('usu_rol_nombre', TRUE),
                'est_id' => $this->input->post('est_id', TRUE),
                'usu_id' => $this->user_id,
                'usu_rol_fecha_edicion' => getHoraExacta()
            );
            //creo el arreglo where
            $dataWhere = array(
                'usu_rol_id' => $this->input->post('usu_rol_id', TRUE)
            );
            if ($this->crud_model->actualizarRegistro("usuario_rol", $dataActualizar, $dataWhere) > 0) :
                //preparo el array de mensaje y tipo de mensaje
                $this->index($this->alerts_library->getUpdateMessage($this->input->post('usu_rol_nombre')));
            endif;
        //fin del if
        else:
            $this->index();
        endif;
    }

    //fin del controlador    

    /*
     * -----------------------------------------------------------------------
     *  Controlador para confirmar un registro por nombre usuario rol
     * -----------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | TRUE | Este se retorna si se encuentra en la DB valores
     *  similares de rol
     */
    public function validarRol() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'usu_rol_nombre' => $this->input->post('usu_rol_nombre', TRUE)
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
            $valorRetorno = TRUE;
        endif;
        //devolvemos el valor retorno
        return $valorRetorno;
    }

    //fin del controlador  

    /*
     * -----------------------------------------------------------------------
     *  Controlador para confirmar un registro por Id
     * -----------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | TRUE | Este se retorna si se encuentra en la DB valores similares en Id.
     */

    public function validarRolId() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'usu_rol_nombre' => $this->input->post('usu_rol_nombre', TRUE),
            'usu_rol_id !=' => $this->input->post('usu_rol_id', TRUE)
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
            $valorRetorno = TRUE;
        endif;
        //devolvemos el valor retorno
        return $valorRetorno;
    }

    //fin del controlador  

    /*
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

    private function validarControles($pControl, $pTipo = 0) {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //validamos los datos
        if ($this->input->post($pControl)):
            //creo la variable de validación del campo nombre
            $valorValidacion = 'required';
            if ($pTipo == 1):
                $valorValidacion .= '|callback_validarRol';
            else:
                $valorValidacion .= '|callback_validarRolId';
            endif; //fin del if
            $this->form_validation->set_rules('usu_rol_nombre', 'Usuario Rol', $valorValidacion);
            $this->form_validation->set_rules('est_id', 'Estado', 'required|trim');
            //seteamos los mensajes para las funciones
            $this->form_validation->set_message('required', 'El campo <strong>%s</strong> es obligatorio');
            $this->form_validation->set_message('validarRolId', 'Otro regístro ya existe con el nombre que ingresó en el campo <strong>%s</strong>');
            $this->form_validation->set_message('validarRol', 'El nombre que ingresó en el campo <strong>%s</strong> ya existe');

            //verificamos las validaciones
            if ($this->form_validation->run() == TRUE) :
                //cambio el valor retono
                $valorRetorno = TRUE;
            endif;
        //fin del if
        endif;
        //devuelvo el valor retorno
        return $valorRetorno;
    }

    //fin del controlador


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

}
