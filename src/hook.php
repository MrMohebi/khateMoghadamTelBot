<?php


require __DIR__ . '/../vendor/autoload.php';
include_once "DataAccess/MysqldbAccess.php";
include_once "DataAccess/db.config.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../' );
$dotenv->load();

use TelegramBot\Api\Client;
use TelegramBot\Api\Types\Update;

include_once "functions/sendGif.php";
include_once "functions/disGif.php";
include_once "functions/dummyText.php";


try {
    $bot = new Client($_ENV['TOKEN']);
    //Handle text messages
    $bot->on(function (Update $update) use ($bot) {
        $message = $update->getMessage();
        $text = $message->getText();
        $chatId = $message->getChat()->getId();

        if($text =="chatId")
            $bot->sendMessage($chatId, $chatId);


        // test section
//        if($chatId == "-1001233610032" || "-1001325863232")


        // Khate Moghadam actions
        if($chatId == "-1001416542274"){
            sendGif($bot, $chatId, $text);
        }

        // high school class actions
        if($chatId == "-1001458338829"){
            sendGif($bot, $chatId, $text);
        }

        disGif($bot, $message);
        dummyText($bot, $message);

    }, function () {
        return true;
    });
    $bot->run();
} catch (\TelegramBot\Api\Exception $e) {
    echo $e->getMessage();
}
