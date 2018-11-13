<?php
include 'codigo.php'; 
$mail = new PHPMailer;
$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'socialsivex.com';              // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'admin@socialsivex.com'; // your email id
$mail->Password = 'Gabriel124'; // your password
$mail->SMTPSecure = 'ssl';                  
$mail->Port = 465;     //587 is used for Outgoing Mail (SMTP) Server.
$mail->setFrom('admin@socialsivex.com', 'Sivex Social Network');
$mail->addAddress('testing4thewinmlg@gmail.com');   // Add a recipient
$mail->isHTML(true);  // Set email format to HTML

$bodyContent = '<h1>Registo com Sucesso</h1>';
$bodyContent .= '<p>O seu registo foi completo. Ative agora a sua <a href="http://socialsivex.com/ativar.php">Conta</a>';
$mail->Subject = 'Sivex - Registo Concluido';
$mail->Body    = $bodyContent;
if(!$mail->send()) {

} else {

}
?>