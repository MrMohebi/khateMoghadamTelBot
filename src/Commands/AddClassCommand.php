<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;


use MysqlConfig;
use MysqldbAccess;



class AddClassCommand extends UserCommand{
    protected $name = 'addClass';
    protected $description = 'add class';
    protected $version = '1.0.0';

    public function execute():ServerResponse
    {
        $connTelbot = MysqlConfig::connTelbot();
        $telbotAccess = new MysqldbAccess($connTelbot);

        $message = $this->getMessage();
        $text = $message->getText();

        $commandArr = preg_split('/[\s\n\r]+/',$text,-1,PREG_SPLIT_NO_EMPTY);
        $className = $commandArr[1];
        if(substr( $className, 0, 1 ) == '@')
            return $this->replyToChat("ریدی که، اصلا اسم کلاس مشخص");

        if($telbotAccess->noDuplicate(array('lessen_name'=>$className), 'class_reminder'))
            return $this->replyToChat("کسخل کلاس تکراری زدی");

        $memberList = array();
        foreach ($commandArr as $eMember){
            if(substr( $eMember, 0, 1 ) == '@')
                $memberList[] = $eMember;
        }
        if(count($memberList) > 10){
            return $this->replyToChat("اسپم نکن کونی :|");
        }
        if(count($memberList) > 0)
            if($telbotAccess->insert('class_reminder', array(
                'lessen_name'=>$className,
                'students_id'=>characterFixer(json_encode($memberList)),
                'modified_date'=>time(),
            )))
                return $this->replyToChat(" کلاس " . $className. " زده شد تنگش ");

        return $this->replyToChat("کیر توش نشد");
    }
}

function characterFixer($str){
    return preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
        return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UTF-16BE');
    }, $str);
}