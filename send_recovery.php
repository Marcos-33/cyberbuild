<?php
// procesar petición de recuperación: genera token, lo guarda y envía email

$conexion = mysqli_connect("localhost","cyberbuild","Admin1234","faltas");
if (!$conexion) {
    die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener DNI y email del formulario
    $dni = isset($_POST['dni']) ? trim($_POST['dni']) : '';
    $gmail = isset($_POST['gmail']) ? trim($_POST['gmail']) : '';

    // Validar que no estén vacíos
    if (empty($dni) || empty($gmail)) {
        die("DNI y correo son requeridos");
    }

    // Comprobar que el par dni+email exista en la BD
    $sql = "SELECT dni FROM usuario WHERE dni = '$dni' AND gmail = '$gmail'";
    $res = $conexion->query($sql);
    
    if ($res && $res->num_rows === 1) {
        // Generar token
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', time() + 3600);

        // Guardar token en BD
        $sqlInsert = "INSERT INTO password_resets (dni, token, expires_at) VALUES ('$dni', '$token', '$expires')";
        $conexion->query($sqlInsert);

        // Construir enlace de recuperación
        $resetLink = "http://localhost/reset_password.php?token=" . $token;

        // Preparar mensaje de email
        $subject = "Recuperar contraseña - Cyberbuild";
        $message = "Has solicitado restablecer tu contraseña.\n\n" .
                   "Pulsa en el siguiente enlace:\n\n" .
                   "$resetLink\n\n" .
                   "Este enlace caduca en una hora.\n\n" .
                   "Si no solicitaste esto, ignora este email.";

        // Enviar email con mail() nativa (sin PHPMailer)
        $headers = "From: noreply@cyberbuild.es\r\n";
        $headers .= "Reply-To: noreply@cyberbuild.es\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        if (mail($gmail, $subject, $message, $headers)) {
            echo "✅ Si el correo existe en nuestro sistema, recibirás un mensaje con instrucciones.";
        } else {
            error_log("Error enviando correo con mail()");
            echo "✅ Si el correo existe en nuestro sistema, recibirás un mensaje con instrucciones.";
        }

        /*
        // ALTERNATIVA: Usar PHPMailer (requiere instalar con Composer)
        // composer require phpmailer/phpmailer
        
        try {
            require 'vendor/autoload.php';
            
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            
            // Configuración SMTP Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tuemail@gmail.com';  // Tu correo Gmail
            $mail->Password = 'tu_contraseña_app';  // Contraseña de aplicación
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            
            // Remitente y destinatario
            $mail->setFrom('noreply@cyberbuild.es', 'Cyberbuild');
            $mail->addAddress($gmail);
            
            // Contenido
            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body = $message;
            
            // Enviar
            $mail->send();
            
            echo "✅ Email enviado correctamente.";
            
        } catch (Exception $e) {
            error_log("Error PHPMailer: " . $e->getMessage());
            echo "❌ Error enviando email.";
        }
        */
    } else {
        echo "✅ Si el correo existe en nuestro sistema, recibirás un mensaje con instrucciones.";
    }
}
?>