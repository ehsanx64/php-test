<?php
use PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PhpMailerController extends Controller {
    public function __construct() {
    }

    public function index() {
		$mail = new PHPMailer\PHPMailer();

		// Set mailer to use SMTP
		$mail->isSMTP();

		// Specify main and backup SMTP servers
		$mail->Host = '';

		// Enable SMTP authentication
		$mail->SMTPAuth = true;

		// SMTP username and password
		$mail->Username = '';
		$mail->Password = '';

		// Enable encryption, only 'tls' is accepted
//		$mail->SMTPSecure = 'tls';

		// Set 'from' address and 'from name'
		$mail->From = 'test@ehsanm.net';
		$mail->FromName = 'Test Account';

		// Add a recipient
		$mail->addAddress('');

		// Set word wrap to 50 characters
		$mail->WordWrap = 50;

		$mail->Subject = 'Hello';
		$mail->Body = 'Testing some Mailgun awesomness';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}
    }
}
