<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;

use MysqlConfig;
use MysqldbAccess;

class AddDelDisGifCommand extends UserCommand{
    protected $name = 'addDelDisGif';
    protected $description = 'Add del dis';
    protected $version = '1.0.0';

    public function execute():ServerResponse
    {
        $connTelbot = MysqlConfig::connTelbot();
        $telbotAccess = new MysqldbAccess($connTelbot);

        $uniqueList = json_decode($telbotAccess->select("data", "temp_data", "`name`='disGif'"), false) ?? [];
        $message = $this->getMessage();
        $text = $message->getText();

        $fileUniqueId ="";
        if($message->getReplyToMessage()->getMessageId() > 0 && $message->getReplyToMessage()->getType() == "animation")
            $fileUniqueId = $message->getReplyToMessage()->getAnimation()->getFileUniqueId();

        if($text == "دهنت" && strlen($fileUniqueId) > 2){
            if(in_array($fileUniqueId, $uniqueList)){
                return $this->replyToChat("حالمون بهم زدی :(");
            }
            $telbotAccess->updateAppendToList("temp_data", array("data"=>$fileUniqueId), "`name`='disGif'");
        }else if($text == "ندهنت" && strlen($fileUniqueId) > 2){
            $newUniqueList = array_values(array_diff($uniqueList,[$fileUniqueId]));
            $telbotAccess->update("temp_data", array("data"=>json_encode($newUniqueList)), "`name`='disGif'");
            return $this->replyToChat("اوک بفرستش، ولی دهنت");
        }

        return $this->replyToChat("حالمون بهم زدی :(");
    }
}
