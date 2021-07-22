<?php
include_once "../DataAccess/MysqldbAccess.php";
include_once "../DataAccess/db.config.php";

function disGif($bot,$message){
    $chatId = $message->getChat()->getId();

    $connTelbot = MysqlConfig::connTelbot();
    $telbotAccess = new MysqldbAccess($connTelbot);
    $uniqueList = json_decode($telbotAccess->select("data", "temp_data", "`name`='disGif' AND `user_id`='$chatId'"), false) ?? [];
    $result= json_decode(file_get_contents("php://input"));

    if($message->getAnimation() !== null){
        $fileUniqueId = $result->message->animation->file_unique_id ?? "";
        if(in_array($fileUniqueId, $uniqueList)){
            if ($bot->deleteMessage($chatId, $message->getMessageId()))
                return $bot->sendMessage($chatId,"نفرست این عنو");

        }
    }

    if($message->getFrom()->getId() == 851828777 && $message->getReplyToMessage() !== null && $message->getReplyToMessage()->getAnimation() !== null){
        $fileUniqueId = $result->message->reply_to_message->animation->file_unique_id ?? "";
        if($message->getText() == "دهنت" && strlen($fileUniqueId) > 2){
            if(in_array($fileUniqueId, $uniqueList)){
                return $bot->sendMessage($chatId, "حالمون بهم زدی :(", null, false, $message->getMessageId());
            }
            if(count($uniqueList) === 0){
                $telbotAccess->insert("temp_data", ["data"=>json_encode(["@@",$fileUniqueId]),"name"=>"disGif", "user_id"=> $chatId]);
            }else{
                $telbotAccess->updateAppendToList("temp_data", array("data"=>$fileUniqueId), "`name`='disGif' AND `user_id`='$chatId'");
            }
            return $bot->sendMessage($chatId,"حالمون بهم زدی :(", null, false, $message->getMessageId());
        }else if($message->getText() == "ندهنت" && strlen($fileUniqueId) > 2){
            $newUniqueList = array_values(array_diff($uniqueList,[$fileUniqueId]));
            $telbotAccess->update("temp_data", array("data"=>json_encode($newUniqueList)), "`name`='disGif' AND `user_id`='$chatId'");
            return $bot->sendMessage($chatId,"اوک بفرستش، ولی دهنت", null, false, $message->getMessageId());
        }
    }
    return false;
}