<?php

if (!defined('BASEPATH'))
    exit('No ingrese directamente es este script');

/**
 * Esta clase permitirá administrar los usuarios que tendrán acceso al sistema
 *
 * @author YARA WEB Developer
 */
class Usuario extends Private_Controller {

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
        //determino cual es el acción
        $dataAction = $this->uri->segment(1) . "/crearUsuario";
        //creo los campos a seleccionar
        $dataSelect = "usu_id, usu_nombre, usu_apellido, est_id";
        //creo la condicional para no trer superadministradores
        $dataWhere = array(
            "usu_rol_id !=" => '1',
            "usu_id >" => '1'
        );
        //obtengo los registros
        $dataRegistros = $this->crud_model->obtenerRegistros("usuario", $dataWhere, $dataSelect);
        //obtengo los roles
        $dataRoles = $this->obtenerRolUsuario();
        //$pMensaje = NULL;
        if ($dataRoles == NULL):
            $pMensaje .= 'No puedes crear Usuarios sin asignar permisos a un rol. <a href="' . base_url("/permisorol") . '"> Click aqui para hacerlo</a>';
        endif;
        //obtener empresas

        if ($dataRoles == NULL) :

            //asigno un dato para validar en la vista
            //Envio un mensaje avisando que no puede crear usuarios
            $pMensaje = array(
                'mensaje' => '
                 <p>
                    <strong>
                    ¡Espera un Momento!
                    </strong>
                    ' . $pMensaje . '
                 </p>',
                'tipo' => 'alert-error'
            );

        endif;
        //preparo el array que se enviará
        $dataDatos = array(
            'Action' => $dataAction,
            'editar' => 0,
            'Registros' => $dataRegistros,
            'valorUsername' => NULL,
            'valorNombre' => NULL,
            'valorApellido' => NULL,
            'valorUser' => NULL,
            'valorIdentificacion' => NULL,
            'valorCelular' => NULL,
            'valorTelefono' => NULL,
            'valorCorreo' => NULL,
            'valorId' => NULL,
            'valorCiudad' => NULL,
            'dataCiudad' => NULL,
            'valorRolUsuario' => NULL,
            'dataRolUsuario' => $dataRoles,
            'valorEmpresa' => NULL,
            'dataEmpresa' => $dataRoles,
            'valorEstado' => NULL,
            'valorMensaje' => $pMensaje['mensaje'],
            'valorTipoMensaje' => $pMensaje['tipo']
        );
        $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
        //abro la vista
        $this->load->view("usuarios/usuario_view", $this->dataSend);
    }

//fin del metodo

    /*
     * -----------------------------------------------------------------------
     * Controlador para cargar en los controladores los datos para editar un
     * usuario
     * -----------------------------------------------------------------------
     * Párametros
     * @pId |   Int   | Valor defecto: NULL | Párametro identificador para 
     * filtrar usuario en la DB
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */
    public function editarUsuario($pId = NULL) {
        //verifico que el id no pertenezca a un superadministrador
        //obtengo los roles
        $dataRoles = $this->obtenerRolUsuario();
        $dataCiudad = $this->obtenerData('accesorio_ciudad');
        $pMensaje = NULL;
        if ($dataRoles == NULL):
            $pMensaje .= 'No puedes crear Usuarios sin asignar permisos a un rol. <a href="' . base_url("/permisorol") . '"> Click aqui para hacerlo</a>';
        endif;
        if ($dataCiudad == null):
            $pMensaje .= '<br /> No puedes crear usuarios sin crear/activar ciudades <a href="' . base_url("/ciudad") . ">Click aquí para hacerlo</a>";
        endif;
        if ($dataRoles == NULL || $dataCiudad == NULL) :

            //asigno un dato para validar en la vista
            //Envio un mensaje avisando que no puede crear usuarios
            $pMensaje = array(
                'mensaje' => '
                 <p>
                    <strong>
                    ¡Espera un Momento!
                    </strong>
                    ' . $pMensaje . '
                 </p>',
                'tipo' => 'alert-error'
            );
            //envio el array de mensaje a index
            $this->index($pMensaje);
        else:
            //Comprobar que el id desde que se accede cexiste
            if ($this->validarIdUsuario($pId)):
                if (!$this->validarAccesoUrl($pId)):

                    $this->controlarAcceso("get");
                    //determino cual es el acción
                    $dataAction = $this->uri->segment(1) . "/actualizarUsuario";
                    //creo el arreglo where
                    $dataWhere = array(
                        "usu_id" => $pId
                    );
                    //consulto el registro
                    $dataUsuario = $this->crud_model->obtenerRegistros("usuario", $dataWhere);
                    //itero los resultados
                    foreach ($dataUsuario as $itemUsuario):
                        $valorNombre = $itemUsuario->usu_nombre;
                        $valorApellido = $itemUsuario->usu_apellido;
                        $valorCedula = $itemUsuario->usu_documento;
                        $valorCiudad = $itemUsuario->ciu_id;
                        $valorTelefono = $itemUsuario->usu_telefono;
                        $valorCelular = $itemUsuario->usu_celular;
                        $valorCorreo = $itemUsuario->usu_correo;
                        $valorEstado = $itemUsuario->est_id;
                        $valorRolUsuario = $itemUsuario->usu_rol_id;
                        $valorId = $itemUsuario->usu_id;
                        $valorTipoDoc = $itemUsuario->tip_doc_id;
                    endforeach;
                    //preparo el array que enviará
                    $dataDatos = array(
                        'Action' => $dataAction,
                        'Registros' => NULL,
                        'valorNombre' => $valorNombre,
                        'valorApellido' => $valorApellido,
                        'valorCedula' => $valorCedula,
                        'valorTelefono' => $valorTelefono,
                        'valorCelular' => $valorCelular,
                        'valorCorreo' => $valorCorreo,
                        'valorId' => $valorId,
                        'valorCiudad' => $valorCiudad,
                        'dataCiudad' => $dataCiudad,
                        'valorTipoDoc' => $valorTipoDoc,
                        'dataTipoDoc' => $this->obtenerTipoDocumento(),
                        'dataRolUsuario' => $this->obtenerRolUsuario(),
                        'valorRolUsuario' => $valorRolUsuario,
                        'valorEstado' => $valorEstado,
                        'valorMensaje' => NULL,
                        'valorTipoMensaje' => NULL
                    );
                    $this->dataSend = array_merge((array) $this->dataSend, (array) $dataDatos);
                    //abro la vista
                    $this->load->view("usuarios/usuario_view", $this->dataSend);
                else: //Si el id pertenece a un Superadministrador
                    //lo llevo al inicio de la aplicacion
                    //preparo el array de mensaje y tipo de mensaje
                    $dataMensaje = array(
                        'mensaje' => '
                 <p>
                    <strong>
                    ¡Algo ha ido mal!
                    </strong>
                    No puedes ingresar a este Rol.
                 </p>',
                        'tipo' => 'alert-error'
                    );
                    //envio el array de mensaje a index
                    $this->index($dataMensaje);
                //redirect(base_url());
                endif; //fin de verificacion de superadministrador

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
        endif;
    }

//fin del controlador

    /*
     * -----------------------------------------------------------------------
     * Controlador para crear un usuario
     * ----------------------------------------------------------------------- 
     * Parametros
     * Sin varables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */
    public function crearUsuario() {
        //$this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar', 1)) :
            //creo el data insert
            $dataInsert = array(
                'usu_nombre' => $this->input->post('usu_nombre', TRUE),
                'usu_apellido' => $this->input->post('usu_apellido', TRUE),
                'usu_documento' => $this->input->post('usu_documento', TRUE),
                'usu_telefono' => $this->input->post('usu_telefono', TRUE),
                'usu_celular' => $this->input->post('usu_celular', TRUE),
                'usu_correo' => $this->input->post('usu_correo', TRUE),
                'usu_contrasena' => do_hash($this->input->post('usu_contrasena', TRUE), 'md5'),
                'ciu_id' => $this->input->post('ciu_id', TRUE),
                'est_id' => $this->input->post('est_id', TRUE),
                'tip_doc_id' => $this->input->post('tip_doc_id', TRUE),
                'usu_rol_id' => $this->input->post('usu_rol_id', TRUE),
                'usu_fecha_creacion' => date('Y-m-d'),
                'usu_id_edicion' => $this->user_id
            );
            if ($this->crud_model->agregarRegistro('usuario', $dataInsert) > 0 && $this->enviarCorreos($dataInsert)) :
                //preparo el mensaje y el tipo de mesaje
                $dataMensaje = array(
                    'mensaje' => '
                 <p>
                    <strong>
                    ¡Bien Hecho!
                    </strong>
                    Has creado el usuario con nombre: 
                    "' . $this->input->post('usu_nombre') . ' ' . $this->input->post('usu_apellido') . '" e identificado: ' . $this->input->post('usu_documento') . '
                        satisfacotriamente.
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
     * Controlador para actualizar un usuario
     * ----------------------------------------------------------------------- 
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * Sin variable de retorno
     * -----------------------------------------------------------------------
     */
    public function actualizarUsuario() {
        $this->controlarAcceso('post', 'guardar');
        if ($this->validarControles('guardar')) {
            //creo el data actualizar
            $dataActualizar = array(
                'usu_nombre' => $this->input->post('usu_nombre', TRUE),
                'usu_apellido' => $this->input->post('usu_apellido', TRUE),
                'usu_telefono' => $this->input->post('usu_telefono', TRUE),
                'usu_celular' => $this->input->post('usu_celular', TRUE),
                'usu_correo' => $this->input->post('usu_correo', TRUE),
                'ciu_id' => $this->input->post('ciu_id', TRUE),
                'est_id' => $this->input->post('est_id', TRUE),
                'tip_doc_id' => $this->input->post('tip_doc_id', TRUE),
                'usu_rol_id' => $this->input->post('usu_rol_id', TRUE),
                'usu_fecha_creacion' => date('Y-m-d'),
                'usu_id_edicion' => $this->user_id,
                'usu_fecha_edicion' => date('Y-m-d'),
                'usu_id_edicion' => $this->user_id
            );
            //creo el arreglo where
            $dataWhere = array(
                'usu_id' => $this->input->post('usu_id', TRUE)
            );
            if ($this->crud_model->actualizarRegistro("usuario", $dataActualizar, $dataWhere) > 0) {
                //preparo el array de mensaje y tipo de mensaje
                $dataMensaje = array(
                    'mensaje' => '
                 <p>
                    <strong>
                    ¡Perfecto!
                    </strong>
                    Has actualizado los datos de el usuario con nombre: "' . $this->input->post('usu_nombre') . ' ' . $this->input->post('usu_apellido') . '" satisfactoriamente.
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
     *  Controlador para confirmar un registro por documento usuario
     * -----------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -----------------------------------------------------------------------
     * Retorno
     * @valorRetorno | TRUE | Este se retorna si se encuentra en la DB valores 
     * similares de documento usuario
     */
    public function validarUsuario() {
        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'usu_documento' => $this->input->post('usu_documento', TRUE),
        );
        //creo el arreglo orwhere
        $dataWhereOr = array(
            'usu_correo' => $this->input->post('usu_correo', TRUE),
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'usuario',
            'dataColumns' => 'usu_id',
            'dataWhere' => $dataWhere,
            'dataWhereOr' => $dataWhereOr,
        );
        if ($this->crud_model->scalarRegistro($dataSendQuery)) {
            //cambio el valor Retorno
            $valorRetorno = TRUE;
        }
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
    public function validarUsuarioId() {

        //creo la variable de retorno
        $valorRetorno = FALSE;
        //creo el arreglo where
        $dataWhere = array(
            'usu_id !=' => $this->input->post('usu_id', TRUE),
            'usu_documento' => $this->input->post('usu_documento', TRUE)
        );
        //creo el arreglo orwhere
        $dataWhereOr = array(
            'usu_correo' => $this->input->post('usu_correo', TRUE),
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'usuario',
            'dataColumns' => 'usu_id',
            'dataWhere' => $dataWhere,
            'dataWhereOr' => $dataWhereOr,
        );
        if ($this->crud_model->scalarRegistro($dataSendQuery)) {
            //cambio el valor Retorno
            $valorRetorno = TRUE;
        }
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
            $valorValidacion = 'required|trim|numeric';
            if ($pTipo == 1):
                $valorValidacion .= '|callback_validarUsuario';
                $this->form_validation->set_rules('usu_documento', 'Documento de identidad', $valorValidacion);
                $this->form_validation->set_rules('usu_correo', 'Correo Electrónico', 'required|trim|valid_email');
                $this->form_validation->set_rules('usu_contrasena', 'Contraseña', 'required|trim');
            endif; //fin del if

            $this->form_validation->set_rules('usu_nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('usu_apellido', 'Apellido', 'required');
            $this->form_validation->set_rules('est_id', 'Estado', 'required|trim');
            $this->form_validation->set_rules('ciu_id', 'ciudad', 'required|trim');
            $this->form_validation->set_rules('usu_rol_id', 'Rol del Usuario', 'required|trim');
            //seteamos los mensajes para las funciones
            $this->form_validation->set_message('numeric', 'El campo <strong>%s</strong> debe contener solo números');
            $this->form_validation->set_message('required', 'El campo <strong>%s</strong> es obligatorio');
            $this->form_validation->set_message('valid_email', 'El campo <strong>%s</strong> debe ser un correo electrónico válido');
            $this->form_validation->set_message('validarUsuario', 'los datos que ingresó en los campos de <Strong>Documento</Strong> o <Strong>Correo electrónico</Strong> ya existente en el sistema');
            $this->form_validation->set_message('validarUsuarioId', 'Otro <strong>Usuario</Strong> ya existente en el sistema con los datos de <Strong>Documento</Strong> o <Strong>Correo electrónico</Strong>');

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
     *  controlador obtener el tipo de usuario
     * ----------------------------------------------------------------------- 
     */

    private function obtenerRolUsuario() {
        //Creo el array de condicionales
        $dataWhere = array(
            'usuario_rol.est_id' => 1,
            'usuario_rol.usu_rol_id >' => 1
        );
        //creo el dataJoin
        $dataJoin = array(
            'table' => 'modulo_acceso',
            'compare' => 'modulo_acceso.usu_rol_id = usuario_rol.usu_rol_id',
            'method' => 'inner'
        );
        //preparo el array group by
        $dataGroupby = array(
            'usu_rol_nombre'
        );
        //creo los campos a seleccionar de tipo usuario
        $dataConsulta = array(
            'dataColumns' => 'usuario_rol.usu_rol_id, usuario_rol.usu_rol_nombre',
            'dataWhere' => $dataWhere,
            'dataTable' => 'usuario_rol',
            'dataWhereOr' => NULL,
            'dataOrder' => NULL,
            'dataGroupBy' => $dataGroupby,
            'dataJoin' => $dataJoin
        );
        //obtengo los registros
        $dataTipoUsuario = $this->crud_model->obtenerRegistrosFull($dataConsulta);
        //devolvemos la data
        return $dataTipoUsuario;
    }

//fin de la función

    /*
     * -------------------------------------------------------------------------
     * Control para obtener tipo de documento
     * -------------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -------------------------------------------------------------------------
     * Retorno
     * @dataTipoEmp | array | Si la consulta es correcta retorna los datos encontrados
     */
    private function obtenerTipoDocumento() {
        //crear campos a seleccionar tipo de documentos
        $dataSelectTipoDoc = "tip_usu_id, tip_usu_nombre";
        //Traer los datos que tengan como estado activo
        $dataWhereTipoDoc = array(
            "est_id" => 1
        );
        //obtener los registros
        $dataTipoDoc = $this->crud_model->obtenerRegistros("accesorio_tipo_usuario", $dataWhereTipoDoc, $dataSelectTipoDoc);

        return $dataTipoDoc;
    }

    //fin de la función
    //fin de la función

    /*
     * -------------------------------------------------------------------------
     * Control para obtener tipo de validar acceso url de un superadministrador
     * -------------------------------------------------------------------------
     * Parametros
     * Sin variables de parametros
     * -------------------------------------------------------------------------
     * Retorno
     * @valorReotrno | true | Si la funcion encuentra que el usuario es superadministrador
     */
    public function validarAccesoUrl($pId) {
        //variable de retorno
        $valorRetorno = false;

        //crear campos a seleccionar tipo de documentos
        $dataSelectTipoDoc = "usu_rol_id";
        //Traer los datos que tengan como estado activo
        $dataWhereTipoDoc = array(
            "est_id" => 1,
            "usu_id" => $pId,
            "usu_rol_id" => 1
        );
        //obtener los registros
        $dataUsuario = $this->crud_model->obtenerRegistros("usuario", $dataWhereTipoDoc, $dataSelectTipoDoc);
        //Si el aray no viene vacio, encontro una coincidencia
        if ($dataUsuario != NULL):
            //cambio el valor de la variable de retorno
            $valorRetorno = TRUE;
        endif; //fin comparacion del array
        return $valorRetorno; //retorno la variable
    }

    //fin de la función

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

    public function validarIdUsuario($pId) {
        //creo la variable de retorno
        $valorRetorno = TRUE;
        //creo el arreglo where
        $dataWhere = array(
            'usu_id' => $pId
        );
        //creo la data completa para la consulta
        $dataSendQuery = array(
            'dataTable' => 'usuario',
            'dataColumns' => 'usu_id',
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

    public function enviarCorreos($pDatos) {
        $valorRetorno = FALSE; //variable de retorno
        //preparo el mensaje al administrador que creo el nuevo usuario
        $dataCorreo = array(
            'dataNombre' => $this->session->userdata('user_nombre'),
            'dataCorreo' => $this->user_correo,
            'dataAsunto' => 'Creación de nuevo usuario',
            'dataMensaje' => 'Sr(a). ' . $this->session->userdata('user_nombre') . ' <br />'
            . 'Ha creado un nuevo usuario con los siguientes datos: <br />'
            . '<ul>'
            . '<li> Nombre: ' . $pDatos['usu_nombre'] . ' </li>'
            . '<li> Apelllido: ' . $pDatos['usu_apellido'] . ' </li>'
            . '<li> Documento: ' . $pDatos['usu_documento'] . ' </li>'
            . '<li> Correo: ' . $pDatos['usu_correo'] . ' </li>'
            . '</ul>'
            . '<br /> Este es un mensaje automatico'
        );
        //envio el correo al Administrador
        $valorRetorno = $this->my_phpmailer->enviarCorreo($dataCorreo);
        if ($valorRetorno == TRUE):
            //preparo el mensaje al nuevo usuario creado
            $dataCorreo = array(
                'dataNombre' => $pDatos['usu_nombre'],
                'dataCorreo' => $pDatos['usu_correo'],
                'dataAsunto' => 'Bienvenido a KFC Amigos - Nuevo Usuario',
                'dataMensaje' => 'Bienvenido. ' . $pDatos['usu_nombre'] . ' a KFC Amigos <br />'
                . 'Sus datos de acceso al sistema son: <br />'
                . '<ul>'
                . '<li> Documento: ' . $pDatos['usu_documento'] . ' </li>'
                . '<li> Correo: ' . $pDatos['usu_correo'] . ' </li>'
                . '<li> Contraseña: ' . $this->input->post('usu_contrasena', TRUE) . ' </li>'
                . '</ul>'
                . '<br /> Recuerde que puede ingresar con el Documento o Correo.'
                . '<br /> Por su seguridad ingrese y cambie su contraseña <a href="' . base_url() . '">KFC Amigos</a>'
                . 'Este es un mensaje automatico.'
            );
            //envio el correo al Administrador
            $valorRetrono = $this->my_phpmailer->enviarCorreo($dataCorreo);
        endif;
        return $valorRetorno;
    }

    //fin del control
}

//fin del la clase
