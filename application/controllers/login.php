<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author YARA WEB Developer
 */
class Login extends CI_Controller {

    public $user_id;

    //constructor de la clase
    public function __construct() {
        parent::__construct();
        //cargo el modelo login
        $this->load->model('login/login_model');
    }

//fin del constructor

    /*
     * -----------------------------------------------------------------------
     * controlador index
     *  Recibe como parametro un Arreglo; se debe estar seguro que siempre
     *  se enviará un arreglo de datos o en su defecto no enviar nada
     * -----------------------------------------------------------------------
     */

    public function index($pDatos = NULL) {
        $this->user_id = @$this->session->userdata('user_id');
        if (!@$this->user_id):
            //defino el arreglo de envio
            $dataSend = array(
                'mensaje_error' => NULL
            );
            //verifico si llega algo en el parametro
            if ($pDatos != NULL) {
                //asigno el parametro a DataSend
                $dataSend = $pDatos;
            }//fin del if
            $this->load->view("login/login_view", $dataSend);
        else:
            redirect('/inicio/');
        endif;
    }

    /*
     * -----------------------------------------------------------------------
     * controlador iniciarSesion
     * -----------------------------------------------------------------------
     */

    public function iniciarSesion() {
        //validamos si hay algún post
        if ($this->input->post("ingresar")):
            //validamos los datos
            $this->form_validation->set_rules('text_user', 'Usuario', 'required|trim');
            $this->form_validation->set_rules('text_contrasena', 'Contraseña', 'required|trim');
            //seteamos los mensajes para las funciones
            $this->form_validation->set_message('required', 'El campo %s es obligatorio');
            //verificamos que las reglas se hallan cumplido
            if ($this->form_validation->run()):
                //si las reglas se cumplen pasamos consultar el usuario
                $consultarDatos = $this->login_model->consultarDatos();
                //validamos los resultado obtenidos
                if ($consultarDatos != null):
                    //si llega el valor true paso a crear la sessión
                    $this->crearSesion($consultarDatos);
                    //redirecciono a inicio
                    redirect('inicio/');
                else:
                    //creamos el mensaje de error
                    $dataSend = array('mensaje_error' => 'El usuario y(o) contraseña son erroneos');
                    //delvolvemos al inicio de login
                    $this->index($dataSend);
                endif;
            else:
                //devolvemos al inicio del login
                $this->index();
            endif;

        else:
            //si no hay post redireccionamos a login
            redirect("login/");

        endif;
    }

//fin del método

    /*
     * -----------------------------------------------------------------------
     * controlador cerrarSesion
     * -----------------------------------------------------------------------
     */

    public function cerrarSesion() {

        //validamos si hay algún post
        $this->session->sess_destroy();
        //redirecciono al inicio
        redirect("inicio/");
    }

    /*
     * -----------------------------------------------------------------------
     * controlador crearSession
     * -----------------------------------------------------------------------
     */

    private function crearSesion($pObjetoUsuario) {

        $userId = $pObjetoUsuario->usu_id;
        $userNombre = $pObjetoUsuario->usu_nombre;
        $userApellido = $pObjetoUsuario->usu_apellido;
        $userRol = $pObjetoUsuario->usu_rol_id;
        $userCorreo = $pObjetoUsuario->usu_correo;
        $userPhoto = $pObjetoUsuario->usu_foto;
        try {

            $this->session->set_userdata('user_id', $userId);
            $this->session->set_userdata('user_nombre', $userNombre);
            $this->session->set_userdata('user_apellido', $userApellido);
            $this->session->set_userdata('user_rol_id', $userRol);
            $this->session->set_userdata('user_correo', $userCorreo);
            $this->session->set_userdata('user_foto', $userPhoto);
        } catch (Exception $ex) {
            
        }//fin del try-catch
    }

//fin del controlador
}

//fin de la clase
