<?php

/**
 *  Este controlador es que tendrá todas las funciones accesorias requeridas para
 *  toda la aplicación, como la validación de session, redireccionamiento, 
 *  cotrolador para manejar el acceso de la url por get o por post.
 * 
 *  @author YARA WEB Developer
 */
class Private_Controller extends CI_Controller {

    //atributo de validación para la session
    public $user_id;
    public $user_rol;
    public $user_correo;
    //atributo donde se listarán los módulos
    public $listaModulos;
    public $dataSend = array();

    /*
     * -----------------------------------------------------------------------
     * Cosntructor de la clase
     *  Esta clase es la que realiza la validación de la sessión
     * -----------------------------------------------------------------------
     */

    public function __construct() {
        parent::__construct();
        //cargo el modelo 
        $this->load->model('usuarios/modulos_model');
        // asigno lo que exista en la sessión de user_id y de rol
        $this->user_id = @$this->session->userdata('user_id');
        $this->user_rol = @$this->session->userdata('user_rol_id');
        $this->user_correo = @$this->session->userdata('user_correo');
        //valido si hay sesión, de lo contrario lo redireccionamos al login
        if (!@$this->user_id) :
            redirect('/login/');
        else:
            //lleno el arreglo send con los modulos y los datos del usurio
            $this->listaModulos = array(
                "listaModulos" => $this->listarModulos($this->user_rol),
                "nombreUsuario" => @$this->session->userdata('user_nombre'),
                "apellidoUsuario" => @$this->session->userdata('user_apellido'),
                "correoUsuario" => @$this->session->userdata('user_correo'),
                "fotoUsuario" => @$this->session->userdata('user_foto'),
                "dataModuloActual" => $this->registrarAccesoHistorial($this->user_id, 2)[0],
                "modulosInicio" => $this->consultarModulosRecientes($this->user_id),
            );

            // Asigno la respuesta de la funcion al verificar acceso a modulos
            $urlAcceso = $this->uri->segment(1);
            if ($urlAcceso != NULL):
                if ($this->modulos_model->obtenerModulos($urlAcceso)):
                    // Asigno la respuesta de la funcion al verificar acceso a modulos
                    $accesoModulo = $this->modulos_model->verificarAccesoUrl(@$this->user_rol, $urlAcceso);
                    //verifico si el rol no tiene acceso a este modulo
                    if (!$accesoModulo):
                        //lo redirecciono al inicio de la aplicacion
                        redirect(base_url());
                    else:
                        //registro el acceso a un controlador
                        $this->registrarAccesoHistorial($this->user_id);
                    endif;
                endif;
            endif;
        endif;
        //fin del if - else
    }

//fin del constructor


    /*
     * -----------------------------------------------------------------------
     * Controlador para listar los módulos
     * -----------------------------------------------------------------------
     */
    public function listarModulos($pIdRolUsuario) {
        $moduloActual = $this->registrarAccesoHistorial($this->user_id, 2)[0];
        $valorModulos = '<ul class="sidebar-menu">
                        <li class="active">
                            <a href="' . base_url() . '">
                                <i class="fa fa-dashboard"></i> <span>Inicio</span>
                            </a>
                        </li>
       ';
        //obtengo los módulos a los que tienen acceso el usuario
        $dataModuloGeneral = $this->modulos_model->consultarModulosGeneral($pIdRolUsuario);
        if ($dataModuloGeneral != NULL) {
            //iteramos los resultados
            $valorActivo = NULL;
            foreach ($dataModuloGeneral as $itemModuloGeneral):
                if ($moduloActual != NULL):
                    if ($itemModuloGeneral->mod_dependencia == $moduloActual->mod_dependencia):
                        $valorActivo = " active";
                    else:
                        $valorActivo = NULL;
                    endif;
                endif;

//                var_dump($moduloActual->mod_dependencia);
//                var_dump($itemModuloGeneral->mod_dependencia);
                /*
                 * <li class="treeview">
                  <a href="#">
                  <i class="fa fa-bar-chart-o"></i>
                  <span>Accesorios</span>
                  <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                  <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                  <li><a href="pages/charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                  <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                  </ul>
                  </li>
                 */
                //iteramos los resultados
                $valorModulos .= '<li class="treeview' . $valorActivo . '">
                  <a href="#">
                  <i class="fa ' . $this->consultarNombreModulo($itemModuloGeneral->mod_dependencia)->mod_clase_icono . '"></i>
                  <span>' . $this->consultarNombreModulo($itemModuloGeneral->mod_dependencia)->mod_nombre . '
                  </span>
                 <i class="fa fa-angle-left pull-right"></i></a>
                ';
                $valorModulos .=$this->listarModulosLista($itemModuloGeneral->mod_dependencia, $pIdRolUsuario);
                $valorModulos .='
                </li>
                ';
            endforeach;
        }
        $valorModulos .='
                                </ul>

        ';
        //devuelvo el valor Modulos
        return $valorModulos;
    }

//fin del controlador


    /*
     * -----------------------------------------------------------------------
     * Controlador para consultar el nombre del módulo
     * -----------------------------------------------------------------------
     */
    private function consultarNombreModulo($pIdModulo) {
        $valorRetorno = NULL;
        //obtengo los módulos a los que tienen acceso el usuario
        $dataListaModulo = $this->modulos_model->consultarNombreModulo($pIdModulo);
        //asignar la posicion
        $valorRetorno = $dataListaModulo[0];
        //devolvemos el valor Retorno
        return $valorRetorno;
    }

//fin del controlador


    /*
     * -----------------------------------------------------------------------
     * Controlador para listar los módulos
     * -----------------------------------------------------------------------
     */

    private function listarModulosLista($pIdModulo, $pIdRolUsuario) {
        $moduloActual = $this->registrarAccesoHistorial($this->user_id, 2)[0];
        $valorRetorno = NULL;
        //obtengo los módulos a los que tienen acceso el usuario
        $dataListaModulo = $this->modulos_model->consultarListaModulos($pIdModulo, $pIdRolUsuario);
        if ($dataListaModulo != NULL) {
            $valorRetorno = '<ul class="treeview-menu">';
            $valorActivo = NULL;
            foreach ($dataListaModulo as $itemListaModulo):
                if ($moduloActual != NULL):
                    if ($itemListaModulo->mod_id == $moduloActual->mod_id):
                        $valorActivo = " active";
                    else:
                        $valorActivo = NULL;
                    endif;
                endif;

                $valorRetorno .='<li class="' . $valorActivo . '"><a href="' . base_url($itemListaModulo->mod_url) . '" title="' . $itemListaModulo->mod_nombre . '"><i class="fa fa-angle-double-right"></i> ' . $itemListaModulo->mod_nombre . '</a></li>';
            endforeach;
            $valorRetorno .= '</ul>';
        }
        return $valorRetorno;
        //
    }

//fin del controlador


    /*
     * -----------------------------------------------------------------------
     *  controlador para redireccionar
     * ----------------------------------------------------------------------- 
     */

    public function redireccionar($pSegmento = 1, $Variable = 'uno') {
        redirect($this->uri->segment($pSegmento), 'refresh');
    }

//fin del controlador    


    /*
     * -----------------------------------------------------------------------
     *  controlador para manejar accesos a ciertas posiciones del la url
     * ----------------------------------------------------------------------- 
     */

    public function controlarAcceso($pAccion, $pControl = NULL) {
        //creo la variable control

        if ($pAccion == "post") {
            //si es el caso de post
            if (!$this->input->post($pControl)) {
                $this->redireccionar();
            }
        } else if ($pAccion == 'get') {
            if ($this->uri->segment(3) == NULL) {
                $this->redireccionar();
            }
        }
    }

//fin del controlador    

    /*
     * -----------------------------------------------------------------------
     *  controlador para mostrar el header y footer
     * ----------------------------------------------------------------------- 
     */

    public function construccionSitio($pHeader = "generalheader_view", $pFooter = "generalfooter_view") {
        //obtengo las secciones de código para la construcción del sitio
        $this->dataSend['header'] = $codeHeader = $this->load->view('recursos/' . $pHeader, $this->listaModulos, TRUE);
        $this->dataSend['footer'] = $codeFooter = $this->load->view('recursos/' . $pFooter, '', TRUE);
    }

//fin del controlador   


    /* -------------------------------------------------------------------------
     * Controlador para registrar el acceso a una base de datos
     * -------------------------------------------------------------------------
     * @pIdUsuario | int | id del usuario
     */
    private function registrarAccesoHistorial($pIdUsuario = NULL, $pTipo = 0) {
        //obtener url
        $dataUrl = $this->uri->segment(1);
        //obtener id de la url
        $dataIdUrl = $this->crud_model->obtenerRegistros("modulo", 'mod_url = "' . $dataUrl . '"', "mod_id, mod_nombre, mod_clase_icono, mod_url, mod_descripcion, mod_dependencia");
        //tipo de consulta
        if ($pTipo == 0): // si es normal
            //verifico que no venga vacio la consulta
            if ($dataIdUrl != NULL):
                //array para el ingreso los datos
                $dataInsert = array(
                    'mod_id' => $dataIdUrl[0]->mod_id,
                    'usu_id' => $pIdUsuario,
                    'log_acc_his_fecha' => date("Y-m-d H:i:s")
                );
                $this->crud_model->agregarRegistro('log_acceso_historial', $dataInsert);
            endif;
        elseif ($pTipo == 2): //si se quiere recibir datos de la uri
            //obtener el nombvre de la url
            $dataIdUrl = $this->crud_model->obtenerRegistros("modulo", 'mod_url = "' . $dataUrl . '"', "mod_id, mod_nombre, mod_clase_icono, mod_url, mod_descripcion, mod_dependencia");
            //retornar estos datos
            return $dataIdUrl;
        else:
            if ($dataIdUrl != NULL): //si no está vacio
                //$dataIdUrl[1] = NULL;
                $dataIdUrl ["mod_sub"] = NULL;
                if ($this->uri->segment(2) != NULL): //Si se ingresa a un modulo del acceso
                    $dataSegmento = strpos($this->uri->segment(2), "editar"); //busco la palabra editar
                    //echo $this->uri->segment(2);
                    //var_dump($dataSegmento);
                    if ($dataSegmento !== false): //si se encuentra la cadena
                        //echo "se ha encontrado la palabra deseada!!!!";
                        //echo $this->uri->segment(2);
                        $dataDatos = array(
                            "mod_sub" => "Editar " . $dataIdUrl[0]->mod_nombre
                        );
                        $dataIdUrl = array_merge((array) $dataIdUrl, (array) $dataDatos);
                    //añado una posicion al resultado
                    endif;
                endif;
            endif;
            return $dataIdUrl;
        endif;
    }

//fin del controlador

    /*
     * -----------------------------------------------------------------------
     *  Controlador para obtener datos
     * -----------------------------------------------------------------------
     * Parametros
     * @pTabla | tabla de donde se van a traer los datos
     * @pCampos | campos a seleccionar
     * @pWhere | condicion para traer los campos
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | array | campos retornados por la DB
     */

    public function obtenerData($pTabla, $pCampos = NULL, $pWhere = NULL) {
        $dataSelect = null;
        //creo los campos a seleccionar de tipo persona
        if ($pCampos != null):
            $dataSelect = $pCampos;
        endif;
        //creo los campos a seleccionar de tipo persona

        if ($pWhere == NULL):
            $dataWhere = array(
                "est_id" => 1
            );
        else:
            $dataWhere = $pWhere;
        endif;
        //obtengo los registros
        $dataRegistros = $this->crud_model->obtenerRegistros($pTabla, $dataWhere, $dataSelect);
        //devolvemos la data
        return $dataRegistros;
    }

    /* -------------------------------------------------------------------------
     * Controlador para cargar los modulos recientes
     * -------------------------------------------------------------------------
     * @pIdUsuario | int | id del usuario para buscarlo en la base de datos
     * -------------------------------------------------------------------------
     */

    private function consultarModulosRecientes($pIdUsuario) {
        //crear el array de datos para seleccionar
        //array where
        $dataWhere = array(
            'log_acceso_historial.usu_id' => $pIdUsuario
        );
        //array para el join
        $dataJoin = array(
            'table' => 'modulo',
            'compare' => 'log_acceso_historial.mod_id = modulo.mod_id',
            'method' => 'left'
        );

        $dataSendQuery = array(
            'dataTable' => 'log_acceso_historial',
            'dataColumns' => 'log_acceso_historial.mod_id, max(`log_acc_his_fecha`) log_acc_his_fecha, modulo.mod_nombre, modulo.mod_clase_icono, modulo.mod_url',
            'dataWhere' => $dataWhere,
            'dataWhereOr' => NULL,
            'dataJoin' => $dataJoin,
            'dataOrder' => "log_acc_his_fecha desc",
            'dataGroupBy' => "log_acceso_historial.mod_id",
            'dataLimit' => 4
        );
        //ejecuto la consulta
        $modulosRecientes = $this->crud_model->obtenerRegistrosFull($dataSendQuery);

        return $this->listarModulosRecientes($modulosRecientes);
    }

//fin del controlador


    /* -------------------------------------------------------------------------
     * Controlador para listar los modulos recientes
     * -------------------------------------------------------------------------
     * @pModulosRecientes | array | modulos recientes
     * -------------------------------------------------------------------------
     */
    public function listarModulosRecientes($pModulosRecientes, $tipo = 1) {

        $this->load->library("colors/color_library");
        /**
         *
         */
        //variable de retorno
        $valorRetorno = NULL;
        if ($pModulosRecientes != NULL):
            //inicio los datos que se van a llevar
            $valorRetorno .=' <div class="row">';
            //itero los modulos
            foreach ($pModulosRecientes as $itemModulosReciente):
                $color = $this->color_library->getRandomColor();

                $valorRetorno .= ' 
          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-' . $color . '">
          <div class="inner">
          <h3>
          ' . $itemModulosReciente->mod_nombre . '
          </h3>
          <p>
            Últimos Accesos
          </p>
          </div>
          <div class="icon">
          <i class="fa ' . $itemModulosReciente->mod_clase_icono . '"></i>
          </div>
          <a href="' . base_url($itemModulosReciente->mod_url) . '" class="small-box-footer">
          Visitar <i class="fa fa-arrow-circle-right"></i>
          </a>
          </div>
          </div><!-- ./col -->';
            endforeach;
        else: //si viene vacio
            $valorRetorno .= '<h5 class="subtitle">Bienvenido a la Politeca!</h5>';
        endif;
        //devuelvo la variable
        $valorRetorno .= "</div>";
        return $valorRetorno;
    }

    //fin del controlador

    /**
     * Controlador ara obgtener los datso de un usuario por el ID
     * 
     * @name getUserDataById
     * @access public
     * @return array Array con los datos del usuario
     * @param int $pID Id asignado en la base de datos del usuario
     */
    public function getUserDataById($pID) {
        //obtener los datos
        $dataUsuario = $this->obtenerData('usuario', NULL, 'usu_id =' . $pID);
        //retornar los datos si se encuentra, si no se retorna un null
        if ($dataUsuario != NULL):
            //RETORNANDO los datos
            return $dataUsuario[0];
        else:
            return NULL;
        endif;
    }

}

//fin de la clase
