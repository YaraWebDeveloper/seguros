<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Libreria creada para obtener un color random de un array. Estos colores deben estar en los archivos css
 * del tema de administrador, determinados con el identificador .bg-color
 * 
 * Ejemplo:
 * .bg-aqua;
 * 
 * @access public
 * @name color_library
 * @author YARA WEB Developer
 */
class color_library {

    /**
     * Variable donde estan almacenados los colores en inglés
     * 
     * @access public
     * @name $arrayColors
     */
    public $arrayColors = array(
        "red",
        "blue",
        "green",
        "aqua",
        "yellow",
        "maroon"
    );

    /**
     * Obtener un color random del array.
     * 
     * @name getRandomColor
     * @access public
     * @return Strign Nombre de un color en Inglés.
     */
    public function getRandomColor() {
        //devolver un parametro random de color
        $dataColor = array_rand($this->arrayColors);
        //devolver el valor
        return (string) $this->arrayColors[$dataColor];
    }

}
