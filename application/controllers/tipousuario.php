<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 * El siguiente controlador permitirá el manejo de las acciones para adminitrar
 * los tipos de ocupación que se manejarán en el sistema. 
 *
 * @author YARA WEB Developer
 */
class Tipousuario extends Private_Controller {

    /**
     * Constructor de la clase
     * @name Construct
     * @access public
     */
    public function __construct() {
        parent::__construct();
        $this->construccionSitio();
    }

    /**
     * Index del controlador, este carga la vista principal y las vistas correspondientes
     * 
     * @param   type $pMensaje
     * @return  none
     */
    public function index($pMensaje = NULL) {
        //determino cual es el acción
        $dataAction = $this->uri->segment(1) . "/crearTipoUsuario";
        //obtengo los registros
        $dataRegistros = $this->crud_model->obtenerRegistros("accesorio_tipo_usuario");
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
        $this->load->view("accesorios/tipousuario_view", $this->dataSend);
    }

    /**
     * Método para cargar en los controladores los datos para editar un
     * tipo ocupación.
     * 
     * @param int $pId Párametro identificador para filtrar tipo documento en la DB
     * @return none
     */
    public function editarTipoUsuario($pId = NULL) {
        //Comprobar que el id desde que se accede cexiste
        if ($this->validarOcupacion($pId)):

            $this->controlarAcceso("get");
            //determino cual es el acción
            $dataAction = $this->uri->segment(1) . "/actualizarTipoUsuario";
            //creo el arreglo where
            $dataWhere = array(
                "tip_usu_id" => $pId
            );
            //consulto el registro
            $dataAccesorio = $this->crud_model->obtenerRegistros("accesorio_tipo_usuario", $dataWhere);
            //itero los resultados
            foreach ($dataAccesorio as $itemAccesorio):
                $valorNombre = $itemAccesorio->tip_usu_nombre;
                $valorEstado = $itemAccesorio->est_id;
                $valorId = $itemAccesorio->tip_usu_id;
                $valorCreacion = $itemAccesorio->tip_usu_fecha_creacion;
                $valorEdicion = $itemAccesorio->tip_usu_fecha_edicion;
                $valorUsuId = $itemAccesorio->usu_id;
            endforeach;
            //obtengo los registros
            $dataRegistros = $this->crud_model->obtenerRegistros("accesorio_tipo_usuario");
            if ($dataRegistros == NULL) :
                $dataRegistros = ' ';
            endif;
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
            $this->load->view("accesorios/tipousuario_view", $this->dataSend);
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
     * Controlador para crear una tipo ocupación
     * 
     * @param   none
     * @return  none
     */
    public function crearTipoUsuario() {

        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar', 1)) :
            //creo el data insert
            $dataInsert = array(
                'tip_usu_nombre' => $this->input->post('tip_usu_nombre', TRUE),
                'est_id' => $this->input->post('est_id', TRUE),
                'usu_id' => $this->user_id,
                'tip_usu_fecha_creacion' => getHoraExacta()
            );
            if ($this->crud_model->agregarRegistro('accesorio_tipo_usuario', $dataInsert) > 0) :
                //preparo el mensaje y el tipo de mesaje
                $this->index($this->alerts_library->getSaveMessage($this->input->post('tip_usu_nombre')));
            endif;
        //fin del if
        else :
            $this->index();
        endif;
    }

    /**
     * Controlador para actualizar un tipo ocupación.
     * 
     * @param   none
     * @return  none
     */
    public function actualizarTipoUsuario() {
        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar')) :
            //creo el data actualizar
            $dataActualizar = array(
                'tip_usu_nombre' => $this->input->post('tip_usu_nombre', TRUE),
                'est_id' => $this->input->post('est_id', TRUE),
                'usu_id' => $this->user_id,
                'tip_usu_fecha_edicion' => getHoraExacta()
            );
            //creo el arreglo where
            $dataWhere = array(
                'tip_usu_id' => $this->input->post('tip_usu_id', TRUE)
            );
            if ($this->crud_model->actualizarRegistro("accesorio_tipo_usuario", $dataActualizar, $dataWhere) > 0) :
                //envio el array de mensaje a index
                $this->index($this->alerts_library->getUpdateMessage($this->input->post('tip_usu_nombre')));
            endif;
        //fin del if
        else:
            $this->index();
        endif;
    }

    /**
     *  Controlador para confirmar un registro por Id, busca coincidencias en la base de datos
     * 
     * @param int $pId Id del tipo ocupación que se quiere verificar
     * @return boolean Retorna verdadero si encuentra una coincidencia en la Base de Datos.
     */
    public function validarOcupacion($pId) {
        //creo la variable de retorno
        $valorRetorno = TRUE;
        //creo el arreglo where
        $dataWhere = array(
            'tip_usu_id' => $pId
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'accesorio_tipo_usuario',
            'dataColumns' => 'tip_usu_id',
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

    /**
     *  Controlador para confirmar un registro por Id, busca coincidencias en la base de datos
     * 
     * @param   int $pId Id del tipo tipo ocupación que se quiere verificar
     * @return  boolean Retorna verdadero si encuentra una coincidencia en la Base de Datos.
     */
    public function validarTipoUsuario() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'tip_usu_nombre' => $this->input->post('tip_usu_nombre', TRUE)
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'accesorio_tipo_usuario',
            'dataColumns' => 'tip_usu_id',
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

    /**
     *  Controlador para confirmar un registro por Id, busca coincidencias en la base de datos
     * 
     * @param   none
     * @return  boolean Retorna verdadero si encuentra una coincidencia en la Base de Datos.
     */
    public function validarTipoUsuarioId() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'tip_usu_nombre' => $this->input->post('tip_usu_nombre', TRUE),
            'tip_usu_id !=' => $this->input->post('tip_usu_id', TRUE)
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'accesorio_tipo_usuario',
            'dataColumns' => 'tip_usu_id',
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

    /**
     *  Controlador validar los controles de la vista
     * 
     * @param String $pControl Este es necesario para saber que tipo de accion se realizara ejemplo: 'guardar'
     * @param int $pTipo Validacion desde otro metodo | valores posibles: 0, 1
     * @return boolean Si todos los controles de la vista son aceptados
     */
    private function validarControles($pControl, $pTipo = 0) {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //validamos los datos
        if ($this->input->post($pControl)):
            //creo la variable de validación del campo nombre
            $valorValidacion = 'required';
            if ($pTipo == 1):
                $valorValidacion .= '|callback_validarTipoUsuario';
            else:
                $valorValidacion .= '|callback_validarTipoUsuarioId';
            endif; //fin del if
            $this->form_validation->set_rules('tip_usu_nombre', 'Tipo Ocupacion', $valorValidacion);
            $this->form_validation->set_rules('est_id', 'Estado', 'required|trim');
            //seteamos los mensajes para las funciones
            $this->form_validation->set_message('required', 'El campo <strong>%s</strong> es obligatorio');
            $this->form_validation->set_message('validarTipoUsuarioId', 'Otro regístro ya existe con el nombre que ingresó en el campo <strong>%s</strong>');
            $this->form_validation->set_message('validarTipoUsuario', 'El nombre que ingresó en el campo <strong>%s</strong> ya existe');

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
}

//fin de la clase
