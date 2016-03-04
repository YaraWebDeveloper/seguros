<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 * El siguiente controlador permitirá el manejo de las acciones para adminitrar
 * las marcas que se manejarán en el sistema. 
 *
 * @author YARA WEB Developer
 */
class Marca extends Private_Controller {

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
        $dataAction = $this->uri->segment(1) . "/crearMarca";
        //obtengo los registros
        $dataRegistros = $this->crud_model->obtenerRegistros("accesorio_marca");
        if ($dataRegistros == NULL) {
            $dataRegistros = ' ';
        }//fin del if
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
            'valorMensaje' => $pMensaje['mensaje'],
            'valorTipoMensaje' => $pMensaje['tipo']
        );
        $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
        //abro la vista
        $this->load->view("accesorios/marcas_view", $this->dataSend);
    }

//fin del metodo

    /*
     * -----------------------------------------------------------------------
     * Controlador para cargar en los controladores los datos para editar una 
     * marca
     * -----------------------------------------------------------------------
     * Párametros
     * @pId |   Int   | Valor defecto: NULL | Párametro identificador para filtrar marca en la DB
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */
    public function editarMarca($pId = NULL) {
        //Comprobar que el id desde que se accede cexiste
        if ($this->validarIdMarca($pId)):
            $this->controlarAcceso("get");
            //determino cual es el acción
            $dataAction = $this->uri->segment(1) . "/actualizarMarca";
            //creo el arreglo where
            $dataWhere = array(
                "mar_id" => $pId
            );
            //consulto el registro
            $dataAccesorio = $this->crud_model->obtenerRegistros("accesorio_marca", $dataWhere);
            //itero los resultados
            foreach ($dataAccesorio as $itemAccesorio):
                $valorNombre = $itemAccesorio->mar_nombre;
                $valorEstado = $itemAccesorio->est_id;
                $valorId = $itemAccesorio->mar_id;
            endforeach;
            //preparo el array que enviará
            $dataDatos = array(
                'Action' => $dataAction,
                'Registros' => NULL,
                'valorNombre' => $valorNombre,
                'valorEstado' => $valorEstado,
                'valorId' => $valorId,
                'valorMensaje' => NULL,
                'valorTipoMensaje' => NULL
            );
            $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
            //abro la vista
            $this->load->view("accesorios/marcas_view", $this->dataSend);
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

//fin del controlador


    /*
     * -----------------------------------------------------------------------
     * Controlador para crear una marca
     * ----------------------------------------------------------------------- 
     * Parametros
     * Sin varables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */

    public function crearMarca() {

        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar', 1)) {
            //creo el data insert
            $dataInsert = array(
                'mar_nombre' => $this->input->post('mar_nombre', TRUE),
                'est_id' => $this->input->post('est_id', TRUE)
            );
            if ($this->crud_model->agregarRegistro('accesorio_marca', $dataInsert) > 0) {
                //preparo el mensaje y el tipo de mesaje
                $dataMensaje = array(
                    'mensaje' => '
                 <p>
                    <strong>
                    ¡Bien Hecho!
                    </strong>
                    Has creado la marca: "' . $this->input->post('mar_nombre') . '" satisfacotriamente
                 </p>',
                    'tipo' => 'alert-success'
                );
                //envio el array de mensaje a index
                $this->index($dataMensaje);
            } //fin del if
        }//fin del if
        else {
            $this->index();
        }
    }

//fin del controlador
    /*
     * -----------------------------------------------------------------------
     * Controlador para actualizar una marca
     * ----------------------------------------------------------------------- 
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */


    public function actualizarMarca() {
        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar')):
            //creo el data actualizar
            $dataActualizar = array(
                'mar_nombre' => $this->input->post('mar_nombre', TRUE),
                'est_id' => $this->input->post('est_id', TRUE)
            );
            //creo el arreglo where
            $dataWhere = array(
                'mar_id' => $this->input->post('mar_id', TRUE)
            );
            if ($this->crud_model->actualizarRegistro("accesorio_marca", $dataActualizar, $dataWhere) > 0) :
                //preparo el array de mensaje y tipo de mensaje
                $dataMensaje = array(
                    'mensaje' => '
                 <p>
                    <strong>
                    ¡Perfecto!
                    </strong>
                    Has actualizado los datos de la marca: "' . $this->input->post('mar_nombre') . '" satisfactoriamente.
                 </p>',
                    'tipo' => 'alert-success'
                );
                //envio el array de mensaje a index
                $this->index($dataMensaje);
            endif;
        //fin del if
        else:
            $this->index();
        endif;
    }

    //fin del controlador    


    /*
     * -----------------------------------------------------------------------
     *  Controlador para confirmar un registro por nombre marca
     * -----------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | TRUE | Este se retorna si se encuentra en la DB valores similares de marca
     */

    public function validarMarca() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'mar_nombre' => $this->input->post('mar_nombre', TRUE)
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'accesorio_marca',
            'dataColumns' => 'mar_id',
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

    public function validarMarcaId() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'mar_nombre' => $this->input->post('mar_nombre', TRUE),
            'mar_id !=' => $this->input->post('mar_id', TRUE)
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'accesorio_marca',
            'dataColumns' => 'mar_id',
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
        if ($this->input->post($pControl)) {
            //creo la variable de validación del campo nombre
            $valorValidacion = 'required';
            if ($pTipo == 1):
                $valorValidacion .= '|callback_validarMarca';
            else:
                $valorValidacion .= '|callback_validarMarcaId';
            endif; //fin del if
            $this->form_validation->set_rules('mar_nombre', 'Marca', $valorValidacion);
            $this->form_validation->set_rules('est_id', 'Estado', 'required|trim');
            //seteamos los mensajes para las funciones
            $this->form_validation->set_message('required', 'El campo <strong>%s</strong> es obligatorio');
            $this->form_validation->set_message('validarMarcaId', 'Otro regístro ya existe con el nombre que ingresó en el campo <strong>%s</strong>');
            $this->form_validation->set_message('validarMarca', 'El nombre que ingresó en el campo <strong>%s</strong> ya existe');

            //verificamos las validaciones
            if ($this->form_validation->run() == TRUE) {
                //cambio el valor retono
                $valorRetorno = TRUE;
            }//fin del if
        }
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

    public function validarIdMarca($pId) {
        //creo la variable de retorno
        $valorRetorno = TRUE;
        //creo el arreglo where
        $dataWhere = array(
            'mar_id' => $pId
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'accesorio_marca',
            'dataColumns' => 'mar_id',
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
