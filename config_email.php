<?php
// Configuración de PHPMailer para envío de emails
// IMPORTANTE: Mantén estas credenciales seguras. En producción usa variables de entorno

define('PHPMAILER_HOST', 'smtp.gmail.com');
define('PHPMAILER_USERNAME', 'tucorreo@gmail.com'); // Tu correo Gmail
define('PHPMAILER_PASSWORD', 'tu_contraseña_app');   // Contraseña de app (no la de Gmail)
define('PHPMAILER_FROM_EMAIL', 'noreply@cyberbuild.es');
define('PHPMAILER_FROM_NAME', 'Cyberbuild - Recuperación de Contraseña');
define('PHPMAILER_SMTP_SECURE', 'tls');
define('PHPMAILER_PORT', 587);

// URL base de tu aplicación
define('BASE_URL', 'http://localhost');
?>
