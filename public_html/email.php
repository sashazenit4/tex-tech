<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {$name = $_POST['name'];}
    if (isset($_POST['tel'])) {$phone = $_POST['tel'];}
    if (isset($_POST['mail'])) {$mail = $_POST['mail'];}
    if (isset($_POST['message'])) {$message = $_POST['message'];}

    $to = "hi@tex-tech.ru"; /*Укажите адрес, га который должно приходить письмо*/
    $sendfrom   = $mail; /*Укажите адрес, с которого будет приходить письмо, можно не настоящий, нужно для формирования заголовка письма*/
    $headers  = "From: " . strip_tags($sendfrom) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($sendfrom) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
    $subject = "Форма обратной связи";
    $message = "$message<br> <b>Имя отправителя:</b> $name <br><b>Телефон:</b> $phone";
    $send = mail ($to, $subject, $message, $headers);
    if ($send == 'true')
    {
    // echo '<center><p class="success">Спасибо за отправку вашего сообщения!</p></center>';
    }
    else 
    {
    // echo '<center><p class="fail"><b>Ошибка. Сообщение не отправлено!</b></p></center>';
    }
} else {
    http_response_code(403);
    // echo "Попробуйте еще раз";
}
sleep(1);
header('Location: http://www.tex-tech.ru/');
exit();
?>
