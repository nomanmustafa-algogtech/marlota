<?php
/**
 * Test Email Script - Marlota
 * Sends a test email to nomanmustafa79@gmail.com using existing SMTP credentials.
 * DELETE this file after testing.
 */

// Bootstrap CodeIgniter
define('BASEPATH', '');

$smtp_host    = 'marlota.co.uk';
$smtp_user    = 'orders@marlota.co.uk';
$smtp_pass    = 'Mancity.123';
$smtp_port    = 465;
$smtp_crypto  = 'ssl';
$from_email   = 'orders@marlota.co.uk';
$from_name    = 'Marlota';
$to_email     = 'nomanmustafa79@gmail.com';

// Use PHPMailer-compatible approach via PHP's native SSL SMTP
$context = stream_context_create([
    'ssl' => [
        'verify_peer'       => false,
        'verify_peer_name'  => false,
        'allow_self_signed' => true,
    ],
]);

$errno  = 0;
$errstr = '';

echo "Connecting to {$smtp_host}:{$smtp_port} over SSL...\n";

$socket = stream_socket_client(
    "ssl://{$smtp_host}:{$smtp_port}",
    $errno,
    $errstr,
    30,
    STREAM_CLIENT_CONNECT,
    $context
);

if (!$socket) {
    die("Connection failed: [{$errno}] {$errstr}\n");
}

function smtp_read($socket) {
    $response = '';
    while ($line = fgets($socket, 515)) {
        $response .= $line;
        if (substr($line, 3, 1) === ' ') break;
    }
    echo "< " . trim($response) . "\n";
    return $response;
}

function smtp_send($socket, $cmd) {
    echo "> " . trim($cmd) . "\n";
    fwrite($socket, $cmd . "\r\n");
    return smtp_read($socket);
}

smtp_read($socket); // greeting

smtp_send($socket, "EHLO " . gethostname());
smtp_send($socket, "AUTH LOGIN");
smtp_send($socket, base64_encode($smtp_user));
smtp_send($socket, base64_encode($smtp_pass));
smtp_send($socket, "MAIL FROM:<{$from_email}>");
smtp_send($socket, "RCPT TO:<{$to_email}>");
smtp_send($socket, "DATA");

$subject  = "Test Email from Marlota";
$body     = "<h2>Test Email</h2><p>This is a test email sent from <strong>Marlota</strong> using SMTP credentials.</p><p>If you received this, the email configuration is working correctly.</p>";
$date     = date('r');
$headers  = "Date: {$date}\r\n";
$headers .= "From: {$from_name} <{$from_email}>\r\n";
$headers .= "To: {$to_email}\r\n";
$headers .= "Subject: {$subject}\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";
$headers .= "X-Mailer: Marlota Test Script\r\n";

$message = $headers . "\r\n" . $body . "\r\n.";
fwrite($socket, $message . "\r\n");
$response = smtp_read($socket);

smtp_send($socket, "QUIT");
fclose($socket);

if (strpos($response, '250') !== false) {
    echo "\n✓ Test email sent successfully to {$to_email}\n";
} else {
    echo "\n✗ Email sending may have failed. Server response: {$response}\n";
}
