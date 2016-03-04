<?php if ( ! defined('BASEPATH')) exit('No ingrese directamente es este script');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validarsesion_library
 *
 * @author jucactru
 */
class Validarsesion_library {
    
    //constructor
    public function __construct() {
        
    }//fin del constructor
    
     /*
     * -----------------------------------------------------------------------
     * método validar sesion
     * -----------------------------------------------------------------------
     */
    public function validarSession(){
        //cargo la libreria
        if(!$this->session->userdata('user_id')){
           //no hay session
           //redireccionamos al login porque no hay session
           redirect('login/');
        } //fin del if
        
    }//fin del metodo
}
