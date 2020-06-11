<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';

function SendMail($to, $content, $subject){
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
		echo "<p style='display:none;'>";
		//Server settings
		$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers smtp.gmail.com
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'mailermy17@gmail.com';                 // SMTP username
		$mail->Password = 'my_mailer2017';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom('mailer@ebahn-solutions.com', 'Mailer No Reply');
		$mail->addAddress('gadanyaa@yahoo.com', 'Joe User');     // Add a recipient
		$mail->addAddress($to);               // Name is optional
		$mail->addReplyTo('sales@ebahn-solutions.com', 'No Reply');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $content;
		$mail->AltBody = $content;;

		$mail->send();
		
		echo 'Message has been sent';
		echo "</p>";
	} catch (Exception $e) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
}




?>
