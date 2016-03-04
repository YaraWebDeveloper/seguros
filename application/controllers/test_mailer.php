<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 * Esta clase permitirá actualizar los datos de un perfil de usuario
 *
 * @author YARA WEB Developer
 */
class Test_mailer extends Private_Controller {

//constructor de la clase
    public function __construct() {
        parent::__construct();
        //$this->construccionSitio();
        $this->load->library('My_PHPMailer');
    }

//fin del constructor de la clase

    /*
     * -----------------------------------------------------------------------
     * controlador index
     * -----------------------------------------------------------------------
     */

    public function index() {
        //array del correo
        $dataCorreo = array(
            'dataNombre' => 'Luis Fernando Yara',
            'dataCorreo' => $this->session->userdata('user_correo'),
            'dataAsunto' => 'Soporte IT - Test',
            'dataMensaje' => 'Esto es un mensaje automatico de Soporte It.'
        );

        //envio el correo
        $this->my_phpmailer->enviarCorreo($dataCorreo);
    }

}

//fin del la clase
