<?php
    /**
     * Created by PhpStorm.
     * User: own2pwn
     * Date: 15.02.18
     * Time: 18:12
     */

    $answer    = $_POST['answer'];
    $recipient = $_POST['recipient'];

    include_once('PHPMailer.php');
    include_once('SMTP.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 4;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host       = 'smtp.rambler.ru ';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                               // Enable SMTP authentication
        $mail->Username   = 'adogonasheva@rambler.ru';                 // SMTP username
        $mail->Password   = 'adminadmin';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('adogonasheva@rambler.ru', 'ShopKek');
        $mail->addAddress($recipient, 'Ответ на Ваш вопрос');     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Ответ на Ваш вопрос';
        $mail->Body    = '<b>' . $answer . '</b>';
        $mail->AltBody = $answer;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }