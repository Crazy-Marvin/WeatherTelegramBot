<?php
if($text == "/start") {
    $selectUser = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `user_id` = $userId");
    if($rowUser = mysqli_fetch_assoc($selectUser)) {
        function keyboardStart($chatId, $text) {
            $keyboard = '&reply_markup={"keyboard":[["🔍 CHECK"],["🔔 NOTIFICATIONS", "🚫 DELETE NOTIFICATIONS"],["⏱ TIME"],["HELP"]],"resize_keyboard":true}';
            $url = $GLOBALS[website]."/sendMessage?chat_id=$chatId&parse_mode=HTML&text=".urlencode($text).$keyboard;
            file_get_contents($url);
        }
        keyboardStart($chatId, "Hi, welcome to this weather bot. 🌞\nPlease choose your desired location(s) and I will send you the actual weather and moon phase.\nYou can enable notifications that send updates every 1, 2 or 3 hours.\nThe data comes from the website wttr.in and the source code is available on <b>GitHub</b>.\nhttps://github.com/Crazy-Marvin/WeatherTelegramBot\nEnjoy! 🏖");
    } else {
        $insert_user = mysqli_query($mysqli, "INSERT INTO `halmpwct_weather`.`users` (`user_id`, `status`, `notification`, `city`, `time`) VALUES ('$userId', '❌', '❌', NULL, NULL)");
        function keyboardStart($chatId, $text) {
            $keyboard = '&reply_markup={"keyboard":[["🔍 CHECK"],["🔔 NOTIFICATIONS", "🚫 DELETE NOTIFICATIONS"],["⏱ TIME"],["HELP"]],"resize_keyboard":true}';
            $url = $GLOBALS[website]."/sendMessage?chat_id=$chatId&parse_mode=HTML&text=".urlencode($text).$keyboard;
            file_get_contents($url);
        }
        keyboardStart($chatId, "Hi, welcome to this weather bot. 🌞\nPlease choose your desired location(s) and I will send you the actual weather and moon phase.\nYou can enable notifications that send updates every 1, 2 or 3 hours.\nThe data comes from the website wttr.in and the source code is available on <b>GitHub</b>.\nhttps://github.com/Crazy-Marvin/WeatherTelegramBot\nEnjoy! 🏖");
    }
}
?>