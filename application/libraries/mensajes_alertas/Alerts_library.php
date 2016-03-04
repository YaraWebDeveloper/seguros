<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Libreria creada para obtener los mensajes que se van a mostrar en la vista
 * 
 * 
 * @access public
 * @name alerts_library
 * @author YARA WEB Developer
 */
class Alerts_library {

    /**
     * Obtener alerta de tipo Información
     * 
     * @name getInfoMessages
     * @access public
     * @return Strign Contruccion del mensaje
     * @param String $data Campo o dato del que se va a mandar alerta
     */
    public function getInfoMessages($data) {
        if ($data != NULL):

            //contruir el mensaje
            //preparo el array de mensaje y tipo de mensaje
            $dataMensaje = array(
                'mensaje' => '
                 <p>
                    <strong>
                    ¡Informacion!
                    </strong>
                    Estás Editando: "' . $data . '".
                 </p>',
                'tipo' => 'alert-info'
            );
            //contruyo el mensaje
            return mensaje($dataMensaje['mensaje'], $dataMensaje['tipo']);
        else:
            return NULL;
        endif;
    }

    /**
     * Obtener alerta de tipo Información
     * 
     * @name    getSaveMessage
     * @access  public
     * @return  Strign Contruccion del mensaje
     * @param   String $data Campo o dato del que se va a mandar alerta
     */
    public function getSaveMessage($data) {
        if ($data != NULL):

            //contruir el mensaje
            //preparo el array de mensaje y tipo de mensaje
            $dataMensaje = array(
                'mensaje' => '
                 <p>
                    <strong>
                    ¡Informacion!
                    </strong>
                    Ha guardado: "' . $data . '" satisfactoriamente.
                 </p>',
                'tipo' => 'alert-success'
            );
            //contruyo el mensaje
            return mensaje($dataMensaje['mensaje'], $dataMensaje['tipo']);
        else:
            return NULL;
        endif;
    }

    /**
     * Obtener alerta de tipo Actualización
     * 
     * @name    getUpdateMessage
     * @access  public
     * @return  Strign Contruccion del mensaje
     * @param   String $data Campo o dato del que se va a mandar alerta
     */
    public function getUpdateMessage($data) {
        if ($data != NULL):

            //contruir el mensaje
            //preparo el array de mensaje y tipo de mensaje
            $dataMensaje = array(
                'mensaje' => '
                 <p>
                    <strong>
                    ¡Informacion!
                    </strong>
                    Ha actualizado: "' . $data . '" satisfactoriamente.
                 </p>',
                'tipo' => 'alert-success'
            );
            //contruyo el mensaje
            return mensaje($dataMensaje['mensaje'], $dataMensaje['tipo']);
        else:
            return NULL;
        endif;
    }

    /**
     * Obtener alerta de tipo Error
     * 
     * @name    getErrorMessage
     * @access  public
     * @return  Strign Contruccion del mensaje
     * @param   String $data Campo o dato del que se va a mandar alerta
     */
    public function getErrorMessage($data) {
        if ($data != NULL):

            //contruir el mensaje
            //preparo el array de mensaje y tipo de mensaje
            $dataMensaje = array(
                'mensaje' => '
                 <p>
                    <strong>
                    ¡Error!
                    </strong>
                    ' . $data . '
                 </p>',
                'tipo' => 'alert-danger'
            );
            //contruyo el mensaje
            return mensaje($dataMensaje['mensaje'], $dataMensaje['tipo']);
        else:
            return NULL;
        endif;
    }

    /**
     * Obtener alerta de tipo Actualización
     * 
     * @name    getLockMessage
     * @access  public
     * @return  Strign Contruccion del mensaje
     * @param   String $data Campo o dato del que se va a mandar alerta
     * @param   Array  $data Array de campos por los que se ha bloqueado un control
     */
    public function getLockMessage($data) {
        if ($data != NULL):
            //contruir el mensaje
            $mensaje = "<p>
                    <strong>
                    ¡Alerta!
                    </strong>
                    Éste módulo está bloqueado por esta(s) posible(s) situación(es): <br />";
            //compruebo si no es un array
            if (is_array($data)):
                foreach ($data as $item):
                    $mensaje .= '<i class="fa fa-exclamation-circle"></i> Deben existir "' . $item . '" activos o disponibles.<br />';
                endforeach;
            else:
                $mensaje .= '<i class="fa fa-exclamation-circle"></i> Deben existir "' . $data . '" activos o disponibles.';
            endif;
            //finalizo el mensaje
            $mensaje .= "</p>";
            //contruyo el mensaje
            return mensaje($mensaje, 'alert-danger');
        else:
            return NULL;
        endif;
    }

}
