<?php

use Longman\TelegramBot\Request;



function antiSpam($senderId, $chatId, $massageId, $text){
    $connTelbot = MysqlConfig::connTelbot();
    $telbotAccess = new MysqldbAccess($connTelbot);

    $spamResponses = array("کیر خر", "fuck u");
    shuffle($spamResponses);
    $spamResponse = end($spamResponses);

    $timeLimit =  time() - 900; // 15 min
    $command = $text;

    $isUserBlocked = count($telbotAccess->select('*', 'blocked_users', "`user_id`='$senderId' AND `chat_id`='$chatId' AND `command`='$command' AND `blocked_time`>=$timeLimit")) > 0;

    if($isUserBlocked){
        Request::deleteMessage(['chat_id'=>$chatId, 'message_id' =>$massageId]);
        return Request::sendMessage(['chat_id'=>$chatId, 'text' =>$spamResponse]);
    }

    $massageLogs = $telbotAccess->select('*', 'anti_spam', "`sender_id`='$senderId' AND `chat_id`='$chatId' AND `command`='$command' AND `send_time`>=$timeLimit");
    if($massageLogs > 10){
        $telbotAccess->insert('blocked_users', array(
            'user_id'=>$senderId,
            'chat_id'=>$chatId,
            'blocked_time'=>time(),
            'command'=>$text,
            'reason'=>"spam"
        ));
    }else{
        $telbotAccess->insert('anti_spam', array(
            'sender_id'=>$senderId,
            'chat_id'=>$chatId,
            'send_time'=>time(),
            'command'=>$text,
            'massage_id'=>$massageId
        ));
    }

    return false;
}