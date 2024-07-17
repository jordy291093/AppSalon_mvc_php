<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com', 'AppSalon');
        $mail->addAddress($_POST['email'], $_POST['nombre']);
        $mail->Subject = ('Confirmar tu cuenta');

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola: ". $this->email ."</strong> <br>Has creado tu cuenta en AppSalon, solo debes de confirmar tu cuenta de correo en el siguiente link</p>";
        $contenido .= "<p>Presiona aquí para confirmar: <a href='" . $_ENV['PROJECT_URL'] . "/confirmar-cuenta?token=". $this->token . "'> Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ingnorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar email
        $mail->send();
    }

    public function enviarInstrucciones() {
        $resultado = $_POST['enviarInstrucciones'];
        debuguear($_POST);

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com', 'AppSalon');
        $mail->addAddress($_POST['email'], $_POST['nombre']);
        $mail->Subject = ('Reestablecer Password');

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola: ". $this->nombre ."</strong> <br>Has solicitado reestablecer tu password, ir al siguiente enlace para reestablecer tu password.</p>";
        $contenido .= "<p>Presiona aquí para confirmar: <a href='" . $_ENV['PROJECT_URL'] . "/recuperar?token=". $this->token . "'> Reestablecer Password</a></p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ingnorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        // Enviar email
        $mail->send();
    }
}