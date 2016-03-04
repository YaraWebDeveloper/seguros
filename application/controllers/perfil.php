<?php

/**
 * Esta clase permitirá actualizar los datos de un perfil de usuario
 *
 * @author YARA WEB Developer
 */
class Perfil extends Private_Controller {

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
        $dataAction = $this->uri->segment(1) . "/actualizarPerfil";
//creo el arreglo where
        $dataWhere = array(
            "usu_id" => $this->user_id
        );
//consulto el registro
        $dataUsuario = $this->crud_model->obtenerRegistros("usuario", $dataWhere);
//itero los resultados
        foreach ($dataUsuario as $itemUsuario):
            $valorNombre = $itemUsuario->usu_nombre;
            $valorApellido = $itemUsuario->usu_apellido;
            $valorTelefono = $itemUsuario->usu_telefono;
            $valorCelular = $itemUsuario->usu_celular;
            $valorCorreo = $itemUsuario->usu_correo;
            $valorId = $itemUsuario->usu_id;
            $this->dataContrasena = $itemUsuario->usu_contrasena;
        endforeach;
//preparo el array que enviará
        $dataDatos = array(
            'Action' => $dataAction,
            'Registros' => NULL,
            'valorNombre' => $valorNombre,
            'valorApellido' => $valorApellido,
            'valorTelefono' => $valorTelefono,
            'valorCelular' => $valorCelular,
            'valorCorreo' => $valorCorreo,
            'valorPass' => NULL,
            'valorId' => $valorId,
            'valorMensaje' => $pMensaje['mensaje'],
            'valorTipoMensaje' => $pMensaje['tipo']
        );
        $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
//abro la vista
        $this->load->view("usuarios/perfil_view", $this->dataSend);
    }

//fin del controlador

    /*
     * -----------------------------------------------------------------------
     *  controlador para actualizar el perfil de un usuario 
     * ------------------------------------------------------------------------
     * Parametros
     * No hay variables de parametros
     * ------------------------------------------------------------------------
     * Retorno
     * No hay variable de retono.
     * ------------------------------------------------------------------------
     */

    public function actualizarPerfil() {
        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar')) {

            //Asigno la contraseña del usuario por post 
            $dataContrasena = $this->input->post('usu_contrasena', TRUE);

            //conparar que la dataContrasena no este vacia
            if ($dataContrasena != NULL) :
                //asigno la variable contraseña encriptada a la variabled de envío
                $retornoContrasena = do_hash($this->input->post('usu_contrasena', TRUE), 'md5');
            else: //si la contraseña viene vacía
                //creo el arreglo where
                $dataWhere = array(
                    "usu_id" => $this->user_id
                );
                //consulto el registro
                $dataUsuario = $this->crud_model->obtenerRegistros("usuario", $dataWhere);
                foreach ($dataUsuario as $itemUsuario):
                    $retornoContrasena = $itemUsuario->usu_contrasena;
                endforeach;
            endif;

//creo el data actualizar
            $dataActualizar = array(
                'usu_nombre' => $this->input->post('usu_nombre', TRUE),
                'usu_apellido' => $this->input->post('usu_apellido', TRUE),
                'usu_celular' => $this->input->post('usu_celular', TRUE),
                'usu_telefono' => $this->input->post('usu_telefono', TRUE),
                'usu_contrasena' => $retornoContrasena
            );
//creo el arreglo where
            $dataWhere = array(
                'usu_id' => $this->input->post('usu_id', TRUE)
            );
            if ($this->crud_model->actualizarRegistro("usuario", $dataActualizar, $dataWhere) > 0) {
//ejecutamos la redirección
                //preparo el array de mensaje y tipo de mensaje
                $dataMensaje = array(
                    'mensaje' => '
                 <p>
                    <strong>
                    ¡Perfecto!
                    </strong>
                    Has actualzado tus datos correctamente.
                 </p>',
                    'tipo' => 'alert-success'
                );
                //envio el array de mensaje a index
                $this->index($dataMensaje);
            }//fin del if
        }//fin del if de validación
        else {
            $this->index();
        }
    }

//fin del controlador    
    /*
     * -----------------------------------------------------------------------
     *  Controlador para confirmar un registro por correo
     * -----------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | TRUE | Este se retorna si se encuentra en la DB valores similares en correo.
     */


    public function validarCorreo() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'usu_id !=' => $this->input->post('usu_id', TRUE),
            'usu_correo' => $this->input->post('usu_correo', TRUE)
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'usuario',
            'dataColumns' => 'usu_id',
            'dataWhere' => $dataWhere,
            'dataWhereOr' => NULL
        );
        if ($this->crud_model->scalarRegistro($dataSendQuery)) {
            //cambio el valor Retorno
            $valorRetorno = TRUE;
        }
        //devolvemos el valor retorno
        return $valorRetorno;
    }

    /*
     * -----------------------------------------------------------------------
     *  Controlador para confirmar la coincidencia de contraseñas
     * -----------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | TRUE | Este se retorna si las contraseñas coinciden.
     */

    public function validarContrasena() {

        //variable de retorno
        $valorRetorno = FALSE;

        //asignar variables de contraseñas ingresadas
        $new_pass = $this->input->post('usu_contrasena', TRUE);
        $new_conf_pass = $this->input->post('usu_confirmar_contrasena', TRUE);

        //Verifico si la contraseñas son iguales
        if ($new_conf_pass == $new_pass):
            $valorRetorno = TRUE;
        endif;

        //devuelvo la variables
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
            $valorValidacion = 'required|trim|numeric';
            $valorValidacion .= '|callback_validarCorreo';
            $this->form_validation->set_rules('usu_correo', 'Correo Electrónico', 'required|trim|valid_email|callback_validarCorreo');

            $this->form_validation->set_rules('usu_telefono', 'Teléfono', 'required|numeric');
            $this->form_validation->set_rules('usu_nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('usu_apellido', 'Apellido', 'required');

            if ($this->input->post('usu_contrasena', TRUE) != NULL) :
                $this->form_validation->set_rules('usu_contrasena', 'Contraseña', 'callback_validarContrasena');
            endif;
//seteamos los mensajes para las funciones
            $this->form_validation->set_message('numeric', 'El campo <strong>%s</strong> debe contener solo números');
            $this->form_validation->set_message('required', 'El campo <strong>%s</strong> es obligatorio');
            $this->form_validation->set_message('valid_email', 'El campo <strong>%s</strong> debe ser un correo electrónico válido');
            $this->form_validation->set_message('validarCorreo', 'los datos que ingresó en los campos de <Strong>Correo electrónico</Strong> ya existe en el sistema');
            $this->form_validation->set_message('validarContrasena', 'Los contraseñas no coinciden');

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
}

//fin del la clase
