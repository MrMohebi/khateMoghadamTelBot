<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;


use MysqlConfig;
use MysqldbAccess;



class RemoveClassCommand extends UserCommand{
    protected $name = 'removeClass';
    protected $description = 'remove Class from';
    protected $version = '1.0.0';

    public function execute():ServerResponse
    {
        $connTelbot = MysqlConfig::connTelbot();
        $telbotAccess = new MysqldbAccess($connTelbot);

        $message = $this->getMessage();
        $text = $message->getText();

        $commandArr = preg_split('/[\s\n\r]+/',$text,-1,PREG_SPLIT_NO_EMPTY);
        $className = $commandArr[1];
        if(!$telbotAccess->noDuplicate(array('lessen_name'=>$className), 'class_reminder'))
            return $this->replyToChat("کیرم تو مغزت، اصلا همچین کلاسی نداریم اسکل");

        if(strlen($className) > 1){
            $sql_deleteClass = "DELETE FROM `class_reminder` WHERE `lessen_name`='$className'";
            if(mysqli_query($connTelbot, $sql_deleteClass))
                return $this->replyToChat("تمومس، پاک شد");
        }
        return $this->replyToChat("کیر توش نشد");
    }
}
