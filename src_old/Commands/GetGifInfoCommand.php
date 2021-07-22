<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;

use Longman\TelegramBot\Request;


class GetGifInfoCommand extends UserCommand{
    protected $name = 'getGifInfo';
    protected $description = 'get gif info';
    protected $version = '1.0.0';

    public function execute():ServerResponse
    {
        $massage = $this->getMessage();
        $chatId = $massage->getChat()->getId();


        if($chatId == "-1001325863232"){
            $fileId = $massage->getAnimation()->getFileId();
            $fileUniqId = $massage->getAnimation()->getFileUniqueId();
            return $this->replyToChat("fileID:". $fileId . "\n\nfileUniqueId:".$fileUniqId);
        }
        return Request::emptyResponse();
    }
}
