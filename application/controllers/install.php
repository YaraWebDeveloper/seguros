<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 * Esta clase permitirá administrar los usuarios que tendrán acceso al sistema
 *
 * @author YARA WEB Developer
 */
class Install extends Private_Controller {

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
        $pMensaje = array(
            'mensaje' => NULL,
            'tipo' => NULL
        );
        $dataDatos = array(
            "valorMensaje" => $pMensaje['mensaje'],
            "valorTipoMensaje" => $pMensaje['tipo']
        );
        $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
        //abro la vista
        $this->load->view("install_view", $this->dataSend);
        // Ejemplo 2
        /* $datos = "foo:*:1023:1000::/home/foo:/bin/sh";
          list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $datos);
          echo $user, $pass, $uid, $gid, $gecos, $home, $shell; */
        //echo 'Se ha instalado lo necesario para Trabajar con solucion it';
        //echo 'el superadministrador es: @nombre de superadministrador';
    }

    /* --------------------------------------------------------------------------
     * Controlador para crear estados
     * -------------------------------------------------------------------------
     * Parametros
     * Sin variables
     * -------------------------------------------------------------------------
     * Retorno
     * @valorRetorno || TRUE || Si se ingresan los estados y tipo estado correctamente
     */

    public function crearEstados() {
        //variable de retorno
        $valorRetorno = FALSE;
        //preparo los datos de tipo estado que se van a ingresar
        $dataInsert = array(
            'est_tip_nombre' => "Acceso"
        );
        //creo los tipos de estado
        if ($this->crud_model->agregarRegistro('estado_tipo', $dataInsert) > 0) :
            //creo el data insert
            $dataInsert = array(
                'est_nombre' => $this->input->post('tip_doc_nombre', TRUE),
                'tip_est' => 1
            );
            //crear estados
            if ($this->crud_model->agregarRegistro('estados', $dataInsert) > 0) :
                //si todo es correcto
                $valorRetorno = TRUE;
            endif;

        endif;
    }
    
    /* --------------------------------------------------------------------------
     * Controlador para instalar los modulos y crear Super usuario
     * -------------------------------------------------------------------------
     */

    /* public function InstalarModulos() {
      //archivo que vamos a abrir
      $archivo = "instal.txt";

      //verifico que el archivo exista
      if (file_exists($archivo)):
      //busco el archivo donde se encuentran los datos del administrador
      $file = fopen($archivo, "r") or exit("Unable to open file!");
      //Mientrs el archivo tenga lineas
      while (!feof($file)) :
      //asigno el dato de la linea a una variable
      $datos = fgets($file);
      //verfico que no venga vacia la linea
      if ($datos != NULL) :
      //divido la linea y asigno los datos necesarios para la asignacion de modulos
      list($mod_nombre, $mod_url, $mod_depe) = explode("||", $datos);
      //verifico si el modulo tien menos de 3 caracteres es un modulo general
      if (strlen($mod_depe) < 3):
      //imprimo que es un modulo general
      echo 'insertar en la base de datos con dependencia 0<p/>';
      else: //si tiene mas de 3 caracteres
      //imprimo que tiene mas de tres caracteres
      echo 'buscar moddependencia por url y traer id<br/>';
      echo 'insertar modulo con dependencia de id<p/>';
      endif; //fin de verificacion modulo general
      endif; //fin de verificacion datos diferentes de null
      endwhile; //fin del recorrido del archivo por lineas
      fclose($file); //cierro el archivo
      endif; //fin de verificacion de existencia de archivo
      }
     */
}

//fin del la clase
