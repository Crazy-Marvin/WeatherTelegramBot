<?php
$selectUser = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `user_id` = $userId");
$rowUser = mysqli_fetch_assoc($selectUser);
$recordStatus = $rowUser["status"];
$recordNotification = $rowUser["notification"];
$recordCity = $rowUser["city"];

if($text == "🔍 CHECK") {
    if($recordStatus == "❌") {
        $updateUser = mysqli_query($mysqli, "UPDATE `halmpwct_weather`.`users` SET `status` = '✔️' WHERE `users`.`user_id` = $userId");
        sendMessage($chatId, "🔍 Please type your city");
    }
}

if($text) {
    if($recordStatus == "✔️") {
        $weather = file_get_contents("http://wttr.in/$text?format=<code>[%l]</code>\nPrevision:%20%C\nTemperature:%20<b>%t</b>\nMoonphase:%20%m");
        if($weather) {
            $updateUser = mysqli_query($mysqli, "UPDATE `halmpwct_weather`.`users` SET `status` = '❌' WHERE `users`.`user_id` = $userId");
            $weatherFormat = str_replace("_", "\n", $weather);
            sendMessage($chatId, $weatherFormat);
        } else {
            sendMessage($chatId, "❌ Please enter a valid city.");
        }
    }
}

if($text == "🔔 NOTIFICATIONS") {
    if($recordStatus == "❌") {
        $updateUser = mysqli_query($mysqli, "UPDATE `halmpwct_weather`.`users` SET `notification` = '✔️', `time` = '1' WHERE `users`.`user_id` = $userId");
        sendMessage($chatId, "🔍 Please type your city");
    }
}

if($text) {
    if($recordNotification == "✔️") {
        $weather = file_get_contents("http://wttr.in/$text?format=<code>[%l]</code>\nPrevision:%20%C\nTemperature:%20<b>%t</b>\nMoonphase:%20%m");
        if($weather) {
            $updateUser = mysqli_query($mysqli, "UPDATE `halmpwct_weather`.`users` SET `notification` = '❌', `city` = '$text' WHERE `users`.`user_id` = $userId");
            sendMessage($chatId, "✔️ You set notifications for <code>[$text]</code> city.");
        } else {
            sendMessage($chatId, "❌ Please enter a valid city.");
        }
    }
}

if($text == "🚫 DELETE NOTIFICATIONS") {
    if($recordCity != NULL) {
        $updateUser = mysqli_query($mysqli, "UPDATE `halmpwct_weather`.`users` SET `city` = NULL WHERE `users`.`user_id` = $userId");
        sendMessage($chatId, "✔️ You have turned off notifications.");
    } else {
        sendMessage($chatId, "❌ You have already turned off notifications.");
    }
}

if($text == "⏱ TIME") {
    function KeyboardTime($chatId, $text) {
        $keyboard = '&reply_markup={"inline_keyboard":[[{"text":"1H","callback_data":"1htime"},{"text":"2H","callback_data":"2htime"}],[{"text":"3H","callback_data":"3htime"}]],"resize_keyboard":true}';
        $url = $GLOBALS[website]."/sendMessage?chat_id=$chatId&parse_mode=HTML&text=".urlencode($text).$keyboard;
        file_get_contents($url);
    }
    KeyboardTime($chatId, "Please select time notifications:");
}

if($queryText == "1htime") {
    $updateUser = mysqli_query($mysqli, "UPDATE `halmpwct_weather`.`users` SET `time` = '1' WHERE `users`.`user_id` = $queryUserId");
    editMessageText($queryUserId, $queryMsgId, "✔️ You set every <code>[1H]</code> hour notification");
}

if($queryText == "2htime") {
    $updateUser = mysqli_query($mysqli, "UPDATE `halmpwct_weather`.`users` SET `time` = '2' WHERE `users`.`user_id` = $queryUserId");
    editMessageText($queryUserId, $queryMsgId, "✔️ You set every <code>[2H]</code> hours notification");
}

if($queryText == "3htime") {
    $updateUser = mysqli_query($mysqli, "UPDATE `halmpwct_weather`.`users` SET `time` = '3' WHERE `users`.`user_id` = $queryUserId");
    editMessageText($queryUserId, $queryMsgId, "✔️ You set every <code>[3H]</code> hours notification");
}
?>