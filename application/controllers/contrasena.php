<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 * Esta clase permitirá actualizar los datos de un perfil de usuario
 *
 * @author YARA WEB Developer
 */
class Contrasena extends Private_Controller {

//constructor de la clase
    public function __construct() {
        parent::__construct();
        $this->construccionSitio();
        $this->load->library('My_PHPMailer');
    }

//fin del constructor de la clase

    /*
     * -----------------------------------------------------------------------
     * controlador index
     * -----------------------------------------------------------------------
     */

    public function index($pMensaje = NULL) {
        $dataAction = $this->uri->segment(1) . "/actualizarContrasena";
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
            'valorId' => $valorId,
            'valorPass' => NULL,
            'valorMensaje' => $pMensaje['mensaje'],
            'valorTipoMensaje' => $pMensaje['tipo']
        );
        $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
//abro la vista
        $this->load->view("usuarios/contrasena_view", $this->dataSend);
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

    public function actualizarContrasena() {
        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar')) {

            //Asigno la contraseña del usuario por post 
            $dataContrasena = $this->input->post('usu_contrasena', TRUE);
            $dataContrasenaActual = $this->validarContrasenaDB();

            //comparar que la dataContrasena no este vacia
            if ($dataContrasena != NULL) :
                if ($dataContrasenaActual):
                    $retornoContrasena = do_hash($this->input->post('usu_contrasena', TRUE), 'md5');
                endif;
            endif;

//creo el data actualizar
            $dataActualizar = array(
                'usu_contrasena' => $retornoContrasena
            );
//creo el arreglo where
            $dataWhere = array(
                'usu_id' => $this->input->post('usu_id', TRUE)
            );
            if ($this->crud_model->actualizarRegistro("usuario", $dataActualizar, $dataWhere) > 0 && $this->enviarCorreo()) {
                //preparo el array de mensaje y tipo de mensaje
                $dataMensaje = array(
                    'mensaje' => '
                 <p>
                    <strong>
                    ¡Perfecto!
                    </strong>
                    Has actualizado tu contraseña correctamente
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
     *  Controlador para confirmar la coincidencia de contraseñas en la DB
     * -----------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | TRUE | Este se retorna si las contraseñas coinciden.
     */

    public function validarContrasenaDB() {
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'usu_id' => $this->user_id
        );
//consulto el registro
        $dataUsuario = $this->crud_model->obtenerRegistros('usuario', $dataWhere);
//itero los resultados
        foreach ($dataUsuario as $itemUsuario):
            $dataContrasena = $itemUsuario->usu_contrasena;
        endforeach;
        //encipto la contraseña para verificar
        $dataActualContrasena = do_hash($this->input->post('usu_actual_contrasena', TRUE), 'md5');
        //comparo la contraseña que viene por metodo post
        if ($dataContrasena == $dataActualContrasena):
            //cambio el valor de la variable de retorno
            $valorRetorno = TRUE;
        endif;
        //retorno la variable
        return $valorRetorno;
    }

    //Fin del metodo

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


            if ($this->input->post('usu_contrasena', TRUE) != NULL) :
                $this->form_validation->set_rules('usu_contrasena', 'Contraseña', 'callback_validarContrasena');
                $this->form_validation->set_rules('usu_contrasena', 'Contraseña', 'callback_validarContrasenaDB');
            endif;
//seteamos los mensajes para las funciones
            $this->form_validation->set_message('numeric', 'El campo <strong>%s</strong> debe contener solo números');
            $this->form_validation->set_message('required', 'El campo <strong>%s</strong> es obligatorio');
            $this->form_validation->set_message('validarContrasena', 'Los contraseñas no coinciden');
            $this->form_validation->set_message('validarContrasenaDB', 'La contraseña actual no coincide');

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
     * -------------------------------------------------------------------------
     * Metodo para enviar correos a la creacion de un usuario.
     * -------------------------------------------------------------------------
     * Parametros
     * @pDatos | array | datos del nuevo usuario
     * -------------------------------------------------------------------------
     * Retorno
     * @valorRetorno | boolean | si se envian los mensajes correctamente
     */

    public function enviarCorreo() {
        $valorRetorno = FALSE; //variable de retorno
        //preparo el mensaje al administrador que creo el nuevo usuario
        $dataCorreo = array(
            'dataNombre' => $this->session->userdata('user_nombre'),
            'dataCorreo' => $this->user_correo,
            'dataAsunto' => 'Creación de nuevo usuario',
            'dataMensaje' => 'Sr(a). ' . $this->session->userdata('user_nombre') . ' <br />'
            . 'Soporte IT informa que se ha cambiado la contraseña de la cuenta: ' . $this->user_correo
            . '<p>Si no lo hiciste, contacta de inmediato al administrador del sistema.</p>'
            . '<p></p> Este es un mensaje automatico.'
        );
        //envio el correo al Administrador
        $valorRetorno = $this->my_phpmailer->enviarCorreo($dataCorreo);
        return $valorRetorno;
    }

    //fin del control
}

//fin del la clase
