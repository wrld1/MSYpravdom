<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->isHTML(true);

$mail->setFrom('wrld4282@gmail.com', 'Test');
$mail->addAddress('kir260302@gmail.com');
$mail->Subject = "Нове повідомлення с сайту М.С. Управдом";

$body = '<h1>Новое письмо</h1>';

if(trim(!empty($_POST['fname']))){
    $body.='<p><strong>Имя:</strong> '.$_POST['fname'].'</p>';
}
if(trim(!empty($_POST['lname']))){
    $body.='<p><strong>Прізвище:</strong> '.$_POST['lname'].'</p>';
}
if(trim(!empty($_POST['email']))){
    $body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
}
if(trim(!empty($_POST['phone']))){
    $body.='<p><strong>Номер телефону:</strong> '.$_POST['phone'].'</p>';
}
if(trim(!empty($_POST['message']))){
    $body.='<p><strong>E-mail:</strong> '.$_POST['message'].'</p>';
}

if(!empty($_FILES['image']['tmp_name'])){
    $filePath = __DIR__ . "/files/" . $_FILES['image']['name'];
    if(copy($_FILES['image']['tmp_name'], $filePath)){
        $fileAttach = $filePath;
        $body.='<p><strong>Фото</strong></p>';
        $mail->addAttachment($fileAttach);
    }
}

$mail->Body = $body;

if(!$mail->send()){
    $message = 'Помилка';
}else{
    $message = "Дані відправлено!";
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);

?>