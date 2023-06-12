<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;

    }

    public function enviarConfirmacion() {

        define("EMAIL_HOST", "sandbox.smtp.mailtrap.io");
        define("EMAIL_USERNAME", "ec60cf36982548");
        define("EMAIL_PASS", "86f142fe59f177");
        define("EMAIL_SMTPSECURE", "tls");
        define("EMAIL_PORT", 2525);
        define("EMAIL_ADMIN", 'ddr-288a24@inbox.mailtrap.io');
        try {
            // Creamos el objeto PHPMailer
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;

            // Configuracion del servidor (obtenido de mailtrap)
            $mail->Host = EMAIL_HOST;
            $mail->Username = EMAIL_USERNAME;
            $mail->Password = EMAIL_PASS;
            $mail->SMTPSecure = EMAIL_SMTPSECURE;
            $mail->Port = EMAIL_PORT;

            // Indicamos el origen del correo
            $mail->setFrom(EMAIL_ADMIN);

            // Añadimos el destinatario (ahora mismo solo irá a mailtrap)
            $mail->addAddress("admin@crosffit.com");

            // Indicamos el asuento
            $mail->Subject  = "Confirma tu Cuenta";

            // Indicamos que puede contener codigo html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Mensaje del email
            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>. has creado tu cuenta en Crossfit Relaño, confirma presionando el siguiente enlace:</p>";
            $contenido .= "<p>Presiona aqui: <a href='http://localhost/AppCrossfit/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
            $contenido .= "<p>Si no solicitaste esta cuenta, ignore este mensaje</p>";
            $contenido .= "</html>";
            $mail->Body = $contenido;
            

            // Enviamos el email, nos indicará si se envio o no
            $mail->send();
            
            
        } catch (Exception $e) {
            echo "Error: {$e->ErrorInfo}";
        }
    
    }

    public function enviarInstrucciones() {

        define("EMAIL_HOST", "sandbox.smtp.mailtrap.io");
        define("EMAIL_USERNAME", "ec60cf36982548");
        define("EMAIL_PASS", "86f142fe59f177");
        define("EMAIL_SMTPSECURE", "tls");
        define("EMAIL_PORT", 2525);
        define("EMAIL_ADMIN", 'ddr-288a24@inbox.mailtrap.io');
        try {
            // Creamos el objeto PHPMailer
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;

            // Configuracion del servidor (obtenido de mailtrap)
            $mail->Host = EMAIL_HOST;
            $mail->Username = EMAIL_USERNAME;
            $mail->Password = EMAIL_PASS;
            $mail->SMTPSecure = EMAIL_SMTPSECURE;
            $mail->Port = EMAIL_PORT;

            // Indicamos el origen del correo
            $mail->setFrom(EMAIL_ADMIN);

            // Añadimos el destinatario (ahora mismo solo irá a mailtrap)
            $mail->addAddress("admin@crosffit.com");

            // Indicamos el asuento
            $mail->Subject  = "Reestablece tu Contraseña";

            // Indicamos que puede contener codigo html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Mensaje del email
            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre . "</strong>. has solicitado reestablecer tu contraseña.</p>";
            $contenido .= "<p>Presiona en el siguiente enlace: <a href='http://localhost/AppCrossfit/recuperar?token=" . $this->token . "'>Reestablecer Contraseña</a></p>";
            $contenido .= "<p>Si no solicitaste este cambio, ignore este mensaje.</p>";
            $contenido .= "</html>";
            $mail->Body = $contenido;

            // Enviamos el email, nos indicará si se envio o no
            $mail->send();
            
            
        } catch (Exception $e) {
            echo "Error: {$e->ErrorInfo}";
        }
    }

    public function enviarSugerencia($mensaje, $email) {

        define("EMAIL_HOST", "sandbox.smtp.mailtrap.io");
        define("EMAIL_USERNAME", "ec60cf36982548");
        define("EMAIL_PASS", "86f142fe59f177");
        define("EMAIL_SMTPSECURE", "tls");
        define("EMAIL_PORT", 2525);
        define("EMAIL_ADMIN", 'ddr-288a24@inbox.mailtrap.io');
        try {
            // Creamos el objeto PHPMailer
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;

            // Configuracion del servidor (obtenido de mailtrap)
            $mail->Host = EMAIL_HOST;
            $mail->Username = EMAIL_USERNAME;
            $mail->Password = EMAIL_PASS;
            $mail->SMTPSecure = EMAIL_SMTPSECURE;
            $mail->Port = EMAIL_PORT;

            // Indicamos el origen del correo
            $mail->setFrom(EMAIL_ADMIN);

            // Añadimos el destinatario (ahora mismo solo irá a mailtrap)
            $mail->addAddress($email);

            // Indicamos el asuento
            $mail->Subject  = "Sugerencia";

            // Indicamos que puede contener codigo html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Mensaje del email
            $contenido = "<html>";
            $contenido .= "<p>$mensaje</p>";
            $contenido .= "</html>";
            $mail->Body = $contenido;

            // Enviamos el email, nos indicará si se envio o no
            $mail->send();
            
            
        } catch (Exception $e) {
            echo "Error: {$e->ErrorInfo}";
        }

    }
}