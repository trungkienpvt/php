<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'phpmailer.php';
require_once 'pop3.php';
require_once 'smtp.php';
$mail = new PHPMailer(); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch															   
$mail->IsSMTP();                           // tell the class to use SMTP
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 465;
$mail->SMTPSecure = "ssl";
$mail->Host       = 'smtp.gmail.com';
$mail->Username   = 'phantrungkienvt@gmail.com';     // SMTP server username
$mail->Password   = 'xxx';            // SMTP server password
//$mail->AddReplyTo('phantrungkienvt@gmail.com','trung kien phan');
$mail->From       = 'phantrungkienvt@gmail.com' ;
$mail->FromName  = 'trung kien' ; 
$mail->AddAddress('phantrungkienvt@gmail.com', 'trung kien');
$mail->Subject  = 'test send mail';		
//$mail->AddEmbeddedImage();
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; 
$mail->WordWrap   = 80; // set word wrap

$mail->MsgHTML('demo send mail by smtp');

$mail->IsHTML(true); // send as HTML
if($mail->Send()){
  echo "send mail successful, please check mail";
}
?>
