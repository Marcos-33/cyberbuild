<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarCorreo($to, $asunto, $mensaje) {
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor (Punto 3.1)
        $mail->isSMTP();
        $mail->Host       = 'localhost'; // O jefatura.cyberbuild.lan
        $mail->SMTPAuth   = true;
        $mail->Username   = 'appguardias'; // Usuario creado arriba
        $mail->Password   = 'tu_contraseña'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587; // Puerto obligatorio

        // Remitente y Destinatario
        $mail->setFrom('appguardias@centro.local', 'Sistema Guardias');
        $mail->addAddress($to);
        
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $mensaje;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}