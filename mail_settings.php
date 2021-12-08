<?php
require_once '/var/www/u1473438/data/vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.yandex.ru', 465))
  ->setUsername('hi@yandex.ru')
  ->setPassword('nkeylefjxrrkaamh')
  ->setEncryption('SSL')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);
?>