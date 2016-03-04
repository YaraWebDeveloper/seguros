<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//clase para tomar como libreria
class My_PHPMailer {

    public function __construct() {
        require_once('PHPMailer/class.phpmailer.php');
        //obtengo lo principal de php mailer. 
    }

    /*
     * -------------------------------------------------------------------------
     * Metodo para enviar mensajes por SMTP
     * -------------------------------------------------------------------------
     */

    public function enviarCorreo($pData) {
        //variable de retorno
        $valorRetorno = FALSE;
        //se crea el objeto de tipo mailer
        $mail = new PHPMailer(TRUE);
        //inicializo los valores que se vana anecesitar
        $pData['dataUsuario'] = "luisfernando@YARA WEB Developercolombia.com";
        $pData['dataContraseña'] = "Fher961222";


        $mail->IsSMTP(); // establecemos que utilizaremos SMTP
        $mail->SMTPAuth = true; // habilitamos la autenticación SMTP
        $mail->SMTPSecure = "ssl";  // establecemos el prefijo del protocolo seguro de comunicación con el servidor
        $mail->Host = "smtp.gmail.com";      // establecemos GMail como nuestro servidor SMTP
        $mail->Port = 465;                   // establecemos el puerto SMTP en el servidor de GMail
        $mail->Username = $pData['dataUsuario'];  // la cuenta de correo GMail
        $mail->Password = $pData['dataContraseña'];            // password de la cuenta GMail
        
        //datos del mensaje
        $mail->SetFrom("soporte@YARA WEB Developercolombia.com", 'Mensaje automatico de Soporte IT');  //Quien envía el correo
        //$mail->AddReplyTo($pData['dataUsuario'], "Mensaje automatico de Soporte IT");  //A quien debe ir dirigida la respuesta
        $mail->Subject = $pData['dataAsunto'];  //Asunto del mensaje
        $mail->Body = $pData['dataMensaje']; //cuerpo del mensaje
        $mail->IsHTML(true); //le especifico que puedo enviar html
        $mail->AddAddress($pData['dataCorreo'], $pData['dataNombre']);

        //verifico si el mensaje se envio
        if ($mail->Send()) :
            $valorRetorno = TRUE;
        else:
            echo $mail->ErrorInfo;
        endif;

        //retorno la variable
        return $valorRetorno;
    }

}
