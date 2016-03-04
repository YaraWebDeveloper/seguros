<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 * Carga el inicio de la aplicacion, aquí se van a listar los úlitmos módulos visitados, notificaciones, ETC.
 *
 * @author YARA WEB DEVELOPER
 * @access public
 */
class Inicio extends Private_Controller {

    /**
     * El constructor de la clase, hace referencia al contructor del elemento padre.
     * 
     * @access public
     * @name contruct
     */
    public function __construct() {
        parent::__construct();
        //construyo el sitio
        $this->construccionSitio();
    }

//fin del constructor

    /**
     * Función index, este carga la vista principal que esta en views/inicio_view.php
     * 
     * @name index
     * @access public
     */
    public function index() {
        //array de los datos
        $dataDatos = array(
        );
        //concatenar los datos
        $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
        //cargar la vista de inicio
        $this->load->view("inicio_view", $this->dataSend);
    }

  
}
