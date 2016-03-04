<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 * El siguiente controlador permitirá el manejo de las acciones para adminitrar
 * las Ocupaciones que se manejarán en el sistema. 
 *
 * @author YARA WEB Developer
 */
class Ocupacion extends Private_Controller {

    /**
     * Variable de tipo
     */
    public $dataTipo;

    /**
     * Constructor de la clase
     * @name Construct
     * @access public
     */
    public function __construct() {
        parent::__construct();
        $this->construccionSitio();
        //obtener los datos de tipos
        //datalock
        $this->dataTipo = $this->obtenerData('accesorio_tipo_ocupacion');
    }

    /**
     * Index del controlador, este carga la vista principal y las vistas correspondientes
     * 
     * @param   type $pMensaje
     * @return  none
     */
    public function index($pMensaje = NULL) {

        //obtener mensaje si no hay tipo
        //determino cual es el acción
        $dataAction = $this->uri->segment(1) . "/crearOcupacion";
        //Seleccio de datos
        $dataSelect = "ocu_id, ocu_nombre, est_id, (select tip_ocu_nombre from accesorio_tipo_ocupacion"
                . " where accesorio_ocupacion.tip_ocu_id = accesorio_tipo_ocupacion.tip_ocu_id ) as tip_ocu_nombre";
        //obtengo los registros
        $dataRegistros = $this->crud_model->obtenerRegistros("accesorio_ocupacion",NULL ,$dataSelect);
        //fin del if
        //preparo el array que se enviará
        $dataDatos = array(
            'Action' => $dataAction,
            'Registros' => $dataRegistros,
            'valorNombre' => NULL,
            'valorEstado' => NULL,
            'valorId' => NULL,
            'valorTipo' => NULL,
            'dataTipo' => $this->dataTipo,
            'valorMensaje' => $pMensaje,
        );
        if ($this->dataTipo == NULL):
            $pMensaje = $this->alerts_library->getLockMessage("Tipo Ocupación");
            $dataDatos = array_merge($dataDatos, ['valorMensaje' => $pMensaje, 'dataLock' => TRUE]);
        endif;
        $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
        //abro la vista
        $this->load->view("accesorios/ocupacion_view", $this->dataSend);
    }

    /**
     * Método para cargar en los controladores los datos para editar un
     * tipo ocupación.
     * 
     * @param int $pId Párametro identificador para filtrar tipo documento en la DB
     * @return none
     */
    public function editarOcupacion($pId = NULL) {
        //comprobar tipo
        if ($this->dataTipo != NULL):

            //Comprobar que el id desde que se accede cexiste
            if ($this->validarOcupacion($pId)):

                $this->controlarAcceso("get");
                //determino cual es el acción
                $dataAction = $this->uri->segment(1) . "/actualizarOcupacion";
                //creo el arreglo where
                $dataWhere = array(
                    "ocu_id" => $pId
                );
                //consulto el registro
                $dataAccesorio = $this->crud_model->obtenerRegistros("accesorio_ocupacion", $dataWhere);
                //itero los resultados
                foreach ($dataAccesorio as $itemAccesorio):
                    $valorNombre = $itemAccesorio->ocu_nombre;
                    $valorEstado = $itemAccesorio->est_id;
                    $valorId = $itemAccesorio->ocu_id;
                    $valorCreacion = $itemAccesorio->ocu_fecha_creacion;
                    $valorEdicion = $itemAccesorio->ocu_fecha_edicion;
                    $valorUsuId = $itemAccesorio->usu_id;
                    $valorTipo = $itemAccesorio->tip_ocu_id;
                endforeach;
                //obtengo los registros
                $dataRegistros = $this->crud_model->obtenerRegistros("accesorio_ocupacion");
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
                    'valorTipo' => $valorTipo,
                    'dataTipo' => $this->dataTipo,
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
                $this->load->view("accesorios/ocupacion_view", $this->dataSend);
            else:
                //lo llevo al inicio de la aplicacion
                //envio el array de mensaje a index
                $this->index($this->alerts_library->getErrorMessage('No Puede Ingresar a este ID'));
            endif;
        else:
            redirect(base_url($this->uri->segment(1)));
        endif;
    }

    /**
     * Controlador para crear una tipo ocupación
     * 
     * @param   none
     * @return  none
     */
    public function crearOcupacion() {

        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar', 1)) :
            //creo el data insert
            $dataInsert = array(
                'ocu_nombre' => $this->input->post('ocu_nombre', TRUE),
                'tip_ocu_id' => $this->input->post('tip_ocu_id', TRUE),
                'est_id' => $this->input->post('est_id', TRUE),
                'usu_id' => $this->user_id,
                'ocu_fecha_creacion' => getHoraExacta()
            );
            if ($this->crud_model->agregarRegistro('accesorio_ocupacion', $dataInsert) > 0) :
                //preparo el mensaje y el tipo de mesaje
                $this->index($this->alerts_library->getSaveMessage($this->input->post('ocu_nombre')));
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
    public function actualizarOcupacion() {
        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar')) :
            //creo el data actualizar
            $dataActualizar = array(
                'ocu_nombre' => $this->input->post('ocu_nombre', TRUE),
                'tip_ocu_id' => $this->input->post('tip_ocu_id', TRUE),
                'est_id' => $this->input->post('est_id', TRUE),
                'usu_id' => $this->user_id,
                'ocu_fecha_edicion' => getHoraExacta()
            );
            //creo el arreglo where
            $dataWhere = array(
                'ocu_id' => $this->input->post('ocu_id', TRUE)
            );
            if ($this->crud_model->actualizarRegistro("accesorio_ocupacion", $dataActualizar, $dataWhere) > 0) :
                //envio el array de mensaje a index
                $this->index($this->alerts_library->getUpdateMessage($this->input->post('ocu_nombre')));
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
            'ocu_id' => $pId
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'accesorio_ocupacion',
            'dataColumns' => 'ocu_id',
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
    public function validarIdOcupacion() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'ocu_nombre' => $this->input->post('ocu_nombre', TRUE)
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'accesorio_ocupacion',
            'dataColumns' => 'ocu_id',
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
    public function validarOcupacionId() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'ocu_nombre' => $this->input->post('ocu_nombre', TRUE),
            'ocu_id !=' => $this->input->post('ocu_id', TRUE)
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'accesorio_ocupacion',
            'dataColumns' => 'ocu_id',
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
                $valorValidacion .= '|callback_validarIdOcupacion';
            else:
                $valorValidacion .= '|callback_validarOcupacionId';
            endif; //fin del if
            $this->form_validation->set_rules('ocu_nombre', 'Tipo Ocupacion', $valorValidacion);
            $this->form_validation->set_rules('tip_ocu_id', 'Perteneciente', $valorValidacion);
            $this->form_validation->set_rules('est_id', 'Estado', 'required|trim');
            //seteamos los mensajes para las funciones
            $this->form_validation->set_message('required', 'El campo <strong>%s</strong> es obligatorio');
            $this->form_validation->set_message('validarOcupacionId', 'Otro regístro ya existe con el nombre que ingresó en el campo <strong>%s</strong>');
            $this->form_validation->set_message('validarIdOcupacion', 'El nombre que ingresó en el campo <strong>%s</strong> ya existe');

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
