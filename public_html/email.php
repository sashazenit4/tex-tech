<?php
/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {$name = $_POST['name'];}
    if (isset($_POST['tel'])) {$phone = $_POST['tel'];}
    if (isset($_POST['mail'])) {$mail = $_POST['mail'];}
    if (isset($_POST['message'])) {$message = $_POST['message'];}

    $to = "hi@tex-tech.ru"; 
    $sendfrom   = $mail; 
    $headers  = "From: " . strip_tags($sendfrom) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($sendfrom) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
    $subject = "Форма обратной связи";
    $message = "$message<br> <b>Имя отправителя:</b> $name <br><b>Телефон:</b> $phone";
    $send = mail ($to, $subject, $message, $headers);
    ob_start();
    if ($send == 'true')
    {
        echo '<center><p class="success">Спасибо за отправку вашего сообщения!</p></center>';
    }
    else 
    {
        echo '<center><p class="fail"><b>Ошибка. Сообщение не отправлено!</b></p></center>';
    }
} else {
    http_response_code(403);
        echo "Попробуйте еще раз";
}
header('Location: https://www.tex-tech.ru/');
ob_end_flush();
exit();
*/
?>
<?php
require_once '/www/mail_settings.php';

// здесь указываем адрес администратора, который получит заявку с сайта
// если получателей несколько, указываем в формате: ['receiver@domain.org', 'other@domain.org' => 'A NAME']
// (там где 'A NAME' пишем любое имя, это ни на что не влияет)
$to = ['hi@tex-tech.ru' => 'ADMIN'];

// здесь указываем почтовый ящик, с помощью которого мы отсылаем почту
// имя пользователя для этого ящика мы указывали с Вами в файле с конфигурацией
$from = 'hi@tex-tech.ru';

// допустим, наша форма связи получает данные с формы, в которой заполняются имя, телефон, e-mail
if (isset($_POST['name'])) {$name = $_POST['name'];}
    if (isset($_POST['tel'])) {$tel = $_POST['tel'];}
    if (isset($_POST['mail'])) {$email = $_POST['mail'];}
    if (isset($_POST['message'])) {$message = $_POST['message'];}

// формируем тело письма для отправки администратору сайта
$adminText = <<<MESS
{$message} <br>
<b>Имя клиента</b>: {$name}<br>
<b>Телефон</b>: {$tel}<br>
<b>E-mail</b>: {$email}<br>
MESS;

// формируем тело письма для отправки клиенту, что его заявка получена
$clientText = <<<MESS
<b>{$name}</b>, Ваша заявка принята в работу<br>
Ожидайте звонок на номер телефона <b>{$tel}</b><br>
Ожидайте письмо на e-mail: <b>{$email}</b><br>
MESS;

// готовим отправку письма для администратора сайта
$messageToAdmin = (new Swift_Message("Заказ на обратный звонок"))
  ->setFrom([$from => $from])
  ->setTo($to)
  ->setBody($adminText, 'text/html')
;

// готовим отправку письма для клиента
$messageToClient = (new Swift_Message("Ваш заказ принят в работу"))
  ->setFrom([$from => $from])
  ->setTo([$email => $name])
  ->setBody($clientText, 'text/html')
;

// отправляем письмо администратору сайта и записываем результат в переменную $result
$result = $mailer->send($messageToAdmin);

// отправляем письмо клиенту
$mailer->send($messageToClient);

ob_start();
if($result === 1) { // если всё хорошо и письмо было отправлено
    echo '<h1>Спасибо! Ваша заявка была успешно отправлена! Ожидайте обратную связь по указанным контактным данным.</h1>';
} 
else { // если произошла ошибка и письмо не было отправлено
    echo '<h1>Произошла ошибка при отправке сообщения. Пожалуйста, свяжитесь с нами по телефону.</h1>';
}
header('Location: https://www.tex-tech.ru/');
ob_end_flush();
?>