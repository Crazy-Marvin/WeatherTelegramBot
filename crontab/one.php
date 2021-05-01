<?php
require_once "/var/www/html/weather/index.php";

$i = 0;

$selectUserAutomatic = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `city` IS NOT NULL AND `time` = '1'");
$numUserAutomatic = mysqli_num_rows($selectUserAutomatic);

while ($i <= $numUserAutomatic) {
    $rowUserAutomatic = mysqli_fetch_assoc($selectUserAutomatic);
    $recordUserIdAutomatic = $rowUserAutomatic["user_id"];
    $recordCityAutomatic = $rowUserAutomatic["city"];
    $weatherAutomatic = file_get_contents("http://wttr.in/$recordCityAutomatic?format=<code>[%l]</code>\nPrevision:%20%C\nTemperature:%20<b>%t</b>\nMoonphase:%20%m");
    $weatherAutomaticFormat = str_replace("_", "\n", $weatherAutomatic);
    sendMessage($recordUserIdAutomatic, $weatherAutomaticFormat);
    $i++;
}
?>