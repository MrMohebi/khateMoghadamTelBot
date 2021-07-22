<?php
namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;


use MysqlConfig;
use MysqldbAccess;



class RemoveStudentCommand extends UserCommand{
    protected $name = 'removeStudent';
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
        if(count($memberList) > 0){
            $previousStudents = json_decode($telbotAccess->select("students_id", "class_reminder", "`lessen_name`='$className'"));
            $newStudents = array_diff($previousStudents, $memberList);

            if($telbotAccess->update('class_reminder', array('students_id'=>json_encode($newStudents)), "`lessen_name`='$className'"))
                return $this->replyToChat(" از کلاس " . $className . " سیکشون زده شد ");
        }


        return $this->replyToChat("کیر توش نشد");
    }
}