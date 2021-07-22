<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use MysqlConfig;
use MysqldbAccess;

class DeleteDisGifCommand extends UserCommand{
    protected $name = 'deleteDisGif';
    protected $description = 'del dis';
    protected $version = '1.0.0';

    public function execute():ServerResponse
    {
        $connTelbot = MysqlConfig::connTelbot();
        $telbotAccess = new MysqldbAccess($connTelbot);

        $uniqueList = json_decode($telbotAccess->select("data", "temp_data", "`name`='disGif'")) ?? [];
        $message = $this->getMessage();

        if($message->getType() == "animation"){
            $fileUniqueId = $message->getAnimation()->getFileUniqueId();
            if(in_array($fileUniqueId, $uniqueList)){
                if (Request::deleteMessage(['chat_id'=> $message->getChat()->getId(), 'message_id' => $message->getMessageId(),])->isOk())
                    return $this->replyToChat("نفرست این عنو");
            }
        }
//        return $this->replyToChat("شسینفرست این عنو");
        return Request::emptyResponse();
    }
}
