<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;


use MysqlConfig;
use MysqldbAccess;



class AddStudentCommand extends UserCommand{
    protected $name = 'addStudent';
    protected $description = 'add student to';
    protected $version = '1.0.0';


    public function execute():ServerResponse
    {
        $connTelbot = MysqlConfig::connTelbot();
        $telbotAccess = new MysqldbAccess($connTelbot);

        $message = $this->getMessage();
        $text = $message->getText();

        $commandArr = preg_split('/[\s\n\r]+/',$text,-1,PREG_SPLIT_NO_EMPTY);
        $className = $commandArr[1];

        $memberList = array();
        foreach ($commandArr as $eMember){
            if(substr( $eMember, 0, 1 ) == '@')
                $memberList[] = $eMember;
        }
        if(count($memberList) > 10){
            return $this->replyToChat("اسپم نکن کونی :|");
        }
        if(count($memberList) > 0){
            for ($i = 0; $i < count($memberList); $i++){
                $telbotAccess->updateAppendToList('class_reminder', array(
                    'students_id'=>$memberList[$i],
                ), "`lessen_name`='$className'");
            }
            return $this->replyToChat(" زده شدن تنگ کلاس " . $className);
        }


        return $this->replyToChat("کیر توش نشد");
    }
}