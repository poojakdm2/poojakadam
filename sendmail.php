
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $name = $_POST['name'] ?? '';

$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';

$msg = $_POST['msg'] ?? '';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kadam.mpooja16@gmail.com'; // Replace
        $mail->Password   = ' kfbm yziu jwef xjub'; // Replace with Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('kadam.mpooja16@gmail.com', 'Website Contact');
        $mail->addAddress('kadam.mpooja16@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission from Website ';
        $mail->Body    = "
           <h2>New Inquiry from Website</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email: </strong> $email</p>
        <p><strong>Subject: </strong> $subject</p>
       
        <p><strong>Message:</strong><br>$msg</p>
        ";

        $mail->send();
        header("Location: index.php?status=success");
        exit;
    } catch (Exception $e) {
        $errorMsg = urlencode($mail->ErrorInfo);
        header("Location: index.php?status=error&msg=$errorMsg");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

