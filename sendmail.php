<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

$mail->isSMTP();                               
$mail->Host       = 'smtp.gmail.com';                 
$mail->SMTPAuth   = true;                            
$mail->Username   = '';   
$mail->Password = '';                           
$mail->SMTPSecure = 'tls';  
$mail->Port       = '587';    


$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->isHTML(true);

$mail->setFrom('kir260302@gmail.com', 'Клієнт');
$mail->addAddress('kir260302@gmail.com');
$mail->addAddress('wrld4282@gmail.com');
$mail->Subject = "Нове повідомлення с сайту М.С. Управдом";

$body = '<h1>Новий лист</h1>';

if(trim(!empty($_POST['fname']))){
    $body.='<p><strong>Ім`я:</strong> '.$_POST['fname'].'</p>';
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
    $body.='<p><strong>Повідомлення:</strong> '.$_POST['message'].'</p>';
}
if(trim(!empty($_POST['houseYear']))){
    $body.='<p><strong>Рік будинку:</strong> '.$_POST['houseYear'].'</p>';
}
if(trim(!empty($_POST['metr']))){
    $body.='<p><strong>Квадратура дома:</strong> '.$_POST['metr'].'</p>';
}
if(trim(!empty($_POST['flats']))){
    $body.='<p><strong>Кількість квартир:</strong> '.$_POST['flats'].'</p>';
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
