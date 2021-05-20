<?php
// Load composer
require __DIR__ . '/../vendor/autoload.php';

use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
$config = require __DIR__ . '/config.php';


include_once "DataAccess/MysqldbAccess.php";
include_once "DataAccess/db.config.php";

include_once 'antiSpam.php';

$connTelbot = MysqlConfig::connTelbot();
$telbotAccess = new MysqldbAccess($connTelbot);


try {
    $telegram = new Telegram($config['api_key'], $config['bot_username']);
    $telegram->addCommandsPaths($config['commands']['paths']);

    // input fields
    $result= json_decode(file_get_contents("php://input"));
    $userId = $result->message->from->id ?? "";
    $username = $result->message->from->username ?? "";
    $userFirstName = $result->message->from->first_name ?? "";
    $text = $result->message->text ?? "";
    $chatId = $result->message->chat->id ?? "";
    $massageId = $result->message->message_id ?? "";
    $idOfRepliedUser = $result->message->reply_to_message->from->id ?? "";
    $repliedText = $result->message->reply_to_message->text ?? "";
    $firstname_of_replied_user = $result->message->reply_to_message->from->first_name ?? "";

    // save to chat history
    $telbotAccess->insert("chat_history", array(
        'chat_id'=>$chatId,
        "info_data"=>json_encode($result),
        "massage_text"=>$text,
        "replay_to_massage_text"=>$repliedText
    ));

    $telegram->handle();

    if(count(explode("$$$", $text)) > 1){
        if (Request::deleteMessage(['chat_id'    => $chatId, 'message_id' => $massageId,])->isOk())
            Request::sendMessage(['chat_id' => $chatId, 'text' => explode("$$$", $text)[1]]);
    }

    $isSpam = antiSpam($userId,$chatId,$chatId,$text);
    if($isSpam !== false){
        if (Request::deleteMessage(['chat_id'    => $chatId, 'message_id' => $massageId,])->isOk())
            Request::sendMessage(['chat_id' => $chatId, 'text' => $isSpam . " @". $username]);
        exit();
    }

    if ($chatId !== '' && $text == 'کلاس') {
        $telegram->executeCommand('classReminder');
        $telegram->executeCommand('editClassReminder');
    }else if($chatId !== '' && $text == '🐣صفحه اصلی'){
        $telegram->executeCommand('start');
    }else if ($chatId !== '' && $text == 'لیست دستورات کلاس🍆'){
        $result = Request::sendMessage(['chat_id' => $chatId,
            'text' =>
                "کلاس➕ => اضافه کردن کلاس مثل:" . "\n\n".
                "کلاس➕ معماری " . "\n".
                "@mmad @blabla". "\n".
                "----------------" . "\n".
                "دانشجو👨‍👨‍👦‍👦 => اضافه کردن دانشجو به کلاس مثل:" . "\n\n".
                "دانشجو👨‍👨‍👦‍👦 معماری " . "\n".
                "@mmad @blabla". "\n".
                "----------------" . "\n".
                "دانشجو👨‍👨‍👦 => حذف دانشجو از کلاس مثل:" . "\n\n".
                "دانشجو👨‍👨‍👦 معماری " . "\n".
                "@mmad @blabla". "\n".
                "----------------" . "\n".
                "کلاس✖️ => حذف کلاس مثل:" . "\n\n".
                "کلاس✖️ معماری " . "\n".
                "----------------" . "\n"
        ]);
    }else if($chatId !== '' &&  in_array('کلاس➕', preg_split('/[\s\n\r]/',$text))){
        $telegram->executeCommand('addClass');
    } else if($chatId !== '' &&  in_array('دانشجو👨‍👨‍👦‍👦', preg_split('/[\s\n\r]/',$text))){
        $telegram->executeCommand('addStudent');
    } else if($chatId !== '' &&  in_array('دانشجو👨‍👨‍👦', preg_split('/[\s\n\r]/',$text))){
        $telegram->executeCommand('removeStudent');
    }else if($chatId !== '' &&  in_array('کلاس✖️', preg_split('/[\s\n\r]/',$text))){
        $telegram->executeCommand('removeClass');
    }else if($chatId !== '' && $text == 'بخورش🍆'){
        $result = Request::sendMessage(['chat_id' => $chatId, 'text' =>  "By order of ESI foocking NAJAFI...",]);
    }



//    else{
//        $data = [
//            'chat_id' => $chatId,
//            'text' =>  "asdf",
//        ];
//        $result = Request::sendMessage($data);
//    }


} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    // echo $e->getMessage();
}