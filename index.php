<?php
$botToken = "1139919498:AAEqp4e-2l_a-3GKPNGte9gUAEI6MlRw6Dg";
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents('php://input');
$update = json_decode($update, True);

$config = [
    'mysql_host' => '',
    'mysql_user' => '',
    'mysql_password' => '',
    'mysql_db' => 'halmpwct_weather'
];

$mysqli = new mysqli(
    $config['mysql_host'],
    $config['mysql_user'],
    $config['mysql_password'],
    $config['mysql_db']
);

$mysqli->query("set names utf8mb4_general_ci");

$text = $update['message']['text'];
$chatId = $update['message']['chat']['id'];
$userId = $update['message']['from']['id'];
$msgId = $update['message']['message_id'];
$queryText = $update['callback_query']['data'];
$queryUserId = $update['callback_query']['from']['id'];
$queryMsgId = $update['callback_query']['message']['message_id'];

function sendMessage($chatId, $text) {
    $url = $GLOBALS[website]."/sendMessage?chat_id=$chatId&parse_mode=HTML&text=".urlencode($text);
    file_get_contents($url);
}

function editMessageText($chatId, $msgId, $text) {
    $url = $GLOBALS[website]."/editMessageText?chat_id=$chatId&message_id=$msgId&parse_mode=HTML&text=".urlencode($text);
    file_get_contents($url);
}

include "/var/www/html/weather/assets/start.php";
include "/var/www/html/weather/assets/help.php";
include "/var/www/html/weather/assets/commands.php";
?>